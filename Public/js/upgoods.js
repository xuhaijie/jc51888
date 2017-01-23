;$(function(){
    var $form1=$("#form1"),
        $Tupzs=$("#Tupzs"),
        $Cmm=$("#Cmm"),
        $num=$("#num"),//起始编号
        $pid=$("#pid"),//父分类id
        $order=$("#order"),//排序
        $keywords=$("#keywords"),//关键字
        $price=$("#price"),//价格
        $title=$("#title"),//重命名
        $onnum=$("#onnum"),//编号开关
        $jdt=$("#jdt"),//进度条
        $trs=$Tupzs.find("tr[data-lx='']");//所有图片
    $Cmm.find('input').attr("disabled",true);//禁用input
    $Tupzs.find("div.panel-info").each(function(i){
        var $this=$(this),
            $trh=$this.find("tr[data-lx='']"),
            $troff=$this.find("tr[data-lx!='']");
            $this
                .data("he",$this.height())
                .css({"height":200})
            $trh.addClass("alert-danger");
            $trh.prependTo($this.find('tbody'));
            //$troff.addClass("off");
    });


    $Tupzs.find("div.panel-info").hover(function(){
        var $this=$(this);
        if($this.data("he")>200)$this.css({"height":$this.data("he")})
    },function(){
        var $this=$(this);
        $this.css({"height":200})
    });
    // $Tupzs.on({
    //     "mouseenter":function(event){
    //         var $this=$(this);
    //         $this.find(".off").show(200);
    //         //event.stopPropagation();
    //     },
    //     "mouseout":function(event){
    //         var $this=$(this);
    //         $this.find(".off").stop(true,true).hide(200);
    //         console.log($this.html())
    //         //event.stopPropagation(); 
    //     }
    // },".im-tab >table")
    $(".radio input").click(function(){
        var $this=$(this);
        switch($this.val())
        {
            case '0':
                $Cmm
                    .hide(200)
                    .find("input").attr("disabled",true);
                break;
            case '1':
                if($onnum.attr('checked')){ $num.attr("disabled",false);}
                $onnum
                    .attr("disabled",false);
                $Cmm
                    .show(200)
                    .find('input[name="title"]').attr("disabled",true);
                break;
            case '2':
                if($onnum.attr('checked')){ $num.attr("disabled",false);}
                $onnum
                    .attr("disabled",false);
                $Cmm
                    .show(200)
                    .find('input[name="title"]').attr("disabled",false);
                break;
            default:
        }
    });
    //提交时
     $form1.dir=function($a){
        //alert($form1.find('input[name="wc"]:checked').val())
        var s='';
        $a.parents(".panel-primary[data-flne]").each(function(i){
            if(i==0){
                s=$(this).data("flne")
            }else{
                s=$(this).data("flne")+"/"+s
            }
            
        })
        return s;
        //.parent().find('td').html()
    }
    $form1.mm=function($a){
        //alert($form1.find('input[name="wc"]:checked').val())
        var a='',b=$num.filter(':enabled').val() || '';
        switch($form1.find('input[name="wc"]:checked').val())
            {
            case '0':
              break;
            case '1':
                var oph=$pid.find("option").filter(":selected").html()
                a=$a.data("flne") || oph.slice(oph.indexOf("--")+2)
                break;
            case '2':
               a=$title.val();
              break;
            }
        return a+b;
    }
    //创建分类请求方法
    $form1.ajax_cj=function($a,b){
        //cz=cj&pname=企业站1&pid=66
        var data={};
        data['cz']="cj";
        data['pname']=$a.data("flne");
        data['pid']=b||$a.parent().parent().data("mid");
        $.ajax({
          type: "GET",
          url: "ajax_upgoods",
          data: data
        }).done(function( msg ) {
              if(msg['id']){
                $a.data("mid",msg["id"])
                $a.removeClass("not").addClass("m-yot")
                $form1.ajax_up($a,msg['id'])
              }else{
                $a.removeClass("not").addClass("m-sot")
                alert("获取("+data['pname']+")分类失败!")
              }
        });
    };
    //$Tupzs
    $jdt.mun=$Tupzs.find("tr.not[data-lx!='']").length;
    $jdt.i=0;
    $jdt.css({"display":"none"});
    $jdt.gb=function(){
        $jdt.i++;
        $jdt.w=($jdt.i/$jdt.mun*100).toFixed(0)+"%"
        $jdt.find(".progress-bar").css("width",$jdt.w)
        $jdt.find("span").html("已完成:"+$jdt.w)
    }
    //上传图片请求

    $form1.ajax_up=function jxup($a,b){
        //cz=up&nname=企业站1&pid=66&imgname=1.jpg&order=255
        //获取当前分类下的还未上传的图片(.not)
        var $ninfo=$a.find(">div.panel-info,>div.panel-body >div.panel-info"),
        $ntr=$ninfo.find("tr.not[data-lx!='']").eq(0),data={};
        b=b||$a.parent().parent().data("mid");
        if($ntr.length){
            data['cz']="up";
            data['dir']=$form1.dir($ntr);
            data['imgname']=$ntr.find("td").html();
            data['nname']=$form1.mm($a);
            data['pid']=b;
            data['order']=$order.val();
            data['keywords']=$keywords.val();
            $.ajax({
              type: "GET",
              url: "ajax_upgoods",
              data: data
            }).done(function( msg ) {
              if(msg){
                $ntr.removeClass("not off").addClass("t-yot")
                $jdt.gb()
                //是否开启起始编号
                if($num.filter(':enabled'))$num.val($num.val()*1+1)
              }else{
                $ntr.removeClass("not off").addClass("t-sot")
              }
              //继续执行jxup方法
              jxup($a,b);
            });
        }else if($a.find(">div.not[data-flne],>div.panel-body >div.not[data-flne]").length){
            //获取还未进行上传的父分类(.net)
            if($num.filter(':enabled'))$num.val($num.data("jval"));
            $form1.ajax_cj($a.find(">div.not[data-flne],>div.panel-body >div.not[data-flne]").eq(0),b);
        }else{
            //console.log($a.parentsUntil('[data-flne]').parent().html())
            if($a.parentsUntil('[data-flne]').parent().length){
                //判断是否存在父级为[data-flen],如存在把他传给当前方法jxup()
                jxup($a.parentsUntil('[data-flne]').parent())
            }else if($Tupzs.find(">div.not[data-flne]").length){
                //判断是否存在还未上传过的分类,如存在把他传给当前方法jxup()
                jxup($Tupzs,$("#pid").val())
            }else{
                //全部上传完毕后执行删除
                data["cz"]="sc";
                 $.ajax({
                  type: "GET",
                  url: "ajax_upgoods",
                  data: data
                })
            }
        }

    };
    $form1.submit(function (){
        $num.data("jval",$num.val())//获取起始编号
        $form1.ajax_up($Tupzs,$("#pid").val())//开始发送请求
        if($jdt.mun)$jdt.css({"display":"block"});
        return false;
    });
    //点击开关事件
    $onnum.click(function(){
        var $this=$(this);
        if(!$this.attr('checked')){
            $num
                .data("mw",$num.css("min-width"))
                .css("min-width","0px")
                .stop()
                .animate({
                    'width':'10%'
                })
                .attr("disabled",true);
        }else{
            $num
                .stop()
                .animate({
                    'width':'100%'
                },function(){
                    $num.attr("disabled",false)
                        .css("min-width",$num.data("mw"));
                }); 
        }
    });
});