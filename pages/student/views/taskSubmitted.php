<?php $fCourse = $getRecord -> GET('course_join', "`uid` = '$u' ");
	foreach ($fCourse as $fCourse) {
		$task = $getRecord -> GET('task', "`public` = 'yes' AND `cid` = '{$fCourse['cid']}' ");
		foreach ($task as $task) {
			$lList = getRecord('lesson', "`id` = '{$task['lid']}' ");
			$checkMyTsk = countRecord('task_submit', "`uid` = '$u' AND `tid` = '{$task['id']}' ");
			$myTskSubm = getRecord('task_submit', "`uid` = '$u' AND `tid` = '{$task['id']}' ");
			$checkMyTskEx = countRecord('task_ex_submit', "`uid` = '$u' AND `tid` = '{$task['id']}' ");
			if ($task && $checkMyTsk > 0 && ($grade == 0 && $myTskSubm['grade'] == 0) || ($grade != 0 && $myTskSubm['grade'] != 0) ) {
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
				$tskExNum = countRecord('task_ex', "`tid` = '{$task['id']}' "); ?>
				
				<div class="one-task-lesson submitted">
					<? if ($myTskSubm['grade'] != 0) echo '<div class="grade-square right" style="margin:-3px;height:30px;width:37px;line-height:30px;font-size:18px">'.$myTskSubm['grade'].'</div>' ?>
					<a class="short-title a-title <?php if ($myTskSubm['grade'] == 0) echo 'do-task' ?>" <? if ($myTskSubm['grade'] != 0) echo 'href="#!course?c='.$lList['cid'].'&t=score&l='.$task['lid'].'&u='.$u.'"' ?> id="<?php echo $task['id'] ?>" title="<?php if ($lList['prefix']) echo '['.$lList['prefix'].'] '; echo $lList['title'] ?>">
						<?php if ($lList['prefix']) echo '<span class="label label-info">'.$lList['prefix'].'</span> '; echo $lList['title'] ?>
					</a>
					<span class="badge badge-warning" title="<?php echo $tskExNum ?> exercise include"><?php echo $tskExNum ?></span>
				</div>
				
<?php 		}
		}
	} ?>

