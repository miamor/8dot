<?php if ($_GET['gettick']) include 'system/getTick.course.php';
else { ?>
<form class="get-tick-tb" style="margin-top:20px">
<h2 class="text-primary left" style="margin:0 5px 0 0!important"><? echo $cInfo['title'] ?></h2><h2>Get tickets!</h2>
<?php $tLi = getRecord('course', "`id` = '$c'");
if (!$tLi) echo '<div class="alerts alert-error">You\'re trying to access non-existed course.</div>';
else {
	$ticksOut = countRecord('ticks', "`type` = 'course' AND `iid` = '{$tLi['id']}'");
	if ($cInfo['type'] == 'interact') $numLeft = $cInfo['limit'] - $ticksOut;
	else $numLeft = '+';
	$mynHad = countRecord('ticks', "`uid` = '$u' AND `type` = 'course' AND `iid` = '$c'");
	if ($mynHad == 1) $mynHadText = 'one';
	else if ($mynHad >= 2) $mynHadText = 'two' ?>
	<div class="get-tick-line top center" style="margin-top:10px">
		<div class="get-tick-title">Course</div>
		<div class="get-tick-price">Price</div>
		<div class="get-tick-number-had">Your ticks</div>
		<div class="get-tick-number-left">Left</div>
		<div class="get-tick-number-get">Number</div>
		<div class="get-tick-check">Get</div>
	</div>
	<div class="get-tick-line <?php if ($mynHad > 0) echo $mynHadText.'-had'; echo ' c-'.$c ?>">
		<div class="get-tick-title"><?php echo $cInfo['title'] ?></div>
		<div class="get-tick-price">
		<?php if ($cInfo['type'] == 'interact') {
				echo '<label class="radio" for="advanced-'.$c.'"><input type="radio" name="price-type-'.$c.'" checked value="advanced" alt="'.$cInfo['price'].'" id="advanced-'.$c.'"/> '.$cInfo['price'].'</label>
				<label class="radio" for="normal-'.$c.'"><input type="radio" name="price-type-'.$c.'" value="normal" alt="'.$cInfo['price_normal'].'" id="normal-'.$c.'"/> '.$cInfo['price_normal'].'</label>';
				 echo '<span class="layprice hide">'.$cInfo['price'].'</span>';
			} else echo '<span class="layprice">'.$cInfo['price'].'</span>' ?>
		</div>
		<div class="get-tick-number-had" alt="<?php echo $mynHad ?>">
			<?php if ($mynHad > 0) echo "<b>$mynHad</b>"; else echo $mynHad ?>
		</div>
		<div class="get-tick-number-left" alt="<?php echo $numLeft ?>"><?php echo $numLeft ?></div>
		<div class="get-tick-number-get">
			<label class="radio" for="l-<?php echo $c ?>_1"><input type="radio" name="gettick_number_<?php echo $c ?>" value="1" class="get-radio" id="l-<?php echo $c ?>_1" <?php if ($mynHad == 1) echo 'checked '; if ($mynHad >= 1) echo 'disabled' ?>/> 1</label>
			<label class="radio" for="l-<?php echo $c ?>_2"><input type="radio" name="gettick_number_<?php echo $c ?>" value="2" class="get-radio" id="l-<?php echo $c ?>_2" <?php if ($mynHad >= 1) echo 'disabled' ?>/> 2</label>
			<input type="hidden" name="gettick_num_<?php echo $c ?>" value="<?php if ($mynHad == 1) echo '1' ?>"/>
		</div>
		<div class="get-tick-check">
			<label class="checkbox" for="l-<?php echo $c ?>"><input type="checkbox" <?php if ($mynHad == 0 || $mynHad >= 2) echo 'disabled' ?> name="gettick_<?php echo $c ?>" value="<?php echo $c ?>" class="get-check" id="l-<?php echo $c ?>"/></label>
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
