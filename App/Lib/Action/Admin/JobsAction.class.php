<?php
/**
 * 后台招聘管理
 * Enter description here ...
 * @author Administrator
 *
 */
class JobsAction extends BaseAction {
	/**
	 * 
	 * Enter description here ...
	 */
	public function __construct()
	{
		parent::__construct("Jobs",'jobs');
	}
	
	public function index()
	{
		import('ORG.Util.Page');
		$count      = $this->_model->where($this->_where)->count();// 查询满足要求的总记录数
		$Page       = new Page($count);// 实例化分页类 传入总记录数和每页显示的记录数
		$Page->setConfig('theme','<span>%totalRow% %header% %nowPage%/%totalPage% 页</span>  %first%  %upPage% %linkPage%  %downPage% %end% %select%');
		$show       = $Page->show();// 分页显示输出
		$list = $this->_model->where($this->_where)->order('id')->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
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
		
		$search = array('value'=>'job');
		$this->assign('search', $search);
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		
		$this->display('index');
		
		
	}
	
  /**
     * 基础添加方法
     * Enter description here ...
     */
    function add($template = null)
    {
    	if($_POST)
    	{
    		$_POST['request']=$_POST['content'];
			unset($_POST['content']);			
			if($this->_model->create())
			{
				$id = $this->_model->add($_POST);
	    		if($id)
	    		{
	    			$url = '__GROUP__/'.$this->_action_name.'/Index';
	    			$this->success('添加成功',$url, C('JUMP_TIME'));
	    		}else
	    		{
	    			$this->error('添加失败');
	    		}
			}else
			{
				$this->error($this->_model->getError());
			}
    		exit;
    	}
    	
		$search = array('value'=>'job');
		$this->assign('search', $search);
    	$this->select_category();
    	$this->assign('title_type', '新增');
    	if($template == null)
		{
			$this->display('edit');
		}else{
			$this->display($template);
		}
    	//$this->display('edit');
    }
        
    /**
     * 基础编辑方法
     * Enter description here ...
     */
    function edit($template = null)
    {
    	if($_POST)
    	{
    		$_POST['request']=$_POST['content'];
			unset($_POST['content']);
    		
    		if($this->_model->create())
			{
	    		$id = $this->_model->save($_POST);
	    		if($id)
	    		{
	    			$url = '__GROUP__/'.$this->_action_name.'/Index';
	    			$this->success('更新成功',$url);
	    		}else
	    		{
	    			$this->error('数据没有保存或没有修改');
	    		}
			}else 
			{
				$this->error($this->_model->getError());
			}
    		exit;
    	}
    	$this->select_category();
    	
		$search = array('value'=>'job');
		$this->assign('search', $search);
    	$this->assign('title_type', '修改');
    	
    	$info = D($this->_model_name)->find($_REQUEST['id']);
    	$info['content']=$info['request'];
    	$this->assign('info',$info);
    	if($template == null)
		{
			$this->display();
		}else{
			$this->display($template);
		}
    }
	
	public function search()
    {
    	 //z($_POST);
    	foreach($_POST as $key=>$value)
    	{
    		$this->_where[$key] = array('like','%'.$value.'%');
    	}
    	
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
		
    	$search = array('value'=>'job');
		$this->assign('search', $search);
		$this->assign('search', $search);
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display('index');
    }
	
}