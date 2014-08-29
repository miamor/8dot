<h2>Get tickets!</h2>
<br/>
<?php if ($u != $cInfo['uid']) {
	if ($cInfo['price-type'] == 'one-price' && $member['coin'] < $cInfo['price']) echo '<div class="alerts alert-warning">You don\'t have enough coins to get ticks for this course.</div>';
	else if ($cInfo['price-type'] == 'one-price' && $cInfo['pay'] == 'by-course') echo '<div class="alerts alert-info">This course is <b>one-price</b> and <b>full-packaged</b>. <br/>Get ticks for whole course now!</div>';
	else if ($cInfo['price-type'] == 'one-price' && $cInfo['pay'] == 'by-lesson') echo '<div class="alerts alert-info">This course is <b>one-price</b>. <br/>Get ticks for each lesson now!</div>';
	
	if ($cInfo['available'] == 'both' || $cInfo['available'] == $member['type']) {
		if ($cInfo['pay'] == 'by-course') include 'getTick.course.php';
		else if ($l) include 'getTick.lesson.php';
		else include 'getTick.lesson.list.php';
	} else if ($cInfo['available'] != 'both') echo '<div class="note alerts alert-info">This course is only available for <b>'.$cInfo['available'].'</b>.</div>';
} ?>
