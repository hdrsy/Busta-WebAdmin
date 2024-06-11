<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$currentLang = $_SESSION["sel_lan"];
include_once "languages/{$currentLang}.php";
define('DB_HOST', 'localhost'); // Change this to your database host
define('DB_USER', 'username'); // Change this to your database username
define('DB_PASS', 'password'); // Change this to your database password
define('DB_NAME', 'database'); // Change this to your database name
	
?>