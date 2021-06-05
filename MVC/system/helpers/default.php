<?php 
/**
 * show content for debug
 */
use system\core\Helper;
use system\core\Config;

if(! function_exists("dd"))
{
	function dd(...$list_variables)
	{

		echo "
		<h5 style='margin: 0px; color: red;'><u><b>LOG:</b></u></h5>
		<pre style='background:#000; color:#1df91d; padding:5px; margin: 2px 0px 25px 0px; font-size:12.99px;'>";

		foreach ($list_variables as $key => $variable) 
		{
			print_r($variable);
		}
		
		echo "<br><p style='color:red;'>location:</p>";
		debug_print_backtrace();
		echo "</pre>";
	}
}


/**
 * get config
 */
if(! function_exists("config"))
{
	function config($key, $default = null)
	{
		static $settings = [];

		if (! array_keys_exist($settings, $key)) {
			$segment     = explode(".", trim($key, ". "));
			$file_config = reset($segment) . ".php";
			$file_path   = CONFIG_PATH . "/{$file_config}";

			$data_config = include $file_path;
			if(is_array($data_config)) {
				setArray($settings, reset($segment), $data_config);
			}
		}

		return array_keys_exist($settings, $key) ? 
		getArrayValue($settings, $key) : null;
	}
}


if (! function_exists("conf")) 
{
	function conf($key, $default = "") {
		$config = new Config();
		return $config->get($key, $default);
	}
}



/**
 * load helper
 */
if(! function_exists("helper"))
{
	function helper(...$helper_names)
	{
		$helper = new Helper();
		return $helper->load(...$helper_names);
	}
}