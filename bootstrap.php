<?php 
require_once 'vendor/autoload.php';
// use app\core\App;

/**
 * This is where the constants are defined
 */
define("WEB_PATH", __DIR__);
define("APP_PATH", __DIR__ . "/app");

/**
 * this is where to include files 
 */

$app = new app\core\App();
$app->run();



// $pattern = "~-[\w\d]+~";
// $string = "home/index-1-2-ok.html";
// preg_match_all($pattern, $string, $matches);

// echo "<pre>";
// print_r($matches);
// echo "<pre>";


// preg_match($pattern, $string, $matches);
// echo "<pre>";
// print_r($matches);
// echo "<pre>";