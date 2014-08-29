<div class="alerts alert-info">This course belongs to program dot. Tasks and exams in program dot is a bit different from others.</div>
<? $zii = explode('/', $eInfo['zcode']);
$checkSubmit = countRecord('test_submit', "`tid` = '$e' AND `uid` = '$u' ");
	if ($cInfo['uid'] == $u) echo '<div class="alerts alert-info">You\'re the course creator.</div>';
	else if (countRecord('test_submit', "`tid` = '$e' AND `uid` = '$u' ") > 0)
		echo '<div class="alerts alert-info">You already submitted this test. You might wanna check your <a href="#!course?c='.$c.'&t=score&e='.$e.'&u='.$u.'">score</a>.</div>';
	if ($_GET['act'] == 'submit' || $_GET['act'] == 'save') {
		if ($checkSubmit <= 0) {
			$myResultsCode = '';
			for ($y = 0; $y < count($zii); $y++) {
				$tskf = $zii[$y];
				$exDir = $_POST['dir-to-compile-'.$tskf];
				$exAnswer = $_POST['task-solution-'.$tskf];
				$exCorrectTest = $_POST['correct-test-per-'.$tskf];
//				if (!$exCorrectTest) $exCorrectTest = '';
				$myResultsCode .= '@code['.$tskf.'::'.$exDir.'::'.$exCorrectTest.']';
			}
			$myResultsCode = _content($myResultsCode);
			changeValue('countdown', "`tid` = '$e' AND `uid` = '$u' ", "`results_code` = '$myResultsCode' ");
			if ($_GET['act'] == 'submit') mysql_query("INSERT INTO `test_submit` (`cid`, `tid`, `uid`, `results_code`, `time`) VALUES ('$c', '$e', '$u', '$myResultsCode', '$time')");
			if ($_GET['act'] == 'save') changeValue('countdown', "`tid` = '$e' AND `uid` = '$u' ", "`leave_time` = '$now' ");
		}
	}
//	if ($_GET['act'] == 'public') changeValue('test_submit', "`tid` = '$e' ", "`public` = 'yes' ");
 ?>

<div class="done-data"></div>

<form class="form-submit-task form-submit-test exam-do" data-task="<?php echo $t ?>">
	<div class="mi-content task-exam-do">
<div class="tsk-list">
	<div class="exam-do-info">
		<div class="main-title left" style="position:relative;width:100%;margin-bottom:-2px!important;line-height:30px">
			<?php if ($eInfo['prefix']) echo '<span class="prefix">'.$eInfo['prefix'].'</span>';
			echo '<h4 class="a-title" style="margin-bottom:-2px!important;line-height:30px">'.$eInfo['title'].'</h4>' ?>
			<div class="submit-button right" style="margin-right:7px">
<!--				<a class="btn btn-primary disabled btn-sm task-submit right<?php if ($myTaskSubmit && $myTaskSubmit['grade'] != 0) echo ' dis' ?>">Submit</a> -->
			<? if ($cInfo['uid'] != $u) {
				if ($checkSubmit <= 0) echo '<input type="submit" class="btn-sm" value="Submit"/>';
				else echo '<input type="submit" disabled class="btn-sm" value="Submit"/>';
			} ?>
			</div>
			<div class="label label-info right" style="margin:6px 7px 0!important"><?php echo $cInfo['language'] ?></div>
	<? if ($checkSubmit <= 0 && $cInfo['uid'] != $u) echo '<div id="time" class="time-countdown left" style="margin-top:0;padding:2px 12px 2px"><span id="countdown"><span class="count-min"></span> : <span class="count-sec"></span></span></div>' ?>
		</div>
		
		<div class="clearfix"></div>
	</div>
	<div class="one-task selected program" data-task="starting">
		<div class="task-quest"><b>Getting started</b></div>
	</div>
<? if ($eInfo['problem']) { ?>	
	<div class="one-task problem program" data-task="problem">
		<div class="task-quest"><b>Problem</b></div>
	</div>
<? }
for ($j = 0; $j < count($zii); $j++) { ?>
	<div class="one-task program" data-task="<?php echo $zii[$j] ?>">
		<div class="task-quest"><b>Task <? echo $zii[$j] ?></b></div>
	</div>
<? } ?>
</div>
<div class="form-list">
	<div class="task-do task-exam-do" id="taskstarting">
		<? if ($checkSubmit > 0) echo '<div class="alerts alert-success">You submitted your test.</div>';
		else if ($label == 'danger') echo '<div class="alerts alert-error">Deadline passed. You cannot work on this anymore.</div>' ?>
		<br/>
		<h2>Hello, <? echo $member['username'] ?></h2>
		You might notice this preference is a bit different from other test completing page.<br/>
		This is because the course you're watching belongs to a program dot.<br/>
		We build this preference to help you code more conviniently.<br/><br/>
		<h3>How convinient?</h3>
		Well, you can code and compile your code right here, in this area.<br/>
		After submitting your code, you can view the sample code (posted by the course creator, not developer team) and compare with yours, right here or in the result page.<br/>
		Since the sample code is uploaded by the course creator and it's optional, so it might be unavailable.
	</div>
<? if ($eInfo['problem']) { ?>	
	<div class="exam-pdf-views task-do task-exam-do hide" id="taskproblem">
		<? echo '<iframe class="iframe-document" src="'.PLUGINS.'/pdf-viewer/web/viewer.php?url='.$eInfo['problem'].'"></iframe>' ?>
	</div>
<? } ?>
<? for ($jk = 0; $jk < count($zii); $jk++) {
	$tske = $zii[$jk];
	$tskeDir = MAIN_PATH.'/data/test/'.$eInfo['code'].'/'.$tske.'/';
	$tskeInputFile = $tskeDir.'input.txt';
	$tskeOutputFile = $tskeDir.'output.txt';
	$tskeProbFile = $tskeDir.'problem.txt';
	$tskeSampleFile = $tskeDir.'sample.'.$cInfo['language_code'];
	$tskeMyCodeFile = $tskeDir.$member['username'].'/main.'.$cInfo['language_code'];
	$testcasePath = $tskeDir.'testcase/';
	$testcaseInputPath = $testcasePath.'input/';
	$testcaseOutputPath = $testcasePath.'output/' ?>
		<div class="task-do task-exam-do hide" id="task<? echo $tske ?>">
			<div class="action-top">
				<div class="done-data"></div>
			</div>
			<div class="task-solution">
				<div class="compile-code" id="m_tab">
					<div class="compile-header m_tab">
						<? if (file_exists($tskeProbFile)) echo '<div class="tab" id="problem-tab">Problem</div>' ?>
						<? if (file_exists($tskeSampleFile) && $cInfo['uid'] == $u) echo '<div class="tab active" id="sample-code">sample.'.$cInfo['language_code'].'</div>';
						else if (file_exists($tskeSampleFile) && ($checkSubmit > 0 || $label == 'danger') ) echo '<div class="tab" id="sample-code">sample.'.$cInfo['language_code'].'</div>' ?>
						<? if ($cInfo['uid'] != $u) echo '<div class="tab active" id="my-code">main.'.$cInfo['language_code'].'</div>' ?>
						<? if (file_exists($tskeInputFile) || file_exists($tskeOutputFile)) echo '<div class="tab" id="sample-io">Input/output</div>' ?>
					</div>
		<? 	if (file_exists($tskeInputFile) || file_exists($tskeOutputFile)) {
				$eInput = '';
				$eInputFile = fopen($tskeInputFile, 'r');
				while ($inputline = fgets($eInputFile)) $eInput .= $inputline;
				fclose($eInputFile);
				$eOutput = '';
				$eOutputFile = fopen($tskeOutputFile, 'r');
				while ($outputline = fgets($eOutputFile)) $eOutput .= $outputline;
				fclose($eOutputFile); ?>
					<div class="hide tab-indexs sample-io">
						<div class="main-test-case">
							<div class="s-input left">
								<h4>Input</h4>
								<div class="m-input"><? echo $eInput ?></div>
							</div>
							<div class="s-output right">
								<h4>Output</h4>
								<div class="m-output"><? echo $eOutput ?></div>
							</div>
							<div class="clearfix"></div>
						</div>
				<? if (file_exists($testcasePath)) { ?>
						<div class="more-test-case">
							<h3>More testcases</h3>
							<div class="s-input left">
								<h4>Input</h4>
							<? 	$inputFiles = 0;
								$mInputListFiles = array();
								if ($handle = opendir($testcaseInputPath)) {
									while (false !== ($file = readdir($handle))) {
										if (!in_array($file, $blacklist)) {
											$inputFiles++;
											$mInputListFiles[] = $file;
										}
									}
									closedir($handle);
									sort($mInputListFiles);
									foreach($mInputListFiles as $file) {
										$etInput = file_get_contents($testcaseInputPath.$file);
										echo '<div class="m-input">'.$etInput.'</div>';
									}
								} ?>
							</div>
							<div class="s-output right">
								<h4>Output</h4>
							<? 	$outputFiles = 0;
								$mOutputListFiles = array();
								if ($handle = opendir($testcaseOutputPath)) {
									while (false !== ($file = readdir($handle))) {
										if (!in_array($file, $blacklist)) {
											$outputFiles++;
											$mOutputListFiles[] = $file;
										}
									}
									closedir($handle);
									sort($mOutputListFiles);
									foreach($mOutputListFiles as $file) {
										$etOutput = file_get_contents($testcaseOutputPath.$file);
										echo '<div class="m-output">'.$etOutput.'</div>';
									}
								} ?>
							</div>
							<div class="clearfix"></div>
						</div>
				<? } ?>
					</div>
		<? 	} ?>
		<? 	if (!$eInfo['problem']) {
				$eProb = '';
				$eProblem = fopen($tskeProbFile, 'r');
				while ($probline = fgets($eProblem)) $eProb .= $probline;
				fclose($eProblem) ?>
					<div class="hide tab-indexs problem-tab">
						<? echo $eProb ?>
					</div>
		<? 	} ?>
		
		<? if ($cInfo['uid'] != $u) { ?>
					<div class="compile-code-form tab-indexs my-code">
						<div class="compile-window">
							<div class="compile-window-head">Compile window</div>
							<div class="compile-window-content">
								<div class="code">
									<div class="console error hide" id="errorCode"></div>
									<span id="compile-output"></span>
								</div>
							</div>
						</div>
						<div class="right task-tab-button"><a class="btn btn-success compile-code-submit" alt="my-code">Compile</a></div>
						<textarea name="task-solution-<? echo $tske ?>" class="textarea-my-code required non-sce hide" id="t<? echo $tske ?>" style="height:160px"></textarea>
						<input type="hidden" class="code-file-name" value="main"/>
						<input type="hidden" class="input-file" value="<? echo $tskeInputFile ?>"/>
						<input type="hidden" class="output-file" value="<? echo $tskeOutputFile ?>"/>
						<input type="hidden" class="dir-to-compile" name="dir-to-compile-<? echo $tske ?>" value="<? echo $tskeDir.$member['username'] ?>"/>
						<input type="hidden" class="testcase-dir" name="testcase-dir-<? echo $tske ?>" value="<? echo $testcasePath ?>"/>
						<input type="hidden" class="correct-test-per" name="correct-test-per-<? echo $tske ?>"/>
						<div class="code-language hide"><?php echo $cInfo['language_code'] ?></div>
<div id="ace-editor<? echo $tske ?>" alt="<? echo $tske ?>" class="ace-editor"><? 
if (file_exists($tskeMyCodeFile)) {
	$eMyCode = '';
	$eMyOp = fopen($tskeMyCodeFile, 'r');
	while ($mycodeline = fgets($eMyOp)) $eMyCode .= $mycodeline;
	fclose($eMyOp);
	$sCha = array('<', '>');
	$rCha   = array('&lt;', '&gt;');
	$eMyCode = str_replace($sCha, $rCha, $eMyCode);
	echo $eMyCode;
} ?></div>
					</div>
			<? } ?>


<? if ($checkSubmit > 0 || $cInfo['uid'] == $u || $label == 'danger')  { ?>
					<div class="compile-code-form <? if ($cInfo['uid'] != $u) echo 'hide' ?> tab-indexs sample-code">
						<div class="compile-window">
							<div class="compile-window-head">Compile window</div>
							<div class="compile-window-content">
								<div class="code">
									<div class="console error hide" id="errorCode"></div>
									<span id="compile-output"></span>
								</div>
							</div>
						</div>
						<div class="right task-tab-button"><a class="btn btn-success compile-code-submit" alt="my-code">Compile</a></div>
						<textarea class="textarea-my-code required non-sce hide" id="t<? echo $tske ?>" style="height:160px"></textarea>
						<input type="hidden" class="code-file-name" value="sample"/>
						<input type="hidden" class="input-file" value="<? echo $tskeInputFile ?>"/>
						<input type="hidden" class="output-file" value="<? echo $tskeOutputFile ?>"/>
						<input type="hidden" class="dir-to-compile" name="dir-to-compile-<? echo $tske ?>" value="<? echo $tskeDir ?>"/>
						<input type="hidden" class="testcase-dir" name="testcase-dir-<? echo $tske ?>" value="<? echo $testcasePath ?>"/>
						<input type="hidden" class="correct-test-per" name="correct-test-per-<? echo $tske ?>"/>
						<div class="code-language hide"><?php echo $cInfo['language_code'] ?></div>
<div id="ace-editor<? echo $tske ?>-sample" alt="<? echo $tske ?>" class="ace-editor"><?
if (file_exists($tskeSampleFile)) {
	$eSampleCode = '';
	$eSpOp = fopen($tskeSampleFile, 'r');
	while ($sampleline = fgets($eSpOp)) $eSampleCode .= $sampleline;
	fclose($eSpOp);
	$sCha = array('<', '>');
	$rCha   = array('&lt;', '&gt;');
	$eSampleCode = str_replace($sCha, $rCha, $eSampleCode);
	echo $eSampleCode;
} ?></div>
					</div>
<? } ?>


				</div>
			</div>
		</div>
<? } ?>
</div>
	</div>
</form>


<script>var mins = <? echo $eInfo['test_time'] ?>;</script>
<script src="<? echo JS ?>/examView.program.js"></script>
<?	$aceTheme = 'ambiance';
	$aceMode = $cInfo['ace_code'] ?>
<script src="<?php echo PLUGINS ?>/ace/src/ace.js"></script>
<script src="<?php echo PLUGINS ?>/ace/src/mode-<? echo $aceMode ?>.js"></script>
<script src="<?php echo PLUGINS ?>/ace/src/theme-<? echo $aceTheme ?>.js"></script>
<script>ace_theme = '<? echo $aceTheme ?>';
ace_mode = '<? echo $aceMode ?>';
$(document).ready(function() {
<? for ($k = 0; $k < count($zii); $k++) { ?>
<? 	if ($cInfo['uid'] != $u) { ?>
	var ace_editor<? echo $zii[$k] ?> = ace.edit('ace-editor<? echo $zii[$k] ?>');
		ace_editor<? echo $zii[$k] ?>.setTheme("ace/theme/"+ace_theme);
		ace_editor<? echo $zii[$k] ?>.getSession().setMode("ace/mode/"+ace_mode);
<? 		if ($checkSubmit > 0 || $label == 'danger') echo 'ace_editor'.$zii[$k].'.setReadOnly(true);';
	} ?>
<? if (file_exists($tskeSampleFile)) { ?>
	var ace_editor<? echo $zii[$k] ?>sample = ace.edit('ace-editor<? echo $zii[$k] ?>-sample');
		ace_editor<? echo $zii[$k] ?>sample.setTheme("ace/theme/"+ace_theme);
		ace_editor<? echo $zii[$k] ?>sample.getSession().setMode("ace/mode/"+ace_mode);
		ace_editor<? echo $zii[$k] ?>sample.setReadOnly(true);
<? } ?>
		$('.task-do#task<? echo $zii[$k] ?> .compile-code-submit').click(function () {
	<? if ($cInfo['uid'] != $u) { ?>
			$('.task-do#task<? echo $zii[$k] ?>').find('.my-code .textarea-my-code').val(ace_editor<? echo $zii[$k] ?>.getSession().getValue());
	<? } ?>
<? if (file_exists($tskeSampleFile)) { ?>
			$('.task-do#task<? echo $zii[$k] ?>').find('.sample-code .textarea-my-code').val(ace_editor<? echo $zii[$k] ?>sample.getSession().getValue());
<? } ?>
		});
	<? if ($cInfo['uid'] != $u) { ?>
		$('.form-submit-test').submit(function () {
			$('.task-do#task<? echo $zii[$k] ?>').find('.textarea-my-code').val(ace_editor<? echo $zii[$k] ?>.getSession().getValue());
		});
	<? } ?>
<? 	} ?>
})
</script>
<script src="<?php echo JS ?>/compile.js"></script>
<? if ($checkSubmit <= 0 && $cInfo['uid'] != $u && $label != 'danger') echo '<script src="'.JS.'/examDo.js"></script>' ?>
