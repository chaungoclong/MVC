<?php 

namespace start\core;

class Registry
{
	private static $list_items = [];
	private static Registry $instance;

	private function __construct()
	{

	}

	public static function instance()
	{
		if (! isset(self::$instance)) {
			self::$instance = new Registry();
		}

		return self::$instance;
	}

	public function __set($key, $value)
	{
		self::$list_items[$key] = $value;
	}

	public function __get($key)
	{
		return isset(self::$list_items[$key]) ? self::$list_items[$key] : null;
	}
}