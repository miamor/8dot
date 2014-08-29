<?php include '../lib/config.php';
include 'system/get-dot.php' ?>

<h2>Install new dots</h2>
Get feeds with more and more features on each dot by installing which you love.
<div class="dot-note"></div>
<div class="get-dot-board">
	<div class="dot-detail"><div>
<?php if ($d) {
	$din = getRecord('dot', "`id` = '$d'") ?>
		<div style="color:<? echo $din['color'] ?>">
			<h3 class="left"><?php echo $din['name'] ?></h3> <span class="gensmall" style="margin-left:10px">Color: <?php echo $din['color'] ?></span>
		</div>
		<div class="dot-content" style="margin-top:10px">
			<?php echo $din['content'] ?>
		</div>
<?php } ?>
	</div></div>

	<div class="left-boa">
	<?php $allDots = $getRecord -> GET('dot', "", '', '');
	foreach ($allDots as $allDots) {
		$checkDotuse = countRecord('dot_use', "`uid` = '$u' AND `did` = '{$allDots['id']}'") ?>
		<div class="one-line-dot <?php if ($checkDotuse > 0) echo 'installed' ?>" data-dot="<?php echo $allDots['id'] ?>">
			<div class="one-dot-install minibutton"><?php if ($checkDotuse > 0) echo 'uninstall'; else echo 'install' ?></div>
			<div class="dott" title="<?php echo $allDots['title'] ?>"><span class="dot-color" style="margin-top:5px;background:<?php echo $allDots['color'] ?>"></span>  <span style="color:<?php echo $allDots['color'] ?>;margin-left:20px"><?php echo $allDots['name'] ?></span></div>
			<span class="gensmall right"><?php echo countRecord('dot_use', "`did` = '{$allDots['id']}'") ?></span>
<!--			<div class="view-more right" title="Details" style="padding-top:9px"><span class="icon-file-alt"></span></div> -->
		</div>
	<?php } ?>
	</div>
</div>

<script src="<?php echo JS ?>/get-dot.js"></script>
