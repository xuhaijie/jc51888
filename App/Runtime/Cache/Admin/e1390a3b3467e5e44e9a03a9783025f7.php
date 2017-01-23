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
<body class="main" id="S-nav">
    <div class="panel panel-default">
        <div class="panel-heading">
            <ul class="nav nav-pills">
				 <!--  <li><a>管理</a></li> -->
				  <li><a data-toggle="modal" data-target="#myModal" href="####">新增</a></li>
				</ul>
        </div>
            
        <div class="panel-body" >
            <div class="well" id="accordion">
	               <div class="table-responsive panel panel-default" >
	                  <table class="table table-condensed table-bordered table-hover">
	                    <thead>
	                      <tr>
	                        <th width="55px;" title="无用">ID</th>
	                        <th title="页面调用时候用的名称">导航名</th>
	                        <th width="150px;" title="跳转的链接">url</th>
	                        <th width="150px;" title="输出到页面的ID">页面ID名称</th>
	                        <th width="150px;" title="输出要页面的css样式">CSS</th>
                            <th width="150px;" title="获取分类的子类">分类ID</th>
	                        <th width="50px;" title="越小越前面" data-toggle="tooltip">排序</th>
	                        <th width="111px;">是否显示</th>
	                        <th width="140px;">操作</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                      <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr data-parent="<?php echo ($v["parent"]); ?>">
	                          <td data-name="id"><?php echo ($v["id"]); ?></td>
	                          <td data-name="name" data-xg="yse"><?php echo ($v["name"]); ?></td>
	                          <td data-name="url" data-xg="yse"><?php echo ($v["url"]); ?></td>
	                          <td data-name="tid" data-xg="yse"><?php echo ($v["tid"]); ?></td>
	                          <td data-name="css" data-xg="yse"><?php echo ($v["css"]); ?></td>
                              <td data-name="sur" data-xg="yse"><?php echo ($v["sur"]); ?></td>
	                          <td data-name="order" data-xg="yse"><?php echo ($v["order"]); ?></td>
	                          <td data-name="flag" data-xg="yse"><input type="checkbox" <?php echo ($v[flag]?'checked':''); ?> name="flag"></td>
	                          <td><button class="btn btn-danger btn-xs" value="0">删除</button></td>
	                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	                    </tbody>
	                </table>
	              </div><!-- /.table-responsive /#tab-1 -->
            </div> <!-- /.well -->
			
        </div><!-- /.panel-body -->

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">新增分类</h4>
                      </div>
                      <div class="modal-body">
                            <form role="form" id="nav-form" method="post">
                                <div class="form-group">
                                    <label for="inputEmail3" class="control-label">父类ID:</label>
                                    <div>
                                        <input type="number" name="parent" min="0" value="0" step="1" class="form-control"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class=" control-label">导航名:</label>
                                    <div class="">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                               <input type="checkbox"  name="onnum" title="批量创建导航开关：导航名称用英文 , 隔开。列如：导航1,导航2,导航3">
                                            </span>
                                            <input data-ts="导航名称不能为空!!" type="text" class="form-control" name="name" placeholder="导航名称" value="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="control-label">url:</label>
                                    <div>
                                      <input type="text" name="url" class="form-control" placeholder="url(可为空)"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="control-label">页面ID名称:</label>
                                    <div>
                                      <input type="text" name="tid" placeholder="页面ID名称(可为空)" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="control-label">CSS:</label>
                                    <div>
                                       <input type="text" class="form-control" name="css" placeholder="CSS(可为空)"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="control-label">排序:</label>
                                    <div>
                                      <input type="number" name="order" min="0" step="1" value="255" class="form-control"/>
                                    </div>
                                </div>

                                <input type="submit" style="position: absolute;z-index:-10;" value="提&nbsp;交"/>
                            </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="Cj">确认</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

    </div> <!-- /.panel panel-default -->

<script type="text/javascript" src="__PUBLIC__/js/s_nav.js"></script>
  <script type="text/javascript" src="__PUBLIC__/css/bootstrap3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/css/bootstrap3/switch-master/bootstrap-switch.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/js/Messenger/js/messenger.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/js/skr.js"></script>
</body>
</html>