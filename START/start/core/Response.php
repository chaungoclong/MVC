<?php

namespace start\core;

class Response
{
    public function redirect($uri)
    {
        header('Location:' . WEB_PATH . '/' . $uri);
    }
}