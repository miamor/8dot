<?php $memm = getRecord('members', "`id` = '$uid'") ?>

<div class="user-right-col the-box">
	<div class="user-info-avatar">
		<img src="<?php echo $memm['avatar'] ?>"/>
	</div>
	<h2><?php echo $memm['username'] ?></h2>
</div>

<div class="user-main-col">
	<div class="user-info-cover" style="background-image:url('<?php echo $memm['cover'] ?>')"></div>
	<div class="user-info-menubar">

		<div class="user-info-acts right">
	<?php if ($u != $uid) { ?>
		<?php if (countRecord('friend', "(`uid` = '$u' AND `receive_id` = '$uid') OR (`uid` = '$uid' AND `receive_id` = '$u')") <= 0 &&
					countRecord('follow', "(`uid` = '$u' AND `followed_id` = '$uid') OR (`uid` = '$uid' AND `followed_id` = '$u')") <= 0) { ?>
			<a class="btn btn-primary" href="?u=<?php echo $uid ?>&act=follow"><i class="icon-black icon-ok-circle"></i> Follow</a>
		<?php } else if (countRecord('follow', "`uid` = '$u' AND `followed_id` = '$uid'") > 0) { ?>
			<a class="btn btn-info"><i class="icon-black icon-ok-circle"></i> Following</a>
		<?php }
		if (countRecord('follow', "`uid` = '$uid' AND `followed_id` = '$u'") > 0) { ?>
			<a class="btn btn-default"><i class="icon-black icon-ok-circle"></i> Follower</a>
		<?php } ?>

		<?php if (countRecord('friend', "(`uid` = '$u' AND `receive_id` = '$uid') OR (`uid` = '$uid' AND `receive_id` = '$u')") <= 0 &&
					countRecord('follow', "(`uid` = '$u' AND `followed_id` = '$uid') OR (`uid` = '$uid' AND `followed_id` = '$u')") <= 0) { ?>
			<a class="btn btn-primary" href="?u=<?php echo $uid ?>&act=addfriend"><i class="icon-black icon-plus"></i> Add friends</a>
		<?php } else if (countRecord('friend', "`uid` = '$u' AND `receive_id` = '$uid' AND `accept` != 'yes'") > 0) { ?>
			<a class="btn btn-primary"><i class="icon-black icon-plus"></i> Friend request sent</a>
		<?php } else if (countRecord('friend', "`receive_id` = '$u' AND `uid` = '$uid' AND `accept` != 'yes'") > 0) { ?>
			<a class="btn btn-primary" href="?u=<?php echo $u ?>&act=acceptfriend&id=<?php echo $uid ?>"><i class="icon-black icon-plus"></i> Confirm</a>
			<a class="btn btn-danger" href="?u=<?php echo $u ?>&act=notacceptfriend&id=<?php echo $uid ?>"><i class="icon-black icon-minus"></i> Deny</a>
		<?php } else if (countRecord('friend', "((`receive_id` = '$u' AND `uid` = '$uid') OR (`receive_id` = '$uid' AND `uid` = '$u')) AND `accept` = 'yes'") > 0) { ?>
			<a class="btn btn-info"><i class="icon-black icon-ok-circle"></i> Friend</a>
		<?php } ?>
	<?php } ?>
		</div>
	
		<li class="selected">Home</li>
		<li>About</li>
		<li>Course</li>
		<li>Library</li>
		<li>Friends/Follow</li>
		<li>Statistics</li>
	</div>
</div>


<ul class='statuss'>
<?php $sta=mysql_query("SELECT * FROM `activity` WHERE `to_uid` = '$uid' AND `type` != 'like' AND `type` NOT LIKE '%follow' ORDER BY id DESC");
	while ($sts= mysql_fetch_array($sta)) {
		$content = $sts['content'];
		$thoigian = $sts['update'];
		$img_url = addslashes($sts['img_url']);
		$up_id = $sts['uid'];
		$mesta=mysql_query("SELECT * FROM members WHERE id=$id");
		while ($mests= mysql_fetch_array($mesta)) {
			$avatar = $mests['avatar'];
			$name = $mests['username'];
			echo "<li class='statu stat'>
			<div class='post-head' style='height:45px'>";
			if ( $up_id != $id ) {
				$laymem = mysql_fetch_array( mysql_query("SELECT * FROM members WHERE id=$up_id") );
				$mnamem = $laymem['username'];
				$avat = $laymem['avatar'];
				echo "<a class='thum_fol' href='user.php?id=$up_id'><b><img src='$avat' style='float:left;margin-right:10px'/> $mnamem</b></a>
				<i class='img to'></i>
				<a href='user.php?id=$id'><b>$name</b></a>";
			} else echo "<a class='thum_fol' href='user.php?id=$id'><b><img src='$avatar' style='float:left;margin-right:10px'/> $name</b></a>";
			echo "<div class='deta'>$thoigian</div>
			</div>
		<div class='content' style='margin-top:10px'>$content";
	if ( $img_url != null ) echo "<br/><img src='$img_url' style='max-width:300px;margin-top:10px'/>";
	echo "</div>
	</li>";
		}
	}
?>
</ul>

<?php if ($u != $uid) {
	if ($_GET['act'] == 'follow') {
		if (countRecord('follow', "`uid` = '$u' AND `followed_id` = '$uid'") <= 0) {
			follow($u, $uid, $current);
		} else {
			unfollow($u, $uid, $current);
		}
	} else if ($_GET['act'] == 'addfriend') {
		addfriend($u, $uid, $current);
	}
} else {
	if ($_GET['act'] == 'acceptfriend') {
		$id_send = $_GET['id'];
		acceptfriend($id_send, $u, $uid, $current);
	} else if ($_GET['act'] == 'notacceptfriend') {
		$id_send = $_GET['id'];
		$m_send = getRecord('members', "`id` = '$id_send'");
		if (countRecord('friend', "`uid` = '$id_send' AND `receive_id` = '$u' AND (`accept` != 'yes' OR `accept` != 'no')") > 0) {
			$notinew = $m_send['friend_new'];
			$notinew++;
			$notinewS = $member['friend_new'];
			$notinewS--;
			mysql_query("INSERT INTO `notification` (`type`, `uid`, `to_uid`, `time`) VALUES ('not_accept_friend_request', '$u', '$id_send', '$current')");
//			mysql_query("DELETE FROM `notification` WHERE `type` = 'friend_request' AND `uid` = '$id_send' AND `to_uid` = '$u'");
			changeValue('members', "`id` = '$id_send'", "`friend_new` = '$notinew'");
			changeValue('members', "`id` = '$u'", "`friend_new` = '$notinewS'");
			changeValue('friend', "`uid` = '$id_send' AND `receive_id` = '$u'", "`accept` = 'no'");
		}
	}
} ?>

