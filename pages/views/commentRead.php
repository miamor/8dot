<span id="comts">

<?php $cCmt = $getRecord -> GET($tbl, "`iid` = '$vl' AND `pid` = '0' $condii", 10, $orderr) ?>
<div>
<?php foreach ($cCmt as $cmtInfo) {
$cAu = getRecord("members", "`id` = '{$cmtInfo['uid']}'");
$clikesAr = explode('|', $cmtInfo['like_list']);
$clikes = $cmtInfo['like'];
$cdislikesAr = explode('|', $cmtInfo['dislike_list']);
$cdislikes = $cmtInfo['dislike'] ?>

<div class="rows row-hover cmt <?php if ($typ == 'quest' || $typ == 'ex') echo 'cmt_ans' ?> cmt<?php echo $cmtInfo['id'] ?>" id="<?php echo $cmtInfo['id'] ?>">

<?php if ($typ == 'quest' || $typ == 'ex') {
	$likeCount = $cmtInfo['like'];
	$dislikeCount = $cmtInfo['dislike'];
	$voteCount = $likeCount - $dislikeCount ?>
	<div class="right-vote-ans right" id="cmt<?php echo $cmtInfo['id'] ?>">
		<div class="vote-answer">
<?php if (!in_array($u, $clikesAr)) echo '<a class="iic vote vote-up-off" data-href="cmt='.$cmtInfo['id'].'&act=like"></a>';
	else echo '<a class="iic vote vote-up-on" data-href="cmt='.$cmtInfo['id'].'&act=like"></a>'; ?>
			<div align="center" class="vote-count"><?php echo $voteCount ?></div>
<?php if (!in_array($u, $cdislikesAr)) echo '<a class="iic vote vote-down-off" data-href="cmt='.$cmtInfo['id'].'&act=dislike"></a>';
	else echo '<a class="iic vote vote-down-on" data-href="cmt='.$cmtInfo['id'].'&act=dislike"></a>'; ?>
		</div>
		<div class="choose-best-answer">
	<?php if ($typ == 'quest') {
		if ($libInfo['uid'] == $u) {
			if ($cmtInfo['solve'] == 'solve') echo '<a class="iic thank vote-accepted-on" title="This is chosen as best answer"></a>';
			else echo '<a class="iic thank vote-accepted-off" data-href="cmt='.$cmtInfo['id'].'&act=choosebest" title="Choose as best answer and close topic"></a>';
		}
	 } ?>
		</div>
	</div>
<?php } ?>

	<span><a href="#!user?u=<?php echo $cmtInfo['uid'] ?>">
		<img src="<?php echo $cAu['avatar'] ?>" title="Avatar của <?php echo $cAu['username'] ?>" class="thumbnaii"></a><br>
		<a onclick="rep('<?php echo $c ?>', '<?php echo $cmtInfo['id'] ?>', '<?php echo $cAu['id'] ?>')" class="minibutton reply">Reply</a>
	</span>

	<div class="inside">
		<div class="cmt-head">
<?php if ($cmtInfo['uid'] == $u || $member['admin'] == 'admin' || ($tb == 'comment_course' && $u == $cteacher_id)) { ?>
			<div id="action">
				<a class="<?php echo $cmtInfo['id'] ?>" id="editcm" title="Edit this comment"><i class="fa fa-edit"></i></a>
			</div>
<?php } ?>
			<a class="m-type <?php echo $cAu['group'] ?>" href="#!user?u=<?php echo $cAu['id'] ?>"><?php echo $cAu['username'] ?></a>
			<span class="right gensmall"><span class="fa fa-clock-o"></span> <?php echo $cmtInfo['time'] ?></span>
		</div>
		<div class="content"><?php echo $cmtInfo['content'] ?></div>
	
<div class="tool" id="cmti<?php echo $cmtInfo['id'] ?>"><span>
<?php if ($typ != 'quest' && $typ != 'ex') {
if (strpos($cmtInfo['like_list'], "|$u|") === false) { ?>
	<a id="like" alt="<?php echo $cmtInfo['id'] ?>"><i class="fa fa-thumbs-up"></i> <b><?php echo $cmtInfo['like'] ?></b> Like</a>
<?php } else { ?>
	<a id="like" alt="<?php echo $cmtInfo['id'] ?>"><i class="fa fa-thumbs-down"></i> <b><?php echo $cmtInfo['like'] ?></b> Unlike</a>
<?php }
}

	if (countRecord("$tb", "`pid` = '{$cmtInfo['id']}'") > 0) { ?>
		<a style="margin-left:5px" class="toggle-comment"><span><b><?php echo countRecord("$tb", "`pid` = '{$cmtInfo['id']}'") ?></b> comments</span></a>
	<?php } ?>
</span></div>

	</div>

		<div class="add-comment-form hide"><form class="form-add-comment" alt="<? echo $cmtInfo['id'] ?>" dataPostType="<? echo $cmtInfo['type'] ?>">
			<textarea class="cmt-discuss dafuk" name="comment" style="height:150px"></textarea>
			<input type="submit" value="Send"/>
		</form></div>


<div class="comt-child-list hide" id="child<? echo $cmtInfo['id'] ?>">
<?php if (countRecord($tb, "`pid` = '{$cmtInfo['id']}'") > 0) {
	$miW = mysql_query("SELECT * FROM `$tb` WHERE `pid` = '{$cmtInfo['id']}' ORDER BY `time` ASC");
	while ($cmtInfos = mysql_fetch_array($miW)) {
		$cAu = getRecord("members", "`id` = '{$cmtInfos['uid']}'") ?>
		
<div class="comt_child" id="<?php echo $cmtInfos['id'] ?>">
	<span><a href="#!user?u=<?php echo $cmtInfos['id'] ?>">
		<img src="<?php echo $cAu['avatar'] ?>" title="Avatar của <?php echo $cAu['username'] ?>" class="thumbnaii"></a><br>
	</span>
	
	<div class="inside">
		<div class="cmt-head">
	<?php if ($cmtInfos['uid'] == $u || $member['admin'] == 'admin') { ?>
			<div id="action">
				<a class="<?php echo $cmtInfos['id'] ?>" id="editcm" title="Edit this comment"><i class="fa fa-edit"></i></a>
			</div>
	<?php } ?>
			<a class="m-type <?php echo $cAu['group'] ?>" href="#!user?u=<?php echo $cAu['id'] ?>"><?php echo $cAu['username'] ?></a>
			<span class="right gensmall"><span class="fa fa-clock-o"></span> <?php echo $cmtInfos['time'] ?></span>
		</div>
		<div class="content"><?php echo $cmtInfos['content'] ?></div>
	</div>
</div>

<?php } 
} ?>
</div> <!-- End comt-child-list -->


</div>
<?php } ?>
	
	</div>
</span>

<?php if ($typ == 'quest' || $typ == 'ex' || $typ == 'doc') echo '<script src="'.JS.'/library.js"></script>' ?>
