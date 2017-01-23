<?php
class CartAction extends BaseAction {
	public function index() {
		//cartlist
		$cartlist=session("gwc");
		foreach ($cartlist as $key => $value) {
			$cartlist[$key]["con"]=M('goods')->where("id=$value[id]")->find();
		}
		$this->assign ( 'cartlist', $cartlist);
		$this->display ();
		exit ();
	}
	public function gwc() {
		//$ret=array('id'=>$_GET['id'],'name'=>$_GET['name']);
		//session('gwc',null);
		$ses=session('gwc');
		if(isset($_GET['id'])){
			$ret=array(
				'id'=>$_GET['id'],
				'name'=>$_GET['name'],
				"count"=>$_GET['count']?$_GET['count']:1
			);
			$box=true;
			foreach ($ses as $k => $v) {
				if($v['id']==$ret['id']){
					$box=false;
					break;
				}
			}
			$box?$ses[]=$ret:'';
			$box?session('gwc',$ses):'';
		}
		$this->ajaxReturn($ses,'JSON');
	}

	public function upgwc() {
		if(isset($_GET['id'])){
			$data=session('gwc');
			foreach ($data as $k => $v) {
				if($v['id']==$_GET['id']){
					if($_GET['count']>0){
						$data[$k]['count']=$_GET['count'];
					}else{
						array_splice($data,$k,1);
					}
					session('gwc',$data);
					$this->ajaxReturn(true,'JSON');
					break;
				}
			}
		}
		$this->ajaxReturn(false,'JSON');
	}
	public function add_order(){

		if ($_SESSION ['verify'] != md5 ( $_POST ['captcha'] )) {
			$this->error ( '验证码错误', 'index' );
		}
		$order = M ( 'order' );
		$this->safe ();
		$data = $_POST;
		//购物车数据处理
		$gwc=session('gwc');
		$arr=array();
		$zje=0;
		foreach ($gwc as $k => $v) {
			$gwc[$k]+=M('goods')->field("price")->where("id=$v[id]")->find();
			$zje+=$gwc[$k]["price"]*$v["count"];
		}
		$gwc=array(
			"ddxx"=>$gwc,
			"price"=>$zje
			);
		
		if(session('?user')){
			$user=session('user');
			$data['uid']=$user["id"];
			$data["o_num"]=time().$user["id"];
		}else{
			$data["o_num"]=time()."00";
		}
		$data["info"]=json_encode($gwc);
		if ($order->add ( $data )) {
			$this->success ( '订单成功' );
		} else {
			$this->error ( '订单失败,请稍候再试' );
		}
	}
}
?>