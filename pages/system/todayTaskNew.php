<?php $exTitle = _content($_POST['ex-title']);
	$exType = $_POST['ex-type'];
	$exDay = $_POST['ex-day-publish'];
	$exCoin = $_POST['ex-extra-coin'];
	$exLv = $_POST['ex-level'];
	$exQuest = _content($_POST['ex-quest-'.$exType]);
	$exSolution = _content($_POST['ex-solution-'.$exType]);
	$exResult = _content($_POST['ex-result-'.$exType]);
//	$exTags = $_POST['ex-tags'];
	$exChoiceArray = array();
	for ($j = 1; $j <= 10; $j++) {
		if ($_POST['ex-choice-'.$j]) array_push($exChoiceArray, $_POST['ex-choice-'.$j]);
	}
	$exChoice = implode("|", $exChoiceArray);
//	$exAvailable = $_POST['ex-available'];
	$exAvailable = 'both';
	if (!$exAvailable) $exAvailable = 'both';
	$exLang = $_POST['ex-language'];
	if ($exLang == 'c_cpp') { $exLC = 'cpp'; $exLangName = 'C++'; }
	else if ($exLang == 'c') { $exLC = 'c'; $exLangName = 'C'; }
	else if ($exLang == 'java') { $exLC = 'java'; $exLangName = 'Java'; }
	else if ($exLang == 'python2.7') { $exLC = 'py'; $exLangName = 'Python 2.7'; }
	else if ($exLang == 'python3.2') { $exLC = 'py'; $exLangName = 'Python 3.2'; }
	if (!$exLang) $exLang = $exLangName = $exLC = '';
	$exTopics = $_POST['ex-topic'];
	asort($exTopics);
	$exTopics = implode(',', $exTopics);
	
	if ($exType == 'program') {
		$exSampleType = $_POST['ex-sample-type'];
		$exTestCaseType = $_POST['ex-test-case-type'];
		$inputFileName = 'input.txt';
		$outputFileName = 'output.txt';
		$exCode = generateRandomString(20);
		while (countRecord('ex', "`code` = '$exCode' ") > 0) $exCode = generateRandomString(10);
		if (mkdir(MAIN_PATH.'/data/coding/'.$exCode.'/', 0777, true) ) {
			$tDir = '/data/coding/'.$exCode.'/';
			$tPath = MAIN_PATH.$tDir;
			$tURL = MAIN_URL.$tDir;
			chmod($tPath, 0777);
			$exSolutionDir = $tDir.'sample.'.$exLC;
			$exSolutionPath = $tPath.'sample.'.$exLC;
			$fsamplep = fopen($tPath.'sample.'.$exLC, 'w+');
			fwrite($fsamplep, $exSolution);
			fclose($fsamplep);
			chmod($exSolutionPath, 0777);
			if ($exSampleType == 'none') $exInputFile = $exOutputFile = '';
			else {
				$exInputFile = $tDir.$inputFileName;
				$exOutputFile = $tDir.$outputFileName;
				if ($exSampleType == 'generate') {
					$finputp = fopen($tPath.$inputFileName, 'w+');
					fwrite($finputp, _content($_POST['ex-input-code']));
					fclose($finputp);
					$foutputp = fopen($tPath.$outputFileName, 'w+');
					fwrite($foutputp, _content($_POST['ex-output-code']));
					fclose($foutputp);
				} else if ($exSampleType == 'txt') {
					$inputFile = $_FILES['ex-input-file']['name'];
					$outputFile = $_FILES['ex-output-file']['name'];
					$upInput = move_uploaded_file($_FILES['ex-input-file']['tmp_name'], $tPath.$inputFileName);
					$upOutput = move_uploaded_file($_FILES['ex-output-file']['tmp_name'], $tPath.$outputFileName);
				} else if ($exSampleType == 'zip') {
					$tZip = $_FILES['ex-zip-file'];
					$tZipSource = $_FILES['ex-zip-file']['tmp_name'];
					$tZipName = $_FILES['ex-zip-file']['name'];
					$tZipPath = $tPath.$tZipName;
					if (move_uploaded_file($tZipSource, $tZipPath)) {
						chmod($tZipPath, 0777);
						$zip = new ZipArchive;
						if ($zip->open($tZipPath) === TRUE) {
							$zip->extractTo($tPath, array('input.txt', 'output.txt'));
							$zip->close();
						} else {
							rrmdir($tPath);
							echo 'Something went wrong when opening zip file. Please contact the administrators for help.';
						}
						unlink($tZipPath);
					} else {
						rrmdir($tPath);
						echo 'Something went wrong when moving zip file. Please contact the administrators for help.';
					}
				}
				chmod(MAIN_PATH.$exInputFile, 0777);
				chmod(MAIN_PATH.$exOutputFile, 0777);
				chmod($exSolutionPath, 0777);
			}
			chmod($tPath, 0777);
			if ($exTestCaseType == 'none') $exTestCaseDir = '';
			else {
				mkdir($tPath.'testcase/', 0777);
				$testPath = $tPath.'testcase/';
				$testZip = $_FILES['ex-test-case-zip-file'];
				$testZipSource = $_FILES['ex-test-case-zip-file']['tmp_name'];
				$testZipName = $_FILES['ex-test-case-zip-file']['name'];
				$testZipPath = $tPath.$testZipName;
				if (move_uploaded_file($testZipSource, $testZipPath)) {
						chmod($testZipPath, 0777);
						$zip = new ZipArchive;
						if ($zip->open($testZipPath) === TRUE) {
							$zip->extractTo($testPath);
							$zip->close();
						} else {
							rrmdir($testPath);
							echo 'Something went wrong when opening zip file. Please contact the administrators for help.';
						}
						unlink($testZipPath);
						if ($handle = opendir($testZipPath)) {
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
//							echo $bigfolder;
							rcopy($testZipPath.$bigfolder, $testZipPath);
						}
						$theFolder = array();
						if ($opDir = opendir($testZipPath)) {
							$blacklist = array('.', '..');
							while (false !== ($theFile = readdir($opDir))) {
								chmod($theFile, 0777);
								if (!in_array($theFile, $blacklist)) array_push($theFolder, $theFile);
							}
							closedir($opDir);
						}
					chmod($testPath, 0777);
				} else {
					rrmdir($testPath);
					echo 'Something went wrong when moving zip file. Please contact the administrators for help.';
				}
			}
		}
	} else $exInput = $exOutput = $exCode = $exInputFile = $exOutputFile = $exTestCaseDir = '';
	
	if (countRecord('daily_ex', "`type` = '$exType' AND (`title` = '$exTitle' OR `quest` = '$exQuest')") > 0) {
		$qInfo = getRecord('daily_ex', "`type` = '$exType' AND (`title` = '$exTitle' OR `quest` = '$exQuest')");
		if (countRecord('daily_ex', "`type` = '$exType' AND `title` = '$exTitle'") > 0) echo '<div class="alerts alert-error">There\'s already a same-type exercise with this title. Please check here <a href="#!todayTask?q='.$qInfo['id'].'">'.$qInfo['title'].'</a></div>';
		else echo '<div class="alerts alert-error">There\'s already a same-type exercise with this content. Please check here <a href="#!quest?q='.$qInfo['id'].'">'.$qInfo['title'].'</a></div>';
	} else {
		if ($exType == 'program') $exFinalSolutionToAdd = $exSolutionDir;
		else $exFinalSolutionToAdd = $exSolution;
		if (file_exists($testPath)) $exTestCaseDir = $tDir.'testcase/';
		else $exTestCaseDir = '';
		$a = mysql_query("INSERT INTO `daily_ex` (`uid`, `code`, `type`, `did`, `title`, `quest`, `answer`, `choices`, `result`, `tid`, `available`, `language`, `language_code`, `ace_code`, `input`, `output`, `testcase`, `hard_level`, `coin`, `day`, `time`) VALUES ('$u', '$exCode', '$exType', '$dot', '$exTitle', '$exQuest', '$exFinalSolutionToAdd', '$exChoice', '$exResult', '$exTopics', '$exAvailable', '$exLangName', '$exLC', '$exLang', '$exInputFile', '$exOutputFile', '$exTestCaseDir', '$exLv', '$exCoin', '$exDay', '$current')");
//		echo '<br/>'.$testZipPath.'<br/>'.$exCode.'~~~'.$exLC.'<br/>'.$exSolution;
		if ($a) {
			echo '<div class="alerts alert-success">Your exercise has been added successfully.</div>';
			$newEx = getRecord('daily_ex', "`code` = '$exCode' AND `uid` = '$u' ");
			addRep($u, 5);
			activityAdd('create-daily-ex', $newEx['id']);
		} else echo '<div class="alerts alert-error">Something went wrong when creating this exercise. Please contact the administrators for help.</div>';
	}
?>
