<?php

namespace app\models;

use start\database\DB;

class ClassModel
{
    const TABLE = "classroom";
    private $class_id;
    private $class_name;

    public function __construct()
    {

    }

    public static function all()
    {
        $db = new DB;
        $output = [];
        $list_class = $db->get("select * from " . self::TABLE);
        foreach ($list_class as $each) {
            $class = new ClassModel;
            $class->set_class_id($each['class_id']);
            $class->set_class_name($each['class_name']);
            $output[] = $class;
        }

        return $output;
    }

    public static function find_by_id($id)
    {
        $db = new DB;
        $sql = "SELECT * FROM " . self::TABLE . " WHERE class_id = ?";
        $params = array($id);
        $result = $db->first($sql, $params);
        if (empty($result)) {
            return false;
        }

        $class = new ClassModel;
        $class->set_class_id($result['class_id']);
        $class->set_class_name($result['class_name']);
        return $class;
    }

    public static function store(ClassModel $class)
    {
        $db = new DB;
        $sql = "INSERT INTO " . self::TABLE . " (class_name)" . "VALUES (?)";
        $params = [$class->get_class_name()];
        $db->run($sql, $params);
    }

    public static function update(ClassModel $class)
    {
        $db = new DB;
        $sql = "UPDATE " . self::TABLE . " SET " . "class_name = ? WHERE class_id = ?";
        echo $sql;
        $params = array($class->get_class_name(), $class->get_class_id());
        $db->run($sql, $params);
    }

    public static function destroy($id)
    {
        $db = new DB;
        $sql = "CALL DELETE_CLASSROOM(?)";
        $params = array($id);
        $db->run($sql, $params);
    }

    public function get_class_id()
    {
        return $this->class_id;
    }

    public function set_class_id($id)
    {
        $this->class_id = $id;
    }

    public function get_class_name()
    {
        return $this->class_name;
    }

    public function set_class_name($name)
    {
        $this->class_name = $name;
    }

}
