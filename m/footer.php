<?php
date_default_timezone_set('PRC');
?>
<div data-role="footer" data-position="fixed" style="height:50px;overflow:hidden">
  <div data-role="navbar" ui-icon-shadow="false">
    <ul class="jq_footer">
      <li><a href="<?php if($info['mobile']){$tel=$info['mobile'];}else{$tel=$info['tel'];} echo 'tel:'.$tel;?>" data-icon="myapp-tel" onclick="return checkPhone('<?php echo $tel?>')">电话咨询</a></li>
      <li><a href="<?php echo 'sms:'.$info['mobile'];?>" data-icon="myapp-sms" onclick="return checkMobile('<?php echo $info['mobile'];?>','<?php echo $info['tel'];?>')">短信咨询</a></li>
      <li><a href="guestbook.php" data-icon="myapp-msg" data-ajax="false" data-transition="none">在线留言</a></li>
      <li><a href="javascript:;" data-icon="myapp-contact" onclick="location.href='contact.php'" data-ajax="false" data-transition="none"><?php echo $nav[3];?></a></li>
 </ul>
</div>
</div>


</body>
</html>