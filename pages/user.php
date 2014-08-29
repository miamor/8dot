<?php include '../lib/config.php';
$uid = _GET('u');
if ($uid) {
	if (countRecord('members', "`id` = '$uid'") > 0) include 'views/userInfoPage.php';
	else echo '<div class="alerts alert-error">No user found. This user might be deleted.</div>';
} else echo '<div class="alerts alert-error">No user id specified.</div>' ?>
