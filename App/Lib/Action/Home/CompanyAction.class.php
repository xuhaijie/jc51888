<?php
	class CompanyAction extends BaseAction{
		public function index(){
			 $article = M('article')->where('`id`=1')->find();
			$this->assign ( 'article', $article );
			$this->display();
		}
	}
?>