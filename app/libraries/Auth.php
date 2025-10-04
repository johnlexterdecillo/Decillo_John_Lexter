<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Authentication Library
 * Handles user authentication, authorization, and session management
 */
class Auth {
    protected $lava;
    
    public function __construct()
    {
        $this->lava =& lava_instance();
        $this->lava->call->library('session');
        $this->lava->call->model('UserModel');
    }
    
    /**
     * Register a new user
     * 
     * @param array $data User data (username, email, password, class, role)
     * @return array Result with success status and message
     */
    public function register($data)
    {
        // Validate required fields
        if (empty($data['username']) || empty($data['email']) || empty($data['password'])) {
            return ['success' => false, 'message' => 'Username, email, and password are required'];
        }
        
        // Check if username already exists
        $existing_user = $this->lava->db->table('users')
            ->where('username', $data['username'])
            ->get();
        
        if ($existing_user) {
            return ['success' => false, 'message' => 'Username already exists'];
        }
        
        // Check if email already exists
        $existing_email = $this->lava->db->table('users')
            ->where('email', $data['email'])
            ->get();
        
        if ($existing_email) {
            return ['success' => false, 'message' => 'Email already exists'];
        }
        
        // Hash password
        $hashed_password = password_hash($data['password'], PASSWORD_BCRYPT);
        
        // Prepare user data
        $user_data = [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $hashed_password,
            'class' => $data['class'] ?? 'adventurer',
            'role' => $data['role'] ?? 'user',
            'avatar' => $data['avatar'] ?? null
        ];
        
        // Insert user
        try {
            $user_id = $this->lava->db->table('users')->insert($user_data);
            return ['success' => true, 'message' => 'Registration successful', 'user_id' => $user_id];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Registration failed: ' . $e->getMessage()];
        }
    }
    
    /**
     * Login user
     * 
     * @param string $username Username or email
     * @param string $password Password
     * @return array Result with success status and message
     */
    public function login($username, $password)
    {
        if (empty($username) || empty($password)) {
            return ['success' => false, 'message' => 'Username and password are required'];
        }
        
        // Find user by username or email
        $user = $this->lava->db->table('users')
            ->where('username', $username)
            ->or_where('email', $username)
            ->get();
        
        if (!$user) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }
        
        // Verify password
        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }
        
        // Set session data
        $session_data = [
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'role' => $user['role'],
            'class' => $user['class'],
            'avatar' => $user['avatar'],
            'logged_in' => true
        ];
        
        $this->lava->session->set_userdata($session_data);
        
        // Update last login timestamp if column exists
        try {
            $this->lava->db->table('users')
                ->where('id', $user['id'])
                ->update(['last_login' => date('Y-m-d H:i:s')]);
        } catch (Exception $e) {
            // Ignore if last_login column doesn't exist
        }
        
        return ['success' => true, 'message' => 'Login successful', 'user' => $session_data];
    }
    
    /**
     * Logout user
     * 
     * @return void
     */
    public function logout()
    {
        $this->lava->session->unset_userdata('user_id');
        $this->lava->session->unset_userdata('username');
        $this->lava->session->unset_userdata('email');
        $this->lava->session->unset_userdata('role');
        $this->lava->session->unset_userdata('class');
        $this->lava->session->unset_userdata('avatar');
        $this->lava->session->unset_userdata('logged_in');
        $this->lava->session->sess_destroy();
    }
    
    /**
     * Check if user is logged in
     * 
     * @return bool
     */
    public function is_logged_in()
    {
        return $this->lava->session->userdata('logged_in') === true;
    }
    
    /**
     * Get current user data
     * 
     * @return array|null
     */
    public function user()
    {
        if (!$this->is_logged_in()) {
            return null;
        }
        
        return [
            'id' => $this->lava->session->userdata('user_id'),
            'username' => $this->lava->session->userdata('username'),
            'email' => $this->lava->session->userdata('email'),
            'role' => $this->lava->session->userdata('role'),
            'class' => $this->lava->session->userdata('class'),
            'avatar' => $this->lava->session->userdata('avatar')
        ];
    }
    
    /**
     * Check if user has a specific role
     * 
     * @param string $role Role to check
     * @return bool
     */
    public function has_role($role)
    {
        if (!$this->is_logged_in()) {
            return false;
        }
        
        return $this->lava->session->userdata('role') === $role;
    }
    
    /**
     * Check if user is admin
     * 
     * @return bool
     */
    public function is_admin()
    {
        return $this->has_role('admin');
    }
    
    /**
     * Require authentication (redirect if not logged in)
     * 
     * @param string $redirect_to URL to redirect to after login
     * @return void
     */
    public function require_auth($redirect_to = null)
    {
        if (!$this->is_logged_in()) {
            if ($redirect_to) {
                $this->lava->session->set_userdata('redirect_after_login', $redirect_to);
            }
            redirect('auth/login');
            exit;
        }
    }
    
    /**
     * Require admin role (redirect if not admin)
     * 
     * @return void
     */
    public function require_admin()
    {
        $this->require_auth();
        
        if (!$this->is_admin()) {
            redirect('auth/unauthorized');
            exit;
        }
    }
    
    /**
     * Require specific role
     * 
     * @param string $role Required role
     * @return void
     */
    public function require_role($role)
    {
        $this->require_auth();
        
        if (!$this->has_role($role)) {
            redirect('auth/unauthorized');
            exit;
        }
    }
    
    /**
     * Change user password
     * 
     * @param int $user_id User ID
     * @param string $old_password Old password
     * @param string $new_password New password
     * @return array Result with success status and message
     */
    public function change_password($user_id, $old_password, $new_password)
    {
        $user = $this->lava->db->table('users')->where('id', $user_id)->get();
        
        if (!$user) {
            return ['success' => false, 'message' => 'User not found'];
        }
        
        // Verify old password
        if (!password_verify($old_password, $user['password'])) {
            return ['success' => false, 'message' => 'Current password is incorrect'];
        }
        
        // Hash new password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
        
        // Update password
        try {
            $this->lava->db->table('users')
                ->where('id', $user_id)
                ->update(['password' => $hashed_password]);
            
            return ['success' => true, 'message' => 'Password changed successfully'];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Failed to change password: ' . $e->getMessage()];
        }
    }
}
