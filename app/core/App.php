<?php 
namespace app\core;

class App {
	public static App $app;
	public array $config;
	public Router $router;
	public Request $request;
	public Loader $loader;
	public Model $model;
	public View $view;

	public function __construct() {
		$this->loader  = new Loader();
		$this->config  = $this->loader->loadAllConfig();
		$this->request = new Request();
		$this->view    = new View();
		$this->router  = new Router($this->request);
		$this->model   = new Model();
		self::$app     = $this;
		require_once APP_PATH . "/router/web.php";
	}

	public function run() {
		$this->router->resolve();
	}
}
