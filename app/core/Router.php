<?php 
namespace app\core;

class Router {
	public Request $request;
	public array   $routes = [];

	public function __construct(Request $request) {
		$this->request = $request;
	}

	/**
	 * [get description]
	 * @param  [type] $path     [description]
	 * @param  [type] $callBack [description]
	 * @return [type]           [description]
	 */
	public function get($path, $callBack) {
		$this->routes["get"][$path] = $callBack;
	}

	/**
	 * [post description]
	 * @param  [type] $path     [description]
	 * @param  [type] $callBack [description]
	 * @return [type]           [description]
	 */
	public function post($path, $callBack) {
		$this->routes["post"][$path] = $callBack;
	}

	/**
	 * [resolve 
	 * + get controller, action -> bind param for action
	 * + handle Exception and Error
	 * ]
	 * @return [type] [description]
	 */
	public function resolve() {
		$url      = $this->request->getPathForRouter();
		// echo $url;
		
		$param    = $this->getParam($url);
		
		$path     = $this->matchRouter($url);
		// echo $path;
		
		$method   = $this->request->getMethod();
		

		if (isset($this->routes[$method][$path])) {
			$callBack = $this->routes[$method][$path];

			// if call back is string then get controller and action from callback
			if (is_string($callBack) && 
				// check format Abc@Def
				preg_match("/^[a-zA-Z._]+\@[a-zA-Z_]+$/", $callBack, $x)
			) {
				$callBackArray = $this->extractCallBack($callBack);

				if (!class_exists($callBackArray[0])) {
					die("not found class");
				}

				$controller = new $callBackArray[0]();
				$callBackArray[0] = $controller;

				if (!method_exists($controller, $callBackArray[1])) {
					die("not found method");
				}

				$callBack = $callBackArray;
			}

			return call_user_func_array($callBack, $param);
		}

		die("not found page");
	}	

	/*
	 * [get classname and action (classname had namespace)]
	 * @param  [type] $callBack [description]
	 * @return [type]           [description]
	 */
	public function extractCallBack($callBack) {
		$nameSpace = App::$app->config["config"]["controller_namespace"];

		$callBack  = explode("@", $callBack);
		
		// class name
		$name      = $callBack[0];
		$name      = str_replace(".", "\\", $name);
		$className = $nameSpace . $name;
		
		// action
		$action    = str_replace("-", "_", $callBack[1]);
		
		return [$className, $action];
	}

	/**
	 * [matchRouter get callback from routes if its index equals url on browser]
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public function matchRouter($url) {
		$method = $this->request->getMethod();
		foreach ($this->routes[$method] as $path => $callBack) {
			if (preg_match('~^' .$path. '$~is', $url, $c)) {
				return $path;
			}
		}
	}

	/**
	 * [getParam get param from url on URL]
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public function getParam($url) {
		$pattern = "~-[\w\d]+~";
		preg_match_all($pattern, $url, $matches);

		$param = $matches[0];

		foreach ($param as $key => $value) {
			$param[$key] = ltrim($value, "-");
		}

		return $param;
	}
}