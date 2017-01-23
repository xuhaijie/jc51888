<?php
	class SitemapAction extends BaseAction{
		public function index(){
			
			//设置时间
			$time['time']=date("Y-m-d H:i:s");
			$this->assign("time",$time);

			//查询导航的数据源
			$nav=M("nav");
			$nav_arr=$nav->where("`url`<>''")->select();
			$this->assign("nav_arr",$nav_arr);

			//查询新闻的数据源
			$type=D("Type");
			$type_a=$type->where("code like '%4%'")->select();
			$str="";
			foreach ($type_a as $key => $value) {
				$str.=$value[id].",";
			}
			$str=substr($str,0,-1);
			$news=M("article");
			$news_arr=$news->where("pid in ($str)")->order(" `time` desc")->select();
			$this->assign("news_arr",$news_arr);

			// 网站配置
			C ( 'DEFAULT_THEME', $this->config ( 'current_theme' ) );
			$config = $this->config ();
			$this->assign ( 'config', $config );

			//查询产品类别数据源/
			$product_type=$type->where("code like '%2%'")->select();
			$this->assign("product_type",$product_type);

			//查询所有产品的详情
			$str_pro="";
			foreach ($product_type as $key => $value) {
				$str_pro.=$value[id].",";
			}
			$str_pro=substr($str_pro,0,-1);
			$product_query=M("goods");
			$product_arr=$product_query->where("pid in ($str_pro) and `flag` = 0 ")->order(" `time` desc")->select();
			$this->assign("product_arr",$product_arr);			
			$this->display ();
		}
	}

?>