<?php 
define("APP_PATH", __DIR__ . "/app");

require_once "vendor/autoload.php";
require_once 'app/core/config/config.php';
require_once 'app/helpers/debug_helper.php';

use app\core\App;
use app\controllers\HomeController;

$app = new App(APP_PATH);
$app->run();

// var_dump(class_exists("app\controllers\HomeController"));