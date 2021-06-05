<?php 

// echo "<pre>";
// print_r($_SERVER);
// echo "</pre>";
require_once 'vendor/autoload.php';

use system\core\Route;
Route::get("/home", "HomeController@index");

Route::post("/ok", function() {
	echo "post";
});
use system\core\App;
App::run();

/**
 *
 *kiem tra co route nao khop:
 *co:
 *	- lay param
 *	- lay callback:
 *		+callback la string:
 *			>lay controller va action:
 *				*kiem tra dinh dang:
 *					+ dung :
 *						lay action va controller
 *     				+ sai: error
 *		+callback la function:
 *			tra ve callback
 *	- thuc thi callback:
 *		callback la string: 
 *			kiem tra controller va action co ton tai
 *				co: exec
 *				khong: error
 *		callback la function
 *			exec
 *
 *khong: error
 */
?>
