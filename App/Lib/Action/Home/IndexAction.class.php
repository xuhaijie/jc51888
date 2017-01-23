<?php
class IndexAction extends BaseAction {
	function __construct() {
		parent::__construct ();
	}
	// public function pictest() {
	// ImageResize ( './11.jpg', 400, 400, './00_22.jpg' );
	// /*
	// * 上传图片 不拉伸裁剪
	// */
	// }
	public function index() {
		$_article= M ( 'article' );
		$_call=M('call');
		//Load('extend');
		if(!session('?code_click')){
			M("config")->where("`key`='code_click'")->setInc('value');
			session('code_click',true);
		}
		$intro = $_article->where ( '`id`=1' )->find ();
		$this->assign ( 'intro', $intro );

		$call=$_call->where('`page`=0')->select();
		foreach ($call as $k => $v) {
			if($v['count']>0){
				$this->get_list("$v[ids]:$v[switch]",$v['name'],$v['count'],$v['table']);
			}else if($v['count']==0){
				$this->get_dy($v['ids'],$v['name'],$v['table']);
			}
		}

		$this->display ();
	}
	public function sitemap() {
		$single = M ( 'article' )->where ( "`pid`=0 and `system`='0'" )->select ();
		$listpage = M ( 'type' )->where ( "`parent`='1' and `id` != '4' and `id` !='5'" )->select ();
		$this->assign ( 'single', $single );
		$this->assign ( 'listpage', $listpage );
		$this->display ();
	}
}
?>