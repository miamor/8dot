<? $tPrefix = _content($_POST['t-prefix']);
$tTitle = _content($_POST['t-title']);
$tDes = _content($_POST['t-des']);
$tThumbnai = $_POST['t-thumbnai'];
if (!$tThumbnai) $tThumbnai = IMG.'/test-icon.jpg';
$tTime = $_POST['t-time'];
$tDeadline = $_POST['t-deadline'];
$tUpType = $_POST['t-up-type'];
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
	
	if (is_dir_empty($tPath)) rmdir($tPath);
	
	if ($tPrefix) $tName = '['.$tPrefix.'] '.$tTitle;
	else $tName = $tTitle;
	if (countRecord('course_test', "`cid` = '$c' AND `prefix` = '$tPrefix' AND `title` = '$tTitle' ") <= 0) {
		$add = mysql_query("INSERT INTO `course_test` (`cid`, `code`, `prefix`, `title`, `thumbnai`, `des`, `test_time`, `deadline`, `problem`, `results_code`, `price`, `time`) VALUES ('$c', '$tCode', '$tPrefix', '$tTitle', '$tThumbnai', '$tDes', '$tTime', '$tDeadline', '$tProbURL', '$tResultsCode', '$tPrice', '$current')");
		if ($add) echo '<div class="alerts alert-success">Test <b>'.$testName.'</b> has been submitted successfully. Your attendees will be announced.</div>';
	} else echo '<div class="alerts alert-error">This course already contains a test name <b>'.$testName.'</b></div>';
} else echo '<div class="alerts alert-error">Something went wrong when creating a test. Please contact the administrators for help.</div>';
?>
