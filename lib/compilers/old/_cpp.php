<?php
	$CC="g++";
	$out = "./a.out";
	$code=$_POST["code"];
	$input = $_POST["input"];
	$inputFile = $_POST["inputFile"];
//	$dir=$_POST["dir"];

//	copy($inputFile, $dir.'/input.txt');
//	chmod($dir.'/input.txt', 0777);

	$fh = fopen($inputFile, 'r+');
	while ($line = fgets($fh)) $input .= $line;
	fclose($fh);

	exec("cd $dir");

//	exec("cp -R $inputFile $dir./input.txt");

	$filename_code = "main.cpp";
//	$filename_in = $inputFile;
	$filename_in = "input.txt";
	$filename_error = "error.txt";
	$filename_cmd = "cmd.txt";
	
	$executable = "a.out";
	$command = $CC." -lm ".$filename_code;	
	$command_error = $command." 2>".$filename_error;

	//if(trim($code)=="")
	//die("The code area is empty");
	$file_code=fopen($filename_code, "w+");
//	if ($file_code == true) echo ' Opened!';
	fwrite($file_code, $code);
	fclose($file_code);

	$file_in=fopen($filename_in, "w+");
	fwrite($file_in, $input);
	fclose($file_in);

//	$file_cmd=fopen($filename_cmd, "w+");
//	fwrite($file_cmd, $command.'~~~~~~~~~'.$command_error);
//	fclose($file_cmd);

	exec("chmod -R 777 $filename_code"); 
	exec("chmod -R 777 $filename_in"); 
	exec("chmod -R 777 $executable"); 
	exec("chmod -R 777 $filename_error");	

//	shell_exec($command_error);
	exec($command_error);
	$error = file_get_contents($filename_error);

	if (trim($error) == "") {
		if (trim($input)=="") {
			$output=shell_exec($out);
		} else {
			$out=$out." < ".$filename_in;
			$output = shell_exec($out);
		} echo "<p>$output</p>";
	} else if (!strpos($error, "error")) {
		echo "<p>Fetched some errors:</p> <p>$error</p>";
		if (trim($input)=="") {
			$output=shell_exec($out);
		} else {
			$out=$out." < ".$filename_in;
			$output=shell_exec($out);
		}
		echo "<p>$output</p>";
	} else echo "<p>Fetched some errors:</p> <p>$error</p>";

	exec("rm $filename_code");
	exec("rm $filename_in");
	exec("rm $filename_error");
	exec("rm $executable");
?>
