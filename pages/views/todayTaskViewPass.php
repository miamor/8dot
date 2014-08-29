<?php $exChoii = explode('|', $tsk['choices']);
	$checkSubmit = countRecord('daily_ex_submit', "`uid` = '$u' AND `iid` = '{$tsk['id']}' ");
	$tskEx = getRecord('daily_ex_submit', "`iid` = '{$tsk['id']}' AND `uid` = '$u' ");
	$totalSubmit = countRecord('daily_ex_submit', "`iid` = '{$tsk['id']}' "); ?>

<? if ($tsk['uid'] == $u) echo '<div class="form-submit-daily-task '.$dInfo['type'].'" data-task="'.$e.'">';
else echo '<form class="form-submit-daily-task '.$dInfo['type'].'" data-task="'.$e.'">' ?>
	<div class="mi-content task-exam-do">
		<div class="tsk-list daily-task-do">
			<div class="daily-ex-info <?php echo $tsk['id'].' '.$exInfo['type'] ?>">
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
			} else if ($tsk['uid'] == $u) echo '<div class="console bold warning">This is not today task. You\'re the creator of this exercise.</div>';
			else echo '<div class="console bold warning">This is not today task. You can only view the problem only.</div>' ?>
			</div>
			<div class="clearfix"></div>
		</div>

		<div class="form-list">
			<div class="task-do task-exam-do daily-task-do" id="taskstarting">
				<div class="action-top">
					<div class="done-data"></div>
				</div>
				<div class="task-solution" id="m_tab">
					<div class="compile-header m_tab">
						<div class="tab active" id="problem-tab">Problem</div>
						<? if ($tsk['answer'] && ($checkSubmit > 0 || $tsk['uid'] == $u) ) echo '<div class="tab" id="sample-solution">Sample solution</div>' ?>
						<? if ($checkSubmit > 0) {
							echo '<div class="tab" id="solve-problem">Solve problem ';
								if ($tskEx['result'] == $tsk['result']) echo '<span class="label label-success">Correct</span>';
								else echo '<span class="label label-warning">Not match</span>';
							echo '</div>';
						} ?>
						<? if ($tsk['uid'] == $u && $totalSubmit > 0) echo '<div class="tab right" id="transfer-coin">Transfer coin manager</div>' ?>
						<div class="clearfix"></div>
					</div>

					<div class="tab-indexs problem-tab">
						<? echo $tsk['quest'] ?>
					</div>

<? if ($tsk['uid'] == $u && $totalSubmit > 0) {
	$tskS = $getRecord -> GET('daily_ex_submit', "`iid` = '{$tsk['id']}' ") ?>
					<div class="hide tab-indexs transfer-coin">
						<div class="submitters-list col-md-4 no-padding">
	<? foreach ($tskS as $tskS) {
		$oSer = getRecord('members^username', "`id` = '{$tskS['uid']}' ") ?>
							<div class="one-submitter rows" id="u<? echo $tskS['uid'] ?>" data-u="<? echo $tskS['uid'] ?>" data-e="<? echo $e ?>">
								<a class="select-user"><? echo $oSer['username'] ?></a>
								<? if ($tskS['correct'] == 'yes') echo '<span class="label label-success">Correct</span>';
								else echo '<span class="label label-warning">Not match</span>';
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
		if ($tsk['type'] == 'answer') {
			echo '<dl class="line"><dt>Result </dt> <dd>'.$tsku['result'].'</dd></dl>';
		} else if ($tsk['type'] == 'test') {
			echo '<dl class="line"><dt>Result </dt> <dd class="task-radio-option">';
			for ($j = 0; $j < count($exChoii); $j++) {
				echo '<label class="radio ';
				if ($tsku['result'] == $exChoii[$j]) echo 'checked primary ';
				if ($tsk['result'] == $exChoii[$j]) echo 'checked ';
				echo '"><input type="radio" disabled /> '.$exChoii[$j].'</label>';
			}
			echo '</dd></dl>';
		}
		echo '<div class="daily-task-solution"><h4>'.$uin['username'].'\'s solution</h4>'.$tsku['answer'].'</div>';
		if ($_GET['do'] == 'transfercoin') {
			if (!$tsku['coin']) {
				$coinToAdd = $_POST['coin-to-transfer'];
				addRep($uid, $coinToAdd);
				changeValue('daily_ex_submit', "`iid` = '$e' AND `uid` = '$uid' ", "`coin` = '$coinToAdd' ");
				sendNoti('transfer-coin-daily-ex', $e, '', $uid, $coinToAdd);
			}
		}
		echo '<form class="daily-task-manage-bar"><span>';
			if (!$tsku['coin']) echo '<input type="submit" value="Submit" class="right" style="margin-top:15px"/>';
			echo '<dl class="line line-mar" style="width:80%">
				<dt style="width:25%">';
				if (!$tsku['coin']) echo 'Coins to transfer';
				else echo 'Coins transfered';
			echo '</dt>
				<dd class="right" style="margin-left:0;width:73%">';
				if (!$tsku['coin']) echo '<input type="number" placeholder="Max: '.$tsk['coin'].'" name="coin-to-transfer" style="width:80%" min="0" max="'.$tsk['coin'].'"/>';
				else echo '<input type="number" disabled value="'.$tsku['coin'].'"style="width:80%" />';
			echo '<img src="'.silk.'/coins.png" style="margin-top:-2px;margin-left:5px"/> coins</dd>
			</dl>
		</span></form>';
	} ?>
						</span></div>
					</div>
<? } ?>

<? 	 if ($checkSubmit > 0) {
					echo '<div class="hide tab-indexs solve-problem">';
		if ($tsk['type'] == 'test') {
			echo '<dl class="line"><dt>Result *</dt> <dd class="task-radio-option">';
			for ($j = 0; $j < count($exChoii); $j++) {
				echo '<label class="radio primary"><input type="radio" id="option'.$j.$tsk['id'].'" disabled value="'.$exChoii[$j].'" ';
				if ($tskEx['result'] == $exChoii[$j]) echo 'checked ';
				echo '/> '.$exChoii[$j].'</label>';
			}
			echo '</dd></dl>';
		} else if ($tsk['type'] == 'answer') echo '<dl class="line line-mar"><dt>Result *</dt> <dd><input type="text" name="task-result-'.$tsk['id'].'" class="required" placeholder="Task result" value="'.$tskEx['result'].'"/></dd></dl>';
		echo '<div class="daily-task-solution"><h4 style="margin-bottom:8px">Your solution </h4> '.$tskEx['answer'].'</div>';
					echo '</div>';
	} ?>

				<? if ($tsk['answer'] && ($checkSubmit > 0 || $tsk['uid'] == $u) ) { ?>
					<div class="hide tab-indexs sample-solution">
	<? 		if ($tsk['type'] == 'answer') {
				echo '<dl class="line"><dt>Result </dt> <dd>'.$tsk['result'].'</dd></dl>';
			} else if ($tsk['type'] == 'test') {
				echo '<dl class="line"><dt>Result </dt> <dd class="task-radio-option">';
				for ($j = 0; $j < count($exChoii); $j++) {
					echo '<label class="radio ';
					if ($myTsk['result'] == $exChoii[$j]) echo 'checked primary';
					if ($tsk['result'] == $exChoii[$j]) echo 'checked';
					echo '" for="option'.$j.$eIn['id'].'"><input type="radio" disabled /> '.$exChoii[$j].'</label>';
				}
				echo '</dd></dl>';
			}
			echo '<div class="daily-task-solution"><h4>Sample solution</h4>'.$tsk['answer'].'</div>'; ?>
					</div>
				<? } ?>
				</div>
			</div>
		</div>
	</div>
<? if ($tsk['uid'] == $u) echo '</div>';
else echo '</form>' ?>

<link href="<? echo PLUGINS ?>/slider/slider.min.css" rel="stylesheet">
<script src="<? echo JS ?>/todayTaskView.js"></script>
<? if ($tsk['uid'] == $u && $totalSubmit > 0) echo '<script src="'.JS.'/todayTaskManage.js"></script>' ?>
