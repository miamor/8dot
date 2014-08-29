<?php $myJoinList = $getRecord -> GET($tbll, "`uid` = '$u'");
if ($myJoinList) {
	foreach ($myJoinList as $myJoinList) {
		$ci = $myJoinList[$roww];
		$myList = getRecord ('course', "`id` = '$ci'");
		if ($myList['uid'] != $u) {
		$lik = countRecord('course_vote', "`type` = 'like' AND `iid` = '{$myList['id']}'");
		$dislik = countRecord('course_vote', "`type` = 'dislike' AND `iid` = '{$myList['id']}'");
		$vott = $lik - $dislik;
		$totalRates = 0;
		$rates = $getRecord -> GET('course_rate', "`iid` = '{$myList['id']}'", '', '');
		foreach ($rates as $rates) $totalRates = $totalRates + $rates['rate'];
		$totalRate = countRecord('course_rate', "`iid` = '{$myList['id']}'");
		if ($totalRate != 0) $avarageRate = round($totalRates/$totalRate, 2);
		else $avarageRate = 0; ?>
		<div class="one-course">
			<div class="action-course right">
				<div class="act-edit"><i class="fa fa-edit"></i></div>
				<div class="act-delete"><i class="fa fa-times-circle"></i></div>
				<div class="act-trash"><i class="fa fa-trash-o"></i></div>
			</div>
			<div class="sta-course right">
				<div class="sta-view"><i class="fa fa-eye"></i> <span class="text"><?php echo $myList['view'] ?></span></div>
				<div class="sta-join"><i class="fa fa-sign-in"></i> <span class="text"><?php echo countRecord('course_join', "`cid` = '{$myList['id']}'") ?></span></div>
				<div class="sta-vote"><i class="fa fa-thumbs-up"></i> <span class="text"><?php echo $vott ?></span></div>
				<div class="sta-rate"><i class="fa fa-star"></i> <span class="text"><?php echo $avarageRate ?></span></div>
			</div>
			<div class="right price-course"><?php if ($myList['price-type'] == 'one-price') echo $myList['price']; else echo '/' ?></div>
			<span class="right advance-course" style="margin-right:10px"><?php if ($myList['type'] == 'interact') echo '<i class="fa fa-flash" title="Advanced course"></i>' ?></span>
			<a href="#!course?c=<?php echo $myList['id'] ?>"><?php echo $myList['title'] ?></a>
		</div>
<?php }
}
} else echo '<div class="one-course">Nothing found in your storage.</div>' ?>
