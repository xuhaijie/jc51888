<?php
		$dbinfo=include('../App/Conf/config.php');  //获取系统数据库信息
		error_reporting(E_ALL & ~E_NOTICE);
		define("QFINC", substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-5)."/");
		if(strstr($_SERVER["SERVER_NAME"],"www")=="")
		{
			$temp_arr=explode("/",$_SERVER["REQUEST_URI"]);
			$temp_url="/".$temp_arr[1]."/";
			unset($temp_arr);
		}
		else
		{
			$temp_url="/";
		}

		$cfg_dbhost = $dbinfo['DB_HOST'];
		$cfg_dbname = $dbinfo['DB_NAME'];
		$cfg_dbuser = $dbinfo['DB_USER'];
		$cfg_dbpwd = $dbinfo['DB_PWD'];
		$cfg_dbprefix = $dbinfo['DB_PREFIX'];

		$cfg_db_language = "utf8";
		
		
		define("QFWEB","http://".$_SERVER["SERVER_NAME"].$temp_url);
		unset($temp_url);
		
		//PARENTS CAT ID
		define("NEWS","4");
		define("PRODUCTS","2");
		define("RECRUIT","3");
		
		$updir = "uploads";
?>