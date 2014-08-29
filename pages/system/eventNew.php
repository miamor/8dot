<?php $conJoin = $_POST['con-join'];
	$conRounds = $_POST['con-rounds'];
	$conThumbnai = $_POST['con-thumbnai'];
	$conBanner = $_POST['con-banner'];
	$conPlace = $_POST['con-place'];
	$con = $_POST['con-rounds'];
	$conTitle = _content($_POST['con-title']);
	$conPrefix = _content($_POST['con-prefix']);
	$conDes = _content($_POST['con-des']);
	$conPrizeType = $_POST['con-prize-type'];
	$conPrizes = array();
	$conFirstPrize = 'First prize-'.$_POST['con-first-prize-num'].'-'.$_POST['con-first-prize-value'].'-'.$_POST['con-first-prize-img'];
	$conSecondPrize = 'Second prize-'.$_POST['con-second-prize-num'].'-'.$_POST['con-second-prize-value'].'-'.$_POST['con-second-prize-img'];
	$conThirdPrize = 'Third prize-'.$_POST['con-third-prize-num'].'-'.$_POST['con-third-prize-value'].'-'.$_POST['con-third-prize-img'];
	array_push($conPrizes, $conFirstPrize, $conSecondPrize, $conThirdPrize);
	$conPrizes = implode('|', $conPrizes);
	$conForm = $_POST['con-form'];
	$conFormFields = $_POST['con-form-content'];
	asort($conFormFields);
	$conFormFields = implode('|', $conFormFields);
	$conStart = $_POST['con-start-1'];
	$conStartRounds = array();
//	array_push($conStartRounds, '1>'.$_POST['con-start-1']);
	for ($y = 1; $y <= $conRounds; $y++) {
		mysql_query("INSERT INTO `contest_members` (`iid`, `rid`) VALUES ('$iid', '$y')");
		if ($_POST['con-start-'.$y]) {
			$conStartOne = $y.'>'.$_POST['con-start-'.$y];
			array_push($conStartRounds, $conStartOne);
		}
	}
	$conStartRounds = implode('|', $conStartRounds);
	$cHosts = $_POST['con-hosts'];
	$conHosts = array();
	foreach ($cHosts as $cOneHost) array_push($conHosts, $cOneHost);
	$conHosts = implode('|', $conHosts);
	$conSponsors = array();
	for ($j = 1; $j <= 100; $j++) {
		if ($_POST['con-sponsors-name-'.$j]) {
			$conSponsorOne = $_POST['con-sponsors-name-'.$j].'-'.$_POST['con-sponsors-link-'.$j].'-'.$_POST['con-sponsors-logo-'.$j];
			array_push($conSponsors, $conSponsorOne);
		}
	}
	$conSponsors = implode('|', $conSponsors);
//	echo $conHosts.'~~~'.$conJoin.'~~~'.$conPrizes.'~~~~~'.$conStartRounds.'~~~~'.$conForm.'~~'.$conFormFields;
	if (countRecord('contest', "`title` = '$conTitle' ") <= 0) {
		$add = mysql_query("INSERT INTO `contest` (`did`, `uid`, `prefix`, `title`, `thumbnai`, `banner`, `place`, `des`, `join`, `rounds`, `hosts`, `prize_type`, `prize`, `sponsors`, `start`, `start_rounds`, `form`, `form_fields`, `time`) VALUES ('$dot', '$u', '$conPrefix', '$conTitle', '$conThumbnai', '$conBanner', '$conPlace', '$conDes', '$conJoin', '$conRounds', '$conHosts', '$conPrizeType', '$conPrizes', '$conSponsors', '$conStart', '$conStartRounds', '$conForm', '$conFormFields', '$current')");
		if ($add) echo '<div class="alerts alert-success">Contest <b>'.$conTitle.'</b> has been created successfully.</div>';
		else echo '<div class="alerts alert-error">Something went wrong when creating new contest. Please contact the administrators for help.</div>';
	} else echo '<div class="alerts alert-error">The contest with this name already exists. If this is the same contest other season, you may ought to add SS code to the title or using perfix.</div>';
?>
