<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // Get paginated + searched results
    public function getPaginated($limit, $offset, $search = '')
    {
        $this->db->table($this->table);
        if (!empty($search)) {
            $this->db->like('first_name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('email', $search);
        }
        return $this->db->limit($limit, $offset)->get_all();
    }

    // Count total rows (for pagination)
    public function countAll($search = '')
    {
        $this->db->table($this->table);
        if (!empty($search)) {
            $this->db->like('first_name', $search);
            $this->db->or_like('last_name', $search);
            $this->db->or_like('email', $search);
        }
        return $this->db->get()->num_rows();
    }
}
