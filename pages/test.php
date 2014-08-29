<?php include '../lib/config.php';
if ($mode == 'new') {
	$cInfo = getRecord('course', "`id` = '$c'");
	$dotInfo = getRecord('dot', "`id` = '{$cInfo['did']}'");
	if ($dotInfo['type'] == 'program') include 'views/testNew.program.php';
	else include 'views/testNew.php';
} ?>
