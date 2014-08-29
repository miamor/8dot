<? if ($iid) {
	$nodePath = '/home/miamor/dev/node/node';
	
	$apIn = getRecord('apps', "`id` = '$iid' ");
	$appDir = MAIN_PATH.'/apps/';
	$appZip = $appDir.$apIn['code'].'.zip';

	$usDir = MAIN_PATH.'/users/'.$member['username'].'/';
	$insDir = $usDir.'apps/';
	$insAppDir = $insDir.$apIn['code'].'/';
	$insZip = $insDir.$apIn['code'].'.zip';
	$insAppConfigDir = $insAppDir.$apIn['config_dir'].'/';
	$insAppConfigFile = $insAppConfigDir.$apIn['config_file'];
	$insAppNodeRunFile = $insAppDir.'server.js';

	$appMyPort = '7000';
	$appMyHost = HOST_NAME;

	if (!file_exists($usDir)) {
		mkdir($usDir, 0777);
		chmod($usDir, 0777);
	}
	if (!file_exists($insDir)) {
		mkdir($insDir, 0777);
		chmod($insDir, 0777);
	}

	$zip = new ZipArchive;
	if ($zip->open($appZip) === TRUE) {
		$zip->extractTo($insDir);
		$zip->close();
	} else {
		echo 'Something went wrong when opening zip file. Please contact the administrators for help.';
	}
	chmod($insAppDir, 0777);
	chmod($insAppConfigDir, 0777);
	chmod($insAppConfigFile, 0777);
	chmod($insAppNodeRunFile, 0777);
	
	$appConfigContent = '';
	$appCfgOp = fopen($insAppConfigFile, 'r+');
	while ($line = fgets($appCfgOp)) $appConfigContent .= $line;
	fclose($appCfgOp);

	$appConfigContent = str_replace('{SET_USER_HOSTNAME}', $appMyHost, $appConfigContent);
	$appConfigContent = str_replace('8888', $appMyPort, $appConfigContent);
	echo $appConfigContent;

	$appCfgOp = fopen($insAppConfigFile, "w+");
	ftruncate($appCfgOp);
	fwrite($appCfgOp, $appConfigContent);
	fclose($appCfgOp);
	
	chdir($insAppDir);
	
	echo '<br/><br/>'.$insAppDir.'~~#$@<br/>';

	$insNpmCmd = './install.sh';
//	curl_exec('http://npmjs.org/install.sh');
	$insAppNpmCmd = 'npm install';
	$insCmd = $nodePath.' server';
	echo '<br/><br/>';

//	chdir('/home/miamor');
	exec($insNpmCmd.' 2>&1', $insNpm);
	print_r($insNpm);

//	chdir($insAppDir);
	$insAppNpm = exec($insAppNpmCmd.' 2>&1');
	$insAppReturn = exec($nodePath.' server.js 2>&1');
	echo '~~~~<br/>';
	echo $insAppNpm.'~~~~<br/>';
//	echo $insAppReturn;
	exec($nodePath.' server.js 2>&1', $output);
	print_r($output);
} else echo 'No app detected.' ?>
