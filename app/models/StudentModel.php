<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: StudentsModel
 * 
 * Automatically generated via CLI.
 */
class StudentModel extends Model {
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }


     public function page($q = '', $records_per_page = null, $page = null) {
 
            if (is_null($page)) {
                return $this->db->table('students')->get_all();
            } else {
                $query = $this->db->table('students');

                 // Grouped LIKE conditions across name and email
                 $like = '%'.$q.'%';
                 $query->grouped(function($db) use ($like) {
                     $db->like('first_name', $like)
                        ->or_like('last_name', $like)
                        ->or_like('email', $like);
                 });
                    
                // Clone before pagination
                $countQuery = clone $query;

                $data['total_rows'] = $countQuery->select_count('*', 'count')
                                                ->get()['count'];

                $data['records'] = $query->pagination($records_per_page, $page)
                                        ->get_all();

                return $data;
            }
        }
}