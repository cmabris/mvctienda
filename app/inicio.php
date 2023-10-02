<?php
ini_set('display_errors', 1);

//Constantes iniciales
define('ROOT', DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' . ROOT);


//Carga las clases iniciales
require_once 'libs/MySQLdb.php';
require_once 'libs/Controller.php';
require_once 'libs/Application.php';


