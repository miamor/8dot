<?php
if ($_GET['act']) {
	$actt = $_GET['act'];
	if ($actt == 'like' || $actt == 'dislike') {
		if ($cmii) likeCmt($tb, $actt, $cmii, $u);
		else if ($typ) voteLib($typ, $actt, $vl, $u, $current);
	} else if ($actt == 'star') starLib($typ, $vl, $u, $current);
	else if ($actt == 'choosebest') {
		if ($cmii && $u != $cminfo['uid']) solveQuest($vl, $cmii);
	}
}

if ( $_GET['do'] == "comment" ) {
	$cmt = (_content($_POST['comment']));
	$cmtType = $_GET['type'];
	if ($cmt) {
		if (!$cmii) {
			if ($tb == 'lesson_cmt') $a = mysql_query("INSERT INTO `$tb` (`iid`, `type`, `uid`, `content`, `time`) VALUES ('$vl', '$cmtType', '$u', '$cmt', '$current')");
			else {
				$a = mysql_query("INSERT INTO `$tb` (`iid`, `uid`, `content`, `time`) VALUES ('$vl', '$u', '$cmt', '$current')");
				if ($typ) {
					$auid = $libInfo['uid'];
					$bvl = $libInfo['id'];
				} else {
					$auid = $cInfo['uid'];
					$bvl = $c;
				}
				if ($a && $u != $auid) sendNoti($tb, $vl, $bvl, $auid);
			}
		} else {
			$cmiiInfo = getRecord($tb, "`id` = '$cmii' ");
			if ($tb == 'lesson_cmt') $a = mysql_query("INSERT INTO `$tb` (`pid`, `iid`, `type`, `uid`, `content`, `time`) VALUES ('$cmii', '$vl', '{$cmiiInfo['type']}', '$u', '$cmt', '$current')");
			else {
				$a = mysql_query("INSERT INTO `$tb` (`pid`, `iid`, `uid`, `content`, `time`) VALUES ('$cmii', '$vl', '$u', '$cmt', '$current')");
				$tbm = explode('_', $tb);	$tbm = $tbm[0];
				if ($a && $u != $cmiInfo['uid']) sendNoti($tb.'_child', $cmii, $vl, $cmiiInfo['uid'], $tbm);
			}
		}
	}
}
?>
