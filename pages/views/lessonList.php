<div id="m_tab">
	<ul class="m_tab">
		<li class="tab active" id="c-lesson-list">All (<b class="cmt_num"><span><?php echo countRecord('lesson', "`cid` = '$c'") ?></span></b>)</li>
	</ul>
	<div class="tab-index c-lesson-list">
	
<?php $lList = $getRecord -> GET('lesson', "`cid` = '$c'", '10', '');
	foreach ($lList as $lList) { ?>
		<div class="c-one-lesson the-box" style="margin-bottom:20px">
			<span class="right gensmall"><span class="fa fa-clock-o"></span> <?php echo $lList['time'] ?></span>
				<img class="c-one-lesson-thumb left" src="<?php echo $lList['thumbnai'] ?>"/>
				<a class="a-title title bold"><?php if ($lList['prefix']) echo '<span class="prefix">'.$lList['prefix'].'</span>'; echo ''.$lList['title'] ?></a>
			<div class="shorten"><?php echo $lList['content'] ?></div>
			<div class="right c-one-lesson-links">
	<?php $recordLesson = getRecordingMeetings($lList['id']);
		if ($cInfo['type'] == 'interact') {
			if ($recordLesson == false || !$recordLesson) {
				$checkLesson = checkBBB($lList['id']);
				if ($checkLesson == 'false' || !$checkLesson || $checkLesson == false || $checkLesson == null) {
					if ($lList['run'] == 'end') echo '<a href="#!course?c='.$c.'&t=learning&l='.$lList['id'].'" class="btn btn-warning btn-perspective btn-sm">This lesson has ended. Recording is processing.</a>';
					else {
						if ($u == $cInfo['uid']) echo '<a href="#!course?c='.$c.'&t=learning&l='.$lList['id'].'" class="btn btn-default btn-perspective btn-sm">This lesson has not started. Click to start.</a>';
						else echo '<a href="#!course?c='.$c.'&t=learning&l='.$lList['id'].'" class="btn btn-default btn-perspective btn-sm">This lesson has not started.</a>';
					}
				} else echo '<a href="#!course?c='.$c.'&t=learning&l='.$lList['id'].'" class="btn btn-primary btn-perspective btn-sm">This lesson is running. Join now!</a>';
			} else echo '<a href="#!course?c='.$c.'&t=learning&l='.$lList['id'].'" class="btn btn-info btn-perspective btn-sm">Recording\'s now available. <i class="gensmall">(Requires normal ticks only)</i></a>';
		} else echo '<a href="#!course?c='.$c.'&t=learning&l='.$lList['id'].'" class="btn btn-perspective btn-primary btn-sm">This is normal course</i></a>';

		if ($u == $cInfo['uid']) echo '<a class="btn btn-info btn-perspective btn-sm"><span class="fa fa-cogs"></span> Creator</a>';
		else if ($member['admin'] == 'admin') echo '<a class="btn btn-danger btn-perspective btn-sm">Admin</a>';
		else if (countRecord('ticks', "`uid` = '$u' AND (`type` = 'lesson' AND `iid` = '{$lList['id']}') || (`type` = 'course' AND `iid` = '$c') ") > 0) {
			$myTickInfo = getRecord('ticks', "`uid` = '$u' AND (`type` = 'lesson' AND `iid` = '{$lList['id']}') || (`type` = 'course' AND `iid` = '$c') ");
			if ($myTickInfo['advance'] == 'yes') echo '<a class="btn btn-primary btn-perspective btn-sm"><span class="fa fa-magic"></span> Advance tick</a>';
			else echo '<a class="btn btn-success btn-perspective btn-sm"><span class="fa fa-ticket"></span> Normal tick</a>';
		} else echo '<a class="btn btn-default btn-perspective btn-sm"><span class="fa fa-times"></span> No ticks found</a>'; ?>
			</div>
		</div>
<?php } ?>
	</div>
</div>
