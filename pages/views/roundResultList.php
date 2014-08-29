<? if ($r) {
	if ($r != 'award') {
		$tasks = $getRecord -> GET('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' $condition", '', "`pass` DESC, `grade` DESC");
		foreach ($tasks as $tasks) {
			$au = getRecord('members', "`id` = '{$tasks['uid']}' ") ?>
		<div class="one-tsk-score rows" id="u<? echo $tasks['uid'] ?>">
			<?php if ($tasks['grade']) echo '<div class="grade-square right">'.$tasks['grade'].'</div>';
			if ($cInfo['uid'] == $u && $rInfo['result_public'] != 'yes') {
				echo '<div class="pass-candidate left" id="'.$tasks['uid'].'">';
				if ($tasks['pass'] == 'yes') echo '<div class="pass-can passed"><span class="fa fa-check"></span><span class="fa fa-times"></span> Remove</div>';
				else echo '<div class="pass-can"><span class="fa fa-check"></span> Add</div>';
				echo '</div>';
			}
			echo '<a href="#!event?i='.$iid.'&r='.$r.'&t=result&u='.$au['id'].'"><img src="'.$au['avatar'].'" class="avatar img-circle"/> '.$au['username'].'</a>' ?>
		</div>
<? 		}
	} else {
		$tasks = $getRecord -> GET('contest_round_submit', "`iid` = '$iid' AND `rid` = '{$cInfo['rounds']}' AND `pass` = 'yes' ", '', "`grade` DESC");
		foreach ($tasks as $tasks) {
			$augrade = 0;
			$alltasks = $getRecord -> GET('contest_round_submit', "`iid` = '$iid' AND `uid` = '{$tasks['uid']}' ");
			foreach ($alltasks as $alltasks) $augrade += $alltasks['grade'];
			$au = getRecord('members', "`id` = '{$tasks['uid']}' ") ?>
		<div class="one-tsk-score rows" id="u<? echo $tasks['uid'] ?>">
			<?php if ($tasks['grade']) echo '<div class="grade-square right">'.$augrade.'</div>'; ?>
			<? echo '<a href="#!user?u='.$au['id'].'"><img src="'.$au['avatar'].'" class="avatar img-circle"/> '.$au['username'].'</a>' ?>
		</div>
<?		}
	}
} ?>
