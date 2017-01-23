<?php
class BaseAction extends CommonAction {
	public function __construct() {
		// 手机网站访问跳转m目录
		
if (strpos ( $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'], '/m' ) === false) {
			import ( "ORG.Util.browser" );
			$Agent = new Browser ();
			
			if ($Agent->_platform == 'Android' or $Agent->_platform == 'iPhone' or $Agent->_platform == 'Windows Phone' or $Agent->_platform == 'iPod' or $Agent->_platform == 'iPad' or $Agent->_platform == 'BlackBerry' or $Agent->_platform == 'Nokia') {
				if (strstr ( $_SERVER ["SERVER_NAME"], "www" ) == "") {
					$temp_arr = explode ( "/", $_SERVER ["REQUEST_URI"] );
					$temp_url = "/" . $temp_arr [1] . "/";
					unset ( $temp_arr );
					$tmp_arr1=explode(".",$_SERVER ["HTTP_HOST"]);

					header ( "Location:http://wap." . $tmp_arr1[0].".".$tmp_arr1[1]);
				} else {
					$tmp_arr1=explode(".",$_SERVER ["HTTP_HOST"]);
					header ( "Location:http://wap." .$tmp_arr1[1].".".$tmp_arr1[2] );
				}
			}
}
		
		
		// 用户中心成员
		// $users = M ( 'user' )->where ( "`flag`='0'" )->field ( 'id,nickname' )->order ( 'rand()' )->limit ( 12 )->select ();
		// $this->assign ( 'users', $users );
		// 登陆成功状态
		if ($this->is_login ()) {
			//z(1);
			//头像类处理
			$this->headportrait();
			$this->assign ( 'n_islogin', 1 );
			$this->assign ( 'n_username', $_SESSION ['n_username'] );
			$this->assign ( 'n_user_id', $_SESSION ['n_user_id'] );

		}
		// 读取系统配置主题
		C ( 'DEFAULT_THEME', $this->config ( 'current_theme' ) );
		// 网站配置
		$config = $this->config ();
		$this->assign ( 'config', $config );
		// 幻灯
		$flash = M ( 'flash' )->where ( "`open`=1 and `img`<>''" )->order ( '`order` desc' )->select ();
		$this->assign ( 'flash', $flash );


// 侧边栏产品分类
$type =type_tree ( 6, 2 );
//添加产品个数count
$type=$this->get_son($type,1,'goods');

foreach($type['0']['son'] as $key =>$val){
$pid= $val['id'];
$goods=M("goods")->where("`pid`=$pid")->select();
$type['0']['son'][$key]['goods_cp']=$goods;
}
$this->assign ( 'type', $type );


		//后台设置调用数据
		$call=M('call')->where('`page`=1')->select();
		foreach ($call as $k => $v) {
			if($v['count']>0){
				$this->get_list("$v[ids]:$v[switch]",$v['name'],$v['count'],$v['table']);
			}else if($v['count']==0){
				$this->get_dy($v['ids'],$v['name'],$v['table']);
			}
		}
		// 页面title
		$title = $this->get_title () . $config ['web_name'];
		$this->assign ( 'title', $title );
		
		$liuliangbao = json_decode( $this->config( "liuliangbao" ), TRUE );
        define( "REGISTER_JS", $liuliangbao['code'] );
        //add_tag_behavior( "view_filter", "RegisterJavascript" );
		$this->assign("liuliangbao",$liuliangbao['code']);

		//导航
		$fnav = neidiao(0,4);
		//z($fnav);
		$this->assign("fnav",$fnav);
		$arr1=array();
		$str='';
		foreach ($fnav as $key => $value) {
				//获取对象
				$tid[$value[tid]]=$key;
				$s=strrpos($value['url'],'/');
				if($s){
					$s=substr($value['url'],$s+1);
					if(is_numeric($s))$arr1[]=$s;
				}
				$str.=$this->cl_nav($value,ucfirst($value['tid']));
				
		}
		//z($this->type_tree (2,0));
		$str=substr($str, 0, -1);
		//固定
		//z($str);
		$arr2="Product:".";News:".";Custom:";
		$lid=$this->skr_pdarr($arr1,$arr2,$str);
		$this->assign ( 'yid', $tid[$lid['name'].$lid['id']] );
		//z($str);
//热销分类
$hotProduct=M('goods')->where('`is_hot`=1')->order('`order` desc')->select();
$this->assign ( 'hotProduct', $hotProduct);
//新品分类
$newProduct=M('goods')->where('`is_new`=1')->order('`order` desc')->select();
$this->assign ( 'newProduct', $newProduct);
//促销分类
$bestProduct=M('goods')->where('`is_best`=1')->order('`order` desc')->select();
$this->assign ( 'bestProduct', $bestProduct);

//调用单页
$hongmu=M("article")->where("`id`=28")->find();
$this->assign("hongmu",$hongmu);




		//取第3级分类
		// if(isset ( $_GET ['id'] )){
		// 	$tid=array("id"=>$_GET[id]);
			
		// 	$tid=M('goods')->where($tid)->find();
		// 	$tid=array("id"=>$tid['pid']);

		// }elseif (isset ( $_GET ['type'] )) {
		// 	$tid=array("id"=>$_GET['type']);
		// }
		// if($tid){
		// 	$ttype=M('type')->where($tid)->find ();
		// 	$ttype=explode(",",$ttype[code]);
		// 	if($ttype[2]){
		// 		$ttype = type_tree ( $ttype[1], 0 );
		// 	}elseif ($ttype[1]) {
		// 		$ttype = type_tree ( $ttype[1], 0 );
		// 	}
		// 	$this->assign ( 'ttype', $ttype );
		// }
		// z($ttype);
		$this->header_seo();
		
	}

		/**
	 * 
	 * 头像类处理
	 */
	function headportrait(){
		$picn_ex = $_SESSION ['user']['id'];
		$p1 = $picn_ex . '_' . '1hpic.png';
		$p2 = $picn_ex . '_' . '2hpic.png';
		$p3 = $picn_ex . '_' . '3hpic.png';
		if (! file_exists ( "./APP/uploads/" . $p1 )) {
			$p1 = 'nopic.png';
			$p2 = 'nopic.png';
			$p3 = 'nopic.png';
		}
		$this->assign ( 'p1', $p1 );
		$this->assign ( 'p2', $p2 );
		$this->assign ( 'p3', $p3 );
	}

	// 详细内容 - 子栏目 - 栏目 - 网站名称
	function get_title() {
		$detail = '';
		// z(MODULE_NAME);
		if (MODULE_NAME == 'Index') {
			$column = "";
		} else {
			switch (MODULE_NAME) {
				case 'News' :
					$column = "新闻中心";
					break;
				case 'Message' :
					$column = "在线留言";
					break;
				case 'Jobs' :
					$column = "人才招聘";
					break;
				case 'Product' :
					$column = "产品展示";
					break;
				case 'Company' :
					$column = "公司简介";
					break;
				case 'Order' :
					$column = "在线订单";
					break;
				case 'Contact' :
					$column = "联系我们";
					break;
				default :
					$column = "首页";
			}
			$column .= " - ";
		}
		if (isset ( $_GET ['id']) && MODULE_NAME!="Cart" && MODULE_NAME!="Ajax") {
			$News = M ( 'article' );
			$Jobs = M ( 'jobs' );
			$Product = M ( 'goods' );
			$Custom = M ( 'article' );
			$Message = M ( 'message' );

			
			$id = intval ( $_GET ['id'] );
			$data = ${MODULE_NAME}->where ( "`id`=$id" )->find ();
			// z($data);
			if (MODULE_NAME == 'Jobs') {
				$detail = mb_substr ( strip_tags ( $data ['job'] ), 0, 20, 'UTF-8' ) . '-';
			} else {
				$detail = mb_substr ( strip_tags ( $data ['title'] ), 0, 20, 'UTF-8' ) . '-';
			}
			// 详细内容
			$min_type = M ( 'type' )->field ( '`code`' )->where ( "`id`=$data[pid]" )->find ();
		} else if (isset ( $_GET ['type'] )) {
			$type = intval ( $_GET ['type'] );
			$data = M ( 'type' )->where ( "`id`=$type" )->find ();
			$detail=$data['name'].' - ';
		} else {
			return $column;
		}
		// 各级栏目
		/*
		 * $all_id = rtrim($min_type['code'],','); $name = $type->where("`id` in
		 * ($all_id)")->order('`id` desc')->select(); $grade = ''; foreach($name
		 * as $v){ //除去固有的4个类别 // if($v['id']>4){ $grade .= $v['name'].'-'; // }
		 * }
		 */
		return $detail . $column;
	}
	
	public function safe() {
		foreach ( $_REQUEST as $v ) {
			$v = mysql_real_escape_string ( strip_tags ( $v ) );
		}
	}
	public function verify() {
		import ( "ORG.Util.Image" );
		Image::buildImageVerify ();
	}
	function debug($x) {
		echo '<pre>';
		var_dump ( $x );
		echo '</pre>';
	}
	
	/**
	 * 设置头部的关键字和描述
	 * Enter description here .
	 * ..
	 * 
	 * @param unknown_type $keywords        	
	 * @param unknown_type $description        	
	 */
	protected function header_seo($web_keywords = null, $web_description = null) {
		if ($web_keywords == null) {
			$web_keywords = $this->config ( 'web_keywords' );
		}
		if ($web_description == null) {
			$web_description = $this->config ( 'web_description' );
		}
		
		$this->assign ( 'web_keywords', $web_keywords );
		$this->assign ( 'web_description', $web_description );
	}
	
}
?>