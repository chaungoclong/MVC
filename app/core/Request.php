<?php 
namespace app\core;

class Request {
	public $url;
	public $controller;
	public $action;
	public $param;

	public function __construct() {
		$this->url = $this->get_url();
		$this->set_controller();
		$this->set_action();
		$this->set_param();
	}

	/**
	 * [get_url description]
	 * @return [array | NULL] [description]
	 */
	public function get_url() {
		if (isset($_GET["url"])) {
			$url = filter_var(trim($_GET["url"], "\/ "), FILTER_SANITIZE_URL);
			if ($url !== "") { return explode("/", $url); }
		}
	}


	public function set_controller() {
		if (isset($this->url[0])) {
			$controller = $this->format_controller(array_shift($this->url));

			if (
				file_exists(APP_PATH . "/controllers/" . $controller . ".php") && 
				class_exists(CONF["init"]["controller_path"] . $controller)
			) {
				$this->controller = $controller;
			} else {
				$this->controller = $this->format_controller(CONF["init"]["error_controller"]);
			}

		} else {
			$this->controller = $this->format_controller(CONF["init"]["default_controller"]);
		}
	}



	public function set_action() {
		if(isset($this->url[0])) {
			$action = $this->format_action(array_shift($this->url));

			$controller_class = CONF["init"]["controller_path"] . $this->controller;

			if (method_exists($controller_class, $action)) {
				$this->action = $action;
			} else {
				$this->action = $this->format_action(CONF["init"]["error_action"]);
			}
			
		} else {
			$this->action = $this->format_action(CONF["init"]["default_action"]);
		}
	}


	public function set_param() {
		$this->param = $this->url ?? [];
		echo count($this->param);
	}


	public function format_controller($controller_name) {
		return ucfirst($controller_name) . "Controller";
	}



	public function format_action($action_name) {
		return strtolower(str_replace("-", "_", $action_name));
	}

}