<? include 'system/eventView.php';
$cPrizez = explode('|', $cInfo['prize']); ?>

<div class="row" style="padding:5px 10px 0">
	<div class="col-sm-12 col-md-7">
		<div class="the-box col-md-12 no-padding no-margin">
			<div class="rows">
				<? if ($cInfo['place']) echo $cInfo['place'];
				else echo '<a><span class="fa fa-map-marker"></span> Add a place</a>'; ?>
			</div>
			<div class="rows">
				<a href="#!event?i=<? echo $iid ?>&t=members">Participants</a>
			</div>
		</div>

		<div class="the-box col-md-12" style="margin-top:15px">
			<? echo $cInfo['des'] ?>
		</div>
	</div>

	<div class="col-sm-12 col-md-5">
		<div class="the-box col-md-12 no-padding no-margin">
<? for ($j = 0; $j < count($cPrizez); $j++) {
	$jPrz = explode('-', $cPrizez[$j]);
	$jPrName = $jPrz[0];
	$jPrNums = $jPrz[1];
	$jPrzVal = $jPrz[2];
	$jPrzImg = $jPrz[3]; ?>
			<div class="one-prize">
				<img src="<? echo $jPrzImg ?>"/>
				<b><? echo $jPrName ?></b> (<i><? echo $jPrNums ?></i>)
				<span class="right"><img style="margin-top:-2px" src="<? echo IMG ?>/dollar_coin.png"/> <? echo $jPrzVal ?> </span>
			</div>
<? } ?>
		</div>

<? 	if ($cInfo['prize_awarded']) { ?>
		<div class="the-box col-md-12 no-padding" style="margin-top:15px">
<? for ($l = 0; $l < count($cPrizez); $l++) {
	$jPrz = explode('-', $cPrizez[$l]);
	$jPrName = $jPrz[0];
	$jPrNums = $jPrz[1];
	$jPrzVal = $jPrz[2];
	$jPrzImg = $jPrz[3];
	$jPrNameNoSpace = str_replace(' ', '', $jPrName);
		$prizAwrd = explode($jPrName.'>', $cInfo['prize_awarded']);
		$prizAwrd = explode('|', $prizAwrd[1]);
		$prizAwrd = $prizAwrd[0];
		$prizAwrdPer = explode('+', $prizAwrd);
		for ($k = 0; $k < count($prizAwrdPer); $k++) {
			$au = getRecord('members', "`id` = '{$prizAwrdPer[$k]}' ");
			$augrade = 0;
			$alltasks = $getRecord -> GET('contest_round_submit', "`iid` = '$iid' AND `uid` = '{$au['id']}' ");
			foreach ($alltasks as $alltasks) $augrade += $alltasks['grade'];
			if ($au) { ?>
			<div class="one-tsk-score aw-per rows" style="padding-left:10px!important" id="u<? echo $au['id'] ?>">
				<img src="<? echo $jPrzImg ?>" class="medal" style="margin-right:5px"/>
				<? echo '<div class="grade-square right">'.$augrade.'</div>'; ?>
				<? echo '<a href="#!user?u='.$au['id'].'"><img src="'.$au['avatar'].'" class="avatar img-circle" style="margin-right:3px"/> '.$au['username'].'</a>' ?>
			</div>
<? 			}
		}
} ?>
		</div>
<? } ?>
	</div>
</div>

<div class="form-stt no-padding no-margin box-feed">
	<img class="my-avatar" src="<? echo $member['avatar'] ?>" style="margin-left:-60px"/>
	<form class="<?php echo $c ?>" alt="0" data-type="c" data-page="course" id="comments" method="post" data-action="<?php echo "c=$c" ?>" data-post-type="cmt">
		<div style="width:90%">
			<textarea class="dafuk" name="comment" id="textarea" style="height:140px" placeholder="Content *"></textarea>
		</div>
		<input type="submit" name="submit" style="float:right;margin:-36px 0 0 10px" value="Send" title="Send"/>
		<div class="clearfix"></div>
	</form>
</div>

<div class="course-feed" style="margin-top:50px">
<? $cCmt = $getRecord -> GET('contest_cmt', "`iid` = $iid AND `pid` = 0 ", '', "`pin` DESC, `time` DESC");
foreach ($cCmt as $cmtInfo) {
$cAu = getRecord("members", "`id` = '{$cmtInfo['uid']}'");
$ccmts = countRecord('contest_cmt', "`pid` = '{$cmtInfo['id']}'");
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
<? if (countRecord('contest_cmt', "`pid` = '{$cmtInfo['id']}'") > 0) {
	$miW = $getRecord -> GET('contest_cmt', "`pid` = '{$cmtInfo['id']}' ", '', "`time` ASC, `id` ASC");
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
			<textarea name="cmt-stt" class="no-toolbar" style="display: none;"></textarea>
			<input type="submit" class="right btn btn-primary" value="Submit">
		</form>
	</div>
<? } ?>
</div>


<script src="<? echo JS ?>/courseFeed.js"></script>
