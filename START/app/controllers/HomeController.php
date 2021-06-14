<?php

namespace app\controllers;

use start\core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view("homes.index", ["name" => "LONG"]);
    }

    public function about()
    {
        return view("homes.about");
    }
}
