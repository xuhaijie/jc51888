<?php

	/* 
	    后台文章数据库
		
		三个基本类别
		1.文章中心/article
		2.产品展示/goods
		3.人才招聘/jobs
	*/
	class ActModel extends BaseModel {

		//返回$id所属的整个类别分支的ID
		function getTypeID($id){
			if(!$id) return false;
			$code = M('type')->field('`code`')->where(" `code` like '%,$id,%' ")->order('`id` desc')->find();
			$code = current($code);
			
			return $code ? rtrim(ltrim($code,'0,'),',') : false;
		}
		
		function getList()
		{
			
		}

	}

?>