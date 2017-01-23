<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<title>青峰网络智美云网站系统</title>
	<link rel="stylesheet" type="text/css" href="../Public/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="../Public/css/base.css" />
	<script type="text/javascript" src="../Public/js/jquery.js"></script>
    <script type="text/javascript" src="__PUBLIC__/js/loads.js"></script>
	<script type="text/javascript" src="../Public/js/common.js"></script>

	<style>
	body{hidden;overflow-y : hidden;}
	</style>
	<script type="text/javascript">
    $(function(){
		$("#main").load(function(){
			//$(this).height( $(this).contents().find("body").height());
			//resetLayout();
		})
    })
    </script>
</head>
<body>
    <div class="layout"  id="layout">
        <div class="sidebar" id="lay_sidebar">
            <h1 id="logo"><a href="__ROOT__/Admin" >网站管理系统</a></h1>
            <?php if($_SESSION["left_menu"] != 'system'): ?><dl class="lay_menu" id="lay_menu">            	
            	<dt class="item_tit"><a href="javascript:;"><i class="icon icon_page"></i>单页</a></dt>
                <dd class="item_cont" style="display:none">
                    <ul>
                        <li><a  href="__GROUP__/Single" target="main"><i class="icon icon_this"></i>管理单页</a></li>
                        <li><a  href="__GROUP__/Single/add" target="main"><i class="icon icon_this"></i>新增单页</a></li>
                    </ul>
                </dd>
            	<dt class="item_tit"><a href="javascript:;"><i class="icon icon_article"></i>自助列表</a></dt>
                <dd class="item_cont" style="display:none">
                    <ul>
                        <li><a href="__GROUP__/Article/"  target="main"><i class="icon icon_this"></i>列表</a></li>
                        <li><a href="__GROUP__/Article/add"  target="main"><i class="icon icon_this"></i>新增</a></li>
                        <li><a href="__GROUP__/Category/article"  target="main"><i class="icon icon_this"></i>自助分类</a></li>
                    </ul>
                </dd>
            	<dt class="item_tit"><a href="javascript:;"><i class="icon icon_product"></i>产品</a></dt>
                <dd class="item_cont" style="display:none">
                    <ul>
                        <li><a href="__GROUP__/Goods/" target="main"><i class="icon icon_this"></i>产品列表</a></li>
                        <li><a href="__GROUP__/Goods/add/" target="main"><i class="icon icon_this"></i>新增产品</a></li>
                        <li><a href="__GROUP__/Category/goods/"  target="main"><i class="icon icon_this"></i>产品分类</a></li>
                        <li><a href="__GROUP__/Goods/deltd/" target="main"><i class="icon icon_this"></i>产品回收站</a></li>
                        
                        <?php if($switch_order == '1'): ?><li><a href="__GROUP__/Order/" target="main"><i class="icon icon_this"></i>查看订单</a></li>
                        <li><a href="__GROUP__/Skr/utitle"  target="main"><i class="icon icon_this"></i>批量重命名</a></li>

                        <li><a href="__GROUP__/Goods/piliang"  target="main"><i class="icon icon_this"></i>批量上传(新版本)</a></li>
                        <li></li>
                        <li><a href="__GROUP__/collect"  target="main"><i class="icon icon_this"></i>详情批量采集</a></li><?php endif; ?>
                    </ul>
                </dd>
                <?php if($switch_jobs == '1'): ?><dt class="item_tit"><a href="javascript:;"><i class="icon icon_join"></i>招聘</a></dt>
                <dd class="item_cont" style="display:none">
               	 	<ul>
                        <li><a href="__GROUP__/Jobs/" target="main"><i class="icon icon_this"></i>招聘岗位</a></li>
                        <li><a href="__GROUP__/Jobs/add" target="main"><i class="icon icon_this"></i>新增岗位</a></li>
                        <li><a href="__GROUP__/Category/jobs"  target="main"><i class="icon icon_this"></i>招聘分类</a></li>
                        <li><a href="__GROUP__/Apply" target="main"><i class="icon icon_this"></i>简历列表</a></li>
                    </ul>
                </dd><?php endif; ?>
                
                
                
                <!-- 
                <dt class="item_tit"><a href="javascript:;"><i class="icon icon_join"></i>荣誉资质</a></dt>
                <dd class="item_cont" style="display:none">
               	 	<ul>
                        <li><a href="__GROUP__/Market/addmark" target="main"><i class="icon icon_this"></i>新增</a></li>
                    </ul>
                </dd>
                 -->
                <?php if($switch_message == '1'): ?><dt class="item_tit"><a href="javascript:;"><i class="icon icon_msg"></i>留言</a></dt>
                <dd class="item_cont" style="display:none">
                	<ul>
                       <li><a href="__GROUP__/Message" target="main"><i class="icon icon_this"></i>留言列表</a></li>
                    </ul>
                </dd><?php endif; ?>
                <dt class="item_tit"><a href="javascript:;"><i class="icon icon_form"></i>Smart</a></dt>
                <dd class="item_cont" style="display:none">
                	<ul>
                        <li><a href="__GROUP__/Smart/optimization" target="main"><i class="icon icon_this"></i>数据优化</a></li>
                        <li><a href="__GROUP__/Smart/clearcache" target="main"><i class="icon icon_this"></i>更新缓存</a></li>
                        <li><a href="__GROUP__/Message/weixin" target="main"><i class="icon icon_this"></i>微信互联</a></li>
                        <li><a href="__GROUP__/Smart/liuliangbao" target="main"><i class="icon icon_this"></i>流量宝</a></li>
                        <?php if(0): ?><li><a href="__GROUP__/Smart/baidu" target="main"><i class="icon icon_this"></i>移动互联</a></li><?php endif; ?>
                    </ul>
                </dd>
                <dt class="item_tit item_end"><a href="javascript:;"><i class="icon icon_sys"></i>系统</a></dt>
                <dd class="item_cont" style="display:none">
                    <ul>
                    	<li><a href="__GROUP__/Index/status"  target="main"><i class="icon icon_this"></i>系统状态</a></li>
                        <li><a href="__GROUP__/System/" target="main"><i class="icon icon_this"></i>网站设置</a></li>
                        <li><a href="__GROUP__/Flash/" target="main"><i class="icon icon_this"></i>轮显图片</a></li>
                    </ul>
                </dd>
                
            </dl>
            <?php else: ?>
            			<dl class="lay_menu" id="lay_menu">            	
            	<dt class="item_tit"><a href="javascript:;"><i class="icon icon_page"></i>单页</a></dt>
                <dd class="item_cont" style="display:none">
                    <ul>
                        <li><a  href="__GROUP__/Single" target="main"><i class="icon icon_this"></i>管理单页</a></li>
                        <li><a  href="__GROUP__/Single/add" target="main"><i class="icon icon_this"></i>新增单页</a></li>
                    </ul>
                </dd>
                <dt class="item_tit"><a href="javascript:;"><i class="icon icon_article"></i>分类</a></dt>
                <dd class="item_cont" style="display:none">
                    <ul>
                        <li><a href="__GROUP__/Category/"  target="main"><i class="icon icon_this"></i>栏目管理</a></li>
                        <li><a href="__GROUP__/Category/add"  target="main"><i class="icon icon_this"></i>新增栏目</a></li>
                    </ul>
                </dd>
            	<dt class="item_tit"><a href="javascript:;"><i class="icon icon_article"></i>文章</a></dt>
                <dd class="item_cont" style="display:none">
                    <ul>
                        <li><a href="__GROUP__/Article/"  target="main"><i class="icon icon_this"></i>文章列表</a></li>
                        <li><a href="__GROUP__/Article/add"  target="main"><i class="icon icon_this"></i>新增文章</a></li>
                        <li><a href="__GROUP__/Category/article"  target="main"><i class="icon icon_this"></i>文章分类</a></li>
                    </ul>
                </dd>
            	<dt class="item_tit"><a href="javascript:;"><i class="icon icon_product"></i>产品</a></dt>
                <dd class="item_cont" style="display:none">
                    <ul>
                        <li><a href="__GROUP__/Goods/" target="main"><i class="icon icon_this"></i>产品列表</a></li>
                        <li><a href="__GROUP__/Goods/add" target="main"><i class="icon icon_this"></i>新增产品</a></li>
                        <li><a href="__GROUP__/Category/goods"  target="main"><i class="icon icon_this"></i>产品分类</a></li>
                        <li><a href="__GROUP__/Order/" target="main"><i class="icon icon_this"></i>查看订单</a></li>
                    </ul>
                </dd>
            	<dt class="item_tit"><a href="javascript:;"><i class="icon icon_join"></i>招聘</a></dt>
                <dd class="item_cont" style="display:none">
               	 	<ul>
                        <li><a href="__GROUP__/Jobs/" target="main"><i class="icon icon_this"></i>招聘岗位</a></li>
                        <li><a href="__GROUP__/Jobs/add" target="main"><i class="icon icon_this"></i>新增岗位</a></li>
                        <li><a href="__GROUP__/Category/jobs"  target="main"><i class="icon icon_this"></i>招聘分类</a></li>
                        <li><a href="__GROUP__/Apply" target="main"><i class="icon icon_this"></i>简历列表</a></li>
                    </ul>
                </dd>
             
            	<dt class="item_tit"><a href="javascript:;"><i class="icon icon_msg"></i>留言</a></dt>
                <dd class="item_cont" style="display:none">
                	<ul>
                       <li><a href="__GROUP__/Message" target="main"><i class="icon icon_this"></i>留言列表</a></li>
                    </ul>
                </dd>
                <dt class="item_tit"><a href="javascript:;"><i class="icon icon_form"></i>Smart</a></dt>
                <dd class="item_cont" style="display:none">
                	<ul>
                        <li><a href="__GROUP__/Smart/view" target="main"><i class="icon icon_this"></i>Smart标签</a></li>
                        <li><a href="__GROUP__/Smart/baidu" target="main"><i class="icon icon_this"></i>移动互联</a></li>
                    </ul>
                </dd>
                <dt class="item_tit"><a href="javascript:;"><i class="icon icon_sys"></i>系统</a></dt>
                <dd class="item_cont" style="display:none">
                    <ul>
                    	<li><a href="__GROUP__/Index/status"  target="main"><i class="icon icon_this"></i>系统状态</a></li>
                        <li><a href="__GROUP__/System/" target="main"><i class="icon icon_this"></i>网站设置</a></li>
                        <li><a href="__GROUP__/Flash/" target="main"><i class="icon icon_this"></i>轮显图片</a></li>
                        <li><a href="__GROUP__/Config/" target="main"><i class="icon icon_this"></i>配置管理</a></li>
                        <!--<li><a href="__GROUP__/Plug-in/" target="main"><i class="icon icon_this"></i>插件管理</a></li -->
                        <li><a href="__GROUP__/System/advanced" target="main"><i class="icon icon_this"></i>高级管理</a></li>
                    </ul>
                </dd>
            </dl><?php endif; ?>
            <div class="copyright" id="copyright">青峰网络智美云整站系统<br />Powered by <a href="http://www.myqingfeng.cn" target="_blank" >myqingfeng.cn</a></div>
        </div>
    
        <div class="lay_main" id="lay_main">
            <div class="topMenu" id ="topMenu">
                <a href="javascript:;" onclick="logout('__GROUP__/Login/logout');" class="exit">安全退出</a>
                <strong>您好，<a href="__GROUP__/User/edit/<?php echo ($user_id); ?>" class="yellow" target="main"><?php echo ($username); ?></a>欢迎使用青峰智美云整站系统</strong>
				<a href="__APP__/"  class="update" target="_blank">网站首页</a>
                <!-- <a href="__GROUP__/System/clearcache" class="update" target="main">更新缓存</a> -->
            </div>
            <iframe id="main" name="main" src="<?php echo ($template); ?>" frameborder="0" ></iframe>
        </div>
        <a class="side_show" id="side_show" href="javascript:;"></a>
    </div>
</body>
</html>