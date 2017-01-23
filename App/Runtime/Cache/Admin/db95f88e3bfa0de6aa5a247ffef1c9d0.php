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
<body class="main" id="Call">
    <div class="panel panel-default">
        <div class="panel-heading">
            
        </div>
            
        <div class="panel-body">
            <div class="well">
                <div class="table-responsive">
                  <table class="table panel panel-default table-bordered table-hover" id="call-table">
                    <thead>
                      <tr>
                        <th width="100px" title="无用">ID</th>
                        <th title="页面调用时候用的名称">输出名</th>
                        <th width="100px" title="调用的产品或文章个数!(个数为0的时候表示调用当个!)">个数</th>
                        <th width="170px" title="产品：goods,文章：goods">取值表(goods,article)</th>
                        <th width="150px" title="需要调用内容的所在类别ID,多个分类可用','分隔开！(个数为0时这里填写单个文章或产品ID!)">类别ID</th>
                        <th width="190px">所属页面(主页:0、公共:1)</th>
                        <th width="190px">是否查询子类(是:1、否:0)</th>
                        <th width="100px">删除</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr data-qk="up">
                          <td data-name="id"><?php echo ($v["id"]); ?></td>
                          <td data-name="name" data-xg="yse"><?php echo ($v["name"]); ?></td>
                          <td data-name="count" data-xg="yse"><?php echo ($v["count"]); ?></td>
                          <td data-name="table" data-xg="yse"><?php echo ($v["table"]); ?></td>
                          <td data-name="ids" data-xg="yse"><?php echo ($v["ids"]); ?></td>
                          <td data-name="page" data-xg="yse"><?php echo ($v["page"]); ?></td>
                          <td data-name="switch" data-xg="yse"><?php echo ($v["switch"]); ?></td>
                          <td><button class="btn btn-danger" value="0">X</button></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
              </div><!-- /.table-responsive -->
              <button class="btn btn-primary" id="Insert">新增</button>
            </div> <!-- /.well -->
        </div><!-- /.panel-body -->
    </div> <!-- /.panel panel-default -->
<script type="text/javascript" src="__PUBLIC__/js/call.js"></script>
  <script type="text/javascript" src="__PUBLIC__/css/bootstrap3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/css/bootstrap3/switch-master/bootstrap-switch.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/js/Messenger/js/messenger.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/js/skr.js"></script>
</body>
</html>