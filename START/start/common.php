<?php

use start\core\Config;
use start\core\Helper;
use start\core\Response;

/**
 * hàm hỗ trợ debug
 */
if (!function_exists("dd")) {
	function dd(...$list_variables)
	{

		echo "
		<h5 style='margin: 0px; color: red;'><u><b>LOG:</b></u></h5>
		<pre style='background:#000; color:#1df91d; padding:5px; margin: 2px 0px 25px 0px; font-size:12.99px;'>";

		foreach ($list_variables as $key => $variable) {
			print_r($variable);
		}

		echo "<br><p style='color:red;'>location:</p>";
		debug_print_backtrace();
		echo "</pre>";
	}
}


/**
 * hàm hỗ trợ load config
 */
if (!function_exists("config")) {
	function config($key, $default = null)
	{
		$config = new Config();
		return $config->get($key, $default);
	}
}


/**
 * hàm hỗ trợ load helper
 */
if (!function_exists("helper")) {
	function helper($key)
	{
		$helper = new helper();
		return $helper->load($key);
	}
}


/**
 * hàm hiển thị lỗi
 */
if (!function_exists("error")) {
	function error($name, $message = "Not Found")
	{
		require_once ERROR_PATH . "/{$name}.php";
		// dd();
		die();
	}
}


/**
 * hàm hỗ trợ load view
 */
if (!function_exists("view")) {
	function view($file, array $data = [])
	{
		return \start\core\View::render($file, $data);
	}
}


/**
 * hàm hỗ trợ load block
 */
if (!function_exists("block")) {
	function block($file, array $data = [])
	{
		return \start\core\View::load_block($file, $data);
	}
}


 // ham redirect
 if (!function_exists("redirect")) {
	 function redirect($uri) {
		$response = new Response();
		$response->redirect($uri);
		exit();
	 }
 }