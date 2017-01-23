<?php
	class NewsAction extends BaseAction{

		public function index(){
			import("ORG.Util.Page");
			$_article=M('article');
			$type = intval($_GET['type']);
			$type=$type?$type:4;
			$news_id = getTypeID($type);
			session('news_type',$type);

			$count   = $_article->where("`pid` in ($news_id)")->count();
			$page    = new Page($count,$this->config('page_default'));

			$list    = $_article->where("`pid` in ($news_id) and `order`<>'0'")
							   	   ->order('`order` desc,`id` desc')
							   	   ->limit($page->firstRow.','.$page->listRows)
							       ->select();

			if($count) $this->assign('exist',true);
			foreach($list as $key=>$value)
			{
				$list[$key]['url'] = __ROOT__.'/news/'.$value['id'];
			}
			$this->assign('list',$list);

			//$this->header_seo($list['keywords'], $list['description']);
			$this->assign('page',$page->show());
			$ltype=M("type")->where("`id`=$type")->find();

			$this->display($ltype['www']?$ltype['www']:'index');
			
		}

		public function news_info(){
			//新闻ID
			$id   = intval($_GET['id']);
			$_article=M('article');
			$_type=M('type');
			//若新闻ID不为空则显示单个 反之若类型不空则显示一类新闻
			if($id > 0){
				$list = $_article->where("`id`=$id")->find();
			}
			if($list){
				$list['pid']=$_type->where(array("id"=>$list['pid']))->find();//读取出分类信息
				$user = M('user')->field('`username`')->find();//发布者
				$_article->where("`id`=$id")->setInc('click');//点击加1
				$this->assign('list',$list);//输出变量到页面
				// 上一页---下一页---GO
				$pn_id=$list['id'];
			    $pn_order=$list['order'];
				if(!session('?news_type') or session('news_type')!=$list['pid']['id']){session('news_type',$list['pid']['id']);}//获取分类
		      $opid=getTypeID(intval(session('news_type')));//分类下所有分类
				$pre=$_article->where ( "(`order` >'$pn_order' or (`order` ='$pn_order' and `id`>'$pn_id'))  and `pid` in ($opid) and `order`<> 0"  )->order ( '`order` asc,`id` asc' )->find ();//limit (1)->select ();
		      $next=$_article->where ( "(`order` <'$pn_order' or (`order` ='$pn_order' and `id`<'$pn_id'))  and `id`<>'$pn_id' and `pid` in ($opid) and `order`<>0" )->order ( '`order` desc,`id` desc' )->find ();//limit (1)->select ();
		      $this->assign ( 'pre', $pre);
		      $this->assign ( 'next', $next);
		      // 上一页---下一页---END
		      $this->header_seo($list['keywords'], $list['description']);
				$this->assign('user',$user);
				$this->display($list['www']?$list['www']:'');
		     }else{
		     	$this->_404();
		     }
		}
	}
?>