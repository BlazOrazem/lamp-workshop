<?php

class ErrorController
{
    public static function run404()
    {
        header("HTTP/1.0 404 Not Found");
        require 'views/404.php';
    }
}
