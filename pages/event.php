<?php include '../lib/config.php';

if (!$iid && (!$dot || $dot == null || $dot == '')) echo '<div class="alerts alert-error">Please select a dot before using these links.</div>';
else {
	if ($iid) {
		if (countRecord('contest', "`id` = '$iid'") > 0) {
			$cInfo = getRecord('contest', "`id` = '$iid'");
			if ($r) {
				$rInfo = getRecord('contest_round', "`iid` = '$iid' AND `rid` = '$r' ");
				$rOTimeAr = explode($r.'>', $cInfo['start_rounds']);
				$rOTime = explode('|', $rOTimeAr[1]);
				$rOTime = $rOTime[0];
				$rOTimeSplit = explode('-', $rOTime);
				$rODay = (int)$rOTimeSplit[0];			$rOMonth = (int)$rOTimeSplit[1];			$rOYear = (int)$rOTimeSplit[2];
				$rOTimeClas = '';
				if ($rOYear < $todayY) $rOTimeClas = 'over';
				else if ($rOYear == $todayY) {
					if ($rOMonth < $todaym) $rOTimeClas = 'over';
					else if ($rOMonth == $todaym) {
						if ($rODay < $todayd) $rOTimeClas = 'over';
					}
				}
				$rPublicTimeint = $rInfo['publictime'];
				$enmn = getRecord('contest_members', "`iid` = '$iid' AND `rid` = '$r' ");
				$eMem = $enmn['members'];
				$mList = explode('|', $eMem);
				$endTime = (int)$rInfo['endtime'];
			}
			$iAuth = $cAuth = getRecord('members', "`id` = '{$cInfo['uid']}'");
			$dInfo = getRecord('dot', "`id` = '{$cInfo['did']}'");
			$r1mem = getRecord('contest_members', "`iid` = '$iid' AND `rid` = 1 ");
			$r1mem = $r1mem['members'];
			$r1mem = explode('|', $r1mem);
			
			if ($mode == 'edit') {
				if ($t == 'round') {
					if ($r) include 'views/roundEdit.php';
				}
			} else {
				echo '<h2 class="c-info-h3">'.$cInfo['title'].'</h2>';
				echo '<div class="c-info-view">';
				include 'views/eventInfo.php';
				if ($t == 'result') include 'views/eventRoundResult.php';
				else if ($t == 'members') include 'views/eventRoundMembers.php';
/*				else if ($t == 'test') {
					if ($r) include 'views/eventRound.php';
					else echo '<div class="alerts alert-error">Please choose a round first.</div>';
				}
*/				else {
					if ($r) include 'views/eventRound.php';
					else include 'views/eventView.php';
//					include 'views/eventView.php';
				}
				echo '</div>';
			}
		} else echo '<div class="alerts alert-error">Nothing found. Item not exists or has been deleted.</div>';
	} else if ($mode == 'new') include 'views/eventNew.php';
	else {
		include 'views/eventList.php';
		right_container('250px', array('views/dotList.php', 'views/topicList.php'), array( 'u' => $u, 'dot' => $dot, 'pdot' => $pdot ) );
	}
}
?>
