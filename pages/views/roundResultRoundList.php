<div class="borderwrap">
	<div class="name">Select rounds</div>
	<div class="plain no-padding">
		<div class="rows">
<? $lastRoundPassed = countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '{$cInfo['rounds']}' AND `pass` = 'yes' ");
$awCount = countRecord('contest_prize', "`iid` = '$iid' ");
if ($awCount > 0) $labee = 'success';
else if ($lastRoundPassed > 0) $labee = 'warning';
else $awCount = 'default';
if (countRecord('contest_round', "`iid` = '$iid' AND `rid` = '{$cInfo['rounds']}' AND `result_public` = 'yes' ") > 0) { ?>
			<a class="short-title a-title" href="#!event?i=<? echo $iid ?>&t=result&r=award">Award</a>
<? } else echo 'Award' ?>
		</div>
<? for ($k = $cInfo['rounds']; $k >= 1; $k--) {
	$tsk = getRecord('contest_round', "`iid` = '$iid' AND `rid` = '$k' ");
	$totalSubmit = countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$k' ");
	$graded = countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$k' AND `grade` != 0 ");
	$ungraded = $totalSubmit - $graded;
	if ($totalSubmit > 0) {
		if ($rInfo['result_public'] == 'yes') $label = 'primary';
		if ($ungraded == 0) $label = 'success';
		else if ($ungraded > 0) $label = 'warning';
	} else $label = 'default'; ?>
		<div class="rows">
			<? if ($tsk) {
				echo '<a class="short-title a-title" href="#!event?i='.$iid.'&t=result&r='.$k.'">';
				echo 'Round <b>'.$k.'</b>';
				echo '</a>';
				echo '<span class="right label label-'.$label.' label-count-grade">'.$graded.'/'.$totalSubmit.'</span>';
			} else {
				echo '<span class="short-title a-title" style="max-width:80%">';
				echo 'Round <b>'.$k.'</b>';
				echo '</span>';
			} ?>
		</div>
<? } ?>
	</div>
</div>

