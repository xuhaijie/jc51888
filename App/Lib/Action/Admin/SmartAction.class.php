<?php
/**
 * 后台智能标签管理
 * Enter description here ...
 * @author Administrator
 *
 */
function login_encrypt( $aid, $token )
{
    $key = "qfyxb_login";
    $str = str_rot13( base64_encode( time( ).md5( $key ) )."a".md5( "zm" ).$token.dechex( $aid ) );
    $len = strlen( $str );
    $i = 0;
    for ( ; $i < $len; ++$i )
    {
        $char[] = ord( substr( $str, $i ) );
    }
    return base64_encode( json_encode( $char ) );
}
class SmartAction extends BaseAction {
	/**
	 * 
	 * Enter description here ...
	 */
	public function __construct()
	{
		parent::__construct("Smart",'Config');
	}
	
	/**
	 * 查看智能标签
	 * Enter description here ...
	 */
	public function view()
	{
		$where = 'group_id = 2';
		$result = $this->_model->where($where)->select();
		$info = $result[0];
		
		$smart_list = $result;
		$this->assign('info', $info);
		$this->assign('smart_list', $smart_list);
		$this->display();
	}
	
	public function baidu()
	{
		$switch_mbaidu = $this->config('switch_mbaidu');
		$this->assign('switch_mbaidu',$switch_mbaidu);
		$this->display();
	}
	
	public function ajax()
	{
		$state = 1;
		switch ($_REQUEST['t'])
		{
			case 'tag': //获取模板标签
				$info = M('config')->find($_REQUEST['id']);
				$result = $info['value'];
				if($result)
				{
					$this->ajaxReturn($result,'JSON', 1);
				}else {
					$this->ajaxReturn('','JSON', 0);
				}
				break;
			case 'baidu':
				$data = M('config')->where('`key`="switch_mbaidu"')->select();
				$info = $data[0];
				$info['value'] = $_GET['v'];
				M('config')->save($info);
				break;
			case 'repair': //修复
				$repair = explode(',', $_GET['name']);
				foreach($repair as $key=>$value)
				{
					$flag = M()->execute("REPAIR TABLE `".$$value."`");
					if($flag)
					{
						$state = '0';
					}
				}
				if($state)
				{
					$this->ajaxReturn('修复成功','JSON', 1);
				}else {
					$this->ajaxReturn('修复失败','JSON', 0);
				}
				break;
			case 'optimize': //优化
				$optimize = explode(',', $_GET['name']);
				foreach($optimize as $key=>$value)
				{
					$flag = M()->execute("OPTIMIZE TABLE `".$$value."`");
					if($flag)
					{
						$state = '0';
					}
				}
				if($state)
				{
					$this->ajaxReturn('优化成功','JSON', 1);
				}else {
					$this->ajaxReturn('优化失败','JSON', 0);
				}
				break;
		}
		exit;
	}
	
	 /**
	     * 清除缓存操作
     * Enter description here ...
     */
    public function clearcache()
    {
    	import('ORG.Util.File');
    	$temp_dir = dirname(__FILE__).'/../../../'.C('TEMP_DIR');
    	session('left_menu', null);
    	//debug($temp_dir);
    	$this->del_install();
    	if(is_dir($temp_dir))
		{
			File::unlinkDir($temp_dir);
			$this->success('清除缓存成功！', __GROUP__."/Index/status");
		}else 
		{
			$this->error('清除缓存失败！');
		}
    }
    
    /**
     * 数据优化
     * Enter description here ...
     */
    public function optimization()
    {
    	$table_name = M()->query('SHOW TABLES');
    	foreach($table_name as $key=>$value)
    	{
    		 $list[$key]['name'] = implode(',',$value);
    		 $table = $list[$key]['name'];
    		 $table_state = M()->query("CHECK TABLES $table");
    		 $list[$key]['state'] = $table_state[0][Msg_text];
    	}
    	$this->assign('list',$list);
    	$this->display();
    }

    /**
     * 清除安装包
     * Enter description here ...
     */
    private function del_install()
    {
    	$file_install 	= ROOT.'/install.php';
    	$dir_install 	= ROOT.'/App/Tpl/Install';
    	$tpl_install	= ROOT.'/App/Lib/Action/Install'; 
    	if(is_file($file_install))
    	{
    		//z('清除安装包');
    		import("ORG.Util.File");
			$file = new File;
			$file->unlinkFile($file_install);
			$file->unlinkDir($dir_install);
			$file->unlinkDir($tpl_install);
    	}
    }

    //  public function qftouch( )
    // {
    //     if ( $_POST )
    //     {
    //         if ( c( "API_STATUS" ) == "ok" )
    //         {
    //             return FALSE;
    //         }
    //         set_time_limit( 0 );
    //         $api_url = "http://www.qftouch.com/api.php";
    //         $api_id = $_POST['api_id'];
    //         $api_secret = $_POST['api_secret'];
    //         $params = array(
    //             "action" => "check",
    //             "appid" => $api_id,
    //             "signature" => md5( $api_secret )
    //         );
    //         $response = http_transport( $api_url, $params );
    //         if ( $response === "ok" )
    //         {
    //             $config_path = APP_PATH."Conf/api.php";
    //             $params['action'] = "url";
    //             $config_data['API_URL'] = $api_url;
    //             $config_data['M_URL'] = "http://".http_transport( $api_url, $params );
    //             $config_data['API_ID'] = $api_id;
    //             $config_data['API_SECRET'] = $api_secret;
    //             $config_data['API_VERSION'] = "1.1";
    //             $config_data['API_STATUS'] = "ok";
    //             $config_data = var_export( $config_data, TRUE );
    //             $str_data = "<?php\n return ".$config_data.";";
    //             if ( file_put_contents( $config_path, $str_data ) )
    //             {
    //                 $api = a( "Home/Api" );
    //                 $api->debug = TRUE;
    //                 $api->index( "synchro" );
    //                 $this->success( "激活成功！" );
    //             }
    //             else
    //             {
    //                 $this->error( "写入配置文件失败，请检查Conf文件夹权限" );
    //             }
    //         }
    //         else
    //         {
    //             $this->error( "请检查填写信息是否正确！" );
    //         }
    //     }
    //     if ( c( "API_STATUS" ) == "ok" )
    //     {
    //         $api_status = c( "API_STATUS" );
    //         $api_id = c( "API_ID" );
    //         $api_secret = c( "API_SECRET" );
    //         $token = encrypt( strval( time( ) ), $api_secret );
    //         $this->assign( "api_status", $api_status );
    //         $this->assign( "appid", $api_id );
    //         $this->assign( "token", $token );
    //     }
    //     $this->display( );
    // }

    public function liuliangbao( )
    {
        $config = $this->config( );

        if ( !array_key_exists( "liuliangbao", $config ) )
        {
            $table['key'] = "liuliangbao";
            $table['name'] = "流量宝";
            $table['type'] = "text";
            $table['group_id'] = "0";
            m( "config" )->add( $table );
        }


        $liuliangbao = json_decode( $config['liuliangbao'], TRUE );


        if ( empty( $liuliangbao['id'] ) )
        {
            $rand = uniqid( );
            $post = array(
                "username" => "temp_".$rand,
                "password" => $rand,
                "company" => $this->config( "web_name" ),
                "domain" => $this->config( "web_url" ),
                "aid" => 0
            );
            $token = encrypt( strval( time( ) ), "qfyxb" );
            $api_url = "http://yxb.qftouch.com/admin/api.php?action=register&token=".$token;
            $res = http_transport( $api_url, $post );
            $res = json_decode( $res, TRUE );
            if ( $res['state'] != "error" )
            {
                $liuliangbao = json_encode( $res['data'] );
                $this->config( "liuliangbao", $liuliangbao );
            }
            $liuliangbao = json_decode( $liuliangbao, TRUE );
        }
        $key = login_encrypt( $liuliangbao['id'], $liuliangbao['token'] );
        $demo_url = "http://yxb.qftouch.com/zm.php?key=".$key;
        $this->assign( "demo_url", $demo_url );
        
        $this->display( );
    }

}