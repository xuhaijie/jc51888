<?php

/**

 * 公用函数库

 */

/**
 *
 *
 *
 * 内部调试函数
 *
 * Enter description here ...
 *
 * @param unknown_type $var        	
 *
 * @param unknown_type $end        	
 *
 */
function debug($var, $end = true) 

{
	header ( "Content-type:text/html;charset=utf-8" );
	
	echo '<hr>';
	
	// var_dump($var);
	
	print_r ( $var );
	
	echo '<hr>';
	
	if ($end) 

	{
		
		exit ();
	}
}


function Z($var, $end = true) 

{
	debug ( $var, $end );
}

if (get_magic_quotes_gpc ()) 

{
	function stripslashes_deep($value) 

	{
		$value = is_array ( $value ) ? array_map ( 'stripslashes_deep', $value ) : stripslashes ( $value );
		
		return $value;
	}
	
	$_POST = array_map ( 'stripslashes_deep', $_POST );
	
	$_GET = array_map ( 'stripslashes_deep', $_GET );
	
	$_COOKIE = array_map ( 'stripslashes_deep', $_COOKIE );
}

/**
 *
 *
 *
 * 截图，重新设置大小，不安比例
 *
 * Enter description here ...
 *
 * @param unknown_type $var        	
 *
 * @param unknown_type $end        	
 *
 *
 */
function ImageResize($srcFile, $toW, $toH, $toFile = "") {
	global $cfg_photo_type;
	if ($toFile == "") {
		$toFile = $srcFile;
	}
	$info = "";
	$srcInfo = GetImageSize ( $srcFile, $info );
	switch ($srcInfo [2]) {
		case 1 :
			
			$im = imagecreatefromgif ( $srcFile );
			break;
		case 2 :
			
			$im = imagecreatefromjpeg ( $srcFile );
			break;
		case 3 :
			
			$im = imagecreatefrompng ( $srcFile );
			break;
		case 6 :
			
			$im = imagecreatefromwbmp ( $srcFile );
			break;
	}
	$srcW = ImageSX ( $im );
	$srcH = ImageSY ( $im );
	
	// if ($srcW <= $toW && $srcH <= $toH) {
	// return true;
	// }
	// 缩略生成并裁剪
	$newW = $toH * $srcW / $srcH;
	$newH = $toW * $srcH / $srcW;
	if ($newH >= $toH) {
		$ftoW = $toW;
		$ftoH = $newH;
	} else {
		$ftoW = $newW;
		$ftoH = $toH;
	}
	// if ($srcW > $toW || $srcH > $toH) {
	
	if (function_exists ( "imagecreatetruecolor" )) {
		@$ni = imagecreatetruecolor ( $ftoW, $ftoH );
		if ($ni) {
			imagecopyresampled ( $ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH );
		} else {
			$ni = imagecreate ( $ftoW, $ftoH );
			imagecopyresized ( $ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH );
		}
	} else {
		$ni = imagecreate ( $ftoW, $ftoH );
		imagecopyresized ( $ni, $im, 0, 0, 0, 0, $ftoW, $ftoH, $srcW, $srcH );
	}
	// 裁剪图片成标准缩略图
	$new_imgx = imagecreatetruecolor ( $toW, $toH );
	if ($newH >= $toH) {
		imagecopyresampled ( $new_imgx, $ni, 0, 0, 0, ($newH - $toH) / 2, $toW, $toH, $toW, $toH );
	} else {
		imagecopyresampled ( $new_imgx, $ni, 0, 0, ($newW - $toW) / 2, 0, $toW, $toH, $toW, $toH );
	}
	switch ($srcInfo [2]) {
		case 1 :
			imagegif ( $new_imgx, $toFile );
			break;
		case 2 :
			imagejpeg ( $new_imgx, $toFile, 85 );
			break;
		case 3 :
			imagepng ( $new_imgx, $toFile );
			break;
		case 6 :
			imagebmp ( $new_imgx, $toFile );
			break;
		default :
			return false;
	}
	imagedestroy ( $new_imgx );
	imagedestroy ( $ni );
	// } else {
	
	// // echo 'asdasd';
	// }
	imagedestroy ( $im );
	return true;
}
/*
 * 参数解释 $string： 明文 或 密文 $operation：DECODE表示解密,其它表示加密 $key： 密匙 $expiry：密文有效期
 */
if (! function_exists ( 'AuthCode' )) {
	function AuthCode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
		// 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
		// 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
		// 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
		// 当此值为 0 时，则不产生随机密钥
		$ckey_length = 4;
		// 密匙
		$key = md5 ( $key ? $key : $GLOBALS ['cfg_auth_key'] );
		// 密匙a会参与加解密
		$keya = md5 ( substr ( $key, 0, 16 ) );
		// 密匙b会用来做数据完整性验证
		$keyb = md5 ( substr ( $key, 16, 16 ) );
		// 密匙c用于变化生成的密文
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr ( $string, 0, $ckey_length ) : substr ( md5 ( microtime () ), - $ckey_length )) : '';
		// 参与运算的密匙
		$cryptkey = $keya . md5 ( $keya . $keyc );
		$key_length = strlen ( $cryptkey );
		// 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
		// 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
		$string = $operation == 'DECODE' ? base64_decode ( substr ( $string, $ckey_length ) ) : sprintf ( '%010d', $expiry ? $expiry + time () : 0 ) . substr ( md5 ( $string . $keyb ), 0, 16 ) . $string;
		$string_length = strlen ( $string );
		$result = '';
		$box = range ( 0, 255 );
		$rndkey = array ();
		
		// 产生密匙簿
		for($i = 0; $i <= 255; $i ++) {
			$rndkey [$i] = ord ( $cryptkey [$i % $key_length] );
		}
		
		// 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上并不会增加密文的强度
		for($j = $i = 0; $i < 256; $i ++) {
			// $j是三个数相加与256取余
			$j = ($j + $box [$i] + $rndkey [$i]) % 256;
			$tmp = $box [$i];
			$box [$i] = $box [$j];
			$box [$j] = $tmp;
		}
		
		// 核心加解密部分
		for($a = $j = $i = 0; $i < $string_length; $i ++) {
			// 在上面基础上再加1 然后和256取余
			$a = ($a + 1) % 256;
			$j = ($j + $box [$a]) % 256; // $j加$box[$a]的值 再和256取余
			$tmp = $box [$a];
			$box [$a] = $box [$j];
			$box [$j] = $tmp;
			// 从密匙簿得出密匙进行异或，再转成字符，加密和解决时($box[($box[$a] + $box[$j]) %
			// 256])的值是不变的。
			$result .= chr ( ord ( $string [$i] ) ^ ($box [($box [$a] + $box [$j]) % 256]) );
		}
		
		if ($operation == 'DECODE') {
			// substr($result, 0, 10) == 0 验证数据有效性
			// substr($result, 0, 10) - time() > 0 验证数据有效性
			// substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb),
			// 0, 16) 验证数据完整性
			// 验证数据有效性，请看未加密明文的格式
			if ((substr ( $result, 0, 10 ) == 0 || substr ( $result, 0, 10 ) - time () > 0) && substr ( $result, 10, 16 ) == substr ( md5 ( substr ( $result, 26 ) . $keyb ), 0, 16 )) {
				return substr ( $result, 26 );
			} else {
				return '';
			}
		} else {
			// 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
			// 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
			return $keyc . str_replace ( '=', '', base64_encode ( $result ) );
		}
	}
}
/*
 * 函数说明：截取指定长度的字符串 utf-8专用 汉字和大写字母长度算1，其它字符长度算0.5 @param string $str 原字符串 @param
 * int $len 截取长度 @param string $etc 省略字符... @return string 截取后的字符串
 */
if (! function_exists ( 'ReStrLen' )) {
	function ReStrLen($str, $len = 10, $etc = '...') {
		$restr = '';
		$i = 0;
		$n = 0.0;
		
		// 字符串的字节数
		$strlen = strlen ( $str );
		while ( ($n < $len) and ($i < $strlen) ) {
			$temp_str = substr ( $str, $i, 1 );
			
			// 得到字符串中第$i位字符的ASCII码
			$ascnum = ord ( $temp_str );
			
			// 如果ASCII位高与252
			if ($ascnum >= 252) {
				// 根据UTF-8编码规范，将6个连续的字符计为单个字符
				$restr = $restr . substr ( $str, $i, 6 );
				// 实际Byte计为6
				$i = $i + 6;
				// 字串长度计1
				$n ++;
			} elseif ($ascnum >= 248) {
				$restr = $restr . substr ( $str, $i, 5 );
				$i = $i + 5;
				$n ++;
			} elseif ($ascnum >= 240) {
				$restr = $restr . substr ( $str, $i, 4 );
				$i = $i + 4;
				$n ++;
			} elseif ($ascnum >= 224) {
				$restr = $restr . substr ( $str, $i, 3 );
				$i = $i + 3;
				$n ++;
			} elseif ($ascnum >= 192) {
				$restr = $restr . substr ( $str, $i, 2 );
				$i = $i + 2;
				$n ++;
			}			

			// 如果是大写字母 I除外
			elseif ($ascnum >= 65 and $ascnum <= 90 and $ascnum != 73) {
				$restr = $restr . substr ( $str, $i, 1 );
				// 实际的Byte数仍计1个
				$i = $i + 1;
				// 但考虑整体美观，大写字母计成一个高位字符
				$n ++;
			}			

			// %,&,@,m,w 字符按1个字符宽
			elseif (! (array_search ( $ascnum, array (
					37,
					38,
					64,
					109,
					119 
			) ) === FALSE)) {
				$restr = $restr . substr ( $str, $i, 1 );
				// 实际的Byte数仍计1个
				$i = $i + 1;
				// 但考虑整体美观，这些字条计成一个高位字符
				$n ++;
			} 			

			// 其他情况下，包括小写字母和半角标点符号
			else {
				$restr = $restr . substr ( $str, $i, 1 );
				// 实际的Byte数计1个
				$i = $i + 1;
				// 其余的小写字母和半角标点等与半个高位字符宽
				$n = $n + 0.5;
			}
		}
		
		// 超过长度时在尾处加上省略号
		if ($i < $strlen) {
			$restr = $restr . $etc;
		}
		
		return $restr;
	}
}

// 获得当前的页面文件的url
if (! function_exists ( 'GetCurUrl' )) {
	function GetCurUrl() {
		if (! empty ( $_SERVER ['REQUEST_URI'] )) {
			$nowurls = explode ( '?', $_SERVER ['REQUEST_URI'] );
			$nowurl = $nowurls [0];
		} else {
			$nowurl = $_SERVER ['PHP_SELF'];
		}
		
		return $nowurl;
	}
}

// 获取IP
if (! function_exists ( 'GetIP' )) {
	function GetIP() {
		static $ip = NULL;
		if ($ip !== NULL)
			return $ip;
		
		if (isset ( $_SERVER ['HTTP_X_FORWARDED_FOR'] )) {
			$arr = explode ( ',', $_SERVER ['HTTP_X_FORWARDED_FOR'] );
			$pos = array_search ( 'unknown', $arr );
			if (false !== $pos)
				unset ( $arr [$pos] );
			$ip = trim ( $arr [0] );
		} else if (isset ( $_SERVER ['HTTP_CLIENT_IP'] )) {
			$ip = $_SERVER ['HTTP_CLIENT_IP'];
		} else if (isset ( $_SERVER ['REMOTE_ADDR'] )) {
			$ip = $_SERVER ['REMOTE_ADDR'];
		}
		
		// IP地址合法验证
		$ip = (false !== ip2long ( $ip )) ? $ip : '0.0.0.0';
		return $ip;
	}
}

// 查看数据大小
if (! function_exists ( 'GetRealSize' )) {
	function GetRealSize($size) {
		$kb = 1024; // Kilobyte
		$mb = 1024 * $kb; // Megabyte
		$gb = 1024 * $mb; // Gigabyte
		$tb = 1024 * $gb; // Terabyte
		
		if ($size < $kb)
			return $size . 'B';
		
		else if ($size < $mb)
			return round ( $size / $kb, 2 ) . 'KB';
		
		else if ($size < $gb)
			return round ( $size / $mb, 2 ) . 'MB';
		
		else if ($size < $tb)
			return round ( $size / $gb, 2 ) . 'GB';
		
		else
			return round ( $size / $tb, 2 ) . 'TB';
	}
}

// 获取文件夹大小
if (! function_exists ( 'GetDirSize' )) {
	function GetDirSize($dir) {
		$handle = opendir ( $dir );
		$fsize = '';
		
		while ( ($fname = readdir ( $handle )) !== false ) {
			if ($fname != '.' && $fname != '..') {
				if (is_dir ( "$dir/$fname" ))
					$fsize += GetDirSize ( "$dir/$fname" );
				
				else
					$fsize += filesize ( "$dir/$fname" );
			}
		}
		
		closedir ( $handle );
		if (empty ( $fsize ))
			$fsize = 0;
		
		return $fsize;
	}
}

// 返回格林威治标准时间
if (! function_exists ( 'MyDate' )) {
	function MyDate($format = 'Y-m-d H:i:s', $timest = 0) {
		global $cfg_timezone;
		$addtime = $cfg_timezone * 3600;
		if (empty ( $format )) {
			$format = 'Y-m-d H:i:s';
		}
		return gmdate ( $format, $timest + $addtime );
	}
}

// 返回格式化(Y-m-d H:i:s)的时间
if (! function_exists ( 'GetDateTime' )) {
	function GetDateTime($mktime) {
		return MyDate ( 'Y-m-d H:i:s', $mktime );
	}
}

// 返回格式化(Y-m-d)的日期
if (! function_exists ( 'GetDateMk' )) {
	function GetDateMk($mktime) {
		return MyDate ( 'Y-m-d', $mktime );
	}
}

// 从普通时间转换为Linux时间截
if (! function_exists ( 'GetMkTime' )) {
	function GetMkTime($dtime) {
		if (! preg_match ( "/[^0-9]/", $dtime )) {
			return $dtime;
		}
		$dtime = trim ( $dtime );
		$dt = array (
				1970,
				1,
				1,
				0,
				0,
				0 
		);
		$dtime = preg_replace ( "/[\r\n\t]|日|秒/", " ", $dtime );
		$dtime = str_replace ( "年", "-", $dtime );
		$dtime = str_replace ( "月", "-", $dtime );
		$dtime = str_replace ( "时", ":", $dtime );
		$dtime = str_replace ( "分", ":", $dtime );
		$dtime = trim ( preg_replace ( "/[ ]{1,}/", " ", $dtime ) );
		$ds = explode ( " ", $dtime );
		$ymd = explode ( "-", $ds [0] );
		if (! isset ( $ymd [1] ))
			$ymd = explode ( ".", $ds [0] );
		if (isset ( $ymd [0] ))
			$dt [0] = $ymd [0];
		if (isset ( $ymd [1] ))
			$dt [1] = $ymd [1];
		if (isset ( $ymd [2] ))
			$dt [2] = $ymd [2];
		if (strlen ( $dt [0] ) == 2)
			$dt [0] = '20' . $dt [0];
		if (isset ( $ds [1] )) {
			$hms = explode ( ":", $ds [1] );
			if (isset ( $hms [0] ))
				$dt [3] = $hms [0];
			if (isset ( $hms [1] ))
				$dt [4] = $hms [1];
			if (isset ( $hms [2] ))
				$dt [5] = $hms [2];
		}
		foreach ( $dt as $k => $v ) {
			$v = preg_replace ( "/^0{1,}/", '', trim ( $v ) );
			if ($v == '') {
				$dt [$k] = 0;
			}
		}
		
		$mt = mktime ( $dt [3], $dt [4], $dt [5], $dt [1], $dt [2], $dt [0] );
		if (! empty ( $mt ))
			return $mt;
		else
			return time ();
	}
}

// 创建多级目录
if (! function_exists ( 'mkdirs' )) {
	function mkdirs($dir) {
		return is_dir ( $dir ) or (mkdirs ( dirname ( $dir ) ) and mkdir ( $dir, 0777 ));
	}
}

// 显示信息
if (! function_exists ( 'ShowMsg' )) {
	function ShowMsg($msg = '', $gourl = '-1') {
		if ($gourl != '-1')
			echo '<script>alert("' . $msg . '");location.href="' . $gourl . '";</script>';
		
		else
			echo '<script>alert("' . $msg . '");history.go(-1);</script>';
	}
}

// 读取文件内容
if (! function_exists ( 'Readf' )) {
	function Readf($file) {
		if (file_exists ( $file ) && is_readable ( $file )) {
			if (function_exists ( 'file_get_contents' )) {
				$str = file_get_contents ( $file );
			} else {
				$str = '';
				
				$fp = fopen ( $file, 'r' );
				while ( ! feof ( $fp ) ) {
					$str .= fgets ( $fp, 1024 );
				}
				fclose ( $fp );
			}
			return $str;
		} else {
			return FALSE;
		}
	}
}

// 写入文件内容
if (! function_exists ( 'Writef' )) {
	function Writef($file, $str, $mode = 'w') {
		if (file_exists ( $file ) && is_writable ( $file )) {
			$fp = fopen ( $file, $mode );
			flock ( $fp, 3 );
			fwrite ( $fp, $str );
			fclose ( $fp );
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

// 查看url中是否包含http
if (! function_exists ( 'IsHttpUrl' )) {
	function IsHttpUrl($url) {
		if (! preg_match ( "/^(http|ftp):/", $url )) {
			$url = 'http://' . $url;
		}
		
		return $url;
	}
}

// 执行时间函数
if (! function_exists ( 'ExecTime' )) {
	function ExecTime() {
		$time = explode ( " ", microtime () );
		$usec = ( double ) $time [0];
		$sec = ( double ) $time [1];
		return $sec + $usec;
	}
}

// 清除HTML
if (! function_exists ( 'ClearHtml' )) {
	function ClearHtml($str) {
		$str = strip_tags ( $str );
		
		// 首先去掉头尾空格
		$str = trim ( $str );
		
		// 接着去掉两个空格以上的
		$str = preg_replace ( '/\s(?=\s)/', '', $str );
		
		// 最后将非空格替换为一个空格
		$str = preg_replace ( '/[\n\r\t]/', ' ', $str );
		
		return $str;
	}
}

// 获取指定长度随机字符串
if (! function_exists ( 'GetRandStr' )) {
	function GetRandStr($length = 6) {
		// '!@#$%^&*()-_ []{}<>~`+=,.;:/?|';
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$random_str = '';
		
		for($i = 0; $i < $length; $i ++) {
			// 这里提供两种字符获取方式
			// 第一种是使用 substr 截取$chars中的任意一位字符；
			// 第二种是取字符数组 $chars 的任意元素
			// $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
			$random_str .= $chars [mt_rand ( 0, strlen ( $chars ) - 1 )];
		}
		
		return $random_str;
	}
}

/*
 * 参数解释 $string： 明文 或 密文 $operation：DECODE表示解密,其它表示加密 $key： 密匙 $expiry：密文有效期
 */
if (! function_exists ( 'AuthCode' )) {
	function AuthCode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
		// 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
		// 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
		// 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
		// 当此值为 0 时，则不产生随机密钥
		$ckey_length = 4;
		// 密匙
		$key = md5 ( $key ? $key : $GLOBALS ['cfg_auth_key'] );
		// 密匙a会参与加解密
		$keya = md5 ( substr ( $key, 0, 16 ) );
		// 密匙b会用来做数据完整性验证
		$keyb = md5 ( substr ( $key, 16, 16 ) );
		// 密匙c用于变化生成的密文
		$keyc = $ckey_length ? ($operation == 'DECODE' ? substr ( $string, 0, $ckey_length ) : substr ( md5 ( microtime () ), - $ckey_length )) : '';
		// 参与运算的密匙
		$cryptkey = $keya . md5 ( $keya . $keyc );
		$key_length = strlen ( $cryptkey );
		// 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
		// 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
		$string = $operation == 'DECODE' ? base64_decode ( substr ( $string, $ckey_length ) ) : sprintf ( '%010d', $expiry ? $expiry + time () : 0 ) . substr ( md5 ( $string . $keyb ), 0, 16 ) . $string;
		$string_length = strlen ( $string );
		$result = '';
		$box = range ( 0, 255 );
		$rndkey = array ();
		
		// 产生密匙簿
		for($i = 0; $i <= 255; $i ++) {
			$rndkey [$i] = ord ( $cryptkey [$i % $key_length] );
		}
		
		// 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上并不会增加密文的强度
		for($j = $i = 0; $i < 256; $i ++) {
			// $j是三个数相加与256取余
			$j = ($j + $box [$i] + $rndkey [$i]) % 256;
			$tmp = $box [$i];
			$box [$i] = $box [$j];
			$box [$j] = $tmp;
		}
		
		// 核心加解密部分
		for($a = $j = $i = 0; $i < $string_length; $i ++) {
			// 在上面基础上再加1 然后和256取余
			$a = ($a + 1) % 256;
			$j = ($j + $box [$a]) % 256; // $j加$box[$a]的值 再和256取余
			$tmp = $box [$a];
			$box [$a] = $box [$j];
			$box [$j] = $tmp;
			// 从密匙簿得出密匙进行异或，再转成字符，加密和解决时($box[($box[$a] + $box[$j]) %
			// 256])的值是不变的。
			$result .= chr ( ord ( $string [$i] ) ^ ($box [($box [$a] + $box [$j]) % 256]) );
		}
		
		if ($operation == 'DECODE') {
			// substr($result, 0, 10) == 0 验证数据有效性
			// substr($result, 0, 10) - time() > 0 验证数据有效性
			// substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb),
			// 0, 16) 验证数据完整性
			// 验证数据有效性，请看未加密明文的格式
			if ((substr ( $result, 0, 10 ) == 0 || substr ( $result, 0, 10 ) - time () > 0) && substr ( $result, 10, 16 ) == substr ( md5 ( substr ( $result, 26 ) . $keyb ), 0, 16 )) {
				return substr ( $result, 26 );
			} else {
				return '';
			}
		} else {
			// 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
			// 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
			return $keyc . str_replace ( '=', '', base64_encode ( $result ) );
		}
	}
}

/* 字符串转数组 */
function String2Array($data) {
	if ($data == '')
		return array ();
	@eval ( "\$array = $data;" );
	return $array;
}


/**
 * 加密算法
 * @param  string $data 加密字符串
 * @param  string $key  密钥
 * @return string       
 */
function encrypt($data, $key)
{
    $key = md5($key);
    $x  = 0;
    $len = strlen($data);
    $l  = strlen($key);
    for ($i = 0; $i < $len; $i++)
    {
        if ($x == $l) 
        {
         $x = 0;
        }
        $char .= $key{$x};
        $x++;
    }
    for ($i = 0; $i < $len; $i++)
    {
        $str .= chr(ord($data{$i}) + (ord($char{$i})) % 256);
    }
    return base64_encode($str);
}



/**
 *
 * 将订单中的json数据转为数组
 * @param unknown_type $starray
 */
function decode_carstr($starray) {
	return json_decode($starray,true);
}





function http_transport($url, $params = array(), $method = 'POST')
{
    $opts = array(
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false
    );
    /* 根据请求类型设置特定参数 */
    switch(strtoupper($method)){
        case 'GET':
            $opts[CURLOPT_URL] = $url .'?'. http_build_query($params);
            break;
        case 'POST':
            $opts[CURLOPT_URL] = $url;
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = $params;
            break;
    }       
    /* 初始化并执行curl请求 */
    $ch = curl_init();
    curl_setopt_array($ch, $opts);
    $data  = curl_exec($ch);
    $err = curl_errno($ch);
    $errmsg = curl_error($ch);
    curl_close($ch);
    if ($err > 0) {     
        // $this->error = $errmsg; 
        return false;
    }else {
        return $data;
    }


}
?>