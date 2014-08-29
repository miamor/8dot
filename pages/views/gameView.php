<div class="the-box game-view">
		<div class="game-play">
			<div class="game-frame">
				<iframe class="game-iframe" src="<? echo $gInfo['frame'] ?>"></iframe>
			</div>
		</div>

	<div class="game-high-score right the-box">
		<h3 class="text-primary">High score</h3>
		<? $gList = $getRecord -> GET('game_score', "`iid` = '$g' ", '%10', "`score` DESC");
			foreach ($gList as $gList) {
				$gListAuth = getRecord('members', "`id` = '{$gInfo['uid']}' ") ?>
			<div class="one-game-list">
				<a href="#!user?u=<? echo $gListAuth['username'] ?>"><? echo $gListAuth['username'] ?></a>
			</div>
		<? } ?>
	</div>

	<div class="game-list right">
		<h3 class="text-info">Available versions</h3>
		
		<h3 class="text-warning">Other games</h3>
	<? $gList = $getRecord -> GET('game', "`type` != 'contribute' ", '%10', "");
		foreach ($gList as $gList) {
			$gListAuth = getRecord('members', "`id` = '{$gInfo['uid']}' ") ?>
		<div class="one-game-list">
			<img class="g-thumb left" src="<? echo $gList['thumbnai'] ?>"/>
			<a class="bold" href="#!game?g=<? echo $g ?>"><? echo $gInfo['title'] ?></a>
			<br/>
			by <a href="#!user?u=<? echo $gListAuth['username'] ?>"><? echo $gListAuth['username'] ?></a>
		</div>
	<? } ?>
	</div>

	<div class="game-main">
		<div class="game-info">
			<h2 class="text-primary"><? echo $gInfo['title'] ?></h2>
		</div>
	</div>

	<div class="clearfix"></div>
</div>

<script src="<? echo JS ?>/gameView.js"></script>
