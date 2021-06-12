<?php 
use start\core\Route;
use start\core\Request;

Route::get("/", "HomeController@index");
Route::get("/home", "HomeController@index");
Route::get("/about", "HomeController@about");
Route::get("/home/", "HomeController@index");
Route::get("/admin", "admin.AdminController@index");

Route::post("/admin", function() {
	$request = new Request();
	dd($request->post());
});
Route::post("/home", function() {
	$request = new Request;
	dd($request->any());
});

Route::get("/admin", "admin.AdminController@index");