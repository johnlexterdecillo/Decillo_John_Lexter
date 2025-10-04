<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class DashboardController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->library('auth');
        $this->call->model('UserModel');
        
        // Require authentication
        $this->auth->require_auth();
    }
    
    public function index()
    {
        $current_user = $this->auth->user();
        
        // Get statistics
        $data['current_user'] = $current_user;
        // Use select_count/get to avoid driver-specific count_all
        $usersCountRow = $this->db->table('users')->select_count('*', 'count')->get();
        $data['total_users'] = isset($usersCountRow['count']) ? (int)$usersCountRow['count'] : 0;

        try {
            $advCountRow = $this->db->table('adventurers')->select_count('*', 'count')->get();
            $data['total_adventurers'] = isset($advCountRow['count']) ? (int)$advCountRow['count'] : 0;
        } catch (Exception $e) {
            // Adventurers table may not exist yet
            $data['total_adventurers'] = 0;
        }
        
        // Get recent users
        $data['recent_users'] = $this->db->table('users')
            ->order_by('created_at', 'DESC')
            ->limit(5)
            ->get_all();
        
        // Get user's adventurers if adventurers table exists
        try {
            $data['my_adventurers'] = $this->db->table('adventurers')
                ->where('user_id', $current_user['id'])
                ->order_by('created_at', 'DESC')
                ->limit(5)
                ->get_all();
        } catch (Exception $e) {
            $data['my_adventurers'] = [];
        }
        
        // Get class distribution
        $data['class_stats'] = $this->db->raw("
            SELECT class, COUNT(*) as count 
            FROM users 
            WHERE class IS NOT NULL 
            GROUP BY class 
            ORDER BY count DESC 
            LIMIT 5
        ");
        
        $this->call->view('dashboard/index', $data);
    }
}
