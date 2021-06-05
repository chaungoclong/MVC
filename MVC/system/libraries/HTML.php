<?php 
namespace system\libraries;

class HTML
{
	public static function open_form($action = "", $method = "get")
	{
		echo ("<form action=\"{$action}\" method=\"{$method}\">");
	}

	public static function close_form()
	{
		echo "</form>";
	}

	public static function input($type = "text", $name = "", $class = "",
		$id = "", $before = "", $after = "")
	{
		echo 
		("
			{$before}
				<input type=\"{$type}\" name=\"{$name}\" class=\"{$class}\"
				id=\"{$id}\"/>
			{$after} 
		");
	}
}