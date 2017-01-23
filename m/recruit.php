<?php include('header.php');?>
<div data-role="content" class="mcontent">
<?php
	$page = isset($_GET['page'])?$_GET['page']:1;
	$display_num=2;
	$start=$display_num*($page-1);
	if($start<='0')
	{
		$start='0';
	}
	$sqls="SELECT * FROM `#@__jobs` ORDER BY `ORDER` DESC, `ID` DESC  limit $start,$display_num";
	$sqlnum="SELECT * FROM `#@__jobs`";
	$db->Query("recu",$sqls);
	$db->Query("num",$sqlnum);
	$total_num = $db->GetTotalRow("num");
	$page_temp = MgetPage($total_num,$page,$type=$type,$display_num);
	while($re=$db->GetArray("recu")){
?>
	<div data-role="collapsible" data-collapsed="false" style="margin:5px 0" data-content-theme="c">
		<h3><?php echo $re['job']?></h3>
		<div data-role="content">
            <p>职位名称：<?php echo $re['job']?></p>
            <p>招聘人数：<?php echo $re['num']?></p>
            <p>工资待遇：<?php echo $re['salary']?></p>
            <p>详细说明：<?php echo $re['request']?></p>
		</div>
	</div>
<?php }	?>
<?php echo $page_temp;?>	
</div>
<?php include('footer.php');?>

