<div class="tsk-score-lesson-list tsk-score-round-list <? if (countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `uid` = '$uid' ") > 0) echo 'score-view' ?>">
	<?php include 'views/roundResultRoundList.php' ?>
</div>

<div class="score-board result-board">

<? if ($rPublicTimeint > $nowFull) echo '<div class="alerts alert-info">This round has not started yet.</div>';
else if ($endTime >= $nowFull) echo '<div class="alerts alert-info">This round is running.</div>';
else {
	if ($r && $uid) include 'views/roundResultView.php';
	else if ($r && $r != 'award') {
		if ($cInfo['uid'] == $u || $rInfo['result_public'] == 'yes') {
			$totalSubmit = countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' ");
			$graded = countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `grade` != 0");
			$passed = countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `pass` = 'yes' ");
			if ($cInfo['uid'] == $u) {
				if ($rInfo['result_public'] == 'yes') echo '<div class="alerts alert-info">This round result is published. You can\'t edit this anymore.</div>';
				else {
					if ($totalSubmit == $graded) {
						if ($passed >= 2) echo '<div class="alerts alert-info">This round result has not been published. Do you want to publish now? Once published, you cannot edit this. <a class="bold submit-result" data-href="i='.$iid.'&t=result&r='.$r.'">Publish!</a></div>';
						else echo '<div class="alerts alert-info">Select some candidates to go to next round. You can only publish result when there are at least 2 candidates selected.</div>';
					} else echo '<div class="alerts alert-info">Grade them all to start picking. You can only publish result after picking members to the next round.</div>';
				}
			}
			if ($cInfo['uid'] == $u) {
				if ($passed >= 2 && $_GET['do'] == 'submitresult') {
					changeValue('contest_round', "`iid` = '$iid' AND `rid` = '$r' ", "`result_public` = 'yes' ");
//					sendNoti('result_public', $r, $iid, '');
				}
			}
			$tsk = getRecord('contest_round', "`iid` = '$iid' AND `rid` = '$r' ") ?>
	<div class="the-box tsk-score-list" id="m_tab">
		<div class="m_tab">
			<div class="right search-user">
				<select placeholder="Search an username" class="chosen-select">
					<optgroup label="Graded">
			<?php $gOptions = $getRecord -> GET('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `grade` != 0 ");
				foreach ($gOptions as $gOptions) {
					$gUser = getRecord('members', "`id` = '{$gOptions['uid']}' ");
					echo '<option value="'.$gOptions['uid'].'">'.$gUser['username'].'</option>';
				} ?>
					</optgroup>
			<?php if ($cInfo['uid'] == $u) {
					echo '<optgroup label="Ungraded">';
					$uOptions = $getRecord -> GET('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `grade` = 0 ");
					foreach ($uOptions as $uOptions) {
						$uUser = getRecord('members', "`id` = '{$uOptions['uid']}' ");
						echo '<option value="'.$uOptions['uid'].'">'.$uUser['username'].'</option>';
					}
					echo '</optgroup>';
				} ?>
				</select>
			</div>
			<li class="tab active" id="graded">Graded</li>
			<?php if ($cInfo['uid'] == $u) echo '<li class="tab" id="ungrade">Ungraded</li>' ?>
		</div>
	<?php if ($cInfo['uid'] == $u) { ?>
		<div class="hide tab-index ungrade">
			<?php $condition = "AND `grade` = 0"; $orderr = ''; include 'views/roundResultList.php' ?>
		</div>
	<?php } ?>
		<div class="tab-index graded">
			<?php $condition = "AND `grade` != 0"; $orderr = "`grade` DESC"; include 'views/roundResultList.php' ?>
		</div>
	</div>
	<script src="<? echo JS ?>/roundResultList.js"></script>
<?php 	} else echo '<div class="alerts alert-info">This has not been published yet.</div>';
	} else if ($r == 'award') { ?>
<form class="the-box tsk-score-list award-submit" id="m_tab" data-action="<? echo "i=$iid&t=result&r=award" ?>">
	<div class="m_tab">
<? if ($cInfo['uid'] == $u) { ?>
		<div class="right search-user">
			<input type="submit" value="Submit" <? if ($cInfo['prize_awarded']) echo 'disabled' ?>/>
		</div>
<? } ?>
		<li class="tab active" id="awarding">Awarding</li>
		<li class="tab" id="mlist">List</li>
	</div>
	<div class="tab-index awarding">
<? $cPrizez = explode('|', $cInfo['prize']);
if ($_GET['do'] == 'award' && !$cInfo['prize_awarded'] && $cInfo['uid'] == $u) {
	$prizeAwrd = array();
	for ($j = 0; $j < count($cPrizez); $j++) {
		$jPrz = explode('-', $cPrizez[$j]);
		$jPrName = $jPrz[0];
		$jPrNums = $jPrz[1];
		$jPrzVal = $jPrz[2];
		$jPrzImg = $jPrz[3];
		$jPrNameNoSpace = str_replace(' ', '', $jPrName);
		$thisPrzAwrd = $jPrName.'>';
		$thisPrzAwrdAr = array();
		for ($k = 1; $k <= $jPrNums; $k++) {
			$onePrzu = $_POST[$jPrNameNoSpace.'-'.$k];
			if ($onePrzu > 0) array_push($thisPrzAwrdAr, $onePrzu);
		}
		$thisPrzAwrdStr = implode('+', $thisPrzAwrdAr);
		$thisPrzAwrd .= $thisPrzAwrdStr;
		array_push($prizeAwrd, $thisPrzAwrd);
	}
	$prizeAwrd = implode('|', $prizeAwrd);
	changeValue('contest', "`id` = '$iid' ", "`prize_awarded` = '$prizeAwrd' ");
}
for ($j = 0; $j < count($cPrizez); $j++) {
	$jPrz = explode('-', $cPrizez[$j]);
	$jPrName = $jPrz[0];
	$jPrNums = $jPrz[1];
	$jPrzVal = $jPrz[2];
	$jPrzImg = $jPrz[3];
	$jPrNameNoSpace = str_replace(' ', '', $jPrName) ?>
	<div class="one-prize" style="padding:8px 15px">
		<div>
			<img src="<? echo $jPrzImg ?>"/>
			<b><? echo $jPrName ?></b> (<i><? echo $jPrNums ?></i>)
			<span class="right"><img style="margin-top:-2px" src="<? echo IMG ?>/dollar_coin.png"/> <? echo $jPrzVal ?> </span>
		</div>
		<div class="aw-people">
<? if (!$cInfo['prize_awarded']) {
	for ($k = 1; $k <= $jPrNums; $k++) { ?>
			<div class="aw-per" style="width:70%;margin-top:5px">
				<b class="left"><?echo $k ?>. </b>
				<select placeholder="Search an username" name="<? echo $jPrNameNoSpace.'-'.$k ?>" class="chosen-select">
					<option value="0">Choose a person</option>
			<?php $gOptions = $getRecord -> GET('contest_round_submit', "`iid` = '$iid' AND `rid` = '{$cInfo['rounds']}' AND `pass` = 'yes' ");
				foreach ($gOptions as $gOptions) {
					$gUser = getRecord('members', "`id` = '{$gOptions['uid']}' ");
					echo '<option value="'.$gOptions['uid'].'">'.$gUser['username'].'</option>';
				} ?>
				</select>
			</div>
	<? }
} else {
	$prizAwrd = explode($jPrName.'>', $cInfo['prize_awarded']);
	$prizAwrd = explode('|', $prizAwrd[1]);
	$prizAwrd = $prizAwrd[0];
	$prizAwrdPer = explode('+', $prizAwrd);
	for ($k = 0; $k < count($prizAwrdPer); $k++) {
		$au = getRecord('members', "`id` = '{$prizAwrdPer[$k]}' ");
		$augrade = 0;
		$alltasks = $getRecord -> GET('contest_round_submit', "`iid` = '$iid' AND `uid` = '{$au['id']}' ");
		foreach ($alltasks as $alltasks) $augrade += $alltasks['grade'];
		if ($au) { ?>
		<div class="one-tsk-score aw-per" style="padding:6px 0!important" id="u<? echo $au['id'] ?>">
			<b class="left" style="margin-top:8px"><?echo $k + 1 ?>. </b>
			<? echo '<div class="grade-square right">'.$augrade.'</div>'; ?>
			<? echo '<a href="#!user?u='.$au['id'].'"><img src="'.$au['avatar'].'" class="avatar img-circle"/> '.$au['username'].'</a>' ?>
		</div>
<? 		}
	}
} ?>
		</div>
	</div>
<? } ?>
	</div>
	<div class="hide tab-index mlist">
		<?php include 'views/roundResultList.php' ?>
	</div>
</form>
<script src="<? echo JS ?>/roundResultAward.js"></script>
<?	} else echo '<div class="alerts alert-info">Select one lesson from the left side to start managing scores.</div>';
} ?>

</div>

<script src="<? echo JS ?>/roundResult.js"></script>
