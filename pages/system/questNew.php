<?php if ($_GET['act'] == 'submit') {
	$qTitle = _content($_POST['q-title']);
	$qContent = _content($_POST['q-content']);
//	$qTags = $_POST['q-tags'];
	$qAvailable = $_POST['q-available'];
	if (!$qAvailable) $qAvailable = 'both';
	$qTopics = $_POST['q-topic'];
	$qExtraCoin = $_POST['q-coin'];
	asort($qTopics);
	$qTopics = implode(',', $qTopics);
	if (countRecord('quest', "`title` = '$qTitle' OR `content` = '$qContent'") > 0) {
		$qInfo = getRecord('quest', "`title` = '$qTitle' OR `content` = '$qContent'");
		if (countRecord('quest', "`title` = '$qTitle'") > 0) echo '<div class="alerts alert-error">There\'s already a quest with this title. Please check here <a href="#!quest?q='.$qInfo['id'].'">'.$qInfo['title'].'</a></div>';
		else echo '<div class="alerts alert-error">There\'s already a quest with this content. Please check here <a href="#!quest?q='.$qInfo['id'].'">'.$qInfo['title'].'</a></div>';
	} else {
		$a = mysql_query("INSERT INTO `quest` (`uid`, `did`, `title`, `coin`, `content`, `tid`, `available`, `time`) VALUES ('$u', '$dot', '$qTitle', '$qExtraCoin', '$qContent', '$qTopics', '$qAvailable', '$current')");
		if ($a) {
			echo '<div class="alerts alert-success">Your quest has been added successfully.</div>';
			addRep($u, 2);
			$newQ = getRecord('quest', "`title` = '$qTitle' AND `content` = '$qContent' AND `uid` = '$u' ");
			activityAdd('create-quest', $newQ['id']);
		} else echo '<div class="alerts alert-error">Something went wrong when creating a quest. Please contact the administrators for help.</div>';
	}
} ?>
