<?php if ($_GET['act'] == 'submit') {
	if ($_GET['do'] == 'addcomment') {
		$te = $_GET['te'];
		$line = $_GET['line'];
		$content = _content($_POST['comment-line-'.$te.$line]);
		if ($content) mysql_query("INSERT INTO `task_ex_comment` (`uid`, `teid`, `line`, `content`, `time`) VALUES ('$u', '$te', '$line', '$content', '$current')");
	} else if ($_GET['do'] == 'grade') {
		$grade = $_POST['score'];
		$comt = _content($_POST['score-comment']);
		if ($l) changeValue('task_submit', "`uid` = '$uid' AND `tid` = '{$task['id']}' ", "`grade` = '$grade', `comment` = '$comt', `time_grade` = '$current' ");
		else if ($e) changeValue('test_submit', "`uid` = '$uid' AND `tid` = '$e' ", "`grade` = '$grade', `comment` = '$comt', `time_grade` = '$current' ");
	}
} ?>
