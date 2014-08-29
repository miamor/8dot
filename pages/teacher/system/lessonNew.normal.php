<?php if ($_GET['act'] == 'submit') {
	$lPrefix = _content($_POST['l-prefix']);
	$lTitle = _content($_POST['l-title']);
	$lThumbnai = $_POST['l-thumbnai'];
	$lContent = _content($_POST['l-content']);
	$lVid = $_POST['l-video'];
	$lDoc = $_POST['l-document'];
	$lPrice = $_POST['l-price'];
	if ($lPrice == $cInfo['price']) $lPrice = 0;
	if ($lPrefix) $lTtitle = '['.$lPrefix.'] '.$lTitle;
	else $lTtitle = $lTitle;
	if (countRecord('lesson', "`prefix` = '$lPrefix' AND `title` = '$lTitle'") > 0) echo '<div class="alerts alert-error">You already have a lesson name <b>'.$lTtitle.'</b> in this course. Please choose another name.</div>';
	else {
		$a = mysql_query("INSERT INTO `lesson` (`cid`, `prefix`, `title`, `thumbnai`, `content`, `document`, `video`, `price`, `time`) VALUES ('$c', '$lPrefix', '$lTitle', '$lThumbnai', '$lContent', '$lDoc', '$lVid', '$lPrice', '$current')");
		if ($a) {
			echo '<div class="alerts alert-success">Lesson <b>'.$lTtitle.'</b> added successfully.</div>';
			$lInfo = getRecord('lesson', "`cid` = '$c' AND `title` = '$lTitle' AND `prefix` = '$lPrefix' ");
			foreach ($joinList as $joinnist) sendNoti('new-lesson', $lInfo['id'], $c, $joinnist['uid']);
		} else echo '<div class="alerts alert-error">Something went wrong when creating a lesson. Please contact the administrators for help.</div>';
	}
} ?>
