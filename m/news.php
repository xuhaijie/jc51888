<?php include('header.php');?>

<div data-role="content" class="mcontent">

<div data-role="collapsible" data-collapsed="false" data-content-theme="c" data-inline="true">

		<h3>新闻中心</h3>

			<ul data-role="listview" data-inset="true" >

			  <?php

					$type = isset($_GET["typeid"])?"typeid=$_GET[typeid]":NUll;

					$page = isset($_GET['page'])?$_GET['page']:1;

					$display_num=10;

					$start=$display_num*($page-1);

					if($start<='0')

					{

						$start='0';

					}

					$classid = $type?$_GET['typeid']:NEWS;

					$class = $db->GetOne("SELECT * FROM #@__type WHERE ID='$classid'");

					$newsClassId = $db->GetClassId($classid);

					$sql="SELECT * FROM #@__article";

					$numint=substr($newsClassId,0,1);

					if(is_numeric($numint))

					{	

						$numRs=$sql." WHERE PID IN($newsClassId)";

						$sqls=$numRs." ORDER BY `ORDER` DESC,`ID` DESC limit $start,$display_num";

						

					}else

					{

						$sqls=$sql."  ORDER BY `ORDER` DESC,`ID` DESC   limit 0";	

						$numRs=$sql. " limit 0";

					}

					$db->Query("prs",$sqls);

					$db->Query("numRs",$numRs);

					$total_num = $db->GetTotalRow("numRs");

					$page_temp = MgetPage($total_num,$page,$type=$type,$display_num);

					while($prt=$db->GetArray("prs")){

				   ?>

					   <li><a href="newsInfo.php?id=<?php echo $prt['id'];?>"  data-transition="none" data-ajax="false">

								

								<?php echo $prt['title']?></a>

								<!-- <p class="ui-li-aside" style=" margin-top:13px; margin-right:35px; margin-left:0px;"><?php echo $prt['time']?></p>  -->

						</li>

					<?php }	?>					

			</ul>

			<?php echo $page_temp;?></div>

<div> </div>

</div>

<?php include('footer.php');?>