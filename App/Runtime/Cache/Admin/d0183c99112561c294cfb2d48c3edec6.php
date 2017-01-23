<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
  <title>青峰网络智美云网站系统</title>
  <script type="text/javascript" src="../Public/js/jquery.js"></script>
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap3/css/bootstrap.min.css" />
  
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/bootstrap3/switch-master/bootstrap-switch.min.css" />

  <link rel="stylesheet/less" type="text/css" href="__PUBLIC__/css/base2.less"/>
  <script type="text/javascript" src="__PUBLIC__/js/less.js"></script>
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/js/Messenger/css/messenger.css" />
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/js/Messenger/css/messenger-theme-future.css" />
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/fileinput.css" />
  <script type="text/javascript" src="__PUBLIC__/js/fileinput.js"></script>
  <script type="text/javascript" src="__PUBLIC__/js/fileinput_locale_zh.js"></script>
<script>
var url = "__ROOT__",
    type = "<?php echo (MODULE_NAME); ?>";
</script>
</head>
<script type="text/javascript">	
		$(function(){
			$("#form1").submit(function (){
				if($("#title").val()!=''){
				    if(confirm('确认输入参数配置正确?')){
					    return true;
				    }else{
					    return false;
				    }
				}
				else{
					alert('新标题名不允许为空');
					return false;
				}
			})
		})
</script>
<body class="main">
  <div class="panel panel-default">
               
    <div class="panel-heading">
        <a href="javascript:;">产品</a>&gt;<a href="javascript:;"><?php echo ($title_type); ?>产品</a>
    </div>
            
    <div class="panel-body">
      <div class="well">
       <div class="alert alert-danger">当前数字变量：<strong>%1$s</strong>,当前分类变量：<strong>%2$s</strong>,原始标题变量：<strong>%3$s</strong></div>
        <form class="form-horizontal" action="" method="post" id="form1" enctype="multipart/form-data">
          <div class="form-group">
              <label for="" class="col-sm-1 control-label">产品类别：</label>
              <div class="col-sm-2">
                  <select id="pid" name="pid" onchange="" ondblclick="" class="form-control" ><?php  foreach($category as $key=>$val) { if(!empty($selected) && ($selected == $key || in_array($key,$selected))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
                  <span>是否修改子类：<input type="checkbox" class="" name="sf"></span>
              </div>
          </div>

          <div class="form-group">
              <label for="" class="col-sm-1 control-label">新标题名：</label>
              <div class="col-sm-2">
                  <input type="text" class="form-control" id="title" name="title"  placeholder="请输入新标题名" />
              </div>
          </div>

          <div class="form-group">
              <label for="" class="col-sm-1 control-label">数字个数：</label>
              <div class="col-sm-2">
                  <input type="number" id="dig" name="dig" min="0" step="1" value="0" class="form-control"/>
              </div>
          </div>

           <div class="form-group">
              <label for="" class="col-sm-1 control-label">起始数字：</label>
              <div class="col-sm-2">
                  <input type="number" id="origi" name="origi" min="0" step="1" value="1" class="form-control"/>
              </div>
          </div>
          
          <div class="form-group" style="text-align: center;">
            <div class="col-sm-2">
              <input type="submit" class="btn btn-primary btn-lg" value="提&nbsp;交" />
              <input type="reset" class="btn btn-warning btn-lg" value="重&nbsp;置" />
            </div>
          </div>

        </form>
      </div> <!-- /.well -->
    </div> <!-- /.panel-body -->
  </div>  <!-- /.panel panel-default -->
  <script type="text/javascript" src="__PUBLIC__/css/bootstrap3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/css/bootstrap3/switch-master/bootstrap-switch.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/js/Messenger/js/messenger.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/js/skr.js"></script>
</body>
</html>