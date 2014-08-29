<?php include '../lib/config.php' ?>

<?php if (!$t) echo '<div class="the-box heading bg-warning full-width no-border">
	<h1 class="no-padding no-margin"><i class="fa fa-tasks icon-lg icon-circle icon-bordered"></i> Tasks</h1>
</div>
<div class="the-box full-width full-height no-border" style="*background:#fefefe;padding-top:30px">';
if ($member['type'] == 'student' || $member['admin'] == 'admin') {
	if ($member['admin'] == 'admin') echo '<div class="alerts alert-classic">You\'re admin. If your type is not student, then this is just the sample page for you to see how it works.</div>';
	if ($t) {
		if (countRecord('task', "`id` = '$t'") > 0) include 'student/views/taskView.php';
		else echo '<div class="alerts alert-error">This task does not exist</div>';
	} else include 'student/views/taskList.php';
} else echo '<div class="alerts alert-warning">This feature is available for students only.</div>';
if (!$t) echo '</div>' ?>

<script src="<? echo JS ?>/task.js"></script>
