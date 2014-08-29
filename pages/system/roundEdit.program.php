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
// $tUpType = $_POST['t-up-type'];
$tUpType = 'zip';
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

/*$endMin = ($rnPublicMin + $tTime) % 6;
if ($rnPublicMin >= 30) $endHour = $rnPublicHour + floor($endMin / 60);
else $endHour = $rnPublicHour + ceil($endMin / 60);
*/
$endMin = sprintf("%02s", $endMin);
$endHour = sprintf("%02s", $endHour);
$endDay = $pDay;
$endMonth = $pMonth;
$endYear = $pYear;
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
$endMonth = sprintf("%02s", $endMonth);
$endTime = $endYear.$endMonth.$endDay.$endHour.$endMin.'00';
$end_Time = "$endDay-$endMonth-$endYear $endHour:$endMin";

while (countRecord('contest_round', "`code` = '$tCode' ") > 0) $tCode = generateRandomString(10);
if (mkdir(MAIN_PATH.'/data/contest/_coding/'.$tCode.'/', 0777, true) ) {
	$tDir = '/data/contest/_coding/'.$tCode.'/';
	$tPath = MAIN_PATH.$tDir;
	$tURL = MAIN_URL.$tDir;
	chmod($tPath, 0777);
	if ($tUpType == 'zip') {
		$tZip = $_FILES['t-zip-file'];
		$tZipSource = $_FILES['t-zip-file']['tmp_name'];
		$tZipName = $_FILES['t-zip-file']['name'];
		$tZipNameEx = explode('.', $tZipName);
		$tZipNameEx = $tZipNameEx[0];
		$tZipPath = $tPath.$tZipName;
		$tZipCode = array();
		if (move_uploaded_file($tZipSource, $tZipPath)) {
			chmod($tZipPath, 0777);
			$folders = 0;
			$foldersList = array();
			$zip = new ZipArchive;
			if ($zip->open($tZipPath) === TRUE) {
				$zip->extractTo($tPath);
				$zip->close();
			} else {
				rrmdir($tPath);
				echo 'Something went wrong when opening zip file. Please contact the administrators for help.';
			}
			unlink($tZipPath);
			if ($handle = opendir($tPath)) {
				$blacklist = array('.', '..');
				while (false !== ($file = readdir($handle))) {
					if (!in_array($file, $blacklist)) {
						$folders++;
						array_push($foldersList, $file);
					}
				}
				closedir($handle);
			}
//			echo $folders;
			if ($folders == 1) {
				$bigfolder = $foldersList[0];
				echo $bigfolder;
				rcopy($tPath.$bigfolder, $tPath);
			}
			$theFolder = array();
			if ($opDir = opendir($tPath)) {
				$blacklist = array('.', '..');
				while (false !== ($theFile = readdir($opDir))) {
					chmod($theFile, 0777);
					if (!in_array($theFile, $blacklist)) array_push($theFolder, $theFile);
				}
				closedir($opDir);
			}
		} else {
			rrmdir($tPath);
			echo 'Something went wrong when moving zip file. Please contact the administrators for help.';
		}
	}
//	echo '~~~~~~~~~~'.$tResultsCode;
	
	if (is_dir_empty($tDir)) rmdir($tDir);
	
	$tZipURL = $tURL.$tZipNameEx;
	if (file_exists($tPath.'problem.pdf')) {
		$tProbURL = $tURL.'problem.pdf';
		if (($key = array_search('problem.pdf', $theFolder)) !== false) {
			unset($theFolder[$key]);
		}
	} else $tProbURL = '';
	asort($theFolder);
	$zipFolder = implode ('/', $theFolder);

	if (countRecord('contest_round', "`iid` = '$iid' AND `rid` = '$r' ") <= 0) {
		$add = mysql_query("INSERT INTO `contest_round` (`iid`, `rid`, `code`, `des`, `public_time`, `publictime`, `test_time`, `end_time`, `endtime`, `problem`, `results_code`, `zcode`, `time`) VALUES ('$iid', '$r', '$tCode', '$tDes', '$tPublicTime', '$tPublicTimeInt', '$tTime', '$end_Time', '$endTime', '$tProbURL', '$tResultsCode', '$zipFolder', '$current')");
		if ($add) echo '<div class="alerts alert-success">Round <b>'.$r.'</b> will begin at <b>'.$tPublicTime.'</b>. All participants will be announced.</div>';
	} else ;
} else echo '<div class="alerts alert-error">Oops! Something went wrong. Please contact the administrators for help.</div>';
?>
