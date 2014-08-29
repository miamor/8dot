<? include '../lib/config.php';
$blacklist = array('.', '..');
$languageID = $_POST["language"];
$dir = $_POST["dir"];
$code = $_POST["code"];
// $input = $_POST["input"];
$fileCodeName = $_POST['codeFileName'];
$input = '';
$inputFile = $_POST["inputFile"];
$outputFile = $_POST["outputFile"];
$testcasePath = $_POST["testcaseDir"];
$testcaseInputPath = $testcasePath.'input/';
$testcaseOutputPath = $testcasePath.'output/';
$filename_out = $dir.'/compile.output.txt';
$uName = $member['username'];
if (!file_exists($dir) ) {
	mkdir ($dir, 0777);
}
chmod($dir, 0777);
if (file_exists($dir) ) {
	switch ($languageID)
		{
			case "c": {
				include("../lib/compilers/c.php");
				break;
			}
			case "cpp": {
				include("../lib/compilers/cpp.php");
				break;
			}
			case "java": {	
				include("../lib/compilers/java.php");
				break;
			}
			case "python2.7": {
				include("../lib/compilers/python27.php");
				break;
			}
			case "python3.2": {
				include("../lib/compilers/python32.php");
				break;
			}
		}
	}
?>
