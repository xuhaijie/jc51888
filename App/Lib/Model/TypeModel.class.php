<?php

/* * 
 * 分类数据模型
 * 
 */
/**
 * 分类数据模型 建议更换成category
 * Enter description here ...
 * 1.文章分类
 * 2.产品分类
 * 3.招聘分类
 * @author Administrator
 *
 */
class TypeModel extends BaseModel {
	/**
	 * 栏目数据
	 * Enter description here ...
	 * @var unknown_type
	 */
	private $colum = array();
	
	protected $_validate = array(
    	array('name','require','栏目名称不允许为空！'), //默认情况下用正则进行验证
	);
	
	/**
	 * 获取指定栏目分类
	 * Enter description here ...
	 * 默认是所有分类，返回数组数据,按照归属类别排序。
	 */
	public function list_column($parent = 0)
	{
		$data = $this->select_data($parent);
		//z($data);
		$result = $this->list_arrange($data);
		return $result;
	}
	
	/**
	 * 获取select下来分类栏目
	 * Enter description here ...
	 * @param $parent 需要获取的分类栏目ID
	 * @param $recursion 是否递归获取其子分类栏目
	 * 当$recursion=true时获取$parent其下的所有分类栏目
	 */
	public function select_column($parent = 0, $recursion = false)
	{
		if($recursion)
		{
			if ($parent == 0)
			{
				$where['id'] = $parent;			
				$data =  $this->select_data($parent);
			}else 
			{
				$where['id'] = $parent;			
				$data = array_merge($this->where($where)->order('id')->select(), $this->select_data($parent));
			}			
		}else
		{
			$data = $this->select();
		}
		$result = $this->select_arrange($data);
    	return $result;
	}
	
	/**
	 * 递归获取栏目下边子栏目
	 * Enter description here ...
	 * @param unknown_type $parent 栏目父ID
	 */
	private function select_data($parent)
	{
		//$where = array('parent'=>$parent);
		$where['parent'] = $parent;
		$data = $this->where($where)->order("`order`")->select();
		//z($data);
		foreach($data as $key=>$value)
		{
			$this->colum[] = $value;
			$this->select_data($value['id']);
		}
		return $this->colum;
	}
	
	/**修改
	 * 列表名字格式排盘数据
	 * Enter description here ...
	 * @param unknown_type $data
	 */
	private  function list_arrange($data)
	{
		$result = array();
		foreach ($data as $key=>$value)
		{
			$code = count(explode(',', $value['code']))-2;
			// $separator = '';
			// for ($i=3; $i <$code ; $i++) { 
			// 	$separator .= '&nbsp;&nbsp;&nbsp;&nbsp;';
			// }
			// if($code==3){
			// 	$code = '<span>' . $separator ;
			// }else{
			// 	$code = '<span>' . $separator.'<img src="__PUBLIC__/img/sub_type_line.gif" style="top: -5px;position: relative;left: -5px;"/>' ;
			// }
			$code = '<span data-xs class="t-code-'.$code.'">';
			$result[$key] = $value;
			$result[$key]["jname"]=$value['name'];
			$result[$key]['name'] = $code . $value['name'] . "</span>";
		}
		return $result;
	}
	
	/**
	 * select下拉框分类数据排版显示
	 * Enter description here ...
	 * @param unknown_type $data
	 * 根据data数据整理数据格式
	 */
	private function select_arrange($data)
	{
		$result = array();
		foreach ($data as $key=>$value)
		{
			$code = count(explode(',', $value['code']));
			$separator = '';
			for ($i=2; $i <$code ; $i++) { 
				$separator .= '&nbsp;&nbsp;&nbsp;&nbsp;';
			}
			$separator .="|-";
			$result[$value['id']] =$separator .$value['id'].'--'.$value['name'];
		}
		return $result;
	}
}

?>