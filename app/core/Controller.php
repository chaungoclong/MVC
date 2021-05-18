<?php 
namespace app\core;

abstract class Controller {
	public function view($path, $param = []) {
		App::$app->view->render($path, $param);
	}

	public function model($name) {
		return App::$app->model->load($name);
	}
}