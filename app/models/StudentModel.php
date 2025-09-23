<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Paginated search by first or last name (and optionally email).
     *
     * @param string $queryString
     * @param int    $perPage
     * @param int    $page
     * @return array [data, total]
     */
    public function search_paginated($queryString = '', $perPage = 10, $page = 1)
    {
        $q = trim($queryString);

        // Count total with filters
        $this->db->table($this->table);
        if ($q !== '') {
            $like = '%'.$q.'%';
            $this->db->grouped(function($db) use ($like) {
                $db->like('first_name', $like)
                   ->or_like('last_name', $like)
                   ->or_like('email', $like);
            });
        }
        $total = $this->db->count();

        // Fetch page data with same filters
        $offset = max(0, ($page - 1) * $perPage);
        $this->db->table($this->table);
        if ($q !== '') {
            $like = '%'.$q.'%';
            $this->db->grouped(function($db) use ($like) {
                $db->like('first_name', $like)
                   ->or_like('last_name', $like)
                   ->or_like('email', $like);
            });
        }
        $data = $this->db->order_by('id', 'DESC')->limit($offset, $perPage)->get_all();

        return [
            'data' => $data,
            'total' => (int) $total
        ];
    }
}