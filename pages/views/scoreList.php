<? if ($l) {
	$tsk = getRecord('task', "`public` = 'yes' AND `lid` = '$l' ");
	$tasks = $getRecord -> GET('task_submit', "`tid` = '{$tsk['id']}' $condition");
	foreach ($tasks as $tasks) {
		$au = getRecord('members', "`id` = '{$tasks['uid']}' ") ?>
	<div class="one-tsk-score rows">
		<?php if ($tasks['grade']) echo '<div class="grade-square right">'.$tasks['grade'].'</div>' ?>
		<?php echo '<a href="#!course?c='.$c.'&t=score&l='.$l.'&u='.$au['id'].'"><img src="'.$au['avatar'].'" class="avatar img-circle"/> '.$au['username'].'</a>' ?>
	</div>
<?	}
} else if ($e) {
	$tasks = $getRecord -> GET('test_submit', "`tid` = '$e' $condition");
	foreach ($tasks as $tasks) {
		$au = getRecord('members', "`id` = '{$tasks['uid']}' ") ?>
	<div class="one-tsk-score rows">
		<?php if ($tasks['grade']) echo '<div class="grade-square right">'.$tasks['grade'].'</div>' ?>
		<?php echo '<a href="#!course?c='.$c.'&t=score&e='.$e.'&u='.$au['id'].'"><img src="'.$au['avatar'].'" class="avatar img-circle"/> '.$au['username'].'</a>' ?>
	</div>
<? 	}
} ?>
