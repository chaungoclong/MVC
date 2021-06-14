<?php

namespace start\core;

use start\database\DB;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new DB();
    }
}
