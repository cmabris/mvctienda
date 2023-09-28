<?php

ini_set('display_errors', 1);
require_once "libs/MySQLdb.php";

/**
 * La clase Application maneja la URL y lanza los procesos
 */

class Application
{
    public function __construct()
    {;
        $url = $this->separarURL();
        var_dump($url);
    }

    public function separarURL()
    {
        if ($_SERVER['REQUEST_URI'] != '/') {
            $url = trim($_SERVER['REQUEST_URI'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }

}