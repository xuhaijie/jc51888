<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
	<title>青峰网络智美云网站系统</title>
   <link rel="stylesheet" type="text/css" href="../Public/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="../Public/css/base.css" />
	<script type="text/javascript" src="../Public/js/jquery.js"></script>
	<script type="text/javascript" src="../Public/js/common.js"></script>
	<script type="text/javascript" src="../Public/js/sprintf.js"></script>
	<!--[if IE 6]>
	<script src="//letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
	<?php if($ie < 9): ?><link rel="stylesheet" type="text/css" href="../Public/css/skk.css" />
	<?php else: ?>
		<link rel="stylesheet/less" type="text/css" href="../Public/css/skk.less">
		<script type="text/javascript" src="../Public/css/less.js"></script><?php endif; ?>
	<script type="text/javascript" src="../Public/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="../Public/js/fancybox/jquery.fancybox-1.3.4.css" />
<script>
var url = "__ROOT__";
var type = "<?php echo (MODULE_NAME); ?>";
window.UEDITOR_HOME_URL="__PUBLIC__/ueditor/";
</script>
</head>
<body class="main">
  <div class="subTit">
                
<div class="query">
</div>
    	
                <div class="tit">
                    <a href="javascript:;"><?php echo ($title); ?></a>&gt;<a href="javascript:;"><?php echo ($title); ?>分类</a>
                </div>
            </div>
              <div class="content">
                <div class="tableMod">
                    <div class="tit">
                        <a href="__GROUP__/Category/add/type/<?php echo ($type); ?>"><i class="icon icon_add"></i>添加分类</a>
                        <a href="javascript:;" onclick="batch_del(this, 'Category')"><i class="icon icon_del"></i>删除选中项</a>
                    </div>
                    <table id="example" class="table-css1">
                        <thead>
                            <tr>
                                <th width="13px"><input type="checkbox" value="" id="check_box" onclick="selectall('id[]');"></th>
                                <th width="50px">ID(id)</th>
                                <th >分类名称(name)</th>
                                <th width="80px">排序(order)</th>
                                <th width="143px">关联的文章ID(aid)</th>
                                <th width="100px" title="必须有这个页面(空=index),产品放在Product文件夹下,自助放在News下！">载入页面(www)</th>
                                <th width="100px">自定义</th>
                                <!-- <th width="10%">查看该类下的产品</th> -->
                                <th width="310px">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                           	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr data-id="<?php echo ($vo["id"]); ?>">
                                <td align="center"><?php if($vo["parent"] != '0' and $vo["id"] != '4' and $vo["id"] != '15' and $vo["id"] != '5'): ?><input  class="checkbox-1" type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id[]"><?php endif; ?></td>
                                <td align="center"><span class="col_ccc"><?php echo ($vo["id"]); ?></span></td>
                                <td data-xg="name" data-val="<?php echo ($vo["jname"]); ?>"><?php echo ($vo["name"]); ?><a href="__ROOT__/<?php echo ACTION_NAME=='goods'?'product':'news'; ?>/type/<?php echo ($vo["id"]); ?>" target="_blank"  class="off">查看</a></td>
                                <td align="center"  class="order" data-xg="order" data-val="<?php echo ($vo["order"]); ?>"><?php echo ($vo["order"]); ?></td>
                                <td align="center" data-xg="aid" data-val="<?php echo ($vo["aid"]); ?>"><span data-xs><?php echo ($vo["aid"]); ?></span><a class="off" href="<?php echo ($vo["url"]); ?>" >查看</a></td>
                                <td align="center" data-xg="www" data-val="<?php echo ($vo["www"]); ?>"><?php echo ($vo["www"]); ?></td>
                                <td align="center" data-xg="sur" data-val="<?php echo ($vo["sur"]); ?>"><?php echo ($vo["sur"]); ?></td>
                               <!--  <td align="center"  class="order"><a href="<?php echo U('/admin/goods/search_goods',array('pid'=>$vo[id]));?>">查看</a></td>
                                 --><td align="center" class="op" style="text-align: left;">
                                    <a href="__GROUP__/<?php echo ACTION_NAME;?>/add/type/<?php echo ($vo["id"]); ?>"><i class="icon icon_add"></i>添加内容</a>
                                    <a href="__GROUP__/<?php echo ACTION_NAME;?>#<?php echo ($vo["id"]); ?>---<?php echo (ltrim(strip_tags($vo["name"]),'&nbsp;')); ?>"><i class="icon icon_search"></i>查看分类下的内容</a>
                                   	<a href="__GROUP__/Category/edit/id/<?php echo ($vo["id"]); ?>/type/<?php echo ($vo["type"]); ?>"  target="main"><i class="icon icon_edit"></i>修改</a>
                                   	<?php if($vo["parent"] != '0' and $vo["id"] != '4' and $vo["id"] != '15' and $vo["id"] != '5'): ?><a href="javascript:;" data-cz="sc" onclick="del(this,'Category',<?php echo ($vo["id"]); ?>)";><i class="icon icon_x"></i>删除</a><?php endif; ?>
                                </td>
                            </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- End tableMod -->       
	</div>
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/js/Messenger/css/messenger.css" />
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/js/Messenger/css/messenger-theme-future.css" />
  <script type="text/javascript" src="__PUBLIC__/js/Messenger/js/messenger.min.js"></script>
  <script type="text/javascript">
  ;$(function(){
    var $tbody=$("#example").find('tbody');
     $tbody.on('blur','td[data-xg] input',function(){
        var data={},
        $this=$(this),
        $xg_par=$this.parent(),
        $td=$this.parentsUntil("td").parent(),
        $tr=$this.parentsUntil("tr").parent();
        if(!$td.length){ $td=$this.parent()}
        if($td.data('val')!=$this.val()){
          data['id']=$tr.data('id');
          data[$td.data('xg')]=$this.val();
          $.ajax({
                type: "GET",
                url: 'ajax_category',
                data: data
            }).done(function( msg ) {
                $td.data('val',$this.val())
                $xg_par.html($this.val())
                 $.globalMessenger().post({
                    message:msg
                });
            });
          }else{
             $xg_par.html($this.val())
          }
     });
    $tbody.on('click','td[data-xg]',function(){
       var $this=$(this);
        if($this.find('input').length!=1){
          var $inn=$(sprintf('<input type="text" data-xg class="txt" value="%s">',[$this.data('val')])),
          $xs=$this.find('[data-xs]');
          $inn.css({"width":"90%"});
          if($xs.length){
            $xs.html($inn);
          }else{
            $this.html($inn);
          }
          $inn.focus().select();
        }
    });
  });
  
  </script>
</body>
</html>