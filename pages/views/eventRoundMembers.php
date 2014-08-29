<? if ($_GET['do'] == 'approve') {
//	if (!$r || $r == 1) {
		if (!in_array($uid, $r1mem)) array_push($r1mem, $uid);
		else {
			if (($key = array_search($u, $r1mem)) !== false) unset($r1mem[$key]);
		}
		$r1memStr = implode('|', $r1mem);
		changeValue('contest_members', "`iid` = '$iid' AND `rid` = 1", "`members` = '$r1memStr' ");
//	}
} ?>

<div class="alerts alert-info">
<? if ($cInfo['join'] == 'everyone') echo 'This contest is open for everyone.';
else if ($cInfo['join'] == 'approve') echo 'This contest is open for everyone but needs approve.';
if ($cInfo['join'] == 'host-invite') echo 'This contest is open for only who invited by host.'; ?>
</div>

<? if ($cInfo['uid'] == $u) echo '<div class="alerts alert-info">Edit round 1/Starting members for whole event members.<br/>
Starting from round 2, you must result attenders and publish result in <a>result page</a>.<br/></div>' ?>

<!-- 
<div class="tsk-score-lesson-list tsk-score-round-list <? if (countRecord('contest_round_submit', "`iid` = '$iid' AND `rid` = '$r' AND `uid` = '$uid' ") > 0) echo 'score-view' ?>">
	<?php include 'views/roundMembersRoundList.php' ?>
</div>
-->

<!-- <div class="score-board result-board"> -->

<div class="the-box tsk-score-list" id="m_tab">
	<div class="m_tab">
		<div class="right search-user">
			<select placeholder="Search an username" class="chosen-select">
		<?php $gOptions = $getRecord -> GET('contest_join', "`iid` = '$iid' ");
			foreach ($gOptions as $gOptions) {
				$gUser = getRecord('members', "`id` = '{$gOptions['uid']}' ");
				echo '<option value="'.$gOptions['uid'].'">'.$gUser['username'].'</option>';
			} ?>
			</select>
		</div>
		<li class="tab active" id="candidates">
<!--			<? if (!$r || $r == 1) echo 'Event participants';
			else echo 'Round '.$r.' memberlist' ?> -->
			Event candidates
		</li>
<? if ($cInfo['join'] == 'approve') { ?>
		<li class="tab" id="unapprove">Unapprove</li>
		<li class="tab" id="disapprove">Disapproved</li>
<? } ?>
	</div>

<? if ($cInfo['join'] == 'approve') { ?>
	<div class="tab-index unapprove">
<? 	$evne = $getRecord -> GET('contest_join', "`iid` = '$iid' AND `approve` != 'yes' AND `approve` != 'no' ");
	foreach ($evne as $evne) {
		$uinn = getRecord('members', "`id` = '{$evne['uid']}' ") ?>
			<div class="one-tsk-score rows one-can" id="u<? echo $uinn['id'] ?>">
				<a href="#!event?i=<? echo $iid ?>&t=members&u=<? echo $uinn['id'] ?>">
					<img src="<? echo $uinn['avatar'] ?>" class="avatar img-circle"/>
					<? echo $uinn['username'] ?>
				</a>
				<div class="right action-mem">
			<? if (countRecord('contest_join', "`iid` = '$iid' AND `uid` = '{$uinn['id']}' AND `approve` = 'yes' AND `approve` != 'no' ") <= 0) echo '<div class="approve-mem" data-href="?i='.$iid.'&u='.$uinn['id'].'"><span class="fa fa-check"></span> Approve</div>';
			else echo '<div class="approve-mem approved" data-href="?i='.$iid.'&u='.$uinn['id'].'"><span class="fa fa-check"></span> <span class="fa fa-times"></span> Disapprove</div>'; ?>
				</div>
			</div>
<? 	} ?>
	</div>

	<div class="tab-index disapprove">
<? 	$evnem = $getRecord -> GET('contest_join', "`iid` = '$iid' AND `approve` = 'no' ");
	foreach ($evnem as $evnem) {
		$uinn = getRecord('members', "`id` = '{$evnem['uid']}' ") ?>
			<div class="one-tsk-score rows one-can" id="u<? echo $uinn['id'] ?>">
				<a href="#!event?i=<? echo $iid ?>&t=members&u=<? echo $uinn['id'] ?>">
					<img src="<? echo $uinn['avatar'] ?>" class="avatar img-circle"/>
					<? echo $uinn['username'] ?>
				</a>
				<div class="right action-mem">
			<? if (countRecord('contest_join', "`iid` = '$iid' AND `uid` = '{$uinn['id']}' AND `approve` = 'yes' AND `approve` != 'no' ") <= 0) echo '<div class="approve-mem" data-href="?i='.$iid.'&u='.$uinn['id'].'"><span class="fa fa-check"></span> Approve</div>';
			else echo '<div class="approve-mem approved" data-href="?i='.$iid.'&u='.$uinn['id'].'"><span class="fa fa-check"></span> <span class="fa fa-times"></span> Disapprove</div>'; ?>
				</div>
			</div>
<? 	} ?>
	</div>
<? } ?>

	<div class="tab-index candidates">
<? // if (!$r || $r == 1) {
	$evme = $getRecord -> GET('contest_join', "`iid` = '$iid' AND `approve` = 'yes' ");
	foreach ($evme as $evme) {
		$uinn = getRecord('members', "`id` = '{$evme['uid']}' ") ?>
			<div class="one-tsk-score rows one-can" id="u<? echo $uinn['id'] ?>">
				<a href="#!event?i=<? echo $iid ?>&t=members&u=<? echo $uinn['id'] ?>">
					<img src="<? echo $uinn['avatar'] ?>" class="avatar img-circle"/>
					<? echo $uinn['username'] ?>
				</a>
				<div class="right action-mem">
			<? if (countRecord('contest_join', "`iid` = '$iid' AND `uid` = '{$uinn['id']}' AND `approve` = 'yes' ") <= 0) echo '<div class="approve-mem" data-href="?i='.$iid.'&u='.$uinn['id'].'"><span class="fa fa-check"></span> Approve</div>';
			else echo '<div class="approve-mem approved" data-href="?i='.$iid.'&u='.$uinn['id'].'"><span class="fa fa-check"></span> <span class="fa fa-times"></span> Disapprove</div>'; ?>
				</div>
			</div>
<? 	}
/* } else {
	$prevR = $r - 1;
	$evme = $getRecord -> GET('contest_round_submit', "`iid` = '$iid' AND `rid` = '$prevR' AND `pass` = 'yes' ", '', "`grade` DESC");
	foreach ($evme as $evme) {
		$uinn = getRecord('members', "`id` = '{$evme['uid']}' ") ?>
			<div class="one-tsk-score rows one-can" id="u<? echo $uinn['id'] ?>">
				<? echo '<div class="grade-square right">'.$evme['grade'].'</div>' ?>
				<a href="#!user?u=<? echo $uinn['id'] ?>">
					<img src="<? echo $uinn['avatar'] ?>" class="avatar img-circle"/>
					<? echo $uinn['username'] ?>
				</a>
			</div>
<? 	}
} */ ?>
	</div>
</div>

<!-- </div> -->

<script src="<? echo JS ?>/roundMembers.js"></script>
