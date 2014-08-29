<?php //$rInfo = getRecord('rooms', "`cid` = '$c' AND `lid` = '$l'");  ?>

<?php $lInfo = getRecord('lesson', "`id` = '$l'");
$task = getRecord('task', "`lid` = '$l'");
$checkMyNote = countRecord('lesson_note', "`uid` = '$u' AND `lid` = '$l' ");
$myNote = getRecord('lesson_note', "`uid` = '$u' AND `lid` = '$l' ");

if ($_GET['do'] == 'addnote') {
	$note = _content($_POST['notepad_text']);
	if ($checkMyNote <= 0) mysql_query("INSERT INTO `lesson_note` (`uid`, `lid`, `cid`, `content`, `time`) VALUES ('$u', '$l', '$c', '$note', '$current')");
	else changeValue('lesson_note', "`uid` = '$u' AND `lid` = '$l' ", "`content` = '$note', `time` = '$current' ");
}

if ($cInfo['type'] == 'interact') {
	if ($u == $cInfo['uid']) {
		$pw = $member['password'];
		if ($_GET['do'] == 'endlesson') {
			$endParams = array(
				'meetingId' => $l, 			// REQUIRED - We have to know which meeting to end.
				'password' => $pw,				// REQUIRED - Must match moderator pass for meeting.
			);
			endMeeting($endParams);
			changeValue('lesson', "`id` = '$l' ", "`run` = 'end' ");
		}
/*		if ($lInfo['run'] == 'yes') {
			$endParams = array(
				'meetingId' => $l, 			// REQUIRED - We have to know which meeting to end.
				'password' => $pw,				// REQUIRED - Must match moderator pass for meeting.
			);
		}
*/	} else $pw = 'ap';

	$recordLesson = getRecordingMeetings($l);
} ?>

<link rel="stylesheet" href="<? echo PLUGINS ?>/fancybox/fancybox.min.css">
<script src="<? echo PLUGINS ?>/fancybox/fancybox.js"></script>
<script>fancyboxLoad();</script>

<div class="lesson-more left" style="width:250px">
<!--	<div class="the-box" style="margin-top:0">
		<b>Public</b>
		<div class="right"><?php echo $cInfo['available'] ?></div>
		<br/>
		<b></b>
	</div>
	<img class="thumb-lesson no-float" src="<?php echo $lInfo['thumbnai'] ?>"/> -->
	<div class="lesson-video">
<?php if ($lInfo['video']) {
	if (check($lInfo['video'], 'youtube') > 0) echo '<a href="'.$lInfo['video'].'">'.$lInfo['video'].'</a>';
	else echo '	<div class="video-viewer">
	<video class="video-lesson video-js" controls preload="auto" poster="'.$lInfo['thumbnai'].'" data-setup="{}">
		<source src="'.$lInfo['video'].'" type="video/mp4">
	</video></div>';
} else echo '<div class="video-viewer" style="height:200px"><img class="fcim" src="'.$lInfo['thumbnai'].'"/></div>' ?>
	</div>
<?	if ($lInfo['document']) { ?>
	<div class="the-box">
		<b><span class="fa fa-paperclip"></span> Document attachment</b><br/>
		<?php $splitDocName = explode('/', $lInfo['document']);
			$lg = count($splitDocName) - 1;
			echo '<a href="'.$lInfo['document'].'">'.$splitDocName[$lg].'</a>' ?>
	</div>
<?php } ?>
<?php if (countRecord('task', "`public` = 'yes' AND `lid` = '$l' ") > 0) { ?>
	<div class="the-box">
		<b><span class="fa fa-tasks"></span> Tasks</b>
		<span class="badge badge-warning"><?php echo countRecord('task_ex', "`tid` = '{$task['id']}'") ?></span>
		<?php $tDay = $todayd; 			$tMonth = $todaym; 			$tYear = $todayY;
			$dead = explode('-', $task['deadline']);
			$dDay = (int)$dead[0]; 		$dMonth = (int)$dead[1]; 		$dYear = (int)$dead[2];
			if ($today == $task['deadline']) $label = 'warning';
			else if ($tYear < $dYear) $label = 'primary';
			else if ($tYear > $dYear) $label = 'danger';
			else {
				if ($tMonth < $dMonth) $label = 'primary';
				else if ($tMonth > $dMonth) $label = 'danger';
				else {
					if ($tDay < $dDay) $label = 'primary';
					else if ($tDay > $dDay) $label = 'danger';
				}
			}
			if ($label == 'danger') $dTitle = 'Deadline passed';
			else if ($label == 'warning') $dTitle = 'Today is deadline!';
			else {
				if ($tYear < $dYear) {
					$lft = $dYear - $tYear;
					if ($lft > 1) $dTitle = $lft.' years till deadline';
					else $dTitle = $lft.' year till deadline';
				} else if ($tMonth < $dMonth) {
					$lft = $dMonth - $tMonth;
					if ($lft > 1) $dTitle = $lft.' months till deadline';
					else $dTitle = $lft.' month till deadline';
				} else if ($tDay < $dDay) {
					$lft = $dDay - $tDay;
					if ($lft > 1) $dTitle = $lft.' days till deadline';
					else $dTitle = $lft.' day till deadline';
				}
			} ?>
		<span class="label label-<?php echo $label ?> right" title="<?php echo $dTitle ?>" style="margin-top:3px"><?php echo $task['deadline'] ?></span><br/>
		<div class="task-list-ex">
		<?php $tsk = $getRecord -> GET('task_ex', "`tid` = '{$task['id']}'", '', '');
		foreach ($tsk as $tsk) {
			$eInfo = getRecord('ex', "`id` = '{$tsk['eid']}'") ?>
		<div class="task-one-ex"><?php echo $eInfo['quest'] ?></div>
		<?php } ?>
		</div>
	</div>
<?php } ?>
</div>

<div class="lesson-content" style="margin-left:270px">
	<?php if ($cInfo['type'] == 'interact') { ?>
			<div class="plain">		
		<?php if ($recordLesson == 'Failed server') echo '<div class="alerts alert-error">Failed to get any response. Maybe we can\'t contact the BBB server</div>';
		else if ($recordLesson == false || !$recordLesson) {
			if ($cInfo['uid'] == $u || ( ($cInfo['pay'] == 'by-lesson' && countRecord('ticks', "`type` = 'lesson' AND `iid` = '$l' AND `advance` = 'yes' ") > 0) || ($cInfo['pay'] == 'by-course' && countRecord('ticks', "`type` = 'course' AND `iid` = '$l'") > 0) ) )
				checkAndJoinBBB($l, $u);
			else echo '<div class="alerts alert-warning">Oops! Seems like you\'ve got only normal tick for advance course. <br/>This cause you can only review the lesson after it ends. <br/>You may want to come back later, when this lesson ends.</div>';
		} else {
			echo '<div class="controlbar-interact-lesson fixed-control">
				<a class="btn btn-xs btn-primary iframe-button minimize-iframe" title="minimize"><span class="fa fa-chevron-down"></span></a>
				<a class="btn btn-xs btn-primary iframe-button maximize-iframe" style="display:none" title="Maximize"><span class="fa fa-chevron-up"></span></a>
			</div><iframe class="interact-lesson-iframe play-record" src="'.$recordLesson.'"></iframe>';
//			if ($u == $cInfo['uid']) changeValue('lesson', "`id` = '$l'", "`run` = 'end'");
		} ?>
			</div>
		<script src="<? echo JS ?>/lessonView.interact.js"></script>
	<?php } ?>
	<div class="borderwrap">
		<div class="name">
			<span class="a-title" title="<?php if ($lInfo['prefix']) echo '['.$lInfo['prefix'].'] '; echo $lInfo['title'] ?>">
			<?php if ($lInfo['prefix']) echo '<span class="prefix">'.$lInfo['prefix'].'</span> ';
				echo $lInfo['title'] ?>
			</span>
			<span class="right gensmall time"><span class="fa fa-clock-o"></span> <?php echo $lInfo['time'] ?></span>
		</div>
		<div class="plain">
			<?php echo $lInfo['content'] ?>
		</div>
	</div>
</div>
		<div style="clear:both"></div>

	<div class="comment-bod" style="margin:30px 0 0">
		<?php $tb = $tbcmt = 'lesson_cmt'; $vl = $l; $ttyp = 'l' ?>
		<?php include 'views/Comment.php' ?>
	</div>
