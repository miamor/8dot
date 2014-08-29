<?php include '../lib/config.php' ?>

<div class="the-box heading bg-info full-width no-border">
	<h1 class="no-padding no-margin"><i class="fa fa-shopping-cart icon-lg icon-circle icon-bordered"></i> Package</h1>
</div>
<div class="the-box full-width full-height no-border" style="*background:#fefefe;padding-top:30px">
	<div class="col-sm-12 col-md-4">
		<div class="the-box col-sm-6 col-md-12 shopping-cart cart-box">
			<input type="submit" value="Transfer" class="right"/>
			<h2>Transfer</h2>
			<div class="transfer-content">
				<div class="transfer-tick-info">
					<b style="margin-right:10px">TickID</b> <span class="label label-warning">#3</span>
				</div>
				<div class="transfer-user-info">
					<b>User to transfer</b>
					<select name="user-to-transfer" multiple class="chosen-select">
				<? $frList = $getRecord -> GET('friend', "`accept` = 'yes' AND (`uid` = '$u' OR `receive_id` = '$u') ");
				foreach ($frList as $frList) {
					if ($frList['uid'] == $u) $fri = getRecord('members', "`id` = '{$frList['receive_id']}' ");
					else $fri = getRecord('members', "`id` = '{$frList['uid']}' ");
					echo '<option value="'.$fri['id'].'">'.$fri['username'].'</option>';
				} ?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-12 col-md-8">
		<div class="the-box tick-list">
			<h2>Tickets</h2>
			<div class="tick-list-content">
			<? $ticks = $getRecord -> GET('ticks', "`uid` = '$u' ");
			foreach ($ticks as $ts) {
				$inn = getRecord($ts['type'], "`id` = '{$ts['iid']}' ") ?>
				<div class="one-tick rows">
					<a class="add-to-transfer"><img src="<? echo silk ?>/arrow_switch.png"/></a>
					<div class="tick-num">
						<? echo countRecord('ticks', "`uid` = '$u' AND `iid` = '{$ts['iid']}' AND `type` = '{$ts['type']}' ") ?>
					</div>
					<div class="a-title">
						<span class="capitalize label label-<? if ($ts['type'] == 'course') echo 'success'; else echo 'info' ?>"><? echo $ts['type'] ?></span>
						<a><? echo $inn['title'] ?></a>
						<b class="tick-code">#<? echo $ts['id'] ?></b>
					</div>
					<div class="tick-price right" title="Price (gold)">
						<img style="margin-top:-3px" src="<? echo IMG ?>/dollar_coin.png"/> <? echo $ts['price'] ?>
					</div>
					<div class="tick-action right">
						
					</div>
				</div>
			<? } ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
