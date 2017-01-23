<?php include('header.php');

$id = (int)$_GET['id'];

$productinfo = $db->GetOne("SELECT * FROM #@__goods WHERE `id` = '".$id."'");

?>

<div data-role="content">

	<h2><a href="#" class="ui-link" data-transition="none"><img src="./uploads/<?php echo $productinfo['img'];?>" class="lazy" style="width:80%;margin:0 10%"></a></h2>

    <div data-role="collapsible" data-collapsed="false" data-content-theme="c" >

      <h3><?php echo $productinfo['title'];?></h3>

      <?php echo $productinfo['content'];?> <br>

    </div>

</div>

<?php include('footer.php');?>