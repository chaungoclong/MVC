<?php 
namespace system\core;

class Registry
{
	private static Registry $instance;
	private static $list_variables;

	private function __construct()
	{

	}

	public static function get_instance()
	{
		if(!isset(self::$instance))
		{
			self::$instance = new Registry();
		}
		return self::$instance;
	}

	public function __get($name)
	{
		return self::$list_variables[$name] ?? null;
	}

	public function __set($name, $value)
	{
		self::$list_variables[$name] = $value;
	}

	public function show()
	{
		var_dump(self::$list_variables);
	}

}