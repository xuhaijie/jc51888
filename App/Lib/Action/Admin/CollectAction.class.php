<?php
/**
 * 后台首页框架首页
 * @author Administrator
 *
 */
class CollectAction extends BaseAction {
	private $colum = array();
	function __construct()
	{
		set_time_limit(0);
		parent::__construct('article','article');
	}
	public function select_data($parent)
	{
		$where['parent'] = $parent;
		$data = M("Type")->where($where)->order('`order` desc,id desc')->select();
		foreach($data as $key=>$value)
		{
			if($value['id'] != '3')
			{
				$code=substr($value['code'], 0,$length-1);
				$code = explode(',', $code);
				$separator = '';
				foreach ($code as $k => $v)
				{	 
					$separator .= "&nbsp;&nbsp;&nbsp;&nbsp;";	
				}
				$value['name'] = $separator . $value['name'];
				$this->colum[] = $value;
				$this->select_data($value['id']);
			}
		}
		return $this->colum;
	}
	public function fake_header($queryURL)
	{ 
		import('ORG.Net.Http');
		$http = new Http();
		$result = $http->fsockopenDownload($queryURL);
		$wcharset = preg_match("/<meta.+?charset=[^\w]?([-\w]+)/i",$result,$temp) ? strtolower($temp[1]):"";
		if($wcharset && strtolower($wcharset) != 'utf-8')
		{
			$result = iconv($wcharset, 'UTF-8', $result);
		}
		return $result;
	}
	public function index()
	{
		$type =$this->select_data(0);
		$this->assign('type',$type);
		$this->display();	
	}
	public function ajax_collect()
	{
			import("ORG.Util.PhpQuery");
			import("ORG.Util.QueryList");
			//获取采集对象
			$ql = new QueryList();
			foreach($_REQUEST as $k=>$v)
			{
				$_REQUEST[$k] = str_replace('"',"'",$v);
			}
			$str_rule 				= $_REQUEST['str_rule'];
			$str_set1 				= $_REQUEST['str_set1'];
			$str_set2 				= $_REQUEST['str_set2'];
			$title_select 			= $_REQUEST['title_select'];
			$title_select_order		= $_REQUEST['title_select_order'];
			$img_select 			= $_REQUEST['img_select'];
			$img_select_order		= $_REQUEST['img_select_order'];
			$content_select 		= $_REQUEST['content_select'];
			$content_select_order 	= $_REQUEST['content_select_order'];
			$content_select_filter  = $_REQUEST['content_select_filter'];
			$time_select 			= $_REQUEST['time_select'];
			$time_select_order 		= $_REQUEST['time_select_order'];
			$i 						= $_REQUEST['i'];
			$url = str_replace("[参数]",$i,$str_rule);
			cookie('str_rule',$str_rule);
			cookie('str_set1',$str_set1);
			cookie('str_set2',$str_set2);
			cookie('title_select',$title_select);
			cookie('title_select_order',$title_select_order);
			cookie('img_select',$img_select);
			cookie('img_select_order',$img_select_order);
			cookie('content_select',$content_select);
			cookie('content_select_order',$content_select_order);
			cookie('content_select_filter',$content_select_filter);
			cookie('time_select',$time_select);
			cookie('time_select_order',$time_select_order);
			if($title_select)
			{
				$title = $ql->Query($this->fake_header($url),array('title'=>array($title_select,'text')),'','utf-8')->data;
				if(!$title)
				{
					$title = $ql->Query($url,array('title'=>array($title_select,'text')),'','utf-8')->data;
				}
				$map['title'] = (int)$title_select_order == 0 ? $title[0]['title'] : $title[(int)$title_select_order-1]['title'];
			}
			if($img_select)
			{
				$img = $ql->Query($this->fake_header($url),array('img'=>array($img_select,'src')),'','utf-8')->data;
				if(!$img)
				{
					$img = $ql->Query($url,array('img'=>array($img_select,'src')),'','utf-8')->data;
				}
				$map['img'] = (int)$img_select_order == 0 ? $img[0]['img'] : $img[(int)$img_select_order-1]['img'];
				//解析url
				$parse_url  = parse_url($str_rule);
				$url_host   = $parse_url['scheme']. '://' .$parse_url['host'];
				//解析img
				$parse_img  = parse_url($map['img']);
				if($map['img'][0] != '/')
				{
					$pathArr = explode("/", $parse_url['path']);
					$url_host = $url_host . '/' . $pathArr[1] . '/';
				}
				if($parse_img['scheme'] != '' && $parse_img['host'] != '' && $parse_img['path'] != '')
				{
					$img_url    = $parse_img['scheme'].'://'.$parse_img['host'].$parse_img['path'];
				}
				else
				{
					$img_url    = $url_host.'/'.$parse_img['path'];
				}
				//下载图片
				$map['img'] = $this->upload_img($img_url);
			}
			if($content_select)
			{
				$content = $ql->Query($this->fake_header($url),array('content'=>array($content_select,'html',$content_select_filter)),'','utf-8')->data;
				if(!$content)
				{
					$content = $ql->Query($url,array('content'=>array($content_select,'html',$content_select_filter)),'','utf-8')->data;
				}
				$map['content'] = (int)$content_select_order == 0 ? $content[0]['content'] : $content[(int)$content_select_order-1]['content'];	
				//str_replace('/Uploads/image/20151201/1448978193862701.jpg','/Uploads/',$map['content']);	
				if(preg_match_all('/<\s*img\s+[^>]*?src\s*=\s*(\'|\")(.*?)\\1[^>]*?\/?\s*>/i',$map['content'],$match))
				{
					$img_array = array_unique($match[2]);
					foreach($img_array as $k=>$v)
					{
						//解析url
						$parse_url  = parse_url($str_rule);
						$url_host   = $parse_url['scheme']. '://' .$parse_url['host'];
						//解析img
						$parse_img  = parse_url($v);
						if($v[0] != '/')
						{
							$pathArr = explode("/", $parse_url['path']);
							$url_host = $url_host . '/' . $pathArr[1] . '/';
						}
						if($parse_img['scheme'] != '' && $parse_img['host'] != '' && $parse_img['path'] != '')
						{
							$img_url    = $parse_img['scheme'].'://'.$parse_img['host'].$parse_img['path'];
						}
						else
						{
							$img_url    = $url_host.'/'.$parse_img['path'];
						}
						//下载图片
						$savename = $this->upload_img($img_url,0);
						if($savename)
						{
							$map['content'] = str_replace($v,__ROOT__.'/'.C('UPLOAD_DIR').'/'.$savename,$map['content']);
						}
					}
				}
			}
			if($time_select)
			{
				$time = $ql->Query($this->fake_header($url),array('time'=>array($time_select,'text')),'','utf-8')->data;
				if(!$time)
				{
					$time = $ql->Query($url,array('time'=>array($time_select,'text')),'','utf-8')->data;
				}
				$map['time']= (int)$time_select_order == 0 ? $time[0]['time'] : $time[(int)$time_select_order-1]['time'];
			}
			$map['i'] = $i;
			print_r(json_encode($map));
	}
	public function ajax_insert()
	{
		foreach($_REQUEST as $k=>$v)
		{
			if($v != 'undefined' && $v !='null' && $k != 'tr_id')
			{
				$map[$k] = str_replace("%26","&",$v);
			}
		}
		if($map['img'])
		{
			$map['img1'] = $map['img'];
		}
		$tr_id = $_REQUEST['tr_id'];
		$type = M("Type")->where(array("id"=>$map['pid']))->find();
	 	$table =  in_array('1',explode(',',$type['code'])) ? 'Article' : 'Goods' ;
	 	$result = M($table)->add($map);
	 	if($result)
	 	{
	 		print_r($tr_id);
	 	}
	}
	//采集图片,返回保存后的图片名
	public function upload_img($img_url,$thumb = 1)
	{
		//判断链接是否能打开
		$header = get_headers($img_url);
		$have = 0;
		foreach($header as $k=>$v)
		{
			if(in_array('200',explode(' ',$v)))
			{
				$have = 1;
			}
		}
		if(!$have)
		{
			$savename = '';
		}
		else
		{
			//判断图片链接是否合法
			$array = explode('.',$img_url);
			if(!in_array('jpg',$array) && !in_array('jpeg',$array) && !in_array('gif',$array) && !in_array('png',$array) && !in_array('bmp',$array) && !in_array('JPG',$array))
			{
				$savename = '';
			}
			else
			{
				import('ORG.Net.Http');
				$http = new Http();
				//下载后的图片保存名称
				$savename = uniqid().substr($img_url,strripos($img_url,'.'));
				$http->curlDownload($img_url,C('UPLOAD_DIR').$savename);
				if($thumb)
				{
					import('ORG.Util.Image');
					$image = new Image();
					$image->thumb(C('UPLOAD_DIR').$savename,C('UPLOAD_DIR').'m_'.$savename,'','300','300');
				}
			}
		}
		return $savename;
	}
	//检查更新
	public function check_update()
	{
		import("ORG.Net.Http");
		import("ORG.Util.PclZip");
		$http = new Http();
		$http->curlDownload('http://dnjx888.243.greensp.cn/collect/kiki.zip','kiki.zip');
		$archive = new PclZip('kiki.zip'); 
		if ($archive->extract(PCLZIP_OPT_PATH, 'data',PCLZIP_OPT_REMOVE_PATH, 'install/release') == 0) {  
			die("Error : ".$archive->errorInfo(true));  
		}
		$current_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$update_url = str_replace('Admin/collect/check_update','data/update.php',$current_url);
		$update_result = file_get_contents($update_url);
		$result = array();
		if($update_result)
		{
			$install_url = str_replace('Admin/collect/check_update','data/install.php',$current_url);
			$install_result = file_get_contents($install_url);
			$config = file_get_contents("http://dnjx888.243.greensp.cn/collect/update_log.php");
			$config_data = json_decode($config,true);
			$result['info'] = $install_result;
			$result['collect_version'] = $config_data['COLLECT_VERSION'];
			$result['collect_log'] = $config_data['COLLECT_LOG'];
			$result['collect_time'] = $config_data['COLLECT_TIME'];
		}
		else
		{
			import("ORG.Util.File");
			$file = new File();
			$file->unlinkDir('data');
			$file->unlinkFile('kiki.zip');
			$result['info'] = 'false';
		}
		print_r(json_encode($result));
	}
	public function ajax_bug()
	{
		import("ORG.Util.Smtp");
		$smtpserver = "smtp.163.com";
		$smtpserverport = 25;
		$smtpusermail = "15617992374@163.com";
		$smtpemailto = "409703312@qq.com";
		$smtpuser = "15617992374";//SMTP服务器的用户帐号 
		$smtppass = "suiyu123"; //SMTP服务器的用户密码
		$mailsubject = "Collect反馈";
		$mailbody = str_replace("%26","&",$_REQUEST['text']);
		$mailtype = "html";
		$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);
		$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
		echo 1;
	}
	public function getUrlId()
	{
		$count = (int)$_REQUEST['get_page'] <= 1 ? 2 : (int)$_REQUEST['get_page'];
		import("ORG.Util.PhpQuery");
		import("ORG.Util.QueryList");
		$ql = new QueryList();
		$arr = array();
		for($i = 1; $i<=$count;$i++)
		{
			$url = str_replace("[参数]",$i,$_REQUEST['get_listurl']);
			$a = $ql->Query($this->fake_header($url),array('a'=>array($_REQUEST['get_cp'],'href')),'','utf-8')->data;
			if(!$a)
			{
				$a = $ql->Query($url,array('a'=>array($_REQUEST['get_cp'],'href')),'','utf-8')->data;		
			}
			foreach($a as $k => $v)
			{
				$arr[] = $v['a'];
			}
		}
		$arr = array_filter(array_unique($arr));
		$str_id = '';
		$str_count = 0;
		foreach($arr as $k=>$v)
		{
			$str = str_replace($this->main($v,$_REQUEST['get_cpurl']) , '' ,$v);
			if($str)
			{
				$str_id .= str_replace($this->main($v,$_REQUEST['get_cpurl']) , '' ,$v) .',';
				$str_count++;
			}
			
		}
		$result = array('str_id' => $str_id , 'str_count' => $str_count);
		print_r(json_encode($result));

	}
	function main($str1, $str2) {
		//将字符串转成数组
		$arr1 = str_split($str1);
		$arr2 = str_split($str2);
		//计算字符串的长度
		$len1 = strlen($str1);
		$len2 = strlen($str2);
		//初始化相同字符串的长度
		$len = 0;
		//初始化相同字符串的起始位置
		$pos = -1;
		for ($i = 0; $i < $len1; $i++) {
			for ($j = 0; $j < $len2; $j++) {
				//找到首个相同的字符
				if ($arr1[$i] == $arr2[$j]) {
					//判断后面的字符是否相同
					for ($p = 0; (($i + $p) < $len1) && 
						(($j + $p) < $len2) && 
						($arr1[$i + $p] == $arr2[$j + $p]) && 
						($arr1[$i + $p] <> ''); $p++);
					if ($p > $len) {
						$pos = $i;
						$len = $p;
					}
				}
			}
		} 
		if ($pos == -1) {
			return ;
		} else {
			return substr($str1, $pos, $len);
		}
	}
}