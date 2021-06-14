<?php 

/**
 * PATH
 */

// root path
define("ROOT_PATH", __DIR__);


// web path
define(
	"WEB_PATH", 
	isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === "on" ? "https://" : "http://" 
	. $_SERVER['HTTP_HOST'] 
	. substr(
		$_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "/", 1)
	)
);


// app path
define("APP_PATH", ROOT_PATH . "/app");


// public path
define("PUBLIC_PATH", ROOT_PATH . "/public");


// config path
define("CONFIG_PATH", APP_PATH . "/config");


// system path
define("SYSTEM_PATH", ROOT_PATH . "/start");


// core path
define("CORE_PATH", SYSTEM_PATH . "/core");


// libraries path
define("LIBRARY_PATH", SYSTEM_PATH . "/libraries");


// helpers path
define("HELPER_PATH", SYSTEM_PATH . "/helpers");


// database path
define("DATABASE_PATH", SYSTEM_PATH . "/database");


// controllers path
define("CONTROLLER_PATH", APP_PATH . "/controllers");


// models path
define("MODEL_PATH", APP_PATH . "/models");


// views path
define("VIEW_PATH", APP_PATH . "/views");


// errors path
define("ERROR_PATH", APP_PATH . "/errors");

// *****************************************************************************

// cung cấp thư viện autoload
require_once "vendor/autoload.php";

use start\core\App;

$app = new App();
$app->start();

// use start\database\Connection;
// use start\database\DB;
// $db = new DB;
// $rs = $db->get("select * from classroom where class_id > ?", [1]);
// $db->run("delete from classroom where class_id = ?", [8]);