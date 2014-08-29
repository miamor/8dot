<div class="all-item-lists">
<div id="container1" class="super-list variable-sizes item-list clearfix">
<?php $itemList = $getRecord -> GET('course', "", '%12', '');
foreach ($itemList as $itemList) {
	echo $uid;
	$auth = getRecord('members', "`id` = '{$itemList['uid']}'") ?>
<div class="element one-item">
	<div class="item-thumbnai">
		<a href="#!item?i=<?php echo $itemList['id'] ?>"><img class="thumbnai" src="<?php echo $itemList['thumbnai'] ?>"/></a>
	</div>
	<div class="item-info">
<?php if ($page == 'ushop') { ?>
		<div class="item-author right">
			<a href="#!user?u=<?php echo $itemList['uid'] ?>">
				<img class="item-author-thumbnai" src="<?php echo $auth['avatar'] ?>" title="<?php echo $auth['username'] ?>"/>
			</a>
		</div>
<?php } ?>
		<div class="item-title">
			<div class="rate right">
				<div title="<?php echo $totalRate ?> votes <?php if ($totalRate != 0) echo '- '.$totalRates/$totalRate.'%' ?>" class="rating-icons <?php if ($itemList['uid'] == $u) echo 'myrate'; else echo 'rated' ?>">
					<?php for ($j = 1; $j <= 5; $j++) { ?>
						<div class="rating-star-icon v<?php echo $j ?>" id="v<?php echo $j ?>">&nbsp;</div>
					<?php } ?>
						<div class="rate-count" style="width:<?php if ($totalRate == 0) echo '0'; else echo $totalRates/$totalRate ?>%"></div>
				</div>
			</div>
			<span class="item-code"></span> <a href="#!item?i=<?php echo $itemList['id'] ?>" class="title"><?php echo $itemList['title'] ?></a>
		</div>
		<div class="item-sta">
<!--			<div class="sta-vote-bar right">
				<div class="vote-bar" title="<?php // echo $votes; if ($votes <= 1) echo ' vote'; else echo ' votes' ?>">
					<div class="vote-bar-like" title="<?php echo $likes; if ($likes <= 1) echo ' like'; else echo ' likes' ?>" style="width:<?php echo $lper.'%' ?>"></div>
					<div class="vote-bar-dislike" title="<?php echo $dislikes; if ($dislikes <= 1) echo ' dislike'; else echo ' dislikes' ?>" style="width:<?php echo $dper.'%' ?>"></div>
				</div>
			</div>
			<span class="item-view icon-eye-open"> <?php echo $itemList['views'] ?></span>
			<span class="item-buy icon-shopping-cart"> <?php echo $itemList['buys'] ?></span>
			<span class="item-feedback icon-comment"> <?php echo $itemList['cmts'] ?></span>
<!--			<span class="item-mix"><?php echo $itemList['title'] ?></span> -->
		</div>
	</div>
</div>
<?php } ?>
</div>
</div>

	<script src="<?php echo JS ?>/libs/isotope/isotope.js"></script>
	<script src="<?php echo JS ?>/index-isotope.js"></script>
