<?php if ($_GET['act'] == 'submit') {
	if ($e) {
		$exInfo = getRecord('ex', "`id` = '$e'" );
		$solution = _content($_POST['task-solution-'.$e]);
		$result = _content($_POST['task-result-'.$e]);
		$myCodeFile = $_POST['dir-to-compile-'.$e].'/main.cpp';
		$correctTestPer = $_POST['correct-test-per-'.$e];
		if (!$correctTestPer) $correctTestPer = '';
		if ($solution || $result) {
			if (countRecord('task_ex_submit', "`uid` = '$u' AND `teid` = '$e' ") <= 0) {
				$add = mysql_query("INSERT INTO `task_ex_submit` (`uid`, `tid`, `teid`, `correct-test-per`, `time`) VALUES ('$u', '$t', '$e', '$correctTestPer', '$current')");
				if ($add) {
//					changeValue('task', "`id` = '$t'", "`done` = 'inprogress'");
					echo '<div class="alerts alert-success">Quest <a>'.$exInfo['quest'].'</a> is saved successfully.</div>';
				} else echo '<div class="alerts alert-error">Something went wrong when trying to saved quest <a>'.$exInfo['quest'].'</a>. Please contact the administrators for help.</div>';
			} else {
				$myTskDo = getRecord('task_ex_submit', "`uid` = '$u' AND `teid` = '$e' ");
//					echo $myTskDo['solution'].'~~~~~'.$solution;
				if ($myTskDo['solution'] != $solution || $myTskDo['result'] != $result || $myCodeFile) {
					$change = changeValue('task_ex_submit', "`uid` = '$u' AND `teid` = '$e'", "`solution` = '$solution', `result` = '$result', `file` = '$myCodeFile', `correct-test-per` = '$correctTestPer' ");
					if ($change) {
//						changeValue('task', "`id` = '$t'", "`done` = 'inprogress'");
						echo '<div class="alerts alert-success">Quest <a>'.$exInfo['quest'].'</a> is saved successfully.</div>';
					} else echo '<div class="alerts alert-error">Something went wrong when trying to saved quest <a>'.$exInfo['quest'].'</a>. Please contact the administrators for help.</div>';
				}
			}
		} else echo '<div class="alerts alert-error">Solution and result both not found.</div>';
	} else {
		$myDoneEx = 0;
		foreach ($tsk as $tsk) {
			if (countRecord('task_ex_submit', "`uid` = '$u' AND `teid` = '{$tsk['id']}' ") > 0) $myDoneEx++;
		}
		if ($myDoneEx == countRecord('task_ex', "`tid` = '$t' ")) {
			if ($myTaskSubmit && $myTaskSubmit['grade'] == 0) {
				$changeTsk = changeValue('task_submit', "`uid` = '$u' AND `tid` = '$t' ", "`time` = '$current' ");
				if ($changeTsk) echo '<div class="alerts alert-success">Your task has been resubmitted successfully. Wait for grading... :3</div>';
				else echo '<div class="alerts alert-error">Something went wrong when trying to resubmit your task. Please contact the administrators for help.</div>';
			} else if (!$myTaskSubmit) {
				$submit = mysql_query("INSERT INTO `task_submit` (`uid`, `tid`, `lid`, `cid`, `time`) VALUES ('$u', '$t', '{$task['lid']}', '{$task['cid']}', '$current')");
				if ($submit) {
//					changeValue('task', "`id` = '$t'", "`done` = 'done'");
					echo '<div class="alerts alert-success">Your task has been submitted successfully. Wait for grading... :3</div>';
				} else echo '<div class="alerts alert-error">Something went wrong when trying to submit your task. Please contact the administrators for help.</div>';
			}
		} else echo '<div class="alerts alert-error">You did not complete all quests in this task. Please complete them all before trying to submit task.</div>';
	}
} ?>
