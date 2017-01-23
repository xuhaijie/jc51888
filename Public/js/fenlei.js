$(function() {
        var $Fenlei=$("#Fenlei"),
            $select=$("#Fenlei").find("select"),
            $Fudon=$("#Fudon"),
            $myModal=$("#myModal"),
            zcun=json_type,
            clhs=function($this,$h3,$panel,$b){
                    if($.trim($b.val()) !=""){
                        $h3.html($b.val()).data("vname",$h3.html());
                        $.ajax({
                              type: "GET",
                              url: "ajax_fenlei",
                              data: $.param({ name: $h3.data('vname'),cz:"up", id: $panel.data('vid'),type:type})
                            }).done(function( msg ) {
                                if(msg['return']){
                                   $.globalMessenger().post({
                                        message:$h3.data('vname')+"修改成功!"
                                    });
                                   zcun=msg.cun;
                                   new_select.new_select_f0(msg.cun);
                                   $panel.find('>.panel-footer form input[name="name"]').val($h3.data('vname'));
                                }else{
                                    $.globalMessenger().post({
                                        message:$h3.data('vname')+"修改失败!",
                                        type: 'error'
                                    });
                                }
                            });
                    }else{
                         $h3.html($h3.data("vname"));
                    }
                };
        //设置
        $Fudon.hide()
        //浮动go
        $Fenlei.find('.panel-heading').hover(function() {
            var $this=$(this);
            $this.prepend($Fudon);
            $Fudon.data("vid",$this.parent().data("vid"));
            $Fudon.stop(true,true).show(100);
        },function() {
            $Fudon.stop().hide(100)
            	.find('.dropdown-menu').hide();
        });
        //设置
        $Fudon.find(".dropdown").click(function() {
        	var $this=$(this);
        	$Fudon.css("overflow","initial");
        	$this.find('.dropdown-menu').stop().slideToggle(100);
        });
        //点击增加按钮事件
        $myModal.on("show.bs.modal",function() {
        	$myModal.find("form select").html(new_select.new_select_f1(zcun,$Fudon.data('vid')));
        });
        //确定创建
        $myModal.find("form").submit(function() {
            var $form=$myModal.find("form"),
                $name=$myModal.find("form input[name='name']");
            //location.reload();
            if($name.val()!=""){
                $.ajax({
                  type: "GET",
                  url: "ajax_fenlei",
                  dataType:"json",
                  data: $form.serialize()+"&cz=in&type="+type
                }).done(function( msg ) {
                    if(msg['return']){
                        location.reload();
                    }else{
                        $.globalMessenger().post({
                            message:"创建失败!",
                            type: 'error'
                        });
                        //console.log(msg);
                    }
                });
            }else{
                $.globalMessenger().post({
                    message:"类别名称不能为空!",
                    type: 'error'
                });
            }//判断名字是否为空
        	return false;
        })
        $myModal.find("#Cj").click(function() {
        	$myModal.find("form").submit();
        });
        //删除
        $Fudon.find(".dropdown-menu li a").click(function() {
        	var $this=$(this),
        		sql=$Fudon.data('vid');
        	if(confirm("是否确定执行操作："+$Fudon.parent().find('h3').html()+"---"+$this.html()+"!")){
	        	switch($this.data("cz"))
					{
						case 1:
						  sql="pid="+sql;
						  break;
						case 2:
						  sql="id="+sql;
						  break;
						default:
						  sql=false;
					}

				if(sql){
		        	$.ajax({
		              type: "GET",
		              url: "ajax_fenlei",
		              dataType:"json",
		              data: sql+"&cz=de&type="+type
		            }).done(function( msg ) {
		            	if(msg['return']){
		            		location.reload();
		            	}else if(msg['return']==0){
		            		$.globalMessenger().post({
		                        message:"无子类!",
		                        type: 'error'
		                    });
		            	}else{
		            		$.globalMessenger().post({
		                        message:"无子类!",
		                        type: 'error'
		                    });
		                    //console.log(msg);
		            	}
		            });
	            }//选项
            }//确认窗口
        });
        //浮动end
        //双击修改标题
        $Fenlei.find('h3').dblclick(function() {
            var $this=$(this),//当前标题H3
                $heading=$(this).parent(),
                $panel=$(this).parentsUntil(".panel-primary").parent();
                $this.html('<input type="text" class="form-control" placeholder="请输入分类名称" value="'+$this.data("vname")+'">')
                .find("input")
                    .focus()
                    .blur(function(){clhs($heading,$this,$panel,$(this));})
                    .keyup(function(e) {e.which == 13?clhs($heading,$this,$panel,$(this)):false;});
        });
        //单击标题
       $Fenlei.find("h3").click(function(){
            var $this=$(this);
            $this.parentsUntil('.panel-primary').parent().find(">.panel-footer").stop(true,true).slideToggle(100);  
        });
        //提交修改
        $Fenlei.find("form").submit(function(){
           var  $this=$(this),//当前提交表单
                $panel=$(this).parent().parent(),//当前提交表单所在大框架
                $name=$(this).find('input[name="name"]');//名称
           //ajax用GET方式提交到ajax_fenlei页面 参数：type:后台判断需要查询的表
           if($name.val()!=""){
	           $.ajax({
	              type: "GET",
	              url: "ajax_fenlei",
	              dataType:"json",
	              data: $this.serialize()+"&cz=up&id="+$this.data("vid")+"&type="+type
	            }).done(function( msg ) {
	                //msg（json）返回数据{'return':是否成功,com:其他数据}
	                var $order=$this.find("input[type='number']"),//排序
	                    
	                    $pid=$this.find("select");//父ID
	                    //console.log(msg);
	                if(msg['return']){
	                    $.globalMessenger().post({
	                         message: $name.val()+"修改成功!"
	                    });
	                    $panel.find('>.panel-heading h3').html($name.val())//改变H3中的名称
	                            .data('vname',$name.val());
	                    if($order.val()!=$order.data('vval') || $pid.val()!=$pid.find('option[selected="selected"]').val()){
	                        $order.data('vval',$order.val());//获取上次改变时排序
	                        fname($pid.val(),$panel,$order.val(),msg.cun);
	                    }
	                    zcun=msg.cun;
	                }else{
	                    $.globalMessenger().post({
	                        message:$name.val()+"修改失败!",
	                        type: 'error'
	                    });
	                }
	            });
			}else{
				$.globalMessenger().post({
                    message:"类别名称不能为空!",
                    type: 'error'
                });
			}
            return false;
        });
        //变化地址参数a:父分类ID，b:修改分类的id，c:修改后的排序
        function fname (a,$b,c,d) {
            var $mk=$Fenlei.find('.panel-primary[data-vid="'+a+'"]'),//获取父分类
                $mk2=$b,//获取转移分类
                $cr=$mk.find('>div.panel-body >div.panel-primary');
            //判断是否有子分类
            if($cr.length>0){
                $mk2.slideUp(200,function() {
                    var bo=true;
                    $cr.filter(":visible").each(function() {
                        var $this=$(this);
                        var d=$this.find("input[type='number']").val();
                        if(bo){
                            if(parseInt(d)<=parseInt(c)){
                                if(parseInt(d)==parseInt(c)){
                                    if(parseInt($this.data("vid"))>parseInt($mk2.data('vid')))
                                    {
                                        $this.after($mk2);
                                    }else{
                                        $this.before($mk2);
                                    }
                                }else{
                                    $this.before($mk2);
                                }
                                bo=false;
                                return bo;
                            }
                            
                        }
                    });
                    if(bo){
                        $mk.find(">div.panel-body")
                            .append($mk2);
                    }
                    new_select.new_select_f0(d);
                    $mk2.slideDown(200,function() {
                        $(this).css("overflow","inherit")
                    });
                });
            }else{
                $mk2.slideUp(200,function() {
                    if($mk.find(">div.panel-body").length>0){
                        $mk.find(">div.panel-body")
                            .append($mk2);
                    }else{
                        $mk.append('<div class="panel-body"></div>')
                            .find(">div.panel-body")
                            .append($mk2);
                    }
                    new_select.new_select_f0(d);
                     $mk2.slideDown(200,function() {
                        $(this).css("overflow","inherit")
                    });
                });
            }
        }
        //刷新父类
        var new_select=new Object();

		new_select.new_select_f0=function (cun) {
		    var o=100000;
		    $select.each(function() {
		        var $this=$(this),
		            $panel=$(this).parentsUntil(".panel-primary").parent();
		            $this.html(new_select.new_select_f1(cun,$panel.parentsUntil(".panel-primary").parent().data("vid"),$panel.data("vid"),0));
		    });
		    

		}

		new_select.new_select_f1=function(cun,vid,pid,i) {
	        var ml="";
	        i=i?i:0;
	        function xu (y) {
		        var mk='';
		        for (var i = 0; i < y; i++) {
		            mk+="&nbsp;&nbsp;&nbsp;&nbsp;"
		        };
                mk+='|-';
		        return mk;
		    };
	        if(cun.id*1==vid*1 ){
	            ml+='<option style="background:#f2dede;" value="'+cun.id+'" selected="selected">'+xu(i)+cun.id+'.'+cun.name+'</option>';
	        }else if(pid*1==cun.id*1){
	            o=i;
	            ml+='<option style="background:#f2dede;" disabled="disabled" value="'+cun.id+'">'+xu(i)+cun.id+'.'+cun.name+'</option>';
	        }else if(i>o){
	            ml+='<option style="background:#f2dede;" disabled="disabled" value="'+cun.id+'">'+xu(i)+cun.id+'.'+cun.name+'</option>';
	        }else{
	            o=1000;
	            ml+='<option value="'+cun.id+'">'+xu(i)+cun.id+'.'+cun.name+'</option>';
	        }
	        if(cun.son){
	            $.each(cun.son,function(k, v) {
	                ml+=new_select.new_select_f1(v,vid,pid,i+1);
	            });
	        }
	        return ml; 
	    };
        //console.log(new_select);
        new_select.new_select_f0(json_type);
        
});