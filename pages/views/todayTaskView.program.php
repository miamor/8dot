<?php $sCha = array('<', '>');
$rCha   = array('&lt;', '&gt;');
	$checkSubmit = countRecord('daily_ex_submit', "`uid` = '$u' AND `iid` = '{$tsk['id']}' ");
	$tskEx = getRecord('daily_ex_submit', "`iid` = '{$tsk['id']}' AND `uid` = '$u' ");
	$totalSubmit = countRecord('daily_ex_submit', "`iid` = '{$tsk['id']}' ");
	$tskSs = $getRecord -> GET('daily_ex_submit', "`iid` = '{$tsk['id']}' ");
//	$tske = $zii[$jk];
	$tskeDir = MAIN_PATH.'/data/coding/'.$tsk['code'].'/';
	$tskeInputFile = $tskeDir.'input.txt';
	$tskeOutputFile = $tskeDir.'output.txt';
	$tskeProbFile = $tskeDir.'problem.txt';
	$tskeSampleFile = $tskeDir.'sample.'.$tsk['language_code'];
	$tskeMyCodeFile = $tskeDir.$member['username'].'/main.'.$tsk['language_code'];
	$testcasePath = $tskeDir.'testcase/';
	$testcaseInputPath = $testcasePath.'input/';
	$testcaseOutputPath = $testcasePath.'output/';
	if ($_GET['act'] == 'submit') {
		$mySolution = _content($_POST['task-solution-'.$tsk['id']]);
		$myResult = _content($_POST['correct-test-per-'.$tsk['id']]);
		if ($checkSubmit <= 0) {
			$ad = mysql_query("INSERT INTO `daily_ex_submit` (`answer`, `file`, `result`, `uid`, `iid`, `time`) VALUES ('$mySolution', '$tskeMyCodeFile', '$myResult', '$u', '$e', '$current')");
			if ($ad) echo '<div class="alerts alert-success">Your work has been submitted successfully.</div>';
			else echo '<div class="alerts alert-error">Oops! Something went wrong when trying to submit your work. Please contact the administrators for more details and supports.</div>';
		}
	} else { ?>

<? if ($tsk['uid'] == $u) echo '<div class="form-submit-daily-task '.$dInfo['type'].'" data-task="'.$e.'">';
else echo '<form class="form-submit-daily-task '.$dInfo['type'].'" data-task="'.$e.'">' ?>
	<div class="mi-content task-exam-do">
		<div class="tsk-list daily-task-do">
			<div class="daily-ex-info <?php echo $tsk['id'].' '.$tsk['type'] ?>">
				<input type="submit" value="Submit" <? if ($member['type'] != 'student' || $checkSubmit > 0) echo 'disabled' ?> style="margin-top:-5px" class="task-submit right">
				<h3 class="text-primary" style="margin-top:15px!important"><? echo $tsk['title'] ?></h3>
				<div class="task-lv">
					<div class="slider slider-horizontal" style="width: 100%;" title="Difficult level: <? echo $tsk['hard_level'] * 10 ?>%">
						<div class="slider-track">
							<div class="slider-selection" style="left: 0%; width: <? echo $tsk['hard_level'] * 10 ?>%;"></div>
							<div class="slider-handle round" style="left: <? echo $tsk['hard_level'] * 10 ?>%;"></div>
							<div class="slider-handle round hide" style="left: 0%;"></div>
						</div>
					</div>
				</div>
				<div class="task-coin">
					<img src="<? echo silk ?>/coins_add.png" style="margin-top:-2px"/> Extra coins: <b title="Extra coins for solving this task"> <? echo $tsk['coin'] ?> </b>
				</div>
				<div class="done-data" style="margin:25px 0"></div>
				<div class="lib-auth-view-info" style="margin:5px 0 25px">
					<div class="gensmall">Submitted <span class="fa fa-clock-o"></span> <?php echo $tsk['time'] ?></div>
					<a href="#!user?u=<?php echo $tsk['uid'] ?>">
						<img class="lib-auth-thumbnai left" src="<?php echo $auth['avatar'] ?>"/>
						<?php echo $auth['username'] ?>
					</a>
					<div class="more-auth-info">
						<b><img src="<?php echo IMG ?>/ense110.png"/> <?php echo $auth['coin'] ?></b>
						<b><img src="<?php echo IMG ?>/table_10.png"/> <?php echo $auth['reputation'] ?></b>
					</div>
				</div>
			<? if ($checkSubmit > 0) {
				echo '<div class="check-get-coin">';
				if (!$tskEx['coin']) echo '<div class="console bold warning">You submitted your work, you can check if your result is correct in the window beside.<br/>We need to confirm your work before making decision of how much coin to transfer to you. <a href="">Learn more</a></div>';
				else echo '<div class="console success bold">'.$tskEx['coin'].' coins were successfully transfered to you.</div>';
				echo '</div>';
			} ?>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="form-list">
			<div class="task-do task-exam-do daily-task-do program" id="taskstarting">
				<div class="action-top">
					<div class="done-data"></div>
				</div>
				<div class="task-solution compile-code" id="m_tab">
					<div class="compile-header m_tab">
						<div class="left label label-info" style="margin:12px 10px 0 5px"><? echo $tsk['language'] ?></div>
						<div class="tab active" id="problem-tab">Problem</div>
						<? if ($tsk['answer'] && ($checkSubmit > 0 || $tsk['uid'] == $u) ) echo '<div class="tab" id="sample-solution">sample.'.$tsk['language_code'].'</div>' ?>
						<? if ($member['type'] == 'student') echo '<div class="tab" id="solve-problem">main.'.$tsk['language_code'].'</div>' ?>
						<? if (file_exists($tskeInputFile) || file_exists($tskeOutputFile)) echo '<div class="tab" id="sample-ios">Input/output</div>' ?>
						<div class="tab right" id="transfer-coin">Transfer coin manager</div>
						<div class="clearfix"></div>
					</div>


					<div class="tab-indexs problem-tab">
						<? echo $tsk['quest'] ?>
					</div>

<? if ($tsk['uid'] == $u && $totalSubmit > 0) { ?>
					<div class="hide tab-indexs transfer-coin">
						<div class="submitters-list col-md-4 no-padding">
	<? foreach ($tskSs as $tskS) {
		$oSer = getRecord('members^username', "`id` = '{$tskS['uid']}' ") ?>
							<div class="one-submitter rows" id="u<? echo $tskS['uid'] ?>" data-u="<? echo $tskS['uid'] ?>" data-e="<? echo $e ?>">
								<a class="select-user"><? echo $oSer['username'] ?></a>
			<? 	$eOutput = file_get_contents($tskeOutputFile);
			$tskeSOutputFile = $tskeDir.$oSer['username'].'/compile.output.txt';
			$mOutput = file_get_contents($tskeSOutputFile);
			if (!$eOutput) echo '<img style="margin-top:-3px" src="'.IMG.'/warning.png"/>';
			else if (!$mOutput) echo '<img style="margin-top:-3px" src="'.IMG.'/error.png"/>';
			else if ($mOutput == $eOutput) echo '<img src="'.IMG.'/success.png"/>';
			else echo '<img style="margin-top:-3px" src="'.IMG.'/warning.png"/>';
								$tskeCorrectTestPer = $tskS['result'];
								if ($tskeCorrectTestPer == 100) $clasFortest = 'success';
								else $clasFortest = 'warning';
								if ($tskeCorrectTestPer) echo '<span class="console '.$clasFortest.' non-icon">'.$tskeCorrectTestPer.'%</span>';
								echo '<span class="check-transfer-coin right">';
								if ($tskS['coin']) echo '<span class="left"><img src="'.silk.'/coins.png" style="margin-top:-2px"/> '.$tskS['coin'].' <img src="'.IMG.'/success.png"/></span>';
								echo '</span>' ?>
								<div class="ar-right"></div>
							</div>
	<? } ?>
						</div>
						<div class="submission-detail col-md-8"><span>
	<? if (!$uid) echo 'Choose one person from the left side.';
	else {
		$uin = getRecord('members^username', "`id` = '$uid' ");
		$tsku = getRecord('daily_ex_submit', "`uid` = '$uid' AND `iid` = '$e' ");
		$tskScode = file_get_contents($tskS['file']);
		$tskScode = str_replace($sCha, $rCha, $tskScode); ?>
						<div class="u-code compile-code-form">
							<div class="action-top right" style="margin:10px 150px 0 -0">
								<a class="btn btn-success compile-code-submit">Compile</a>
							</div>
							<textarea name="task-solution-<? echo $tsk['id'] ?>" class="textarea-my-code required non-sce hide" style="height:160px"><? echo $tskEx['solution'] ?></textarea>
							<input type="hidden" class="code-file-name" value="main"/>
							<input type="hidden" class="input-file" value="<? echo MAIN_PATH.$tsk['input'] ?>"/>
							<input type="hidden" class="output-file" value="<? echo MAIN_PATH.$tsk['output'] ?>"/>
							<input type="hidden" class="dir-to-compile" name="dir-to-compile-u" value="<? echo $tskeDir.$oSer['username'] ?>"/>
							<input type="hidden" class="testcase-dir" name="testcase-dir-u" value="<? echo $testcasePath ?>"/>
							<input type="hidden" class="correct-test-per" name="correct-test-per-u"/>
							<div class="hide code-language"><? echo $tsk['language_code'] ?></div>
							<div class="compile-window">
								<div class="compile-window-head">Compile window</div>
								<div class="compile-window-content">
									<div class="code">
										<div class="console error hide" id="errorCode"></div>
										<span id="compile-output"></span>
									</div>
								</div>
							</div>
<?		echo '<div id="ace-editor-u'.$tskS['uid'].'-code">'.$tskScode.'</div>'; ?>
						</div>
<? 		if ($_GET['do'] == 'transfercoin') {
			if (!$tsku['coin']) {
				$coinToAdd = $_POST['coin-to-transfer'];
				addRep($uid, $coinToAdd);
				changeValue('daily_ex_submit', "`iid` = '$e' AND `uid` = '$uid' ", "`coin` = '$coinToAdd' ");
				sendNoti('transfer-coin-daily-ex', $e, '', $uid, $coinToAdd);
			}
		}
		echo '<form class="daily-task-manage-bar" style="padding-top:0!important"><span>';
			if (!$tsku['coin']) echo '<input type="submit" value="Submit" class="right" style="margin-top:11px"/>';
			echo '<div class="line" style="margin-top:6px;width:80%">
				<div class="left" style="margin-top:6px;width:25%">';
				if (!$tsku['coin']) echo 'Coins to transfer';
				else echo 'Coins transfered';
			echo '</div>
				<div class="right" style="margin-left:0;width:73%">';
				if (!$tsku['coin']) echo '<input type="number" placeholder="Max: '.$tsk['coin'].'" name="coin-to-transfer" style="width:80%" min="0" max="'.$tsk['coin'].'"/>';
				else echo '<input type="number" disabled value="'.$tsku['coin'].'"style="width:80%" />';
			echo '<img src="'.silk.'/coins.png" style="margin-top:-2px;margin-left:5px"/> coins</div>
			</div>
		</span></form>';
	} ?>
						</span></div>
					</div>
<? } ?>


		<? 	if ($tsk['input'] || $tsk['output']) {
				$eInput = file_get_contents(MAIN_PATH.$tsk['input']);
				$eOutput = file_get_contents(MAIN_PATH.$tsk['output']); ?>
					<div class="hide tab-indexs sample-ios">
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


<? if ($member['type'] == 'student') { ?>
					<div class="hide compile-code-form tab-indexs solve-problem">
						<div class="action-top right" style="margin:10px 150px 0 -0">
							<a class="btn btn-success compile-code-submit">Compile</a>
						</div>
						<textarea name="task-solution-<? echo $tsk['id'] ?>" class="textarea-my-code required non-sce hide" style="height:160px"><? echo $tskEx['solution'] ?></textarea>
						<input type="hidden" class="code-file-name" value="main"/>
						<input type="hidden" class="input-file" value="<? echo MAIN_PATH.$tsk['input'] ?>"/>
						<input type="hidden" class="output-file" value="<? echo MAIN_PATH.$tsk['output'] ?>"/>
						<input type="hidden" class="dir-to-compile" name="dir-to-compile-<? echo $tsk['id'] ?>" value="<? echo $tskeDir.$member['username'] ?>"/>
						<input type="hidden" class="testcase-dir" name="testcase-dir-<? echo $tsk['id'] ?>" value="<? echo $testcasePath ?>"/>
						<input type="hidden" class="correct-test-per" name="correct-test-per-<? echo $tsk['id'] ?>"/>
						<div class="hide code-language"><? echo $tsk['language_code'] ?></div>
						<div class="compile-window">
							<div class="compile-window-head">Compile window</div>
							<div class="compile-window-content">
								<div class="code">
									<div class="console error hide" id="errorCode"></div>
									<span id="compile-output"></span>
								</div>
							</div>
						</div>
						<div id="ace-editor-my-code" class="ace-editor"><? $myCodeSession = file_get_contents($tskEx['file']);
$myCodeSession = str_replace($sCha, $rCha, $myCodeSession);
echo $myCodeSession; ?></div>
					</div>
<? } ?>

<? if ($tsk['answer'] && ($checkSubmit > 0 || $tsk['uid'] == $u) ) { ?>
					<div class="hide compile-code-form tab-indexs sample-solution">
						<div class="action-top right" style="margin:10px 150px 0 -0">
							<a class="btn btn-success compile-code-submit">Compile</a>
						</div>
						<textarea name="task-solution" class="textarea-my-code required non-sce hide" style="height:160px"><? echo $tskEx['solution'] ?></textarea>
						<input type="hidden" class="code-file-name" value="main"/>
						<input type="hidden" class="input-file" value="<? echo MAIN_PATH.$tsk['input'] ?>"/>
						<input type="hidden" class="output-file" value="<? echo MAIN_PATH.$tsk['output'] ?>"/>
						<input type="hidden" class="dir-to-compile" name="dir-to-compile-sample" value="<? echo MAIN_PATH.$tsk['dir'].$member['username'] ?>"/>
						<input type="hidden" class="testcase-dir" name="testcase-dir-sample" value="<? echo $testcasePath ?>"/>
						<input type="hidden" class="correct-test-per" name="correct-test-per-sample"/>
						<div class="hide code-language"><? echo $tsk['language_code'] ?></div>
						<div class="compile-window">
							<div class="compile-window-head">Compile window</div>
							<div class="compile-window-content">
								<div class="code">
									<div class="console error hide" id="errorCode"></div>
									<span id="compile-output"></span>
								</div>
							</div>
						</div>
						<div id="ace-editor-sample-code" class="ace-editor"><? $sampleCodeText = file_get_contents($tskeSampleFile);
$sampleCodeText = str_replace($sCha, $rCha, $sampleCodeText);
echo $sampleCodeText; ?></div>
					</div>
<? } ?>

				</div>
			</div>
		</div>
	</div>
</div>

<? if ($tsk['uid'] == $u) echo '</div>';
else echo '</form>' ?>

<link href="<? echo PLUGINS ?>/slider/slider.min.css" rel="stylesheet">
<script src="<? echo JS ?>/todayTaskView.js"></script>
<? if ($member['type'] == 'student' && $checkSubmit <= 0) echo '<script src="'.JS.'/todayTaskDo.js"></script>';
if ($tsk['uid'] == $u && $totalSubmit > 0) echo '<script src="'.JS.'/todayTaskManage.program.js"></script>';

$aceTheme = 'idle_fingers';
$aceMode = $tsk['ace_code'] ?>
<script src="<?php echo PLUGINS ?>/ace/src/ace.js"></script>
<script src="<?php echo PLUGINS ?>/ace/src/mode-<? echo $aceMode ?>.js"></script>
<script src="<?php echo PLUGINS ?>/ace/src/theme-<? echo $aceTheme ?>.js"></script>
<script>ace_theme = '<? echo $aceTheme ?>';
ace_mode = '<? echo $aceMode ?>';
var ace_editorMyCode = ace.edit('ace-editor-my-code');
ace_editorMyCode.setTheme("ace/theme/"+ace_theme);
ace_editorMyCode.getSession().setMode("ace/mode/"+ace_mode);
<? if ($checkSubmit > 0) { ?>
ace_editorMyCode.setReadOnly(true);
<? }
if ($tsk['answer'] && ($checkSubmit > 0 || $tsk['uid'] == $u)) { ?>
var ace_editorSampleCode = ace.edit('ace-editor-sample-code');
ace_editorSampleCode.setTheme("ace/theme/"+ace_theme);
ace_editorSampleCode.getSession().setMode("ace/mode/"+ace_mode);
ace_editorSampleCode.setReadOnly(true);
$('.sample-solution .compile-code-submit').click(function () {
	$(this).closest('.compile-code-form').find('.textarea-my-code').val(ace_editorSampleCode.getSession().getValue());
});
<? } ?>
$('.solve-problem .compile-code-submit').click(function () {
	$(this).closest('.compile-code-form').find('.textarea-my-code').val(ace_editorMyCode.getSession().getValue());
});
</script>
<script src="<?php echo JS ?>/compile.js"></script>
<? } ?>
