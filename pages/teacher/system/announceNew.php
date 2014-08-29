<?php if ($_GET['act'] == 'submit') {
	$lPrefix = _content($_POST['a-prefix']);
	$lTitle = _content($_POST['an-title']);
	$lThumbnai = $_POST['a-thumbnai'];
	$lContent = _content($_POST['a-content']);
	if ($lPrefix) $lTtitle = '['.$lPrefix.'] '.$lTitle;
	else $lTtitle = $lTitle;
	if (countRecord('announcement', "`prefix` = '$lPrefix' AND `title` = '$lTitle'") > 0) echo '<div class="alerts alert-error">You already have a lesson name <b>'.$lTtitle.'</b> in this course. Please choose another name.</div>';
	else {
		$a = mysql_query("INSERT INTO `announcement` (`cid`, `prefix`, `title`, `thumbnai`, `content`, `time`) VALUES ('$c', '$lPrefix', '$lTitle', '$lThumbnai', '$lContent', '$current')");
		if ($a) echo '<div class="alerts alert-success">The <b>'.$lTtitle.'</b> added successfully.</div>';
		else echo '<div class="alerts alert-error">Something went wrong when creating an announcement. Please contact the administrators for help.</div>';
	}
} ?>
