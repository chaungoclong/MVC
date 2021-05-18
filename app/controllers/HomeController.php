<?php 
namespace app\controllers;

use app\core\Controller;

class HomeController extends Controller {
	public function index() {
		$homeModel = $this->model("home");
		
		$data = $homeModel->index();
		
		$this->view("home.index", ["data"=>$data]);
	}

	public function register() {
		$homeModel = $this->model("home");
		$this->view("home.register");
	}

	public function handle_register() {
		$request = new \app\core\Request();
		echo $request->getMethod();
		var_dump($request->getFields());
	}
}