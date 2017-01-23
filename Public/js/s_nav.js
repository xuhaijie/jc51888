;$(function(){
   var $acc=$('#accordion');
   var o=1,
   $trs=$acc.find('tbody').find('tr'),//所有tr元素
   set={},//延迟执行
   arr=new Array(),ids=new Array(),//记录是否显示数组
   $acc_che=$acc.find('input').filter('[type="checkbox"]');//是否显示开关
   $trs.find('td[data-name="id"]').each(function(){
      ids.unshift($(this).html());

   });

   function sds(a,b){
    arr.unshift(a);//增加元素
    clearTimeout(set);//去除延迟
    set=setTimeout(km);//增加延迟
    //flag修改方法
    function km(){
      var data={cz:'up',flag:b,id:arr}
       $.ajax({
            type: "GET",
            url: "ajax_s_nav",
            data: $.param(data)
          }).done(function( msg ) {
              arr=new Array();
              $.globalMessenger().post({
                  message:msg.cun
              });
          });
    }
   }

  //创建处理checkbox按钮.
  $acc_che.bootstrapSwitch().bootstrapSwitch('setSizeClass', 'switch-mini').each(function(){
    $this_tr=$(this).parentsUntil("tr").parent();
    if($this_tr.data('parent')!=0){
      $(this).bootstrapSwitch("setDisabled",!$(this).attr("checked"))
    }
  });
  //checkbox按钮值改变事件
  $acc_che.on('switch-change', function () {
    var $this=$(this),//当前改变的checkbox按钮元素
      bol=$(this).attr("checked")?true:false;//判断当前是on还是off
      $this_tr=$this.parentsUntil("tr").parent();//当前改变的checkbox按钮元素所在父元素tr
      //alert($this_tr.find('td[data-name="id"]').html());
      sds($this_tr.find('td[data-name="id"]').html(),bol?1:0);//flag修改方法
      //获取所属子元素,并改变属性
      $trs.filter("[data-parent="+$this_tr.find('td[data-name="id"]').html()+"]").find('td[data-name="flag"] input[type="checkbox"]').bootstrapSwitch('setState',bol).bootstrapSwitch("setDisabled",!bol);
  });
  //创建修改方法
  var xiugao=function($tr,cz,$td) {
    //判断$td是否有值
    if($td){
      //判断修改的是否为name
      if($td.find('span').length){
        $td.find('span').text($td.find('input').val());
      }else{
        $td.html($td.find('input').val());
      }
    }
    //创建data
      var data={cz:cz},fh='';
      if(cz){
        //获取$tr所有下的带有[data-name]属性的所有td元素(除[data-name="flag"]外)
        $tr.find('td[data-name]').not('[data-name="flag"]').each(function() {
              var $this=$(this);
              //判断修改的是否为name
              if($this.find('span').length){
            data[$this.data('name')]=$this.find('span').html();
          }else{
            data[$this.data('name')]=$this.html();
          }
        });
      }else{
        
      }
      //alert($.param(data))
      //判断是否有相应操作
      if(cz){
           $.ajax({
            type: "GET",
            url: "ajax_s_nav",
            data: $.param(data)
          }).done(function( msg ) {
             if(msg['return']){
              //console.log(msg);
              $.globalMessenger().post({
                  message:msg.cun
              });
             
                //cz=='in'?$tr.find('td[data-name="id"]').html(msg['return']):'';//判断是否为新增
                // $tr.find('td[data-xg]').off('click').on('click',function() {
                //     click($(this),'up');//给新增条添加修改事件
                // });
              }
          });
      }
      
  },
  //创建点击内容修改事件
  click=function($this,cz) {
    if(!$this.find('input').length){
      //判断修改的是否为name
      if($this.data('name')=='name'){
        $this.find('span').html('<input type="text" class="form-control" value="'+$this.find('span').html()+'">')
      }else{
        $this.html('<input type="text" class="form-control" value="'+$this.html()+'">')
      }
      
      $this.find("input")
          .focus()
          .blur(function() {xiugao($this.parent(),cz,$this);})
          .keyup(function(e) {
            switch(e.which)
            {
              case 13:xiugao($this.parent(),cz,$this);break;
            }
          });
    }
  },
  but_click=function($this,b) {
    if(b){
      var $tr=$this.parent().parent();
      if(confirm('是否确定删除!!')){
        xiugao($tr,'de');
        but_click($tr,0);
        $tr.remove();
      }
    }else{
      var $tr=$trs.filter('[data-parent="'+$this.find('[data-name="id"]').html()+'"]');
      if($tr.length){
        but_click($tr.eq(0),0);
        $tr.remove();
      };
    }
  };
  //修改
  $acc.find('table').on('click','td[data-xg]',function(){
    click($(this),'up');
  });
  //删除
  $acc.find('table').on('click',"button[value='0']",function(){
    but_click($(this),1);
  });
  //
  $("#nav-form").submit(function(){
    var $this=$(this),bol=true;
    if($.inArray($this.find('input[name="parent"]').val(),ids)>=0 || $this.find('input[name="parent"]').val()==0){
      $this.find('input').filter("[data-ts]").each(function(){
        var $this=$(this);
        if($this.val()==''){
          $this.focus();
          alert($this.data('ts'));
          bol=false;
          return bol
        }
      })
    }else{
      bol=false;
      alert('请输入正确的父类ID');
    }
    return bol;
  });
  $("#Cj").click(function(){
     $("#nav-form").submit();
  });
  //修改
  // $("table td[data-xg]").click(function() {
  //    click($(this),'up');
  // });
  //删除
  // $("table tr ").click(function() {
  //    but_click($(this));
  // });

});