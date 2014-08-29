<div class="contest-problem" id="<? echo $r ?>">
<? if ($rInfo['public_time']) echo '<div class="alerts alert-info">This round is set to be started at <b>'.$rInfo['public_time'].'</b> and end at <b>'.$rInfo['end_time'].'</b></div>';
else echo '<div class="alerts alert-info">This round is set to be started at <b>'.$rOTime.'</b> with no exact time setting yet.</div>';

$participants;
if ($r == 1) {
	if (countRecord('contest_join', "`uid` = '$u' AND `iid` = '$iid' AND `approve` = 'yes' ") > 0) $participants = 'yes';
} else {
	$rpv = $r - 1;
	if (countRecord('contest_round_submit', "`uid` = '$u' AND `iid` = '$iid' AND `rid` = '$rpv' AND `pass` = 'yes' ") > 0) $participants = 'yes';
}

if (countRecord('contest_round', "`iid` = '$iid' AND `rid` = '$r' ") > 0) {
	$checkSubmit = countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` ='$r' AND `uid` = '$u' ");
	$label = '';
	if ($cInfo['uid'] == $u) {
//		echo 'You\'re the creator.';
		$label = 'over';
		include 'views/roundView.php';
	} else if ($rPublicTimeint <= $nowFull) {
		if ($endTime >= $nowFull) {
			if ($participants == 'yes') {
				if ($checkSubmit <= 0) $label = 'doing';
				else $label = 'over-join';
				include 'views/roundView.php';
			} else echo '<div class="alerts alert-info">This round is running. <br/>Since you\'re not one of participants, you can only view the exam after it ends.</div>';
		} else {
			if ($participants == 'yes') $label = 'over-join';
			else $label = 'over';
			$over = 'yes';
			echo '<div class="alerts alert-info">This round is completed.';
			if ($rInfo['result_public'] == 'yes') echo '<br/>Results are now available! Check \'em out now!';
			else echo '<br/>Wait for results published!';
			echo '</div>';
			include 'views/roundView.php';
		}
	} else echo '<div class="alerts alert-error">This round has not started yet.</div>';
} else {
	if ($cInfo['uid'] == $u) echo '<div class="alerts alert-warning">This round is not available yet.</div>';
	else { ?>
<div id="status" class="alerts alert-warning test-not-start">
	<p>This round has not yet started.</p>
	<img class="right" style="margin-top:-5px" src="<? echo IMG ?>/ajax_loading.gif" alt="Contacting server..." />
	<p>You should check again the contest time, or wait for the organizers to publish the test.</p>
	<p>You will be connected as soon as the test starts.</p>
</div>
<script type="text/javascript">
function checkEv () {
	$('.contest-problem').load(MAIN_URL + '/pages/event.php?i=<? echo $iid ?>&r=<? echo $r ?> .contest-problem > div', function () {
		if ($(".test-not-start").length) window.setTimeout("checkEv()", 1000);
	})
}
checkEv();
</script>
<? 	}
} ?>
</div>
