<?php 
namespace system\core;

class App
{
	public static Config $config;
	public static Helper $helper;
	public static Route $route;
	public static Request $request;
	
	public static function run()
	{
		self::init();
		self::dispatch();
	}

	private static function init()
	{
		self::$helper  = new Helper();
		self::$config  = new Config();
		self::$request = new Request();
		self::$route   = new route(self::$request);
	}

	// private static load()
	// {
	// 	self::$config->load("app");
	// }

	private static function dispatch()
	{
		self::$route->run();
	}
}