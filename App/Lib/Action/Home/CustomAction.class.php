<?php
class CustomAction extends BaseAction {
	
	/**
	 * Enter description here .
	 * ..
	 */
	public function __construct() {
		parent::__construct ( "Article", 'Article' );
	}
	
	/**
	 * 公用文章列表页
	 * (non-PHPdoc)
	 *
	 * @see BaseAction::index()
	 */
	public function index() {
		
	}
	
	/**
	 * 公用文章单页(non-PHPdoc)
	 *
	 * @see BaseAction::info()
	 */
	public function info() {
		$_article=M ( 'article' );
		$user = M ( 'user' )->field ( 'username' )->find ();
		$_article->where ( '`id`="' . $_REQUEST ['id'] . '"' )->setInc ( 'click' );
		$article = $_article->where ( '`id`="' . $_REQUEST ['id'] . '"' )->find ();
		$this->assign ( 'tid', $_REQUEST ['id']);
		$this->assign ( 'article', $article );
		
		$this->assign ( 'user', $user );
		$this->display ($article['www']?$article['www']:'');
	}
}
?>