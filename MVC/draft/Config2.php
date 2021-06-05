<?php 
namespace system\core;

class Config
{
	/***************************************************************************
	 * get config in all case
	 * @param  [mixed String] $config_names [description]
	 * @return [array || null] [an array of config of null]
	 **************************************************************************/
	public function get(...$config_names)
	{
		$result       = null;
		$config_names = $this->filter_config_name($config_names);
		$count        = count($config_names);

		foreach ($config_names as $config_name)
		{
			if($count === 1)
			{
				$result = self::one($config_name);
			}
			else
			{
				$result[$config_name] = self::one($config_name);
			}
		}

		return $result;
	}


	/***************************************************************************
	 * get one config by name
	 * @param  [string] $config_name [name of config]
	 * @return [array || null]     	 [an array of config of null]
	 **************************************************************************/
	public function one($config_name)
	{
		$path = CONFIG_PATH . "/{$config_name}.php";

		if(is_file($path) && file_exists($path))
		{
			$rs = include $path;
			return is_array($rs) ? $rs : null;
		}
	}


	/***************************************************************************
	 * filter list of config's name
	 * @return [array] [list of config's name]
	 **************************************************************************/
	private function filter_config_name($config_names)
	{
		$result = [];
		$count = count($config_names);

		if($count === 0)
		{
			$file_names = array_diff(scandir(CONFIG_PATH), [".", ".."]);

			foreach ($file_names as $key => $file_name) 
			{
				if(is_file(CONFIG_PATH . "/{$file_name}"))
				{
					$result[] = str_replace(".php", "", $file_name);
				}
			}
		}
		else
		{
			foreach ($config_names as $key => $config_name) 
			{
				$config_name = trim($config_name);
				if(is_file(CONFIG_PATH . "/{$config_name}.php"))
				{
					$result[] = $config_name;
				}
			}
		}

		return $result;
	}
}