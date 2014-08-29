<!-- <div class="borderwrap" id="readme">
	<div class="name">Description <span class="right time gensmall"><span class="fa fa-clock-o"></span> <?php echo $cInfo['time'] ?></span></div>
	<div class="plain"><?php echo $cInfo['des'] ?></div>
<!--	<style>.borderwrap .plain{border-top-color:<?php echo $dInfo['color'] ?>} .borderwrap .name{border-bottom-color:<?php echo $dInfo['color'] ?>}</style>
</div> -->

<? include 'system/courseView.php' ?>

<div class="the-box">
	<?php echo $cInfo['des'] ?>
</div>

<? // if ($u == $cInfo['uid']) { ?>
<!-- <h3 class="text-primary">Upload new feed</h3> -->
<div class="form-stt no-padding no-margin box-feed">
	<img class="my-avatar" src="<? echo $member['avatar'] ?>" style="margin-left:-60px"/>
	<form class="<?php echo $c ?>" alt="0" data-type="c" data-page="course" id="comments" method="post" data-action="<?php echo "c=$c" ?>" data-post-type="cmt">
		<div style="width:90%">
			<textarea class="dafuk" name="comment" id="textarea" style="width:100%;height:140px" placeholder="Content *"></textarea>
		</div>
		<input type="submit" name="submit" style="float:right;margin:-36px 0 0 10px" value="Send" title="Send"/>
		<div class="clearfix"></div>
	</form>
</div>
<? // } ?>

<div class="course-feed" style="margin-top:50px">
<? $cCmt = $getRecord -> GET('course_cmt', "`iid` = $c AND `pid` = 0 ");
foreach ($cCmt as $cmtInfo) {
$cAu = getRecord("members", "`id` = '{$cmtInfo['uid']}'");
$ccmts = countRecord('course_cmt', "`pid` = '{$cmtInfo['id']}'");
$clikesAr = explode('|', $cmtInfo['like_list']);
$clikes = $cmtInfo['like']; ?>
	<div class="statu the-box box-feed" id="<? echo $cmtInfo['id'] ?>">
		<div id="option"></div>
		<a class="fol_thum" href="#!user?u=1">
			<img src="<? echo $cAu['avatar'] ?>" class="thumbnai thumbs">
			<div class="bold"><? echo $cAu['username'] ?></div>
		</a>
		<div class="content stt">
			<? echo $cmtInfo['content'] ?>
		</div>
		<div id="tool">
			<span class="like-unlike">
				<a class="lik" id="like_<? echo $cmtInfo['id'] ?>" href="act=like&cmt=<? echo $cmtInfo['id'] ?>">
					<? if (!in_array($u, $clikesAr)) echo 'Like';
					else echo 'Unlike' ?>
				</a>
			</span>
			<a class="cmt" id="cmt_<? echo $cmtInfo['id'] ?>">Comment</a>
			<a class="share" id="share_<? echo $cmtInfo['id'] ?>">Share</a>
			<span class="nums">
				<span>
					<? if ($clikes > 0) echo '<span id="like"><i class="fa fa-thumbs-up"></i> '.$clikes.'</span>';
					if ($ccmts > 0) echo '<span id="cmt"><i class="fa fa-coffee"></i> '.$ccmts.'</span>' ?>
				</span>
			</span>
			<span class="deta gensmall" style="color:#888;padding:5px"><i class="fa fa-clock-o"></i> 06-07-2014 10:51</span>
		</div>
		<div class="like_list">
			<div class="num_line">
				<span> <span id="iy"></span> <span class="lt"></span> </span>
			</div>
		</div>
		<div class="stt-cmt-list">
<? if (countRecord('course_cmt', "`pid` = '{$cmtInfo['id']}'") > 0) {
	$miW = $getRecord -> GET('course_cmt', "`pid` = '{$cmtInfo['id']}' ", '', "`time` ASC, `id` ASC");
	foreach ($miW as $cmtInfos) {
		$cAut = getRecord("members", "`id` = '{$cmtInfos['uid']}'") ?>
			<div class="one-cmt-stt">
				<a class="bold" href="#!user?u=<? echo $cAut['id'] ?>"><img src="<? echo $cAut['avatar'] ?>" class="img-circle left">
				<span class="stt-user left"><? echo $cAut['username'] ?></span></a>
				<p><? echo $cmtInfos['content'] ?></p>
				<div class="cmt-tool">
					<a href="">Like</a>
					<span class="time gensmall"><span class="fa fa-clock-o"></span> 07-07-2014 07:21</span>
				</div>
			</div>
<? 	}
} ?>
		</div>
		<form class="cmt-form" id="<? echo $cmtInfo['id'] ?>">
			<img class="my-avatar" src="<? echo $member['avatar'] ?>">
			<textarea name="cmt-stt" class="no-toolbar non-sce" style="display: none;"></textarea>
			<input type="submit" class="right btn btn-primary" value="Submit">
		</form>
	</div>
<? } ?>
</div>

<script src="<?php echo JS ?>/courseFeed.js"></script>
