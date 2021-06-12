<?php 

namespace start\core;

class App
{
	private Request $request;
	private Route $routes;

	public function __construct()
	{
		$this->request = new Request();
		$this->routes  = new Route($this->request);
		Registry::instance()->layout = config("app.default_layout");
	}

	public function start()
	{
		$this->routes->run();
	}
}