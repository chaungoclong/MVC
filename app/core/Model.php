<?php 
namespace app\core;

class Model {
	public function load($name) {
		$nameSpace = App::$app->config["config"]["model_namespace"];
		$classModel = $nameSpace . ucfirst($name) . "Model";
		echo $classModel . "<br>";

		if (class_exists($classModel)) {
			return new $classModel();
		}
		echo("not found");
	}

}