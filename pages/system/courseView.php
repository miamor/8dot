<? if ($_GET['act']) {
	$actt = $_GET['act'];
	if ($actt == 'like' || $actt == 'dislike') {
		if ($cmii) likeCmt('course_cmt', $actt, $cmii, $u);
	}
}
if ( $_GET['do'] == "comment" ) {
	if (!$cmii) {
		$cmt = _content($_POST['comment']);
		if ($cmt) {
			$a = mysql_query("INSERT INTO `course_cmt` (`iid`, `uid`, `content`, `time`) VALUES ('$c', '$u', '$cmt', '$current')");
			if ($cInfo['uid'] != $u && $a) sendNoti('course_cmt', '', $c, $cInfo['uid'], 'course');
		}
	} else {
		$cmiiInfo = getRecord('course_cmt', "`id` = '$cmii' ");
		$cmt = _content($_POST['cmt-stt']);
		if ($cmt) {
			$a = mysql_query("INSERT INTO `course_cmt` (`pid`, `iid`, `uid`, `content`, `time`) VALUES ('$cmii', '$c', '$u', '$cmt', '$current')");
			if ($cmiInfo['uid'] != $u && $a) sendNoti('course_cmt_child', '', $c, $cmiInfo['uid'], 'course');
		}
	}
} ?>
