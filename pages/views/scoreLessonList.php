<div class="borderwrap">
	<div class="name">Tests</div>
	<div class="plain no-padding">
<? $testList = $getRecord -> GET('course_test', "`cid` = '$c' ");
foreach ($testList as $lList) {
	$totalSubmit = countRecord('test_submit', "`tid` = '{$lList['id']}' ");
	$graded = countRecord('test_submit', "`tid` = '{$lList['id']}' AND `grade` != 0");
	$ungraded = $totalSubmit - $graded;
	if ($totalSubmit > 0) {
		if ($ungraded == 0) $label = 'primary';
		else if ($ungraded > 0) $label = 'warning';
	} else $label = 'default'; ?>
	
	<div class="rows">
	<? echo '<a class="short-title a-title" href="#!course?c='.$c.'&t=score&e='.$lList['id'].'">';
		if ($lList['prefix']) echo '<span class="label label-info">'.$lList['prefix'].'</span> '; echo $lList['title'];
		echo '</a>';
		if ($totalSubmit > 0) echo '<span class="right label label-'.$label.' label-count-grade">'.$graded.'/'.$totalSubmit.'</span>'; ?>
	</div>	
<? } ?>
	</div>
</div>

<div class="borderwrap">
	<div class="name">Lessons</div>
	<div class="plain no-padding">
<? $lList = $getRecord -> GET('lesson', "`cid` = '$c' ");
foreach ($lList as $lList) {
	$tsk = getRecord('task', "`public` = 'yes' AND `lid` = '{$lList['id']}' ");
	$totalSubmit = countRecord('task_submit', "`tid` = '{$tsk['id']}' ");
	$graded = countRecord('task_submit', "`tid` = '{$tsk['id']}' AND `grade` != 0");
	$ungraded = $totalSubmit - $graded;
	if ($totalSubmit > 0) {
		if ($ungraded == 0) $label = 'primary';
		else if ($ungraded > 0) $label = 'warning';
	} else $label = 'default'; ?>
	
	<div class="rows">
	<? if ($tsk) {
		echo '<a class="short-title a-title" href="#!course?c='.$c.'&t=score&l='.$lList['id'].'">';
		if ($lList['prefix']) echo '<span class="label label-info">'.$lList['prefix'].'</span> '; echo $lList['title'];
		echo '</a>';
		echo '<span class="right label label-'.$label.' label-count-grade">'.$graded.'/'.$totalSubmit.'</span>';
	} else {
		echo '<span class="short-title a-title" style="max-width:80%">';
		if ($lList['prefix']) echo '<span class="label label-info">'.$lList['prefix'].'</span> '; echo $lList['title'];
		echo '</span>';
	} ?>
	</div>	
<? } ?>
	</div>
</div>

