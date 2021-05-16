<?php  
namespace app\core;

class App {
	public static App $app;
	public Router $router;
	public $APP_PATH;

	public function __construct($APP_PATH) {
		self::$app = $this;
		$this->APP_PATH = $APP_PATH;
		$this->router = new Router();
	}

	public function run() {
		$this->router->resolve();
	}
}