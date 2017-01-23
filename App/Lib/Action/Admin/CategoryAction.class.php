<?php
/**
 * 后台分类管理
 * Enter description here ...
 * @author Administrator
 *
 */
class CategoryAction extends BaseAction {
	/**
	 * 
	 * Enter description here ...
	 */
	public function __construct()
	{
		parent::__construct("Category",'Type');
        
	}
	/**
	 * 栏目列表
	 * @see BaseAction::index()
	 */
    function index()
    {
    	//z($this->_model_name);
    	$list = $this->_model->list_column();
    	//debug($list);
    	$this->assign('list', $list);
    	//parent::index();
    	$this->display();
    }
    
    function add()
    {
        //$this->skr_code(6,false);

    	if($_POST)
    	{     
            /*
                分类图片上传开始==============第一步start====================
            */
            if ($_FILES ['img'] ['size'] != 0) {
                $img_name = $this->UploadFile ();
                $s=count($img_name);
                $_POST ['img'] = $img_name [1];
            }
            /*
                分类图片上传==============第一步end=======================
            */

            if($_POST['m']){
                $arrl=explode(",",$_POST['name']);
                foreach ($arrl as $key => $value) {
                    $arrl2=array();
                    $arrl2=$_POST;
                    $arrl2['name']=$value;
                    $arrl2['aid']=be_dy($value);
                    $type_id = $this->_model->add($arrl2);
                    $this->make_code($type_id);
                }
            }else{
                /*
                分类图片上传开始==============第二步start========================
                */
                   if($_POST['img']){
                        $dir=C('UPLOAD_DIR')."/imgs/";
                        $fiedir=$dir.$id.'/';
                        mkdir($fiedir);
                        foreach ($_POST['img'] as $k => $v) {
                            rename ( $dir.$v,$fiedir . $v );
                        }
                        del_dir($dir);
                    }
                /*
                    分类图片上传开始==============第二步end==========================
                */
                $_POST['aid']=be_dy($_POST['name']);
                $type_id = $this->_model->add($_POST);
            }
    		
            
    		///debug($type_id,true);
    		if($type_id)
    		{
                 if(1){
    			     $this->make_code($type_id);
                 }
    		switch($_REQUEST['type'])
		    	{
		    		case "1":
		    			$this->success('添加成功',__GROUP__.'/Category/article');
		    			break;
		    		case "2":
		    			$this->success('添加成功',__GROUP__.'/Category/goods');
		    			break;
		    		case "3":
		    			$this->success('添加成功',__GROUP__.'/Category/jobs');
		    			break;
		    		default:
		    			$this->success('添加成功',__GROUP__.'/Category/Index');
		    	}
    		}else
    		{
    			$this->error('添加失败');
    		}
    		exit;
    	}
    	if($_GET['type'])
    	{
    		$parent = $this->_model->select_column($_GET['type'], true);
    	}else
    	{
    		$parent = $this->_model->select_column('0', true);
    	}
    	switch($_REQUEST['type'])
    	{
    		case "1":
    			$column = "文章";
    			break;
    		case "2":
    			$column = "产品";
    			break;
    		case "3":
    			$column = "招聘";
    			break;
    	}
    	$this->assign('column', $column);
    	//z($parent);
    	$title = "新增分类";
    	$this->assign('parent',$parent);
    	$this->assign('title',$title);
    	parent::add();
    }
    
	/**
	 * 编辑栏目(non-PHPdoc)
	 * @see BaseAction::edit()
	 */
    function edit()
    {
        
    	if($_POST)
    	{
    		
            if ($_FILES ['img'] ['size'] != 0) {
                $img_name = $this->UploadFile ();
                $_POST ['img'] = $img_name [1];
            }
            if($_POST['img']){
                    $dir=C('UPLOAD_DIR')."/imgs/";
                    $fiedir=$dir.$id.'/';
                    mkdir($fiedir);
                    foreach ($_POST['img'] as $k => $v) {
                        rename ( $dir.$v,$fiedir . $v );
                    }
                    del_dir($dir);
            }
            $type_id = $this->_model->save($_POST);
    		if(skr_code($_POST['id'],false))
    		{
	    		switch($_REQUEST['type'])
		    	{
		    		case "1":
		    			$this->success('更新成功',__GROUP__.'/Category/article');
		    			break;
		    		case "2":
		    			$this->success('更新成功',__GROUP__.'/Category/goods');
		    			break;
		    		case "3":
		    			$this->success('更新成功',__GROUP__.'/Category/jobs');
		    			break;
		    		default:
		    			$this->success('更新成功',__GROUP__.'/Category/Index');
		    	}
    			
    		}else
    		{
    			$this->error('更新失败');
    		}
    		exit;
    	}
    	$title = "编辑栏目";
    	if($_GET['type'])
    	{
    		$parent = $this->_model->select_column($_GET['type'], true);
    	}else
    	{
    		$parent = $this->_model->select_column('0', true);
    	}
    	$info = $this->_model->find($_REQUEST['id']);
    	//z($info);
    	$selected = $info['parent'];
    	//z($selected);
    	switch($_REQUEST['type'])
    	{
    		case "1":
    			$column = "文章";
    			break;
    		case "2":
    			$column = "产品";
    			break;
    		case "3":
    			$column = "招聘";
    			break;
    	}
    	$this->assign('column', $column);
    	$this->assign('title','编辑分类');
    	$this->assign('sele',$selected);
    	$this->assign('parent',$parent);
    	$this->assign('info',$info);
    	parent::edit();
    }
    function article()
    {
    	$input_hidden = '<input type="hidden" name="type" value="1">';
    	$input_hidden .= '<input type="hidden" name="action" value="'.ACTION_NAME.'">';
    	$this->assign('input_hidden', $input_hidden);
    	$search = array('value'=>'name');
		$this->assign('search', $search);
		
    	//z($this->_model_name);
    	$list = $this->_model->list_column(C('article'));
    	$type = C('article');
    	$this->assign('type', $type);
        foreach ($list as $key => $value) {
            if($value!=0){
                $where=array(
                    "id"=>$value['aid']
                );
                $fi=M('article')->where($where)->find();
                if($fi){
                    switch ($fi['pid']) {
                        case '0':
                            $list[$key]['url']='__GROUP__/Single/edit/id/'.$fi['id'];
                            break;
                        default:
                            $list[$key]['url']='__GROUP__/Article/edit/id/'.$fi['id'];
                            break;
                    }
                }else{
                    $list[$key]['aid']=0;
                    $list[$key]['url']='';
                }
            }else{
                $list[$key]['url']='';
            }
        }
    	$this->assign('list', $list);
    	$title = "文章";
    	$this->assign('title',$title);
    	$this->display('index');
    }
    
    function jobs()
    {
    	$input_hidden = '<input type="hidden" name="type" value="3">';
    	$input_hidden .= '<input type="hidden" name="action" value="'.ACTION_NAME.'">';
    	$this->assign('input_hidden', $input_hidden);
    	$search = array('value'=>'name');
		$this->assign('search', $search);
    	//z($this->_model_name);
    	$list = $this->_model->list_column(C('jobs'));
    	$type = C('jobs');
    	$this->assign('type', $type);
        foreach ($list as $key => $value) {
            if($value!=0){
                $where=array(
                    "id"=>$value['aid']
                );
                $fi=M('article')->where($where)->find();
                if($fi){
                    switch ($fi['pid']) {
                        case '0':
                            $list[$key]['url']='__GROUP__/Single/edit/id/'.$fi['id'];
                            break;
                        default:
                            $list[$key]['url']='__GROUP__/Article/edit/id/'.$fi['id'];
                            break;
                    }
                }else{
                    $list[$key]['aid']=0;
                    $list[$key]['url']='';
                }
            }else{
                $list[$key]['url']='';
            }
        }
    	$this->assign('list', $list);
    	$title = "招聘";
    	$this->assign('title',$title);
    	$this->display('index');
    }
    
    function goods()
    {
    	$input_hidden = '<input type="hidden" name="type" value="2">';
    	$input_hidden .= '<input type="hidden" name="action" value="'.ACTION_NAME.'">';
    	$this->assign('input_hidden', $input_hidden);
    	$search = array('value'=>'name');
		$this->assign('search', $search);
    	
    	//z($this->_model_name);
    	$list = $this->_model->list_column(C('goods'));
    	$type = C('goods');
        //print_r($list);
    	$this->assign('type', $type);
        foreach ($list as $key => $value) {
            if($value["aid"]!=0){
                $where=array(
                    "id"=>$value['aid']
                );
                $fi=M('article')->where($where)->find();
                if($fi){
                    switch ($fi['pid']) {
                        case '0':
                            $list[$key]['url']='__GROUP__/Single/edit/id/'.$fi['id'];
                            break;
                        default:
                            $list[$key]['url']='__GROUP__/Article/edit/id/'.$fi['id'];
                            break;
                    }
                }else{
                    $list[$key]['aid']=0;
                    $list[$key]['url']='';
                }
            }else{
                $list[$key]['url']='';
            }

        }
    	$this->assign('list', $list);
    	$title = "产品";
    	$this->assign('title',$title);
    	$this->display('index');
    }
    function ajax_category(){
        if(isset($_REQUEST[id])){
            $data=$this->_model->save($_REQUEST);
            if($data){
                $data="修改成功!";
            }else{
                $data="修改失败!";
            }
            $this->ajaxReturn($data,'JSON');
            
        }
    }
    /**
     * Ajax获取数据
     * Enter description here ...
     */
    function ajax()
    {
    	switch($_REQUEST['t'])
    	{
    		//获取不同类型栏目的ajax数据
    		case 'type':
    			$data = $this->_model->select_column($_REQUEST['tpye']);
    			$this->ajaxReturn($data,'JSON');
    			break;
    		case 'del':
                $type=getTypeID($_REQUEST['id']);
    			if($data = $this->_model->where("`id` in ($type)")->delete())
    			{
    				$this->ajaxReturn('删除成功','JSON', 1);
    			}else 
    			{
    				$this->ajaxReturn('删除失败','JSON', 0);
    			}
    			break;
    		case 'batch_del':
                $arr=array();
                foreach (explode(',', $_REQUEST['ids']) as $k => $v) {

                    if(!in_array($v,$arr)){
                        $aaa=explode(',',getTypeID($v));
                        $arr=array_merge($arr,$aaa);
                    }
                }
    			$where = array('id'=> array('in', $arr));
    			if($data = $this->_model->where($where)->delete())
    			{
    				$this->ajaxReturn('删除成功','JSON', 1);
    			}else 
    			{
    				$this->ajaxReturn('删除失败','JSON', 0);
    			}
    			break;
    		case 'order':
    			$where = array('id'=>$_REQUEST['id']);
    			//删除上除图片
    			$info = $this->_model->find($_REQUEST['id']);
    			$info['order'] = (int)$_REQUEST['value'];
    			$id = $this->_model->save($info);
    			if($id)
	    		{
	    			$this->ajaxReturn('修改成功','JSON', 1);
	    		}else
	    		{
	    			$this->ajaxReturn('修改失败','JSON', 0);
	    		}
    			break;
    	}
    }
    
    
/**
     * 分类后台搜索
     * Enter description here ...
     */
    public function search($template = null)
    {
		
		$input_hidden = '<input type="hidden" name="type" value="'.$_POST['type'].'">';
    	$input_hidden .= '<input type="hidden" name="action" value="'.$_POST['action'].'">';
    	$this->assign('input_hidden', $input_hidden);
    	$search = array('value'=>'name');
		$this->assign('search', $search);
		
   		 foreach($_POST as $key=>$value)
    	{
    		$this->_where[$key] = array('like','%'.$value.'%');
    	}
    	switch($_POST['action'])
    	{
    		case 'goods':
    			$title = "产品";
    			break;
    		case 'jobs':
    			$title = "招聘";
    			break;
    		case 'article':
    			$title = "文章";
    			break;
    	}
    	$this->assign('title',$title);
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
    /**
     * 生成code值
     * Enter description here ...
     * @param unknown_type $parent_id当前分类ID
     */
    private function make_code($id)
    {
    	$data = $this->_model->find($id);
    	$parent_data = $this->_model->find($data['parent']);
    	$data['code'] = $parent_data['code'].$data['id'].",";
    	$data['type'] = $parent_data['type'];
    	$Type = M('Type');
    	$Type->save($data);
    }
    
}