<?php include '../lib/config.php';
$uList = $_GET['u'];
$memChat = explode('|', $uList);
array_push($memChat, $u);
sort($memChat);
$chatUsers = implode('|', $memChat);
$mid = 'chat|'.$chatUsers;

checkAndJoinBBB($mid);

for ($j = 1; $j <= count($memChat); $j++) {
	$uid = $memChat[$j];
	$uInfo = getRecord('members', "`id` = '$uid' ");
}
?>
