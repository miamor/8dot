<?php $lInfo = getRecord('lesson', "`id` = '$l'");
$task = getRecord('task', "`lid` = '$l'"); ?>

<div class="lesson-more left" style="width:250px">
<!--	<img class="thumb-lesson no-float" src="<?php echo $lInfo['thumbnai'] ?>"/> -->
	<video class="video-lesson video-js" controls preload="auto" poster="<?php echo $lInfo['thumbnai'] ?>" data-setup="{}">
		<source src="<?php echo $lInfo['video'] ?>" type="video/mp4">
	</video>
	<div class="the-box">
		<b><span class="fa fa-paperclip"></span> Document attachment</b><br/>
		<?php $splitDocName = explode('/', $lInfo['document']);
			$lg = count($splitDocName) - 1;
			echo '<a href="'.$lInfo['document'].'">'.$splitDocName[$lg].'</a>' ?>
	</div>
	<div class="the-box">
		<b><span class="fa fa-tasks"></span> Tasks</b>
		<span class="badge badge-warning"><?php echo countRecord('task_ex', "`tid` = '{$task['id']}'") ?></span>
		<?php $tDay = intval(date('d')); $tMonth = intval(date('m')); $tYear = intval(date('Y'));
			$dead = explode('-', $task['deadline']);
			$dDay = intval($dead[0]); $dMonth = intval($dead[1]); $dYear = intval($dead[2]);
			if ($today == $task['deadline']) $label = 'warning';
			else if ($tYear < $dYear) $label = 'danger';
			else if ($tYear > $dYear) $label = 'primary';
			else {
				if ($tMonth > $dMonth) $label = 'primary';
				else if ($tMonth < $dMonth) $label = 'danger';
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
</div>

<div class="lesson-content" style="margin-left:270px">
	<div class="borderwrap" id="readme">
		<div class="name">
			<?php if ($lInfo['prefix']) echo '<span class="prefix">'.$lInfo['prefix'].'</span>';
				echo $lInfo['title'] ?>
			<span class="right gensmall" style="margin-top:-2px"><span class="icon-time"></span> <?php echo $lInfo['time'] ?></span>
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
