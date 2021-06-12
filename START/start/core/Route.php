<?php
namespace start\core;

class Route {
    private static $routes = [];
    private Request $request;
    private $param = [];
    private $callback;
    private $url;

    /***************************************************************************
     * Khởi tạo route và url
     * @param Request $request [request đi vào route]
     **************************************************************************/
    public function __construct(Request $request) {
        $this->request = $request;
        $this->url = $this
            ->request
            ->get_url();
    }

    /***************************************************************************
     * Thêm router với phương thức get: router này sẽ được thực thi nếu đường
     * dẫn trên url khớp với đường dẫn quy định và REQUEST_METHOD = GET
     * @param  [string] $path     [Đường dẫn quy định]
     * @param  [string, function] $callback [công việc sẽ làm khi đi đến đường * dẫn quy định (gọi một controller thực thi 1 action || thực thi một *function)]
     **************************************************************************/
    public static function get($path, $callback) {
        self::addRoute("get", $path, $callback);
    }

    /***************************************************************************
     *  Thêm router với phương thức post router này sẽ được thực thi nếu đường
     * dẫn trên url khớp với đường dẫn quy định và REQUEST_METHOD = POST
     *  (tương tự get)
     **************************************************************************/
    public static function post($path, $callback) {
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
    public static function addRoute($method, $path, $callback) {
        $path = trim($path);
        $path = preg_replace("/\//", "\\\/", $path);
        $path = preg_replace("/\{([\w]+)\}/", "(?P<$1>[\w]+)", $path);
        $path = preg_replace("/\{([\w]+):([^\}]+)\}/", "(?P<$1>$2)", $path);
        $path = "/^" . $path . "$/i";
        $method = strtolower(trim($method));
        self::$routes[] = [$method, $path, $callback];
    }

    /***************************************************************************
     * so khớp đường dẫn trên thanh địa chỉ với đường dẫn của các router, nếu 
     * đường dẫn của một router khớp với đường dẫn trên thanh địa chỉ thì lấy 
     * callback và param của router đó và set cho param và callback của router
     * @param  [string] $url [url]
     * @return [boolean]      [true nếu có router khớp , ngược lại fasle]
     **************************************************************************/
    private function match($url) {
        $request_method = $this
            ->request
            ->get_method();
        foreach (self::$routes as $route) {
            list($method, $path, $callback) = $route;
            if ($method === $request_method) {
                if (preg_match($path, $url, $matches)) {
                    $param = array_slice(array_unique($matches) , 1);
                    $this->param = $param;
                    $this->callback = $callback;
                    return true;
                }
            }
            else {
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
    public function getCallback() {
        $output = [];

        if (is_null($this->callback)) {
            dd(1);
            return false;
        }

        // callback is string
        if (is_string($this->callback)) {
            // check format
            $pattern = "/^(?P<controller>[\w][\w\.]+[\w])\@(?P<action>[\w]+)$/";
            if (preg_match($pattern, $this->callback, $matches)) {
                $segment    = $this->controller_info($matches["controller"]);
                $class_name = $segment["class_full_name"];
                $class_path = $segment["class_path"];
                $action     = strCamel($matches["action"], 0);

                // check controller && action exists
                if (is_file($class_path) && class_exists($class_name) && method_exists($class_name, $action)) {
                    $output = [
                        "type" => "object",
                        "data" => [$class_name, $action]
                    ];
                }
                else {
                    dd($segment);
                    dd("here");
                    return false;
                }
            }
            else {
                return false;
            }
        }

        // callback is callable
        if (is_callable($this->callback)) {
            $output = ["type" => "function", "data" => $this->callback];
        }

        return $output;
    }

    /***************************************************************************
     * có router khớp -> get callback -> thực thi callback
     * ngược lại báo lỗi
     * @return [type] [description]
     **************************************************************************/
    public function dispatch() {
        // dd($this->url);
        if ($this->match($this->url)) {
            if ($this->getCallback() !== false) {
                $callback = $this->getCallback();

                if ($callback['type'] === "object") {
                    // lấy tên đầy đủ của class controller
                    $controller        = $callback['data'][0];

                    // tạo controller 
                    $controller_object = new $controller();

                    Registry::instance()->current_controlller = 
                    $controller_object;

                    // lấy action
                    $action = $callback['data'][1];

                    // thực thi action của controller 
                    call_user_func_array(
                        [$controller_object, $action], $this->param
                    );
                }
                else {
                    $function = $callback['data'];
                    call_user_func_array($function, $this->param);
                }
            }
            else {
                error("404");
            }
        }
        else {
            error("404");
        }
    }

    /**
     * [tạo tên class đầy đủ và đường dẫn đầy đủ từ phần khớp với controller 
     * trên callback]
     * @param  [type] $full_class_name [description]
     * @return [type]                  [description]
     */
    public function controller_info($controller_string) {
        // mảng chứa các thành phần của tên class phân tách bởi dấu '.'
        $segment = explode(".", $controller_string);
        $segment = array_filter($segment, fn($v) => !is_null($v) && $v !== '');

        $last_index           = array_key_last($segment);
        $segment[$last_index] = strCamel($segment[$last_index]);

        // tao class name (namespace + class name)
        $namespace  = config("app.ctrl_namespace");
        $class_name = $segment[$last_index];
        $class_full_name = $namespace . implode("\\", $segment);

        // tao class path (duong dan den class)
        $length     = count($segment);
        $class_path = implode("/", array_slice($segment, 0, $length - 1));
        if ($class_path !== "") {
            $class_path = CONTROLLER_PATH . "/{$class_path}/" . $class_name
            . ".php";
        } else {
             $class_path = CONTROLLER_PATH . "/" . $class_name . ".php";
        }

        $output = [
            "class_path"      => $class_path,
            "class_full_name" => $class_full_name
        ];

        return $output;
    }


    /***************************************************************************
     * hàm chạy router
     * @return [type] [description]
     **************************************************************************/
    public function run() {
        $this->dispatch();
    }
}

