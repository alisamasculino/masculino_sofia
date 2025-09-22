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
        // Get search keyword safely
        $search = $this->io->get('search') ?? '';

        // Pagination setup
        $limit = 9; // 9 records per page
        $currentPage = (int)($this->io->get('page') ?? 1);
        if ($currentPage < 1) $currentPage = 1;

        $offset = ($currentPage - 1) * $limit;

        // Fetch data
        $users = $this->StudentModel->getPaginated($limit, $offset, $search);
        $totalRecords = $this->StudentModel->countAll($search);
        $totalPages = ceil($totalRecords / $limit);

        // Send data to view
        $this->call->view('students/index', [
            'users' => $users,
            'search' => $search,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages
        ]);
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