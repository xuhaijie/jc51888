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

<body class="main">
  <div class="panel panel-default">
       
        <div class="panel-heading">
            <a href="javascript:;">产品</a>&gt;<a href="javascript:;">批量上传产品(新版)</a>
        </div>
            
        <div class="panel-body">
            <div class="well min-2">
                
                <form enctype="multipart/form-data" action="" method="POST" class="definewidth m20">
          <table class="table table-bordered table-hover definewidth m10">
            <tr>
              <td class="tableleft" width="120">产品类别</td>
              <td>
              <div class="form-group">
                  <div class="col-sm-3">
                    <select id="pid" name="pid" onchange="" ondblclick="" class="form-control" ><?php  foreach($category as $key=>$val) { if(!empty($selected) && ($selected == $key || in_array($key,$selected))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
                  </div>
              </div>
              <!-- <div class="col-sm-3">
                  <select id="pid" name="pid" onchange="" ondblclick="" class="txt" ><?php  foreach($category as $key=>$val) { if(!empty($classid) && ($classid == $key || in_array($key,$classid))) { ?><option selected="selected" value="<?php echo $key ?>"><?php echo $val ?></option><?php }else { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } } ?></select>
              </div> -->
              </td>
            </tr>
            <tr>
              <td class="tableleft" width="120">文件命名</td>
              <td>
                <div class="col-sm-2">
                  <input type="radio" name="titleBy" value="1" checked=""> 根据文件名
                  <input type="radio" name="titleBy" value="0"> 统一命名
                </div>
              </td>
            </tr>
            <tr style="display:none;" id="title" >
              <td class="tableleft" width="120" >命名规则</td>
              <td>
                <div class="col-sm-2">
                  <input id="titleRule" type="text" name="title" class="form-control" style="width:250px;" />
                </div>
              </td>
            </tr>
            <tr>
              <td class="tableleft">批量上传</td>
              <td>
                <input id="file-5" class="file" type="file" multiple data-preview-file-type="any">
              </td>
            </tr>
            </table>
                    <p style="color: red;text-indent: 10px;">注意：图片大小不得超过800KB，200KB左右最佳。</p>
      </form>
      <script type="text/javascript">
      $(function(){
        $('input[name=titleBy]').change(function() {
          if ($(this).val()==1) {
            $('#title').hide();
            $('p.notice').show();
          }else{
            $('p.notice').hide();
            $('#title').show();
          };                   
        }); 
      })

    </script>
    <script>
      $("#file-5").fileinput({
          uploadUrl: "<?php echo U('piliang1');?>", // you must set a valid URL here else you will get an error
          allowedFileExtensions : ['jpg', 'png','gif'],
          overwriteInitial: false,
          maxFileSize: 1000,
          slugCallback: function(filename) {
              return filename.replace('(', '_').replace(']', '_');
          }
    });
    </script>
            </div>
        </div>
    </div>  

<script type="text/javascript" src="__PUBLIC__/js/upgoods.js"></script>
  <script type="text/javascript" src="__PUBLIC__/css/bootstrap3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/css/bootstrap3/switch-master/bootstrap-switch.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/js/Messenger/js/messenger.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/js/skr.js"></script>
</body>
</html>