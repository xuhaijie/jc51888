<?php
/**
 * 系统配置管理
 * Enter description here ...
 * @author Administrator
 *
 */
class ConfigAction extends BaseAction {
    function __construct()
    {
    	parent::__construct('Config','Config');
    }
    
    /*
    function edit()
    {
    	if($_POST)
    	{
    		
    		if($_FILES['img']['size'] != 0)
    		{
				$img_name = $this->UploadFile();
				$_POST['img'] = $img_name[0];
    		}
    		
    		if($this->_model->create())
			{
	    		$id = $this->_model->save($_POST);
	    		if($id)
	    		{
	    			$url = '__GROUP__/'.$this->_action_name.'/Index';
	    			$this->success('更新成功',$url);
	    		}else
	    		{
	    			$this->error('更新失败');
	    		}
			}else 
			{
				$this->error($this->_model->getError());
			}
    		exit;
    	}
    	
    	$info = D($this->_model_name)->find($_REQUEST['id']);
    	$this->assign('info',$info);
    	
		$this->display();
		
    }
	*/
}