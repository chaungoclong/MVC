<?php 
namespace app\core;

class Loader {
	public function loadAllConfig() {
		$allConfig = [];

		$listFileName = glob(APP_PATH . "/config/*.php");
		
		foreach ($listFileName as $key => $filePath) {
			$pathArray = explode("/", $filePath);
			$fileName = end($pathArray);
			$index = str_replace(".php", "", $fileName);

			$tmp = include $filePath;

			if (is_array($tmp)) {
				$allConfig[$index] = $tmp;
			}
		}

		return $allConfig;
	}

	public function loadConfig($fileName) {
		$config = [];

		if (file_exists(APP_PATH . "/config/" . $fileName . ".php")) {
			$tmp = include APP_PATH . "/config/" . $fileName . ".php";
			$config = is_array($tmp) ? $tmp : [];
		}
		
		return $config;
	} 
}