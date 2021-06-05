<?php 
namespace system\core;

class Config
{
	private static $settings = [];


	/***************************************************************************
	 * [__construct description]
	 **************************************************************************/
	public function __construct(array $settings = [])
	{
		self::$settings = $settings;
	}


	/***************************************************************************
	 * [__get description]
	 * get config in level 1
	 **************************************************************************/
	public function __get($key) {
		return $this->get($key);
	}


	/***************************************************************************
	 * [get description]
	 * get config in all level
	 **************************************************************************/
	public function get($key, $default = "ok")
	{
		$segment   = explode(".", trim($key, ". "));
		$file_name = reset($segment);

		// if not found load file containing configuration
		if (! $this->has($key)) {
			$this->load($file_name);
		}

		return $this->has($key) ? getArrayValue(self::$settings, $key) :
		$default;
	}
	

	/***************************************************************************
	 * [__set description]
	 **************************************************************************/
	public function __set($key, $value)
	{
		return $this->set($key, $value);
	}


	/***************************************************************************
	 * [set description]
	 **************************************************************************/
	public function set($key, $value)
	{
		setArray(self::$settings, $key, $value);
	}


	/**
	 * [all description]
	 * @return [array] [description]
	 */
	public function all()
	{
		$file_names = $this->getAllConfigName();
		foreach ($file_names as $file_name) {
			$this->load($file_name);
		}
		return self::$settings;
	}


	/***************************************************************************
	 * [load description] load data from file config
	 **************************************************************************/
	public function load($file_name)
	{
		$file_path = CONFIG_PATH . "/{$file_name}.php";
		if (is_file($file_path)) {
			$value = include $file_path;
			if (is_array($value)) {
				self::$settings[$file_name] = $value;
			}
		}
		return $this;
	}


	/***************************************************************************
	 * [has description] check if it has config[$key]
	 **************************************************************************/
	public function has($key)
	{
		return array_keys_exist(self::$settings, $key);
	}


	/***************************************************************************
	 * [getAllConfigName description] get all config name(file name after remove .php) in folder config
	 **************************************************************************/
	public function getAllConfigName()
	{
		$configFiles = array_diff(scandir(CONFIG_PATH), [".", ".."]);
		$configNames = [];
		foreach ($configFiles as $key => $configFile) {
			$path = CONFIG_PATH . "/{$configFile}";
			if(is_file($path)) {
				$configNames[] = str_replace(".php", "", $configFile);
			}
		}
		return $configNames;
	}

	public function show()
	{
		dd(self::$settings);
	}
}