<div class="overflow">
<?php $fList = $getRecord -> GET('friend', "`accept` = 'yes' AND (`uid` = '$u' OR `receive_id` = '$u')", '%10', '');
foreach ($fList as $fList) {
	if ($fList['uid'] == $u) $fInfo = getRecord('members', "`id` = '{$fList['receive_id']}'");
	else $fInfo = getRecord('members', "`id` = '{$fList['uid']}'") ?>
	<div class="one-friend">
		<img class="left thumb-round" src="<?php echo $fInfo['avatar'] ?>"/>
		<?php echo $fInfo['username'] ?>
	</div>
<?php } ?>
</div>
