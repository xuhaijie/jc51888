<?php
header("Content-type:text/html;charset=utf-8");
include 'ThinkPHP/Extend/Library/ORG/Net/Http.class.php';
include 'ThinkPHP/Extend/Library/ORG/Util/PclZip.class.php';
$http = new Http();
$http->curlDownload('http://dnjx888.243.greensp.cn/collect/kiki.zip','kiki.zip');
$archive = new PclZip('kiki.zip');  
if ($archive->extract(PCLZIP_OPT_PATH, 'data',PCLZIP_OPT_REMOVE_PATH, 'install/release') == 0) {  
	die("Error : ".$archive->errorInfo(true));  
}
$current_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = str_replace('kiki.php','data/install.php',$current_url);
header("Location:".$url);
?>