<?php $task = getRecord('task', "`id` = '$t' ");
	$lInfo = getRecord('lesson', "`id` = '{$task['lid']}' ");
	$program = false;
if ($task['public'] != 'yes') echo '<div class="alerts alert-warning">This task may not be published yet.</div>';
else {
	if ($task && $task['done'] != 'yes') {
		$myTaskSubmit = getRecord('task_submit', "`uid` = '$u' AND `tid` = '$t' ");
		$tDay = $todayd; 			$tMonth = $todaym; 			$tYear = $todayY;
		$dead = explode('-', $task['deadline']);
		$dDay = (int)$dead[0]; 		$dMonth = (int)$dead[1]; 		$dYear = (int)$dead[2];
		if ($today == $task['deadline']) $label = 'warning';
		else if ($tYear < $dYear) $label = 'primary';
		else if ($tYear > $dYear) $label = 'danger';
		else {
			if ($tMonth < $dMonth) $label = 'primary';
			else if ($tMonth > $dMonth) $label = 'danger';
			else {
				if ($tDay < $dDay) $label = 'primary';
				else if ($tDay > $dDay) $label = 'danger';
			}
		}
		if ($label == 'danger') $dTitle = 'Deadline passed';
		else if ($label == 'warning') $dTitle = 'Today is deadline!';
		else {
			if ($tYear < $dYear) {
				$lft = $dYear - $tYear;
				if ($lft > 1) $dTitle = $lft.' years till deadline';
				else $dTitle = $lft.' year till deadline';
			} else if ($tMonth < $dMonth) {
				$lft = $dMonth - $tMonth;
				if ($lft > 1) $dTitle = $lft.' months till deadline';
				else $dTitle = $lft.' month till deadline';
			} else if ($tDay < $dDay) {
				$lft = $dDay - $tDay;
				if ($lft > 1) $dTitle = $lft.' days till deadline';
				else $dTitle = $lft.' day till deadline';
			}
		}
		$tskExNum = countRecord('task_ex', "`tid` = '{$task['id']}' ");
		$tsk = $getRecord -> GET('task_ex', "`tid` = '{$task['id']}' ");
		if ($_GET['act'] == 'submit') include 'student/system/taskSubmit.php';
		else {
			$miDoneEx = 0;
			foreach ($tsk as $tskcount) {
				if (countRecord('task_ex_submit', "`uid` = '$u' AND `teid` = '{$tskcount['id']}' ") > 0) $miDoneEx++;
			} ?>

<div class="alert-box">
<?php if ($myTaskSubmit) {
	if ($myTaskSubmit['grade'] == 0) echo '<div class="alerts alert-info right">Your task has been submitted, but no graded yet. Therefore, you can still resubmit it. </div>';
	else echo '<div class="alerts alert-info right">Your task has been submitted and graded. </div>';
} else {
	if ($label == 'danger') echo '<div class="alerts alert-warning left">This task is out of deadline. Though, you can still submit it. Be more noticed next time.</div>';
	echo '<div class="alerts alert-warning left">Remember to save your edition before switching to any other actions or closing this window. For avoiding errors due to your carelessness, we do not make this auto-saved.</div>';
} ?>
	<div class="clearfix"></div>
</div>

<div class="done-data"></div>

<div class="form-submit-task" data-task="<?php echo $t ?>">
<!--	<div class="alerts alert-classic left">Tip for day~</div> -->
	<div style="clear:both"></div>
	
	<h3 class="main-title left" style="margin-bottom:-2px!important">
		<?php echo $lInfo['title'] ?>
	</h3>
	<div class="badge badge-warning left" style="display:inline;margin-top:17px" title="<?php echo $tskExNum ?> exercise include"><?php echo $tskExNum ?></div>
	<div class="label label-<?php echo $label ?> left" title="<?php echo $dTitle ?>" style="margin:17px 0 0 17px"><?php echo $task['deadline'] ?></div>
	
	<div class="submit-button">
		<a class="btn btn-primary disabled task-submit right<?php if ($myTaskSubmit && $myTaskSubmit['grade'] != 0) echo ' dis' ?>">Submit</a>
	</div>
	
	<div class="clearfix"></div>
	<div class="mi-content">

<?php foreach ($tsk as $tsk) {
//		$tske = getRecord('task_ex', "`tid` = '{$task['id']}' AND `eid` = '{$tsk['eid']}' ");
		$exInfo = getRecord('ex', "`id` = '{$tsk['eid']}'" );
		$tskEx = getRecord('task_ex_submit', "`teid` = '{$tsk['id']}' AND `uid` = '$u' "); ?>

	<div class="one-task <?php echo $tsk['id'].' '.$exInfo['type'] ?>">
		<div class="task-quest" data-task="<?php echo $tsk['id'] ?>">
		<?php if ($tsk['difficult'] == 'yes') echo '<span class="prefix prefix-orange prefix-small">Difficult</span> ';
			echo $exInfo['quest'] ?>
		</div>
		<div class="ar-right"></div>
	</div>

	<form method="post" class="form-submit-task-ex task-do hide <? if ($exInfo['type'] == 'program') echo 'program compile-code-form' ?>" id="<?php echo $tsk['id'] ?>">
<?php 	if ($exInfo['type'] == 'test') {
			$exChoii = explode('|', $exInfo['choices']);
			echo '<div class="task-radio-option">';
			for ($j = 0; $j < count($exChoii); $j++) {
				echo '<label class="radio" for="option'.$j.$exInfo['id'].'"><input type="radio" ';
				if ($tskEx['result'] == $exChoii[$j]) echo 'checked ';
				echo 'id="option'.$j.$exInfo['id'].'" value="'.$exChoii[$j].'" name="task-result-'.$tsk['id'].'"/> '.$exChoii[$j].'</label>';
			}
			echo '</div>';
			echo '<div class="task-solution" title="Solution"><textarea name="task-solution-'.$tsk['id'].'" style="height:160px">'.$tskEx['solution'].'</textarea></div>';
		} else if ($exInfo['type'] == 'answer') {
			echo '<div class="task-solution" title="Solution *"><textarea name="task-solution-'.$tsk['id'].'" class="required" style="height:160px">'.$tskEx['solution'].'</textarea></div>';
			if ($exInfo['result']) echo '<dl class="line line-mar"><dt>Result *</dt> <dd><input type="text" name="task-result-'.$tsk['id'].'" class="required" placeholder="Task result" value="'.$tskEx['result'].'"/></dd></dl>';
		} else if ($exInfo['type'] == 'program') {
			$program = true; ?>
			<div class="action-top">
				<div class="done-data"></div>
				<div class="right">
					<a class="btn btn-success compile-code-submit">Compile</a>
					<input type="submit" class="quest-save" value="Save"/>
				</div>
			</div>
			<div class="task-solution">
				<textarea name="task-solution-<? echo $tsk['id'] ?>" class="textarea-my-code required non-sce hide" style="height:160px"><? echo $tskEx['solution'] ?></textarea>
				<input type="hidden" class="input-file" value="<? echo MAIN_PATH.$exInfo['input'] ?>"/>
				<input type="hidden" class="dir-to-compile" name="dir-to-compile-<? echo $tsk['id'] ?>" value="<? echo MAIN_PATH.$tsk['dir'].$member['username'] ?>"/>
<!--				<input type="hidden" class="dir-to-save" name="dir-to-save-<? echo $tsk['id'] ?>" value="<? echo $tsk['dir'].$member['username'] ?>"/> -->
				<div class="compile-code" id="m_tab">
					<div class="compile-header m_tab">
						<div class="left code-language label label-info" style="margin:12px 10px 0 5px"><? echo $exInfo['language'] ?></div>
						<div class="tab active" id="my-code">main.cpp</div>
						<? if ($exInfo['input'] && $exInfo['output']) echo '<div class="tab" id="sample-io">Input/output</div>' ?>
					</div>
					<div class="compile-window">
						<div class="compile-window-head">Compile window</div>
						<div class="compile-window-content">
							<div class="code">
								<div class="console error hide" id="errorCode"></div>
								<span id="compile-output"></span>
							</div>
						</div>
					</div>
		<? 	if ($exInfo['input'] && $exInfo['output']) {
				$eInput = '';
				$eInputFile = fopen(MAIN_PATH.$exInfo['input'], 'r');
				while ($inputline = fgets($eInputFile)) $eInput .= $inputline;
				fclose($eInputFile);
				$eOutput = '';
				$eOutputFile = fopen(MAIN_PATH.$exInfo['output'], 'r');
				while ($outputline = fgets($eOutputFile)) $eOutput .= $outputline;
				fclose($eOutputFile); ?>
					<div class="hide tab-indexs sample-io"><div style="height:100%">
						<div class="s-input left" style="width:49%">
							<h4>Input</h4>
							<? echo $eInput ?>
						</div>
						<div class="s-output right" style="width:49%">
							<h4>Output</h4>
							<? echo $eOutput ?>
						</div>
					</div></div>
		<? 	} ?>
					<div class="tab-indexs my-code">
						<div id="ace-editor<? echo $exInfo['id'] ?>" style="width:100%;height:100%;margin-top:-1px"><? $myCodeSession = '';
$myCodeSessionOp = fopen($tskEx['file'], 'r');
while ($loadCode = fgets($myCodeSessionOp)) $myCodeSession .= $loadCode;
fclose($myCodeSessionOp);
$sCha = array('<', '>');
$rCha   = array('&lt;', '&gt;');
$myCodeSession = str_replace($sCha, $rCha, $myCodeSession);
echo $myCodeSession; ?></div>
					</div>
				</div>
			</div>
		<? } ?>
<? if ($exInfo['type'] != 'program') { ?>
		<div class="action-bottom">
			<div class="right">
				<input type="submit" class="quest-save" disabled value="Save"/>
			</div>
			<div class="done-data left"></div>
		</div>
<? } ?>
	</form>
<?php } ?>

<? 	$aceTheme = 'crimson_editor';
	$aceMode = $exInfo['language'] ?>
<script src="<?php echo PLUGINS ?>/ace/src/ace.js"></script>
<script src="<?php echo PLUGINS ?>/ace/src/mode-<? echo $aceMode ?>.js"></script>
<script src="<?php echo PLUGINS ?>/ace/src/theme-<? echo $aceTheme ?>.js"></script>
<script>ace_theme = '<? echo $aceTheme ?>';
ace_mode = '<? echo $aceMode ?>';</script>
<? 	$tskk = $getRecord -> GET('task_ex', "`tid` = '{$task['id']}' ");
	foreach ($tskk as $tskk) {
		$exInfos = getRecord('ex', "`id` = '{$tskk['eid']}'" ); ?>
<script>var ace_editor<? echo $exInfos['id'] ?> = ace.edit('ace-editor<? echo $exInfos['id'] ?>');
		ace_editor<? echo $exInfos['id'] ?>.setTheme("ace/theme/"+ace_theme);
		ace_editor<? echo $exInfos['id'] ?>.getSession().setMode("ace/mode/"+ace_mode);
		$('.task-do#<? echo $tskk['id'] ?> .compile-code-submit').click(function () {
			$('.task-do#<? echo $tskk['id'] ?>').find('.textarea-my-code').val(ace_editor<? echo $exInfos['id'] ?>.getSession().getValue());
		});
</script>
<? 	} ?>
<script src="<?php echo JS ?>/compile.js"></script>
<script type="text/javascript" src="<?php echo PLUGINS ?>/sceditor/minified/jquery.sceditor.js"></script>
<script type="text/javascript" src="<?php echo JS ?>/checkValidNew.js"></script>
<script src="<?php echo JS ?>/taskView.js"></script>

	</div>
</div>

<? 		}
	}
} ?>
