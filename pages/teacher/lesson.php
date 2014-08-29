<?php include '../../lib/config.php';

//echo '<div class="session-warning hide">Course session has expired. This may cause when you\'re trying to attempt 2 courses at once. Please reload this course view page to switch back this session or click reload to use current session. <a class="reload-c-session">Reload</a></div>';
if (!$c && !$l) echo '<div class="alerts alert-error">Course session has expired. Please select a course before doing this action.</div>';
else if ($l && countRecord('lesson', "`id` = '$l' AND `cid` = '$c'") <= 0) echo '<div class="alerts alert-error">No lesson found in this course. This may occur when you\'re trying to access a lesson of other course from this course.</div>';
else {
	$cInfo = getRecord('course', "`id` = '$c'");
	$joinList = $getRecord -> GET('course_join', "`cid` = '$c' ");
	$starList = $getRecord -> GET('course_star', "`iid` = '$c' ");
	$lInfo = getRecord('lesson', "`id` = '$l'");
	if ($mode == 'new') include 'views/lessonNew.php';
	else if ($mode == 'edit') {
		if ($l) include 'views/lessonEdit.php';
		else include 'views/lessonList.php';
	} else if ($mode == 'addexercise') include 'views/lessonAddExercise.php';
	else if ($mode == 'delete') include 'views/lessonDelete.php';
} ?>

<? if ($mode == 'new' && !$_GET['act']) echo '<script type="text/javascript" src="'.JS.'/lessonNew.js"></script>' ?>
<link rel="stylesheet" type="text/css" href="<?php echo CSS ?>/teacher.css"/>
