<?php
	/**
	 * 基础框架
	 * Enter description here ...
	 * @author Administrator
	 *
	 */
	class CommonAction extends Classskr {

		function __construct()
		{
			//建议放置在thinkphp框架内
			//检测是否授权
			//check_authorization();
		}

		/**
		 * 日志记录
		 * Enter description here ...
		 * @param unknown_type $acton 动作
		 */
	    protected function log($acton)
	    {
	    	$Log = M('Log');
	    	$data = array('action'=>$acton, 'user'=>$_SESSION['username'], 'ip'=>get_client_ip());
	    	$Log->add($data);
	    }
	    /**
	     * 日志记录
	     * Enter description here ...
	     * @param unknown_type $acton 普通用户登陆log
	     */
	    protected function lognmal($acton)
	    {
	    	$Log = M('Log');
	    	$data = array('action'=>$acton, 'user'=>$_SESSION['n_username'], 'ip'=>get_client_ip());
	    	$Log->add($data);
	    }
	    
	    /**
	     * 读取设置配置参数
	     * Enter description here ...
	     * 当key值为空时,读取所有配置信息key对应数据库字段的key,value对应数据库字段value.
	     * 只有key值的时候,是读取配置,有Value时,就是修改配置
	     * @param unknown_type $key
	     * @param unknown_type $value
	     */
	     protected function config( $key = NULL, $value = NULL )
    {
        if ( $key == NULL )
        {
            $result = m( "config" )->select( );
            foreach ( $result as $key => $value )
            {
                $config[$value[key]] = $value[value];
            }
			//客服qq处理
	    		$config['kefu_qq']=explode('|', $config['kefu_qq']);
	    		foreach ($config['kefu_qq'] as $key => $value) {
	    			$temp=explode(':', $value);
	    			$tempvlue[name]=$temp[0];
	    			$tempvlue[qq]=$temp[1];
	    			$kf[]=$tempvlue;
	    		}
	    		$config['kefu_qq']=$kf;
                $this->assign('kfqq',$config['kefu_qq']);
				
            return $config;
        }
        $result = m( "config" )->where( "`key`='".$key."'" )->select( );
        if ( $value === NULL )
        {
            return $result[0]['value'];
        }
        $data = array(
            "value" => $value
        );
        m( "config" )->where( "`key`='".$key."'" )->save( $data );
        return TRUE;
    }
		
	    /**
	     * 404跳转
	     * Enter description here ...
	     */
	    protected function _404(){
			header("HTTP/1.1 404 Not Found");
			$this->display('Public:404');
			exit;
		}
		/**
		 * 判断是否登陆状态
		 *
		 * @return boolean
		 * 登陆成功返回 true 否则返回 false
		 */
		public function is_login() {
			if (!empty($_SESSION ['user']['id'])) {
				return true;
			}
			return false;
		}
	}

?>