<?php if ($_GET['act'] == 'send') {
	$content = _content($_POST['chat-content-'.$uid]);
	if ($content) {
		$add = mysql_query("INSERT INTO `chat` (`uid`, `to_uid`, `content`, `time`) VALUES ('$u', '$uid', '$content', '$current')");
		if ($add) include 'views/chatContent.php';
		else echo 'error';
	}
} ?>
