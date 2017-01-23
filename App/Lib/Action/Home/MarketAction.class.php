<?php
class MarketAction extends BaseAction {
	public function index() {
		$this->header_seo ();
		// print_r($_GET[t]);
		$proving = array_pop ( array_pop ( $_GET ) );
		
		$info = M ( 'article' )->where ( "`id`='3'" )->select ();
		$info = $info [0];
		$proving = iconv ( 'GBK', 'UTF-8', $proving );
		$this->assign ( 'proving', $proving );
		$this->assign ( 'info', $info );
		$this->display ();
	}
}
?>