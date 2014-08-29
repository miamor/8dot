<?php include 'lib/config.php';
$_SESSION['dot'] = $_GET['dot'];
$dot_info = getRecord('dot', "`id` = '{$_GET['dot']}'");
echo $dot_info['title'] ?>
