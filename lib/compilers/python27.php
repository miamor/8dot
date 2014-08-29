<?php
	$CC = "python2.7";
	//$out="./a.out";

	$sOutput = file_get_contents($outputFile);

	$fh = fopen($inputFile, 'r+');
	while ($line = fgets($fh)) $input .= $line;
	fclose($fh);

	chdir($dir);

	$filename_code = $fileCodeName.".py";
	$filename_in = "compile.input.txt";
	$filename_error = "compile.error.txt";

	//$executable="a.out";
	$command = $CC." ".$filename_code;	
	$command_error = $command." 2>".$filename_error;
	
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

	if (trim($error) == "" || !strpos($error, "error")) {
		if (trim($input) == "") $execOut = $command;
		else $execOut = $command." < ".$filename_in;

		$output = shell_exec($execOut);

		if (file_exists($testcasePath)) {
			$mOutput = array();
			$moreOutput = array();
			$testCases = 0;
			if ($opMoreOutput = opendir($testcaseOutputPath)) {
				while (false !== ($file = readdir($opMoreOutput))) {
					if (!in_array($file, $blacklist)) {
						$toutputline = file_get_contents($testcaseOutputPath.$file);
						$mOutput[] = $toutputline;
						$testCases++;
					}
				}
				closedir($opMoreOutput);
			}
			if ($handle = opendir($testcaseInputPath)) {
				while (false !== ($file = readdir($handle))) {
					if (!in_array($file, $blacklist)) {
						$moreout = $command." < ".$testcaseInputPath.$file;
						$moreoutput = shell_exec($moreout);
						$moreOutput[] = $moreoutput;
					}
				}
				closedir($handle);
			}
		}
	} else echo "<div class='console error console-bottom bold'>Errors fetched:</div> <div class='console error non-icon'>$error</div>";

	$file_out = fopen($filename_out, "w+");
	fwrite($file_out, $output);
	fclose($file_out);
	exec("chmod -R 777 $filename_out"); 

	sort($moreOutput);
	sort($mOutput);
	$countCompare = count($compare);
	$okCount = $testCases - $countCompare;
	$okPercent = $okCount/$testCases * 100;
	if ($output) {
		if (!$sOutput) echo "<div class='console success bold'>Compile complete. <Not found sample output data></div> ";
		else if ($sOutput == $output) echo "<div class='console success bold'>Compile complete. You rock!</div> ";
		else echo "<div class='console warning bold'>Compile complete but output not match. You may wanna check again?</div> ";
		if (file_exists($testcasePath) && $testCases > 0) {
			if ($okPercent == 100) echo "<div class='console success console-bottom bold'>Percentage of correct tests: $okPercent%</div>";
			else echo "<div class='console warning console-bottom bold'>Percentage of correct tests: $okPercent%</div>";
		}
		echo "<div class='console non-icon'><b>Output</b><br/>$output</div>";
	}

//	exec("rm $filename_code");
	exec("rm $filename_in");
	exec("rm $filename_error");
?>
