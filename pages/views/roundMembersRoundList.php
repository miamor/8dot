<div class="borderwrap">
	<div class="name">Select rounds</div>
	<div class="plain no-padding">
<? for ($k = $cInfo['rounds']; $k >= 1; $k--) {
	$kp = $k - 1;
	$kpp = $k - 2;
	$tsk = getRecord('contest_round', "`iid` = '$iid' AND `rid` = '$k' ");
				$enmmn = getRecord('contest_members', "`iid` = '$iid' AND `rid` = '$k' ");
				$eMemm = $enmmn['members'];
				$mmList = explode('|', $eMemm);
	if ($k == 1) {
		$totalMemRound = countRecord('contest_join', "`iid` = '$iid' ");
		$totalMemRoundPassed = countRecord('contest_join', "`iid` = '$iid' AND `approve` = 'yes' ");
	} else {
/*		if ($eMemm) $totalMemRound = count($mmList);
		else $totalMemRound = 0;
*/		$totalMemRound = countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$kp' ");
		$totalMemRoundPassed = countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$kp' AND `pass` = 'yes' ");
	}
	if ($totalMemRound > 0) {
		if ($ungraded == 0) $label = 'primary';
		else if ($ungraded > 0) $label = 'warning';
	} else $label = 'default'; ?>
	
	<div class="rows">
	<? if ($tsk) {
		echo '<a class="short-title a-title" href="#!event?i='.$iid.'&r='.$k.'&t=members">';
		echo 'Round <b>'.$k.'</b>';
		if ($k == 1) echo ' - Starting';
		echo '</a>';
		echo '<span class="right label label-'.$label.' label-count-grade">'.$totalMemRoundPassed.'/'.$totalMemRound.'</span>';
	} else {
		echo '<span class="short-title a-title" style="max-width:80%">';
		echo 'Round <b>'.$k.'</b>';
		echo '</span>';
	} ?>
	</div>	
<? } ?>
	</div>
</div>

