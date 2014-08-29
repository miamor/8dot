<?php $lInfo = getRecord('announcement', "`id` = '$a'"); ?>

<div class="borderwrap" id="readme">
	<div class="name">
		<?php if ($lInfo['prefix']) echo '<span class="prefix">'.$lInfo['prefix'].'</span>';
			echo $lInfo['title'] ?>
		<span class="right gensmall" style="margin-top:-2px"><span class="fa fa-clock-o"></span> <?php echo $lInfo['time'] ?></span>
	</div>
	<div class="plain">
		<img class="thumb-lesson" src="<?php echo $lInfo['thumbnai'] ?>"/>
		<?php echo $lInfo['content'] ?>
		<div style="clear:both"></div>
	</div>
</div>

	<div class="comment-bod" style="margin:30px 0 0">
		<?php $tb = $tbcmt = 'announcement_cmt'; $vl = $a; $ttyp = 'a' ?>
		<?php include 'views/Comment.php' ?>
	</div>
