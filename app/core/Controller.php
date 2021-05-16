<?php 
namespace app\core;

abstract class Controller {
	public function __construct() {
		echo "this is base controller";
	}
}