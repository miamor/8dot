<?php include '../lib/config.php';
if ($p) {
	if (countRecord('page', "`id` = '$p'") > 0) {
		include 'views/Timeline.php';
	} else echo '<div class="alerts alert-error">No page found. This does not exist or has been removed.</div>';
} else echo '<div class="alerts alert-error">No input specified.</div>' ?>
