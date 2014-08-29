<?php if ($l) {
	if (countRecord('lesson', "`id` = '$l' AND `cid` = '$c'") > 0) {
//		if ($cInfo['available'] == 'both' || $cInfo['available'] == $member['type'] || $member['admin'] == 'admin' || $u == $cInfo['uid']) {
		$lInfo = getRecord('lesson', "`id` = '$l'");
			if ( $u != $cInfo['uid'] && (($cInfo['pay'] == 'by-lesson' && countRecord('ticks', "`type` = 'lesson' AND `iid` = '$l'") <= 0) ||
			    ($cInfo['pay'] == 'by-course' && countRecord('ticks', "`type` = 'course' AND `iid` = '$c'") <= 0)) ) {
				if ($cInfo['pay'] == 'by-lesson') echo '<div class="alerts alert-warning">We found no ticks of this lesson in your package. You must get at least 1 tick of this lesson to access this lesson.</div>';
				else echo '<div class="alerts alert-warning">This is full-packaged course.<br/>We found no ticks of this course in your package. You must get at least 1 tick of this course to access these lessons.</div>';
			} else {
				$ok = true;
				if ($cInfo['type'] == 'interact') {
					$recordLesson = getRecordingMeetings($l);
					if ($recordLesson == false || !$recordLesson) {
						$checkLesson = checkBBB($l);
						if ($checkLesson == 'false' || !$checkLesson || $checkLesson == false || $checkLesson == null) {
							if ($lInfo['run'] == 'end') $ok = true;
							else {
								if ($u == $cInfo['uid']) $ok = true;
								else {
									if (($cInfo['pay'] == 'by-lesson' && countRecord('ticks', "`type` = 'lesson' AND `iid` = '$l' AND `advance` = 'yes'") <= 0) ||
										($cInfo['pay'] == 'by-course' && countRecord('ticks', "`type` = 'course' AND `iid` = '$c' AND `advance` = 'yes'") <= 0)) $ok = false;
								}
							}
						} else echo '<a href="#!course?c='.$c.'&t=learning&l='.$l.'" class="btn btn-primary btn-perspective btn-sm">This lesson is running. Join now!</a>';
					}
				}
				if ($ok == true) include 'lessonView.php';
				else echo '<div class="alerts alert-warning">Oops! You can\'t log into this lesson right now. This might be caused when you\'re trying to access a <b>with-interact</b> lesson with <b>normal ticks</b>. <a href="/welcome/#tick-la-gi">See more...</a></div>';
			}
//		} else echo '<div class="alerts alert-warning">Opps! <br/>This course is only available for <b>'.$cInfo['available'].'</b>. <br/>You have no rights to join this. Sorry about that :(</div>';
	} else echo '<div class="alerts alert-error">No lesson found in this course. This may occur when you\'re trying to access a non-existed lesson or a lesson of other course.</div>';
} else include 'lessonList.php' ?>


