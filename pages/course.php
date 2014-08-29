<?php include '../lib/config.php';
if ($c) $_SESSION['c'] = $c;
if (!$c) unset($_SESSION['c']);
$cShowRightBar = true;
if (!$c && (!$dot || $dot == null || $dot == '')) {
	echo '<div class="alerts alert-error">Please select a dot before using these links.</div>';
} else {
	if ($c) {
		if (countRecord('course', "`id` = '$c'") > 0) {
			$cInfo = getRecord('course', "`id` = '$c'");
			$iAuth = $cAuth = getRecord('members', "`id` = '{$cInfo['uid']}'");
			$dInfo = getRecord('dot', "`id` = '{$cInfo['did']}'");
			$peList = explode('|', $cInfo['people_list']);
$joinList = $getRecord -> GET('course_join', "`cid` = '$c' ");
$starList = $getRecord -> GET('course_star', "`iid` = '$c' ");
			if ($cInfo['available'] == 'both' || $cInfo['available'] == $member['type'] || $member['admin'] == 'admin' || $cInfo['uid'] == $u) {
				if (  $member['admin'] == 'admin' || $cInfo['privacy'] == 'public' || $cInfo['privacy'] == 'link' || ($cInfo['privacy'] == 'exclude' && !in_array($u, $peList)) || ($cInfo['privacy'] == 'include' && in_array($u, $peList)) ||
					($cInfo['privacy'] == 'trash' && $cInfo['uid'] == $u) ) {

					if ($l && countRecord('lesson', "`id` = '$l' AND `cid` = '$c' ") <= 0) echo '<div class="alerts alert-error">You\'re trying to attempt a lesson belongs to another course from here.</div>';
					else if ($e && countRecord('course_test', "`id` = '$e' AND `cid` = '$c' ") <= 0) echo '<div class="alerts alert-error">You\'re trying to attempt an exam belongs to another course from here.</div>';
					else if ($t == 'ticks') include 'views/getTick.php';
					else {
						$cShowRightBar = false;
						echo '<h2 class="c-info-h3">'.$cInfo['title'].'</h2>';
						echo '<div class="c-info-view">';
						include 'views/courseInfo.php';
						if ($t == 'learning') include 'views/courseLearning.php';
						else if ($t == 'announcement') include 'views/courseAnnounce.php';
						else if ($t == 'exam') include 'views/courseExam.php';
						else if ($t == 'score') include 'views/courseScore.php';
						else if ($t == 'discuss') include 'views/courseDiscuss.php';
						else if ($t == 'statistics') include 'views/courseSta.php';
						else if (!$t || $t == 'home') include 'views/courseView.php';
						else echo '<div class="alerts alert-error">No page found.</div>';
						echo '</div>';
					}
				} else echo '<div class="alerts alert-warning">Opps!<br/>This course is not public. And you don\'t have permissons to access this.<br/>Sorry about that :(</div>';
			} else echo '<div class="alerts alert-warning">Opps!<br/>This course is only available for <b>'.$cInfo['available'].'</b>.<br/>You have no rights to join this.<br/>Sorry about that :(</div>';
		} else echo '<div class="alerts alert-error">Nothing found. Item not exists or has been deleted.</div>';
	} else {
		include 'views/courseList.php';
	}
}
if ($cShowRightBar == true) right_container('250px', array('views/dotList.php', 'views/topicList.php'), array( 'u' => $u, 'dot' => $dot, 'pdot' => $pdot ) );
?>

