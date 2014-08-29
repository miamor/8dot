<? $rCodeAr = rCode($rInfo['results_code']);
$rCodeArray = explode('@', $rInfo['results_code']);
$checkSubmit = countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `uid` = '$u' ");
	if ($cInfo['uid'] != $u) {
		if (countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `uid` = '$u' ") > 0)
			echo '<div class="alerts alert-info">You already submitted this test. You might wanna check <a href="#!event?i='.$iid.'&r='.$r.'&t=score">result</a>.</div>';
	} ?>

<div class="exam-answer-sheet right" style="width:280px">

	<form class="borderwrap form-submit-test">
		<div class="name">
			Answer sheet
		</div>
		<div class="plain answer-sheets" style="padding:0">
<? 	$mCode = getRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `uid` = '$u' ");
	$mCodeAr = rCode($mCode['results_code']);
	$mySmCode = '';
	for ($j = 1; $j < count($rCodeArray); $j++) {
		$rQuest = $rCodeAr['q'.$j];
		$rAns = $rCodeAr['ans'.$j];
		$rResult = $rCodeAr['result'.$j];
		$rAnswer = $rCodeAr['answer'.$j];
		$mAns = $mCodeAr['ans'.$j];
		$mResult = $mCodeAr['result'.$j];
		$mAnswer = $mCodeAr['answer'.$j] ?>
		
		<div class="one-ans-sheet rows <? if ($checkSubmit <= 0 || $cInfo['uid'] == $u) echo 'no-do' ?>">
		<? if ($checkSubmit <= 0) { ?>
			<div class="bold left"><? echo $rQuest ?>.</div>
			<div class="left ans-field correct">
				<div class="exam-result left"><? echo $rResult ?></div>
			</div>
			<div class="clearfix"></div>
			<? if ($rAns == 'ans') echo '<span class="ans-required fa fa-file-text-o" style="margin-top:-4px" title="Answer required"></span>';
				if ($rAnswer) echo '<div class="exam-answer">'.$rAnswer.'</div>'; ?>
		<? } else { ?>
			<div class="left ans-field <? if (!$mResult) echo 'empty'; else if ($mResult == $rResult) echo 'correct'; else echo 'wrong' ?>">
				<div class="exam-result left"><? if ($mResult) echo $mResult; else echo '[empty]' ?></div>
				<div class="exam-correct-result right"><? echo $rResult ?></div>
			</div>
			<div class="clearfix"></div>
			<? if ($rAns == 'ans') echo '<div class="exam-answer">'.$mAnswer.'</div>' ?>
<? 		} ?>
		</div>
<? 	} ?>
		</div>
	</form>

</div>

<div class="exam-pdf-views" style="margin-right:300px">
	<div class="borderwrap">
		<div class="name">Problem</div>
		<div class="plain">
			<? echo '<iframe class="iframe-document" src="'.PLUGINS.'/pdf-viewer/web/viewer.php?url='.$rInfo['problem'].'"></iframe>' ?>
		</div>
	</div>
</div>

<script src="<? echo JS ?>/roundView.js"></script>
