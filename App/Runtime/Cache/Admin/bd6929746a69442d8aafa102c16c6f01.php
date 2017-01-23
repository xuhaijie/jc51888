<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
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
<link href="../Public/css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
var imgs="<?php echo ($info['imgs']?$info['imgs']:''); ?>" || 0,
id="<?php echo ($info['id']?$info['id']:''); ?>" || 0,//获取id
pimgs=false;
if(imgs){
    pimgs=true;
    imgs=imgs.split(',');
}else{
    pimgs=false;
    imgs=new Array();
}
		// 对富文本编辑插件进行封装
$(function(){
		$("#form1").submit(function (){
            if($('#pdid').attr('checked')){
				if($("#title").val() == ''){
					alert('请填写产品名称');
					$("#title").focus();
					return false;
				}
            }	
	})

})
</script>


<body class="main">
 	<div class="subTit">
                
<div class="query">
</div>
    	
                <div class="tit">
                    <a href="javascript:;">产品</a>&gt;<a href="javascript:;"><?php echo ($title_type); ?>产品</a>
                </div>
            </div>
            <div class="content">
                <div class="formMod">
                    <div class="tit"><?php echo ($title_type); ?>产品</div>
                    <form action="" method="post" id="form1" enctype="multipart/form-data">
                        <ul>
                        
                            <li>
                                <label for="newsId">产品ID:</label>
                                <div class="item_cont">
                                    <input type="text" readonly class="txt" name="id" style="" value="<?php echo ($info["id"]); ?>" />
                                    <?php if(strpos($info['id'],",")){ ?>
                                        空白:<input type="checkbox" value="1" id="pdid" name="pdid" title="所见即所得">
                                    <?php }?>

                                </div>
                                <div class="clear2"></div>
                            </li>

                            <li>
                                <label for="newsSort">产品类别：</label>
                                <div class="item_cont">
                                    <select name="pid" id="pid" title="pid">
                                        <?php if(strpos($info['id'],",")){ ?>
                                            <option value="" "selected"}>------选择分类------</option>
                                            <?php if(is_array($category)): foreach($category as $key=>$vo): ?><option value="<?php echo ($key); ?>"><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                                        <?php }else{ ?>
                                            <?php if(is_array($category)): foreach($category as $key=>$vo): ?><option value="<?php echo ($key); ?>" <?php echo ($key==$selected?"selected":''); ?>><?php echo ($vo); ?></option><?php endforeach; endif; ?>
                                        <?php }?>
                                    </select>
                                    <span>(pid)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            
                            <li>
                                <label >产品名称：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id="title" name="title" style="width:637px;" value="<?php echo ($info["title"]); ?>" />
                                    <span>(title)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <?php if(!strpos($info['id'],",")){ ?>
                            <li>
                                <label >产品图片：</label>
                                <div class="item_cont">
                                    <input type="file" id="img" name="img" size="35" class="txt"/>
									<?php if($info["img"] != ""): ?><img src="__ROOT__/__UPLOAD__/in_<?php echo ($info["img"]); ?>" style="width: 65px;"><input type="button" value="删除图片" data-img="<?php echo ($info["img"]); ?>" id="del-img"><?php endif; ?>
                                    <span>(img)</span>
                                </div>
                                <p style="color: red;text-indent: 10px;">注意：图片大小不得超过800KB，200KB左右最佳。</p>
                                <div class="clear2"></div>
                            </li>
                            <li style="position: relative;">
                                <input id="file_upload" accept=".jpg,.gif,.png" type="file" multiple="50" class="c_hide" value="添加文件" id="f1"/>
                                 
                                 <div class="xiance">
                                     <div id="xckg" data-kg="1">打开相册</div>
                                     <input style="display:none;" id="imgs" name="imgs" value="<?php echo ($info["imgs"]); ?>" />
                                     <div id="xc-1">
                                        <fieldset class="picarr" >
                                            <legend >相册列表(不创建缩略图)(imgs)：<button id="qb" type="button" style="padding: 5px">查看全部</button><button id="qk" type="button" style="padding: 5px">清空图片</button> </legend>
                                            <ul id="picarr_area" style="position: relative;">
                                            </ul>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <?php }?>
                             <li>
                                <label>产品推荐：</label>
                                <div class="item_cont">
                                <input type="hidden" name="goodsck" value="1">
                                    热销&nbsp;<input type="checkbox" name="is_hot" title="is_hot" value="1" <?php if($info["is_hot"] == '1'): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;
                                    促销&nbsp;<input type="checkbox" name="is_best" title="is_best" value="1" <?php if($info["is_best"] == '1'): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;
                                    新品&nbsp;<input type="checkbox" name="is_new" title="is_new" value="1" <?php if($info["is_new"] == '1'): ?>checked="checked"<?php endif; ?>>&nbsp;&nbsp;
                                </div>
                                <div class="clear2"></div>
                            </li>
                             <li>
                                <label>价格：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id='price' name="price" style="width:637px;" value="<?php echo ($info["price"]); ?>" />
                                    <span>(price)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <li>
                                <label>关键字：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id='keywords' name="keywords" style="width:637px;" value="<?php echo ($info["keywords"]); ?>" />
                                    <span>(keywords)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <li>
                                <label >载入页面：</label>
                                <div class="item_cont">
                                    <input type="text" class="txt" id='www' name="www" style="width:637px;" value="<?php echo ($info["www"]); ?>" title="产品载入的页面放入Product目录下" />
                                    <span>(www)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <li>
                                <label>简介：</label>
                                <div class="item_cont">
                                    <textarea name="description" id="description" class="txt" style="hidth:65px;"  ><?php echo ($info["description"]); ?></textarea>
                                    <span>(description)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <li>
                                <label for="newsCont">产品描述：</label>
                                <div class="item_cont">
                                     
<script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.parse.js"></script>
<script type="text/javascript" src="__PUBLIC__/ueditor/ueditor.all.min.js"></script>
<style type="text/css">
    #content{width: 60%;min-height:300px;}
</style>
<script type="text/javascript">
;$(function(){
	var ue = UE.getEditor('content');
});
</script>
<script type="text/plain" id="content" name="content">
  <?php echo ($info["content"]); ?>
</script>

                                     <span>(content)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                             <li>
                                <label for="newsId">排序：</label>
                                <div class="item_cont">
                                    <input type="number" id="order" name="order"  min="0" step="1" value="<?php if($info["order"] != ''): echo ($info["order"]); else: ?>255<?php endif; ?>" class="txt"/>
                                    <span>(order)</span>
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <li class="push">
                                <div class="item_cont">
                                 <?php if($info["id"] != ''): ?><input type="hidden" id="id" name="id" value="<?php echo ($info["id"]); ?>" />
                                 	<input type="hidden" id="img" name="img" value="<?php echo ($info["img"]); ?>" />
                                 	<input type="hidden" id="time" name="time" value="<?php echo ($info["time"]); ?>" />
                                 	<input type="hidden" id="click" name="click" value="<?php echo ($info["click"]); ?>" /><?php endif; ?>
                                    <input type="submit" class="submit" value="提&nbsp;交" />
                                    <input type="reset" class="reset" value="重&nbsp;置" />
                                </div>
                                <div class="clear2"></div>
                            </li>
                            <div class="clear2"></div>
                        </ul>
                    </form>
                </div>
            </div>
<script type="text/javascript">
//把图片加载到页面
function addims($this,img){
    var mk='';//创建局部变量
    //判断参数img是否为数组
    if($.isArray(img)){
        //历遍数组img
        $.each(imgs,function(x,v){
            mk+=sprintf('<li data-or="%3$s"><span><img src="__ROOT__/__UPLOAD__/imgs/%4$s%1$s"></span><h2>%2$s</h2><div class="cz" ><button type="button" value="%1$s">X</button></div></li>',v,x*1+1,x,id?id+'/':'');
        });
        //输出到页面
        $this.html(mk);
    }else{
        //创建格式
        mk=sprintf('<li  data-or="%3$s"><span><img src="__ROOT__/__UPLOAD__/imgs/%4$s%1$s"></span><h2>%2$s</h2><div class="cz" ><button type="button" value="%1$s">X</button></div></li>',img,imgs.length,imgs.length-1,id?id+'/':'');
        //尾部添加
        $this.append(mk);
    }
}
//相册内容的处理方法
function upims(img,i,bo){
    //判断参数img是否有效
    if(img){
            //复制一份修改前的相册数组imgs的数据
       var imgs_bk=imgs.concat(),
            //查找img是否属于数组img中
            de=$.inArray(img,imgs);
        if(de>=0){
            //判断参数i是否为数字
            if(!$.isNumeric(i)){
                //把img从数组imgs中删除
                imgs.splice(de,1);
            }else if(i!=de){
                //交换位置
                imgs[i]=imgs_bk[de];
                imgs[de]=imgs_bk[i];
            }
            //判断是否和原本一样，重新加载所有相册图片
            if(imgs_bk.toString()!=imgs.toString()){addims($("#picarr_area"),imgs);}
        }else{
            //在数组imgs尾部添加img
            imgs.push(img);
        }
        //更新#imgs提交值
        $("#imgs").val(imgs.join())
    }
    //判断是否存在id并且参数bo有效
    if(bo && id){
        //把数据以POST方式提交到ajax_goods_del页面交给后台处理
        $.ajax({
            type: "POST",
            url: "__GROUP__/Goods/ajax_goods_del",
            data: {'id':id,'t':'del_imgs','imgs':$("#imgs").val()}
        })
    }
}
    $(function() {
       
        $("#xckg").click(function(){
            var $this=$(this);
            if($this.data("kg")==1){
                $this.data("kg",0).html('关闭相册')
                 $("#xc-1").css("height",$("#xc-1").find('.picarr').height()+50)
            }else{
                $this.data("kg",1).html('打开相册')
                 $("#xc-1").css("height",0)
            }
        });
        $("#file_upload").click(function(){
            alert(1)
             $("#xc-1").css("height",$("#xc-1").find('.picarr').height()+50)
        })
        //创建$area元素缓存
        var $area=$("#picarr_area"),
            $del_img=$("#del-img") || false;

        //判断是否存在相册内容，并载入页面
        if(pimgs)addims($area,imgs);
        //$area中注册点击事件到h2中
        $area.on('click','h2',function() {
            var $this=$(this);
            //判断当前点击元素中的input的个数是否等于0个！
            if(!$this.find('input').length){
                //创建input
                $this.html(sprintf('<input type="number" style="float: right;" value="%1$s" data-cvla="%1$s" min="1" class="txt"/>',$this.html()));
            }
            
        });
        if($del_img){
            $del_img.click(function(){
                var $this=$(this);
                if(confirm('是否删除')){
                    $.ajax({
                        type: "POST",
                        url: "__GROUP__/Goods/ajax_goods_del",
                        data: {'id':id,'t':'del_img','img':$this.data("img")}
                    }).done(function( msg ) {
                        if(msg['code']){
                            $this.parent().find('img').remove();
                            $this.remove();
                        }else{
                            alert(msg['data']['name']);
                        }
                    });
                }
            });

        }
        //$area中注册焦点失去事件到input中
        $area.on('blur','input',function() {
            var $this=$(this);
                //当前元素的父元素h2
            var $h2=$this.parent(),
                //当前元素的祖元素li
                $li=$this.parent().parent();
                //获取当前元素的图片名称
            var img=imgs[$li.data('or')];
            //判断输入的是否为数字
            if($.isNumeric($this.val())){
                var k=0;
                //判断输入的数字并处理
                if($this.val()>=$area.find('li').length){
                   k=$area.find('li').length-1;
                }else if($this.val()==0){
                    k=0
                }else{
                    k=$this.val()-1
                }
                //更新数组
                upims(img,k,1)
                $h2.html(k+1)
            }else{
                $h2.html($this.data('cvla'))
            }
        });
        //$area中注册点击事件到button中
        $area.on('click','button',function() {
            var $this=$(this);
            //选择提示框
            if(confirm('是否删除')){
                //从数组中删除
                upims($this.val())
                if(id){
                    $.ajax({
                        type: "POST",
                        url: "__GROUP__/Goods/ajax_goods_del",
                        data: {'id':id,'t':'del_imgs','img':$this.val(),'imgs':$("#imgs").val()}
                    }).done(function( msg ) {
                        if(msg['code']){
                            $this.parentsUntil('li').parent().remove();
                        }else{
                            alert(msg['data']['name']);
                        }
                    });
                }
                
            }   
        });
        
         $("#qk").click(function() {
            var $this=$(this);
            if(confirm('是否清空')){
                if(id){
                    $.ajax({
                        type: "POST",
                        url: "__GROUP__/Goods/ajax_goods_del",
                        data: {'id':id,'t':'del_imgs_all'}
                    }).done(function( msg ) {
                         if(msg['code']){
                            imgs=[];
                            $area.html('')
                         }else{
                            alert(msg['data']['name']);
                         }
                    });
                }else{
                    imgs=[];
                    $area.html('')
                }
            }   
        });
        $("#picarr_area >li:gt(8)").hide();
        $("#qb").click(function() {
            $("#picarr_area >li:gt(8)").show();
        });
    });
</script>
<script type="text/javascript" src="__PUBLIC__/uploadify/jquery.uploadify.min.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css" />
<script type="text/javascript">
    <?php $timestamp = time();?>
        $(function() {
            $('#file_upload').uploadify({
                'buttonText' :"上传相册图片",
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    'token'     : '<?php echo md5('unique_salt' . $timestamp);?>',
                    'id':id
                },
                'swf'      : '__PUBLIC__/uploadify/uploadify.swf',
                'uploader' : '__GROUP__/Skr/upload_ajax',
                'onUploadSuccess':function(file, data, response){
                    if(response){
                        //console.log(data);
                        upims(data);
                        addims($("#picarr_area"),data)
                    }
                },
                'onQueueComplete':function(file) {
                    upims(0,"跳",1);
                }
            });
        });
</script>
</body>
</html>