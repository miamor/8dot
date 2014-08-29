<?php if ($a) {
	if (countRecord('announcement', "`id` = '$a' AND `cid` = '$c'") > 0) {
		$aInfo = getRecord('announcement', "`id` = '$a'");
		include 'announceView.php';
	} else echo '<div class="alerts alert-error">No announcement found in this course. This may occur when you\'re trying to access a non-existed announcement or a lesson of other course.</div>';
} else include 'announceList.php' ?>
