<?php
/**
 * 后台订单管理
 * Enter description here ...
 * @author Administrator
 *
 */
class OrderAction extends BaseAction {
	function __construct() {
		parent::__construct ( 'Order', 'Order' );
	}
	/**
	 * 更新订单状态 normal,,
	 */
	function upflag() {
		$url = '__GROUP__/' . $this->_action_name . '/index';
		if ($_POST) {
			$info = M ( 'order' )->find ( $_REQUEST ['id'] );
			//老的状态
			$oldertyp=explode(',',$info[type]);
			$info [type] = implode ( ',', $_POST [type] );
			$data = M ( 'order' )->save ( $info );
			//新的状态
			$newtype =$_POST [type];
			$typearry=C('typearry');
			
			//旧的订单状态
			foreach ($typearry as $key2=>$value){
				if(in_array($key2,$oldertyp)){
					$oldertypstr[]=$value;
				}
			}
			//新的订单状态
			foreach ($typearry as $key2=>$value){
				if(in_array($key2,$newtype)){
					$newtypestr[]=$value;
				}
			}
			//log 写入
			$f1=implode(',', $oldertypstr);
			$f2=implode(',', $newtypestr);
			
			$logdata['act']="订单".$info['o_num']."由(".$f1.")---更新为--->(".$f2.")";
			M('plog')->add($logdata);
			if (false !== $data) {
				$this->success ( '修改成功', $url, C ( 'JUMP_TIME' ) );
			} else {
				$this->success ( '修改失败', $url, C ( 'JUMP_TIME' ) );
			}
		}
	}
	// 订单状态详细
	function more() {
		$info = M ( 'order' )->field ( 'id,type' )->find ( $_REQUEST ['id'] );
		$typestrs = explode ( ',', $info [type] );
		foreach ( $typestrs as $value ) {
			$this->assign ( $value, 1 );
		}
		$this->assign ( 'info', $info );
		$this->display ();
	}
	//地址详情
	function moreaddr() {
		$info = M ( 'order' )->field ( 'postarea_prov,postarea_city,postarea_country' )->find ( $_REQUEST ['id'] );
		foreach($info as $key=>$value){
			$plzinfo=M('cascadedata')->where("`datavalue`='$value'")->field("dataname")->find();
			if(!empty($plzinfo)){
				$sinfo[$key]=$plzinfo[dataname];
			}
			
		}
		$this->assign ( 'sinfo', $sinfo );
		$this->display ();
	}
	function index() {
		import ( 'ORG.Util.Page' );
		$count = $this->_model->where ( $this->_where )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig ( 'theme', '<span>%totalRow% %header% %nowPage%/%totalPage% 页</span>  %first%  %upPage% %linkPage%  %downPage% %end% %select%' );
		$show = $Page->show (); // 分页显示输出                         
		$list = $this->_model->field ( 'id, name,tel,add, num, email,time, notes,info,flag,type,paid,allprice,favar' )->where ( $this->_where )->order ( '`flag` asc,`id` desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		// 遍历查询订单中的产品
		
		foreach ( $list as $key => $value ) {
		
			$list [$key] ["info"] =json_decode($value ["info"],true);
		}

		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出
		if ($template == null) {
			$this->display ();
		} else {
			$this->display ( $template );
		}
	}
	function search() {
		foreach ( $_POST as $key => $value ) {
			$this->_where [$key] = array (
					'like',
					'%' . $value . '%' 
			);
		}
		import ( 'ORG.Util.Page' );
		$count = $this->_model->where ( $this->_where )->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count ); // 实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show (); // 分页显示输出
		$list = $this->_model->where ( $this->_where )->order ( 'id desc' )->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();
		
		$result = D ( 'Type' )->select ();
		foreach ( $result as $key => $value ) {
			$category [$value ['id']] = $value ['name'];
		}
		foreach ( $list as $key => $value ) {
			$list [$key] ['cate_name'] = $category [$value ['pid']];
		}
		$this->select_category ();
		$search = array (
				'value' => 'name' 
		);
		$this->assign ( 'search', $search );
		$this->assign ( 'list', $list ); // 赋值数据集
		$this->assign ( 'page', $show ); // 赋值分页输出
		if ($template == null) {
			$this->display ( 'index' );
		} else {
			$this->display ( $template );
		}
	}
}