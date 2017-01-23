<?php

/**
 * 文章数据模型
 * Enter description here ...
 * @author Administrator
 *
 */
class ArticleModel extends BaseModel {
	function __construct()
	{
		parent::__construct();
	}

	protected $_validate = array(
    	array('title','require','文章名称不允许为空！'), //默认情况下用正则进行验证
	);
	//返回$id所属的整个类别分支的ID
	function getTypeID($id){
		if(!$id) return false;

		$code = M('type')->field('`code`')->where(" `code` like '%,$id,%' ")->order('`id` desc')->find();
		$code = current($code);
		
		return $code ? rtrim(ltrim($code,'0,'),',') : false;
	}
	
	

}

?>