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

<link rel="stylesheet" type="text/css" href="__PUBLIC__/js/media/css/jquery.dataTables.min.css" />
<script type="text/javascript" src="__PUBLIC__/js/media/js/jquery.dataTables.min.js"></script>
<body class="main">
<div class="subTit">

<div class="query">
</div>
    	
<div class="tit">
        <a href="javascript:;">文章</a>&gt;<a href="javascript:;">文章列表</a>
	</div>
</div>
              <div class="content">
                <div class="tableMod">
                    <div class="tit">
                        <a href="__GROUP__/Category/article"><i class="icon icon_txt"></i>管理分类</a>
                        <a href="__GROUP__/Article/add"><i class="icon icon_add"></i>添加文章</a>
                        <a href='####' data-href="__GROUP__/Article/edit.php" id="pl"><i class="icon icon_edit"></i>批量修改产品</a>
                        <a href="javascript:;" onclick="batch_del(this, 'Article')"><i class="icon icon_del"></i>删除选中项</a>
                    </div>
                    <table id="example" class="display">
                        <thead>
                        
                            <tr>
                                <th width="6%"><input type="checkbox" value="" id="check_box" onclick="selectall('id[]');"></th>
                                <th width="10%">ID</th>
                                <th width="9%">类别</th>
                                <th width="37%">文章标题</th>
                                <th width="9%">排序</th>
                                <th width="15%">添加时间</th>
                                <th width="14%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center"><input  class="checkbox-1" type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id[]"></td>
                                <td align="center"><?php echo ($vo["id"]); ?></td>
                                <td align="center"><?php if($vo[cate_name]): echo ($vo["pid"]); ?>---<?php echo ($vo["cate_name"]); else: ?>分类已删除<?php endif; ?></td>
                                <td><a href="__ROOT__/news/<?php echo ($vo["id"]); ?>" target="_blank"><?php echo ($vo["title"]); ?></a></td>
                                <td align="center" class="order"><span data-zid="<?php echo ($vo["id"]); ?>"><?php echo ($vo["order"]); ?></span></td>
                                <td align="center"><span class="col_ccc"><?php echo ($vo["time"]); ?></span></td>
                                <td align="center" class="op">
                                	<a href="__GROUP__/Article/edit/id/<?php echo ($vo["id"]); ?>"><i class="icon icon_edit"></i>修改</a>
                                    <a href="javascript:;" onclick="del(this,'Article',<?php echo ($vo["id"]); ?>)";><i class="icon icon_x"></i>删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "$empty" ;endif; ?>
                        </tbody>
                    </table>
                  
                </div>

        <!-- End tableMod -->     
        <script type="text/javascript">
        var sousuo=location.hash.slice(1);
         $(function() {
               var  $oTable=$('#example').dataTable({
                	"aoColumns": [
              			    	{ "asSorting": [] ,"bSearchable": false},
              			      null,
              			      null,
              			      null,
              			      null,
                              
              			      null,
              			      { "asSorting": [] ,"bSearchable": false}
              			    ],
              	    "bStateSave": true,
                    "bPaginate": true,
                    "iDisplayLength":100,
                    "aLengthMenu": [[100,200,300,500,1000,-1], [100,200,300,500,1000,"全部"]],
                    "sDom": '<"top"flip<"clear" and >>rt<"bottom"<"clear" and >><"clear">',
                    "sPaginationType": "full_numbers",
                    "oLanguage": {
                    "sLengthMenu": "每页显示 _MENU_ 条记录",
                    "sZeroRecords": "抱歉， 没有找到",
                    "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
                    "sInfoEmpty": "没有数据",
                    "sInfoFiltered": "(从 _MAX_ 条数据中检索)",
                    "sSearch": "筛选(多个关键字用空格隔开):",
                    "oPaginate": {
                    "sFirst": "首页",
                    "sPrevious": "前一页",
                    "sNext": "后一页",
                    "sLast": "尾页"
                    },
                    "sZeroRecords": "没有检索到数据"
                    }
                });

                if(sousuo){
                    $oTable.fnFilter(sousuo)
                    $("#example_filter input").val(sousuo).focus();
                }
                $('#pl').click(function(e) {
                   var $this=$(this),
                        $example=$('#example');
                        if($example.find('tbody input:checked').length>0){
                            location.href=$this.data('href')+'?'+$example.find('tbody input:checked').serialize();
                        }else{
                            alert('无选中!');
                        }
                });
    }())
    </script>  
	</div>
</body>
</html>