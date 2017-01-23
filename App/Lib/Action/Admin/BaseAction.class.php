<?php
/**
 * 后台管理基础框架
 * Enter description here ...
 * @author Administrator
 *
 */
class BaseAction extends CommonAction {
	/**
	 * 执行操作的ACTION名称
	 * Enter description here .
	 *
	 *
	 * ..
	 * ACTION初始化时需要设置动作名称
	 *
	 * @var unknown_type
	 */
	protected $_action_name;
	
	/**
	 * 和ACTION关联的MODEL名称
	 * Enter description here .
	 *
	 *
	 * ..
	 * ACTION初始化时需要设置关联的模型名称
	 *
	 * @var unknown_type
	 */
	protected $_model_name;
	
	/**
	 * MODEL模型
	 * Enter description here .
	 *
	 *
	 * ..
	 *
	 * @var unknown_type
	 */
	protected $_model;
	
	/**
	 * 基础分类名称
	 * Enter description here .
	 *
	 *
	 * ..
	 * 主要目的是获取分类列表使用
	 *
	 * @var unknown_type
	 */
	protected $_categroy = array (
			'Article' => '1',
			'Goods' => '2',
			'Jobs' => '3' 
	);
	/**
	 * 条件查询
	 * Enter description here .
	 *
	 *
	 * ..
	 *
	 * @var unknown_type
	 */
	protected $_where;
	
	/**
	 * 构造函数
	 * Enter description here .
	 *
	 *
	 * ..
	 *
	 * @param unknown_type $classs_name
	 *        	子类名称
	 */
	function __construct($action_name = NULL, $model_name = NULL) {
		// 检测用户是否登录
		$this->check_user ();
		$this->assign ( 'ie', C('IE') );
		$this->assign ( 'username', $_SESSION ['username'] );
		$this->assign ( 'empty', '<tr><td  align="center" colspan="10">本栏目暂时没有数据</td></tr>' );
		// 初始化
		if ($action_name == null)
			die ( 'Forbidden' );
		else {
			$this->_action_name = $action_name;
			$this->_model_name = $model_name;
			$this->_model = D ( $this->_model_name );
			$this->assign ( 'action', $this->_action_name );
			// 读取栏目开关
			// 公司介绍
			// $this->assign('switch_introduction',$this->config('switch_introduction'));
			// 新闻中心
			// $this->assign('switch_order', $this->config('switch_news'));
			// 联系我们
			// $this->assign('switch_contactus',
			// $this->config('switch_contactus'));
			$this->assign ( 'switch_order', $this->config ( 'switch_order' ) );
			$this->assign ( 'switch_message', $this->config ( 'switch_message' ) );
			$this->assign ( 'switch_jobs', $this->config ( 'switch_jobs' ) );
		}
	}
	
	/**
	 * 动态设置控制器
	 * Enter description here .
	 *
	 *
	 * ..
	 *
	 * @param unknown_type $actionName        	
	 */
	function setAction($actionName) {
		$this->_action_name = $actionName;
	}
	
	/**
	 * 设置关联模型
	 * Enter description here .
	 *
	 *
	 * ..
	 *
	 * @param unknown_type $modelnName        	
	 */
	function setModel($modelnName) {
		$this->_model_name = $modelnName;
		$this->_model = D ( $this->_model_name );
	}
	
	/**
	 * 默认列表页面
	 * Enter description here .
	 *
	 *
	 * ..
	 */
	function index($template = null, $cate = 0) {
		import ( 'ORG.Util.Page' );
		$count = $this->_model->where ( $this->_where )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', '<span>%totalRow% %header% %nowPage%/%totalPage% 页</span>  %first%  %upPage% %linkPage%  %downPage% %end% %select%' );
		$show = $Page->show (); // 分页显示输出
		
		$list = $this->_model->where ( $this->_where )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		//echo $this->_model->getLastSql();
		// 遍历判断注册用户的留言
		foreach ( $list as $key => $value ) {
			// 注册用户的留言!
			if ($value [uid]) {
				$list [$key] [name] = '<font color="red">登陆用户 id:</font>' . $value [uid];
			}
		}
		// echo $this->_model->getlastsql();
		// print_r($list);
		$this->assign ( 'list', $list ); // 赋值数据集
		//print_r($list);
		$this->assign ( 'page', $show ); // 赋值分页输出
		if ($template == null) {
			$this->display ();
		} else {
			$this->display ( $template );
		}
	}
	
	/**
	 * 基础添加方法
	 * Enter description here .
	 *
	 *
	 * ..
	 */
	function add($template = null) {
		if ($_POST) {
			$this->_model->create ();
			if ($_FILES ['img'] ['size'] != 0) {
				$img_name = $this->UploadFile ();
				$s=count($img_name);
				$_POST ['img'] = $img_name [1];
			 }
			//产品添加 产品分栏目
			if($_POST[goodsck]=='1'){
				unset($_POST[goodsck]);
				$_POST[is_hot]=$_POST[is_hot]?$_POST[is_hot]:0;
				$_POST[is_best]=$_POST[is_best]?$_POST[is_best]:0;
				$_POST[is_new]=$_POST[is_new]?$_POST[is_new]:0;	
			}
			if ($this->_model->create ()) {
				$id = $this->_model->add ( $_POST );
				if ($id) {
					$url = '__GROUP__/' . $this->_action_name . '/Index';
					//相册图移动
					if($_POST['imgs']){
						$_POST['imgs']=explode(',',$_POST['imgs']);
						$dir=C('UPLOAD_DIR')."/imgs/";
						$fiedir=$dir.$id.'/';
						mkdir($fiedir);
						foreach ($_POST['imgs'] as $k => $v) {
							rename ( $dir.$v,$fiedir . $v );
						}
						del_dir($dir);
					}
					$this->success ( '添加成功', $url, C ( 'JUMP_TIME' ),0);
				} else {
					$this->error ( '添加失败' );
				}
			} else {
				$this->error ( $this->_model->getError () );
			}
			exit ();
		}
		
		$search = array (
				'value' => 'title' 
		);
		
		$this->assign ( 'search', $search );
		$this->select_category ();
		$this->assign ( 'title_type', '新增' );
		$this->assign('selected',$_GET['type']);
		if ($template == null) {
			$this->display ( 'edit' );
		} else {
			$this->display ( $template );
		}
		// $this->display('edit');
	}
	
	/**
	 * 基础编辑方法
	 * Enter description here .
	 *
	 *
	 * ..
	 */
	function edit($template = null) {

		if(count($_REQUEST ['id'])==1){
			$_REQUEST ['id']=intval($_GET[id])==1?$_GET ['id'][0]:$_GET ['id'];
			$info=D ( $this->_model_name )->find ( $_REQUEST ['id']);
			$this->assign('selected',$info["pid"]);
		}else{
			$info['id']=implode(",",$_REQUEST ['id']);
		}
		if ($_POST) {

			if ($_FILES ['img'] ['size'] != 0) {
				$img_name = $this->UploadFile ();
				$_POST ['img'] = $img_name [1];
			}

			if ($this->_model->create ()) {
				$ids=$_POST['id'];
				$_POST=$this->pil_new($_POST);
				$id = $this->_model->where("`id` in ($ids)")->save ( $_POST );
				if ($id) {
					$url = '__GROUP__/' . $this->_action_name . '/Index';
					$this->success ( '更新成功', $url ,1);
				} else {
					$this->error ( '数据没有保存或没有修改' );
				}
			} else {
				$this->error ( $this->_model->getError () );
			}
			exit ();
		}
		
		$search = array (
				'value' => 'title' 
		);
		$this->select_category ();
		$this->assign ( 'search', $search );
		$this->assign ( 'title_type', '修改' );
		
		
		// if($info['imgs']){
		// 	$info['imgs']=explode(',',$info['imgs']);
		// }
		$this->assign ( 'info', $info );
		if ($template == null) {
			$this->display ();
		} else {
			$this->display ( $template );
		}
	}
	public function pil_new($data)
	{
		
		
		if(!$data['pdid'] && count(explode(',',$data['id']))>1){
			foreach ($data as $key => $value) {
				if(!$value){
					unset($data[$key]);
				}
			}
		}else{
			if($data[goodsck]=='1'){
				unset($data[goodsck]);
				$data[is_hot]=$data[is_hot]?$data[is_hot]:0;
				$data[is_best]=$data[is_best]?$data[is_best]:0;
				$data[is_new]=$data[is_new]?$data[is_new]:0;
			}
		}
		unset($data['id']);
		unset($data['time']);
		return $data;
	}
	/**
	 * 基础详细方法
	 * Enter description here .
	 *
	 * ..
	 */
	function more($template = null) {
		$info = D ( $this->_model_name )->find ( $_REQUEST ['id'] );
		$this->assign ( 'info', $info );
		if ($template == null) {
			$this->display ();
		} else {
			$this->display ( $template );
		}
	}
	
	/**
	 * 基本获取信息方法
	 * Enter description here .
	 *
	 *
	 * ..
	 *
	 * @param unknown_type $template        	
	 */
	function info($template = null) {
		$info = $this->_model->find ( $_REQUEST ['id'] );
		$this->select_category ();
		$this->assign ( 'info', $info );
		if ($template == null) {
			$this->display ();
		} else {
			$this->display ( $template );
		}
	}
	
	/**
	 * 带分类的列表页面
	 * Enter description here .
	 * ..
	 */
	function index_cate($template = '') {
		// import ( 'ORG.Util.Page' );
		// $count = $this->_model->where ( $this->_where )->count (); //
		// 查询满足要求的总记录数
		// $Page = new Page ( $count ); // 实例化分页类 传入总记录数和每页显示的记录数
		// $Page->setConfig ( 'theme', '<span>%totalRow% %header%
		// %nowPage%/%totalPage% 页</span> %first% %upPage% %linkPage% %downPage%
		// %end% %select%' );
		// $show = $Page->show (); // 分页显示输出
		// $list = $this->_model->where ( $this->_where )->order ( 'id' )->limit
		// ( $Page->firstRow . ',' . $Page->listRows )->order ( 'id desc'
		// )->select ();
		$list = $this->_model->where ( $this->_where )->order ( 'id' )->order ( 'id desc' )->select ();
		$result = M ( 'Type' )->select ();
		foreach ( $result as $key => $value ) {
			$category [$value ['id']] = $value ['name'];
		}
		foreach ( $list as $key => $value ) {
			$list [$key] ['cate_name'] = $category [$value ['pid']];
		}
		$this->select_category ();
		$search = array (
				'name' => 'code',
				'value' => 'title' 
		);
		$this->select_category ();
		$this->assign ( 'search', $search );
		$this->assign ( 'list', $list ); // 赋值数据集
		                                 // $this->assign ( 'page', $show ); //
		                                 // 赋值分页输出
		$this->display ( $template );
	}
	

	/**
	 * Ajax获取数据
	 * Enter description here .
	 *
	 *
	 * ..
	 */
	public function ajax() {
		switch ($_REQUEST ['t']) {
			// 获取不同类型栏目的ajax数据
			case 'del' :
				$where = array (
						'id' => $_REQUEST ['id'] 
				);
				// 删除上传图片
				$info = $this->_model->find ( $_REQUEST ['id'] );
				$this->del_image ( $info ['img'],$_REQUEST ['id']);
				$data = $this->_model->where ( $where )->delete ();
				if ($data) {
					$this->ajaxReturn ( '删除成功', 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '删除失败', 'JSON', 0 );
				}
				break;
			// 删除用户组
			case 'delgroup' :
				$where = array (
						'id' => $_REQUEST ['id'] 
				);
				$counts=M ( 'user' )->where("`gid`='$where[id]'")->count();
				if ($counts==0) {
					$data = M( 'ugroup')->where ( $where )->delete ();
					if (false!==$data) {
						$this->ajaxReturn ( '删除成功', 'JSON', 1 );
						break;
					} 
				}
				$this->ajaxReturn ( '删除失败', 'JSON', 0 );
				break;
			// 获取不同类型栏目的ajax数据
			case 'hid' :
				$where = array (
						'id' => $_REQUEST ['id'] 
				);
				$new [flag] = 1;
				$new [id] = $_REQUEST ['id'];
				$info = $this->_model->save ( $new );
				
				if ($info !== false) {
					$this->ajaxReturn ( '删除成功', 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '删除失败', 'JSON', 0 );
				}
				break;
			case 'recover' :
				$where = array (
						'id' => $_REQUEST ['id'] 
				);
				$new [flag] = 0;
				$new [id] = $_REQUEST ['id'];
				$info = $this->_model->save ( $new );
				
				if ($info !== false) {
					$this->ajaxReturn ( '恢复成功', 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '恢复失败', 'JSON', 0 );
				}
				break;
			
			// 完成订单
			case 'compete' :
				$where = array (
						'id' => $_REQUEST ['id'] 
				);
				
				$info = $this->_model->find ( $_REQUEST ['id'] );
				$info [type] = 1;
				$data = $this->_model->save ( $info );
				if ($data) {
					$this->ajaxReturn ( '完成成功', 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '完成失败', 'JSON', 0 );
				}
				break;
			
			// 设置前台显示
			case 'add_show' :
				$where = array (
						'id' => $_REQUEST ['id'] 
				);
				// 删除上除图片
				$info = $this->_model->find ( $_REQUEST ['id'] );
				$info ['is_show'] = 1;
				$data = $this->_model->save ( $info );
				if ($data) {
					$this->ajaxReturn ( '设置成功', 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '设置失败', 'JSON', 0 );
				}
				break;
			// 启用前台账户
			case 'user_show' :
				$where = array (
						'id' => $_REQUEST ['id'] 
				);
				// 删除上除图片
				$info = $this->_model->find ( $_REQUEST ['id'] );
				$info ['flag'] = 1;
				$data = $this->_model->save ( $info );
				if ($data) {
					$this->ajaxReturn ( '设置成功', 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '设置失败', 'JSON', 0 );
				}
				break;
			// 前台用户账号
			case 'user_hidden' :
				$where = array (
						'id' => $_REQUEST ['id'] 
				);
				// 删除上除图片
				$info = $this->_model->find ( $_REQUEST ['id'] );
				$info ['flag'] = 0;
				$data = $this->_model->save ( $info );
				if ($data) {
					$this->ajaxReturn ( '设置成功', 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '设置失败', 'JSON', 0 );
				}
				break;
			// 设置取消前台显示
			case 'quit_show' :
				$where = array (
						'id' => $_REQUEST ['id'] 
				);
				// 删除上除图片
				$info = $this->_model->find ( $_REQUEST ['id'] );
				$info ['is_show'] = 0;
				
				$data = $this->_model->save ( $info );
				if ($data) {
					$this->ajaxReturn ( '设置成功', 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '设置失败', 'JSON', 0 );
				}
				break;
			case 'batch_del' :
				$where = array (
						'id' => array (
								'in',
								$_REQUEST ['ids'] 
						) 
				);
				$result = $this->_model->where ( $where )->select ();
				foreach ( $result as $key => $value ) {
					$this->del_image ( $value ['img'],$value['id'] );
				}
				$data = $this->_model->where ( $where )->delete ();
				if ($data) {
					$this->ajaxReturn ( '删除成功', 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '删除失败', 'JSON', 0 );
				}
				break;
			case 'batch_recover' :
				$where = array (
						'id' => array (
								'in',
								$_REQUEST ['ids'] 
						) 
				);
				$nwsfl [flag] = 0;
				$data = $this->_model->where ( $where )->save ( $nwsfl );
				if (false !== $data) {
					$this->ajaxReturn ( '批量恢复成功', 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '批量恢复失败', 'JSON', 0 );
				}
				break;
			case 'batch_hid' :
				$where = array (
						'id' => array (
								'in',
								$_REQUEST ['ids'] 
						) 
				);
				$nwsfl [flag] = 1;
				$data = $this->_model->where ( $where )->save ( $nwsfl );
				if (false !== $data) {
					$this->ajaxReturn ( '批量删除成功', 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '批量删除失败', 'JSON', 0 );
				}
				break;
			case 'order' :
				$where = array (
						'id' => $_REQUEST ['id'] 
				);
				// 删除上除图片
				$info = $this->_model->find ( $_REQUEST ['id'] );
				$info ['order'] = ( int ) $_REQUEST ['value'];
				$id = $this->_model->save ( $info );
				if ($id) {
					$this->ajaxReturn ( '修改成功', 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '修改失败', 'JSON', 0 );
				}
				break;
		}
	}
	
	/**
	 * 设置添加查询
	 * Enter description here .
	 *
	 *
	 * ..
	 *
	 * @param unknown_type $where        	
	 */
	protected function setWhere($where) {
		$this->_where = $where;
	}
	
	/**
	 * Enter description here .
	 *
	 * ..
	 */
	
	/**
	 * 上传图片封装
	 * 直接调用就可以返回保存的图片名称,可以上传多个图片返回数组格式
	 * Enter description here .
	 *
	 *
	 * ..
	 *
	 * @param unknown_type $file
	 *        	上传文件名
	 * @param unknown_type $is_watermark
	 *        	是否开启水印
	 * @param unknown_type $is_thumb
	 *        	是否开启缩率图
	 */
	protected function UploadFile($file = '', $is_watermark = '1', $is_thumb = '1') {
		import ( 'ORG.Net.UploadFile' );
		$upload = new UploadFile (); // 实例化上传类
		$upload->maxSize = C ( 'UPLOAD_SIZE' ); // 设置附件上传大小
		$upload->allowExts = C ( 'UPLOAD_TYPE' ); // 设置附件上传类型
		$upload->savePath = C ( 'UPLOAD_DIR' ); // 设置附件上传目录
		
		import ( 'ORG.Util.Image' );
		$Image = new Image ();
		
		$dir = ROOT . '/' . C ( 'UPLOAD_DIR' );
		$dir_thumb = ROOT . '/' . C ( "UPLOAD_DIR_M" );
		
		if ($file == '') {
			if (! $upload->upload ()) { // 上传错误提示错误信息
				$this->error ( $upload->getErrorMsg () );
			} else { // 上传成功 获取上传文件信息
				$info = $upload->getUploadFileInfo ();
			}
			// 水印开关检测
			$result = D ( 'config' )->field ( 'value' )->where ( '`key`="switch_watermark"' )->select ();
			$switch_watermark = $result [0] ['value'];
			
			// 是否有水印图片
			// $result =
			// D('config')->field('value')->where('`key`="web_watermark"')->select();
			// $web_watermark = $result[0]['value'];
			// z($web_watermark);
			
			foreach ( $info as $key => $value ) {
				$result [] = $value ['savename'];
				
				// 上传图片水印处理
				if ($is_watermark && $switch_watermark) {
					// 处理图片水印
					// $Image->water($dir.$value['savename'],$dir.$$web_watermark);
					// 处理文字水印
					$Image->showImg ( $dir . $value ['savename'], $this->config ( 'web_watermark' ) );
				}
				// 判断是否生成一张正方形的缩略图
				if (C ( 'UPLOAD_RESIZ' ) == 1) {
					skr_ImageResize ( $dir . $value ['savename'], C ( 'BRE_W' ), C ( 'BRE_H' ), $dir . 'in_' . $value ['savename'] );
					$c = $Image->thumb ( $dir . $value ['savename'], $dir.'im_' . $value ['savename'],"",C ( 'BRE_W' ), C ( 'BRE_H' ) );
				
				}
				// 是否手机上传缩率图
				if ($is_thumb) {
					$d = $Image->thumb ( $dir . $value ['savename'], $dir_thumb . $value ['savename'], '', 800, 480 );
					$s = $Image->thumb ( $dir . $value ['savename'], $dir_thumb . 'm_' . $value ['savename'], '', 110, 83 );
				}
			}
			
			return $result;
		} else {
			$info = $upload->uploadOne ( $file );
			// 是否手机上传缩率图
			if ($is_thumb) {
				$s = $Image->thumb ( $dir . $info [0] ['savename'], $dir_thumb . $info [0] ['savename'], '', 800, 480 );
			}
			if (! $info) { // 上传错误提示错误信息
				$this->error ( $upload->getErrorMsg () );
			} else { // 上传成功 获取上传文件信息
				return $info;
			}
		}
	}
	
	/**
	 * 检测管理员是否登录
	 * Enter description here .
	 *
	 *
	 * ..
	 */
	private function check_user() {
		if ($_SESSION ['username'] == '') {
			// 没有登录直接跳转登录页面
			header ( "Content-type:text/html;charset=utf-8" );
			redirect ( __ROOT__ . '/Admin/Login' );
			/*
			 * $this->error('您尚未登录！请先登录', '/Admin/Login');
			 */
			exit ();
		}
	}
	
	/**
	 * 删除上传的图片
	 * Enter description here .
	 *
	 *
	 * ..
	 *
	 * @param unknown_type $img_name        	
	 */
	function del_image($img_name,$id=0) {
		import ( 'ORG.Util.File' );
		if($img_name){
			$imgage_dir_name[] = C ( 'UPLOAD_DIR' ) . $img_name;
			$imgage_dir_name[] = C ( 'UPLOAD_DIR' ) ."in_". $img_name;
			$imgage_dir_name[] = C ( 'UPLOAD_DIR' ) ."im_". $img_name;
			$imgage_dir_name[] = C ( "UPLOAD_DIR_M" ) . $img_name;
			$imgage_dir_name[] = C ( "UPLOAD_DIR_M" ) ."m_". $img_name;
			foreach ($imgage_dir_name as $k => $v) {
				unlink ($v);
			}
		}
		if($id){
			$dir=ROOT .'/'. C ( 'UPLOAD_DIR' ). 'imgs'.'/' .$_REQUEST ['id'];
			del_dir($dir);
		}
		return 1;
	}
	protected function select_category() {
		// model中的TypeModel.class.php中
		$category = D ( 'Type' )->select_column ( C ( $this->_action_name ), true );
		// print_r($category);
		$this->assign ( 'category', $category );
		// z($category);
		// $selected = M ( $this->_model_name )->field ( 'pid' )->find ( $_REQUEST ['id'] );
		// $this->assign ( 'selected', $selected );
		return $category;
	}
}