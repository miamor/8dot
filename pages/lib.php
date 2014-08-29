<?php $ratetb = $typ.'_rate';
$votetb = $typ.'_vote';
$startb = $typ.'_star';
if (!$vl && (!$dot || $dot == null || $dot == '')) {
	echo '<div class="alerts alert-error">Please select a dot before using these links.</div>';
} else {
	if ($vl) {
		$libInfo = getRecord($typ, "`id` = '$vl'");
		$auth = getRecord('members', "`id` = '{$libInfo['uid']}'");
		$dInfo = getRecord('dot', "`id` = '{$libInfo['did']}'");
		$tidList = explode(',', $libInfo['tid']);
		if (countRecord($typ, "`id` = '$vl'") > 0) {
			if ($member['admin'] == 'admin' || $libInfo['uid'] == $u || $libInfo['available'] == 'both' || $libInfo['available'] == $member['type']) 
				include 'views/libView.php';
			else echo '<div class="alerts alert-warning">Opps!<br/>This is set to be available for <b>'.$libInfo['available'].'</b> only.<br/>You have no rights to access this.<br/>Sorry about that :(</div>';
		} else echo '<div class="alerts alert-error">Nothing found. Item not exists or has been deleted.</div>';
	} else if ($mode == 'new') {
		if ($typ == 'ex') include 'views/exNew.php';
		else if ($typ == 'quest') include 'views/questNew.php';
		else if ($typ == 'doc') include 'views/docNew.php';
	} else {
		include 'views/libList.php';
	}
}

if (!$mode) right_container('320px', array('views/dotList.php', 'views/topicList.php')) ?>
