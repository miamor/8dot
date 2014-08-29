<? if ($iid) {
	$apIn = getRecord('apps', "`id` = '$iid' ");
	$appDir = MAIN_PATH.'/apps/'.$apIn['code'].'/';
	$appConfigDir = $appDir.$apIn['config_dir'].'/';
	$appConfigFile = $appConfigDir.$apIn['config_file'];

	$insDir = $appDir;
	$insAppDir = $insDir;
	$insAppConfigDir = $insAppDir.$apIn['config_dir'].'/';
	$insAppConfigFile = $insAppConfigDir.'user-'.$u.'-config.js';
	$insAppNodeRunFile = $insAppDir.'server.js';

	$appMyPort = $u.'00'.$iid;
	$appMyHost = HOST_NAME;

/*	if (!file_exists($insDir)) {
		mkdir($insDir, 0777);
		chmod($insDir, 0777);
	}
*/

	$appConfigContent = '';
	$appCfgOp = fopen($appConfigFile, 'r+');
	while ($apline = fgets($appCfgOp)) $appConfigContent .= $apline;
	fclose($appCfgOp);

	echo $appConfigFile.'~~~~<br/>';
	echo $insAppConfigFile.'~~~~<br/>';

	$insAppConfigContent = str_replace('{SET_USER_HOSTNAME}', $appMyHost, $appConfigContent);
	$insAppConfigContent = str_replace('8888', $appMyPort, $appConfigContent);
	echo $insAppConfigContent;

	$insAppCfgOp = fopen($insAppConfigFile, "w+");
	ftruncate($insAppCfgOp);
	fwrite($insAppCfgOp, $insAppConfigContent);
	fclose($insAppCfgOp);
	
	chmod($insAppConfigFile, 0777);
	chmod($insAppNodeRunFile, 0777);
	chmod($insAppDir, 0777);
	chmod($insAppConfigDir, 0777);

	$insCmd = 'node server';
	echo '<br/><br/>';
	echo $insAppDir.'<br/>';
	chdir($insAppDir);
	$insAppReturn = exec($insCmd.' 2>&1');
	echo $insAppReturn;
} else echo 'No app detected.' ?>
