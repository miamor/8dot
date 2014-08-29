<?php include 'system/courseAction.php';

$numJoined = countRecord('course_join', "`cid` = '$c'");
$numStar = countRecord('course_star', "`iid` = '$c'");

if ($cInfo['type'] == 'interact') $ticks = $cInfo['limit'];
else $ticks = '+';

/*if ($cInfo['pay'] == 'by-course') $ticksOut = countRecord('ticks', "`type` = 'course' AND `iid` = '$c'");
else {
	
}
$ticksLeft = $ticks - $ticksOut;
*/
$totalRates = 0;
$rates = $getRecord -> GET('course_rate', "`iid` = '$c'", '', '');
foreach ($rates as $rates) {
	$totalRates = $totalRates + $rates['rate']*100/5;
}
$totalRate = countRecord('course_rate', "`iid` = '$c'");

$likes = countRecord('course_vote', "`iid` = '$c' AND `type` = 'like'");
$dislikes = countRecord('course_vote', "`iid` = '$c' AND `type` = 'dislike'");

$aCount = countRecord('announcement', "`cid` = '$c' ");
$lCount = countRecord('lesson', "`cid` = '$c' ");
$examCount = countRecord('course_test', "`cid` = '$c' ");
$lGCount = countRecord('task_submit', "`cid` = '$c' AND `grade` != 0");
$lUCount = countRecord('task_submit', "`cid` = '$c' AND `grade` = 0");
$tGCount = countRecord('test_submit', "`cid` = '$c' AND `grade` != 0");
$tUCount = countRecord('test_submit', "`cid` = '$c' AND `grade` = 0");
$gCount = $lGCount + $tGCount;
$uCount = $lGCount + $tUCount;
$disCount = countRecord('course_discuss', "`cid` = '$c' ");

$votes = $likes + $dislikes;
if ($votes != 0) {
	$lper = round($likes/$votes, 3) * 100;
	$dper = round($dislikes/$votes, 3) * 100;
} else $lper = $dper = 0;

if ($cInfo['available'] != 'both') $avaii = ' '.$cInfo['available'];
else $avaii = '';
if ($cInfo['privacy'] == 'public') $cpub = '<span class="label label-primary" title="Public course"><span class="fa fa-globe"></span>';
else if ($cInfo['privacy'] == 'link') $cpub = '<span class="label label-warning" title="Only who gets link can access this course."><span class="fa fa-link"></span>';
else if ($cInfo['privacy'] == 'trash') $cpub = '<span class="label label-danger" title="This course is in draff. You\'re the only person can see and access this."><span class="fa fa-trash-o"></span>';
else if ($cInfo['privacy'] == 'exclude') $cpub = '<span class="label label-default sb-open" id="custom" title="Custom: Public to everyone excludes..."><span class="fa fa-cog"></span>';
else if ($cInfo['privacy'] == 'include') $cpub = '<span class="label label-default sb-open" id="custom" title="Custom: Public to only these people..."><span class="fa fa-cog"></span>';
$cpub = $cpub.$avaii.'</span>';
if ($cInfo['privacy'] == 'exclude' || $cInfo['privacy'] == 'include') {
	echo '<div class="hide small-board-fixed"></div><div class="hide small-board sb-custom">
		<h3>';
	if ($cInfo['privacy'] == 'exclude') echo 'Public to everyone excludes:';
	else if ($cInfo['privacy'] == 'include') echo 'Public to only these people:';
	echo '</h3>';
	$peList = explode('|', $cInfo['people_list']);
	for ($j = 0; $j < count($peList); $j++) {
		$us = getRecord('members', "`id` = '{$peList[$j]}' ");
		echo '<div class="one-people"><a href="#!user?u='.$us['id'].'">'.$us['username'].'</a> <span class="right gensmall">'.$us['type'].'</span></div>';
	}
	echo '</div>';
} ?>

<div class="c-info-right the-box">
	<div class="all-thumbnais">
		<img class="active-thumbnai" src="<?php echo $cInfo['thumbnai'] ?>"/>
		<div class="thumbs">
			<div class="thumbs-img">
				<img class="small-thumbs selected" src="<?php echo $cInfo['thumbnai'] ?>"/>
	<?php if ($cInfo['thumbs']) {
			$thumbs = explode('|', $cInfo['thumbs']);
			for ($j = 0; $j < count($thumbs); $j++)
				echo '<img class="small-thumbs" src="'.$thumbs[$j].'"/>';
		}	?>
			</div>
			<div class="play" align="center" valign="bottom">
			</div>
		</div>
	</div>

<ul class="c-info-tab">
	<li class="c-info-one-tab announcement">
		<a href="<?php echo "#!course?c=$c&t=announcement" ?>" title="Announcements">
			<span class="fa fa-file-text"></span> <span class="text">Announcements</span>
			<?php if ($aCount > 0) echo '<span class="badge badge-info">'.$aCount.'</span>' ?>
		</a>
	</li>
	<li class="c-info-one-tab home"><a href="<?php echo "#!course?c=$c" ?>" title="Course info"><span class="fa fa-home"></span> <span class="text">Info</span></a></li>
	<li class="c-info-one-tab learning">
		<a href="<?php echo "#!course?c=$c&t=learning" ?>" title="Start learning">
			<span class="fa fa-book"></span> <span class="text">Lessons</span>
			<?php if ($lCount > 0) echo '<span class="badge badge-primary">'.$lCount.'</span>' ?>
		</a>
	</li>
	<li class="c-info-one-tab exam">
		<a href="<?php echo "#!course?c=$c&t=exam" ?>" title="Take exams">
			<span class="fa fa-columns"></span> <span class="text">Lessons</span>
			<?php if ($examCount > 0) echo '<span class="badge badge-danger">'.$examCount.'</span>' ?>
		</a>
	</li>
	<li class="c-info-one-tab score">
		<a href="<?php echo "#!course?c=$c&t=score" ?>" title="Scoreboard">
			<span class="fa fa-list-alt"></span> <span class="text">Scoreboard</span>
			<?php if ($gCount > 0) echo '<span class="badge badge-success">'.$gCount.'</span>' ?>
		</a>
	</li>
	<li class="c-info-one-tab discuss">
		<a href="<?php echo "#!course?c=$c&t=discuss" ?>" title="Requests and Discussions">
			<span class="fa fa-mail-forward"></span> <span class="text">Requests & Discussions</span>
			<?php if ($disCount > 0) echo '<span class="badge badge-warning">'.$disCount.'</span>' ?>
		</a>
	</li>
<!--	<li class="c-info-one-tab statistics"><a href="<?php echo "#!course?c=$c&t=statistics" ?>" title="Statistics"><span class="fa fa-tasks"></span> <span class="text">Statistics</span></a></li> -->
</ul>

<div class="c-info-author">
	<img src="<?php echo $cAuth['avatar'] ?>" class="left thumbnai"/>
	<a href="#!user?u=<?php echo $cAuth['id'] ?>"> <h4 class="left"><?php echo $cAuth['username'] ?></h4></a>

	<div class="item-bar vote-bar left" title="<?php // echo $votes; if ($votes <= 1) echo ' vote'; else echo ' votes' ?>">
		<div class="vote-bar-like" title="<?php echo $likes; if ($likes <= 1) echo ' like'; else echo ' likes' ?>" style="width:<?php echo $lper.'%' ?>"></div>
		<div class="vote-bar-dislike" title="<?php echo $dislikes; if ($dislikes <= 1) echo ' dislike'; else echo ' dislikes' ?>" style="width:<?php echo $dper.'%' ?>"></div>
	</div>

	<div class="star-info right" data-course="<?php echo $c ?>">
		<div title="<?php echo $totalRate ?> votes <?php if ($totalRate != 0) echo '- '.round($totalRates/$totalRate, 2).'%' ?>" class="rating-icons <?php if ($cInfo['uid'] == $u) echo 'myrate'; else if (!$u || countRecord('course_rate', "`uid` = '$u' AND `iid` = '$c'") > 0) echo 'rated' ?>" style="float:left;">
		<?php for ($j = 1; $j <= 5; $j++) { ?>
			<div class="rating-star-icon v<?php echo $j ?>" id="v<?php echo $j ?>">&nbsp;</div>
		<?php } ?>
			<div class="rate-count" style="width:<?php if ($totalRate == 0) echo '0'; else echo round($totalRates/$totalRate, 2) ?>%"></div>
		</div>
	</div>

	<div id="it-vote" class="<?php if (countRecord('course_vote', "`uid` = '$u' AND `iid` = '$c'") > 0) echo 'voted' ?>">
		<div class="button-remark ld-button dislike right minibutton-hover <?php if (countRecord('course_vote', "`uid` = '$u' AND `iid` = '$c' AND `type` = 'dislike'") > 0) echo 'vote-voted disliked' ?>" id="dislike"><div class="u-icon-dislike"></div></div>
		<div class="button-remark ld-button like right minibutton-hover <?php if (countRecord('course_vote', "`uid` = '$u' AND `iid` = '$c' AND `type` = 'like'") > 0) echo 'vote-voted liked' ?>" id="like"><div class="u-icon-like left"></div> Like</div>
	</div>
</div>
	
	<ul class="stats">
<!--		<li><a><strong><?php echo countRecord('course_join', "`cid` = '$c' AND `utype` = 'student'") ?></strong> students</a></li>
		<li><a><strong><?php echo countRecord('course_join', "`cid` = '$c' AND `utype` = 'teacher'") ?></strong> watching</a></li> -->
		<li><a class="sb-open" id="star-list"><strong><?php echo countRecord('course_star', "`iid` = '$c'") ?></strong> stared</a></li>
		<li><a class="sb-open" id="join-list"><strong><?php echo countRecord('course_join', "`cid` = '$c'") ?></strong> joined</a></li>
		<li <?php if ($ticks == '+') echo 'title="This is a normal course. Therefore, ticks are unlimited."' ?>><a><strong><?php echo $ticks ?></strong> ticks <?php if ($ticks != '+')  echo '/lesson' ?></a></li>
	</ul>
	
	<div class="hide small-board-fixed"></div>
	<div class="hide small-board sb-star-list">
		<h3><?php echo count($starList) ?> following people stared this course</h3>
<?php foreach ($starList as $starList) {
		$us = getRecord('members', "`id` = '{$starList['uid']}' ");
		echo '<div class="one-people"><a href="#!user?u='.$us['id'].'">'.$us['username'].'</a> <span class="right gensmall">'.$us['type'].'</span></div>';
	} ?>
	</div>
	
	<div class="hide small-board-fixed"></div>
	<div class="hide small-board sb-join-list">
		<h3><?php echo count($joinList) ?> following people joined this course</h3>
<?php foreach ($joinList as $joinList) {
		$us = getRecord('members', "`id` = '{$joinList['uid']}' ");
		echo '<div class="one-people"><a href="#!user?u='.$us['id'].'">'.$us['username'].'</a> <span class="right gensmall">'.$us['type'].'</span></div>';
	} ?>
	</div>
	
	<div class="c-info-actions <?php if ($u == $cInfo['uid']) echo 'star-only'?>"><span>
	<div class="left cprivacy" style="margin-top:1px"><?php echo $cpub ?></div>
<div class="join-star"><?php if ($u != $cInfo['uid']) {
	echo '<div class="right minibutton button-remark button-remark-join" style="margin:0 0 0 30px">';
	if (countRecord('course_join', "`cid` = '$c' AND `uid` = '$u'") <= 0) echo 'Join';
	else echo 'Unjoin';
	echo '</div><style>.button-remark-join:before{content:"'.$numJoined.'"}</style>';
}	
	echo '<div class="right minibutton button-remark button-remark-star" style="margin:0 0 0 50px">';
	if (countRecord('course_star', "`iid` = '$c' AND `uid` = '$u'") <= 0) echo 'Star';
	else echo 'Unstar';
	echo '</div><style>.button-remark-star:before{content:"'.$numStar.'"}</style>';
 ?>
</div>
<? if ($u != $cInfo['uid']) {
	if (countRecord('course_join', "`cid` = '$c' AND `uid` = '$u'") <= 0) echo '<div class="right fui-check minibutton button-remark button-remark-tickets disabled" title="You must join this course to get ticks">Get ticks</div>';
	else {
		if ($cInfo['available'] == 'both' || $cInfo['available'] == $member['type']) {
			if ($cInfo['pay'] == 'by-course') {
				if ($cInfo['type'] == 'interact') echo '<div class="price round small" title="Normal price: <b>'.$cInfo['price_normal'].'</b> for whole course"><div>'.$cInfo['price_normal'].'</div></div>';
				echo '<div class="price round" title="Advanced price: <b>'.$cInfo['price'].'</b> for whole course"><div>'.$cInfo['price'].'</div></div>';
				echo '<div class="right fui-check minibutton button-remark button-remark-tickets" alt="tick-course" title="One tick for whold course. Get ticks now!">Get ticks</div>';
			} else {
				if ($cInfo['type'] == 'interact') {
					if ($cInfo['price-normal-type'] == 'one-price') echo '<div class="price round small" title="Normal price: <b>'.$cInfo['price_normal'].'</b> for whole course"><div>'.$cInfo['price_normal'].'</div></div>';
				}
				if ($cInfo['price-type'] == 'one-price') echo '<div class="price round" title="'.$cInfo['price'].' per lesson"><div>'.$cInfo['price'].'</div></div>';
				echo '<div class="right fui-check minibutton button-remark button-remark-tickets" alt="tick-lesson">Get ticks</div>';
			}
		}
	}
} ?>

</span></div>

<?php if ($cInfo['type'] == 'interact') { ?>
	<div class="course-schedule">
		<div class="right notice-schedule" style="margin-top:3px">
			<label class="checkbox">
				<input type="checkbox" <?php if (countRecord('mark_notice', "`type` = 'course' AND `uid` = '$u' AND `iid` = '$c' ") > 0) echo 'checked'; if ($u != $cInfo['uid'] && countRecord('course_join', "`uid` = '$u' AND `cid` = '$c' ") <= 0) echo ' disabled' ?> name="notice" id="notice-input"/> Notice me
			</label>
		</div>
		<h3>Schedule</h3>
		<div class="schedule-list">
<?php $cTime = explode('|', $cInfo['lesson_time']);
	for ($j = 0; $j < count($cTime); $j++) {
		$cTimm = explode('-', $cTime[$j]) ?>
		<div class="one-day-time">
			<span class="right"><?php echo $cTimm[1] ?></span>
			<?php echo $cTimm[0] ?>
		</div>
<?php } ?>
		</div>
	</div>
<?php } ?>

<?php if ($cInfo['available'] != 'both') echo '<div class="note alerts alert-info">This course is only available for <b>'.$cInfo['available'].'</b>.</div>';
if ($u == $cInfo['uid']) echo '<div class="note alerts alert-info">You are the course creator. Try manage links from the left side.</div>' ?>

</div>


<?php if ($u == $cInfo['uid']) { ?>
<li class="manage-courses non-show">
	<a><i class="fa fa-cog icon-sidebar"></i> Manage a course</a>
	<ul class="submenu manage-course-list non-show">
		<li class="manage-course-edit"><a>Edit course</a></li>
		<li class="manage-course-ticks"><a>Tickets</a></li>
		<li class="manage-course-lesson"><a>Lesson</a>
			<ul class="submenu"><li><a class="create-new-lesson">New lesson</a></li>
		<?php if ($l) { ?>
				<li><a class="edit-lesson">Edit specified</a></li>
		<?php } ?>
			</ul>
		</li>
		<li class="manage-course-announcement"><a>Announcement</a>
			<ul class="submenu"><li><a class="create-new-announcement">New announcement</a></li>
				<li>Edit specified</li></ul>
		</li>
		<li class="manage-course-score"><a>Score</a></li>
	</ul>
</li>
<?php } ?>

<script src="<?php echo JS ?>/courseView.js" type="text/javascript"></script>
<script src="<?php echo JS ?>/rate.js" type="text/javascript"></script>
