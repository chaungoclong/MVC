<?php 
namespace app\core;

class View {
	public $BasePath = APP_PATH . "/views/";
	public function render($path, $param = []) {
		$path = str_replace(".", "/", $path);
		$path = $this->BasePath . $path . ".php";
		
		if(file_exists($path)) {
			// one element in array -> new variable has name is its index in array
			extract($param);

			// start save all output
			ob_start();
			require_once $path;

			// save all output into $content then clean buffer
			$content = ob_get_clean();

			// now we has variable $content, main.php will use it;
			require_once $this->BasePath . "/layout/main.php";
		} else {
			die("not found");
		}
	}
}