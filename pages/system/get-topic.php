<?php if ($t) {
	echo $t;
	$tinfo = getRecord('topic', "`id` = '$t'");
	$checkDotuse = countRecord('topic_follow', "`uid` = '$u' AND `tid` = '$t'");
	if ($_GET['act'] == 'follow') {
		if ($checkDotuse <= 0) {
			$a = mysql_query("INSERT INTO `topic_follow` (`uid`, `tid`, `time`) VALUES ('$u', '$t', '$current')");
			if ($a) echo '<div class="alerts alert-success">Followed topic <b>'.$tinfo['title'].'</b>.</div>';
			else echo '<div class="alerts alert-error">Failed to follow <b>'.$tinfo['title'].'</b>. Seems like something wrong on system technology. (Please contact the administrators for help)</div>';
		} else echo '<div class="alerts alert-error">You already follow this topic.</div>';
	} else if ($_GET['act'] == 'unfollow') {
		if ($checkDotuse > 0) {
			$a = mysql_query("DELETE FROM `topic_follow` WHERE `uid` = '$u' AND `tid` = '$t' ");
			if ($a) echo '<div class="alerts alert-success">Unfollowed topic <b>'.$tinfo['title'].'</b>.</div>';
			else echo '<div class="alerts alert-error">Failed to unfollow <b>'.$tinfo['title'].'</b>. Seems like something wrong on system technology. (Please contact the administrators for help)</div>';
		} else echo '<div class="alerts alert-error">You\'ve not followed this topic yet.</div>';
	}
} else if ($_GET['act']) echo '<div class="alerts alert-error">No topic found. Please select a dot before doing this action.</div>'; ?>
