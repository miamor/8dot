<?php $lLi = $getRecord -> GET('lesson', "`cid` = '$c'", '', '');
$totalPrice = 0;
$totalPrice = $totalPrice + $vat;
foreach ($lLi as $lLiy) {
	if ($cInfo['type'] == 'interact') {
		$priceType = $_POST['price-type-'.$lLiy['id']];
		if ($priceType == 'advanced') {
			if ($cInfo['price-type'] == 'one-price') $price = $cInfo['price'];
			else $price = $lLiy['price'];
		} else {
			if ($cInfo['price-type'] == 'one-price') $price = $cInfo['price_normal'];
			else $price = $lLiy['price_normal'];
		}
	} else {
		$priceType = 'normal';
		if ($cInfo['price-type'] == 'one-price') $price = $cInfo['price'];
		else $price = $lLiy['price'];
	}
	$numTicks = $_POST['gettick_number_'.$lLiy['id']];
	$numTicksHidden = $_POST['gettick_num_'.$lLiy['id']];
	$check = $_POST['gettick_'.$lLiy['id']];
	if ($numTicks) $ticks = $numTicks;
	else $ticks = $numTicksHidden;
	if ($check && $ticks) $totalPrice = $totalPrice + $price * $ticks;
}
if ($member['coin'] >= $totalPrice) {
	foreach ($lLi as $lLi) {
		if ($cInfo['price-type'] == 'one-price') $price = $cInfo['price'];
		else $price = $lLi['price'];
		if ($lLi['prefix']) $Lp = '['.$lLi['prefix'].'] ';
		$lAdvance = 'no';
		if ($cInfo['type'] == 'interact') {
			$priceType = $_POST['price-type-'.$lLi['id']];
			$ticksOut = countRecord('ticks', "`type` = 'lesson' AND `iid` = '{$lLi['id']}'");
			$numLeft = $cInfo['limit'] - $ticksOut;
			if ($priceType == 'advanced') {
				$lAdvance = 'yes';
				if ($cInfo['price-type'] == 'one-price') $price = $cInfo['price'];
				else $price = $lLi['price'];
			} else {
				if ($cInfo['price-type'] == 'one-price') $price = $cInfo['price_normal'];
				else $price = $lLi['price_normal'];
			}
		} else {
			$priceType = 'normal';
			if ($cInfo['price-type'] == 'one-price') $price = $cInfo['price'];
			else $price = $lLi['price'];
		}
		$numTicks = $_POST['gettick_number_'.$lLi['id']];
		$numTicksHidden = $_POST['gettick_num_'.$lLi['id']];
		$check = $_POST['gettick_'.$lLi['id']];
		if ($numTicks) $ticks = $numTicks;
		else $ticks = $numTicksHidden;
		if ($check && $ticks) {
//			echo $check.' - '.$price.' - '.$ticks.'<br/>';
			for ($i = 1; $i <= $ticks; $i++) {
				if ($member['coin'] >= $price) {
					if (($cInfo['type'] == 'interact' && $lAdvance == 'yes' && $numLeft > 0) || ($cInfo['type'] == 'interact' && $lAdvance != 'yes') || $cInfo['type'] != 'interact') {
						if (countRecord('ticks', "`type` = 'lesson' AND `iid` = '{$lLi['id']}'") < 2) {
							$a = mysql_query("INSERT INTO `ticks` (`uid`, `type`, `iid`, `advance`, `price`, `time`) VALUES ('$u', 'lesson', '{$lLi['id']}', '$lAdvance', '$price', '$current')");
							if ($a) {
								echo '<div class="console success"><b>Console log: </b> Get 1 ticket for lesson <b>'.$Lp.$lLi['title'].'</b> successfully.</div>';
								substractCoin($u, $price);
								addCoin($cInfo['uid'], $price);
								addNoti('get-tick-lesson', $l, $c, $cInfo['uid'], $lAdvance);
							} else echo '<div class="console error"><b>Console log: </b> Failed to get 1 ticket for lesson <b>'.$cInfo['title'].'</b>. Technology errors. (Please contact the administrators for help)</div>';
						} else echo '<div class="console error"><b>Console log: </b> Failed to get 1 ticket for lesson <b>'.$Lp.$lLi['title'].'</b>. Maximum reached.</div>';
					} else if ($cInfo['type'] == 'interact' && $lAdvance == 'yes' && $numLeft <= 0) echo '<div class="console error"><b>Console log: </b> Failed to get 1 ticket for lesson <b>'.$Lp.$lLi['title'].'</b>. Out of <b>advanced</b> ticket.</div>';
				} else echo '<div class="console error"><b>Console log: </b> Failed to get 1 ticket for lesson <b>'.$Lp.$lLi['title'].'</b>. Not enough money</div>';
			}
		}
	}
} else echo '<div class="alerts alert-error">You don\'t have enough coins to get these ticks. Please select again.</div>' ?>
