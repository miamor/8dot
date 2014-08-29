<? include '../lib/config.php';

if ($g) {
	if (countRecord('game', "`id` = '$g' AND `type` != 'contribute' ") > 0) {
		$gInfo = getRecord('game', "`id` = '$g' AND `type` != 'contribute' ");
		include 'views/gameView.php';
	} else echo '<div class="alerts alert-error">No game found in data.</div>';
} else if ($mode == 'new') include 'views/gameNew.php';
else {
	include 'views/gameList.php';
} ?>
