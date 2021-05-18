<?php 
namespace app\controllers;
use app\core\BaseController;

class CategoryController extends BaseController {
	public function indexAction() {
		$categoryModel = $this->model("category");
		$data 		   = $categoryModel->getAll();
		$this->view("category.index", $data);
	}
}