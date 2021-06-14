<?php

namespace start\database;

use \PDO;

class DB
{
    protected $driver;
    protected $pdo;
    protected $stmt;
    protected $query;

    public function __construct()
    {
        $this->driver = Connection::get_instance();
    }

    protected function connect()
    {
        if (!isset($this->pdo)) {
            $this->pdo = $this->driver->connect();
        }
    }

    protected function close()
    {
        $this->stmt = null;
        $this->pdo = null;
        $this->driver->close();
    }

    public function get($sql, array $param = [])
    {
        $rs = [];

        try {
            $this->connect();
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($param);
            $rs = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
            $this->close();
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $rs;
    }

    public function run($sql, array $param = [])
    {
        try {
            $this->connect();
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute($param);
            $this->close();
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function first($sql, array $param = [])
    {
        $rs = [];
        
        try {
            $result = $this->get($sql, $param);
            $rs = array_shift($result);
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $rs;
    }
}
