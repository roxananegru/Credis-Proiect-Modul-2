<?php

define("ROOT_PATH", __DIR__ . DIRECTORY_SEPARATOR);
require ROOT_PATH . "config/constant.php";
require ROOT_PATH . "helpers/function.php";

session_start();
    
if (ENV === "dev") {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}