<div class="c-info-rights right the-box">

<div class="lib-auth-view-info right">
	<div class="gensmall">Submitted <span class="icon-time"></span> <?php echo $libInfo['time'] ?></div>
	<a href="#!user?u=<?php echo $libInfo['uid'] ?>">
		<img class="lib-auth-thumbnai left" src="<?php echo $auth['avatar'] ?>"/>
		<?php echo $auth['username'] ?>
	</a>
	<div class="more-auth-info">
		<b><img src="<?php echo IMG ?>/ense110.png"/> <?php echo $auth['coin'] ?></b>
		<b><img src="<?php echo IMG ?>/table_10.png"/> <?php echo $auth['reputation'] ?></b>
	</div>
</div>

<div class="more-info">
		<?php for ($i = 0; $i < count($tidList); $i++) {
				$tInfo = getRecord('topic', "`id` = '{$tidList[$i]}'") ?>
			<a class="item-topic-one border-radius" style="color:<?php echo $dInfo['color'] ?>">
				<div class="dott dot-<?php echo $dInfo['re'] ?>" alt="<?php echo $dInfo['id'] ?>" title="Dot <?php echo $dInfo['title'] ?>"><span class="dot-color" style="background:<?php echo $dInfo['color'] ?>"></span></div>
			<?php echo $tInfo['title'] ?></a>
		<?php } ?>
</div>

<div class="lib-privacy"><i class="fa fa-lock"></i> Privacy: <span class="capitalize"><?php echo $libInfo['available'] ?></span></div>
</div>
