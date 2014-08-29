<?php $deadline = $_GET['deadline'];
$difficult = $_GET['difficult'];
if ($_GET['act'] == 'add') {
	if (countRecord('task', "`lid` = '$l'") <= 0) mysql_query("INSERT INTO `task` (`lid`, `cid`, `deadline`, `time`) VALUES ('$l', '$c', '$deadline', '$current')");
	$tInfo = getRecord('task', "`lid` = '$l'");
	$cDotInfo = getRecord('dot', "`id` = '{$cInfo['did']}'");
	$eInfo = getRecord('ex', "`id` = '$e'");
	if ($cDotInfo['type'] == 'program') {
		$lDir = '/data/coding/'.$eInfo['code'].'/c'.$c.'l'.$l.'/';
		$lessonPath = MAIN_PATH.$lDir;
		if (mkdir($lessonPath, 0777, true) ) {
			chmod($lessonPath, 0777);
			chmod(MAIN_PATH.'/data/coding/'.$eInfo['code'], 0777);
		}
	} else $lDir = '';
	if (countRecord('task_ex', "`tid` = '{$tInfo['id']}' AND `eid` = '$e'") <= 0) {
		$add = mysql_query("INSERT INTO `task_ex` (`tid`, `lid`, `cid`, `eid`, `difficult`, `dir`) VALUES ('{$tInfo['id']}', '$l', '$c', '$e', '$difficult', '$lDir')");
		if ($add) echo '<div class="alerts alert-success">One ex has been added to this task successfully.</div>';
	} else {
		$remove = mysql_query("DELETE FROM `task_ex` WHERE `tid` = '{$tInfo['id']}' AND `eid` = '$e'");
		if ($remove) echo '<div class="alerts alert-success">One ex has been removed from this task successfully.</div>';
	}
} else if ($_GET['act'] == 'mark') {
	$tInfo = getRecord('task', "`lid` = '$l'");
	if ($tInfo['difficult'] == 'yes') changeValue('task_ex', "`tid` = '{$tInfo['id']}' AND `eid` = '$e'", "`difficult` = ''");
	else changeValue('task_ex', "`tid` = '{$tInfo['id']}' AND `eid` = '$e'", "`difficult` = 'yes'");
} else if ($_GET['act'] == 'public') {
//	$tInfo = getRecord('task', "`lid` = '$l'");
	changeValue('task', "`id` = '$t' ", "`public` = 'yes'");
} ?>
