<? if ($l) {
	if (countRecord('task_submit', "`lid` = '$l' AND `uid` = '$uid' ") > 0) {
		if ($dInfo['type'] == 'program') include 'scoreViewLesson.program.php';
		else include 'scoreViewLesson.php';
	} else echo '<div class="alerts alert-error">Nothing found. May be this person hasn\'t submit their task.</div>';
} else if ($e) {
	if (countRecord('test_submit', "`tid` = '$e' AND `uid` = '$uid' ") > 0) {
		if ($dInfo['type'] == 'program') include 'scoreViewTest.program.php';
		else include 'scoreViewTest.php';
	} else echo '<div class="alerts alert-error">Nothing found. May be this person hasn\'t submit their test.</div>';
} ?>
<script>$('.tsk-score-lesson-list').addClass('score-view')</script>
