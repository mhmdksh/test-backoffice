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
define("DB_HOST", "criboudb.cfzfxjthiasd.me-south-1.rds.amazonaws.com");
define("DB_NAME", "cribou");
define("DB_USER", "cribou");
define("DB_PASS", "?.XtBC3n12V4vOw618");
define("DB_PREFIX", "");
?>
