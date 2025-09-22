<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: StudentModel
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

    // Fetch students with search, limit, and offset
    public function search($search = '', $limit = 5, $offset = 0)
    {
        $query = "SELECT * FROM {$this->table} 
                  WHERE first_name LIKE :search 
                     OR last_name LIKE :search 
                     OR email LIKE :search
                  ORDER BY id DESC
                  LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Count total records matching search
    public function countSearch($search = '')
    {
        $query = "SELECT COUNT(*) as total FROM {$this->table} 
                  WHERE first_name LIKE :search 
                     OR last_name LIKE :search 
                     OR email LIKE :search";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
