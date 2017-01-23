<?php include('header.php');
$id = (int)$_GET['id'];
$newsinfo = $db->GetOne("SELECT * FROM #@__article WHERE `id`='".$id."'");
?>
<div data-role="content">
    <div  data-role="collapsible" data-collapsed="false" data-content-theme="c" >
      <h3><?php echo $newsinfo['title'];?></h3>
      <?php echo $newsinfo['content'];?> <br>
    </div>
</div>
<?php include('footer.php');?>