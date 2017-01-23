<?php
/**
 * 后台产品分类管理
 * Enter description here ...
 * @author Administrator
 *
 */
class GoodsAction extends BaseAction {
	public function __construct() {
		parent::__construct ( 'Goods', 'Goods' );
	}
	//产品列表
	public function index() {
		 $this->_where="`flag`='0'";
		 parent::index_cate ();
	}
	//回收站
	public function deltd() {
		$this->_where="`flag`='1'";
		parent::index_cate ('recycle');
	}
	function get_newfilename($filename) {
		$now = time ();
		$image_fix = end ( explode ( '.', $filename ) );
		$img_suiji = rand ( 20, 250 );
		$rename = $now . "$img_suiji" . "." . $image_fix;
		return $rename;
	}
	/**
	 * 批量修改标题
	 * 
	 */
	function piliangname($template = null,$is_thumb=1) {
		$this->select_category ();
		$this->assign ( 'title_type', '批量修改文件名' );
		if ($_POST) {
			$pid=$_POST[pid];
			$texh=$_POST[title];
			$pstyle=$_POST[pstyle];
			$goods=M('goods')->where("`pid`='$pid' and `flag`='0'")->order(" `order` desc,`id` desc")->field('id')->select();
			$flag=0;
			foreach ($goods as $k=> $v){
				$flag++;
				$pad=str_pad($flag,3,"0",STR_PAD_LEFT);
				switch ($pstyle) {
					case '2':
						$v[title]=$texh."-".$pad;	
						break;
					case '3':
						$v[title]=$texh."_".$pad;	
						break;
					case '4':
						$v[title]=$pad."_".$texh;
						break;
					case '5':
						$v[title]="(".$pad.")".$texh;
						break;
					default:
						$v[title]=$texh."(".$pad.")";	
						break;
				}
				M('goods')->save($v);
			}
			$url = '__GROUP__/' . $this->_action_name . '/piliangname';
			$this->success ( '修改成功', $url, C ( 'JUMP_TIME' ) );
			exit;
		}
		if ($template == null) {
			$this->display ();
		} else {
			$this->display ( $template );
		}
	}

	/*
		新版批量上传
	*/

	public function piliang( ){
		// $count=M("pinpai")->count();
		// $pinpai=M("pinpai")->select();
		// $this->assign("count",$count);
		// $this->assign("pinpai",$pinpai);
        $this->select_category( );
        $this->display( );
        
    }

    public function piliang1(){
    	if ( $_FILES['file_data']['name'] != "" ){
            $up_name = $_FILES['file_data']['name'];
            $up_name_ext = pathinfo( $up_name, PATHINFO_EXTENSION );
            $up_name = str_replace( ".".$up_name_ext, "", $up_name );
            $save_arr = $this->UploadFile( );

            $save_name = $save_arr[1];
            $pid = $this->_post( "pid" );
           // $pingpai=$this->_post( "pingpai" );
            $title=$this->_post( "title" );
           	if(empty($title)) $title = $up_name;
            $data = array(
	            "pid" => $pid,
	            "title" => $title,
	            "img" => $save_name,
	            "order"=>"255"
	            // "pinpai" => $pingpai,
	            // "img1" => $save_name
            );
            $data=array_filter($data);

            if ( !$this->_model->add( $data ) ){
                del_image( $save_name );
            }
        }
    }











	//修改情况
	function ajax_goods_save() {
		switch ($_REQUEST ['t']) {
			case 'yes':
				$where=array('id'=>array('in',implode(',',$_REQUEST['id'])));
				if(!$where['id'][1]){
					$where['id'][1]=$_REQUEST['id'];
				}
				$save=array($_REQUEST['ty']=>1);
				
				$data = M('goods')->where($where)->save ($save);
				$this->ajaxReturn ($data, 'JSON');
			break;
			case 'no':
				$where=array('id'=>array('in',implode(',',$_REQUEST['id'])));
				if(!$where['id'][1]){
					$where['id'][1]=$_REQUEST['id'];
				}
				$save=array($_REQUEST['ty']=>0);
				$data = M('goods')->where($where)->save ($save);
				$this->ajaxReturn ($data, 'JSON' );
			break;
		}
	}
	function ajax_goods_del() {
		//修改图片
		switch ($_REQUEST ['t']) {
			//删除一个
			case 'del_imgs':
				$where=array('id'=>$_REQUEST ['id']);
				$save=array('imgs'=>$_REQUEST ['imgs']);
				$data=$this->_model->where($where)->save($save);
				//array_intersect()
				if ($data) {
					if($_REQUEST ['img']){
						$dir=ROOT .'/'. C ( 'UPLOAD_DIR' ). 'imgs'.'/' .$_REQUEST ['id'].'/'.$_REQUEST ['img'];
						unlink($dir);
					}
					$data=array(
							'code'=>1,
							'data'=>array(
								'name'=>'删除成功'
								)
						);
					$this->ajaxReturn ($data, 'JSON');
				} else {
					$data=array(
							'code'=>0,
							'data'=>array(
								'name'=>'删除失败'
								)
						);
					$this->ajaxReturn ( $data, 'JSON');
				}
			break;
			case 'del_imgs_all':
				//删除全部
			if($_REQUEST ['id']){
				$where=array('id'=>$_REQUEST ['id']);
				$save=array('imgs'=>'');
				$data=$this->_model->where($where)->save($save);
				if ($data) {
					$dir=ROOT .'/'. C ( 'UPLOAD_DIR' ). 'imgs'.'/' .$_REQUEST ['id'];
					del_dir($dir);
					$data=array(
							'code'=>1,
							'data'=>array(
								'name'=>'删除成功'
								)
						);
					$this->ajaxReturn ($data, 'JSON');
				} else {
					$data=array(
							'code'=>0,
							'data'=>array(
								'name'=>'删除失败'
								)
						);
					$this->ajaxReturn ($data, 'JSON');
				}
			}else{
				$dir=ROOT .'/'. C ( 'UPLOAD_DIR' ). 'imgs';
				del_dir($dir);
			}
			break;
			case 'del_img':
			//删除图片
			if($_REQUEST ['id']){
				$where=array('id'=>$_REQUEST ['id']);
				$save=array('img'=>'');
				$data=$this->_model->where($where)->save($save);
				if ($data) {
					$this->del_image($_REQUEST ['img']);
					$data=array(
							'code'=>1,
							'data'=>array(
								'name'=>'删除成功'
								)
						);
					$this->ajaxReturn ($data, 'JSON');
				} else {
					$data=array(
							'code'=>0,
							'data'=>array(
								'name'=>'删除失败'
								)
						);
					$this->ajaxReturn ($data, 'JSON');
				}
			}
			break;
			
		}
		
		M('goods')->save($_POST);
		exit();
	}

	/**
	 * 批量上传产品
	 *
	 *
	 */
	function piliangedit($template = null,$is_thumb=1) {
		// 手机上传图片路径
		$dir_thumb = C ( "UPLOAD_DIR_M" );
		// 批量上传开始
		if ($_POST) {
			import ( 'ORG.Util.Image' );
			$Image = new Image ();
			
			// 读取图片列表
			$dir = C ( 'UPLOAD_PILIANG' );
			$files = @scandir ( $dir );
			// print_r($_POST);
			// ////////////////////////////////////////////////////////////////////////////
			$cpimg = $_POST [upfile];
			// 上传文件目录
			$fiedir = C ( 'UPLOAD_DIR' );
			$inum=(int)$_REQUEST [num];
			foreach ( $cpimg as $cpimgname ) {
				$cname = $files [$cpimgname];
				if (file_exists ( $dir . "/" . $files [$cpimgname] ) && $files [$cpimgname] != '') {
					// 老文件名，可用于产品标题
					$oldname = iconv ( 'gb2312', 'utf-8', $files [$cpimgname] );
					$tempoldname = explode ('.',$oldname);
					if ($tempoldname [0]) {
						$oldname = $tempoldname[0];
					}
					// 新文件名
					$newname = $this->get_newfilename ( $files [$cpimgname] );
					$item = array ();
					// 栏目id
					$item [pid] = $_REQUEST [pid];
					$item [img] = $newname;
					$item[order]= $_REQUEST [order];
					if($_REQUEST[wc]=='0'){
					//使用文件名作为标题	
						$item [title] = $oldname;
					}else {
						$item [title] =$_REQUEST[title]."(".$inum.")";
					}
					$inum++;
					$item [is_delete] = 0;
					if ($this->_model->create ()) {
						$id = $this->_model->add ( $item );
						if ($id) {
							// 移动文件到upload目录
							// echo $dir."/".$files [$cpimgname]."====".$fiedir.
							// $newname;
							if ($dir) {
								rename ( $dir . "/" . $files [$cpimgname], $fiedir . $newname );
							}
							//判断是否生成一张正方形的缩略图
							if(C('UPLOAD_RESIZ')==1){
								ImageResize ($fiedir. $newname , C('BRE_W'), C('BRE_H'), $fiedir .'in_'.$newname);
								$c = $Image->thumb ( $fiedir. $newname,C ( 'BRE_W' ), C ( 'BRE_H' ), $fiedir .'im_'.$newname );
							}
							// 手机缩略图
							if ($is_thumb) {
								$d = $Image->thumb ( $fiedir . $newname, $dir_thumb . $newname, '', 800, 480 );
								$s = $Image->thumb ( $fiedir . $newname, $dir_thumb . 'm_' . $newname, '', 110, 83 );
							}
							// copy($fiedir. $newname,$fiedir."m/".$newname);
						} else {
							$this->error ( '批量上传数据库操作出错。' );
						}
					} else {
						$this->error ( $this->_model->getError () );
					}
					// 产生新随机文件名
				}
			}
			$url = '__GROUP__/' . $this->_action_name . '/Index';
			$this->success ( '添加成功', $url, C ( 'JUMP_TIME' ) );
			exit ();
		}
		// 读取图片列表
		$dir = C ( 'UPLOAD_PILIANG' );
		$files = @scandir ( $dir );
		for($i = 2; $i < count ( $files ); $i ++) {
			$files [$i] = iconv ( 'gb2312', 'utf-8', $files [$i] );
			$itme [filename] = $files [$i];
			$itme [subid] = $i;
			$files2 [] = $itme;
		}
		$this->assign ( 'files', $files2 );
		$this->select_category ();
		$this->assign ( 'title_type', '批量上传' );
		if ($template == null) {
			$this->display ();
		} else {
			$this->display ( $template );
		}
	}
}