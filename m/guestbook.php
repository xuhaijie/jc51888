<?php

date_default_timezone_set('PRC');

include('header.php');

?>

<script>

$(document).ready(function() {

	$("#form1").submit(function (){

		if($("#name1").val() == ''){

			alert('请填写用户名！');

			$("#name1").focus();

			return false;		

		}

		if($("#tel1").val() == ''){

			alert('请填写电话！');

			$("#tel1").focus();

			return false;		

		}

		

		})

});



</script>

<div data-role="content" class="mcontent">

    <div data-role="collapsible" data-collapsed="false" style="margin:5px 0" data-content-theme="c">

        <h3>在线留言</h3>

		<?php 

//guestbook

if($_POST['is_mobile'] == '1'){

	//print_r($_POST['is_mobile']);

	$name=strip_tags($_POST['name']);

	$tel=strip_tags($_POST['tel']);

	$add=strip_tags($_POST['address']);

	$email=strip_tags($_POST['email']);

	$content=strip_tags($_POST['content']);

	$is_mobile=strip_tags($_POST['is_mobile']);

	$ip=$_SERVER["REMOTE_ADDR"];

	$time=date('Y-m-d H:i:s');

	$res = $db->ExecNoneQuery("INSERT INTO #@__message (`NAME`,`TEL`,`ADD`,`EMAIL`,`CONTENT`,`IP`,`TIME`,`IS_MOBILE`) values ('$name','$tel','$add','$email','$content','$ip','$time','$is_mobile')");

	if($res){

		echo "<script>alert('留言成功，感谢您对我们工作的支持！');location.href='index.php';</script>";

	}else{

		echo "<script>alert('对不起，留言失败！\n请联系管理人员！');location.href='index.php';</script>";

	}

	

}



        ?>

        <div data-role="content">

			<form action="" method="post" id="form1">

				<input type="hidden" name="is_mobile" value="1"/>

				<label for="name" style="font-weight:bold; font-size:12px;">姓名：</label>

				<input type="text" name="name" id="name1" value="" data-clear-btn="true" data-mini="true">



				<label for="tel" style="font-weight:bold; font-size:12px;">电话：</label>

				<input type="text" name="tel" id="tel1" value="" data-clear-btn="true" data-mini="true">

				<label for="address" style="font-weight:bold; font-size:12px;">地址：</label>

				<input type="text" name="address" id="address1" value="" data-clear-btn="true" data-mini="true">

				<label for="email" style="font-weight:bold; font-size:12px;">邮箱：</label>

				<input type="email" name="email" id="email1" value="" data-clear-btn="true" data-mini="true">



				<div class="switch">

					<label for="content" style="font-weight:bold;font-size:12px;">留言内容</label>

					<textarea name="content" id="conent1"></textarea>

				</div>

				<div class="ui-grid-a">

					<div class="ui-block-a"><input type="submit" data-theme="c" data-mini="true" value="保存"/></div>

					<div class="ui-block-b"><a href="#" data-rel="close" data-role="button" data-theme="a" data-mini="true">取消</a></div>

				</div>

			</form>

        </div>

    </div>

</div>

<?php include('footer.php');?>

