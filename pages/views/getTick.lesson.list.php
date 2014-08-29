<?php if ($_GET['gettick']) include 'system/getTick.lesson.list.php';
else { ?>
<form class="get-tick-tb" style="margin-top:20px">
<h2 class="text-primary left" style="margin:0 5px 0 0!important"><? echo $cInfo['title'] ?></h2><h2>Get tickets!</h2>
	<div class="get-tick-line top center" style="margin-top:10px">
		<div class="get-tick-title">Lesson</div>
		<div class="get-tick-price">Price</div>
		<div class="get-tick-number-had">Your ticks</div>
		<div class="get-tick-number-left">Left</div>
		<div class="get-tick-number-get">Ticks</div>
		<div class="get-tick-check">Get</div>
	</div>
<?php $lLi = $getRecord -> GET('lesson', "`cid` = '$c'");
foreach ($lLi as $lLi) {
	if (!$lLi['prefix']) $lLtitle = $lLi['title'];
	else $lLtitle = '<span class="prefix">'.$lLi['prefix'].'</span> '.$lLi['title'];
	if ($cInfo['price-type'] == 'one-price') $lLprice = $cInfo['price'];
	else $lLprice = $lLi['price'];
	if ($cInfo['price-normal-type'] == 'one-price') $lLpriceNormal = $cInfo['price_normal'];
	else $lLpriceNormal = $lLi['price_normal'];
//	$numJoined = ;
	$ticksOut = countRecord('ticks', "`type` = 'lesson' AND `iid` = '{$lLi['id']}'");
	if ($cInfo['type'] == 'interact') $numLeft = $cInfo['limit'] - $ticksOut;
	else $numLeft = '+';
	$myHad = countRecord('ticks', "`uid` = '$u' AND `type` = 'lesson' AND `iid` = '{$lLi['id']}'");
	if ($myHad == 1) $myHadText = 'one';
	else if ($myHad >= 2) $myHadText = 'two' ?>
	<div class="get-tick-line <?php if ($myHad > 0) echo $myHadText.'-had'; echo ' l-'.$lLi['id'] ?>">
		<div class="get-tick-title"><span class="a-title"><?php echo $lLtitle ?></span></div>
		<div class="get-tick-price">
			<?php if ($cInfo['type'] == 'interact') {
				echo '<label class="radio" for="advanced-'.$lLi['id'].'"><input type="radio" name="price-type-'.$lLi['id'].'" checked ';
				if ($myHad >= 2) echo 'disabled ';
				echo 'value="advanced" alt="'.$lLprice.'" id="advanced-'.$lLi['id'].'"/> '.$lLprice.'</label>
				
				<label class="radio" for="normal-'.$lLi['id'].'"><input type="radio" name="price-type-'.$lLi['id'].'" ';
				if ($myHad >= 2) echo 'disabled ';
				echo 'value="normal" alt="'.$lLpriceNormal.'" id="normal-'.$lLi['id'].'"/> '.$lLpriceNormal.'</label>
				
				<span class="layprice hide">'.$lLprice.'</span>';
			} else echo '<span class="layprice">'.$lLprice.'</span>' ?>
		</div>
		<div class="get-tick-number-had" alt="<?php echo $myHad ?>">
			<?php if ($myHad > 0) echo "<b>$myHad</b>"; else echo $myHad ?>
		</div>
		<div class="get-tick-number-left" alt="<?php echo $numLeft ?>"><?php echo $numLeft ?></div>
		<div class="get-tick-number-get">
			<label class="radio" for="l-<?php echo $lLi['id'] ?>_1"><input type="radio" name="gettick_number_<?php echo $lLi['id'] ?>" value="1" class="get-radio" id="l-<?php echo $lLi['id'] ?>_1" <?php if ($myHad == 1) echo 'checked '; if ($myHad >= 1) echo 'disabled' ?>/> 1</label>
			<label class="radio" for="l-<?php echo $lLi['id'] ?>_2"><input type="radio" name="gettick_number_<?php echo $lLi['id'] ?>" value="2" class="get-radio" id="l-<?php echo $lLi['id'] ?>_2" <?php if ($myHad >= 1) echo 'disabled' ?>/> 2</label>
			<input type="hidden" name="gettick_num_<?php echo $lLi['id'] ?>" value="<?php if ($myHad == 1) echo '1' ?>"/>
		</div>
		<div class="get-tick-check">
			<label class="checkbox" for="l-<?php echo $lLi['id'] ?>"><input type="checkbox" <?php if ($myHad == 0 || $myHad >= 2) echo 'disabled' ?> name="gettick_<?php echo $lLi['id'] ?>" value="<?php echo $lLi['id'] ?>" class="get-check" id="l-<?php echo $lLi['id'] ?>"/></label>
		</div>
	</div>
<?php } ?>
	<div class="get-tick-line center bottom">
		<div class="get-tick-title">Total</div>
		<div class="get-tick-price"><span class="total"></span></div>
		<div class="get-tick-vat">VAT <span class="vat"><?php echo $vat ?></span></div>
		<div class="get-tick-total"><span class="total-vat genbig" style="color:#fa0000"></span></div>
	</div>
	<div style="margin:15px;padding:10px">
		<div class="alerts alert-info left">You have <span class="my-money"><?php echo $member['coin'] ?></span> in your account</div>
		<input class="submit right" type="submit" value="Submit"/>
	</div>
</form>
<?php if ($cInfo['type'] == 'interact') echo '<style>.get-tick-title{width:38%} .get-tick-price{width:22%}.get-tick-vat{width:12.8%}.get-tick-total{width:24.2%}</style>';
else echo '<style>.get-tick-title{width:38%} .get-tick-price{width:22%} .a-title{width:98%}</style>';
} ?>
