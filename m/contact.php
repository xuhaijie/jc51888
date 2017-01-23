<?php include('header.php');?>

<div data-role="content" class="mcontent">

	<div data-role="collapsible-set" data-content-theme="c">

			<div data-role="collapsible" data-theme="b"  data-collapsed="false"  >

				<h3>联系我们</h3>

				<div style='text-align:left; font-weight:bold;'>

			  <p>联系人：<?php echo $info['linkman']?></p>

			  <?php if($info['mobile']) :?><p>手　机：<?php echo $info['mobile']?></p><?php endif?>

                    <?php if($info['tel']) :?><p>电　话：<?php echo $info['tel']?></p><?php endif?>

                    <?php if($info['email']) :?><p>邮　箱：<?php echo $info['email']?></p><?php endif?>

                    <?php if($info['address']) :?><p>地　址：<?php echo $info['address']?></p><?php endif?>

				</div>

			</div>



</div>

</div>

<?php include('footer.php');?>