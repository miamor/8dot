<h3>Get more dots</h3>

<div class="overflow">
	<?php $allDots = $getRecord -> GET('dot', "", '', '');
	foreach ($allDots as $allDots) {
		$checkDotuse = countRecord('dot_use', "`uid` = '$u' AND `did` = '{$allDots['id']}'") ?>
		<div class="one-line-dot <?php if ($checkDotuse > 0) echo 'installed' ?>" data-dot="<?php echo $allDots['id'] ?>">
<!--			<?php if ($checkDotuse > 0) echo '<div class="one-dot-install label label-square label-primary right">Installed</div>';
			else echo '<div class="one-dot-install label label-square label-default right">install</div>' ?> -->
			<div class="one-dot-install minibutton right"><?php if ($checkDotuse > 0) echo 'uninstall'; else echo 'install' ?></div>
			<div class="dott" id="dot-detail" title="<?php echo $allDots['title'] ?>"><span class="dot-color" style="margin-top:6px;background:<?php echo $allDots['color'] ?>"></span>  <span style="color:<?php echo $allDots['color'] ?>;margin-left:20px"><?php echo $allDots['name'] ?></span></div>
			<span class="gensmall"><?php echo countRecord('dot_use', "`did` = '{$allDots['id']}'") ?></span>
<!--			<div class="view-more right" title="Details" style="padding-top:9px"><span class="icon-file-alt"></span></div> -->
		</div>
	<?php } ?>
</div>

<div class="hide small-board-fixed"></div>
<div class="hide small-board sb-dot-detail"></div>

<script>getDot();</script>
