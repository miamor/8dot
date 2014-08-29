<?php if ($_GET['act'] == 'submit') include 'system/testNew.php';
else { ?>

<h2>Add new exam</h2>

<form method="POST" enctype="multipart/form-data" class="form-mi form-new-test" data-c="<? echo $c ?>">
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
		<dl class="line left" style="width:40%"><dt>Time *</dt> <dd><input type="number" name="t-time" class="required input-number" min="5" value="5" style="width:80%"/> min</dd></dl>
		<dl class="line left" style="width:33%"><dt>Deadline *</dt> <dd><input type="text" name="t-deadline" class="datepicker required"/></dd></dl>
		<dl class="line right" style="width:24%"><dt>Price </dt> <dd><input type="number" name="t-price" class="required" value="0"/></dd></dl>
	</div>


	<div class="step" id="step-2" alt="Generate your exam form" style="margin-top:-5px;padding-top:5px">
		<h3>Generate your exam form</h3>
		<input type="submit" value="Submit" class="right" style="margin-top:-30px"/>
<!--		<div class="alerts alert-classic">We're now only supporting test exam.</div> -->
		<dl class="line" style="margin-top:10px!important">
			<dt>Choose type</dt>
			<dd class="up-type">
				<label class="radio" style="margin-right:15%!important"><input type="radio" name="t-up-type" value="zip"/> Uploading one zip</label>
				<label class="radio"><input checked type="radio" name="t-up-type" value="generate"/> Generate</label>
			</dd>
		</dl>
		
		<div class="up-type-zip hide">
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
			<div class="alerts alert-info left" style="width:40%"><b>.zip</b> file must contains <b>2 files</b> : <b>1 problem.pdf file</b> for all problems, and <b>1 results.txt file</b> for results source. <a>What is <b>results source</b> ?</a></div>
		</div>
		<div class="up-type-generate">
			<div class="left" style="width:41%">
				<h4>Problems</h4>
				<div class="line up-problem-type" style="margin-top:10px">
					<label class="radio" style="margin-right:15%!important"><input checked type="radio" name="t-up-prob-type" value="file"/> Uploading a file</label>
					<label class="radio"><input type="radio" name="t-up-prob-type" value="url"/> URL</label>
				</div>
				<dl class="line line-mar up-problem up-problem-file">
					<dt>Upload a file</dt>
					<dd class="input-test-prob input-group">
						<input readonly type="text" placeholder=".pdf" class="required">
						<span class="input-group-btn">
							<span class="btn btn-primary btn-file">
								Browse… <input type="file" name="t-prob-file" accept="application/pdf">
							</span>
						</span>
					</dd>
				</dl>
				<dl class="line line-mar up-problem up-problem-url hide">
					<dt>Or use a URL</dt>
					<dd><input type="text" name="t-prob-url" class="required"/></dd>
				</dl>
			</div>
			<div class="right" style="width:57%">
				<h4>Answer sheet</h4>
				<dl class="line">
					<dt>Result sheets</dt>
					<dd class="set-result-type">
						<label class="radio"><input type="radio" name="t-result-type" checked value="generate"/> Generate now</label>
						<label class="radio"><input type="radio" name="t-result-type" value="console"/> Generate with code</label>
						<label class="radio"><input type="radio" name="t-result-type" value="upload"/> Upload my file</label>
						<div class="clearfix"></div>
					</dd>
				</dl>
				<div class="set-correct-ans generate">
					<dl class="line">
						<dt style="width:55%;">How many questions available in exam?</dt>
						<dd style="margin-left:56%;width:34%"><input type="number" min="1" name="t-nums" value="1"/></dd>
					</dl>
					<div class="t-sheets">
						<div class="t-sheet-one">
							<label class="checkbox"><input type="checkbox" name="t-ans-1" value="ans"/></label> <input type="text" name="t-result-1" class="required"/> <i class="gensmall">// Correct answer for quest 1</i>
						</div>
					</div>
				</div>
				<div class="set-correct-ans console hide">
					<textarea name="t-ans-console" class="hide non-sce t-ans-console"></textarea>
<div id="ace-editor-results-code" style="width:100%;height:200px">// Add your results code here. See examples below.
// Use @[Quest num::Result::Sample solution] for one question result code.
// Add 'ans' after @ for answer requiring. Eg @ans[1::30] with 30 is the final result.
// 2 result code doesn't need to be seperated.

@[1::B::] @[2::A]@[3::C]	@[4::A]
@ans[5::50]
@[6::E] // You can add comments here by using '//'
@[7::"Words with space"]
@[8::Words with space] // " is not required even when there's space
@ans[9::"\sqrt{2}"] // Final result can be telex code</div>
				</div>
				<div class="set-correct-ans upload hide">
					<dl class="line line-mar">
						<dt>Upload your file</dt>
						<dd class="input-group">
							<input readonly type="text" class="required" placeholder=".txt">
							<span class="input-group-btn">
								<span class="btn btn-primary btn-file">
									Browse… <input type="file" name="t-ans-file" accept="text/plain">
								</span>
							</span>
						</dd>
					</dl>
					<div class="alerts alert-info">Your <b>.txt file</b> must contains <b>results code</b>.</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="completed-print hide" id="completed-print">
		<h3>Finally!</h3>
		<div class="done-data"></div>
	</div>
</form>

<script src="<?php echo PLUGINS ?>/ace/src/ace.js"></script>
<script src="<?php echo JS ?>/stepSetting.js"></script>
<script src="<?php echo JS ?>/testNew.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS ?>/teacher.css"/>
<?php } ?>
