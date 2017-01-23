<?php
class PcenterAction extends BaseAction {
	function __construct() {
		//要求先登录
		parent::__construct ();
		$this->mustlogin ();
	}
	/**
	 * 前台是登陆
	 * 
	 */
	function mustlogin() {
		if (!session('?user')) {
			echo "hacker attack!";
			exit ();
		}
	}
	/**
	 * 
	 * 个人订单页面
	 */
	public function porder(){
		$uid = session('user');
		$uid = $uid[id];
		$orders=M('order')->where("`uid`='$uid' and `flag`='0'")->order('`time` desc')->select();
		
		foreach ($orders as $key=>$value){
			$orders[$key]["info"]=json_decode($value["info"],true);
			
		}
		$this->assign('orders',$orders);
		$this->display ();
	}
	
	
	/**
	 * 个人信息详细页面
	 */
	public function index() {
		if ($_POST) {
			// 安全校验
			$this->safe ();
			$url = '__GROUP__/' . $this->_action_name . 'Pcenter/index';
			$userutil  = session('user')[id;
			if ($_POST [nickname]) {
				$userinfo = M ( 'user' )->where ( "`id`='$userutil[id]'" )->field ( 'nickname' )->find ();
				if ($userinfo [nickname] != '') {
					echo "hacker attack!";
					exit ();
				}
				
				$count = M ( 'user' )->where ( "`nickname`='$_POST[nickname]'" )->count ();
				if ($count == 0) {
					$userutil [nickname] = $_POST [nickname];
				}
			}
			$userutil [tel] = $_POST [tel];
			$userutil [mobi] = $_POST [mobi];
			$userutil [qq] = $_POST [qq];
			$userutil [email] = $_POST [email];
			
			$id = M ( 'user' )->save ( $userutil );
			if ($id) {
				$msg = '个人信息更新成功!';
			} else {
				$msg = '个人信息更新失败,昵称已存在!';
			}
			$this->success ( $msg, $url );
			exit ();
		}
		$ae=session('user');
		$ae=$ae[id];
		$where=array('id'=>$ae);
		$user = M ( 'user' )->where ($where)->find ();
		$user [password] = '';
		$groupinfo=M('ugroup')->where("`id`='$user[gid]'")->find();
		
		$this->assign ( 'groupinfo', $groupinfo );
		$this->assign ( 'user', $user );
		$this->display ();
	}
	/**
	 * 会员头像修改
	 */
	public function headpic() {
		$ae=session('user');
		$ae=$ae[id];
		$where=array('id'=>$ae);
		$user = M ( 'user' )->where ($where)->find ();
		$user [password] = '';
		$this->assign ( 'user', $user );
		$this->display ();
	}
	
	/**
	 * 个人收藏页面
	 */
	public function pcollect() {
		$ae=session('user');
		$ae=$ae[id];
		$sql="SELECT  g.*,c.time as 'cltime' FROM ".C('DB_PREFIX')."collect c RIGHT JOIN ".C('DB_PREFIX')."goods g ON c.gid = g.id  where c.uid=".$ae." order by c.time desc";
		$collects=M('collect')->query($sql);
		$this->assign ( 'collects', $collects );
		$this->display ();
	}
	
	/**
	 * 处理表单数据
	 */
	public function upfile() {
		$path = APP_PATH . "uploads/";
		$picn_ex = session('user') ;
		$picn_ex = $picn_ex['id'];
		$file_src = "src.png";
		$filename162 = $picn_ex . '_' . '1hpic.png';
		$filename48 = $picn_ex . '_' . '2hpic.png';
		$filename20 = $picn_ex . '_' . '3hpic.png';
		$src = base64_decode ( $_POST ['pic'] );
		$pic1 = base64_decode ( $_POST ['pic1'] );
		$pic2 = base64_decode ( $_POST ['pic2'] );
		$pic3 = base64_decode ( $_POST ['pic3'] );
		if ($src) {
			file_put_contents ( $file_src, $src );
		}
		file_put_contents ( $path . $filename162, $pic1 );
		file_put_contents ( $path . $filename48, $pic2 );
		file_put_contents ( $path . $filename20, $pic3 );
		$rs ['status'] = 1;
		echo json_encode ( $rs );
	}
}
?>