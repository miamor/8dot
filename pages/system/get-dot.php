<?php if ($d) {
	$dotIin = getRecord('dot', "`id` = '$d'");
	$checkDotuse = countRecord('dot_use', "`uid` = '$u' AND `did` = '$d'");
	if ($_GET['act'] == 'install') {
		if ($checkDotuse <= 0) {
			$a = mysql_query("INSERT INTO `dot_use` (`uid`, `did`, `time`) VALUES ('$u', '$d', '$current')");
			if ($a) echo '<div class="alerts alert-success">Dot <b>'.$dotIin['name'].'</b> is successfully installed to your package.</div>';
			else echo '<div class="alerts alert-error">Failed to get dot <b>'.$dotIin['name'].'</b>. Technology errors. (Please contact the administrators for help)</div>';
		} else echo '<div class="alerts alert-error">You already dot this dot in your package.</div>';
	} else if ($_GET['act'] == 'uninstall') {
		if ($checkDotuse > 0) {
			$a = mysql_query("DELETE FROM `dot_use` WHERE `uid` = '$u' AND `did` = '$d'");
			if ($a) echo '<div class="alerts alert-success">Dot <b>'.$dotIin['name'].'</b> is successfully uninstalled from your package.</div>';
			else echo '<div class="alerts alert-error">Failed to remove dot <b>'.$dotIin['name'].'</b>. Technology errors. (Please contact the administrators for help)</div>';
		} else echo '<div class="alerts alert-error">This dot is not yet in your package.</div>';
	}
} else if ($_GET['act']) echo '<div class="alerts alert-error">No dot found. Please select a dot before doing this action.</div>'; ?>
