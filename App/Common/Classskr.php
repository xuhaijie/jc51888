<?php
	class Classskr extends Action {
/**

 * 参数：$pid: 返回值：嵌套数组形式的类别树 $depth = 0 返回父类下所有类别 $depth = N 返回父类下N层类别

 */
 function get_list($pid,$tpname,$num=5,$type='article',$fl){
 		$pid=explode(":",$pid);
 		if($tpname=="article"){
	 		$type=$tpname;
	 		$tpname='news'.$pid[0];
	 	}elseif ($tpname=="goods") {
	 		$type=$tpname;
	 		$tpname='pr'.$pid[0];
	 	}elseif (is_numeric($tpname)) {
	 		$num=$tpname;
	 		$tpname='news'.$pid[0];
	 	}
	 	if($pid[1]){
	 		if(stripos($pid[0],',')){
	 			$pid=explode(",",$pid[0]);
	 			foreach ($pid as $k => $v) {
	 				$pid2.=getTypeID($v).',';
	 			}
	 			$pid=implode(',',array_unique(explode(',',rtrim($pid2,','))));
	 		}else{
	 			$pid=getTypeID($pid[0]);
	 		}
	 	}else{
	 		$pid=$pid[0];
	 	}
	 	if(!($type=='article' || $type=='goods')){
	 		$type=='article';
	 	}
		$num=$num?$num:100;
		$fl = $fl?"and `is_".$fl."`=1":'';
     $va=M($type)->where("`pid` in ($pid) and `order` <> 0 and `flag`='0'".$fl)->limit($num)->order('`order` desc,`id` desc')->select();
     if ($type=='goods') {
     		foreach ($va as $key => $value) {
     			$va[$key]['imgs']=explode(',',$value['imgs']);
     			//$va[$key]['tid']=M($type)->where("`pid` in ($pid) and `order` <> 0 and `flag`='0'".$fl)->limit($num)->order('`order` desc,`id` desc')->select();
     		}
     }
     $this->assign($tpname,$va);
     return $va;
}
/**

 * 作用：获取新品等
 * $fl：新品：new 促销：best 热销：hot；
 * $tpname:输出到页面的变量名称
 * $num:个数(默认6个)
 * $pid:查询产品所在ID分类:1,0
 * $a:是否查询子类(默认查询true,不查询false)

 */
 function get_is($fl,$tpname,$num=6,$pid='2:true'){
	$this->get_list($pid,$tpname,$num=6,'goods',$fl);
}
/**

 * 作用：获取单页
 * $id:单页ID（可为新闻内容或产品内容($)）
 * $tpname:输出到页面的变量名称
 * $type:查询表
 */
 function get_dy($id,$tpname,$type='article'){
 	if($tpname=="article" || $tpname=="goods"){
 		$va=M($tpname)->where("`id` = ($id)")->find();
 	}elseif($type=="article" || $type=="goods"){
 		$va=M($type)->where("`id` = ($id)")->find();
 		$this->assign($tpname,$va);
 	}
    return $va;
}
/**

 * 作用：获取"产品"或"新闻"的"个数"或"内容"($this->type_tree())
 * $type:使用$this->type_tree()查询出来的内容
 * $a:变量为1为数量,2为产品详情(全部)
 * $b:查询表"article"(默认) or "goods" 
 * $c:是否查询计算子类
 * 
 */
function get_son($type,$a=1,$b='article',$c=true)
	{
		if(!($b=='article' || $b=='goods')){
	 		$b=='article';
	 	}
		foreach ($type as $key => $value) {
			$pid =$c?getTypeID ($value['id']):$pid;
			if($type[$key]['aid']!=0){
				$aid=array("id"=>$type[$key]['aid']);
				$type[$key]['aid']=M('article')->where($aid)->find();
			}
			if($a==1){
				$type[$key]['count'] = M ( $b )->where ( "`pid` in ($pid) and `order`<>0 and `flag`='0'" )->count ();
			}elseif($a==2){
				$type[$key]['count'] = M ( $b )->where ( "`pid` in ($pid) and `order`<>0 and `flag`='0'" )->order('`order` desc,`id` desc')->select ();
			}
			if($value['son']){
				$type[$key]['son']=$this->get_son($value['son'],$a,$b);
			}
		}
		return $type;
	}
//处理导航
	function cl_nav($value='',$name)
	{
		$str='';
			foreach ($value['cun'] as $k => $v) {
				$str.=$this->cl_nav($v,$name);
				if($v['url']){
					$v=explode('/',$v['url']);
					$c=count($v);
					if($c>=1){
						$b=$c==1?'':$v[$c-1];
						$v[0]=ucfirst($v[0]);
						$str.="$v[0],$name,false,$b,$c;";
					}
				}
				
				//z($str);
			}

			return $str;
		
	}
	function cl2_nav($value='',$name)
	{
		$str='';
			foreach ($value['son'] as $k => $v) {
				$str.=$this->cl2_nav($v,$name);
				if($v['url']){
					$v=explode('/',$v['url']);
					$c=count($v);
					if($c>=1){
						$b=$c==1?'':$v[$c-1];
						$v[0]=ucfirst($v[0]);
						$str.="$v[0],$name,false,$b,$c;";
					}
				}
				
				//z($str);
			}

			return $str;
		
	}
/**

*$pname(名称,转变后的名称,是否带后数字(ture,false),判断的数值) arr:id可用数组(导航) arr2:id2可用数组(侧边栏)
*	$arr2="Product:".";News:".";Custom:";
*	$this->pdarr("","3",$arr2);
*
*/
 function skr_pdarr($arr=0,$arr2=0,$pname=0){
	$lid['name']=MODULE_NAME;
	$lid["oid"]["name"]=MODULE_NAME;
	$lid["oid"]["sd"]=1;
	$pd=ture;
	$pd2=false;
	$idp=$_GET ['id'];
	$typep=$_GET ['type'];

	//如果是传的值为id
	if($idp>0){
		$lid["oid"]["id"]=$idp;
		$lid["oid"]["sd"]=2;
		//判断当前地址然后取相对应的参数
		switch (MODULE_NAME) {
			case 'Product' :
				$va=M('goods')->where("`id` = '$idp'")->find();
				$lid['title']=$va['title'];
				$lid['id']=$va['pid'];
				break;
			case 'News' :
				$va=M('article')->where("`id` = '$idp'")->find();
				$lid['title']=$va['title'];
				$lid['id']=$va['pid'];
				break;
			case 'Custom' :
				$va=M('article')->where("`id` = '$idp'")->find();
				$lid['title']=$va['title'];
				$lid['id']=$va['id'];
				break;
			default :
		}
		$pd2=ture;
		//$lid['title']=$pname;
	//如果传的值为type
	}elseif($typep>0){
		$lid["oid"]["id"]=$typep;
		$lid["oid"]["sd"]=3;
		//取type相对应的名称
		$va=M('type')->where("`id` = '$typep'")->find();
		$lid['title']=$va['name'];
		$pd2=ture;
	//如果没有传值(特殊处理)
	}else{
		switch (MODULE_NAME) {
			case 'Product' :
				$typep=2;
				break;
			case 'News' :
				$typep=4;
				break;
			case 'Custom' :
				break;
			default :
		}
		$va=M('type')->where("`id` = '$typep'")->find();
		$lid['title']=$va['name'];
	}
	$lid["oid"]["title"]=$va;
	if($pd2){
		if(!is_array($arr))$arr=explode(",",$arr);
		if(in_array($idp,$arr)){
				$lid['id']=$idp;
		}elseif (in_array($typep,$arr)) {
				$lid['id']=$typep;
		}
	}

	if($pname){
		$pname=explode(";",$pname);
		foreach ($pname as $key => $value) {
			$pname[$key]=explode(",",$value);

			if($pname[$key][4]==$lid["oid"]["sd"]){
				if($pname[$key][0]==$lid['name']&&($lid["oid"]["id"]==$pname[$key][3] or !$pname[$key][3]))
				{
					$lid['name']=$pname[$key][1];
					$lid['id']=$pname[$key][2]=='false'?'':$pname[$key][3];
					break;
				}
			}elseif($lid["oid"]["sd"]==2){
				if($pname[$key][0]==$lid['name']&&($lid["oid"]["title"]['pid']==$pname[$key][3] or !$pname[$key][3]))
				{
					$lid['name']=$pname[$key][1];
					$lid['id']=$pname[$key][2]=='false'?'':$pname[$key][3];
					break;
				}
			}
		}
	}
	
	$this->assign ( 'lid', $lid);
	return	$lid;
}


}
?>