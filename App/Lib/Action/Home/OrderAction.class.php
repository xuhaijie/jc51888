<?php
class OrderAction extends BaseAction {
	public function index() {
		$pid = getTypeID ( PRODUCT );
		$product = M ( 'goods' )->field ( '`id`,`title`' )->where ( "pid in ($pid)" )->select ();
		
		$this->assign ( 'product', $product );
		$this->header_seo ();
		
		$this->display ();
	}
	public function add_order() {
		if ($_SESSION ['verify'] != md5 ( $_POST ['captcha'] )) {
			$this->error ( '验证码错误', 'index' );
		}
		$order = M ( 'order' );
		$this->safe ();
		$id = $_POST ['cp_id'];
		$pinfo = M ( 'goods' )->where ( "`id`='$id'" )->find ();
		if($pinfo){
			$shoppingcart ["ddxx"][] = array (
					"id"=>$pinfo ['id'],
					"name"=>$pinfo['title'],
					"count"=>1,
					"price"=>$pinfo['price']
			);
			$shoppingcart ["price"]=$pinfo['price'];
			$_POST ['info'] = json_encode ( $shoppingcart );
			$data = $_POST;
			//$data["o_num"]=
			if(session('?user')){
				$user=session('user');
				$data['uid']=$user["id"];
				$data["o_num"]=time().$user["id"];
			}else{
				$data["o_num"]=time()."00";
			}
			if ($order->add ( $data )) {
				$this->success ( '订单成功' );
			} else {
				
				$this->error ( '订单失败,请稍候再试' );
			}
		}else{
			$this->error ( '订单失败,没有找到相关商品' );
		}
	}
}
?>