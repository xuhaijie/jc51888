<?php

class BaseAction extends CommonAction{
	/**
	 * 构造函数
	 * Enter description here ...
	 */
	public function __construct(){
		//手机网站访问跳转m目录
		if(strpos($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'/m')===false){
		import("ORG.Util.browser");
		$Agent = new Browser();
		if($Agent->_platform != 'Windows'){
				if(strstr($_SERVER["SERVER_NAME"],"www")==""){
					$temp_arr=explode("/",$_SERVER["REQUEST_URI"]);
					$temp_url="/".$temp_arr[1]."/";
					unset($temp_arr);
					header("Location:http://".$_SERVER['HTTP_HOST'].$temp_url."m");
				}else{
					header("Location:http://".$_SERVER['HTTP_HOST']."/m");
				}
				
			}
		}
		//读取系统配置主题
		C('DEFAULT_THEME',$this->config('current_theme'));
		//网站配置
		$config = $this->config();
		//幻灯
		$flash = M('flash')->where("`open`=1 and `img`<>''")->order('`order` desc')->select();
		//侧边栏产品分类
		$type = $this->type_tree(PRODUCT,2);
		
		//页面title
		$title = $this->get_title().$config['web_name'];
		
		$this->assign('title',$title);
		$this->assign('config',$config);
		$this->assign('flash',$flash);
		$this->assign('type',$type);
	}

	//详细内容 - 子栏目 - 栏目 - 网站名称
	function get_title(){
		$type   = M('type');
		$detail = '';

		//z(MODULE_NAME);
		switch(MODULE_NAME){
			case 'News':
				$column = "新闻中心";
				break;
			case 'Message':
				$column = "在线留言";
				break;
			case 'Jobs':
				$column = "人才招聘";
				break;
			case 'Product':
				$column = "产品展示";
				break;
			case 'Company':
				$column = "公司简介";
				break;
			case 'Order':
				$column = "在线订单";
				break;
			default:
				$column = "首页";
		}
		$column .= " - ";
		
		if(isset($_GET['id'])){
			$News    = M('article');
			$Jobs    = M('jobs');
			$Product = M('goods');
			$Custom = M('article');

			$id   = intval($_GET['id']);
			$data = ${MODULE_NAME}->where("`id`=$id")->find();
			//z($data);
			if(MODULE_NAME == 'Jobs')
			{
				$detail   = mb_substr(strip_tags($data['job']),0,20,'UTF-8').'-';
			}else 
			{
				$detail   = mb_substr(strip_tags($data['title']),0,20,'UTF-8').'-';
			}
			//详细内容
			$min_type = $type->field('`code`')->where("`id`=$data[pid]")->find();
		}else if(isset($_GET['type'])){
			$type_id  = intval($_GET['type']);
			$min_type = $type->field('`code`')->where("`id`=$type_id")->find();
		}else{
			return $column;
		}
		//各级栏目
		/*
		$all_id = rtrim($min_type['code'],',');
		$name   = $type->where("`id` in ($all_id)")->order('`id` desc')->select();
		
		$grade = '';
		foreach($name as $v){
			//除去固有的4个类别
			// if($v['id']>4){
				$grade .= $v['name'].'-';
			// }
		}
		*/
		return $detail.$column;	
	}

	/*
	 *参数：父类id和类别树的深度 返回值：嵌套数组形式的类别树
	 *$depth = 0 返回父类下所有类别
	 *$depth = N 返回父类下N层类别
	 */
	function type_tree($parent_id,$depth=1){
		if($depth >= 0){
			if($parent_id > 0 && $parent_id < 4){	//三个根分类
				$type = M('type')->field('`id`,`code`,`parent`,`name`')->where("`type` = $parent_id")->order('`order`')->select();
			}else{
				$type = M('type')->field('`id`,`code`,`parent`,`name`')->where("`code` like '%,$parent_id,%'")->order('`order`')->select();
			}
		}else{
			return 'parameter error';
		}
		
		//$cate保留所有
		$cate = array();
		


		//循环搜索所有分类结果
		foreach($type as $v){
			//搜索当前类别的code字段
			$code_arr = explode(',',rtrim($v['code'],','));
			//$key:参数$parent_id在code数组中的位置
			$key      = array_search($parent_id,$code_arr);

			if($depth == 0){
				$cate[$v['id']] = array('id'=>$v['id'],'pid'=>$v['parent'],'name'=>$v['name']);
			}else{
				//只保留$depth个深度的分类
				if(!isset($code_arr[$key+$depth+1])){
					$cate[$v['id']] = array('id'=>$v['id'],'pid'=>$v['parent'],'name'=>$v['name']);
				}
			}
		}
		
		return $this->tree_gen($cate);
	}

	function tree_gen($items){		//生成类别树
		$tree = array();
		foreach($items as $v){
			if( isset($items[$v['pid']]) ){
				$items[$v['pid']]['son'][] = &$items[$v['id']];
			}else{
				$tree[] = &$items[$v['id']];
			}
		}
		return $tree;
	}
	


	//返回$id的子类别ID和自身
	function getTypeID($id){
		if(!$id) return false;

		if($id>0 && $id<4){
			$pid = M('type')->field('`id`')->where("`code` like '$id,%'")->select();
		}else{
			$pid = M('type')->field('`id`')->where("`code` like '%,$id,%'")->select();
		}
		
		//文章 or 产品 or 人才 的PID
		$nums = '';
		foreach($pid as $v){
			$nums .= $v['id'].',';
		}

		return rtrim($nums,',');
	}


	public function safe(){
		foreach($_REQUEST as $v){
			$v = mysql_real_escape_string(strip_tags($v));
		}
	}

	public function verify(){
		import("ORG.Util.Image");
		Image::buildImageVerify();
	}

	function debug($x){
		echo '<pre>';
		var_dump($x);
		echo '</pre>';
	}
	
	/**
	 * 设置头部的关键字和描述
	 * Enter description here ...
	 * @param unknown_type $keywords
	 * @param unknown_type $description
	 */
	protected function header_seo($web_keywords = null, $web_description = null)
	{
		if($web_keywords == null)
		{
			$web_keywords = $this->config('web_keywords');
		}
		if($web_description == null)
		{
			$web_description = $this->config('web_description');
		}
		
		$this->assign('web_keywords',$web_keywords);
		$this->assign('web_description',$web_description);
	}
	
	
}
?>