<? $rCodeAr = rCode($rInfo['results_code']);
$rCodeArray = explode('@', $rInfo['results_code']);
$checkSubmit = countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `uid` = '$u' ");
	if ($_GET['act'] == 'submit' || $_GET['act'] == 'save') {
		if ($checkSubmit <= 0) {
			$myResultsCode = '';
			for ($y = 1; $y < count($rCodeAr); $y++) {
				$exAns = $_POST['e-ans-'.$y];
				if ($rAns == 'ans') $exAnswer = $_POST['e-answer-'.$y];
				$exResult = $_POST['e-result-'.$y];
				$myResultsCode .= '@'.$exAns.'['.$y.'::'.$exResult.'::'.$exAnswer.']';
			}
			$myResultsCode = _content($myResultsCode);
			if ($_GET['act'] == 'submit') mysql_query("INSERT INTO `contest_round_submit` (`iid`, `rid`, `uid`, `results_code`, `time`) VALUES ('$iid', '$r', '$u', '$myResultsCode', '$time')");
		}
	} ?>

<div class="exam-answer-sheet right" style="width:280px">

<? if ($cInfo['uid'] != $u) {
	if ($checkSubmit <= 0) echo '<div id="time" class="time-countdown right"><span id="countdown"><span class="count-min"></span> : <span class="count-sec"></span></span></div>';
	else echo '<div class="alerts alert-info">This round is running...</div>' ?>
	<form class="borderwrap form-submit-round-test">
		<div class="name">
			<input type="submit" value="Submit" class="right btn-sm" style="margin-top:-4px"/>
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
		$mAnswer = $mCodeAr['answer'.$j];?>
			<div class="one-ans-sheet rows <? if ($checkSubmit <= 0 || $cInfo['uid'] == $u) echo 'no-do' ?>">
				<div class="bold left"><? echo $rQuest ?>.</div>
		<? if ($checkSubmit <= 0) { ?>
				<div class="left ans-field">
					<input type="text" name="e-result-<? echo $rQuest ?>" placeholder="Result quest <? echo $rQuest ?>"/>
					<input type="hidden" name="e-ans-<? echo $rQuest ?>" value="<? echo $rAns ?>"/>
				</div>
				<div class="clearfix"></div>
				<? if ($rAns == 'ans') { ?>
					<span class="ans-required fa fa-file-text-o" title="Answer required"></span>
					<textarea name="exam-answer-<? echo $rQuest ?>" class="dafukk"></textarea>
				<? } ?>
		<? } else { ?>
				<div class="left ans-field <? if (!$mResult) echo 'empty'; else if ($mResult == $rResult) echo 'correct'; else echo 'wrong' ?>">
					<div class="exam-result left"><? if ($mResult) echo $mResult; else echo '[empty]' ?></div>
					<div class="exam-correct-result right"><? echo $rResult ?></div>
				</div>
				<div class="clearfix"></div>
				<? if ($rAns == 'ans') echo '<div class="exam-answer">'.$mAnswer.'</div>' ?>
		<? } ?>
			</div>
<? 	} ?>
		</div>
	</div>
</form>
<? } else echo '<div class="alerts alert-info">This round is running...</div>' ?>
</div>

<div class="exam-pdf-views" style="margin-right:300px">
	<div class="borderwrap">
		<div class="name">Problem</div>
		<div class="plain">
			<? echo '<iframe class="iframe-document" src="'.PLUGINS.'/pdf-viewer/web/viewer.php?url='.$rInfo['problem'].'"></iframe>' ?>
		</div>
	</div>
</div>

<script>var mins = <? echo $rInfo['test_time'] ?>;</script>
<script src="<? echo JS ?>/roundView.js"></script>
<? if ($checkSubmit <= 0 && $cInfo['uid'] != $u) echo '<script src="'.JS.'/roundDo.js"></script>' ?>
