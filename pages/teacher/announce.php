<?php include '../../lib/config.php';

//echo '<div class="session-warning hide">Course session has expired. This may cause when you\'re trying to attempt 2 courses at once. Please reload this course view page to switch back this session or click reload to use current session. <a class="reload-c-session">Reload</a></div>';
if (!$c && !$a) echo '<div class="alerts alert-error">Course session has expired. Please select a course before doing this action.</div>';
else if ($a && countRecord('lesson', "`id` = '$l' AND `cid` = '$c'") <= 0) echo '<div class="alerts alert-error">No lesson found in this course. This may occur when you\'re trying to access a lesson of other course from this course.</div>';
else {
	$cInfo = getRecord('course', "`id` = '$c'");
	$laInfo = getRecord('announcement', "`id` = '$a'");
	if ($mode == 'new') include 'views/announceNew.php';
	else if ($mode == 'edit') {
		if ($a) include 'views/announceEdit.php';
		else include 'views/announceList.php';
	} else if ($mode == 'delete') include 'views/announceDelete.php';
} ?>

<link rel="stylesheet" type="text/css" href="<?php echo CSS ?>/teacher.css"/>
