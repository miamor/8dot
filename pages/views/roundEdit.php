<? if ($cInfo['uid'] == $u) {
	if ($r <= $cInfo['rounds']) {
		if ($dInfo['type'] == 'program') include 'views/roundEdit.program.php';
		else include 'views/roundEdit.normal.php';
	} else echo '<div class="alerts alert-error">This contest is set for '.$cInfo['rounds'].' rounds only.</div>';
} else echo '<div class="alerts alert-error">This is not your contest. You cannot edit it.</div>'; ?>
