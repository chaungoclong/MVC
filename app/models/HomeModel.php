<?php 
namespace app\models;

class HomeModel {
	public function index() {
		return [
			["id" => 1, "name" => "a"],
			["id" => 2, "name" => "c"],
			["id" => 3, "name" => "d"],
			["id" => 4, "name" => "e"],
			["id" => 5, "name" => "f"]
		];
	}
}