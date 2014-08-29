<?php include '../lib/config.php';
$id = $_GET['id'];
if ($_GET['display']) {
	$id = $_GET['id'];
	$dis = $_GET['display'];
	$lL = $getRecord -> GET('activity_like', "`iid` = '$id' ");
	echo '<h3>'.count($lL).' following people liked this</h3>';
	foreach ($lL as $lL) {
		$lp = getRecord('members', "`id` = '{$lL['uid']}' ");
		echo '<div class="one-people"><a href="#!user?u='.$lL['uid'].'"><img class="left sm-thumb" src="'.$lp['avatar'].'"/> '.$lp['username'].'</a> <span class="right gensmall">'.$lp['type'].'</span></div>';
	}
} else {
	include 'views/community.php';
	right_container('300px', array('views/dotList.php', 'views/topicList.php'));
}

?>
