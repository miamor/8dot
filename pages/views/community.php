<script type="text/javascript" src="<?php echo JS ?>/community.js"></script>

<style>.sceditor-container{margin:-1px;width:100%!important;border:1px solid #ededed}
.pagination{display:none}</style>

<?php if (!$id) { ?>
<div class='m_mainn'>

<div id='test'></div>

<div class="hide small-board-fixed"></div>
<div class="hide small-board sb-stt-likelist"></div>

<div class="form-stt the-box box-feed">
	<img class="my-avatar" src="<? echo $member['avatar'] ?>"/>
	<div class="head" style="margin-top:-5px;padding:0 5px 5px;font-size:11px">
		<b style="margin:0 10px"><a id="update-stt" style="color:#444"><i class="icon-comment icon-black"></i> Update status</a></b>
	</div>
	<div id="arrow"></div>
	<form method="post" enctype="multipart/form-data" action="<?php echo MAIN_URL ?>/pages/feed.php?do=submitstt" class="<?php echo $member['id'] ?>" id="submitstt">
		<div class="form-text">
			<textarea name="status" style="height:80px" id="update_stt" class="no-toolbar" placeholder="What on your mind"></textarea>
		</div>
		<div class="text_bottom" id="submitphoto">
				<i class="fa fa-camera"></i>
				<div class='submit_img'><input type='file' accept="image/*" id='stt_photo' name='img'/></div>
				<i class="divider-stt"></i>
			<input type="submit" name="ok_upload" id="oku" value="Submit" style="float:right"/>
			<div class="loading" style="float:right;margin:13px 10px 0 0;display:none"><img src="<?php echo $imgdir ?>/ajaxload.gif"/></div>
		</div>
	</form>
</div>

<!--		<video class="video-js" controls width="620" height="349" poster="<?php echo FLAT_UI ?>/images/video/poster.jpg" data-setup="{}">
			<source src="http://iurevych.github.com/Flat-UI-videos/big_buck_bunny.mp4" type="video/mp4">
			<source src="http://iurevych.github.com/Flat-UI-videos/big_buck_bunny.webm" type="video/webm">
		</video>
-->
<?php $site = MAIN_URL;
if ( $_GET['do'] == "submitstt" ) {
	$content = _content($_POST['status']);
	$title = _content($_POST['title']);
	$decodeName = $_FILES['img']['name'];
	$ext = end(explode(".", strtolower(basename($decodeName))));
	$nameF = explode('.', $decodeName);
	if (strlen($decodeName) != strlen(utf8_decode($decodeName))) $nameFile = md5($nameF[0]).'.'.$ext;
	else $nameFile = $decodeName;
	$up = move_uploaded_file($_FILES['img']['tmp_name'], MAIN_PATH."/data/img/".$nameFile);
	$url = "data/img/".$nameFile;
//	echo $_FILES['img']['tmp_name'].'~~~~~~'.$nameFile;
//	if ($up) echo 'done';
//	else echo 'error';
	if ($_GET['type'] == 'blog') {
		if ($title && $content) {
			if ($up) mysql_query("insert into `activity` (`type`, `title`, `img_url`, `uid`, `to_uid`, `content`, `time`) values ('blog', '$title', '$url', '$u', '$u', '$content', '$current')");
			else mysql_query("insert into `activity` (`type`, `title`, `uid`, `to_uid`, `content`, `time`) values ('blog', '$title', '$u', '$u', '$content', '$current')");
		}
	} else {
		if ($up) mysql_query("insert into `activity` (`type`, `img_url`, `uid`, `to_uid`, `content`, `time`) values ('photo', '$url', '$u', '$u', '$content', '$current')");
		else if ($content) mysql_query("insert into `activity` (`type`, `uid`, `to_uid`, `content`, `time`) values ('stt', '$u', '$u', '$content', '$current')");
	}
}
$ui = $member['id'] ?>

<div class='following'>

	<div class='statuss'>
		<?php if ($_GET['show']) {
			$showC = $_GET['show'];
			if ($showC == 'status') $mconn = "`type` = 'stt'";
			else if ($showC == 'blog') $mconn = "`type` = 'blog'";
		} else $mconn = "`type` != 'like'";

		if ($_GET['note'] == 'undividepage') $l = $getRecord -> GET('activity', $mconn, '', '');
		else $l = $getRecord -> GET('activity', $mconn, '^5', '');
		foreach ($l as $l) {
				$lid = $l['id'];
				$up_id = $l['uid'];
				$to_id = $l['to_uid'];
				$content = nl2br($l['content']);
				$thoigian = $l['time'];
				$img_url = $l['img_url'];
				$laymem = getRecord('members', "`id`='$up_id'");
				$up_name = $mnamem = $laymem['username'];
				$avat = $laymem['avatar'];
				$laymm = getRecord('members', "`id`='$to_id'");
				$to_name = $laymm['username'];
			if ($l['uid'] == $u || countRecord('follow', "`uid` = '$u' AND `followed_id` = '{$l['uid']}'") > 0 ||
				countRecord('friend', "(`uid` = '$u' AND `receive_id` = '{$l['uid']}') OR (`receive_id` = '$u' AND `uid` = '{$l['uid']}')") > 0) {
				if ($l['type'] == 'follow') echo '<div class="statu long-line"><a class="fol_thum" href="#!user?u='.$up_id.'"><img src="'.$avat.'" class="thumbnai"/> <b>'.$up_name.'</b></a> followed 
					<a class="m-type '.$laymem['group'].'" href="#!user?u='.$to_id.'"><b>'.$to_name.'</b></a>.</div>';
				else if ($l['type'] == 'unfollow') echo '<div class="statu long-line"><a class="fol_thum" href="#!user?u='.$up_id.'"><img src="'.$avat.'" class="thumbnai"/> <b>'.$up_name.'</b></a> unfollowed 
					<a class="m-type '.$laymem['group'].'" href="#!user?u='.$to_id.'"><b>'.$to_name.'</b></a>.</div>';
				else if ($l['type'] == 'become-friend') echo '<div class="statu long-line"><a class="fol_thum" href="#!user?u='.$up_id.'"><img src="'.$avat.'" class="thumbnai"/> <b>'.$up_name.'</b></a> and 
					<a class="m-type '.$laymem['group'].'" href="#!user?u='.$to_id.'"><b>'.$to_name.'</b></a> became friends.</div>';
				else {
					echo "<div class='statu the-box box-feed' id='$lid'>
						<div id='option'></div>";
						if ($up_id != $to_id) {
							echo "<a class='fol_thum' href='#!user?u=$up_id'>
									<img src='$avat' class='thumbnai thumbs'/>
									<div class='bold'>$up_name</div>
								</a>
								<a href='#!user?u=$up_id'><b>$up_name</b></a>
								<i class='img to'></i>
								<a class='m-type ".$laymem['group']."' href='#!user?u=$to_id'><b>$to_name</b></a>";
						} else {
							echo "<a class='fol_thum' href='#!user?u=$up_id'><img src='$avat' class='thumbnai thumbs'/>
							<div class='bold'>$up_name</div></a>";
							if ($l['type'] != 'stt') {
								echo '<a href="#!user?u='.$up_id.'"><b>'.$up_name.'</b></a> ';
								if ($l['type'] == 'photo' && strlen($l['content']) <= 0) echo '<span class="small">added a photo</span>';
								else if ($l['type'] == 'create-quest') {
									$ifl = getRecord('quest', "`id` = '{$l['iid']}' ");
									echo '<span class="small">added a quest</span>';
									echo '<div class="thumb-box"><a href="#!quest?q='.$ifl['id'].'"><h3>'.$ifl['title'].'</h3>';
									if ($ifl['coin']) echo '<div class="left gensmall" title="Extra coins for solving this problem"><img style="height:14px;margin:-3px 1px 0 0" src="'.silk.'/coins_add.png"/>'.$ifl['coin'].' </div>';
									echo '<div class="shorten">'.$ifl['content'].'</div>
									</a></div>';
								} else if ($l['type'] == 'create-ex') {
									$ifl = getRecord('ex', "`id` = '{$l['iid']}' ");
									echo '<span class="small">added an exercise</span>';
									echo '<div class="thumb-box"><a href="#!ex?e='.$ifl['id'].'"><h3>'.$ifl['title'].'</h3>';
									echo '<div class="shorten">'.$ifl['quest'].'</div>
									</a></div>';
								} else if ($l['type'] == 'create-doc') {
									$ifl = getRecord('doc', "`id` = '{$l['iid']}' ");
									echo '<span class="small">added an exercise</span>';
									echo '<div class="thumb-box"><a href="#!doc?d='.$ifl['id'].'">';
//									echo '<img class="thumbnai-left left" src="'.$ifl['thumbnai'].'"/>';
									echo '<h3>'.$ifl['title'].'</h3>';
									if ($ifl['price']) echo '<div class="left gensmall" title="Price per download"><img style="height:14px;margin:-3px 1px 0 0" src="'.IMG.'/dollar_coin.png"/>'.$ifl['price'].' </div>';
									echo '<div class="shorten">'.$ifl['content'].'</div>
									</a></div>';
								} else if ($l['type'] == 'create-course') {
									$ifl = getRecord('course', "`id` = '{$l['iid']}' ");
									echo '<span class="small">added a course</span>';
									echo '<div class="thumb-box"><a href="#!course?c='.$ifl['id'].'">';
									echo '<img class="thumbnai-left left" src="'.$ifl['thumbnai'].'"/>';
									echo '<h3>'.$ifl['title'].'</h3>';
									echo '<div class="shorten">'.$ifl['des'].'</div>
									</a></div>';
								} else if ($l['type'] == 'create-contest') {
									$ifl = getRecord('contest', "`id` = '{$l['iid']}' ");
									echo '<span class="small">created a contest</span>';
									echo '<div class="thumb-box"><a href="#!event?i='.$ifl['id'].'">';
									echo '<img class="thumbnai-left left" src="'.$ifl['thumbnai'].'"/>';
									echo '<h3>'.$ifl['title'].'</h3>';
									echo '<div class="shorten">'.$ifl['des'].'</div>
									</a></div>';
								}
							}
						}
						echo "<div class='content stt'>";
						if ($content) echo $content;
						if ($img_url != null && (strlen(strstr($img_url, '.')) > 0)) echo "<div class='line-break'></div> <img src='$img_url'/>";
						echo '</div>';
					display_like_stt($u, $lid, $thoigian);
					echo "</div>";
				}
			}
		}

		if ($_GET['do']) {
//				$p = $_GET['p'];
				$pS = mysql_fetch_array(mysql_query("SELECT * FROM `activity` WHERE `id` = '$p'"));
				$upi = $pS['uid'];
				$upnn = getRecord('members', "`id` = '$upi'");
				$upn = $upnn['username'];
				$toi = $pS['to_uid'];
				$tonn = getRecord('members', "`id` = '$toi'");
				$ton = $tonn['username'];
			if ( $_GET['do'] == "cmt" ) {
				$cmtcon = _content($_POST['cmt-stt-'.$p]);
				if ($cmtcon && $cmtcon != '<p><br></p>') mysql_query("INSERT INTO `activity_cmt` (`uid`, `iid`, `content`, `time`) VALUES ('$u', '$p', '$cmtcon', '$current')");
			}
			if ( $_GET['do'] == "like" ) {
				if ( mysql_num_rows( mysql_query("SELECT * FROM `activity_like` WHERE `iid` = '$p' AND `uid` = '$u'") ) <= 0 ) {
					$inlike = mysql_query("INSERT INTO `activity_like` (`uid`, `iid`, `time`) VALUES ('$u', '$p', '$current')");
					if ($upi != $u) {
						if ($upi != $toi) {
//							sendNoti('like-wall-stt', $p, '', $toi, '');
							sendNoti('like-wall-stt', $p, '', $upi);
						} else $innos = sendNoti('like-my-stt', $p, '', $upi);
					}
				} else echo "You've liked this";
			}
			if ( $_GET['do'] == "unlike" ) {
				if ( mysql_num_rows( mysql_query("SELECT * FROM `activity_like` WHERE `iid` = '$p' AND `uid` = '$u'") ) > 0 )
					$unlike=mysql_query("DELETE FROM `activity_like` WHERE `iid` = '$p' AND `uid` = '$u'");
			}
		}
	?>
	</div>
	<div id="more"></div>
</div>

</div>

<?php } else {
	$pInfo = $l = getRecord('activity', "`id` = '$id'");
	$laymem = getRecord('members', "`id` = '{$pInfo['uid']}'");
	$up_name = $mnamem = $laymem['username'];
	$avat = $laymem['avatar'];
	$laymm = getRecord('members', "`id` = '{$pInfo['to_uid']}'");
	$to_name = $laymm['username'] ?>
	<div class='statu stat one the-box box-feed' id='<?php echo $id ?>'>
		<div id='option'></div>
	<?php if ($pInfo['uid'] != $pInfo['to_uid']) {
			echo "<a class='fol_thum' href='#!user?u={$pInfo['uid']}'>
					<img src='$avat' class='thumbnai'/>
					<div class='bold'>$up_name</div>
				</a>
				<a href='#!user?u={$pInfo['uid']}'><b>{$up_name}</b></a>
				<i class='img to'></i>
				<a href='#!user?u={$pInfo['to_uid']}'><b>{$to_name}</b></a>";
		} else echo "<a class='fol_thum' href='#!user?u={$pInfo['uid']}'><img src='$avat' class='thumbnai'/><div class='bold'>$up_name</div></a>";
	if ($l['type'] != 'stt') {
		echo '<a href="#!user?u='.$up_id.'"><b>'.$up_name.'</b></a> ';
		if ($l['type'] == 'photo' && strlen($l['content']) <= 0) echo '<span class="small">added a photo</span>';
		else if ($l['type'] == 'create-quest') {
			$ifl = getRecord('quest', "`id` = '{$l['iid']}' ");
			echo '<span class="small">added a quest</span>';
			echo '<div class="thumb-box"><a href="#!quest?q='.$ifl['id'].'"><h3>'.$ifl['title'].'</h3>';
			if ($ifl['coin']) echo '<div class="left gensmall" title="Extra coins for solving this problem"><img style="height:14px;margin:-3px 1px 0 0" src="'.silk.'/coins_add.png"/>'.$ifl['coin'].' </div>';
			echo '<div class="shorten">'.$ifl['content'].'</div>
			</a></div>';
		} else if ($l['type'] == 'create-ex') {
			$ifl = getRecord('ex', "`id` = '{$l['iid']}' ");
			echo '<span class="small">added an exercise</span>';
			echo '<div class="thumb-box"><a href="#!ex?e='.$ifl['id'].'"><h3>'.$ifl['title'].'</h3>';
			echo '<div class="shorten">'.$ifl['quest'].'</div>
			</a></div>';
		} else if ($l['type'] == 'create-doc') {
			$ifl = getRecord('doc', "`id` = '{$l['iid']}' ");
			echo '<span class="small">added an exercise</span>';
			echo '<div class="thumb-box"><a href="#!doc?d='.$ifl['id'].'">';
//			echo '<img class="thumbnai-left left" src="'.$ifl['thumbnai'].'"/>';
			echo '<h3>'.$ifl['title'].'</h3>';
			if ($ifl['price']) echo '<div class="left gensmall" title="Price per download"><img style="height:14px;margin:-3px 1px 0 0" src="'.IMG.'/dollar_coin.png"/>'.$ifl['price'].' </div>';
			echo '<div class="shorten">'.$ifl['content'].'</div>
			</a></div>';
		} else if ($l['type'] == 'create-course') {
			$ifl = getRecord('course', "`id` = '{$l['iid']}' ");
			echo '<span class="small">added a course</span>';
			echo '<div class="thumb-box"><a href="#!course?c='.$ifl['id'].'">';
			echo '<img class="thumbnai-left left" src="'.$ifl['thumbnai'].'"/>';
			echo '<h3>'.$ifl['title'].'</h3>';
			echo '<div class="shorten">'.$ifl['des'].'</div>
			</a></div>';
		} else if ($l['type'] == 'create-contest') {
			$ifl = getRecord('contest', "`id` = '{$l['iid']}' ");
			echo '<span class="small">created a contest</span>';
			echo '<div class="thumb-box"><a href="#!event?i='.$ifl['id'].'">';
			echo '<img class="thumbnai-left left" src="'.$ifl['thumbnai'].'"/>';
			echo '<h3>'.$ifl['title'].'</h3>';
			echo '<div class="shorten">'.$ifl['des'].'</div>
			</a></div>';
		}
	}
		echo "<div class='content stt'>";
		if ($pInfo['content']) echo $pInfo['content'];
		if ($pInfo['img_url'] != null && (strlen(strstr($pInfo['img_url'], '.')) > 0)) echo "<div class='line-break'></div><img src='{$pInfo['img_url']}'/>";
		echo '</div>';
	display_like_stt($u, $pInfo['id'], $pInfo['time']);	?>
	</div>
<?php } ?>

<div class="m_advertise">
	<div class="main_content">
		<div class="rows">This is the title of the advertise</div>
		<img src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash2/373424_239368225023_804738382_q.jpg"/>
	</div>
</div>

