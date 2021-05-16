<?php 
namespace app\controllers;

use app\core\Controller;

class HomeController extends Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		echo "<br>this is index page";
	}

	public function _404() {
		echo "<br>not found";
	}
}
