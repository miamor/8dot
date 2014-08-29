<? $tDes = _content($_POST['t-des']);
$rnPublicHour = $_POST['public_time_hour'];
$rnPublicMin = $_POST['public_time_minute'];
$rtimAr = explode('|', $cInfo['start_rounds']);
if ($rOTime) $rnDate = $rOTime;
else {
	$rnDate = $_POST['public_time_day'];
	array_push($rtimAr, $rnDate);
}
$rtimm = implode('|', $rtimAr);
$tPublicTime = $rnDate.' '.$rnPublicHour.':'.$rnPublicMin;

$rnDateAr = explode('-', $rnDate);
$pMin = sprintf("%02s", $endMin);
$pHour = sprintf("%02s", $endHour);
$pDay = sprintf("%02s", (int)$rnDateAr[0]);
$pMonth = sprintf("%02s", (int)$rnDateAr[1]);
$pYear = sprintf("%02s", (int)$rnDateAr[2]);
$tPublicTimeInt = $pYear.$pMonth.$pDay.$rnPublicHour.$rnPublicMin.'00';

$tTime = (int)$_POST['t-time'];
$tUpType = $_POST['t-up-type'];
$tCode = generateRandomString(20);

$tTimeHour = sprintf("%02s", floor($tTime / 60));
$tTimeMin = sprintf("%02s", $tTime % 6);
$tTimem = $tTimeHour.$tTimeMin;

$endMin = $rnPublicMin + $tTimeMin;
$endHour = $rnPublicHour + $tTimeHour;
if ($endMin >= 60) {
	$endMin = $endMin - 60;
	$endHour++;
}

/*$endMin = $nowM + $tTime;
$endHour = $nowH;
*/
$endMin = sprintf("%02s", $endMin);
$endHour = sprintf("%02s", $endHour);
$endDay = $todayd;
$endMonth = $todaym;
$endYear = $todayY;
$thisMonthDays = date('t');
if ($endMin > 59) {
	$endMin = $tTime - (59 - $endMin);
	$endHour++;
	if ($endHour > 23) {
		$endHour = 0;
		$endDay++;
		if ($endDay > $thisMonthDays) {
			$endDay = 1;
			$endMonth++;
			if ($endMonth > 12) {
				$endMonth = 1;
				$endYear++;
			}
		}
	}
}
$endMin = sprintf("%02s", $endMin);
$endHour = sprintf("%02s", $endHour);
$endDay = sprintf("%02s", $endDay);
$endDay = sprintf("%02s", $endMonth);
$endTime = $endYear.$endMonth.$endDay.$endHour.$endMin.'00';
$end_Time = "$endDay-$endMonth-$endYear $endHour:$endMin";
while (countRecord('contest_round', "`code` = '$tCode' ") > 0) $tCode = generateRandomString(10);
if (mkdir(MAIN_PATH.'/data/contest/'.$tCode.'/', 0777, true) ) {
	$tDir = '/data/contest/'.$tCode.'/';
	$tPath = MAIN_PATH.$tDir;
	$tURL = MAIN_URL.$tDir;
	chmod($tPath, 0777);
	if ($tUpType == 'zip') {
		$tZip = $_FILES['t-zip-file'];
		$tZipSource = $_FILES['t-zip-file']['tmp_name'];
		$tZipName = $_FILES['t-zip-file']['name'];
		$tZipPath = $tPath.$tZipName;
		if (move_uploaded_file($tZipSource, $tZipPath)) {
			chmod($tZipPath, 0777);
			$zip = new ZipArchive;
			if ($zip->open($tZipPath) === TRUE) {
				$zip->extractTo($tPath, array('problem.pdf', 'results.txt'));
				$zip->close();
				$tProbURL = $tURL.'problem.pdf';
			} else {
				rrmdir($tPath);
				echo 'Something went wrong when opening zip file. Please contact the administrators for help.';
			}
		} else {
			rrmdir($tPath);
			echo 'Something went wrong when moving zip file. Please contact the administrators for help.';
		}
	} else {
		$tProbType = $_POST['t-up-prob-type'];
		if ($tProbType == 'file') {
			$tProbFileDecode = $_FILES['t-prob-file']['name'];
			$ext = end(explode(".", strtolower(basename($tProbFileDecode))));
			$tProbFileName = explode('.', $tProbFile);
//			if (strlen($tProbFileDecode) != strlen(utf8_decode($tProbFileDecode))) $tProbFile = md5($tProbFileName[0]).'.'.$ext;
//			else $tProbFile = $tProbFileDecode;
			$tProbFile = 'problem.pdf';
			$upProb = move_uploaded_file($_FILES['t-prob-file']['tmp_name'], $tPath.$tProbFile);
			$tProbURL = $tURL.$tProbFile;
		} else $tProbURL = $_POST['t-prob-url'];
//		echo $tProbURL;

		$tResultType = $_POST['t-result-type'];
		if ($tResultType == 'upload') {
			$tResultsCode = '';
			$tResultFile = $_FILES['t-ans-file']['name'];
			$tResultFileName = 'results.txt';
			$upResult = move_uploaded_file($_FILES['t-ans-file']['tmp_name'], $tPath.$tResultFileName);
			$tResultURL = $tURL.$tResultFileName;
			$fh = fopen($tPath.$tResultFileName, 'r');
			while ($line = fgets($fh)) $tResultsCode .= $line;
			fclose($fh);
			$tResultsCode = _content($tResultsCode);
		} else if ($tResultType == 'console') {
			$tResultsCode = _content($_POST['t-ans-console']);
		} else {
			$tNums = $_POST['t-nums'];
			$tResultsCode = '';
			for ($j = 1; $j <= $tNums; $j++) {
				if ($_POST['t-result-'.$j]) {
					$tAnsOne = '@'.$_POST['t-ans-'.$j].'['.$j.'::'.$_POST['t-result-'.$j].'::'.$_POST['t-sample-answer-'.$j].']';
					$tResultsCode .= $tAnsOne;
				}
			}
			$tResultsCode = _content($tResultsCode);
		}
	}
//	echo '~~~~~~~~~~'.$tResultsCode;
	
	if (is_dir_empty($tDir)) rmdir($tDir);
	
	if (countRecord('contest_round', "`iid` = '$iid' AND `rid` = '$r' ") <= 0) {
		$add = mysql_query("INSERT INTO `contest_round` (`iid`, `rid`, `code`, `des`, `public_time`, `publictime`, `test_time`, `end_time`, `endtime`, `problem`, `results_code`, `time`) VALUES ('$iid', '$r', '$tCode', '$tDes', '$tPublicTime', '$tPublicTimeInt', '$tTime', '$end_Time', '$endTime', '$tProbURL', '$tResultsCode', '$current')");
		if ($add) echo '<div class="alerts alert-success">Round <b>'.$r.'</b> will begin at <b>'.$tPublicTime.'</b>. All participants will be announced.</div>';
	} else ;
} else echo '<div class="alerts alert-error">Oops! Something went wrong. Please contact the administrators for help.</div>';
?>
