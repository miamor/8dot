<?php $totalPrice = 0;
$totalPrice = $totalPrice + $vat;
	$tAdvance = 'no';
	if ($cInfo['type'] == 'interact') {
		$priceType = $_POST['price-type-'.$c];
		$ticksOut = countRecord('ticks', "`type` = 'course' AND `iid` = '$c'");
		$numLeft = $cInfo['limit'] - $ticksOut;
		if ($priceType == 'advanced') {
			$price = $cInfo['price'];
			$tAdvance = 'yes';
		} else $price = $cInfo['price_normal'];
	}
	$numTicks = $_POST['gettick_number_'.$c];
	$numTicksHidden = $_POST['gettick_num_'.$c];
	$check = $_POST['gettick_'.$c];
	if ($numTicks) $ticks = $numTicks;
	else $ticks = $numTicksHidden;
	if ($check && $ticks) {
		$totalPrice = $totalPrice + $price * $ticks;
//		echo $check.' - '.$price.' - '.$ticks.'<br/>';
		for ($i = 1; $i <= $ticks; $i++) {
			if ($member['coin'] >= $price) {
				if (($cInfo['type'] == 'interact' && $tAdvance == 'yes' && $numLeft > 0) || ($cInfo['type'] == 'interact' && $tAdvance != 'yes') || $cInfo['type'] != 'interact') {
					if (countRecord('ticks', "`type` = 'course' AND `iid` = '$c'") < 2) {
						$a = mysql_query("INSERT INTO `ticks` (`uid`, `type`, `iid`, `advance`, `price`, `time`) VALUES ('$u', 'course', '$c', '$tAdvance', '$price', '$current')");
						if ($a) {
							echo '<div class="console success"><b>Console log: </b> Get 1 ticket for course <b>'.$cInfo['title'].'</b> successfully.</div>';
							substractCoin($u, $price);
							addCoin($cInfo['uid'], $price);
							addNoti('get-tick-course', $c, $c, $cInfo['uid'], $lAdvance);
						} else echo '<div class="console error"><b>Console log: </b> Failed to get 1 ticket for course <b>'.$cInfo['title'].'</b>. Technology errors. (Please contact the administrators for help)</div>';
					} else echo '<div class="console error"><b>Console log: </b> Failed to get 1 ticket for course <b>'.$cInfo['title'].'</b>. Maximum reached.</div>';
				} else if ($cInfo['type'] == 'interact' && $tAdvance == 'yes' && $numLeft <= 0) echo '<div class="console error"><b>Console log: </b> Failed to get 1 ticket for course <b>'.$cInfo['title'].'</b>. Out of <b>advanced</b> ticket.</div>';
			} else echo '<div class="console error"><b>Console log: </b> Failed to get 1 ticket for course <b>'.$cInfo['title'].'</b>. Not enough money.</div>';
		}
	}
?>
