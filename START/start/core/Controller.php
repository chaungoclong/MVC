<?php 

namespace start\core;

class Controller
{
	protected $layout;
	protected $request;
	protected $response;

	public function __construct()
	{
		$this->layout = Registry::instance()->layout;
		$this->request = new Request();
		$this->response = new Response();
	}

	public function view($name, array $data = [])
	{
		return View::render($name, $data);
	}

	public function model($name)
	{
		
	}

	public function set_layout($layout)
	{
		$this->layout = $layout;
	}

	public function get_layout()
	{
		return $this->layout;
	}

	public function get_name()
	{
		return get_class($this);
	}

	public function redirect($uri)
	{
		$this->response->redirect($uri);
		exit();
	}
}