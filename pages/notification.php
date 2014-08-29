<? include '../lib/config.php';
$notiList = $getRecord -> GET("notification", "`to_uid` = '$u' AND `type` != 'friend_request' AND `type` != 'follow' AND `type` != 'accept_friend_request' ", '%10');
	foreach ($notiList as $notiList) {
		$sendInfo = getRecord("members", "`id` = '{$notiList['uid']}'");
		$cou = getRecord('course', "`id` = '{$notiList['pi']}'") ?>
	<li class="<?php if ($notiList['read'] != 'read') echo 'unread' ?>"><div class="dropdown-noti" <? if ($notiList['type'] == 'transfer-coin-daily-ex') echo 'style="padding-left:15px"' ?> >
<? if ($notiList['type'] == 'transfer-coin-daily-ex') {
	$imgnoti = silk.'/coins_add.png';
	$dtsk = getRecord('daily_ex^title,coin,day', "`id` = '{$notiList['i']}'") ?>
			<!-- <img src="<? echo silk ?>/coins.png" style="margin-top:-2px"/> -->
			<b><? echo $notiList['content'] ?></b>/<? echo $dtsk['coin'] ?> coins were successfully transfered to you for solving daily task
			<a href="#!todayTask?e=<? echo $notiList['i'] ?>" class="bold"><? echo $dtsk['title'] ?></a>
			on <b><? echo $dtsk['day'] ?></b>.
<? } else if ($notiList['type'] == 'ex-add-solution') {
	$imgnoti = silk.'/pencil_add.png';
	$dtsk = getRecord('ex^title', "`id` = '{$notiList['pi']}'") ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			added a solution to your exercise
			<a href="#!exercise?e=<? echo $notiList['pi'] ?>" class="bold"><? echo $dtsk['title'] ?></a>.
<? } else if ($notiList['type'] == 'like-my-stt') {
	$imgnoti = silk.'/thumb_up.png';
	$quoteStt = getRecord('activity', "`id` = '{$notiList['i']}'") ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<?php if (check($quoteStt['type'], 'photo') >0) echo '<img class="absolute-right-content img-circle" src="'.$quoteStt['img_url'].'"/>' ?>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			liked your <strong>
			<?php if ($quoteStt['type'] == 'photo') echo '<a class="fanbox" href="'.$quoteStt['img_url'].'">photo</a>';
				else if ($quoteStt['type'] == 'stt') echo '<a href="#!feed?id='.$notiList['i'].'">status</a>';
				else echo '<a href="#!feed?id='.$notiList['i'].'">action</a>'; ?>
			</strong>
			<?php if ($quoteStt['content']) echo ': "<span class="quote-stt">'.$quoteStt['content'].'</span>" ' ?>
<? } else if ($notiList['type'] == 'like-wall-stt') {
	$imgnoti = silk.'/thumb_up.png';
	$quoteStt = getRecord('activity', "`id` = '{$notiList['i']}'") ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<?php if (check($quoteStt['type'], 'photo') >0) echo '<img class="absolute-right-content img-circle" src="'.$quoteStt['img_url'].'"/>' ?>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			liked a <strong>
			<?php if ($quoteStt['type'] == 'photo') echo '<a class="fanbox" href="'.$quoteStt['img_url'].'">photo</a>';
				else if ($quoteStt['type'] == 'sttt') echo '<a href="#!feed?id='.$notiList['i'].'">status</a>';
				else echo '<a href="#!feed?id='.$notiList['i'].'">action</a>'; ?>
			</strong>
			on your wall <?php if ($quoteStt['content']) echo ': "<span class="quote-stt">'.$quoteStt['content'].'</span>" ' ?>
<? } else if ($notiList['type'] == 'cmt-my-stt') {
	$imgnoti = silk.'/comment.png';
	$quoteStt = getRecord('activity_cmt', "`id` = '{$notiList['i']}'") ?>
			<img class="absolute-left-content img-circle" src="<? echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			commented on your <strong>
			<?php if ($quoteStt['type'] == 'photo') echo '<a class="fanbox" href="'.$quoteStt['img_url'].'">photo</a>';
				else echo '<a href="#!feed?id='.$notiList['i'].'">status</a>'; ?>
			</strong>: "<span class="quote-stt"><?php echo $quoteStt['content'] ?></span>".
<? } else if ($notiList['type'] == 'course_cmt_child' || $notiList['type'] == 'contest_cmt_child') {
	$imgnoti = silk.'/cup_add.png';
		$tt = explode('_cmt_child', $notiList['type']);
		$tt = $tt[0];
		$fiin = getRecord($notiList['content'], "`id` = '{$notiList['pi']}'");
		$quoteCmt = getRecord($tt.'_cmt', "`id` = '{$notiList['i']}' ");
		$hree = $notiList['content'];
		if ($tt == 'course') $href= '#!course?c='.$notiList['pi'];
		else if ($tt == 'contest') $href= '#!event?i='.$fiin['cid'] ?>
			<img class="absolute-left-content img-circle" src="<?php if ($fiin['thumbnai']) echo $fiin['thumbnai']; else echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			commented on your <a class="bold" href="#!<? echo $notiList['id'] ?>">post</a> in <? echo $hree ?> <a  class="bold" href="<? echo $href ?>"><? echo $fiin['title'] ?></a>
<? } else if (check($notiList['type'], '_cmt_child') > 0) {
	$imgnoti = silk.'/comments.png';
		$tt = explode('_cmt_child', $notiList['type']);
		$tt = $tt[0];
		$fiin = getRecord($notiList['content'], "`id` = '{$notiList['pi']}'");
		$quoteCmt = getRecord($tt.'_cmt', "`id` = '{$notiList['i']}' ");
		$hree = $notiList['content'];
		if ($tt == 'course') $href= '#!course?c='.$notiList['pi'];
		else if ($tt == 'lesson') $href= '#!course?c='.$fiin['cid'].'&t=learning&l='.$notiList['pi'];
		else if ($tt == 'announcement') $href= '#!course?c='.$fiin['cid'].'&t=announcement&a='.$notiList['pi'];
		else if ($tt == 'quest') $href= '#!quest?q='.$notiList['pi'];
		else if ($tt == 'ex') {
			$href= '#!exercise?e='.$notiList['pi'];
			$hree = 'exercise';
		} else if ($tt == 'doc') {
			$href= '#!document?d='.$notiList['pi'];
			$hree = 'document';
		} ?>
			<img class="absolute-left-content img-circle" src="<?php if ($fiin['thumbnai']) echo $fiin['thumbnai']; else echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			commented on your <a class="bold" href="#!<? echo $notiList['id'] ?>">comment</a> in <? echo $hree ?> <a  class="bold" href="<? echo $href ?>"><? echo $fiin['title'] ?></a>
<? } else if ($notiList['type'] == 'course_join') {
	$imgnoti = silk.'/user_add.png'; ?>
			<img class="absolute-left-content img-circle" src="<?php echo $sendInfo['avatar'] ?>"/>
			<img class="absolute-right-content img-circle" src="<? echo $cou['thumbnai'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			joined your course <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>"><?php echo $cou['title'] ?></a>
<? } else if ($notiList['type'] == 'contest_cmt') {
	$imgnoti = silk.'/cup.png';
	$fiin = getRecord('contest', "`id` = '{$notiList['pi']}' "); ?>
			<img class="absolute-left-content img-circle" src="<?php echo $sendInfo['avatar'] ?>"/>
			<img class="absolute-right-content img-circle" src="<? echo $fiin['thumbnai'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			posted in your event <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>"><?php echo $cou['title'] ?></a>
<? } else if ($notiList['type'] == 'course_cmt') {
	$imgnoti = silk.'/cup.png'; ?>
			<img class="absolute-left-content img-circle" src="<?php echo $sendInfo['avatar'] ?>"/>
			<img class="absolute-right-content img-circle" src="<? echo $cou['thumbnai'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			posted in your course <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>"><?php echo $cou['title'] ?></a>
<? } else if ($notiList['type'] == 'lesson_cmt') {
	$imgnoti = silk.'/comment.png';
		$fiin = getRecord('lesson', "`id` = '{$notiList['i']}'") ?>
			<img class="absolute-left-content img-circle" src="<?php echo $sendInfo['avatar'] ?>"/>
			<img class="absolute-right-content img-circle" src="<? echo $fiin['thumbnai'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			commented on the lesson <b><a href="#!course?c=<? echo $notiList['pi'] ?>&t=lesson&l=<? echo $notiList['i'] ?>"><?php echo $fiin['title'] ?></a></b>
			in your course <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>"><?php echo $cou['title'] ?></a>
<? } else if ($notiList['type'] == 'announcement_cmt') {
	$imgnoti = silk.'/comment.png';
		$fiin = getRecord('announcement', "`id` = '{$notiList['i']}' ") ?>
			<img class="absolute-left-content img-circle" src="<?php echo $sendInfo['avatar'] ?>"/>
			<img class="absolute-right-content img-circle" src="<? echo $fiin['thumbnai'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			commented on announcement <b><a href="#!course?c=<? echo $notiList['pi'] ?>&t=announcement&a=<? echo $notiList['i'] ?>"><?php echo $fiin['title'] ?></a></b>
			in your course <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>"><?php echo $cou['title'] ?></a>
<? } else if ($notiList['type'] == 'ex_cmt') {
	$imgnoti = silk.'/comment.png';
		$fiin = getRecord('ex', "`id` = '{$notiList['pi']}'") ?>
			<img class="absolute-left-content img-circle" src="<?php echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			commented on your exercise <a class="bold" href="#!exercise?e=<? echo $notiList['pi'] ?>"><?php echo $fiin['title'] ?></a>
<? } else if ($notiList['type'] == 'quest_cmt') {
	$imgnoti = silk.'/comment.png';
		$fiin = getRecord('quest', "`id` = '{$notiList['pi']}'") ?>
			<img class="absolute-left-content img-circle" src="<?php echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			added an answer to your question <a class="bold" href="#!quest?q=<? echo $notiList['pi'] ?>"><?php echo $fiin['title'] ?></a>
<? } else if ($notiList['type'] == 'quest_vote') {
	if ($notiList['content'] == 'like') $imgnoti = silk.'/thumb_up.png';
	else $imgnoti = silk.'/thumb_down.png';
		$fiin = getRecord('quest', "`id` = '{$notiList['pi']}'") ?>
			<img class="absolute-left-content img-circle" src="<?php echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			<? echo $notiList['content'] ?> your question <a class="bold" href="#!quest?q=<? echo $notiList['pi'] ?>"><?php echo $fiin['title'] ?></a>
<? } else if ($notiList['type'] == 'ex_vote') {
	if ($notiList['content'] == 'like') $imgnoti = silk.'/thumb_up.png';
	else $imgnoti = silk.'/thumb_down.png';
	$fiin = getRecord('ex', "`id` = '{$notiList['pi']}'") ?>
			<img class="absolute-left-content img-circle" src="<?php echo $sendInfo['avatar'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			<? echo $notiList['content'] ?> your exercise <a class="bold" href="#!exercise?e=<? echo $notiList['pi'] ?>"><?php echo $fiin['title'] ?></a>
<? } else if ($notiList['type'] == 'course_vote') {
	if ($notiList['content'] == 'like') $imgnoti = silk.'/thumb_up.png';
	else $imgnoti = silk.'/thumb_down.png';
	$fiin = getRecord('course', "`id` = '{$notiList['pi']}'") ?>
			<img class="absolute-left-content img-circle" src="<?php echo $sendInfo['avatar'] ?>"/>
			<img class="absolute-right-content img-circle" src="<? echo $fiin['thumbnai'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			<? echo $notiList['content'] ?> your course <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>"><?php echo $fiin['title'] ?></a>
<? } else if ($notiList['type'] == 'course_rate') {
	if ($notiList['content'] == 'like') $imgnoti = silk.'/thumb_up.png';
	else $imgnoti = silk.'/star.png';
	$fiin = getRecord('course', "`id` = '{$notiList['pi']}'") ?>
			<img class="absolute-left-content img-circle" src="<?php echo $sendInfo['avatar'] ?>"/>
			<img class="absolute-right-content img-circle" src="<? echo $fiin['thumbnai'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			rated <b><? echo $notiList['content'] ?></b> star for your course <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>"><?php echo $fiin['title'] ?></a>
<? } else if ($notiList['type'] == 'new-lesson') {
	$imgnoti = silk.'/report_add.png';
	$les = getRecord('lesson^title,thumbnai', "`id` = '{$notiList['i']}'"); ?>
			<img class="absolute-left-content img-circle" src="<?php echo $cou['thumbnai'] ?>"/>
			<img class="absolute-right-content img-circle" src="<?php echo $les['thumbnai'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			added new lesson <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>&t=learning&l=<? echo $notiList['i'] ?>"><? echo $les['title'] ?></a>
			in course <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>"><?php echo $cou['title'] ?></a>
<? } else if ($notiList['type'] == 'new-exam') {
	$imgnoti = silk.'/chart_curve.png';
	$les = getRecord('course_test', "`id` = '{$notiList['i']}'"); ?>
			<img class="absolute-left-content img-circle" src="<?php echo $cou['thumbnai'] ?>"/>
			<img class="absolute-right-content img-circle" src="<?php echo $les['thumbnai'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			added new exam <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>&t=exam&e=<? echo $notiList['i'] ?>"><? echo $les['title'] ?></a>
			in course <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>"><?php echo $cou['title'] ?></a>
<? } else if ($notiList['type'] == 'new-announcement') {
	$imgnoti = silk.'/bell.png';
	$les = getRecord('announcement', "`id` = '{$notiList['i']}'");
	$imgnoti = ''; ?>
			<img class="absolute-left-content img-circle" src="<?php echo $cou['thumbnai'] ?>"/>
			<img class="absolute-right-content img-circle" src="<?php echo $les['thumbnai'] ?>"/>
			<a class="bold" href="#!user?u=<?php echo $notiList['uid'] ?>">
				<?php echo $sendInfo['username'] ?>
			</a>
			added new announcement <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>&t=announcement&a=<? echo $notiList['i'] ?>"><? echo $les['title'] ?></a>
			in course <a class="bold" href="#!course?c=<? echo $notiList['pi'] ?>"><?php echo $cou['title'] ?></a>
<? } else echo $notiList['type'] ?>
<span class="small-caps"><img src="<? echo $imgnoti ?>"/> <?php echo $notiList['time'] ?></span>
<!--	<span class="small-caps"><span class="fa fa-clock-o"></span> <?php echo $notiList['time'] ?></span> -->
	</div></li>
<?php } ?>
