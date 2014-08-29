<?php include 'header.php';

$result = mysql_query("SHOW TABLES FROM `bschool`");

while ($row = mysql_fetch_row($result)) {
	$tbl = $row[0];
	$tb = $tbl;
	echo '<h2>Table: '.$row[0].'</h2>';
	$get = $getRecord -> GET($tb, '', '', '');
	foreach ($get as $get) {
		$timmes = str_replace('/', '-', $get['time']);
		$timme = explode(' ', $timmes);
		if (check($timme[1], '-') > 0) {
			$timmeDay = $timme[1];
			$timmeTime = $timme[0];
		} else {
			$timmeDay = $timme[0];
			$timmeTime = $timme[1];
		}
		$timmeNew = $timmeDay.' '.$timmeTime;
		$field = 'thumbnai';
		$oval = $get[$field];
		$imgg = str_replace('/box/', '/8dot/', $oval);
		$id = $get['id'];
		if ($timmeNew != $timmes) {
			$change = mysql_query("UPDATE `$tb` SET `time` = '$timmeNew' WHERE `id` = '$id'");
			if ($change) echo 'Done<br/>';
		}
	}

}
?>
