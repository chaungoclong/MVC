<?php 
// root path
define("ROOT_PATH", dirname(dirname( __DIR__)));


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
define("CONFIG_PATH", ROOT_PATH . "/config");


// system path
define("SYSTEM_PATH", ROOT_PATH . "/system");


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


// exceptions path
define("EXCEPTION_PATH", APP_PATH . "/exceptions");
