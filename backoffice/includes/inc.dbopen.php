<?php
// Include needed database classes
include_once(ROOT."dbaccess/class.MysqlManager.php");
include_once(ROOT."dbaccess/class.AppDataManager.php");
include_once(ROOT."dbaccess/class.News.php");


$database_manager = new MysqlManager(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$database_manager->open();
$database_manager->setEncoding("utf8");
$data_manager = new AppDataManager($database_manager);

?>