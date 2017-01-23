<?php
/**
 * 后台其他功能
 * Enter description here ...
 * @author Administrator
 *
 */
class SkrAction extends BaseAction {
	public function __construct() {
		parent::__construct ( 'Skr', 'Skr' );

	}
	/**
	 
	 * 批量修改标题
	 
	 */
	function utitle($template = null,$is_thumb=1) {
		$this->setAction('Goods');
		$this->select_category ();
		$this->assign ( 'title_type', '批量修改文件名' );
		if ($_POST) {
			$pid=$_POST[pid];
			$texh=$_POST[title];
			$dig=$_POST[dig];
			$origi=$_POST[origi];
			$where=array();
			$where[flag]=0;
			if($_POST[sf]){
				$pid=explode(",",getTypeID($pid));
			}
			function cmm($goods,$flag,$dig,$texh){
				foreach ($goods as $k=> $v){
					$type=M('type')->find($v['pid']);
					$pad=str_pad($flag,$dig,"0",STR_PAD_LEFT);
					$v['title']=sprintf($texh,$pad,$type['name'],$v['title']);
					M('goods')->save($v);
					$flag++;
				}
			}
			if(is_array($pid)){
				foreach ($pid as $key => $value) {
					$where[pid]=$value;
					$goods=M('goods')->where($where)->order("`order` desc,`id` desc")->select();
					$flag=$origi;
					cmm($goods,$flag,$dig,$texh);
				}
			}else{
				$where[pid]=$pid;
				$goods=M('goods')->where($where)->order("`order` desc,`id` desc")->select();
				$flag=$origi;
				cmm($goods,$flag,$dig,$texh);
			}
			
			
			

			$url = '__GROUP__/skr/utitle';
			$this->success ( '修改成功', $url, C ( 'JUMP_TIME' ) );
			exit;
		}
		if ($template == null) {
			$this->display ();
		} else {
			$this->display ( $template );
		}
	}
	
	/**

	 * 产品分类
	 
	 */
	function fenlei($template = null,$is_thumb=1) {
		$type=type_tree(2,0);
		$type[0]['types']='goods';
		$this->assign("type",$type[0]);
		$this->assign("json_type",json_encode($type[0]));
		$this->display ();
	}
	function fenlei_ac($template = null,$is_thumb=1) {
		$type=type_tree(1,0);
		$type[0]['types']='article';
		$this->assign("type",$type[0]);
		$this->assign("json_type",json_encode($type[0]));
		$this->display ('fenlei');
	}
		function ajax_fenlei($template = null,$is_thumb=1) {
		$data=array("return"=>false);
		$list=array();
		if($_REQUEST["type"]=="goods"){
			$list["type"]=2;
		}elseif($_REQUEST["type"]=="article"){
			$list["type"]=1;
		}
		if($list["type"]){
			//判断操作类型
			switch ($_REQUEST["cz"]) {
				//修改
				case 'up':
					$this->setAction('Goods');
					$id=(int)$_REQUEST["id"];
					if($id){
						if($_REQUEST["pid"]){
							$list["name"]=$_REQUEST["name"];
							$list["parent"]=(int)$_REQUEST["pid"];
							$list["aid"]=(int)$_REQUEST["aid"];
							$list["order"]=(int)$_REQUEST["order"];
						}else{
							$list["name"]=$_REQUEST["name"];
						}
						$data["return"]=M("type")->where("`id`=$id")->save($list) && skr_code($id);
						$type=type_tree($list["type"],0);
						$data["cun"]=$type[0];
					}
					//z($data);
					break;
				//新增
				case 'in':
					if($_REQUEST["onnum"]){
						$name=explode(",",$_REQUEST["name"]);
						$list["parent"]=(int)$_REQUEST["pid"];
						$list["order"]=(int)$_REQUEST["order"];
						$list["aid"]=(int)$_REQUEST["aid"];
						foreach ($name as $key => $value) {
							$list["name"]=$value;
							$data["return"]=M("type")->add($list);
							skr_code($data["return"]);
						}
					}else{
						$list["name"]=$_REQUEST["name"];
						$list["parent"]=(int)$_REQUEST["pid"];
						$list["aid"]=(int)$_REQUEST["aid"];
						$list["order"]=(int)$_REQUEST["order"];
						$data["return"]=M("type")->add($list);
						skr_code($data["return"]);
					}
					
					break;
				//删除
				case 'de':
					$id=(int)$_REQUEST["id"];
					$pid=(int)$_REQUEST["pid"];
					if($id){
						$data["return"]=M("type")->where("(`code` like '%,$id,%' or `code` like '%$id,%') and `id` not in(1,2,3,4,5,15)")->delete();
					}elseif($pid){
						$data["return"]=M("type")->where("(`code` like '%,$pid,%' or `code` like '%$pid,%') and `id`<>$pid ")->delete();
					}
					break;
				default:
					break;
			}
		}
		$this->ajaxReturn($data,'JSON');
	}
	/**

	*调用

	*/
	function call() {
		$list=M("call")->select();
		$this->assign("list",$list);
		//$this->assign("json_type",json_encode($type[0]));
		$this->display ();
	}
	function ajax_call() {
		$data=array("return"=>false);
		if($_REQUEST){
			$bd=M("call");
			$lits=$_REQUEST;
			
			switch ($lits["cz"]) {
				//修改
				case 'up':
					unset($lits['cz']);
					$data["return"]=$bd->save($lits);
					$data["cun"]='修改成功';
					break;
				//新增
				case 'in':
					unset($lits['cz']);
					unset($lits['id']);
					$data["return"]=$bd->add($lits);
					$data["cun"]='添加成功';
					break;
				//删除
				case 'de':
					$data["return"]=$bd->where("`id`=$lits[id]")->delete();
					$data["cun"]='删除成功';
					break;
				default:
					$data["cun"]='无此操作';
					break;
			}
		}

		$this->ajaxReturn($data,'JSON');
	}
	/**

	 * 批量上传产品
	 
	 */
	function ajax_upgoods(){
		$this->setAction('Goods');
		$this->select_category ();

		switch ($_GET['cz']) {
			case 'up':
				import ( 'ORG.Util.Image' );
				//$_GET['cpimgname'];
				$dir=iconv ( 'utf-8', 'gb2312',$_GET['dir']);
				$dir = C ( 'UPLOAD_PILIANG' ).($dir?'/'.$dir:'');
				$fiedir = C ( 'UPLOAD_DIR' );
				$dir_thumb =  C ( "UPLOAD_DIR_M" );
				$imgname=iconv ( 'utf-8', 'gb2312',$_GET['imgname'] );
				$Ppid=$_GET['pid'];
				$new_name=$_GET['nname'];
				$Image = new Image ();
				//$new_name=s_fun1($new_name,$m_type['name']);
				$data=skr_plsr($imgname,$dir,$fiedir,$Ppid,$new_name,$Image,$dir_thumb);
				break;
			case 'cj':
				$iname=$_GET['pname'];
				$Ppid=$_GET['pid'];
				$ppid=getTypeID($Ppid);
				$ptype=M('type')->where("`name`='$iname' and `id` in ($ppid)")->find();
				if($ptype){//判断是否创建新子类
					$data['id']=$ptype['id'];
				}else{
					$type=array("order"=>255,"type"=>2,"flag"=>0);
					$type['name']=$iname;
					$type['parent']=$Ppid;
					$type['aid']=be_dy($iname);
					$Ppid=M('type')->add($type);//获取新建分类id
					skr_code($Ppid);//更新分类code
					$data['id']=$Ppid;
				}
				break;
			case 'sc':
				$dir = C ( 'UPLOAD_PILIANG' );
				$cpimg =skr_dir($dir,false);
				
				function delDirAndFile( $cpimg ,$dir)  
				{  
					foreach ( $cpimg['sim2'] as $cpimgname ) {//目录图片上传
						if(!in_array($cpimgname['size'][2],array(1,2,3))){
							unlink($dir."/".$cpimgname['img']);
						}
					}
					foreach ( $cpimg['sim1'] as $cpimgname ) {
						$dir2=$dir.'/'.$cpimgname['name'];
						
						delDirAndFile($cpimgname['imgs'],$dir2);

						rmdir($dir2);
					}
					return 1;
				}  
				$data["cun"]=delDirAndFile($cpimg,$dir);
				break;
			default:
				# code...
				break;
		}
		$this->ajaxReturn($data,'JSON');

		

		
	}
	function upgoods($template = null,$is_thumb=1) {
		function s_fun1($a,$b){
        	switch ($_REQUEST ['wc']) {
				case '1':
					$a=$b;
					break;
				default:
					break;
			}
			return $a;
		}
		$this->setAction('Goods');
		$this->select_category ();
		// 手机上传图片路径
		$dir_thumb =  C ( "UPLOAD_DIR_M" );
		$dir = C ( 'UPLOAD_PILIANG' );
		//z(skr_dir($dir));
		// 批量上传开始
		if ($_POST) {
			import ( 'ORG.Util.Image' );
			$Image = new Image ();
			// 读取图片列表
			$cpimg =skr_dir($dir,false);//获取根目录下upload的文件及目录
			// 上传文件目录
			$fiedir = C ( 'UPLOAD_DIR' );
			// $Inum=(int)$_REQUEST [num];
			// $Inum1=$Inum;
			$Ppid=$_REQUEST [pid];//获取当前选择分类id
			//$ppid=getTypeID($Ppid);
			//z($_POST);
			$new_name=$_REQUEST[title];
			if($_REQUEST [pname]){//判断是否创建新子类
				$type=array("order"=>255,"type"=>2,"flag"=>0);
				$type['name']=$_REQUEST [pname];
				$type['parent']=$Ppid;
				$Ppid=M('type')->add($type);//获取新建分类id
				skr_code($Ppid);//更新分类code
			}
			$m_type=M('type')->where("`id`=$Ppid")->find();
			$new_name=s_fun1($new_name,$m_type['name']);
			function tpsc($cpimg,$fiedir,$Ppid,$dir,$new_name,$Image,$dir_thumb)
			{
				$Inum=(int)$_REQUEST [num];
				foreach ( $cpimg['sim2'] as $cpimgname ) {//目录图片上传
					if(in_array($cpimgname['size'][2],array(1,2,3))){
						skr_plsr($cpimgname['img'],$dir,$fiedir,$Ppid,skr_new_name($new_name,$Inum),$Image,$dir_thumb);//上传图片方法在funskr.php内
						$Inum=$Inum?++$Inum:'';
					}else{
						unlink($dir."/".$cpimgname['img']);
					}
				}
				foreach ( $cpimg['sim1'] as $cpimgname ) {//文件夹图片上传
					$dir2=$dir.'/'.$cpimgname['name'];
					$iname=iconv ( 'gb2312', 'utf-8', $cpimgname['name'] );
					$ppid=getTypeID($Ppid);
					$ptype=M('type')->where("`name`='$iname' and `id` in ($ppid)")->find();
					if($ptype){
						$upid=$ptype[id];
					}else{
						$type=array("order"=>255,"type"=>2,"flag"=>0);
						$type['name']=iconv ( 'gb2312', 'utf-8', $cpimgname['name'] );
						$type['parent']=$Ppid;
						$upid=M('type')->add($type);
						skr_code($upid);
					}
					$m_type2=M('type')->where("`id`=$upid")->find();
					$new_name2=s_fun1($new_name,$m_type2['name']);
					tpsc($cpimgname['imgs'],$fiedir,$upid,$dir2,$new_name2,$Image,$dir_thumb);
					rmdir($dir2);//删除空目录
				}
			}
			tpsc($cpimg,$fiedir,$Ppid,$dir,$new_name,$Image,$dir_thumb);
			$url = '__GROUP__/Skr/upgoods';
			$this->success ( '添加成功', $url, C ( 'JUMP_TIME' ) );
			exit ();
		}
		// 读取图片列表

		$this->assign ( 'files', skr_dir($dir));
		$this->assign ( 'title_type', '批量上传' );
		if ($template == null) {
			$this->display ();
		} else {
			
			$this->display ( $template );
		}
		
	}

		/**

	 * 导航
	 
	 */
	function s_nav($value='')
	{
		//z(neidiao(0,2));
		if($_POST){
			$list=$_POST;
			if($list['onnum']){
				$_POST['name']=explode(',',$list['name']);
				$list=array();
				foreach ($_POST['name'] as $k => $v) {
					$list[$k]=$_POST;
					$list[$k]['name']=$v;
				}
				M('nav')->addall($list);
			}else{
				M('nav')->add($list);
			}
			
		}


		$this->assign ( 'list', neidiao(0,2));
		$this->display ();
	}
	function ajax_s_nav($value='')
	{
		$data=array("return"=>false);
		if($_REQUEST){
			$bd=M("nav");
			$lits=$_REQUEST;
			
			switch ($lits["cz"]) {
				//修改
				case 'up':
					unset($lits['cz']);
					if(isset($lits["flag"])){
						$where=array( 
								'id'=>array(
									'in',implode(',',$lits["id"])
								)
							);
						$save=array('flag'=>$lits["flag"]);
						$data["return"]=$bd->where($where)->save($lits);
					}else{
						$data["return"]=$bd->save($lits);
					}
					if($data["return"]){
						$data["cun"]='修改成功';
					}else{
						$data["cun"]='修改失败';
					}
					break;
				//新增
				case 'in':
					unset($lits['cz']);
					unset($lits['id']);
					$data["return"]=$bd->add($lits);
					$data["cun"]='添加成功';
					break;
				//删除
				case 'de':
					$where=array(
						"id"=>array(
							'in',neidiao($lits[id],3).$lits[id]
						)
					);
					$data["return"]=$bd->where($where)->delete();
					$data["cun"]='删除成功';
					break;
				default:
					$data["cun"]='无此操作';
					break;
			}
		}
		$this->ajaxReturn($data,'JSON');
	}
			/**

	 * ajax
	 
	 */
	//相册上传ajax
	function upload_ajax($value='')
	{

		$targetFolder =ROOT.'/'.C('UPLOAD_DIR'); 
		$targetPath = $targetFolder."imgs";//相册图片上传目录
		mkdir($targetPath);//创建文件
		//如果有id就创建文件夹
		if($_REQUEST['id']!=0){
			$targetPath .= '/'.$_REQUEST['id'];
			mkdir($targetPath);
		}
		//print_r($_POST);
		$verifyToken = md5('unique_salt' . $_POST['timestamp']);

		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
			$tempFile = $_FILES['Filedata']['tmp_name'];//获取上传文件缓存名称
			$fileTypes = array('jpg','jpeg','gif','png'); //支持图片格式
			$fileParts = pathinfo($_FILES['Filedata']['name']);//图片信息
			$new_name=time().'-'.rand(0,10000).'.'.$fileParts['extension'];//(重命名：当前日期+0到10000随机数+后缀)
			$targetFile = rtrim($targetPath,'/') . '/' .$new_name ;
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				print_r($new_name);//返回数据
			} else {
				print_r(false);//返回数据
			}
		}

	}

	
}