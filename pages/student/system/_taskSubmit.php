<?php if ($_GET['act'] == 'submit') {
	$myDoneEx = 0;
	foreach ($tsk as $tsk) {
		$exInfo = getRecord('ex', "`id` = '{$tsk['eid']}'" );
		$solution = $_POST['task-solution-'.$tsk['id']];
		$result = $_POST['task-result-'.$tsk['id']];
		if ($solution || $result) {
			if (countRecord('task_ex_submit', "`uid` = '$u' AND `teid` = '{$tsk['id']}' ") <= 0) {
				$add = mysql_query("INSERT INTO `task_ex_submit` (`uid`, `teid`, `time`) VALUES ('$u', '{$tsk['id']}', '$current')");
				if ($add) echo '<div class="console success">Quest <a>'.$exInfo['quest'].'</a> is saved successfully.</div>';
				else echo '<div class="console error">Something went wrong when trying to saved quest <a>'.$exInfo['quest'].'</a>. Please contact the administrators for help.</div>';
			} else {
				$myTskDo = getRecord('task_ex_submit', "`uid` = '$u' AND `teid` = '{$tsk['id']}' ");
//					echo $myTskDo['solution'].'~~~~~'.$solution;
				if ($myTskDo['solution'] != $solution || $myTskDo['result'] != $result) {
					$change = changeValue('task_ex_submit', "`uid` = '$u' AND `teid` = '{$tsk['id']}'", "`solution` = '$solution', `result` = '$result' ");
					if ($change) echo '<div class="console success">Quest <a>'.$exInfo['quest'].'</a> is saved successfully.</div>';
					else echo '<div class="console error">Something went wrong when trying to saved quest <a>'.$exInfo['quest'].'</a>. Please contact the administrators for help.</div>';
				}
			}
			if (countRecord('task_ex_submit', "`uid` = '$u' AND `teid` = '{$tsk['id']}' ") > 0) $myDoneEx++;
		}
	}
	if ($myDoneEx == countRecord('task_ex', "`tid` = '$t' ")) {
		mysql_query("INSERT INTO `task_submit` (`uid`, `tid`, `time`) VALUES ('$u', '$t', '$current')");
	}
} ?>
