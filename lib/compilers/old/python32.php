<?php
	$CC="python3.2";
	//$out="./a.out";

	$sOutput = '';
	$soutputFile = fopen($outputFile, 'r');
	while ($soutputline = fgets($soutputFile)) $sOutput .= $soutputline;
	fclose($soutputFile);

	$fh = fopen($inputFile, 'r+');
	while ($line = fgets($fh)) $input .= $line;
	fclose($fh);

//	exec("cd $dir");
	chdir($dir);

	$filename_code = $fileCodeName.".py";
	$filename_in = "compile.input.txt";
	$filename_error = "compile.error.txt";

	//$executable="a.out";
	$command=$CC." ".$filename_code;	
	$command_error=$command." 2>".$filename_error;

	$file_code = fopen($filename_code, "w+");
	ftruncate($file_code, 0);
	fwrite($file_code, $code);
	fclose($file_code);

	$file_in = fopen($filename_in, "w+");
	fwrite($file_in, $input);
	fclose($file_in);

	//exec("chmod 777 $executable"); 
	exec("chmod -R 777 $filename_code"); 
	exec("chmod -R 777 $filename_in"); 
	exec("chmod 777 $filename_error");

	shell_exec($command_error);
	$error = file_get_contents($filename_error);

	if (trim($error) == "") {
		if (trim($input) == "") {
			$output=shell_exec($command);
		} else {
			$command=$command." < ".$filename_in;
			$output=shell_exec($command);
		}
	} else {
		echo "<div class='console error console-bottom bold'>Errors fetched:</div> <div class='console error non-icon'>$error</div>";
	}
	if ($output) {
		if (!$sOutput) echo "<div class='console success console-bottom bold'>Compile complete. <Not found sample output data></div> <div class='console non-icon'>$output</div>";
		else if ($output == $sOutput) echo "<div class='console success console-bottom bold'>Compile complete. You rock!</div> <div class='console non-icon'>$output</div>";
		else echo "<div class='console warning console-bottom bold'>Compile complete but output not match. You may wanna check again?</div> <div class='console non-icon'>$output</div>";
	}

//	exec("rm $filename_code");
	exec("rm $filename_in");
	exec("rm $filename_error");
?>
