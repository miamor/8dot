<?php
if ($_GET['act'] == 'submit') {
	if ($_GET['do'] == 'updateevent') {
		$eStart = $_GET['start'];
		$eEnd = $_GET['end'];
		$eId = $_GET['id'];
		mysql_query("UPDATE `calendar` SET `start` = '$eStart', `end` = '$eEnd' WHERE `id` = '$eId' ");
	} else if ($_GET['do'] == 'dragevent') {
		$eDragId = $_GET['id'];
		$ein = getRecord('calendar', "`id` = '$eDragId' ");
		$eTitle = $ein['title'];
		$eDes = $ein['des'];
		$eURL = $ein['url'];
		$eStart = $_GET['start'];
		$eEnd = $_GET['end'];
		$eBg = $ein['bg'];
		$eColor = $ein['color'];
		mysql_query("INSERT INTO `calendar` (`title`, `des`, `url`, `uid`, `start`, `end`, `allday`, `bg`, `color`) VALUES ('$eTitle', '$eDes', '$eURL', '$u', '$eStart', '$eEnd', 'true', '$eBg', '$eColor')");
	} else if ($_GET['do'] == 'completeevent') {
		$eID = $_GET['id'];
		changeValue('calendar', "`id` = '$eID' ", "`complete` = 'yes' ");
	} else if ($_GET['do'] == 'removeevent') {
		$eID = $_GET['id'];
		mysql_query("DELETE FROM `calendar` WHERE `id` = '$eID' ");
	} else {
		if ($_GET['do'] == 'addevent') $letter = 'n';
		else if ($_GET['do'] == 'editevent') $letter = 'e';
		$id = $_GET['id'];
		$eTitle = _content($_POST['e'.$letter.'_title']);
		$eDes = _content($_POST['e'.$letter.'_des']);
		$eURL = $_POST['e'.$letter.'_url'];
		$eStart = $_POST['e'.$letter.'_start'];
		$eEnd = $_POST['e'.$letter.'_end'];
		$eAllday = $_POST['e'.$letter.'_allday'];
		$eBg = $_POST['e'.$letter.'_bg'];
		$eColor = $_POST['e'.$letter.'_color'];
		if ($eTitle) {
			if ($letter == 'n') mysql_query("INSERT INTO `calendar` (`title`, `des`, `url`, `uid`, `start`, `end`, `allday`, `bg`, `color`) VALUES ('$eTitle', '$eDes', '$eURL', '$u', '$eStart', '$eEnd', '$eAllday', '$eBg', '$eColor')");
			else if ($letter == 'e') changeValue('calendar', "`id` = '$id' ", "`title` = '$eTitle', `des` = '$eDes', `url` = '$eURL', `start` = '$eStart', `end` = '$eEnd', `allday` = '$eAllday', `bg` = '$eBg', `color` = '$eColor' ");
		}
	}
}
?>
