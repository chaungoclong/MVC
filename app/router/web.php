<?php 
use app\core\App;
use app\core\Request;

App::$app->router->get("/", "HomeController@index");

App::$app->router->get("/register", "HomeController@register");

App::$app->router->post("/register", "HomeController@handle_register");