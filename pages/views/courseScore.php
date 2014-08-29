<div class="tsk-score-lesson-list">
	<?php include 'views/scoreLessonList.php' ?>
</div>

<div class="score-board">
<? if ($l || $e) {
	if ($l) {
		$tsk = getRecord('task', "`public` = 'yes' AND `lid` = '$l' ");
		$lInfo = getRecord('lesson', "`id` = '$l' ");
		$leTitle = '<span class="label label-info">Lesson</span> '.$lInfo['title'];
	} else {
		$tsk = getRecord('course_test', "`id` = '$e' ");
		$leTitle = '<span class="label label-info">Test</span> '.$tsk['title'];
	}
	echo '<h3 class="text-primary le-title">'.$leTitle.'</h3>';
	if ($uid) {
		if ($l) $tskSubmitt = getRecord('task_submit', "`cid` = '$c' AND `tid` = '{$tsk['id']}' ");
		else $tskSubmitt = getRecord('test_submit', "`cid` = '$c' AND `tid` = '{$tsk['id']}' ");
		if ($tskSubmitt['grade'] != 0 || $cInfo['uid'] == $u) include 'views/scoreView.php';
		else echo '<div class="alerts alert-error">Nothing found. This may cause when this user has not submitted their task or the educator has not graded this.</div>';
	} else { ?>
<div class="the-box tsk-score-list" id="m_tab">
	<div class="m_tab">
		<div class="right search-user">
			<select placeholder="Search an username" class="chosen-select">
				<optgroup label="Graded">
		<?php $gOptions = $getRecord -> GET('task_submit', "`tid` = '{$tsk['id']}' AND `grade` != 0 ");
			foreach ($gOptions as $gOptions) {
				$gUser = getRecord('members', "`id` = '{$gOptions['uid']}' ");
				echo '<option value="'.$gOptions['uid'].'">'.$gUser['username'].'</option>';
			} ?>
				</optgroup>
		<?php if ($cInfo['uid'] == $u) {
				echo '<optgroup label="Ungraded">';
				$uOptions = $getRecord -> GET('task_submit', "`tid` = '{$tsk['id']}' AND `grade` = 0 ");
				foreach ($uOptions as $uOptions) {
					$uUser = getRecord('members', "`id` = '{$uOptions['uid']}' ");
					echo '<option value="'.$uOptions['uid'].'">'.$uUser['username'].'</option>';
				}
				echo '</optgroup>';
			} ?>
			</select>
		</div>
		<li class="tab active" id="graded">Graded</li>
		<?php if ($cInfo['uid'] == $u) echo '<li class="tab" id="ungrade">Ungraded</li>' ?>
	</div>
<?php if ($cInfo['uid'] == $u) { ?>
	<div class="hide tab-index ungrade">
		<?php $condition = "AND `grade` = 0"; include 'views/scoreList.php' ?>
	</div>
<?php } ?>
	<div class="tab-index graded">
		<?php $condition = "AND `grade` != 0"; include 'views/scoreList.php' ?>
	</div>
</div>
<? 	}
} else echo '<div class="alerts alert-info">Select one lesson from the left side to start managing scores.</div>' ?>
</div>
