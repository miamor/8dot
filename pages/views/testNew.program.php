<?php if ($_GET['act'] == 'submit') include 'system/testNew.program.php';
else { ?>

<h2>Add new exam</h2>
<div class="clearfix"></div>
<form method="POST" enctype="multipart/form-data" class="form-mi form-new-test-program" data-c="<? echo $c ?>">
	<div class="complete-bar">
		<div class="complete-bar-color"></div>
	</div>
	
	<div class="step active" id="step-1" alt="Basic information">
		<h3>Basic information</h3>
		<div class="left" style="width:60%">
			<dl class="line">
				<dt>Title *</dt> <dd><input type="text" name="t-prefix" style="width:19%" placeholder="Prefix"/> <input type="text" name="t-title" class="right required" style="width:80%"/></dd>
			</dl>
		</div>
		<div class="right" style="width:39%">
			<dl class="line">
				<dt>Thumbnai </dt> <dd><input type="text" name="t-thumbnai"/></dd>
			</dl>
		</div>
		<div class="clearfix"></div>
			<dl class="line">
				<textarea name="t-des" class="required-non" style="height:200px"></textarea>
			</dl>
		<dl class="line left" style="width:35%"><dt>Time *</dt> <dd><input type="number" name="t-time" class="required input-number" min="5" value="5" style="width:70%;margin-left:6.5%"/> min</dd></dl>
		<dl class="line left" style="width:32%"><dt>Deadline *</dt> <dd><input type="text" name="t-deadline" class="datepicker required"/></dd></dl>
		<dl class="line right" style="width:29%"><dt>Price </dt> <dd><input type="number" name="t-price" class="required" value="0"/></dd></dl>
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
							Browse… <input type="file" name="t-zip-file" accept=".zip,application/octet-stream,application/x-zip,application/x-zip-compressed">
						</span>
					</span>
				</dd>
			</dl>
<!--			<div class="alerts alert-classic right" style="width:60%;margin-top:5px">This course belongs to a program dot. Creating an exam for program dot is a bit different from others.</div> -->
			<div class="alerts alert-info left" style="width:58%;margin-right:0;margin-left:17px;padding-right:5px">This course belongs to a <b>program dot</b>. Creating an exam for program dot is a bit different from others.<br/>
				We now support only <b>one</b> method to create a programming exam.<br/>
				<b>Upload a zip</b> which satisfies <b>one of those</b> two:
				<ol>
					<li>Contains <b>n folder</b> name as task number, in which contains 4 files and 1 folder of testcases: <b>input.txt</b>, <b>output.txt</b>, <b>problem.txt</b>, <b>sample.&lt;your type&gt; <i>(optional)</i></b>, <b>testcase/ <i>(optional)</i></b> <a>See example tree</a></li>
					<li>Contains 1 <b>problem.pdf</b> file which includes all the problems in the test, <b>n folder</b> name as task number, in which contains 3 files and 1 folder of testcases: <b>input.txt</b>, <b>output.txt</b>, <b>sample.&lt;your type&gt; <i>(optional)</i></b>, <b>testcase/ <i>(optional)</i></b> <a>See example tree</a></li>
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
<script src="<?php echo JS ?>/testNew.program.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS ?>/teacher.css"/>
<?php } ?>
