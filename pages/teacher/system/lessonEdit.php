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
	if (countRecord('lesson', "`prefix` = '$lPrefix' AND `title` = '$lTitle'") > 1) echo '<div class="alerts alert-error">You already have a lesson name <b>'.$lTtitle.'</b> in this course. Please choose another name.</div>';
	else {
		$edit = mysql_query("UPDATE `lesson` SET `title` = '$lTitle', `prefix` = '$lPrefix', `thumbnai` = '$lThumbnai', `content` = '$lContent', `document` = '$lDoc', `video` = '$lVid', `price` = '$lPrice' WHERE `id` = '$l'");
		if ($edit) echo '<div class="alerts alert-success">Lesson <b>'.$lTtitle.'</b> has been updated successfully.</div>';
		else echo '<div class="alerts alert-error">Something went wrong when editing a lesson. Please contact the administrators for help.</div>';
	}
} ?>
