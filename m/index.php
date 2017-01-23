<?php include('header.php');?>
<div data-role="content" class="mcontent">



	<div data-role="collapsible" data-collapsed="false" style="margin:5px 0" data-content-theme="c">

		<h3>公司简介</h3>

		<div data-role="content" >

        	<?php 

			//公司简介

			$sql="SELECT * FROM #@__article WHERE `id` = '1'";

			$cinfo=$db->GetOne($sql);

			?>
			<?php if($cinfo['img']) echo "<img src=\"./uploads/".$cinfo['img']."\" width=\"100%\" >";?>
			<a href="companyInfo.php" style="color: #2f3e46; text-decoration:none; " data-transition="none" data-ajax="false"> <?php echo msubstr($cinfo['content'],0,200);?> </a>

		</div>

	</div>

	<div data-role="collapsible" data-collapsed="false" data-content-theme="c">

		<h3>产品展示</h3>

			<ul data-role="listview" data-inset="true">

			<?php

					$sqls="SELECT * FROM `#@__goods` WHERE `flag`=0 ORDER BY `order` desc,`ID` desc LIMIT 10";

					$db->Query("prs",$sqls);

					while($prt=$db->GetArray("prs")){

			?>

				   <li><a href="productInfo.php?id=<?php echo $prt['id'];?>" style="height:60px;" data-transition="none" data-ajax="false">

							<img src="uploads/m_<?php echo $img = ($prt['img'])?$prt['img']:'nophoto.png';?>" alt="<?php echo $prt['title']?>" style="height:85px;width:85px;" />

							<h3><?php echo $prt['title']?></h3>

							<p><?php echo $prt['keywords']?></p>

					</a></li>

			<?php }?>

			</ul>

		</div>

</div>

<?php include('footer.php');?>