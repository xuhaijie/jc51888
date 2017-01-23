<?php include('header.php');?>

<div data-role="content"  class="mcontent" >

	<div style="padding:5px;">

		<?php 

        //公司简介

        $sql="SELECT * FROM #@__article WHERE `id` = '1'";

        $cinfo=$db->GetOne($sql);

        ?>

		<h2><?php if($cinfo['img']) echo "<img src=\"./uploads/".$cinfo['img']."\" width=\"100%\" >";?></h2>

		<p><?php echo $cinfo['content'];?></p>

	</div>

</div>

<?php include('footer.php');?>