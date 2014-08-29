<?php $fCourse = $getRecord -> GET('course_join', "`uid` = '$u' ");
	foreach ($fCourse as $fCourse) {
		$task = $getRecord -> GET('task', "`public` = 'yes' AND `cid` = '{$fCourse['cid']}' ");
		foreach ($task as $task) {
			$lList = getRecord('lesson', "`id` = '{$task['lid']}' ");
			$checkMyTsk = countRecord('task_submit', "`uid` = '$u' AND `tid` = '{$task['id']}' ");
			$checkMyTskEx = countRecord('task_ex_submit', "`uid` = '$u' AND `tid` = '{$task['id']}' ");
			if ($task && $checkMyTsk <= 0 && $checkMyTskEx > 0) {
				$tDay = $todayd; 			$tMonth = $todaym; 			$tYear = $todayY;
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
				}
				$tskExNum = countRecord('task_ex', "`tid` = '{$task['id']}' ");
				$tsk = $getRecord -> GET('task_ex', "`tid` = '{$task['id']}' ");
				$myDoneEx = 0;
				foreach ($tsk as $tsk) {
					$tskSubmit = $getRecord -> GET('task_ex_submit', "`uid` = '$u' AND `teid` = '{$tsk['id']}' ");
					if (countRecord('task_ex_submit', "`uid` = '$u' AND `teid` = '{$tsk['id']}' ") > 0) $myDoneEx++;
				}
				$pComplete = round($myDoneEx/$tskExNum * 100, 2);
				if ($pComplete == 100) $pClass = 'primary';
				else if ($pComplete < 100 && $pComplete >= 90) $pClass = 'success';
				else if ($pComplete < 90 && $pComplete >= 30) $pClass = 'warning';
				else if ($pComplete < 30) $pClass = 'danger'; ?>
				
				<div class="one-task-lesson">
					<a class="short-title do-task" id="<?php echo $task['id'] ?>" title="<?php if ($lList['prefix']) echo '['.$lList['prefix'].'] '; echo $lList['title'] ?>">
						<?php if ($lList['prefix']) echo '<span class="label label-info">'.$lList['prefix'].'</span> '; echo $lList['title'] ?>
					</a>
					<span class="badge badge-warning" title="<?php echo $tskExNum ?> exercise include"><?php echo $tskExNum ?></span>
					<div class="task-progress-bar progress progress-sm progress-striped active">
						<div class="progress-bar progress-bar-<?php echo $pClass ?>" aria-valuenow="90" style="width: <?php echo $pComplete ?>%">
							<div class="small" title="<?php echo $myDoneEx.'/'.$tskExNum ?>"><?php echo $pComplete ?>%</div>
						</div><!-- /.progress-bar .progress-bar-danger -->
					</div>
					<span class="label label-<?php echo $label ?> right" title="<?php echo $dTitle ?>" style="margin-top:3px"><?php echo $task['deadline'] ?></span>
				</div>
				
<?php 		}
		}
	} ?>
