<?php $qList = $getRecord -> GET($typ, "$condition AND `did` IN ($childDotStr)", '%30', '');
foreach ($qList as $qList) {
/*	if ($qList['did'] == $dot || in_array($qList['did'], $childDot)) {
*/	$tidList = explode(',', $qList['tid']);
	$checkArray = array_intersect($tidList, $followTopic);
	$checkTopic = count($checkArray);
	if ($checkTopic > 0) {
		$totalRates = 0;
		$rates = $getRecord -> GET($ratetb, "`iid` = '{$qList['id']}'", '', '');
		foreach ($rates as $rates) $totalRates = $totalRates + $rates['rate']*100/5;
		$totalRate = countRecord($ratetb, "`iid` = '{$qList['id']}'");
		$likes = countRecord($votetb, "`iid` = '{$qList['id']}' AND `type` = 'like'");
		$dislikes = countRecord($votetb, "`iid` = '{$qList['id']}' AND `type` = 'dislike'");
		$votes = $likes + $dislikes;
		if ($votes != 0) {
			$lper = round($likes/$votes, 3) * 100;
			$dper = round($dislikes/$votes, 3) * 100;
		} else $lper = $dper = 0;
		$voos = $likes - $dislikes;
		$auth = getRecord('members', "`id` = '{$qList['uid']}'");
		$dInfo = getRecord('dot', "`id` = '{$qList['did']}'");
		$avai = $qList['available'];
		$content = $qList['quest'];
		$checkSubmit = countRecord('daily_ex_submit', "`uid` = '$u' AND `iid` = '{$qList['id']}' ");
		$getSubmit = getRecord('daily_ex_submit', "`uid` = '$u' AND `iid` = '{$qList['id']}' ");
		$countSubmits = countRecord('daily_ex_submit', "`iid` = '{$qList['id']}' ");
		$countCorrects = countRecord('daily_ex_submit', "`iid` = '{$qList['id']}' AND `correct` = 'yes' ");
		$qclas = 'warning';
		if ($qList['day'] == $today) $qclas = 'primary' ?>


<div class="row row-lib <?php if ($checkSubmit > 0) echo 'solved'; if ($u == $qList['uid'] /*|| countRecord($startb, "`uid` = '$u' AND `iid` = '{$qList['id']}'") > 0*/ ) echo ' stared'; // if ($u != $qList['uid'] && countRecord($typ.'_cmt', "`uid` = '$u' AND `iid` = '{$qList['id']}'") > 0 ) echo ' joined' ?>">
	<span class="icon dogear"></span>
	<div class="solve-icon"></div>
	<div class="count-star">
		<?php if (countRecord($startb, "`iid` = '{$qList['id']}' AND `uid` = '$u'") > 0 || $qList['uid'] == $u) { ?>
			<a class="iic star star-on" id="add"></a>
			<span class="favoritecount selected"><b><?php echo countRecord($startb, "`iid` = '{$qList['id']}'") ?></b></span>
		<?php } else if ($qList['uid'] != $u) { ?>
			<a class="iic star star-off" id="add"></a>
			<span class="favoritecount off"><b><?php echo countRecord($startb, "`iid` = '{$qList['id']}'") ?></b></span>
		<?php } ?>
	</div>
	<div class="lib-author left">
		<a href="#!user?u=<?php echo $qList['uid'] ?>">
			<img class="lib-author-thumbnai" src="<?php echo $auth['avatar'] ?>" title="<?php echo $auth['username'] ?>"/>
		</a>
		<?php if ($qList['coin'] != 0) echo '<div class="lib-extra-coin" title="Extra coins for solving this problem"><img src="'.silk.'/coins_add.png"/> <b>'.$qList['coin'].'</b></div>';
			else if ($qList['price'] != 0) echo '<div class="lib-extra-coin" title="Price to download this document"><img src="'.silk.'/coins_add.png"/> <b>'.$qList['price'].'</b></div>' ?>
	</div>
	<div class="lib-list-content">
		<a href="<?php echo $link.$qList['id'] ?>">
			<b class="title"><?php echo $qList['title'] ?></b>
			<div class="right">
				<div class="label label-<? echo $qclas ?>"><? echo $qList['day'] ?></div>
			</div>
			<div class="lib-content shorten">
				<?php echo $content ?>
			</div>
		</a>
		<?php if ($typ == 'ex') {
				if ($qList['type'] == 'test') {
					$exChoii = explode('|', $qList['choices']);
					for ($j = 0; $j < count($exChoii); $j++) {
						echo '<label class="radio primary" for="option'.$j.$qList['id'].'"><input type="radio" id="option'.$j.$qList['id'].'" disabled ';
						if ($exChoii[$j] == $qList['result']) echo 'checked ';
						echo 'name="result'.$qList['id'].'"/> '.$exChoii[$j].'</label>';
					}
				} else if ($qList['result']) {
					if ($qList['available'] == 'both' || $member['type'] == $qList['available']) echo '<div class="label label-info" style="position:absolute;margin-top:-15px;right:10px" title="Result">'.$qList['result'].'</div>';
				}
			} ?>
	</div>
	<div class="lib-sta right">
		<div class="lib-sta-view"><i class="fa fa-eye"></i> <?php echo $qList['view'] ?></div>
		<div class="lib-sta-rep"><i class="fa fa-check-square"></i> <?php echo $countCorrects.'/'.$countSubmits ?></div>
		<div class="lib-sta-vote"><i class="fa fa-thumbs-up"></i> <?php echo $voos ?></div>
	</div>
	<div class="item-topic">
		<?php for ($i = 0; $i < count($tidList); $i++) {
				$tInfo = getRecord('topic', "`id` = '{$tidList[$i]}'") ?>
			<a class="item-topic-one border-radius" style="color:<?php echo $dInfo['color'] ?>">
				<div class="dott dot-<?php echo $dInfo['re'] ?>" alt="<?php echo $dInfo['id'] ?>" title="Dot <?php echo $dInfo['title'] ?>"><span class="dot-color" style="background:<?php echo $dInfo['color'] ?>"></span></div>
			<?php echo $tInfo['title'] ?></a>
		<?php } ?>
	</div>
</div>


<? 	}
//	}
} ?>
