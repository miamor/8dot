<div class="alerts alert-classic">Follow more tops to get more course!</div>

<div class="all-item-lists">
<div id="isotope-wrap" class="isotope super-list variable-sizes item-list clearfix container-masonry">
<?php $itemList = $getRecord -> GET('course', "", '%30', '');
foreach ($itemList as $itemList) {
	if ($itemList['did'] == $dot || in_array($itemList['did'], $childDot)) {
		$tidList = explode(',', $itemList['tid']);
		$checkArray = array_intersect($tidList, $followTopic);
		$checkTopic = count($checkArray);
//		print_r($followTopic);
//		print_r($tidList);
		if ($checkTopic > 0) {
		$peList = explode('|', $itemList['people_list']);
		if ( $itemList['uid'] == $u || $itemList['privacy'] == 'public' || /* ($itemList['privacy'] == 'trash' && $itemList['uid'] == $u) || */
			($itemList['privacy'] == 'exclude' && !in_array($u, $peList)) || 
			($itemList['privacy'] == 'include' && in_array($u, $peList)) ) {
		$totalRates = 0;
		$rates = $getRecord -> GET('course_rate', "`iid` = '{$itemList['id']}'", '', '');
		foreach ($rates as $rates) $totalRates = $totalRates + $rates['rate']*100/5;
		$totalRate = countRecord('course_rate', "`iid` = '{$itemList['id']}'");
	//	$likes = $itemList['likes'];
	//	$dislikes = $itemList['dislikes'];
		$likes = countRecord('course_vote', "`iid` = '{$itemList['id']}' AND `type` = 'like'");
		$dislikes = countRecord('course_vote', "`iid` = '{$itemList['id']}' AND `type` = 'dislike'");
		$votes = $likes + $dislikes;
		if ($votes != 0) {
			$lper = round($likes/$votes, 3) * 100;
			$dper = round($dislikes/$votes, 3) * 100;
		} else $lper = $dper = 0;
		$auth = getRecord('members', "`id` = '{$itemList['uid']}'");
		$dInfo = getRecord('dot', "`id` = '{$itemList['did']}'");
		$joinNum = countRecord('course_join', "`cid` = '{$itemList['id']}'");
		$starNum = countRecord('course_star', "`iid` = '{$itemList['id']}'");
		$checkJoin = countRecord('course_join', "`cid` = '{$itemList['id']}' AND `uid` = '$u'");
		$checkStar = countRecord('course_star', "`iid` = '{$itemList['id']}' AND `uid` = '$u'");
		if ($itemList['available'] != 'both') $avaii = $itemList['available'];
		else $avaii = '';
		if ($itemList['privacy'] == 'public') $cpub = '<span class="label label-primary" title="Public course"><span class="fa fa-globe"></span> ';
		else if ($itemList['privacy'] == 'link') $cpub = '<span class="label label-warning" title="Only who gets link can access this course."><span class="fa fa-link"></span> ';
		else if ($itemList['privacy'] == 'trash') $cpub = '<span class="label label-danger" title="This course is in draff. You\'re the only person can see and access this."><span class="fa fa-trash-o"></span> ';
		else if ($itemList['privacy'] == 'exclude') $cpub = '<span class="label label-default" title="Custom: Public to everyone excludes..."><span class="fa fa-cog"></span> ';
		else if ($itemList['privacy'] == 'include') $cpub = '<span class="label label-default" title="Custom: Public to these people..."><span class="fa fa-cog"></span> ';
		$cpub = $cpub.$avaii.'</span>' ?>
<div class="element-item item-masonry the-box one-item<?php if ($checkJoin > 0) echo ' joined'; if ($checkStar > 0) echo ' stared'; if ($joinNum >= 2) echo ' width2'; if ($starNum >= 2) echo ' height2' ?>">
	<?php if ($itemList['type'] == 'interact') echo '<span class="sub advance-course" title="Advanced course"><span class="text">Ad</span></span>' ?>
	<span class="icon dogear"></span>
	<div class="item-info-top">
		<div class="item-author left">
			<a href="#!user?u=<?php echo $itemList['uid'] ?>">
				<img class="item-author-thumbnai" src="<?php echo $auth['avatar'] ?>" title="<?php echo $auth['username'] ?>"/>
			</a>
		</div>
		<div class="title">
			<div class="dott dot-<?php echo $dInfo['re'] ?>" alt="<?php echo $dInfo['id'] ?>" title="Dot <?php echo $dInfo['title'] ?>"><span class="dot-color" style="background:<?php echo $dInfo['color'] ?>"></span></div>
			<a style="color:<?php echo $dInfo['color'] ?>" href="#!course?c=<?php echo $itemList['id'] ?>"><?php echo $itemList['title'] ?></a>
		</div>
	</div>
<?php if ($itemList['price-type'] == 'one-price') {
	if ($itemList['price'] != 0) {
		if ($itemList['pay'] == 'by-course') echo '<div class="label label-success label-price" title="'.$itemList['price'].' whole course">'.$itemList['price'].'</div>';
		else echo '<div class="label label-info label-price" title="'.$itemList['price'].' per lesson">'.$itemList['price'].'</div>';
	} else echo '<div class="label label-primary free label-price" title="Free">Free</div>';
} else echo '<div class="label label-default label-price" title="Depend on each lesson"><i class="fa fa-money"></i></div>'; ?>
	<div class="item-thumbnai">
		<a href="#!course?c=<?php echo $itemList['id'] ?>"><div class="thumbnai" style="background-image:url(<?php echo $itemList['thumbnai'] ?>)"></div></a>
	</div>
	<div class="item-privacy">
		<?php echo $cpub ?>
	</div>
	<div class="item-info">
		<div class="item-sta">
			<div class="rate right">
				<div title="<?php echo $totalRate ?> votes <?php if ($totalRate != 0) echo '- '.round($totalRates/$totalRate, 2).'%' ?>" class="rating-icons <?php if ($itemList['uid'] == $u) echo 'myrate'; else echo 'rated' ?>">
					<?php for ($j = 1; $j <= 5; $j++) { ?>
						<div class="rating-star-icon v<?php echo $j ?>" id="v<?php echo $j ?>">&nbsp;</div>
					<?php } ?>
						<div class="rate-count" style="width:<?php if ($totalRate == 0) echo '0'; else echo round($totalRates/$totalRate, 2) ?>%"></div>
				</div>
			</div>
			<span class="fui-heart" title="Stars"> <?php echo $starNum ?></span>
			<span class="fui-check-inverted" title="Joined"> <?php echo $joinNum ?></span>
			<span class="fui-new" title="Lessons"> <?php echo countRecord('lesson', "`cid` = '{$itemList['id']}'") ?></span>
		</div>
		<div class="item-topic">
		<?php if ($itemList['tid']) {
				for ($i = 0; $i < count($tidList); $i++) {
					$tInfo = getRecord('topic', "`id` = '{$tidList[$i]}'") ?>
				<a class="item-topic-one">
<!--					<div class="dott dot-<?php echo $dInfo['re'] ?>" alt="<?php echo $dInfo['id'] ?>" title="Dot <?php echo $dInfo['title'] ?>"><span class="dot-color" style="background:<?php echo $dInfo['color'] ?>"></span></div> -->
				<?php echo $tInfo['title'] ?></a>
		<?php 	}
			} ?>
		</div>
	</div>
</div>
<?php	 }
	}
}
} ?>
</div>
</div>


<script src="<?php echo PLUGINS ?>/isotope/isotope.pkgd.js"></script>
<script>$('#isotope-wrap').html('Loading...').load(MAIN_URL + '/pages/course.php #isotope-wrap > div', function () {
	isoo()
});</script>
<style>#content{padding-right:0}</style>
