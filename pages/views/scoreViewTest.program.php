<?php $tsk = getRecord('test_submit', "`tid` = '$e' AND `uid` = '$uid' ");
$rCode = $eInfo = getRecord('course_test', "`id` = '$e'");
$mCodeAr = rCode($tsk['results_code']);
$zii = explode('/', $eInfo['zcode']);
$au = getRecord('members', "`id` = '{$tsk['uid']}' ");
include 'system/scoreView.php'; ?>

<div class="done-data"></div>

<div class="form-submit-task form-submit-test exam-do" data-task="<?php echo $t ?>">
	<div class="mi-content task-exam-do">
<div class="tsk-list">
	<div class="exam-do-info">
		<div class="main-title left" style="position:relative;width:100%;margin-bottom:-2px!important;line-height:30px">
			<?php if ($eInfo['prefix']) echo '<span class="prefix">'.$eInfo['prefix'].'</span>';
			echo '<h4 class="a-title" style="margin-bottom:-2px!important;line-height:30px">'.$eInfo['title'].'</h4>' ?>
			<div class="label label-info right" style="margin:6px 7px 0!important"><?php echo $cInfo['language'] ?></div>
			<div class="left" style="margin-bottom:-5px">
				by <a class="cuprum" style="font-size:15px" href="#!user?u=<? echo $au['id'] ?>"><? echo $au['username'] ?></a>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="one-task grading selected" data-task="grading">
		<div class="task-quest"><b>Grading</b></div>
	</div>
<? if ($eInfo['problem']) { ?>	
	<div class="one-task problem" data-task="problem">
		<div class="task-quest"><b>Problem</b></div>
	</div>
<? }
for ($j = 0; $j < count($zii); $j++) {
	$tske = $zii[$j];
	$tskeDir = MAIN_PATH.'/data/test/'.$eInfo['code'].'/'.$tske.'/';
	$tskeOutputFile = $tskeDir.'output.txt';

	$tskeMyDir = MAIN_PATH.'/data/test/'.$eInfo['code'].'/'.$tske.'/'.$au['username'].'/';
	$tskeMyOutputFile = $tskeMyDir.'compile.output.txt';
	$tskeMyCodeFile = $tskeMyDir.'main.'.$cInfo['language_code'];

	$eOutput = '';
	$eOutputFile = fopen($tskeOutputFile, 'r');
	while ($outputline = fgets($eOutputFile)) $eOutput .= $outputline;
	fclose($eOutputFile);

	$mOutput = '';
	$myOutputFile = fopen($tskeMyOutputFile, 'r');
	while ($moutputline = fgets($myOutputFile)) $mOutput .= $moutputline;
	fclose($myOutputFile);
	
	$tskeCorrectTestPer = $mCodeAr['answer'.$tske];
	if ($tskeCorrectTestPer == 100) $clasFortest = 'success';
	else $clasFortest = 'warning'; ?>
	<div class="one-task program" data-task="<?php echo $zii[$j] ?>">
		<div class="task-quest">
			<? if (!$eOutput) echo '<img src="'.IMG.'/warning.png"/>';
			else if (!$mOutput) echo '<img style="margin-top:-3px" src="'.IMG.'/error.png"/>';
			else if ($mOutput == $eOutput) echo '<img src="'.IMG.'/success.png"/>';
			else echo '<img style="margin-top:-3px" src="'.IMG.'/warning.png"/>'; ?>
			<span class="gensmall correct-test-percent"></span>
			<? if ($tskeCorrectTestPer) echo '<span class="console '.$clasFortest.' non-icon">'.$tskeCorrectTestPer.'%</span>' ?>
			<b>Task <? echo $zii[$j] ?></b>
		</div>
	</div>
<? } ?>
</div>

<div class="form-list score-board">
	<form class="borderwrap score-form task-do task-exam-do" id="taskgrading" data-action="<?php echo 'c='.$c.'&t=score&e='.$e.'&u='.$uid ?>">
		<div class="plain score">
			<?php if ($tsk['grade'] != 0) echo '<div class="time-grade gensmall" title="Time grading"><i class="fa fa-clock-o"></i> '.$tsk['time_grade'].'</div>' ?>
			<div class="score-square">
		<?php if ($tsk['grade'] != 0) echo '<input type="text" name="score" disabled value="'.$tsk['grade'].'"/>';
			else {
				if ($cInfo['uid'] == $u) echo '<input type="text" name="score"/>';
				else echo '<input type="text" name="score" disabled/>';
			}?>
			</div>
			<div class="text-square">
		<?php if ($tsk['grade'] != 0) echo $tsk['comment'];
			else {
				if ($cInfo['uid'] == $u) echo '<textarea name="score-comment" placeholder="Comments here...."/>';
				else echo '<textarea name="score-comment">'.$tsk['comment'].'</textarea>';
			}?>
			</div>
			<?php if ($tsk['grade'] == 0 && $cInfo['uid'] == $u) echo '<input type="submit" class="right submit-score" value="Submit" style="margin-top:6px"/>' ?>
		</div>
		<div class="welcome-grading-screen">
<? if ($cInfo['uid'] == $u) { ?>
			<h3>Welcome to program task grading.</h3>
			Hello, <? echo $member['username'] ?>! <br/>
			This is program test grading conference.<br/>
			You might notice it's a bit different from others.<br/><br/>
			Basically you still can give them score and comment using the form above.<br/>
			What's different here is that we integrated ace editor in grading form also so that you can easily check out the source.<br/>
			The disadvantage of this is that you're no longer able to add comment to each line of submitters' solution.<br/>
			For avoiding destructive behavior, we currently do not allow educators to edit students code, therefore you can't add comment in code.<br/>
			Anyhow, we may support this feature stronger in near future.<br/><br/>
			Get more details and supports <a class="bold">here</a>
<? } ?>
		</div>
	</form>
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
	$testcasePath = $tskeDir.'testcase/';
	$testcaseInputPath = $testcasePath.'input/';
	$testcaseOutputPath = $testcasePath.'output/';
	$tskeProbFile = $tskeDir.'problem.txt';
	$tskeSampleFile = $tskeDir.'sample.'.$cInfo['language_code'];

	$tskeMyDir = MAIN_PATH.'/data/test/'.$eInfo['code'].'/'.$tske.'/'.$au['username'].'/';
	$tskeMyOutputFile = $tskeMyDir.'compile.output.txt';
	$tskeMyCodeFile = $tskeMyDir.'main.'.$cInfo['language_code']; ?>
	<div class="task-do task-exam-do hide" id="task<? echo $tske ?>">
			<div class="action-top">
				<div class="done-data"></div>
			</div>
			<div class="task-solution">
				<div class="compile-code" id="m_tab">
					<div class="compile-header m_tab">
						<? if (file_exists($tskeProbFile)) echo '<div class="tab" id="problem-tab">Problem</div>' ?>
						<div class="tab" id="sample-code">sample.<? echo $cInfo['language_code'] ?></div>
						<div class="tab active" id="my-code">main.<? echo $cInfo['language_code'] ?></div>
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
										$etInput = '';
										$etInputFile = fopen($testcaseInputPath.$file, 'r');
										while ($tinputline = fgets($etInputFile)) $etInput .= $tinputline;
										fclose($etInputFile);
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
										$etOutput = '';
										$etOutputFile = fopen($testcaseOutputPath.$file, 'r');
										while ($toutputline = fgets($etOutputFile)) $etOutput .= $toutputline;
										fclose($etOutputFile);
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
						<div class="right task-tab-button"><a class="btn btn-success compile-code-submit">Compile</a></div>
						<textarea name="task-solution-<? echo $tske ?>" class="textarea-my-code required non-sce hide" id="t<? echo $tske ?>" style="height:160px"></textarea>
						<input type="hidden" class="code-file-name" value="main"/>
						<input type="hidden" class="input-file" value="<? echo $tskeInputFile ?>"/>
						<input type="hidden" class="output-file" value="<? echo $tskeOutputFile ?>"/>
						<input type="hidden" class="dir-to-compile" name="dir-to-compile-<? echo $tske ?>" value="<? echo $tskeDir.$member['username'] ?>"/>
						<input type="hidden" class="testcase-dir" name="testcase-dir-<? echo $tske ?>" value="<? echo $testcasePath ?>"/>
						<input type="hidden" class="correct-test-per" name="correct-test-per-<? echo $tske ?>"/>
						<div class="code-language hide"><?php echo $cInfo['language_code'] ?></div>
<div id="ace-editor<? echo $tske ?>" alt="<? echo $tske ?>" class="ace-editor"><?
	$eMyCode = '';
	$eMyOp = fopen($tskeMyCodeFile, 'r');
	while ($mycodeline = fgets($eMyOp)) $eMyCode .= $mycodeline;
	fclose($eMyOp);
	$sCha = array('<', '>');
	$rCha   = array('&lt;', '&gt;');
	$eMyCode = str_replace($sCha, $rCha, $eMyCode);
	echo $eMyCode; ?></div>
					</div>


					<div class="compile-code-form hide tab-indexs sample-code">
						<div class="compile-window">
							<div class="compile-window-head">Compile window</div>
							<div class="compile-window-content">
								<div class="code">
									<div class="console error hide" id="errorCode"></div>
									<span id="compile-output"></span>
								</div>
							</div>
						</div>
						<div class="right task-tab-button"><a class="btn btn-success compile-code-submit">Compile</a></div>
						<textarea class="textarea-my-code required non-sce hide" id="t<? echo $tske ?>" style="height:160px"></textarea>
						<input type="hidden" class="code-file-name" value="sample"/>
						<input type="hidden" class="input-file" value="<? echo $tskeInputFile ?>"/>
						<input type="hidden" class="output-file" value="<? echo $tskeOutputFile ?>"/>
						<input type="hidden" class="dir-to-compile" name="dir-to-compile-<? echo $tske ?>" value="<? echo $tskeDir ?>"/>
						<input type="hidden" class="testcase-dir" name="testcase-dir-<? echo $tske ?>" value="<? echo $testcasePath ?>"/>
						<input type="hidden" class="correct-test-per" name="correct-test-per-<? echo $tske ?>"/>
						<div class="code-language hide"><?php echo $cInfo['language_code'] ?></div>
<div id="ace-editor<? echo $tske ?>-sample" alt="<? echo $tske ?>" class="ace-editor"><?
	$eSampleCode = '';
	$eSpOp = fopen($tskeSampleFile, 'r');
	while ($sampleline = fgets($eSpOp)) $eSampleCode .= $sampleline;
	fclose($eSpOp);
	$sCha = array('<', '>');
	$rCha   = array('&lt;', '&gt;');
	$eSampleCode = str_replace($sCha, $rCha, $eSampleCode);
	echo $eSampleCode; ?></div>
					</div>
				</div>
			</div>
	</div>
<? } ?>
</div>
	</div>
</div>


<?	$aceTheme = 'ambiance';
	$aceMode = $cInfo['ace_code'] ?>
<script src="<?php echo PLUGINS ?>/ace/src/ace.js"></script>
<script src="<?php echo PLUGINS ?>/ace/src/mode-<? echo $aceMode ?>.js"></script>
<script src="<?php echo PLUGINS ?>/ace/src/theme-<? echo $aceTheme ?>.js"></script>
<script>ace_theme = '<? echo $aceTheme ?>';
ace_mode = '<? echo $aceMode ?>';
$(document).ready(function() {
<? 	for ($k = 0; $k < count($zii); $k++) { ?>
		var ace_editor<? echo $zii[$k] ?> = ace.edit('ace-editor<? echo $zii[$k] ?>');
		ace_editor<? echo $zii[$k] ?>.setTheme("ace/theme/"+ace_theme);
		ace_editor<? echo $zii[$k] ?>.getSession().setMode("ace/mode/"+ace_mode);
		ace_editor<? echo $zii[$k] ?>.setReadOnly(true);
		var ace_editor<? echo $zii[$k] ?>sample = ace.edit('ace-editor<? echo $zii[$k] ?>-sample');
		ace_editor<? echo $zii[$k] ?>sample.setTheme("ace/theme/"+ace_theme);
		ace_editor<? echo $zii[$k] ?>sample.getSession().setMode("ace/mode/"+ace_mode);
		ace_editor<? echo $zii[$k] ?>sample.setReadOnly(true);
		$('.task-do#task<? echo $zii[$k] ?> .compile-code-submit').click(function () {
			$('.task-do#task<? echo $zii[$k] ?>').find('.my-code .textarea-my-code').val(ace_editor<? echo $zii[$k] ?>.getSession().getValue());
			$('.task-do#task<? echo $zii[$k] ?>').find('.sample-code .textarea-my-code').val(ace_editor<? echo $zii[$k] ?>sample.getSession().getValue());
		});
		$('.form-submit-test').submit(function () {
			$('.task-do#task<? echo $zii[$k] ?>').find('.textarea-my-code').val(ace_editor<? echo $zii[$k] ?>.getSession().getValue());
		});
<? 	} ?>
}); </script>
<script src="<?php echo JS ?>/compile.js"></script>

<script src="<?php echo JS ?>/scoreView.program.js"></script>
