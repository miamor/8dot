<? $rCodeAr = rCode($eInfo['results_code']);
$rCodeArray = explode('@', $eInfo['results_code']);
$checkSubmit = countRecord('test_submit', "`tid` = '$e' AND `uid` = '$u' ");
/*	$timeInfo = getRecord('countdown', "`tid` = '$e' AND `uid` = '$u' ");
	$total_time = $eInfo['test_time'] * 100;
	$startDay = $timeInfo['day'];
	$startHour = $timeInfo['start_hour'];
	$startTime = $timeInfo['start_time'];
	$endTime = $timeInfo['end_time'];
	$end_time = $now + $total_time;
	$endDay = $todayd;
	$endMin = $nowMS + $total_time;
	if ($endMin > 5959) {
		$endMin = $total_time - (5959 - $nowMS);
		$endHour = $nowH + 1;
		if ($endHour > 23) {
			$endDay = $todayd + 1;
			$endHour = '00';
		}
		$end_time = $endDay.$endHour.$endMin;
	}
	if ($timeInfo['end_day'] == $todayd) $countdown = ($endTime - $now)/100;
	else {
		if (countRecord('countdown', "`tid` = '$e' AND `uid` = '$u'") > 0) $hieuTime = $now - $startTime;
		else $hieuTime = 0;
		$ttmi = $total_time - $hieuTime;
		$countdown = $ttmi/100;
	}
	$counT = number_format((float)$countdown, 2, ':', '');
	$counTt = explode(':', $counT);
	$counTi = sprintf("%02s", intval($counTt[0]));
	$counTs = sprintf("%02s", intval($counTt[1]));
*/	if ($label == 'danger') echo '<div class="alerts alert-error">Deadline passed.</div>';
	if ($cInfo['uid'] == $u) echo '<div class="alerts alert-info">You\'re the course creator.</div>';
	else if (countRecord('test_submit', "`tid` = '$e' AND `uid` = '$u' ") > 0)
		echo '<div class="alerts alert-info">You already submitted this test. You might wanna check your <a href="#!course?c='.$c.'&t=score&e='.$e.'&u='.$u.'">score</a>.</div>';
//	else if (countRecord('countdown', "`tid` = '$e' AND `uid` = '$u' ") <= 0)
//		mysql_query("INSERT INTO `countdown` (`uid`, `tid`, `total_time`, `day`, `start_hour`, `start_time`, `end_day`, `end_time`) VALUES ('$u', '$e', '$total_time', '$todayd', '$nowH', '$now', '$endDay', '$end_time')");
	if ($_GET['act'] == 'submit' || $_GET['act'] == 'save') {
		if ($checkSubmit <= 0 && $u != $cInfo['uid'] && $label != 'danger') {
			$myResultsCode = '';
			for ($y = 1; $y < count($rCodeAr); $y++) {
				$exAns = $_POST['e-ans-'.$y];
				if ($rAns == 'ans') $exAnswer = $_POST['e-answer-'.$y];
				$exResult = $_POST['e-result-'.$y];
				$myResultsCode .= '@'.$exAns.'['.$y.'::'.$exResult.'::'.$exAnswer.']';
			}
			$myResultsCode = _content($myResultsCode);
//			changeValue('countdown', "`tid` = '$e' AND `uid` = '$u' ", "`results_code` = '$myResultsCode' ");
			if ($_GET['act'] == 'submit') mysql_query("INSERT INTO `test_submit` (`cid`, `tid`, `uid`, `results_code`, `time`) VALUES ('$c', '$e', '$u', '$myResultsCode', '$time')");
//			if ($_GET['act'] == 'save') changeValue('countdown', "`tid` = '$e' AND `uid` = '$u' ", "`leave_time` = '$now' ");
		}
	}
//	if ($_GET['act'] == 'public') changeValue('test_submit', "`tid` = '$e' ", "`public` = 'yes' ");
 ?>

<div class="exam-answer-sheet right" style="width:280px">
	<? if ($checkSubmit <= 0 && $cInfo['uid'] != $u && $label != 'danger') echo '<div id="time" class="time-countdown right"><span id="countdown"><span class="count-min"></span> : <span class="count-sec"></span></span></div>' ?>
	<form class="borderwrap form-submit-test">
		<div class="name">
			<? if ($checkSubmit <= 0 && $cInfo['uid'] != $u && $label != 'danger') echo '<input type="submit" value="Submit" class="right btn-sm" style="margin-top:-4px"/>' ?>
			Answer sheet
		</div>
		<div class="plain answer-sheets" style="padding:0">
<? $mCode = getRecord('test_submit', "`tid` = '$e' AND `uid` = '$u' ");
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
		<div class="one-ans-sheet rows <? if ($checkSubmit <= 0 || $cInfo['uid'] == $u || $label == 'danger') echo 'no-do' ?>">
			<div class="bold left"><? echo $rQuest ?>.</div>
	<? if ($cInfo['uid'] == $u || ($checkSubmit <= 0 && $label == 'danger')) { ?>
			<div class="left ans-field correct">
				<div class="exam-result left"><? echo $rResult ?></div>
			</div>
			<div class="clearfix"></div>
			<? if ($rAns == 'ans') echo '<span class="ans-required fa fa-file-text-o" style="margin-top:-4px" title="Answer required"></span>';
				if ($rAnswer) echo '<div class="exam-answer">'.$rAnswer.'</div>'; ?>
	<? } else if ($checkSubmit <= 0 && $label != 'danger') { ?>
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
<? } ?>
		</div>
	</div>
</form>

<div class="exam-pdf-views" style="margin-right:300px">
	<div class="borderwrap">
		<div class="name">Problem</div>
		<div class="plain">
			<? echo '<iframe class="iframe-document" src="'.PLUGINS.'/pdf-viewer/web/viewer.php?url='.$eInfo['problem'].'"></iframe>' ?>
		</div>
	</div>
</div>

<script>var mins = <? echo $eInfo['test_time'] ?>;</script>
<script src="<? echo JS ?>/examView.js"></script>
<? if ($checkSubmit <= 0 && $cInfo['uid'] != $u && $label != 'danger') echo '<script src="'.JS.'/examDo.js"></script>' ?>
