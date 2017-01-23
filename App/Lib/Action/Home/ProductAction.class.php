<?php
class ProductAction extends BaseAction {
	public function index() {
		$fl = $_GET ['fl']?"and `is_".$_GET ['fl']."`=1":'';
		import ( "ORG.Util.Page" );
		$_goods=M ( 'goods' );
		$type = intval ( $_GET ['type'] );
		$type=$type?$type:2;
		$pid =getTypeID ($type);
		session('prod_type',$type);
		$type=M('type')->where("`id`=$type")->find();//获取分类信息
		$count = $_goods->where ( "`pid` in ($pid) and `order`<>0 and `flag`='0'".$fl)->count ();
		if ($count) {
			$page_product = $this->config ( 'page_product' );
			$page = new Page ( $count, $page_product ? $page_product : $this->config ( 'page_default' ) );
			$list =$_goods->where ( "`pid` in ($pid) and `order`<>0 and `flag`='0'".$fl)->order ( '`order` desc,`id` desc' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
			$this->assign ( 'exist', true );
			$this->assign ( 'page', $page->show () );
		}

		foreach($list as $key=>$value)
		{
			$list[$key]['url'] = __ROOT__.'/product/'.$value['id'];
		}
		$this->assign ( 'list', $list );

		$this->display ( $type['www']?$type['www']:'index');
	}
	public function product_info() {
		// 商品ID
		$id = intval ( $_GET ['id'] );
		$_goods=M ( 'goods' );
		$_type=M ( 'type' );
		if ($id > 0) {
			$list =$_goods->where ( "`id`=$id" )->find ();
		}
		if ($list) {
			//增加一次点击
			$list['pid']=$_type->where("`id`=$list[pid]")->find();
			$_goods->where("`id`=$id")->setInc('click');
			$list['imgs']=explode(',',$list['imgs']);
			$this->assign ( 'list', $list );
			// 上一页---下一页---GO
			$pn_id=$list[id];
		   $pn_order=$list[order];
			if(!session('?prod_type') or session('prod_type')!=$list['pid']['id']){session('prod_type',$list['pid']['id']);}
	      $opid=getTypeID(intval(session('prod_type')));
			$pre=$_goods->where ( "(`order` >'$pn_order' or (`order` ='$pn_order' and `id`>'$pn_id'))  and `pid` in ($opid) and `order`<> 0 and `flag`='0'"  )->order ( '`order` asc,`id` asc' )->find ();
	      $next=$_goods->where ( "(`order` <'$pn_order' or (`order` ='$pn_order' and `id`<'$pn_id'))  and `id`<>'$pn_id' and `pid` in ($opid) and `order`<>0 and `flag`='0'" )->order ( '`order` desc,`id` desc' )->find ();
	      $this->assign ( 'pre', $pre);
	      $this->assign ( 'next', $next);
			// 上一页---下一页---END
	      if($list['pid']['sur']){

	      	$list['www']=$list['pid']['sur'];

	      }

		$this->display ($list['www']?$list['www']:'');
		} else {
			$this->_404 ();
			exit ();
		}
	}

	public function sousuo() {
		import ( "ORG.Util.Page" );
		$_goods=M ( 'goods' );
		//商品类型
		$type ="%".$_GET ['key']."%";
		$pid =getTypeID (2);
		$count = $_goods->where ( "`pid` in ($pid) and `order`<>0 and `flag`='0' and (`title` like '$type' or `keywords` like '$type')" )->count ();
		if ($count) {
			$page_product = $this->config ( 'page_product' );
			$page = new Page ( $count, $page_product ? $page_product : $this->config ( 'page_default' ) );
			
			$list = $_goods->where ( "`pid` in ($pid) and `order`<>0 and `flag`='0' and (`title` like '$type' or `keywords` like '$type')" )->order ( '`order` desc,`id` desc' )->limit ( $page->firstRow . ',' . $page->listRows )->select ();
		}

		if (! $count) {
			$this->assign ( 'exist', false );
		} else {
			$this->assign ( 'exist', true );
			$this->assign ( 'list', $list );
			$this->assign ( 'page', $page->show () );
		}
		$this->display ( 'index' );
	}

}
?>