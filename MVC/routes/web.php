<?php 
use system\core\Route;
Route::get("/home", "HomeController@index");

Route::post("/ok", function() {
	echo "post";
});