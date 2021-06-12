<?php
namespace start\core;

class View {

    // load layout và ném nội dung view ra layout
    public static function render($file, array $data = []) {
        $view_content = self::get_view_content($file, $data);

        $layout = Registry::instance()
            ->current_controlller
            ->get_layout();
        $layout_path = VIEW_PATH . "/layouts/{$layout}.php";

        if (is_file($layout_path)) {
            ob_start();
            require_once $layout_path;
            $layout_content = ob_get_clean();

            echo str_replace("{{content}}", $view_content, $layout_content);
        }
        else {
            return error("404");
        }

    }

    // lấy nội dung view
    public static function get_view_content($file, array $data = []) {
        $file = str_replace(".", "/", trim($file, ". "));
        $view_path = VIEW_PATH . "/{$file}.php";

        if (is_file($view_path)) {
            extract($data);

            ob_start();
            require_once $view_path;
            $view_content = ob_get_clean();

            return $view_content;
        }

        return error("404");
    }

    // load các khối của giao diện
    public static function load_block($file, array $data = []) {
        $file = str_replace(".", "/", trim($file, ". "));
        $block_path = VIEW_PATH . "/{$file}.php";

        if (is_file($block_path)) {
            extract($data);
            require_once $block_path;
        }
        else {
            return error("404");
        }
    }

}

