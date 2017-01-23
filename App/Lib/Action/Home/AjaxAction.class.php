<?php
class AjaxAction extends BaseAction {
	function __construct() {
		parent::__construct ();
	}
	/**

	*收藏

	**/
	 function ajax_collect() {
		$uid = $_SESSION ['user']["id"];
		$id = $_REQUEST ['id'];
		if (empty ( $uid )) {
			$this->ajaxReturn ( '请先登录', 'JSON', 0 );
		}
		switch ($_REQUEST ['t']) {
			// 收藏产品
			case 'sc' :
				
				$where = array (
						'id' => $_REQUEST ['id'] 
				);
				$info = M ( 'Goods' )->find ( $_REQUEST ['id'] );
				if (empty ( $info )) {
					$this->ajaxReturn ( '参数有误', 'JSON', 1 );
				}
				$collinfo = M ( 'collect' )->where ( "`uid`='$uid' and `gid`='$info[id]'" )->find ();
				// 未收藏
				if (empty ( $collinfo )) {
					$new [uid] = $uid;
					$new [gid] = $_REQUEST ['id'];
					$new [description] = '';
					$data = M ( 'collect' )->add ( $new );
				} else {
					$data = M ( 'collect' )->where ( "`uid`='$uid' and `gid`='$info[id]'" )->delete ();
					$this->ajaxReturn ( '取消收藏成功', 'JSON', 2 );
				}
				if ($data) {
					$this->ajaxReturn ( "收藏成功", 'JSON', 3 );
				} else {
					$this->ajaxReturn ( '设置失败,已经收藏该产品', 'JSON', 4 );
				}
				break;
			// 删除订单 隐藏（非真正删除）
			case 'dlorder' :
				$item = M ( 'order' )->where ( "`uid`='$uid' and `id`='$id'" )->find ();
				$item [flag] = 1;
				$data = M ( 'order' )->save ( $item );
				if (false !== $data) {
					$this->ajaxReturn ( "删除成功", 'JSON', 1 );
				} else {
					$this->ajaxReturn ( '删除失败', 'JSON', 0 );
				}
				break;
		}
	}
	function ajax_news() {
		$pid=$_GET["id"].(isset($_GET["z"])?":1":":0");
		$num=$_GET["count"];
		$data=$this->get_list($pid,"article",$num);
		foreach ($data as $key => $value) {
			unset($data[$key]["www"]);
			unset($data[$key]["order"]);
			unset($data[$key]["flag"]);
			unset($data[$key]["system"]);
		}
		$this->ajaxReturn ( $data );
	}
	function ajax_prod(){
		$pid=$_GET["id"].(isset($_GET["z"])?":1":":0");
		$num=$_GET["count"]?$_GET["count"]>=10?"10":$_GET["count"]:5;
		$data=$this->get_list($pid,"goods",$num);
		foreach ($data as $key => $value) {
			unset($data[$key]["www"]);
			unset($data[$key]["order"]);
			unset($data[$key]["flag"]);
			unset($data[$key]["system"]);
		}
		$this->ajaxReturn ( $data );
	}
}
?>