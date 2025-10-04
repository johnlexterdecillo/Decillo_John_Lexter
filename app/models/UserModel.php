<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    // ✅ Allow class, avatar, password, and role
    protected $allowed_fields = ['username', 'email', 'class', 'avatar', 'password', 'role'];

    protected $validation_rules = [
        'username' => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|max_length[150]',
        'class'    => 'permit_empty|min_length[1]|max_length[50]',
        'avatar'   => 'permit_empty', // allow no file uploaded
        'password' => 'permit_empty|min_length[6]', // required only on registration
        'role'     => 'permit_empty' // default to 'user' if not provided
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function page($q = '', $records_per_page = null, $page = null)
    {
        if (is_null($page)) {
            // return all without pagination
            return [
                'total_rows' => $this->db->table($this->table)->count_all(),
                'records'    => $this->db->table($this->table)->get_all()
            ];
        } else {
            $query = $this->db->table($this->table);

            if (!empty($q)) {
                $query->like('username', '%'.$q.'%')
                      ->or_like('email', '%'.$q.'%')
                      ->or_like('class', '%'.$q.'%');
            }

            // count total rows
            $countQuery = clone $query;
            $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];

            // fetch paginated records
            $data['records'] = $query->pagination($records_per_page, $page)->get_all();

            return $data;
        }
    }
}
