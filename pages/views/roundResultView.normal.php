<?php $tsk = getRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `uid` = '$uid' ");
$rCode = getRecord('contest_round', "`iid` = '$iid' AND `rid` = '$r' ");
$rCodeArray = explode('@', $rCode['results_code']);
$au = getRecord('members', "`id` = '{$tsk['uid']}' ");
$myCorrect = 0;
if ($_GET['act'] == 'submit') {
	if ($_GET['do'] == 'grade') {
		$grade = $_POST['score'];
		$comt = _content($_POST['score-comment']);
		changeValue('contest_round_submit', "`uid` = '$uid' AND `iid` = '$iid' AND `rid` = '$r' ", "`grade` = '$grade', `comment` = '$comt', `time_grade` = '$current' ");
	}
}
$rCodeAr = rCode($rCode['results_code']);
$mCodeAr = rCode($tsk['results_code']);

for ($j = 1; $j < count($rCodeArray); $j++) {
	$rResult = $rCodeAr['result'.$j];
	$mResult = $mCodeAr['result'.$j];
	if ($mResult == $rResult) $myCorrect++;
} ?>

<div class="done-data"></div>

<form class="borderwrap score-form" data-action="<?php echo 'i='.$iid.'&t=result&r='.$r.'&u='.$uid ?>" method="post">
	<div class="name">
		<?php echo $au['username'] ?> (<span class="genlarge"><? echo $myCorrect ?></span>/<? echo count($rCodeArray) ?>)
		<?php if ($tsk['grade'] == 0 && $cInfo['uid'] == $u) echo '<input type="submit" class="right submit-score" style="margin-top:-5px" value="Submit"/>' ?>
		<span class="right time gensmall"><i class="fa fa-clock-o"></i> <?php echo $tsk['time'] ?></span>
	</div>
	<div class="plain score">
		<?php if ($tsk['grade'] != 0) echo '<div class="time-grade gensmall" title="Time grading"><i class="fa fa-clock-o"></i> '.$tsk['time_grade'].'</div>' ?>
		<div class="score-square">
	<?php if ($tsk['grade'] != 0) echo '<input type="text" name="score" disabled value="'.$tsk['grade'].'"/>';
		else {
			if ($cInfo['uid'] == $u) echo '<input type="text" name="score"/>';
			else echo '<input type="text" name="score" disabled/>';
		}?>
		</div>
		<div class="text-square">
	<?php if ($tsk['grade'] != 0) echo $tsk['comment'];
		else {
			if ($cInfo['uid'] == $u) echo '<textarea name="score-comment"/>';
			else echo '<textarea name="score-comment">'.$tsk['comment'].'</textarea>';
		}?>
			
		</div>
	</div>
	<div class="plain answer no-padding" data-action="<?php echo 'c='.$c.'&t=score&e='.$e.'&u='.$uid ?>">
<? for ($j = 1; $j < count($rCodeArray); $j++) {
	$rQuest = $rCodeAr['q'.$j];
	$rAns = $rCodeAr['ans'.$j];
	$rResult = $rCodeAr['result'.$j];
	$rAnswer = $rCodeAr['answer'.$j];
	$mAns = $mCodeAr['ans'.$j];
	$mResult = $mCodeAr['result'.$j];
	$mAnswer = $mCodeAr['answer'.$j];
	if (!$mResult) $mResult = '[empty]'; ?>
		<div class="one-ans-score-sheet rows <? if ($mResult == '[empty]') echo 'empty'; else if ($mResult == $rResult) echo 'correct'; else echo 'wrong' ?>">
			<div class="bold left"><? echo $rQuest ?>.</div>
				<div class="exam-result left"><? echo $mResult ?></div>
				<div class="exam-correct-result left"><? echo $rResult ?></div>
				<div style="margin:4px 0 0" class="right label label-<? if ($mResult == $rResult) echo 'success'; else echo 'danger' ?>"><? if ($mResult == $rResult) echo 'correct'; else echo 'wrong' ?></div>
			<div class="clearfix"></div>
			<? if ($rAns == 'ans') { ?>
				<span class="ans-required fa fa-file-text-o" title="Answer required"></span>
				<div class="exam-answer"><? echo $mAnswer ?></div>
			<? } ?>
		</div>
<? } ?>
	</div>
</form>

<script src="<?php echo JS ?>/roundResultView.js"></script>
