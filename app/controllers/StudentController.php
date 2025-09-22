<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: StudentController
 * 
 * Automatically generated via CLI.
 */
class StudentController extends Controller {
    public function __construct()
    {
        parent::__construct();

        $this->call->database();
        $this->call->model('StudentModel');
    }

    public function index()
    {
        // Get search query safely
        $search = $this->io->get('search') ?? '';

        // Prepare base query
        $query = "SELECT * FROM students";

        if ($search !== '') {
            // Use prepared statements to prevent SQL injection
            $query .= " WHERE first_name LIKE :search OR last_name LIKE :search OR email LIKE :search";
            $params = [':search' => "%$search%"];
            $data['users'] = $this->StudentModel->query($query, $params); 
        } else {
            $data['users'] = $this->StudentModel->all();
        }

        // Pass search term to view
        $data['search'] = $search;

        $this->call->view('students/index', $data);
    }


    public function create() 
    {
        if($this->io->method() == 'post') {
            $first_name = $this->io->post('first_name');
            $last_name  = $this->io->post('last_name');
            $email      = $this->io->post('email');

            $data = array(
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'email'      => $email,
            );

            if ($this->StudentModel->insert($data)) {
                redirect();
            } else {
                echo 'Error creating student.';
            }
        } else {
            $this->call->view('students/create');
        }
    }

    public function update($id)
    {
        $user = $this->StudentModel->find($id);
        if (!$user) {   
            echo 'Student not found.';
            return;
        }

        if($this->io->method() == 'post') {
            $first_name = $this->io->post('first_name');
            $last_name  = $this->io->post('last_name');
            $email      = $this->io->post('email');

            $data = array(
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'email'      => $email,
            );

            if ($this->StudentModel->update($id, $data)) {
                redirect();
            } else {
                echo 'Error updating student.';
            }
        } else {
            $data['user'] = $user;
            $this->call->view('students/update', $data);
        }
    }

    public function delete($id)
    {
        if ($this->StudentModel->delete($id)) {
            redirect();
        } else {
            echo 'Error deleting student.';
        }
    }
}