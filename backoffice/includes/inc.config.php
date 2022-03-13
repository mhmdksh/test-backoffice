<?php 
ob_start();
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING & ~E_PARSE);


// Default Date and DateTime formats
define("DATE_FORMAT", "Y-m-d");
define("DATETIME_FORMAT", "Y-m-d H:i:s");

// Media files directory
define("MEDIA_DIRECTORY", ROOT."media/");

// Database
define("DB_HOST", "localhost");
define("DB_NAME", "");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_PREFIX", "");
?>