<div class="alerts alert-classic">Follow more tops to get more games!</div>

<div class="all-item-lists">
<div id="isotope-wrap" class="isotope super-list variable-sizes item-list clearfix container-masonry">
<? $itemList = $getRecord -> GET('game', "`type` != 'contribute' ", '%30', '');
foreach ($itemList as $itemList) {
		$totalRates = 0;
		$rates = $getRecord -> GET('game_rate', "`iid` = '{$itemList['id']}'", '', '');
		foreach ($rates as $rates) $totalRates = $totalRates + $rates['rate']*100/5;
		$totalRate = countRecord('game_rate', "`iid` = '{$itemList['id']}'");
	//	$likes = $itemList['likes'];
	//	$dislikes = $itemList['dislikes'];
		$likes = countRecord('game_vote', "`iid` = '{$itemList['id']}' AND `type` = 'like'");
		$dislikes = countRecord('game_vote', "`iid` = '{$itemList['id']}' AND `type` = 'dislike'");
		$votes = $likes + $dislikes;
		if ($votes != 0) {
			$lper = round($likes/$votes, 3) * 100;
			$dper = round($dislikes/$votes, 3) * 100;
		} else $lper = $dper = 0;
		$auth = getRecord('members', "`id` = '{$itemList['uid']}'"); ?>
<div class="element-item item-masonry the-box item-game one-item<?php if ($checkJoin > 0) echo ' joined'; if ($checkStar > 0) echo ' stared'; if ($joinNum >= 2) echo ' width2'; if ($starNum >= 2) echo ' height2' ?>">
	<span class="icon dogear"></span>
	<div class="item-info-top">
		<div class="item-author left">
			<a href="#!user?u=<?php echo $itemList['uid'] ?>">
				<img class="item-author-thumbnai" src="<?php echo $auth['avatar'] ?>" title="<?php echo $auth['username'] ?>"/>
			</a>
		</div>
		<div class="title">
			<a style="color:#37BC9B" href="#!game?g=<?php echo $itemList['id'] ?>"><?php echo $itemList['title'] ?></a>
		</div>
	</div>
	<div class="item-thumbnai">
		<a href="#!game?g=<?php echo $itemList['id'] ?>"><div class="thumbnai" style="background-image:url(<?php echo $itemList['thumbnai'] ?>)"></div></a>
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
		</div>
	</div>
</div>
<? } ?>
</div>
</div>


<script src="<?php echo PLUGINS ?>/isotope/isotope.pkgd.js"></script>
<script>$('#isotope-wrap').html('Loading...').load(MAIN_URL + '/pages/game.php #isotope-wrap > div', function () {
	isoo()
});</script>
<style>#content{padding-right:0}</style>
