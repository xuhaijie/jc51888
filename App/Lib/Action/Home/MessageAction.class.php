<?php
class MessageAction extends BaseAction {
	public function index() {
		
		$this->header_seo ();
		//
		$message = M ( 'message' )->where ( 'is_show=1' )->limit ( 20 )->order ( 'time desc' )->select ();
		$this->assign ( 'message', $message );
		$this->display ();
	}
	public function message_info(){
		$id= intval($_GET['id']);
		$message = M ( 'message' )->where ( "`id`='$id'" )->find ();
		$this->assign ( 'message', $message );
		$this->display ();

	}
	public function add_message( )
    {
        if ( $_SESSION['verify'] != md5( $_POST['captcha'] ) )
        {
            $this->error( "验证码错误！" );
        }
        $message = m( "message" );
        $this->safe( );
        $data = $_POST;
        // if ( !preg_match( "/^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1})|(17[0-9]{1}))+\\d{8})\$/", $data['tel'] ) || !preg_match( "/^(([0\\+]\\d{2,3}-)?(0\\d{2,3})-)?(\\d{7,8})(-(\\d{3,}))?\$/", $data['tel'] ) )
        // {
        //     $this->error( "电话格式错误，请输入正规的手机号码或者固话" );
        // }
        // if ( !preg_match( "/^\\w+((-\\w+)|(\\.\\w+))*\\@[A-Za-z0-9]+((\\.|-)[A-Za-z0-9]+)*\\.[A-Za-z0-9]+\$/", $data['email'] ) )
        // {
        //     $this->error( "邮箱格式错误，请输入合法的邮箱地址" );
        // }
        $data['ip'] = get_client_ip( );
        $data['time'] = date( "Y-m-d H:i:s" );
        $count = m( "message" )->where( array(
            "ip" => $data['ip'],
            "time" => array(
                "like",
                date( "Y-m-d" )."%"
            )
        ) )->count( );
        if ( m( "message" )->add( $data ) )
        {
            $wx_code = $this->config( "wx_code" );
            $wx_user = $this->config( "wx_user" );
            if ( $wx_user )
            {
                $post['user'] = $data['name'];
                $post['tel'] = $data['tel'];
                $post['address'] = $data['add'];
                $post['email'] = $data['email'];
                $post['content'] = $data['content'];
                $post['ip'] = $data['ip'];
                $post['realadd'] = $data['realadd'];
                $post['time'] = $data['time'];
                $ret = http_transport( "http://mswx.myqingfeng.cn/api.php?action=data&from=1&code=".$wx_code, $post );
            }
            $this->success( "留言成功" );
        }
        else
        {
            $this->error( "留言失败,请稍候再试" );
        }
    }
}
?>