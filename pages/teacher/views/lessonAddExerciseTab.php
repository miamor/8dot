<?php $qList = $getRecord -> GET('ex', $condition, '', '');
$typ = 'ex'; $ratetb = 'ex_rate'; $votetb = 'ex_vote'; $startb = 'ex_star';
foreach ($qList as $qList) {
	$teList = explode(',', $qList['tid']);
	for ($j = 0; $j < count($tcList); $j++) {
		if (in_array($tcList[$j], $teList)) {
			$task = getRecord('task', "`lid` = '$l'");
			$tEx = getRecord('task_ex', "`tid` = '{$task['id']}' AND `eid` = '{$qList['id']}'");
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
			$tidList = explode(',', $qList['tid']);
			$avai = $qList['available'];
			if ($typ == 'ex') $content = $qList['quest'];
			else $content = $qList['content'] ?>
<div class="one-row" id="ex<?php echo $qList['id'] ?>">

<div class="right addex-action" data-ex="<?php echo $qList['id'] ?>" data-lesson="<?php echo $l ?>" data-course="<?php echo $c ?>">
	<?php if (countRecord('task_ex', "`tid`  = '{$task['id']}' AND `eid` = '{$qList['id']}'") <= 0)
		echo '<div class="btn btn-primary add-ex">Add</div>
			<div class="btn btn-danger add-ex" id="difficult">Add as difficult</div>';
	else {
		echo '<div class="btn btn-danger add-ex">Remove</div>';
		if ($tEx['difficult'] =='yes') echo '<div class="btn btn-danger" id="mark-difficult">Remove difficult</div>';
		else echo '<div class="btn btn-primary" id="mark-difficult">Mark as difficult</div>';
	} ?>
</div>

<div class="row row-lib <?php if ($qList['solve'] == 'solve') echo 'solved'; if ($u == $qList['uid'] /*|| countRecord($startb, "`uid` = '$u' AND `iid` = '{$qList['id']}'") > 0*/ ) echo ' stared'; if ($u != $qList['uid'] && countRecord($typ.'_cmt', "`uid` = '$u' AND `iid` = '{$qList['id']}'") > 0 ) echo ' joined' ?> row-addexercise">
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
		<?php if ($qList['coin'] != 0) echo '<div class="lib-extra-coin" title="Extra coins for solving this problem"><img src="'.silk.'/coins_add.png"/> <b>'.$qList['coin'].'</b></div>' ?>
	</div>
	<div class="lib-list-content">
		<a>
			<b class="title"><?php echo $qList['title'] ?></b>
			<span class="right label-available label label-<?php if ($avai == 'students') echo 'info'; else if ($avai == 'teachers') echo 'danger'; else echo 'primary' ?> capitalize"><?php echo $avai ?></span>
			<div class="lib-content shorten">
				<?php echo $content ?>
			</div>
		</a>
		<?php if ($qList['type'] == 'test') {
					$exChoii = explode('|', $qList['choices']);
					for ($j = 0; $j < count($exChoii); $j++) {
						echo '<label class="radio primary" for="option'.$j.$qList['id'].'"><input type="radio" id="option'.$j.$qList['id'].'" disabled ';
						if ($exChoii[$j] == $qList['result']) echo 'checked ';
						echo 'name="result'.$qList['id'].'"/> '.$exChoii[$j].'</label>';
					}
				} else if ($qList['result']) echo '<div class="label label-info" style="position:absolute;margin-top:-15px;right:10px" title="Result">'.$qList['result'].'</div>'; ?>
	</div>
	<div class="lib-sta right">
		<div class="lib-sta-view"><i class="fa fa-eye"></i> <?php echo $qList['view'] ?></div>
		<div class="lib-sta-rep"><i class="fa fa-comments"></i> <?php echo countRecord($typ.'_cmt', '') ?></div>
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

</div>	
<?php 		break;
		}
	}
} ?>
