<? if ($_GET['do'] == 'adddis') {
	$disTitle = _content($_POST['dis-title']);
	$disType = $_POST['dis-type'];
	$disContent = _content($_POST['dis-content']);
	if ($disTitle && $disType && $disContent) {
		if (countRecord('course_discuss', "`cid` = '$c' AND `title` = '{$disTitle}' ") <= 0) 
			mysql_query("INSERT INTO `course_discuss` (`uid`, `cid`, `type`, `title`, `content`, `time`) VALUES ('$u', '$c', '$disType', '$disTitle', '$disContent', '$current')");
	}
}
if ( $_GET['do'] == 'comment' ) {
	$iid = $_GET['id'];
	$cmt = _content($_POST['comment-'.$iid]);
	 mysql_query("INSERT INTO `course_discuss` (`pid`, `cid`, `uid`, `content`, `time`) VALUES ('$iid', '$c', '$u', '$cmt', '$current')");
}
if ($_GET['act']) {
	$actt = $_GET['act'];
	if ($actt == 'like' || $actt == 'dislike') {
		likeCmt('course_discuss', $actt, $cmii, $u);
	}
}
 ?>

<? if ($u) { ?>
<form class="add-discuss">
	<textarea class="summernote-sms" name="dis-content" id="textarea" style="width:100%;height:140px" placeholder="Content *"></textarea>
	<select class="left" name="dis-type" style="width:20%;margin-top:-1px">
		<option value="discuss" selected>Discuss</option>
		<option value="request">Request</option>
	</select>
	<input type="text" name="dis-title" style="width:40%;margin:-1px" placeholder="Input the title"/>
	<input type="submit" name="submit" style="float:right;margin:5px 10px 0 0" value="Send" title="Send"/>
</form>

<div class="clearfix"></div>

<div id="edits"></div><div id="test"></div>
<? } else echo '<div class="alerts alert-error">You must <a href="#!login">login</a> or <a href="#!register">register</a> to add comment</div>' ?>

<div class="done-data" style="height:20px"></div>

<h3 class="left" style="margin-top:22px!important">Requests and Discussions</h3>
<div class="discuss-board" style="margin-top:50px">
<?php $cDis = $getRecord -> GET('course_discuss', "`cid` = '$c' AND `pid` = 0", 20);
foreach ($cDis as $cDis) {
	$auth = getRecord('members', "`id` = '{$cDis['uid']}' ");
	$likeCount = $cDis['like'];
	$dislikeCount = $cDis['dislike'];
	$voteCount = $likeCount - $dislikeCount ?>
	<div class="one-discuss" id="dis<? echo $cDis['id'] ?>">
		<div class="left">
			<img src="<? echo $auth['avatar'] ?>" class="thumbnaii"/>
			<div class="one-discuss-vote right" id="cmt<? echo $cDis['id'] ?>" align="center"><div>
	<?php if (strlen(strstr($cDis['like_list'], "|$u|")) <= 0) echo '<a class="iic vote vote-up-off vote-small" data-href="cmt='.$cDis['id'].'&act=like"></a>';
		else echo '<a class="iic vote vote-up-on vote-small" data-href="cmt='.$cDis['id'].'&act=like"></a>'; ?>
				<span class="vote-count vote-count-small"><?php echo $voteCount ?></span>
	<?php if (strlen(strstr($cDis['dislike_list'], "|$u|")) <= 0) echo '<a class="iic vote vote-down-off vote-small" data-href="cmt='.$cDis['id'].'&act=dislike"></a>';
		else echo '<a class="iic vote vote-down-on vote-small" data-href="cmt='.$cDis['id'].'&act=dislike"></a>'; ?>
			</div></div>
		</div>
		<div class="one-discuss-content">
			<div class="one-discuss-info">
		<?php if ($cDis['uid'] == $u || $member['admin'] == 'admin') { ?>
				<div id="action" class="right">
					<a class="<?php echo $cDis['id'] ?>" id="editcm" title="Edit this comment"><i class="fa fa-edit"></i></a>
				</div>
		<?php } ?>
				<a>
					<span class="right gensmall" style="margin-top:1px"><span class="fa fa-clock-o"></span> <? echo $cDis['time'] ?></span>
					<? if ($cDis['type'] == 'request') echo '<span class="fa fa-exchange"></span> ';
					else echo '<span class="fa fa-retweet"></span> ' ?>
					<? echo $cDis['title'] ?>
				</a>
			</div>
			<div class="shorten">
				<? echo $cDis['content'] ?>
			</div>
			<div class="one-discuss-tool">
		<? if (countRecord('course_discuss', "`pid` = '{$cDis['id']}'") > 0) { ?>
				<a style="margin-left:5px" class="toggle-comment"><b><? echo countRecord("course_discuss", "`pid` = '{$cDis['id']}'") ?></b> comments</a>
		<? } ?>
				<a class="add-comment">Add comment</a>
			</div>
		</div>
		<div class="add-comment-form hide"><form class="form-add-comment" alt="<? echo $cDis['id'] ?>">
			<textarea class="cmt-discuss dafuk" name="comment-<? echo $cDis['id'] ?>" style="height:150px"></textarea>
			<input type="submit" value="Send"/>
		</form></div>

<div class="one-discuss-comment-list">
<?php if (countRecord('course_discuss', "`pid` = '{$cDis['id']}'") > 0) {
	$miW = mysql_query("SELECT * FROM `course_discuss` WHERE `pid` = '{$cDis['id']}'");
	while ($cmtInfos = mysql_fetch_array($miW)) {
		$cAu = getRecord("members", "`id` = '{$cmtInfos['uid']}'") ?>
		
<div class="comt_child" id="<?php echo $cmtInfos['id'] ?>">
	<span><a href="#!user?u=<?php echo $cmtInfos['id'] ?>">
		<img src="<?php echo $cAu['avatar'] ?>" title="Avatar của <?php echo $cAu['username'] ?>" class="thumbnaii"></a><br>
	</span>
	
	<div class="inside">
		<div class="cmt-head">
	<?php if ($cmtInfos['uid'] == $u || $member['admin'] == 'admin') { ?>
			<div id="action" class="right">
				<a class="<?php echo $cmtInfos['id'] ?>" id="editcm" title="Edit this comment"><i class="fa fa-edit"></i></a>
			</div>
	<?php } ?>
			<a class="m-type <?php echo $cAu['group'] ?>" href="#!user?u=<?php echo $cAu['id'] ?>"><?php echo $cAu['username'] ?></a>
			<span class="right gensmall"><span class="fa fa-clock-o"></span> <?php echo $cmtInfos['time'] ?></span>
		</div>
		<div class="shorten">
				<? echo $cmtInfos['content'] ?>
		</div>
	</div>
</div>

<?php } 
} ?>
</div>

	</div>
<?php } ?>
</div>

<script src="<?php echo JS ?>/courseDiscuss.js"></script>
