<?php include '../lib/config.php';

$typ = 'daily_ex'; $vl = $e; $link = '#!todayTask?e=';

$ratetb = $typ.'_rate';
$votetb = $typ.'_vote';
$startb = $typ.'_star';
if (!$vl && (!$dot || $dot == null || $dot == '')) {
	echo '<div class="alerts alert-error">Please select a dot before using these links.</div>';
} else {
	if ($vl) {
		$tsk = getRecord($typ, "`id` = '$vl'");
		$auth = getRecord('members', "`id` = '{$tsk['uid']}'");
		$dInfo = getRecord('dot', "`id` = '{$tsk['did']}'");
		$tidList = explode(',', $tsk['tid']);
		if (countRecord($typ, "`id` = '$vl'") > 0) {
//			if ($member['admin'] == 'admin' || $libInfo['uid'] == $u || $libInfo['available'] == 'both' || $libInfo['available'] == $member['type']) 
			$tsk = getRecord('daily_ex', "`id` = '$e' ");
			if ($tsk['day'] != $today) {
				if ($dInfo['type'] == 'program') include 'views/todayTaskViewPass.program.php';
				else include 'views/todayTaskViewPass.php';
			} else {
				if ($dInfo['type'] == 'program') include 'views/todayTaskView.program.php';
				else include 'views/todayTaskView.normal.php';
			}
//			else echo '<div class="alerts alert-warning">Opps!<br/>This is set to be available for <b>'.$libInfo['available'].'</b> only.<br/>You have no rights to access this.<br/>Sorry about that :(</div>';
		} else echo '<div class="alerts alert-error">Nothing found. Item not exists or has been deleted.</div>';
	} else if ($mode == 'new') include 'views/todayTaskNew.php';
	else {
		include 'views/todayTaskList.php';
		right_container('320px', array('views/dotList.php', 'views/topicList.php'));
	}
} ?>

