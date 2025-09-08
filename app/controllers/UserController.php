<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel');
    }

    
    public function view()
    {
        $data['users'] = $this->UserModel->all();
        $this->call->view('users/view', $data);
    }

    
    public function create()
    {
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');

            $data = [
                'username' => $username,
                'email' => $email
            ];

            try {
               
                $this->UserModel->insert($data);
                redirect('users/view');
            } catch (Exception $e) {
                echo 'Something went wrong while creating user: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $this->call->view('users/create');
        }
    }

    public function update($id)
    {
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');

            $data = [
                'username' => $username,
                'email' => $email
            ];

            try {
                
                $this->UserModel->update($id, $data);
                redirect('users/view');
            } catch (Exception $e) {
                echo 'Something went wrong while updating user: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $data['user'] = $this->UserModel->find($id);
            $this->call->view('users/update', $data);
        }
    }

    
    public function delete($id)
{
    if ($this->io->method() === 'post') {
        // Actually delete the user (POST request from confirmation form)
        try {
            if ($this->UserModel->delete($id)) {
                redirect('users/view');
            } else {
                echo 'Something went wrong while deleting user';
            }
        } catch (Exception $e) {
            echo 'Something went wrong while deleting user: ' . htmlspecialchars($e->getMessage());
        }
    } else {
        // Show delete confirmation page (GET request from users table)
        $data['user'] = $this->UserModel->find($id);
        if (!$data['user']) {
            echo 'User not found';
            return;
        }
        $this->call->view('users/delete', $data);
    }
}
}
