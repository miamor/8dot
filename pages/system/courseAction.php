<?php 
if ($_GET['dos'] == 'like' || $_GET['dos'] == 'dislike') {
	voteItem($_GET['dos'], $c, $u, $current);
}
if ($_GET['rate']) {
	$star = $_GET['rate'];
	rate('course', $c, $star, $u, $current);
}
if ($_GET['join'] == 'submit') courseJoin($u, $c, $current);
if ($_GET['star'] == 'submit') starLib('course', $c, $u, $current);
if ($_GET['do'] == 'noticeme') {
	if (countRecord('mark_notice', "`uid` = '$u' AND `type` = 'course' AND `iid` = '$c' ") <= 0) mysql_query("INSERT INTO `mark_notice` (`uid`, `type`, `iid`) VALUES ('$u', 'course', '$c')");
	else mysql_query("DELETE FROM `mark_notice` WHERE `uid` = '$u' AND `type` = 'course' AND `iid` = '$c' ");
}
?>
