<?php

/**

 * 后台首页框架首页

 * Enter description here ...

 * @author Administrator

 *

 */

class ArticleAction extends BaseAction {

	/**

	 * 

	 * Enter description here ...

	 */

	public function __construct()

	{

		parent::__construct("Article",'Article');

	}



	public function index()

	{

		$where = 'pid != 0 and flag=0';

		$this->setWhere($where);

		parent::index_cate();

	}

	
	function ajax_article_del(){
		if($_REQUEST ['id']){
			$where=array('id'=>$_REQUEST ['id']);
			$save=array('img'=>'');
			$data=$this->_model->where($where)->save($save);
			if ($data) {
				$this->del_image($_REQUEST ['img']);
				$data=array(
						'code'=>1,
						'data'=>array(
							'name'=>'删除成功'
							)
					);
				$this->ajaxReturn ($data, 'JSON');
			} else {
				$data=array(
						'code'=>0,
						'data'=>array(
							'name'=>'删除失败'
							)
					);
				$this->ajaxReturn ($data, 'JSON');
			}
		}
	}
	public function search()

    {

    	$this->_where['title'] = array('like','%'.$_POST['title'].'%');

    	//$this->_where['pid'] = array('NEQ', '0');
        
        $this->_where['pid'] =$_POST['pid'];

    	//z($this->_where);

    	import('ORG.Util.Page');

		$count      = $this->_model->where($this->_where)->count();// 查询满足要求的总记录数

		$Page       = new Page($count);// 实例化分页类 传入总记录数和每页显示的记录数

		$show       = $Page->show();// 分页显示输出

		$list = $this->_model->where($this->_where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();

		$result = D('Type')->select();

		foreach($result as $key=>$value)

		{

			$category[$value['id']] = $value['name'];

		}

		foreach($list as $key=>$value)

		{

			$list[$key]['cate_name'] = $category[$value['pid']];

		}

		$this->select_category();

		$search = array('name'=>'pid', 'value'=>'title');

		$this->assign('search', $search);

		$this->assign('list',$list);// 赋值数据集

		$this->assign('page',$show);// 赋值分页输出

		

    	 

		if($template == null)

		{

			$this->display('index');

		}else{

			$this->display($template);

		}

    }

	

}