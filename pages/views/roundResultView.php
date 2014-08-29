<? if ($dInfo['type'] == 'program') include 'views/roundResultView.program.php';
else include 'views/roundResultView.normal.php';
if ($cInfo['uid'] == $u && $_GET['do'] == 'pass') {
	if ($uid) {
		if (countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `uid` = '$uid' AND `pass` = 'yes' ") <= 0)
			changeValue('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `uid` = '$uid' ", "`pass` = 'yes' ");
		else changeValue('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `uid` = '$uid' ", "`pass` = '' ");
	}
} ?>
