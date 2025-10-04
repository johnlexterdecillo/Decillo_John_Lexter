<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->library('auth');
        $this->call->library('session');
    }
    
    /**
     * Display login page
     */
    public function login()
    {
        // Redirect if already logged in
        if ($this->auth->is_logged_in()) {
            redirect('users/view');
            return;
        }
        
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');
            $remember = $this->io->post('remember');
            
            $result = $this->auth->login($username, $password);
            
            if ($result['success']) {
                // Check for redirect URL
                $redirect_url = $this->session->userdata('redirect_after_login');
                
                if ($redirect_url) {
                    $this->session->unset_userdata('redirect_after_login');
                    redirect($redirect_url);
                } else {
                    redirect('users/view');
                }
            } else {
                $data['error'] = $result['message'];
                $this->call->view('auth/login', $data);
            }
        } else {
            $this->call->view('auth/login');
        }
    }
    
    /**
     * Display registration page
     */
    public function register()
    {
        // Redirect if already logged in
        if ($this->auth->is_logged_in()) {
            redirect('users/view');
            return;
        }
        
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = $this->io->post('password');
            $confirm_password = $this->io->post('confirm_password');
            $class = $this->io->post('class');
            
            // Validation
            if ($password !== $confirm_password) {
                $data['error'] = 'Passwords do not match';
                $this->call->view('auth/register', $data);
                return;
            }
            
            if (strlen($password) < 6) {
                $data['error'] = 'Password must be at least 6 characters long';
                $this->call->view('auth/register', $data);
                return;
            }
            
            $reg_data = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'class' => $class,
                'role' => 'user' // Default role
            ];
            
            $result = $this->auth->register($reg_data);
            
            if ($result['success']) {
                // Auto-login after registration
                $this->auth->login($username, $password);
                redirect('users/view');
            } else {
                $data['error'] = $result['message'];
                $this->call->view('auth/register', $data);
            }
        } else {
            $this->call->view('auth/register');
        }
    }
    
    /**
     * Logout user
     */
    public function logout()
    {
        $this->auth->logout();
        redirect('auth/login');
    }
    
    /**
     * Unauthorized access page
     */
    public function unauthorized()
    {
        $this->call->view('auth/unauthorized');
    }
    
    /**
     * User profile page
     */
    public function profile()
    {
        $this->auth->require_auth();
        
        $user = $this->auth->user();
        $data['user'] = $this->db->table('users')->where('id', $user['id'])->get();
        
        $this->call->view('auth/profile', $data);
    }
    
    /**
     * Change password
     */
    public function change_password()
    {
        $this->auth->require_auth();
        
        if ($this->io->method() === 'post') {
            $user = $this->auth->user();
            $old_password = $this->io->post('old_password');
            $new_password = $this->io->post('new_password');
            $confirm_password = $this->io->post('confirm_password');
            
            if ($new_password !== $confirm_password) {
                $data['error'] = 'New passwords do not match';
                $this->call->view('auth/change_password', $data);
                return;
            }
            
            if (strlen($new_password) < 6) {
                $data['error'] = 'Password must be at least 6 characters long';
                $this->call->view('auth/change_password', $data);
                return;
            }
            
            $result = $this->auth->change_password($user['id'], $old_password, $new_password);
            
            if ($result['success']) {
                $data['success'] = $result['message'];
            } else {
                $data['error'] = $result['message'];
            }
            
            $this->call->view('auth/change_password', $data);
        } else {
            $this->call->view('auth/change_password');
        }
    }
}
