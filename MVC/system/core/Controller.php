<?php
namespace system\core;

class Controller
{
	public static function index()
	{
		echo "<form action='/MVC/ok' method='post'>
		<button>submit</button>
		</form>";
	}
}