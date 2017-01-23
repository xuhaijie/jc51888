<?php
	class ContactAction extends BaseAction{
		public function index(){
			$this->header_seo();
			$this->display();
		}
	}
?>