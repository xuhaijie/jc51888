<?php
class AjaxAction extends BaseAction {
	function __construct() {
		parent::__construct ("Ajax","Ajax");
	}
	/**

	*获取产品或者书籍

	**/
	 function ajax_list() {
	 	$_goods=M('goods');
	 	$_type=M('type');
		// $list = M();
		// $list->query('SELECT a.pid ,b.name FROM `qf_goods`as a,`qf_type`as b');
	 	$where=array(
	 		"flag"=>$_GET["flag"]
	 		);
		$list=$_goods->where($where)->order("id desc")->select();
		$type=$_type->select();
		$list_1=array();
		$list_2=array();
		foreach ($type as $key => $value) {
			$list_1[$value["id"]]=$value["name"];
			$list_2[]=$value["id"];
		}
		foreach ($list as $key => $value) {
			//if($value)
			$list[$key]["pid_name"]=$list_1[$value['pid']];
		}
		$this->ajaxReturn($list);
	}
}
?>