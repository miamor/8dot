<? $checkJoin = countRecord('contest_join', "`iid` = '$iid' AND `uid` = '$u' ");
if ($_GET['do'] == 'join') {
	if ($checkJoin <= 0) {
		mysql_query("INSERT INTO `contest_join` (`iid`, `uid`, `time`) VALUES ('$iid', '$u', '$current')");
		if ($cInfo['join'] == 'everyone') changeValue('contest_join', "`uid` = '$u' AND `iid` = '$iid' ", "`approve` = 'yes' ");
	} else mysql_query("DELETE FROM `contest_join` WHERE `iid` = '$iid' AND `uid` = '$u' ");
}
if ($_GET['do'] == 'noticeme') {
	if (countRecord('mark_notice', "`uid` = '$u' AND `type` = 'contest' AND `iid` = '$iid' ") <= 0) mysql_query("INSERT INTO `mark_notice` (`uid`, `type`, `iid`) VALUES ('$u', 'contest', '$iid')");
	else mysql_query("DELETE FROM `mark_notice` WHERE `uid` = '$u' AND `type` = 'contest' AND `iid` = '$iid' ");
} ?>

<!--<a class="right create-application-form minibutton button-remark-generate">Generate application form</a>-->

<div class="c-info-right the-box">
	<div class="all-thumbnais">
		<img class="active-thumbnai" src="<?php echo $cInfo['thumbnai'] ?>"/>
	</div>

	<ul class="c-info-tab">
		<div class="e-actions">
			<? if ($cInfo['uid'] != $u) {
				if ($checkJoin > 0) echo '<a class="right minibutton join-event button-remark-join" style="margin-top:10px">Unjoin</a>';
				else echo '<a class="right minibutton join-event button-remark-join" style="margin-top:10px">Join</a>';
			} ?>
		</div>
<!--		<li class="c-info-one-tab announcement">
			<a href="<?php echo "#!event?i=$iid&t=feeds" ?>" title="Feeds">
				<span class="fa fa-file-text"></span> <span class="text">Feeds</span>
				<?php if ($aCount > 0) echo '<span class="badge badge-info">'.$aCount.'</span>' ?>
			</a>
		</li>
-->		<li class="c-info-one-tab home"><a href="<?php echo "#!event?i=$iid" ?>" title="Info"><span class="fa fa-home"></span> <span class="text">Info</span></a></li>
		<li class="c-info-one-tab result">
			<a href="<?php echo "#!event?i=$iid&t=members" ?>" title="Members">
				<span class="fa fa-users"></span> <span class="text">Members</span>
			</a>
		</li>
		<li class="c-info-one-tab result">
			<a href="<?php echo "#!event?i=$iid&t=result" ?>" title="Round result">
				<span class="fa fa-list-alt"></span> <span class="text">Result</span>
			</a>
		</li>
		<li class="c-info-one-tab prize">
			<a href="<?php echo "#!event?i=$iid&t=prize" ?>" title="Prize">
				<span class="fa fa-bookmark"></span> <span class="text">Prize</span>
			</a>
		</li>
	</ul>


	<div class="c-info-author c-event">
		<a href="#!user?u=<?php echo $cAuth['id'] ?>">
			<img class="contest-host-icon" src="<?php echo silk ?>/information.png"/>
			<img src="<?php echo $cAuth['avatar'] ?>" class="left thumbnai"/>
			<img class="contest-join-icon" src="<?php echo silk ?>/accept.png"/>
		</a>
		<div class="clearfix"></div>
	</div>

	<ul class="stats">
		<li><a class="sb-open" id="star-list"><strong><?php echo countRecord('contest_join', "`iid` = '$iid' ") ?></strong> registered</a></li>
		<li><a class="sb-open" id="join-list"><strong><?php echo countRecord('contest_join', "`iid` = '$iid' AND `approve` = 'yes' ") ?></strong> candidates</a></li>
	</ul>

	<div class="c-info-cal" style="padding-top:6px">
<? for ($j = 1; $j <= $cInfo['rounds']; $j++) {
		$rTime = explode($j.'>', $cInfo['start_rounds']);
		$rTime = $rTime[1];
		$rTimeSplit = explode('-', $rTime);
		$rDay = (int)$rTimeSplit[0];			$rMonth = (int)$rTimeSplit[1];			$rYear = (int)$rTimeSplit[2];
		$rTimeClas = '';
		if (countRecord('contest_round', "`iid` = '$iid' AND `rid` = '$j' AND `result_public` = 'yes' ") > 0) $rTimeClas = 'active';
		else if (countRecord('contest_round', "`iid` = '$iid' AND `rid` = '$j' ") <= 0) {
			if ($rYear < $todayY) $rTimeClas = 'over';
			else if ($rYear == $todayY) {
				if ($rMonth < $todaym) $rTimeClas = 'over';
				else if ($rMonth == $todaym) {
					if ($rDay < $todayd) $rTimeClas = 'over';
//					else if ($rDay = $todayd) $rTimeClas = 'active';
				}
			}
		}
		if ($j == $r) $rTimeClas = 'current';
		if ($rTime) echo '<a class="date-square '.$rTimeClas.'" href="#!event?i='.$iid.'&r='.$j.'">
			<div class="date-square-month">'.jdmonthname(gregoriantojd($rMonth, $rDay, $rYear), 0).'</div>
			<div class="date-square-day">'.$rDay.'</div>
		</a> ';
		else echo '<a class="date-square" href="#!event?i='.$iid.'&r='.$j.'" title="No time is set yet"></a> ';
	} ?>
		<div class="clearfix"></div>
	</div>

	<div class="course-schedule">
		<div class="right notice-schedule" style="margin-top:3px">
			<label class="checkbox">
				<input type="checkbox" <?php if (countRecord('mark_notice', "`type` = 'contest' AND `uid` = '$u' AND `iid` = '$iid' ") > 0) echo 'checked'; if ($u != $cInfo['uid'] && countRecord('contest_join', "`uid` = '$u' AND `iid` = '$iid' ") <= 0) echo ' disabled' ?> name="notice" id="notice-input"/> Notice me
			</label>
		</div>
	</div>
</div>

<script src="<? echo JS ?>/eventView.js"></script>
