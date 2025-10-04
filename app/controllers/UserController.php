<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UserModel');
        $this->call->library('pagination');
        $this->call->library('auth');
        
        // Require authentication for all user operations
        $this->auth->require_auth();
    }

    public function view()
    {
        $page = isset($_GET['page']) ? (int)$this->io->get('page') : 1;
        $q = isset($_GET['q']) ? trim($this->io->get('q')) : '';

        $records_per_page = 5;
        $all = $this->UserModel->page($q, $records_per_page, $page);
        $data['users'] = $all['records'];
        $total_rows = $all['total_rows'];

        // Provide current user info to the view (avoid using $this->session in views)
        $data['current_user'] = $this->auth->user();

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('default');
        $this->pagination->initialize(
            $total_rows,
            $records_per_page,
            $page,
            site_url('users/view') . '?q=' . urlencode($q)
        );
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/view', $data);
    }

    public function create()
    {
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $class = $this->io->post('class');

            $data = [
                'username' => $username,
                'email'    => $email,
                'class'    => $class
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
            $class = $this->io->post('class');

            $data = [
                'username' => $username,
                'email'    => $email,
                'class'    => $class
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
        // Only admins can delete users
        $this->auth->require_admin();

        if ($this->io->method() === 'post') {
            try {
                $this->UserModel->delete($id);
                redirect('users/view');
            } catch (Exception $e) {
                echo 'Something went wrong while deleting user: ' . htmlspecialchars($e->getMessage());
            }
        } else {
            $data['user'] = $this->UserModel->find($id);
            if (!$data['user']) {
                redirect('users/view');
                return;
            }
            $this->call->view('users/delete', $data);
        }
    }
}
