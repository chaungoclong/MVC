<?php

namespace start\core;

class Helper {
    public function load(...$helper_names) {
        // load all helper
        if (count($helper_names) === 0) {
            $list_helper_path = glob(HELPER_PATH . "/*.php");

            foreach ($list_helper_path as $key => $helper_path) {
                if (file_exists($helper_path)) {
                    require_once $helper_path;
                }
            }
        }

        //load one or more helper
        if (count($helper_names) >= 1) {
            foreach ($helper_names as $key => $helper_name) {
                $helper_path = HELPER_PATH . "/{$helper_name}.php";
                if (file_exists($helper_path)) {
                    require_once $helper_path;
                }
            }
        }
    }
}

