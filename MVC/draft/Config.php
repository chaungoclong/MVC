<?php 

namespace system\core;

class Config 
{
	private static $config = [];

	// public function __construct()
	// {
	// 	self::load();
	// }

	/**
	 * load config to array config
	 * @param  string $config_name [description]
	 * @return [type]              [description]
	 */
	private static function load(...$config_names)
	{
		// add all config
		if(count($config_names) === 0)
		{
			$list_config_path = glob(CONFIG_PATH . "/*.php");
			foreach ($list_config_path as $key => $config_path) 
			{
				$config_name = self::get_config_name_from_path($config_path);
				self::add_config($config_name, $config_path);
			}
		}

		// add one or more config
		if(count($config_names) >= 1)
		{
			foreach ($config_names as $key => $config_name) 
			{
				self::add_config($config_name);
			}
		}
	}


	/**
	 * get config
	 * @param  [type] $config_name [description]
	 * @return [type]              [description]
	 */
	public static function get(...$config_names) 
	{
		// get all configs
		if(count($config_names) === 0)
		{
			self::load();
			return self::$config;
		}
		
		// get one configs
		if(count($config_names) === 1)
		{
			self::load($config_names[0]);
			return self::$config[$config_names[0]] ?? [];
		}

		// get some configs
		if(count($config_names) > 1)
		{
			self::load(...$config_names);
			$result = [];
			foreach ($config_names as $key => $config_name) 
			{
				if(isset(self::$config[$config_name]))
				{
					$result[$config_name] = self::$config[$config_name];
				}
			}
			return $result;
		}
	}



	/**
	 * get config name from config path
	 */
	
	private static function get_config_name_from_path($config_path)
	{
		$config_path_split = explode("/", $config_path);
		$config_file       = end($config_path_split);
		$config_name       = str_replace(".php", "", $config_file);
		return $config_name;
	}


	/**
	 * add config to array config
	 * if it already exist, don't add it again
	 */
	private static function add_config($config_name, $config_path = "")
	{
		if($config_path === "")
		{
			$config_path = CONFIG_PATH . "/{$config_name}.php";
		}

		if(file_exists($config_path))
		{
			if(!isset(self::$config[$config_name]))
			{
				$tmp = include_once $config_path;
				if(is_array($tmp))
				{
					self::$config[$config_name] = $tmp;
				}
				else
				{
					self::$config[$config_name] = null;
				}
			}
			return true;
		}
		return false;
	}
}