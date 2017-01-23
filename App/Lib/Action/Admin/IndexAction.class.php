<?php
/**
 * 后台管理框架首页
 * Enter description here ...
 * @author Administrator
 *
 */
class IndexAction extends BaseAction {
	
	public function __construct()
	{
		parent::__construct("Index", 'Config');
	}
	
    /**
     * 后台主框架
     * Enter description here ...
     */
	public function index()
	{
		//$this->__construct();
		$template = __GROUP__."/Index/status";
		$this->assign('template', $template);
    	$this->display();
    }
    
    /**
     * 系统状态
     * Enter description here ...
     */
    public function status()
    {
    	$result = $this->_model->select();
    	foreach($result as $key=>$value)
    	{
    		$config[$value[key]] = $value[value];
    	}
    	$config['web_ip'] = get_client_ip();
    	$this->assign('config', $config);
	
    	/**
	 *  日志
	 *
	 */
	$log=M('log');
	$logs=$log->order('time desc')->limit('10')->select();
	$this->assign('log',$logs);
		
    	$total['article'] 	= D("Article")->where('`pid` != "0"')->count();
    	$total['jobs']		= D("Jobs")->count();
    	$total['order']		= D("Order")->count();
    	$total['apply']		= D("Apply")->count();
    	$total['goods']		= D("Goods")->count();
    	$total['message']	= D("Message")->count();
    	$this->assign('total', $total);
    	
    	$this->display();
    }
    

}