<?php
class MarketAction extends BaseAction {
	public function __construct()
	{
		parent::__construct('Goods', 'Goods');
	}
	public function index() {
		$this->header_seo ();
// 		print_r($_GET[t]);
		$proving = array_pop ( array_pop ( $_GET ) );
		$proving = iconv ( 'GBK', 'UTF-8', $proving );
		$this->assign ( 'proving', $proving );
		$this->display ();
	}
	public function addmark(){
		$this->display ();
		//`area`, ` department`, `principal`, `tel`, `fax`, `address`
	}
	public function editormark(){
		$this->display ();
		//`area`, ` department`, `principal`, `tel`, `fax`, `address`
	}
}
?>