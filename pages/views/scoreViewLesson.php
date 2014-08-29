<?php $task = getRecord('task', "`lid` = '$l' ");
$tsk = getRecord('task_submit', "`tid` = '{$task['id']}' AND `uid` = '$uid' ");
$au = getRecord('members', "`id` = '{$tsk['uid']}' ");
include 'system/scoreView.php' ?>

<div class="done-data"></div>

<form class="borderwrap score-form" data-action="<?php echo 'c='.$c.'&t=score&l='.$l.'&u='.$uid ?>" method="post">
	<div class="name">
		<?php echo $au['username'] ?>
		<?php if ($tsk['grade'] == 0 && $cInfo['uid'] == $u) echo '<input type="submit" class="right submit-score" value="Submit"/>' ?>
		<span class="right time gensmall"><i class="fa fa-clock-o"></i> <?php echo $tsk['time'] ?></span>
	</div>
	<div class="plain score">
		<?php if ($tsk['grade'] != 0) echo '<div class="time-grade gensmall" title="Time grading"><i class="fa fa-clock-o"></i> '.$tsk['time_grade'].'</div>' ?>
		<div class="score-square">
	<?php if ($tsk['grade'] != 0) echo '<input type="text" name="score" disabled value="'.$tsk['grade'].'"/>';
		else {
			if ($cInfo['uid'] == $u) echo '<input type="text" name="score"/>';
			else echo '<input type="text" name="score" disabled/>';
		}?>
		</div>
		<div class="text-square">
	<?php if ($tsk['grade'] != 0) echo $tsk['comment'];
		else {
			if ($cInfo['uid'] == $u) echo '<textarea name="score-comment"/>';
			else echo '<textarea name="score-comment">'.$tsk['comment'].'</textarea>';
		}?>
			
		</div>
	</div>
	<div class="plain answer no-padding" data-action="<?php echo 'c='.$c.'&t=score&l='.$l.'&u='.$uid ?>">
<?php $tskEx = $getRecord -> GET('task_ex', "`tid` = '{$task['id']}' ");
	foreach ($tskEx as $tskEx) {
		$myTsk = getRecord('task_ex_submit', "`tid` = '{$task['id']}' AND `teid` = '{$tskEx['id']}' AND `uid` = '$uid' ");
		$eIn = getRecord('ex', "`id` = '{$tskEx['eid']}' ") ?>
		<div class="rows" id ="<?php echo $myTsk['id'] ?>">
			<div class="close close-solution" title="Close"><span class="fa fa-times-circle"></span></div>
			<div class="quest-content"><?php echo $eIn['quest'] ?></div>
			<div class="my-solution hide">
				<?php if ($myTsk['solution']) echo $myTsk['solution']; else echo '<i class="no-solution">No solution supplied.</i>' ?>
			</div>
	<?php if ($myTsk['result']) {
			$qResult = $eIn['result'];
			if ($myTsk['result'] == $qResult) { $label = 'primary'; $tiee = 'Correct'; }
			else { $label = 'danger'; $tiee = 'Not fit'; }
			echo '<div class="right label label-'.$label.'" style="margin-top:4px">'.$tiee.'</div>';
			if ($eIn['type'] == 'answer') {
				echo '<div class="the-result">';
				echo '<div class="my-result label label-'.$label.'" title="User result">'.$myTsk['result'].'</div>';
				if ($label == 'danger') echo '<div class="correct-result label label-primary" title="Correct result">'.$qResult.'</div>';
				echo '</div>';
			} else if ($eIn['type'] == 'test') {
				echo '<div class="task-radio-option">';
				$exChoii = explode('|', $eIn['choices']);
				for ($j = 0; $j < count($exChoii); $j++) {
					echo '<label class="radio ';
					if ($myTsk['result'] == $exChoii[$j]) echo 'checked primary';
					if ($eIn['result'] == $exChoii[$j]) echo 'checked';
					echo '" for="option'.$j.$eIn['id'].'"><input type="radio" id="option'.$j.$eIn['id'].'" disabled ';
					echo 'name="task-result-'.$tsk['id'].'"/> '.$exChoii[$j].'</label>';
				}
				echo '</div>';
			}
		} ?>
	<?php $lcmts = $getRecord -> GET('task_ex_comment', "`teid` = '{$myTsk['id']}' ");
		if ($lcmts) {
			echo '<div class="line-comments">';
				foreach ($lcmts as $lcmts) {
					if ($lcmts['uid'] == $cInfo['uid']) { $label = 'danger'; $by = 'author'; }
					else {
						$label = 'info';
						$uIn = getRecord('members', "`id` = '{$lcmts['uid']}' ");
						$by = $uIn['username'];
					} ?>
					<div class="one-line-cmt by-<?php echo $by ?> -<?php echo $label ?>" id="line<?php echo $lcmts['line'] ?>">
						<span class="expand-cmt fa fa-plus-square"></span>
						<span class="time right"><i class="fa fa-clock-o"></i> <?php echo $lcmts['time'] ?></span>
						<b>#<?php echo $by ?>~</b> <?php echo $lcmts['content'] ?>
					</div>
			<?php }
			echo '</div>';
		} ?>
		</div>
<?php } ?>
	</div>
</form>

<script src="<?php echo JS ?>/scoreView.js"></script>
