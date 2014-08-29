<?php $chat = $getRecord -> GET('chat', " (`uid` = '$u' AND `to_uid` = '$uid') OR (`uid` = '$uid' AND `to_uid` = '$u') ", '', '`id` ASC');
	foreach ($chat as $chat) {
		$cU = getRecord('members', "`id` = '{$chat['uid']}' ");
		$cT = getRecord('members', "`id` = '{$chat['to_uid']}' ") ?>
				<div class="chat-line <?php if ($chat['uid'] == $u) echo 'me' ?>">
				<?php if ($chat['uid'] != $u) { ?>
					<a href="#!user?u=<?php echo $chat['uid'] ?>"><img class="avatar img-circle" src="<?php echo $cU['avatar'] ?>"/></a>
				<?php } ?>
					<div class="chat-line-content"><?php echo $chat['content'] ?></div>
					<div style="clear:both"></div>
				</div>
<?php } ?>
