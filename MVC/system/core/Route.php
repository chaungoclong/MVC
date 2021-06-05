<?php 
namespace system\core;

class Route
{
	private static $routes = [];
	private Request $request;
	private $param = [];
	private $callback;
	private $url;


	/***************************************************************************
	 * Khởi tạo route và url
	 * @param Request $request [request đi vào route]
	 **************************************************************************/
	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->url 	   = $this->request->get_url();
	}

	/***************************************************************************
	 * Thêm router với phương thức get: router này sẽ được thực thi nếu đường 
	 * dẫn trên url khớp với đường dẫn quy định và REQUEST_METHOD = GET
	 * @param  [string] $path     [Đường dẫn quy định]
	 * @param  [string, function] $callback [công việc sẽ làm khi đi đến đường * dẫn quy định (gọi một controller thực thi 1 action || thực thi một *function)]
	 **************************************************************************/
	public static function get($path, $callback)
	{
		self::addRoute("get", $path, $callback);
	}


	/***************************************************************************
	 *  Thêm router với phương thức post router này sẽ được thực thi nếu đường 
	 * dẫn trên url khớp với đường dẫn quy định và REQUEST_METHOD = POST
	 *  (tương tự get)
	 **************************************************************************/
	public static function post($path, $callback)
	{
		self::addRoute("post", $path, $callback);
	}


	/***************************************************************************
	 * Thêm router vào danh sách router
	 * @param [string] $method   [REQUEST_METHOD]
	 * @param [string] $path     [đường dẫn quy định]
	 * @param [string || function] $callback [callback]
	 * B1: format lại đường dẫn quy định : abc/xyz/{param}
	 * B2: chuyển đường dẫn quy định thành biểu thức chính quy để so khớp với 
	 * đường dẫn lấy từ thanh địa chỉ bằng hàm preg_replace
	 * # các bước đường dẫn quy định về biểu thức chính quy:
	 *   1, chuyển các dấu / thành \/.
	 *   2, với các phần thể hiện cho param có dạng {param} -> chuyển thành 
	 *   (?P<param>[\w]+). ?P<param> dùng để đặt tên cho nhóm -> khi sử dụng 
	 *   hàm so khớp (preg_match, preg_match_all) nếu nhóm khớp ta sẽ được giá
	 *   trị so khớp và tên của param -> lấy được param của action hoặc 
	 *   function.
	 *   ?P<param> : nhóm sẽ được dặt tên là param. Để lấy được tên của param 
	 *   từ đường dẫn quy định , ta sử dụng back references trong chuỗi thay 
	 *   thế trong hàm preg_replace: {param} => (?P<$1>[\w]+) = nhóm có tên là 
	 *   param với các kí tự chữ số và _
	 *   khi hàm preg_replace chạy nó sẽ so khớp chuỗi được tìm kiếm để thay thế
	 *   (Regex) trên chuỗi được thay thế , từ đó có được các nhóm trùng khớp, 
	 *   sử dụng back references để lấy giá trị các nhóm này theo đúng thứ tự
	 *  B3: thêm router vào danh sách router với định dạng [method, path, 
	 *  callback]
	 **************************************************************************/
	public static function addRoute($method, $path, $callback)
	{
		$path = trim($path);
		$path = preg_replace("/\//", "\\\/", $path);
		$path = preg_replace("/\{([\w]+)\}/", "(?P<$1>[\w]+)", $path);
		$path = preg_replace("/\{([\w]+):([^\}]+)\}/", "(?P<$1>$2)", $path);
		$path = "/^" . $path . "$/i";
		$method = strtolower(trim($method));
		self::$routes[] = [$method, $path, $callback];
	}


	/***************************************************************************
	 * so khớp đường dẫn trên thanh địa chỉ với đường dẫn của các router, nếu đường dẫn của một router khớp với đường dẫn trên thanh địa chỉ thì lấy callback và param của router đó và set cho param và callback của router
	 * @param  [string] $url [url]
	 * @return [boolean]      [true nếu có router khớp , ngược lại fasle]
	 **************************************************************************/
	private function match($url)
	{
		$request_method = $this->request->get_method();
		foreach (self::$routes as $route) {
			list($method, $path, $callback) = $route;
			if ($method === $request_method) {
				if (preg_match($path, $url, $matches)) {
					$param = array_slice(array_unique($matches), 1);
					$this->param    = $param;
					$this->callback = $callback; 
					return true;
				}
			} else {
				continue;
			}
		}

		return false;
	}


	/***************************************************************************
	 * kiểm tra và phân tích callback.
	 * nếu callback tồn tại (!== null) trả về 1 mảng gồm 2 phần tử 
	 * [kiểu của callback, $callback]
	 * nếu callback là string thì tách controller và action từ chuỗi callback
	 * nếu callback là function thì callback là function
	 * nếu callback không tồn tại trả về false
	 * @return [array || false] [description]
	 **************************************************************************/
	public function getCallback()
	{
		$output = [];

		if (is_null($this->callback)) {
			dd(1);
			return false;
		}

		// callback is string
		if (is_string($this->callback)) {
			// check format
			if (preg_match("/^[\w]+\@[\w]+$/", $this->callback)) {
				$segment    = explode("@", $this->callback);
				$controller = strCamel($segment[0]);
				$action     = strCamel($segment[1], 0);
				
				// check controller && action exists
				$class_path = CONTROLLER_PATH . "/{$controller}.php";
				$class_name = conf("app.ctrl_namespace") . $controller;
				
				if (is_file($class_path) && class_exists($class_name) &&
					method_exists($class_name, $action)) {
					$output = [
						"type" => "object",
						"data" => [$class_name, $action]
					];
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		// callback is callable
		if (is_callable($this->callback)) {
			$output = [
				"type" => "function",
				"data" => $this->callback
			];
		}
		
		return $output;
	}


	/***************************************************************************
	 * có router khớp -> get callback -> thực thi callback
	 * ngược lại báo lỗi
	 * @return [type] [description]
	 **************************************************************************/
	public function dispatch()
	{
		// dd($this->url);
		if ($this->match($this->url)) {
			if ($this->getCallback() !== false) {
				$callback = $this->getCallback();

				if ($callback['type'] === "object") {
					$controller = $callback['data'][0];
					$action = $callback['data'][1];
					call_user_func_array([$controller, $action], $this->param);
				} else {
					$function = $callback['data'];
					call_user_func_array($function, $this->param);
				}
			} else {
				throw new \Exception("not found callback");
			}
		} else {
			throw new \Exception("not found page");
		}
	}


	/***************************************************************************
	 * hàm chạy router
	 * @return [type] [description]
	 **************************************************************************/
	public function run()
	{
		$this->dispatch();
	}
}