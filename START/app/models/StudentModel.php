<?php

namespace app\models;

use start\database\DB;

class StudentModel
{
    const TABLE = "student";
    private $student_id;
    private $student_name;
    private $student_gender;
    private $student_class;

    public function __construct()
    {

    }

    /**
     * Get the value of student_id
     */ 
    public function get_student_id()
    {
        return $this->student_id;
    }

    /**
     * Set the value of student_id
     *
     * @return  self
     */ 
    public function set_student_id($student_id)
    {
        $this->student_id = $student_id;

        return $this;
    }

    /**
     * Get the value of student_name
     */ 
    public function get_student_name()
    {
        return $this->student_name;
    }

    /**
     * Set the value of student_name
     *
     * @return  self
     */ 
    public function set_student_name($student_name)
    {
        $this->student_name = $student_name;

        return $this;
    }

    /**
     * Get the value of student_gender
     */ 
    public function get_student_gender()
    {
        return $this->student_gender;
    }

    /**
     * Set the value of student_gender
     *
     * @return  self
     */ 
    public function set_student_gender($student_gender)
    {
        $this->student_gender = $student_gender;

        return $this;
    }

    /**
     * Get the value of student_class
     */ 
    public function get_student_class()
    {
        return $this->student_class;
    }

    /**
     * Set the value of student_class
     *
     * @return  self
     */ 
    public function set_student_class($student_class)
    {
        $this->student_class = $student_class;

        return $this;
    }

    public static function all()
    {
        $db = new DB;
        $sql = "SELECT * FROM ". self::TABLE;
        $result = $db->get($sql);

        $list_student = [];
        foreach ($result as $each) {
            $student = new StudentModel;
            $student->set_student_id($each['student_id']);
            $student->set_student_name($each['student_name']);
            $student->set_student_gender($each['student_gender']);
            $student->set_student_class(ClassModel::find_by_id($each['class_id']));
            $list_student[] = $student;
        }

        return $list_student;
    }

    public static function store(StudentModel $student)
    {
        $db = new DB;
        $sql = "CALL ADD_STUDENT(?, ?, ?)";
        $params = array(
            $student->get_student_name(),
            $student->get_student_gender(),
            $student->get_student_class()
        );
        
        $db->run($sql, $params);
    }

    public static function find_by_id($id)
    {
        $db = new DB;
        $sql = "SELECT * FROM " . self::TABLE . " WHERE student_id = ?";
        // dd($sql);
        $params = array($id);

        $results = $db->first($sql, $params);
        if (empty($results)) {
            return false;
        }

        $student = new StudentModel;
        $student->set_student_id($results['student_id']);
        $student->set_student_name($results['student_name']);
        $student->set_student_gender($results['student_gender']);
        $student->set_student_class(ClassModel::find_by_id($results['class_id']));

        return $student;
    }

    public static function update(StudentModel $student)
    {
        $db = new DB;
        $sql = "CALL UPDATE_STUDENT(?, ?, ?, ?)";
        $params = array(
            $student->get_student_name(), 
            $student->get_student_gender(),
            $student->get_student_class(),
            $student->get_student_id()
        );

        $db->run($sql, $params);
    }

    public static function destroy($id)
    {
        $db = new DB;
        $sql = "DELETE FROM " . self::TABLE . " WHERE student_id = ?";
        $params = array($id);
        $db->run($sql, $params);
    }
}