<?php 
namespace app\core;


class Router extends Request {
	public function __construct() {
		parent::__construct();
	}

	public function resolve() {
		// log_data($this->controller, $this->action, $this->param);
		$controller_path     = CONF["init"]["controller_path"] . $this->controller;
		
		// check param of method 
		// if number of input param !== number of 
		$reflection          = new \ReflectionMethod($controller_path, $this->action);
		$param_of_method     = count($reflection->getParameters());
		
		if ($param_of_method !== count($this->param)) {
		$this->controler     = $this->format_controller(CONF["init"]["error_controller"]);
		$controller_path     = CONF["init"]["controller_path"] . $this->controller;
		$this->action        = $this->format_action(CONF["init"]["error_action"]);
		}
		
		$this->controller    = new $controller_path();
		call_user_func_array([$this->controller, $this->action], $this->param);
	}
}