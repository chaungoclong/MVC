<?php 
namespace system\core;

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

	}


	/**
	 * get param by POST method
	 */
	public function post()
	{

	}


	/**
	 * get param by POST or GET method
	 */
	public function any()
	{

	}
}