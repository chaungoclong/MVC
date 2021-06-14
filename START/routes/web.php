<?php
use start\core\Request;
use start\core\Route;

Route::get("/", "HomeController@index");
Route::get("/home", "HomeController@index");
Route::get("/about", "HomeController@about");
Route::get("/home/", "HomeController@index");
Route::get("/admin", "admin.AdminController@index");

Route::post("/admin", function () {
    $request = new Request();
    dd($request->post());
});
Route::post("/home", function () {
    $request = new Request;
    dd($request->any());
});

Route::get("/admin", "admin.AdminController@index");

// classroom
Route::get("/class/list", "ClassController@index");
Route::get("/class/new", "ClassController@create");
Route::post("/class/store", "ClassController@store");
Route::get("/class/edit/{id}", "ClassController@edit");
Route::post('/class/update', "ClassController@update");
Route::get("/class/delete/{id}", "ClassController@destroy");

// student
Route::get("/student/list", "StudentController@index");
Route::get("/student/edit/{id}", "StudentController@edit");
Route::get("/student/new", "StudentController@create");
Route::post("/student/store", "StudentController@store");
Route::post("/student/update", "StudentController@update");
Route::get("/student/delete/{id}", "StudentController@destroy");