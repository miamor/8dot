<?php $lList = $getRecord -> GET('lesson', "`cid` = '$c'");
foreach ($lList as $lList) { ?>
	<div class="one-lesson">
		<a data-lesson="<?php echo $lList['id'] ?>"><span class="prefix"><?php echo $lList['prefix'] ?></span> <?php echo $lList['title'] ?></a>
		<a class="right edit-lesson fa fa-edit"><span class=""></span></a>
	</div>
<?php } ?>
