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
                    <a href="javascript:;">产品</a>&gt;<a href="javascript:;">产品列表</a>
                </div>
            </div>
            <div class="content">
              <div id="mb" style="position: absolute;width: 100%;top: 0;left: 0;background: rgba(0, 0, 0, 0.7);height: 100%;z-index: 100;"><div style="font-size: 5em;text-shadow: 0 0 10px #FFFFFF;color: #fff;position: absolute;top: 50%;left: 50%;margin-left: -90px;margin-top: -80px;">载入中
                <div class="circle"></div>
                <div class="circle1"></div>
              </div>
                
              </div>
                <div class="tableMod">
                    <div class="tit">
                        <a href="__GROUP__/Category/goods"><i class="icon icon_txt"></i>管理分类</a>
                        <a href="__GROUP__/Goods/add"><i class="icon icon_add"></i>添加产品</a>
                        <a href='####' data-href="__GROUP__/Goods/edit.php" id="pl"><i class="icon icon_edit"></i>批量修改产品</a>
                        <a href="javascript:;" onclick="batch_hid(this, 'Goods')"><i class="icon icon_del"></i>删除选中项</a>
                        <span id="qusi"></span>
                    </div>
                    <table id="example" class="display">
                        <thead>
                            <tr>
                                <th width="1%"><input type="checkbox" value="" id="check_box" onclick="selectall('id[]');"></th>
                                <th width="5%">ID</th>
                                <th width="15%">类别</th>
                                <th width="">产品名称</th>
                                <th width="4%">图片</th>
                                <th width="5%" data-ck="is_hot"><input type="checkbox"><span>热销</span></th>
                                <th width="5%" data-ck="is_best"><input type="checkbox"><span>促销</span></th>
                                <th width="5%" data-ck="is_new"><input type="checkbox"><span>新品</span></th>
                                <th width="5%">排序</th>
                                <th width="10%">添加时间</th>
                                <th width="10%">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            <!-- End tableMod -->  
	       </div>
</div>
<script type="text/javascript">
 var is={},$oTable,sousuo=location.hash.slice(1);
$(function() {
    var $example=$("#example");
    $(window).scroll(function(){
        $example.find('a[rel="goods"]').fancybox()
    })
    //$example.find('a[rel="goods"]').fancybox();
     //$oTable.fnUpdate( 'Example update', 0, 4 );
    $('#pl').click(function(e) {
       var $this=$(this);
            if($example.find("input.checkbox-1:checked").length>0){
                location.href=$this.data('href')+'?'+$example.find("input.checkbox-1:checked").serialize();
            }else{
                alert('无选中!');
            }
    });
    //新建对象is
    is=function ($this,b) {
        var i=0,data={},bl='',
        $tr=$this.parent().parent();
        if(!is.bo){
            i=$this.attr('checked')?1:0;
        }else{
            i=$this.attr('checked')?0:1;
        }
        data['id']=$this.val();
        data['ty']=$this.attr("name");
        data['t']=i?'yes':'no';
        $.ajax({
            type: "POST",
            url: '__GROUP__/Goods/ajax_goods_save',
            data: data
        });
    };
    
    is.ks={is_hot:"热销",is_best:"促销",is_new:"新品"};
    is.bo=false;
    $(window)
        //按住鼠标键事件
        .mousedown(function(e) {
            is.bo=true;
        })
        //释放鼠标键事件
        .mouseup(function(e) {
           is.bo=false;
           
        })
    is.sx=(function() {
        $example.on({
            "click":function(){
            //alert(2)
            is($(this),1);
        },
        "mousedown":function(e) {
            var set=function () {
                is.bo?set.$this.click():false
            };
            set.$this=$(this);
            set.set1=setTimeout(set,200);
        },
        "mouseover":function(e) {
            is.bo?$(this).click():false;
            }
        },'input[name="is_hot"],input[name="is_best"],input[name="is_new"]')
    })(); 

    $oTable=$example.dataTable({
        //"bServerSide":true,
        "aoColumns": [
                        {"asSorting": [],"bSearchable": false},
                      null,
                      null,
                      null,
                      null,
                      { "asSorting": [] },
                      { "asSorting": [] },
                      { "asSorting": [] },
                      {"sClass": "order"},
                      null,
                      { "asSorting": [] ,"bSearchable": false}
                    ],
        //'bStateSave': true,
        "bPaginate": true,
        "iDisplayLength":100,
        "aLengthMenu": [[100,200,300,500,1000,-1], [100,200,300,500,1000,"全部"]],
        "sDom": '<"top"flip<"clear" and >>rt<"bottom"<"clear" and >><"clear">',
        "sPaginationType": "full_numbers",
        "oLanguage": {
        "sProcessing": "正在加载数据...",  
        "sLengthMenu": "每页显示 _MENU_ 条记录",
        "sZeroRecords": "抱歉， 没有找到",
        "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
        "sInfoEmpty": "没有数据",
        "sInfoFiltered": "(从 _MAX_ 条数据中检索)",
        "sSearch":"筛选(多个关键字用空格隔开):",
        "oPaginate": {
        "sFirst": "首页",
        "sPrevious": "前一页",
        "sNext": "后一页",
        "sLast": "尾页"
        },
        "sZeroRecords": "没有检索到数据"
        }
    });

    $.ajax({
            type: "GET",
            url: '__GROUP__/Ajax/ajax_list',
            data: {flag:<?php echo($_GET["flag"]?$_GET["flag"]:0); ?>}
        }).done(function( msg ) {
            var list=[];
            if(msg){
                $.each(msg,function(k,v){
                    list[k]=[
                    '<input  class="checkbox-1" type="checkbox" value="'+v.id+'" name="id[]">',
                    v.id+'<span style="display: none;">'+(v.is_hot==1?"热销":"")+(v.is_best==1?"促销":"")+(v.is_new==1?"新品":"")+'</span>',
                    v.pid_name?v.pid+'---'+v.pid_name:"0--分类已删除",
                    '<a href="__ROOT__/product/'+v.id+'" target="_blank">'+v.title+'</a>',
                    '<a rel="goods" href="__ROOT__/__UPLOAD__/'+v.img+'" target="_blank" title="'+v.id+'--'+v.title+'"><img style="width: 43px;" src="__ROOT__/__UPLOAD__/'+v.img+'"></a>',
                    '<input type="checkbox" value="'+v.id+'"'+(v.is_hot==1?'checked="checked"':'')+'name="is_hot">',
                    '<input type="checkbox" value="'+v.id+'"'+(v.is_best==1?'checked="checked"':'')+'name="is_best">',
                    '<input type="checkbox" value="'+v.id+'"'+(v.is_new==1?'checked="checked"':'')+'name="is_new">',
                    '<span data-zid="'+v.id+'">'+v.order+'</span>',
                    v.time,
                     '<a href="__GROUP__/Goods/edit/id/'+v.id+'"><i class="icon icon_edit"></i>修改</a><a href="javascript:;" onclick="hid(this, \'Goods\' ,'+v.id+','+k+')"><i class="icon icon_x"></i>删除</a>'
                    ];
                });
                $oTable.fnAddData(list);
                $example.find('a[rel="goods"]').fancybox();
            }
            $("#mb").hide();
        });
    
    if(sousuo){
        $oTable.fnFilter(sousuo)
        $("#example_filter input").val(sousuo).focus();
    }
    
    $example.on('click','th[data-ck] span',function() {
         $oTable.fnFilter($(this).html());
         $("#example_filter input").val($(this).html()).focus();
    })
     $example.on('click','th[data-ck] input',function() {
        var $this=$(this),data={},$inp,bol,
        $input=$example.find(sprintf('input[name="%s"]',[$this.parent().data('ck')]));
        if($this.attr('checked')){
            var arr=[];
            bol=true;
            $inp=$input.not(':checked');
            $inp.each(function(i){
                arr[i]=$(this).val();
            });
            data={'id':arr,'t':'yes','ty':$this.parent().data('ck')};
        }else{
            var arr=[];
            bol=false;
            $inp=$input.filter(':checked');
            $inp.each(function(i){
                arr[i]=$(this).val();
            });
            data={'id':arr,'t':'no','ty':$this.parent().data('ck')};
        }
        if(data['id'].length){

            $.ajax({
                type: "POST",
                url: 'ajax_goods_save',
                data: data
            }).done(function( msg ) {
                if(msg){
                    $inp.attr('checked',bol);
                }
            });
        }
    })
    
}());
   
</script> 
</body>
</html>