<? $gTitle = _content($_POST['g-title']);
$gDes = _content($_POST['g-des']);
$gIssues = _content($_POST['g-issues']);
$gGuide = _content($_POST['g-guide']);
$gSource = _content($_POST['g-sourse']);
$gCre = _content($_POST['g-credits']);
$gVer = $_POST['g-version'];
$gThumbnai = $_POST['g-thumbnai'];
$thumbs = array();
for ($j = 0; $j <= 100; $j++) {
	if ($_POST['thumb'.$j]) {
		substr_replace($thumbs, '~~~', 0, 0);
		array_push($thumbs, $_POST['g-thumb'.$j]);
	}
}
$thumm = implode("|", $thumbs);
$gUpType = $_POST['g-up-type'];
$gCode = generateRandomString(10);
while (countRecord('game', "`code` = '$gCode' ") > 0) $gCode = generateRandomString(20);
$myDir = '/data/game/'.$member['username'];
$checkMyDir = file_exists(MAIN_PATH.$myDir);
if (!$checkMyDir) mkdir(MAIN_PATH.$myDir, 0777, true);
chmod(MAIN_PATH.$myDir, 0777);
if (mkdir(MAIN_PATH.$myDir.'/'.$gCode.'/', 0777, true) ) {
	$gDir = $myDir.'/'.$gCode.'/';
	$gPath = MAIN_PATH.$gDir;
	$gURL = MAIN_URL.$gDir;
	chmod($gPath, 0777);
	if ($gUpType == 'upload') {
		$gZip = $_FILES['g-zip-file'];
		$gZipSource = $_FILES['g-zip-file']['tmp_name'];
		$gZipName = $_FILES['g-zip-file']['name'];
		$gZipNameFile = explode('.', $gZipName);
		$gZipNameFile = $gZipNameFile[0];
		$gURL = $gURL.$gZipNameFile.'/';
		$gZipPath = $gPath.$gZipName;
		if (move_uploaded_file($gZipSource, $gZipPath)) {
			chmod($gZipPath, 0777);
			$zip = new ZipArchive;
			if ($zip->open($gZipPath) === TRUE) {
				$zip->extractTo($gPath);
				chmod($gPath.$gZipNameFile.'/', 0777);
				$zip->close();
			} else {
				rrmdir($gPath);
				echo 'Something went wrong when opening zip file. Please contact the administrators for help.';
			}
		} else {
			rmdir($gPath);
			echo 'Something went wrong when moving zip file. Please contact the administrators for help.';
		}
	} else {
	}
	if (countRecord('game', "`title` = '$gTitle' ") <= 0) {
		$add = mysql_query("INSERT INTO `game` (`uid`, `code`, `frame`, `title`, `version`, `des`, `guide`, `issues`, `source`, `credits`, `thumbnai`, `thumbs`, `time`) VALUES ('$u', '$gCode', '$gURL', '$gTitle', '$gVer', '$gDes', '$gGuide', '$gIssues', '$gSource', '$gCre', '$gThumbnai', '$thumm', '$current')");
		if ($add) echo '<div class="alerts alert-success">Your game has been uploaded successfully.</div>';
	} else {
		$gInfo = getRecord('game', "`title` = '$gTitle' ");
		echo '<div class="alerts alert-error">There\'s already a game with this title in our storage. <a class="bold" href="#!game?g='.$gInfo['id'].'">Check here</a>. Is this the different one? If so, change the title will work. If this is the same game with another version or contribution, please choose <a class="bold">contribute</a>.</div>';
	}
}
?>
