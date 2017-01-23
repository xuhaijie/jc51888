<?php
$a = 'http://' . $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'];
$b = parse_url ( $a );
$c = explode ( '/', $b ['path'] );

function zie()
{
	$a=$_SERVER['HTTP_USER_AGENT'];
	$g=strpos($a,'MSIE');
	if($g>0){
		$e=strpos($a,'.',$g);
		$z=substr($a,$g+5,$e-$g-5);
		return (int)$z;
	}else{
		return 10;
	}
	
}
$ie=zie();


$cfg_weburl = $_SERVER['SERVER_NAME'];
$cfg_webpath = '';
$cfg_auth_key = 'AtMUxvCH8LCLfuzi';
$cfg_alipay_uname = 'tao_8jfc';
$cfg_alipay_partner = '234';
$cfg_alipay_key = '234234';
//数据库服务器
$db_host = 'localhost';
//数据库用户名
$db_user = 'root';
//数据库密码
$db_pwd = 'root';
//数据库名
$db_name = 'jc51888';
//数据表前缀
$db_tablepre = 'qf_';
//数据表编码
$db_charset = 'utf8';

return array(
    //'APP_AUTOLOAD_PATH'         =>  '@.TagLib',
    'LOAD_EXT_FILE'=>'Classskr,funskr',
	'APP_XIANGMU'=>$c[1],
    'APP_GROUP_LIST'            =>  'Home,Admin,Install',
    'DEFAULT_GROUP'             =>  'Home',
    'URL_CASE_INSENSITIVE'      =>   true,
	'UPLOAD_DIR'				=>  './App/Tpl/Home/Uploads/',
	'UPLOAD_DIR_M'				=>	'./m/uploads/',
	'UPLOAD_PILIANG'				=>	'./Uploads',
	'UPLOAD_RESIZ'				=>	'1',
    'URL_MODEL'                 =>  1, 
	'MAX_FILE_SIZE'                 =>1048576,
	//'URL_HTML_SUFFIX'           =>  '.html',
    'DB_TYPE'                   =>  'mysql',
    'DB_HOST'                   =>  $db_host,
    'DB_NAME'                   =>  $db_name,
    'DB_USER'                   =>  $db_user,
    'DB_PWD'                    => $db_pwd,
    'DB_PORT'                   =>  '3306',
    'DB_PREFIX'                 => $db_tablepre,
    'IE'=>$ie,
	'TMPL_PARSE_STRING'         => array(
        	'__UPLOAD__' => 'App/Tpl/Home/Uploads', // 增加新的上传路径替换规则
        	'__IE__'=>$ie,
        	//'__GROUP__'=>'Admin'
    ),
	//默认错误跳转对应的模板文件
	'TMPL_ACTION_ERROR' => 'Public:jump',
	//默认成功跳转对应的模板文件
	'TMPL_ACTION_SUCCESS' => 'Public:jump',
	'URL_ROUTER_ON'             =>  true, //开启路由
	'URL_ROUTE_RULES'           =>  array(   //路由规则        
		        '/^news\/([0-9]+)$/'          =>  'news/news_info?id=:1',
		        '/^news\/type\/([0-9]+)$/'    =>  'news/index?type=:1',
		        '/^product\/([0-9]+)$/'       =>  'product/product_info?id=:1',
		        '/^product\/type\/([0-9]+)$/' =>  'product/index?type=:1',

		        '/^jobs\/([0-9]+)$/'          =>  'jobs/jobs_info?id=:1',
			    '/^message\/([0-9]+)$/'    =>  'message/message_info?id=:1',
				'/^custom\/([0-9]+)$/'          =>  'custom/info?id=:1',
		    ),
	'typearry' => array (
				'getmoney' => '已收款',
				'send' => '已发货',
				'verify' => '收货确认',
				'returns' => '退货中',
				'returnsverify' => '退货确认',
				'backmoney' => '已退款',
				'ok' => '订单完成'
		),
	
);
?>