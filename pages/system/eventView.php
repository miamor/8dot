<? if ($_GET['act']) {
	$actt = $_GET['act'];
	if ($actt == 'like' || $actt == 'dislike') {
		if ($cmii) likeCmt('contest_cmt', $actt, $cmii, $u);
	}
}
if ( $_GET['do'] == "comment" ) {
	if (!$cmii) {
		$cmt = _content($_POST['comment']);
		if ($cmt) {
			$a = mysql_query("INSERT INTO `contest_cmt` (`iid`, `uid`, `content`, `time`) VALUES ('$iid', '$u', '$cmt', '$current')");
			if ($cInfo['uid'] != $u && $a) sendNoti('contest_cmt', '', $c, $cInfo['uid'], 'contest');
		}
	} else {
		$cmiiInfo = getRecord('contest_cmt', "`id` = '$cmii' ");
		$cmt = _content($_POST['cmt-stt']);
		if ($cmt) {
			$a = mysql_query("INSERT INTO `contest_cmt` (`pid`, `iid`, `uid`, `content`, `time`) VALUES ('$cmii', '$iid', '$u', '$cmt', '$current')");
			if ($cmiInfo['uid'] != $u && $a) sendNoti('contest_cmt_child', '', $c, $cmiInfo['uid'], 'contest');
		}
	}
} ?>
