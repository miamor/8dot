<? if (countRecord('course_join', "`cid` = '$c' AND `uid` = '$u'") > 0 || $cInfo['uid'] == $u || $member['type'] == 'admin') {
	$eInfo = getRecord('course_test', "`id` = '$e' ");
	$tDay = $todayd; 			$tMonth = $todaym; 			$tYear = $todayY;
	$dead = explode('-', $eInfo['deadline']);
	$dDay = (int)$dead[0]; 		$dMonth = (int)$dead[1]; 		$dYear = (int)$dead[2];
	if ($today == $eInfo['deadline']) $label = 'warning';
	else if ($tYear < $dYear) $label = 'primary';
	else if ($tYear > $dYear) $label = 'danger';
	else {
		if ($tMonth < $dMonth) $label = 'primary';
		else if ($tMonth > $dMonth) $label = 'danger';
		else {
			if ($tDay < $dDay) $label = 'primary';
			else if ($tDay > $dDay) $label = 'danger';
		}
	}
	if ($dInfo['type'] == 'program') include 'views/examView.program.php';
	else include 'views/examView.normal.php';
} else echo '<div class="alerts alert-error">You must join this course to view this course.</div>'; ?>
