<?php
require_once '../repositories/StudentRepository.php';
require_once '../core/Response.php';

class StudentController {
    private $repositories;

    public function __construct($db) {
        $this->repositories = new StudentRepository($db);
    }

    public function getAllStudents() {
        $StudentRepository = $this->repositories->getAllStudents();
        Response::json($StudentRepository);
    }

    public function getStudentById($id) {
        $StudentRepository = $this->repositories->getStudentById($id);
        if ($StudentRepository) {
            Response::json($StudentRepository);
        } else {
            Response::json(["message" => "Student not found."], 404);
        }
    }

    public function addStudent($data) {
        if (isset($data['name'], $data['midterm_score'], $data['final_score'])) {
            $this->repositories->addStudent($data['name'], $data['midterm_score'], $data['final_score']);
            Response::json(["message" => "Student added successfully."]);
        } else {
            Response::json(["message" => "Invalid input."], 400);
        }
    }

    public function updateStudent($data) {
        if (isset($data['id'], $data['midterm_score'], $data['final_score'])) {
            $this->repositories->updateStudent($data['id'], $data['midterm_score'], $data['final_score']);
            Response::json(["message" => "Student updated successfully."]);
        } else {
            Response::json(["message" => "Invalid input."], 400);
        }
    }

    public function deleteStudent($id) {
        $this->repositories->deleteStudent($id);
        Response::json(["message" => "Student deleted successfully."]);
    }
}
?>
