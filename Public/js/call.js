;$(function() {
      var $table=$('#call-table'),
          xiugao=function($tr,cz,$td) {
          $td?$td.html($td.find('input').val()):'';
          var data={cz:cz},fh='';
          $tr.find('td[data-name]').each(function() {
              var $this=$(this);
              data[$this.data('name')]=$this.html();
          });
          //alert($.param(data))
          if(cz){
               $.ajax({
                type: "GET",
                url: "ajax_call",
                data: $.param(data)
              }).done(function( msg ) {
                  $.globalMessenger().post({
                      message:msg.cun
                  });
                  if(msg['return']){
                    cz=='in'?$tr.find('td[data-name="id"]').html(msg['return']):'';//判断是否为新增
                    $tr.find('td[data-xg]').off('click').on('click',function() {
                        click($(this),'up');//给新增条添加修改事件
                    });
                  }
              });
          }
          
      },
      click=function($this,cz) {
        if(!$this.find('input').length){
          $this.html('<input type="text" class="form-control" value="'+$this.html()+'">')
          .find("input")
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
      but_click=function($this) {
        var $tr=$this.parent().parent();
        if($this.val()==0){
          if(confirm('是否确定删除!!')){
            xiugao($tr,'de');
            $tr.remove();
          }
        }
      }
      //修改
      $table.on('click','tr[data-qk="up"] td[data-xg]',function(){
        click($(this),'up');
      });
      //删除
      $table.on('click','tr[data-qk="up"] button',function(){
        but_click($(this));
      });
      //新增
      $table.on('click','tr[data-qk="xz"] td[data-xg]',function(){
        click($(this));
      });
      $table.on('click','tr[data-qk="xz"] button',function(){
        var $this=$(this),$name;
        var $mk=$this.parentsUntil('tr').parent();
          if($this.val()==1){
            $name=$mk.find('[data-name="name"]');
            if($name.html()!=''){
              xiugao($mk,'in');
              $mk.data("qk","up");
              $mk.find('td:last button').removeClass('btn-warning').addClass('btn-danger').click(function() {
                but_click($(this));
              });
            }else{
              $.globalMessenger().post({
                  message:"变量名不能为空！！！",
                  type: 'error'
              });
              $name.click();
            }
          }else{
            $mk.remove();
          }
      });
      //新建
      $("#Insert").click(function() {
           var mk='<tr data-qk="xz"><td data-name="id"><button class="btn btn-info" value="1">确定</button></td><td data-name="name" data-xg="yse"></td><td data-name="count" data-xg="yse">5</td><td data-name="table" data-xg="yse">article</td><td data-name="ids" data-xg="yse">4</td><td data-name="page" data-xg="yse">0</td><td data-name="switch" data-xg="yse">0</td><td><button class="btn btn-warning" value="0">X</button></td></tr>';
          var $mk=$(mk);
          $table.find("tbody").append($mk);
      });

  });