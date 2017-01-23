<?php include('header.php');?>

<div data-role="content" class="mcontent">

<div data-role="collapsible" data-collapsed="false" data-content-theme="c" data-inline="true">

		<h3>产品展示</h3>

			<ul data-role="listview" data-inset="true">

			  <?php

					$type = isset($_GET["typeid"])?"typeid=$_GET[typeid]":NUll;

					$page = isset($_GET['page'])?$_GET['page']:1;

					$display_num=10;

					$start=$display_num*($page-1);

					if($start<='0')

					{

						$start='0';

					}

					$sqls="SELECT * FROM `#@__goods`  WHERE `flag`=0 ORDER BY `order` desc,`ID` desc LIMIT $start,$display_num";

					$numRs="SELECT `id` FROM `#@__goods`  WHERE `flag`=0";

					$db->Query("prs",$sqls);

					$db->Query("numRs",$numRs);

					$total_num = $db->GetTotalRow("numRs");

					$page_temp = MgetPage($total_num,$page,$type=$type,$display_num);

					while($prt=$db->GetArray("prs")){

				   ?>

					   <li><a href="productInfo.php?id=<?php echo $prt['id'];?>" style="height:60px;" data-transition="none" data-ajax="false">

								<img src="uploads/<?php echo $img = ($prt['img'])?$prt['img']:'nophoto.png';?>" style="height:85px;width:85px;" />

								<h3><?php echo $prt['title']?></h3>

								<p><?php echo $prt['keywords']?></p>

						</a></li>

					<?php }	?>					

			</ul>

			<?php echo $page_temp;?></div>

<div> </div>

</div>

<?php include('footer.php');?>