<?php
/**

*生成单页

*/
function be_dy($a){
	if(isset($a)){
		$data=array(
			"title"=>$a,
			'pid'=>0,
			'order'=>255
		);
		return M("article")->add($data);
	}else{
		return '';
	}
}
/**

 * 截图，重新设置大小，不安比例
 
 */
function skr_ImageResize($srcFile, $toW, $toH, $toFile = "") {
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
/**

* 读取目录下（包括一层子类）的图片

**/
function skr_dir($path,$a=true,$b=2){
	//z(scandir($path));
	foreach(scandir($path) as $filename){
		$exclude=array('.','..');
		if(!in_array($filename,$exclude)){
			$true_path=$path.'/'.$filename;
			if(is_dir($true_path)){

				$dirname[]['name']=$a?iconv ('gb2312','utf-8',$filename ):$filename;
				$ii=count($dirname)-1;
				if($b){
					$dirname[$ii]['imgs']=skr_dir($true_path,$a,$b-1);
				}
			}else{
				$imgs[]['img']=$a?iconv('gb2312','utf-8',$filename):$filename;
				$ii=count($imgs)-1;
				$imgs[$ii]['size'] = getimagesize ($true_path);
			}
		}
	}
	if($imgs && $dirname){
		$imgs=array('sim1'=>$dirname,'sim2'=>$imgs);
	}elseif($dirname){
		$imgs=array('sim1'=>$dirname);
	}else{
		$imgs=array('sim2'=>$imgs);
	}
	//print_r($imgs);
	return $imgs;
}

/**

* 上传图片方法 $img:图片名称 $dir2:图片地址 $fideir:图片上传到地址 $ipd：所属类id

**/
function skr_plsr($img,$dir2,$fiedir,$ipd,$imgn,$Image,$dir_thumb) {
	if (file_exists ( $dir2 . "/" . $img ) && $img != '') {
		// 老文件名，可用于产品标题
		$oldname = iconv ( 'gb2312', 'utf-8', $img );
		$tempoldname = explode ('.',$oldname);
		if ($tempoldname [0]) {
			$oldname = $tempoldname[0];
		}
		// 新文件名
		$newname = skr_get_newfilename ( $img );
		$item = array ();
		// 栏目id
		$item [pid] = $ipd;
		$item [img] = $newname;
		$item [order]= $_REQUEST [order];
		$item [title] = $imgn?$imgn:$oldname;
		$item [keywords]=$_REQUEST [keywords]?$_REQUEST [keywords]:'';
		$item [price]=$_REQUEST [price]?$_REQUEST [price]:'';
		$item [is_delete] = 0;
		$id = M("goods")->add ( $item );
		if ($id) {
			// 移动文件到upload目录
			// echo $dir."/".$files [$cpimgname]."====".$fiedir.
			// $newname;
			if ($dir2) {
				rename ( $dir2 . "/" .$img, $fiedir . $newname );
			}
			//判断是否生成一张正方形的缩略图
			if(C('UPLOAD_RESIZ')==1){
				ImageResize ($fiedir. $newname , C('BRE_W'), C('BRE_H'), $fiedir .'in_'.$newname);
				$Image->thumb ( $fiedir . $newname,  $fiedir .'im_'. $newname, '', C('BRE_W'), C('BRE_H') );
			}
			// 手机缩略图
			if (1) {
				$d = $Image->thumb ( $fiedir . $newname, $dir_thumb . $newname, '', 800, 480 );
				$s = $Image->thumb ( $fiedir . $newname, $dir_thumb . 'm_' . $newname, '', 110, 83 );
			}
			return 1;
			// copy($fiedir. $newname,$fiedir."m/".$newname);
		} else {
			return 0;
		}
		// 产生新随机文件名
	}else{
		return 0;
	}
}

function skr_new_name($iname,$inum=false){
	$iname=$inum?$iname."(".$inum.")":$iname;
	return $iname;
}

//重新命名
function skr_get_newfilename($filename) {
	$now = time ();
	$image_fix = end ( explode ( '.', $filename ) );
	$img_suiji = rand ( 20, 250 );
	$rename = $now . "$img_suiji" . "." . $image_fix;
	return $rename;
}
/**

* 修正类别code

**/
function skr_code($id,$a=ture)
{
	//$a为true时
	if($a){
		$data=array();
    	$data =M('type')->find($id);
    	//z($data);
    	$parent_data =M('type')->find($data['parent']);
    	//判断是否属于子类type_tree
    	if(!in_array($id, explode(",",$parent_data['code']))){	
	    	$data['code'] = $parent_data['code'].$data['id'].",";
	    	$data['type'] = $parent_data['type'];
	    	M('type')->save($data);
	    	return ture;
    	}else{
    		$par=explode(",",$data['code']);
    		$i=count($par)-3;		
    		$data['parent']=$par[$i];
    		M('type')->save($data);
    		return false;
    	}
	}elseif(skr_code($id)){
		//跟新子类的归属
		$data=M('type')->where("`parent`=$id")->select();
		if($data){
    		foreach ($data as $key => $value) {
    			skr_code($value['id'],false);
    		}
		}
		return ture;
	}
}
/**

 *返回$id的子类别ID和自身
**/
function getTypeID($id) {
	if (! $id)
		return false;
	if ($id > 0 && $id < 4) {
		$pid = M ( 'type' )->field ( '`id`' )->where ( "`order`<>0 and `code` like '$id,%'" )->select ();
	} else {
		$pid = M ( 'type' )->field ( '`id`' )->where ( "`order`<>0 and `code` like '%,$id,%'" )->select ();
	}
	
	// 文章 or 产品 or 人才 的PID
	$nums = '';
	for ($i=count($pid)-1; $i >=0 ; $i--) { 
	 	$nums .= $pid[$i] ['id'] . ',';
	 }  
	return rtrim ( $nums, ',' );
}
/**

 * 参数：父类id和类别树的深度 返回值：嵌套数组形式的类别树 $depth = 0 返回父类下所有类别 $depth = N 返回父类下N层类别

 **/
function type_tree($parent_id, $depth = 1) {
		if ($depth >= 0) {
			if ($parent_id > 0 && $parent_id < 4) { // 三个根分类
				$type = M ( 'type' )->where ( "`type` = '$parent_id' and `order`<>0" )->order ( '`order` asc' )->select ();
			} else {
				$type = M ( 'type' )->where ( "`code` like '%,$parent_id,%' and `order`<>0 " )->order ( '`order` asc' )->select ();
			}
		} else {
			return 'parameter error';
		}

		// $cate保留所有
		$cate = array ();
		
		// 循环搜索所有分类结果
		foreach ( $type as $v ) {
			// 搜索当前类别的code字段
			$code_arr = explode ( ',', rtrim ( $v ['code'], ',' ) );
			// $key:参数$parent_id在code数组中的位置
			$key = array_search ( $parent_id, $code_arr );
			
			if ($depth == 0) {
				$cate [$v ['id']] =$v;
				$cate [$v ['id']]["pid"]=$v['parent'];
			} else {
				// 只保留$depth个深度的分类
				if (! isset ( $code_arr [$key + $depth + 1] )) {
					$cate [$v ['id']] =$v;
					$cate [$v ['id']]["pid"]=$v['parent'];
				}
			}
		}
		return tree_gen ( $cate );
	}
	function tree_gen($items) { // 生成类别树
		$tree = array ();
		foreach ( $items as $v ) {
			if (isset ( $items [$v ['pid']] )) {
				$items [$v ['pid']] ['son'] [] = &$items [$v ['id']];
			} else {
				$tree [] = &$items [$v ['id']];
			}
		}
		return $tree;
	}
	/**

	* 导航获取

	**/
	function neidiao($a=0,$b=1,$c=1){
		switch ($b) {
			case 1:
				$where=array('parent'=>$a,'flag'=>1);
				$data=M('nav')->where($where)->order("`order`")->select();
				return neidiao_arr($data,$b,$c);
				break;
			case 2:
				$where=array('parent'=>$a);
				$data=M('nav')->where($where)->order("`order`")->select();
				return neidiao_str($data,$b,$c);
				break;
			case 3:
				$where=array('parent'=>$a);
				$data=M('nav')->where($where)->order("`order`")->select();
				return neidiao_in($data,$b,$c);
				break;
			case 4:
				$where=array('parent'=>$a,'flag'=>1);
				$data=M('nav')->where($where)->order("`order`")->select();
				return neidiao_arr2($data,$b,$c);
				break;
			default:
				$where=array('parent'=>$a);
				$data=M('nav')->where($where)->order("`order`")->select();
				return neidiao_arr($data,$b,$c);
				break;
		}
	}
	//返回数组格式
	function neidiao_arr($data,$b,$c)
	{
		//$arr=array();
		foreach ($data as $k => $v) {
			$arr[$k]=$v;
			$arr[$k]['cun']=neidiao($v['id'],$b,$c+1);
		}
		return $arr;
	}
	//返回数组格式（取分类）
	function neidiao_arr2($data,$b,$c)
	{
		foreach ($data as $k => $v) {
			$arr[$k]=$v;
			$arr[$k]['cun']=neidiao($v['id'],$b,$c+1);
			if($v['sur']){
				$cun=type_tree ($v['sur'],0);
				$cun=$cun[0];
				$ty=M('type')->where(array("id"=>$cun['id']))->find();
				$ty=substr($ty['code'],0,1);
				switch ($ty) {
					case 1:
							$ty="news";
						break;
					case 2:
							$ty="product";
						break;
					default:
							$ty="";
						break;
				}
				if($cun){
					if($arr[$k]['cun']){
						$arr[$k]['cun']=array_merge($arr[$k]['cun'],neidiao_arr2_fun($cun['son'],$ty));
					}else{
						$arr[$k]['cun']=neidiao_arr2_fun($cun['son'],$ty);
					}
				}
			}

		}
		return $arr;
	}
	//返回用,相隔格式
	function neidiao_in($data,$b,$c)
	{
		foreach ($data as $k => $v) {
			$arr.=$v['id'].',';
			$arr.=neidiao($v['id'],$b,$c+1);
		}
		return $arr;
	}
	//返回<span></span>格式
	function neidiao_str($data,$b,$c)
	{
		foreach ($data as $k => $v) {
			$v['name']=sprintf('<span class="cun-%s">%s</span>',$c,$v['name']);
			$arr[]=$v;
			$ret=neidiao($v['id'],$b,$c+1);
			if($ret){
				$arr=array_merge($arr,$ret);
			}
			

		}
		return $arr;
	}
	function neidiao_arr2_fun($arr,$b){
		$ok_arr=array();
		foreach ($arr as $k => $v) {
			$ok_arr[$k]['url']=$b.'/type/'.$v['id'];
			//$ok_arr[$k]['tid']=$b.$v['id'];
			$ok_arr[$k]['name']=$v['name'];
			if(count($v['son'])){
				$ok_arr[$k]['cun']=neidiao_arr2_fun($v['son'],$b);
			}else{
				$ok_arr[$k]['cun']='';
			}
		}
		return $ok_arr;
	}
	/**

	*删除目录下的文件

	**/
	function del_dir($dir){
		 //先删除目录下的文件：
		 $dh=opendir($dir);
		 while($file=readdir($dh)){
		     if($file!="."&&$file!=".."){
		         $fullpath=$dir."/".$file;
		         if(!is_dir($fullpath)){
		             unlink($fullpath);
		         }
		     }
		      
		 }
		 closedir($dh); 
		}
?>