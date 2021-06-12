<?php 

namespace start\core;

class Controller
{
	protected $layout;

	public function __construct()
	{
		$this->layout = Registry::instance()->layout;
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
}