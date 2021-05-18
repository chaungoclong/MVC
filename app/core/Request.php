<?php 
namespace app\core;

class Request {
	/**
	 * get url for index of routes
	 */
	public function getPathForRouter() {
		$path = $_SERVER["REQUEST_URI"];
		$start = strpos($path, "/", 1);
		$end = strpos($path, "?");
		
		if($end === false) {
			return substr($path, $start);
		}

		return substr($path, $start, $end - $start);
	}

	/**
	 * get url
	 */
	public function getUrl() {
		if (isset($_GET["url"])) {
			$url = trim($_GET["url"], "\/ ");
			$url = filter_var($url, FILTER_SANITIZE_URL);

			if ($url !== "") {
				return explode("/", $url);
			}
		}
	}

	/**
	 * get method
	 */
	public function getMethod() {
		return strtolower($_SERVER["REQUEST_METHOD"]);
	}

	/**
	 * is get
	 */
	public function isGet() {
		return $this->getMethod() == "get";
	}

	/**
	 * is post
	 */
	public function isPost() {
		return $this->getMethod() == "post";
	}

	/**
	 * get fields
	 */
	
	public function getFields() {
		$fields = [];

		if ($this->isGet()) {
			if (!empty($_GET)) {
				foreach ($_GET as $key => $value) {
					if (is_array($value)) {
						$fields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
					} else {
						$fields[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
					}
				}
			}
		}

		if ($this->isPost()) {
			if (!empty($_POST)) {
				foreach ($_POST as $key => $value) {
					if (is_array($value)) {
						$fields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
					} else {
						$fields[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
					}
				}
			}
		}

		return $fields;
	}
}