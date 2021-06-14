<?php

namespace app\controllers;

use app\models\ClassModel;
use start\core\Controller;
use app\models\StudentModel;

class StudentController extends Controller
{
    public function index()
    {
        $list_student = StudentModel::all();
        $data = array("list_student" => $list_student);
        return view("students.index", $data);
    }

    public function create()
    {
        $list_class = ClassModel::all();
        $data = array("list_class" => $list_class);
        return view("students.create", $data);
    }

    public function store() 
    {
        $input = $this->request->post();
        $student = new StudentModel;
        $student->set_student_name($input['student_name']);
        $student->set_student_gender($input['student_gender']);
        $student->set_student_class($input['student_class']);
       
        StudentModel::store($student);
        $this->redirect("student/list");
    }

    public function edit($id)
    {
        $student = StudentModel::find_by_id($id);
        $list_class = ClassModel::all();
        $data = array(
            "student" => $student,
            "list_class" => $list_class
        );

        return view("students.edit", $data);
    }

    public function update()
    {
        $input = $this->request->post();

        $student = new StudentModel;
        $student->set_student_id($input['student_id']);
        $student->set_student_name($input['student_name']);
        $student->set_student_gender($input['student_gender']);
        $student->set_student_class($input['student_class']);
    
        StudentModel::update($student);
        $this->redirect("student/list");
    }

    public function destroy($id)
    {
        StudentModel::destroy($id);
        $this->redirect("student/list");
    }
}