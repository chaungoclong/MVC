<?php 
namespace start\core;

class Request
{
	/**
	 * get url for router
	 */
	public function get_url()
	{
		$url = $_SERVER['PATH_INFO'] ?? "/";
		return filter_var($url, FILTER_SANITIZE_URL);
	}

	/**
	 * get method of request
	 */
	public function get_method()
	{
		return strtolower($_SERVER['REQUEST_METHOD']);
	}


	/**
	 * check request method is GET
	 */
	public function is_get()
	{
		return $this->get_method() === "get";
	}


	/**
	 * check request method is POST
	 */
	public function is_post()
	{
		return $this->get_method() === "post";
	}


	/**
	 * get param by GET method
	 */
	public function get()
	{
		$data   = [];
		$option = [FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY];

		if (! $this->is_get() || empty($_GET)) {
			return $data;
		}

		foreach ($_GET as $key => $value) {
			if (is_array($value)) {
				$data[$key] = filter_input(INPUT_GET, $key, ...$option);
			} else {
				$data[$key] = filter_input(INPUT_GET, $key, $option[0]);
			}
		}
		return $data;
	}


	/**
	 * get param by POST method
	 */
	public function post()
	{
		$data   = [];
		$option = [FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY];

		if (! $this->is_post() || empty($_POST)) {
			return $data;
		}

		foreach ($_POST as $key => $value) {
			if (is_array($value)) {
				$data[$key] = filter_input(INPUT_POST, $key, ...$option);
			} else {
				$data[$key] = filter_input(INPUT_POST, $key, $option[0]);
			}
		}
		return $data;
	}


	/**
	 * get param by POST or GET method
	 */
	public function any()
	{
		if ($this->is_get()) {
			return $this->get();
		}

		return $this->post();
	}
}