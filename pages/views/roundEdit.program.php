<?php if ($_GET['act'] == 'submit') include 'system/roundEdit.program.php';
else if (countRecord('contest_round', "`iid` = '$iid' AND `rid` = '$r' ") > 0) 
	echo '<h2>Edit round '.$r.'</h2>
	<div class="alerts alert-warning">Sorry you can\'t edit this anymore.</div>';
else { ?>
<h2>Edit round <? echo $r ?></h2>

<form method="POST" enctype="multipart/form-data" class="form-mi form-new-round">
	<? if ($rOTimeClas == 'over') echo '<div class="alerts alert-warning">Opps! Seems you missed it! <br/>The exam should be published on <b>'.$rOTime.'</b>.<br/>Not to worry. Change the time of this round and we\'ll announce to all participants. Though, you should get more careful.</div>' ?>
	<div class="complete-bar">
		<div class="complete-bar-color"></div>
	</div>
	
	<div class="step active" id="step-1" alt="Basic information">
		<h3>Basic information</h3>
		<dl class="line left" style="width:49%"><dt>Time allowed *</dt> <dd><input type="number" name="t-time" class="required input-number" min="5" value="5" style="width:70%;margin-left:6.5%"/> min</dd></dl>
		<dl class="line left" style="width:51%"><dt>Published time *</dt>
			<dd><input type="number" min="00" max="23" name="public_time_hour" style="width:15%" class="required input-number" placeholder="Hour"/> : 
				<input type="number" min="00" max="60" name="public_time_minute" style="width:15%" class="required input-number" placeholder="Min"/>
		<? if (!$rOTime || ($rOTime && $rOTimeClas == 'over')) echo '<input type="text" name="public_time_day" class="datepicker" style="width:62%" class="right"/>';
			else echo '<input type="text" disabled value="'.$rOTime.'" style="width:62%" class="right"/>'; ?>
			</dd>
		</dl>
		<div class="clearfix"></div>
		<dl class="line">
			<textarea name="t-des" class="required-non" style="height:200px"></textarea>
		</dl>
	</div>


	<div class="step" id="step-2" alt="Generate your exam form" style="margin-top:-5px;padding-top:5px">
		<h3>Generate your exam form</h3>
		<input type="submit" value="Submit" class="right" style="margin-top:-33px"/>
<!--		<div class="alerts alert-classic">We're now only supporting test exam.</div> -->
		<dl class="line" style="margin-top:10px!important">
			<dt>Choose type</dt>
			<dd class="up-type">
				<label class="radio" style="margin-right:15%!important"><input type="radio" name="t-up-type" disabled checked value="zip"/> Uploading one zip</label>
				<label class="radio"><input type="radio" name="t-up-type" disabled value="generate"/> Generate</label>
			</dd>
		</dl>
		
		<div class="up-type-zip">
			<dl class="line line-mar">
				<dt>Upload a zip *</dt>
				<dd class="input-test-prob input-group">
					<input readonly type="text" placeholder=".zip" class="required">
					<span class="input-group-btn">
						<span class="btn btn-primary btn-file">
							Browse… <input type="file" name="t-zip-file" accept="application/zip">
						</span>
					</span>
				</dd>
			</dl>
<!--			<div class="alerts alert-classic right" style="width:60%;margin-top:5px">This course belongs to a program dot. Creating an exam for program dot is a bit different from others.</div> -->
			<div class="alerts alert-info left" style="width:58%;margin-right:0;margin-left:17px;padding-right:5px">This course belongs to a <b>program dot</b>. Creating an exam for program dot is a bit different from others.<br/>
				We now support only <b>one</b> method to create a programming exam.<br/>
				<b>Upload a zip</b> which satisfies <b>one of those</b> two:
				<ol>
					<li>Contains <b>n folder</b> name as task number, in which contains 4 file: <b>input.txt</b>, <b>output.txt</b>, <b>problem.txt</b>, <b>sample.main.&lt;your type&gt;</b> <a>See example tree</a></li>
					<li>Contains 1 <b>problem.pdf</b> file which includes all the problems in the test, <b>n folder</b> name as task number, in which contains 3 file: <b>input.txt</b>, <b>output.txt</b>, <b>sample.main.&lt;your type&gt;</b> <a>See example tree</a></li>
				</ol>
			</div>
			<div class="alerts alert-warning right" style="width:36%;margin-right:0;margin-left:15px;padding-right:5px"><b>Warning:</b> This feature hasn't been focused on developing.<br/>Intentionally uploading a zip which not suit the requirements may not cause any errors when creating an exam (means no errors were alerted) but something could went wrong when a student tries to work on your test.</div>
		</div>
	</div>
	
	<div class="completed-print hide" id="completed-print">
		<h3>Finally!</h3>
		<div class="done-data"></div>
	</div>
</form>

<script src="<?php echo JS ?>/stepSetting.js"></script>
<script src="<?php echo JS ?>/roundEdit.program.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS ?>/teacher.css"/>
<?php } ?>
