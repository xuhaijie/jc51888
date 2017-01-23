<?php include('header.php');?>
<div data-role="content" class="mcontent">
	
	  <?php
            $type = isset($_GET["typeid"])?"typeid=$_GET[typeid]":NUll;
            $page = isset($_GET['page'])?$_GET['page']:1;
            $display_num=3;
            $start=$display_num*($page-1);
            if($start<='0')
            {
                $start='0';
            }
            $classid = $type?$_GET['typeid']:5;
            $class = $db->GetOne("SELECT * FROM #@__type WHERE ID='$classid'");
            $honorClassId = $db->GetClassId($classid);
            $sql="SELECT * FROM #@__article";
            $numint=substr($honorClassId,0,1);
            if(is_numeric($numint))
            {	
                $numRs=$sql." WHERE PID IN($honorClassId)";
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
    	<div style="margin-top:20px;"><img src="uploads/<?php echo $img = ($prt['img'])?$prt['img']:'nophoto.png';?>" style="width:100%;" /></div>
		<?php }	?>	
	
    <?php echo $page_temp;?>
</div>
<?php include('footer.php');?>