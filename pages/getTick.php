<?php include '../lib/config.php';
$cInfo = getRecord('course', "`id` = '$c'") ?>
<?php if ($u != $cInfo['uid']) {
//	if ($cInfo['price-type'] == 'one-price' && $member['coin'] < $cInfo['price']) echo '<div class="alerts alert-warning">You don\'t have enough coins to get ticks for this course.</div>';
	if ($cInfo['price-type'] == 'one-price' && $cInfo['pay'] == 'by-course') echo '<div class="alerts alert-info">This course is <b>one-price</b> and <b>full-packaged</b> course. <br/>Get ticks for whole course now!</div>';
	else if ($cInfo['price-type'] == 'one-price' && $cInfo['pay'] == 'by-lesson') echo '<div class="alerts alert-info">This course is <b>one-price</b> course.</div>';
	
	if ($cInfo['available'] == 'both' || $cInfo['available'] == $member['type']) {
		if ($cInfo['pay'] == 'by-course') include 'views/getTick.course.php';
		else if ($l) include 'views/getTick.lesson.php';
		else include 'views/getTick.lesson.list.php';
	} else if ($cInfo['available'] != 'both') echo '<div class="note alerts alert-info">This course is only available for <b>'.$cInfo['available'].'</b>.</div>';
} ?>

<script src="<?php echo JS ?>/getTick.js"></script>
