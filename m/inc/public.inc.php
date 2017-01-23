<?php

	define('QFINC', dirname(__FILE__).'/');

	$nav = array('首　　页','公司简介','产品中心','联系我们');

	include_once("config.inc.php");	//加载配置文件

	include_once("common.func.php");	//加载函数库

	include_once("sql.class.php");	//加载数据库操作类

	include_once("browser.php");	//加载浏览器操作类

?>