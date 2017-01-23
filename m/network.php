<?php include('header.php');?>
<div data-role="content"  class="mcontent"  >
	<div style="padding:5px;">
		<?php 
        //公司简介
        $sql="SELECT * FROM #@__article WHERE `id` = '3'";
        $ninfo=$db->GetOne($sql);
        ?>
		<h2><?php if($ninfo['img']) echo "<img src=\"./uploads/".$ninfo['img']."\" width=\"100%\" >";?></h2>
		<p><?php echo $ninfo['content'];?></p>
	</div>
</div>
<?php include('footer.php');?>