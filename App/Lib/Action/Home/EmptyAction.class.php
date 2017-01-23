<?php
	class EmptyAction extends CommonAction{
		public function index(){
			$this->_404();
		}
		public function _empty(){
			$this->_404();
		}
	}
?>