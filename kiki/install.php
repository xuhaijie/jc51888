<?php
header("Content-type:text/html;charset=utf-8");
error_reporting(0);
include '../ThinkPHP/Extend/Library/ORG/Util/File.class.php';
install('../kiki.zip');
function install($zip,$update = 0)
{
	$file = new File();
	if(is_writable('../App/Lib/Action/Admin/'))
	{
		$file->moveFile('../data/CollectAction.class.php','../App/Lib/Action/Admin/'.'CollectAction.class.php',true);
	}
	else
	{
		$file->unlinkDir('../data');
		$file->unlinkFile('../kiki.zip');
		echo '安装失败，请将App/Lib/Action/Admin/权限设置为0777';
	}
		
	if(is_writable('../App/Tpl/Admin/'))
	{
		$file->moveDir('../data/Collect','../App/Tpl/Admin/'.'Collect',true);
	}
	else
	{
		$file->unlinkDir('../data');
		$file->unlinkFile('../kiki.zip');
		echo '安装失败，请将App/Tpl/Admin/权限设置为0777';
	}
		
	if(is_writable('../App/Tpl/Admin/Public/Js/'))
	{
		$file->moveDir('../data/layer','../App/Tpl/Admin/Public/Js/'.'layer',true);
	}
	else
	{
		$file->unlinkDir('../data');
		$file->unlinkFile('../kiki.zip');
		echo '安装失败，请将App/Tpl/Admin/权限设置为0777';
	}

	if(is_writable('../ThinkPHP/Extend/Library/ORG/Util/'))
	{
		$file->moveFile('../data/PhpQuery.class.php','../ThinkPHP/Extend/Library/ORG/Util/'.'PhpQuery.class.php',true);
		$file->moveFile('../data/QueryList.class.php','../ThinkPHP/Extend/Library/ORG/Util/'.'QueryList.class.php',true);
		$file->moveFile('../data/Smtp.class.php','../ThinkPHP/Extend/Library/ORG/Util/'.'Smtp.class.php',true);
	}
	else
	{
		$file->unlinkDir('../data');
		$file->unlinkFile('../kiki.zip');
		echo '安装失败，请将ThinkPHP/Extend/Library/ORG/Util/权限设置为0777';
	}	
	if(is_readable('../App/Lib/Action/Admin/CollectAction.class.php') && is_readable('../App/Tpl/Admin/Collect') && is_readable('../ThinkPHP/Extend/Library/ORG/Util/PhpQuery.class.php') && is_readable('../ThinkPHP/Extend/Library/ORG/Util/QueryList.class.php') && is_readable('../ThinkPHP/Extend/Library/ORG/Util/Smtp.class.php'))
	{
		$file->unlinkDir('../data');
		$file->unlinkFile('../kiki.zip');
		echo '安装成功,登陆后台,打开/Admin/Collect开始采集';
	}
}
?>