<?php if ($_GET['act'] == 'submit') {
	$dTitle = _content($_POST['d-title']);
	$dFrame = $_POST['d-frame'];
	$dContent = _content($_POST['d-content']);
//	$qTags = $_POST['q-tags'];
	$dAvailable = $_POST['d-available'];
	if (!$dAvailable) $dAvailable = 'both';
	$dTopics = $_POST['d-topic'];
	$dPrice = $_POST['d-price'];
	asort($dTopics);
	$dTopics = implode(',', $dTopics);
	if (countRecord('doc', "`title` = '$dTitle' OR `frame` = '$qFrame'") > 0) {
		$docInfo = getRecord('doc', "`title` = '$dTitle' OR `frame` = '$dFrame'");
		if (countRecord('doc', "`title` = '$dTitle'") > 0) echo '<div class="alerts alert-error">There\'s already a document with this title. Please check here <a href="#!document?i='.$docInfo['id'].'">'.$docInfo['title'].'</a></div>';
		else echo '<div class="alerts alert-error">There\'s already a document with this src. Please check here <a href="#!document?q='.$diocInfo['id'].'">'.$docInfo['title'].'</a></div>';
	} else {
		$add = mysql_query("INSERT INTO `doc` (`uid`, `did`, `title`, `price`, `frame`, `content`, `tid`, `available`, `time`) VALUES ('$u', '$dot', '$dTitle', '$dPrice', '$dFrame', '$dContent', '$dTopics', '$dAvailable', '$current')");
		if ($add) {
			echo '<div class="alerts alert-success">Your document has been added successfully.</div>';
			$newD = getRecord('doc', "`title` = '$dTitle' AND `frame` = '$dFrame' AND `content` = '$dContent' AND `uid` = '$u' ");
			activityAdd('create-doc', $newD['id']);
		} else echo '<div class="alerts alert-error">Something went wrong when creating a document. Please contact the administrators for help.</div>';
	}
} ?>
