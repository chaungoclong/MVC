<?php

namespace app\controllers;

use start\core\Controller;
use app\models\ClassModel;

class ClassController extends Controller
{
    public function index()
    {
        $list_class = ClassModel::all();
        $data = ["list_class"=> $list_class];
        return view("classes.index", $data);
    }

    public function create()
    {
        return view("classes.create");
    }

    public function store()
    {
        $input = $this->request->post();
        $class = new ClassModel;
        $class->set_class_name($input['class_name']);
        ClassModel::store($class);
        $this->redirect("class/list");
    }

    public function edit($id)
    {
       $class = ClassModel::find_by_id($id);
       $data = array("class" => $class);
       return view("classes.edit", $data);
    }

    public function update()
    {
        $input = $this->request->post();
        $class = new ClassModel;
        $class->set_class_id($input['class_id']);
        $class->set_class_name($input['class_name']);
        ClassModel::update($class);
        $this->redirect("class/list");
    }

    public function destroy($id)
    {
        ClassModel::destroy($id);
        $this->redirect("class/list");
    }
}