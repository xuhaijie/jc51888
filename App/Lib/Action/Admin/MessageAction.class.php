<?php
/**
 * 后台留言管理
 * Enter description here ...
 * @author Administrator
http://127.0.0.1/z4.0/index.php/ *
 */
class MessageAction extends BaseAction {
	public function __construct() {
		parent::__construct ( "message", 'message' );
	}

	public function weixin( )
    {
        $step = $_GET['step'];
        if ( $step == 1 )
        {
            $wx_code = $this->config( "wx_code" );
            if ( !$wx_code )
            {
                $wx_code = substr( md5( time( ).rand( 100, 999 ) ), 8, 16 );
                $this->config( "wx_code", $wx_code );
            }
            $this->assign( "wx_code", $wx_code );
        }
        else
        {
            $wx_user = $this->config( "wx_user" );
            if ( $wx_user )
            {
                $user = json_decode( $wx_user, TRUE );
                $this->assign( "user", $user );
            }
            else
            {
                $this->redirect( "Message/weixin", "step=1" );
            }
        }
        $this->display( );
    }

    public function qrcode( )
    {
        $wx_code = $this->config( "wx_code" );
     
        $parmas['action'] = "qrcode";
        $parmas['code'] = $wx_code;
        $parmas['from'] = 1;
        $res = http_transport( "http://mswx.myqingfeng.cn/api.php", $parmas, "GET" );
        header( "Content-type: image/jpeg" );
        echo $res;
        exit( );
    }

    public function wxuser( )
    {
        $wx_code = $this->config( "wx_code" );
        $parmas['action'] = "user";
        $parmas['code'] = $wx_code;
        $parmas['url'] = urlencode( "http://".$_SERVER['HTTP_HOST'].__ROOT__."/" );
        $parmas['from'] = 1;
        $ret = http_transport( "http://mswx.myqingfeng.cn/api.php", $parmas, "GET" );
        $data = json_decode( $ret, TRUE );
        if ( $data['status'] == 1 )
        {
            $this->config( "wx_user", $data['msg'] );
            echo "ok";
        }
        else
        {
            echo $data['msg'];
        }
        $ret = http_transport( "http://mswx.myqingfeng.cn/api.php", $parmas, "GET" );
        exit( );
    }

    public function unlink( )
    {
        $openid = $_GET['id'];
        $wx_code = $this->config( "wx_code" );
        $parmas['action'] = "unlink";
        $parmas['userid'] = $openid;
        $parmas['code'] = $wx_code;
        $ret = http_transport( "http://mswx.myqingfeng.cn/api.php", $parmas, "GET" );
        $data = json_decode( $ret, TRUE );
        if ( $data['status'] == 1 )
        {
            $this->config( "wx_user", $data['msg'] );
            $this->success( "取消绑定成功", u( "message/weixin" ) );
            exit( );
        }
        $this->error( $data['msg'], u( "message/weixin" ) );
        exit( );
    }
	// public function index() {
	// 	if ($_POST) {
		
	// 		if ($this->_model->create ()) {
	// 			$id = $this->_model->save ( $_POST );
	// 			if ($id) {
	// 				$url = U ( 'admin/message/index' );
	// 				$this->success ( '添加成功', $url, C ( 'JUMP_TIME' ) );
	// 			} else {
	// 				$this->error ( '添加失败' );
	// 			}
	// 		} else {
	// 			die ( 'model创建失败' );
	// 		}
			
	// 		exit ();
	// 	}
	// 	parent::index ();
	// }
	/**
	 * Enter description here .
	 * ..
	 */
}