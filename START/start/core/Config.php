<?php

namespace start\core;

class Config
{
    private static $configs = [];

    /***************************************************************************
     * [__construct description]
     **************************************************************************/
    public function __construct($configs = [])
    {
        if (is_array($configs)) {
            self::$configs = $configs;
        }

        if (is_string($configs)) {
            $this->load($configs);
        }
    }

    /***************************************************************************
     * [__get description]
     * get config in level 1
     **************************************************************************/
    public function __get($key)
    {
        return $this->get($key);
    }

    /***************************************************************************
     * [get description]
     * get config in all level
     **************************************************************************/
    public function get($key, $default = "ok")
    {
        // if not found load file containing configuration
        if (!$this->has($key)) {
            $keys      = explode(".", trim($key, ". "));
            $file_name = reset($keys);
            $this->load($file_name);
        }

        return $this->has($key) ? array_get(self::$configs, $key) : $default;
    }

    /***************************************************************************
     * [__set description]
     **************************************************************************/
    public function __set($key, $value)
    {
        return $this->set($key, $value);
    }

    /***************************************************************************
     * [set description]
     **************************************************************************/
    public function set($key, $value = null)
    {
        array_set(self::$configs, $key, $value);
    }

    /**
     * [all description]
     * @return [array] [description]
     */
    public function all()
    {
        $file_names = $this->get_config_names();
        foreach ($file_names as $file_name) {
            $this->load($file_name);
        }
        return self::$configs;
    }

    /***************************************************************************
     * [load description] load data from file config
     **************************************************************************/
    public function load($from)
    {
        $file_path = "";
        $key       = "";

        // get path and key
        if (is_file($from)) {
            $file_path  = $from;
            $file_paths = explode("/", $from);
            $key        = str_replace(".php", "", end($file_paths));
        } else {
            $file_path = CONFIG_PATH . "/{$from}.php";
            $key       = $from;
        }

        // check file exist -> get value from file -> set value for configs
        if (is_file($file_path)) {
            $value = include $file_path;

            if (is_array($value)) {
                self::$configs[$key] = $value;
                return true;
            }
        }

        return false;
    }

    /***************************************************************************
     * [has description] check if it has config[$key]
     **************************************************************************/
    public function has($key)
    {
        return array_has_key(self::$configs, $key);
    }

    /***************************************************************************
     * [get_config_names description] get all config name(file name after remove .php) in folder config
     **************************************************************************/
    public function get_config_names()
    {
        $config_files = array_diff(scandir(CONFIG_PATH), [".", ".."]);
        $config_names = [];

        foreach ($config_files as $key => $config_file) {
            $path = CONFIG_PATH . "/{$config_file}";
            if (is_file($path)) {
                $config_names[] = str_replace(".php", "", $config_file);
            }
        }
        return $config_names;
    }

    public function show()
    {
        dd(self::$configs);
    }
}
