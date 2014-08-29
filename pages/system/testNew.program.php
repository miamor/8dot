<? $tPrefix = _content($_POST['t-prefix']);
$tTitle = _content($_POST['t-title']);
$tDes = _content($_POST['t-des']);
$tThumbnai = $_POST['t-thumbnai'];
if (!$tThumbnai) $tThumbnai = IMG.'/test-icon.jpg';
$tTime = $_POST['t-time'];
$tDeadline = $_POST['t-deadline'];
// $tUpType = $_POST['t-up-type'];
$tUpType = 'zip';
$tPrice = $_POST['t-price'];
$tCode = generateRandomString(20);
while (countRecord('course_test', "`code` = '$tCode' ") > 0) $tCode = generateRandomString(20);
if (mkdir(MAIN_PATH.'/data/test/'.$tCode.'/', 0777, true) ) {
	$tDir = '/data/test/'.$tCode.'/';
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
//			unlink($tZipPath);
			unlink($tZipSource);
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
			if ($folders == 1) {
				$bigfolder = $foldersList[0];
//				echo $bigfolder;
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
	
	if (is_dir_empty($tPath)) rmdir($tPath);
	else chmod($tPath, 0777);
	
	$tZipURL = $tURL.$tZipNameEx;
	if (file_exists($tPath.'problem.pdf')) {
		$tProbURL = $tURL.'problem.pdf';
		if (($key = array_search('problem.pdf', $theFolder)) !== false) {
			unset($theFolder[$key]);
		}
	} else $tProbURL = '';
	asort($theFolder);
	$zipFolder = implode ('/', $theFolder);

	if ($tPrefix) $tName = '['.$tPrefix.'] '.$tTitle;
	else $tName = $tTitle;
	if (countRecord('course_test', "`cid` = '$c' AND `prefix` = '$tPrefix' AND `title` = '$tTitle' ") <= 0) {
		$add = mysql_query("INSERT INTO `course_test` (`cid`, `code`, `prefix`, `title`, `thumbnai`, `des`, `test_time`, `deadline`, `problem`, `zname`, `zcode`, `price`, `time`) VALUES ('$c', '$tCode', '$tPrefix', '$tTitle', '$tThumbnai', '$tDes', '$tTime', '$tDeadline', '$tProbURL', '$tZipNameEx', '$zipFolder', '$tPrice', '$current')");
		if ($add) echo '<div class="alerts alert-success">Test <b>'.$testName.'</b> has been submitted successfully. Your attendees will be announced.</div>';
		else {
			echo '<div class="alerts alert-error">Something went wrong when creating a test. Please contact the administrators for help.</div>';
			rrmdir($tPath);
		}
	} else {
		echo '<div class="alerts alert-error">This course already contains a test name <b>'.$testName.'</b></div>';
		rrmdir($tPath);
	}
} else echo '<div class="alerts alert-error">Something went wrong when creating a test. Please contact the administrators for help.</div>';

?>
