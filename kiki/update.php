<?php

check_file();
function check_file()
{
	$result = 0;
	//file=1 文件,file=2 文件夹
	$array = array(
		0 => array(
				'old' => '../App/Lib/Action/Admin/CollectAction.class.php',
				'new' => 'CollectAction.class.php',
				'file'=> '1'
 			),
		1 => array(
				'old' => '../App/Tpl/Admin/Collect/index.html',
				'new' => 'Collect/index.html',
				'file'=> '1'
 			),
		2 => array(
				'old' => '../ThinkPHP/Extend/Library/ORG/Util/PhpQuery.class.php',
				'new' => 'PhpQuery.class.php',
				'file'=> '1'
 			),
		3 => array(
				'old' => '../ThinkPHP/Extend/Library/ORG/Util/QueryList.class.php',
				'new' => 'QueryList.class.php',
				'file'=> '1'
 			),
		4 => array(
				'old' => '../App/Tpl/Admin/Public/Js/layer',
				'new' => 'layer',
				'file'=> '2'
 			),
		5 => array(
				'old' => '../ThinkPHP/Extend/Library/ORG/Util/Smtp.class.php',
				'new' => 'Smtp.class.php',
				'file'=> '1'
 			)
		);
	foreach($array as $k=>$v)
	{
		if(is_readable($v['old']))
		{
			if($v['file'] == 1)
			{
				$old = md5_file($v['old']);
				$new = md5_file($v['new']);
				if($old != $new)
				{
					$result = 1;
				}
			}
			if($v['file'] == 2)
			{
				$old = md5_folder($v['old']);
				$new = md5_folder($v['new']);
				if($old != $new)
				{
					$result = 1;
				}
			}
		}
		else
		{
			$result = 1;
		}
	}
	echo $result;
}
function md5_folder($dir)
{
	if (!is_dir($dir))
	{
		return false;
	}
	$filemd5s = array();
	$d = dir($dir);
	while (false !== ($entry = $d->read()))
	{
		if ($entry != '.' && $entry != '..' && $entry != '.svn')
		{
			if (is_dir($dir.'/'.$entry))
			{
				$filemd5s[] = md5_folder($dir.'/'.$entry);
			}
			else
			{
				$filemd5s[] = md5_file($dir.'/'.$entry);
			}
		}
	}
	$d->close();
	return md5(implode('', $filemd5s));
}
?>