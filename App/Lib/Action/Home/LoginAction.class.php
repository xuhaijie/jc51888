<?php
class LoginAction extends BaseAction {
	function __construct() {
		parent::__construct ();
	}
	
	/**
	 * 登陆页面
	 */
	public function index() {
		if(session ( '?user')){
			$this->success('你已经登录了', __GROUP__.'/Pcenter');
		}else{
			$this->display ();
		}
		
	}
	/**
	 * 注册页面
	 */
	public function register() {
		// Array (
		// [uname] => 用户名
		// [upass] => 密 码
		// [upass2] => 重复密码
		// [verify] => 7
		// )
		$this->display ();
	}
	/*
	*用户登陆弹出框
	*/
	public function dialog(){
		$this->display();
	}
	/**
	 * 注册action
	 */
	public function register_action() {
		$verify = $_POST ['verify'];
		if (md5 ( strtoupper ( $verify ) ) != $_SESSION ['verify']) {
			$this->error ( '验证码有误!' );
		}
		if ($_POST [username] != 'admin' && $_POST [upass] != '' && $_POST [upass] == $_POST [upass2]) {
			$addinfo [username] = $_POST [uname];
			$addinfo [password] = $_POST [upass];
			$u = M ( 'User' )->where ( "`username`='$addinfo[username]'" )->find ();
			
			$url = '__GROUP__/' . $this->_action_name . 'login/register';
			if ($u [id]) {
				$msg = '注册失败,该用户名已存在';
			} else {
				$addinfo[gid]=1;
				$id = M ( 'User' )->add ( $addinfo );
				if ($id) {
					$url = '__GROUP__/' . $this->_action_name . 'login/index';
					$msg = '注册成功';
				} else {
					$msg = '注册失败';
				}
			}
			$this->success ( $msg, $url );
		} else {
			$this->error ( '输入信息有误,请重新注册!' );
		}
	}
	/**
	 * 登陆action
	 */
	public function login() {
		// 登录处理
		if ($_POST) {
			// print_r($_POST);
			$uname = $_POST [uname];
			$upass = $_POST [upass];
			$verify = $_POST ['verify'];
			if (md5 ( strtoupper ( $verify ) ) == $_SESSION ['verify']) {
				$this->loginceck ( $uname, $upass );
			} else {
				$this->error ( '验证码输入错误！' );
			}
		}
		exit ();
	}
	/**
	 * 登出
	 * Enter description here ...
	 */
	public function logout()
	{
		session('user', null);
		$this->success('已经安全退出。', __GROUP__.'/Login');
	}
	
	/**
	 * 登陆检测
	 *
	 * @param unknown_type $user        	
	 * @param unknown_type $pwd        	
	 */
	private function loginceck($user, $pwd) {
		$user_info = M ( 'User' )->where ( array (
				'username' => $user 
		) )->find ();
		if ($user_info != '') {
			if ($user_info ['password'] === $pwd && $user_info ['id'] != 1 && $user_info ['username'] != 'admin') {
				if($user_info ['flag']==1){
					$this->error ( '您的账号被禁用,请联系网站客服。', __GROUP__ . '/index' );
				}
				// 检测用户登录正确，设置登录状态
				session ( 'user',array('id'=>$user_info ['id'],'name'=>$user_info ['username']));
				$this->lognmal ( '普通用户登录' );
				$this->success ( '登录成功', __ROOT__.'/pcenter');
			} else {
				// 密码错误
				$this->error ( '您输入的密码不正确，请重新输入。', __GROUP__ . '/Login' );
			}
		} else {
			// 没有该管理员
			$this->error ( '您输入的账号不正确，请重新输入。', __GROUP__ . '/Login' );
		}
	}
}
?>