<?php if ($_GET['act'] == 'submit') include 'system/exNew.php';
else { ?>

<h2>Add new exercise</h2>

<div class="done-data"></div>

<form method="POST" enctype="multipart/form-data" class="form-mi form-new-lib" id="exercise">
	<div class="complete-bar">
		<div class="complete-bar-color"></div>
	</div>

	<div class="step active" id="step-1" alt="Choose a type">
		<h3>Choose a type</h3>
		Define which type of ex you would like to add.<br/>
		<div class="type-ex choose-type answer">
			<h3>Answer</h3>
			Create an answer-required exercise.
		</div>
		<div class="type-ex choose-type test">
			<h3>Trac nghiem</h3>
			Exercise as a test.
		</div>
		<div class="type-ex disabled choose-type tick">
			<h3>Ticks</h3>
			Create questions as tick option.
			<i class="gensmall">Currently not supported.</i>
		</div>
		<div class="type-ex choose-type doc">
			<h3>Document required</h3>
			This type required feedback as document.
		</div>
		<div class="type-ex choose-type program">
			<h3>Programming</h3>
			Give a problem (and input, output if there is) and get back the code and the student result.
		</div>
		<div class="clearfix"></div>
		
		<div class="step-1-info">* <i>You haven't chosen any type.</i></div>
		<input type="hidden" name="ex-type"/>
		<input type="hidden" name="ex-num-hidden"/>
	</div>
	
	
	<div class="step" id="step-2" alt="Basic information" style="padding-top:5px">
		<div class="done-data" style="margin-top:-9px;padding-bottom:15px"></div>
		<input class="right" type="submit" value="Submit" style="margin-top:-10px"/>
			<h3 class="left" style="margin-top:0!important">Topic *</h3>
			<div class="c-topic-list left">
			<?php $tList = $getRecord -> GET('topic', "", '', '');
				foreach ($tList as $tList) {
					if ($tList['did'] == $dot || in_array($tList['did'], $childDot)) { ?>
					<div class="c-topic">
						<label class="checkbox" for="ex-<?php echo $tList['id'] ?>"><input type="checkbox" name="ex-topic[]" value="<?php echo $tList['id'] ?>" id="ex-<?php echo $tList['id'] ?>" data-toggle="checkbox"> <?php echo $tList['title'] ?></label>
					</div>
			<?php }
			} ?>
			</div>
		
		<div class="divide-c-green"></div>

		<div class="c-basic-info" style="width:78%">
			<h3 style="width:60%;margin:0px 0 0 10px!important">Basic information</h3>
			<dl class="line line-mar">
				<dt style="margin:0" class="dt-program">
					<select name="ex-language" class="required" style="width:100%">
						<option selected value="c_cpp">C++</option>
						<option value="c">C</option>
						<option value="java">Java</option>
						<option value="python2.7">Python 2.7</option>
						<option value="python3.2">Python 3.2</option>
					</select>
				</dt>
				<dt class="dt-normal">Title *</dt>
				<dd><input type="text" name="ex-title" class="required" placeholder="Title *"/></dd>
			</dl>
			
			<div class="type-display hide" id="answer">
				<dl class="line">
					<dt class="left" title="Quest content *" style="width:49%;margin-left:0;margin-right:0">
						<textarea name="ex-quest-answer" class="required" style="height:120px"></textarea>
					</dt>
					<dd class="right ex" title="Solution *" style="width:50%;margin-left:0!important">
						<textarea name="ex-solution-answer" class="required" style="height:120px"></textarea>
					</dd>
				</dl>
				<div style="clear:both"></div>
				<dl class="line">
					<dt>Result </dt> <dd><input type="text" name="ex-result-answer"/></dd>
				</dl>
			</div>
			
			<div class="type-display hide" id="test">
				<dl class="line">
					<dt class="left" title="Quest content *" style="width:49%;margin-left:0;margin-right:0">
						<textarea name="ex-quest-test" class="required" style="height:120px"></textarea>
					</dt>
					<dd class="right" title="Solution *" style="width:50%;margin-left:0;margin-right:-1.5%">
						<textarea name="ex-solution-test" class="required" style="height:120px"></textarea>
					</dd>
				</dl>
				<div style="clear:both"></div>
				<dl class="line test-choice line-mar">
					<dt>Choices * <i class="fa fa-plus-square ex-add-choice" style="cursor:pointer" title="Add more choice"></i></dt> <dd><input type="text" name="ex-choice-1" class="required" placeholder="Choice 1 *"/><input type="text" name="ex-choice-2" class="required" placeholder="Choice 2 *"/><input type="text" name="ex-choice-3" class="required" placeholder="Choice 3 *"/></dd>
				</dl>
				<input type="hidden" name="ex-result-test" class="ex-result-tracnghiem"/>
			</div>

			<div class="type-display hide" id="program">
				<dl class="line">
					<dt class="left" title="Quest content *" style="width:49%;margin-left:0;margin-right:0">
						<textarea name="ex-quest-program" class="required" style="height:160px"></textarea>
					</dt>
					<dd class="right" style="width:49%;margin-left:0;">
				<div class="line ex-choose-sample-type" style="margin-bottom:10px">
					<h4 style="margin-bottom:6px">Sample input/output </h4>
					<label class="radio"><input checked type="radio" name="ex-sample-type" value="none"/> None</label>
					<label class="radio"><input type="radio" name="ex-sample-type" value="generate"/> Generate</label>
					<label class="radio"><input type="radio" name="ex-sample-type" value="txt"/> .txt</label>
					<label class="radio"><input type="radio" name="ex-sample-type" value="zip"/> .zip </label>
					<div class="clearfix"></div>
				</div>
				<div class="line ex-sample-type-custom ex-sample-type-generate hide">
					<div class="ex-sample-input left" style="width:49%">
						<textarea class="non-sce" name="ex-input-code" class="required" style="width:100%;height:80px" placeholder="Input *"></textarea>
					</div>
					<div class="ex-sample-output input-group right" style="width:49%">
						<textarea class="non-sce" name="ex-output-code" class="required" style="width:100%;height:80px" placeholder="Output *"></textarea>
					</div>
					<div class="clearfix"></div>
				</div>
				<dl class="line ex-sample-type-custom ex-sample-type-txt hide">
					<div class="ex-sample-input input-test-prob input-group">
						<input readonly type="text" placeholder="Input file (.txt)" class="required">
						<span class="input-group-btn">
							<span class="btn btn-primary btn-file">
								Browse… <input type="file" name="ex-input-file" accept="text/plain">
							</span>
						</span>
					</div>
					<div class="ex-sample-output input-group" style="margin-top:8px">
						<input readonly type="text" placeholder="Output file (.txt)" class="required">
						<span class="input-group-btn">
							<span class="btn btn-primary btn-file">
								Browse… <input type="file" name="ex-output-file" accept="text/plain">
							</span>
						</span>
					</div>
					<div class="clearfix"></div>
				</dl>
				<div class="line ex-sample-type-custom ex-sample-type-zip hide">
					<div class="ex-sample-input input-test-prob input-group">
						<input readonly type="text" placeholder=".zip file contains 2 file: input.txt and output.txt" class="required">
						<span class="input-group-btn">
							<span class="btn btn-primary btn-file">
								Browse… <input type="file" name="ex-zip-file" accept=".zip,application/octet-stream,application/x-zip,application/x-zip-compressed">
							</span>
						</span>
					</div>
				</div>

				<div class="line ex-choose-test-case-type" style="margin-top:15px">
					<h4>More testcases (Optional)</h4>
					<i class="gensmall">(So that results given back from our compiler be more exactly.)</i><br/>
					<label class="radio"><input checked type="radio" name="ex-test-case-type" value="none"/> None</label>
					<label class="radio"><input type="radio" name="ex-test-case-type" value="zip"/> .zip </label>
					<div class="clearfix"></div>
				</div>
				<div class="line ex-test-case-type-custom ex-test-case-type-zip hide" style="margin-top:8px">
					<div class="ex-test-case-input input-test-prob input-group">
						<input readonly type="text" placeholder=".zip file contains 2 folders: input and output" class="required">
						<span class="input-group-btn">
							<span class="btn btn-primary btn-file">
								Browse… <input type="file" name="ex-test-case-zip-file" accept=".zip,application/octet-stream,application/x-zip,application/x-zip-compressed">
							</span>
						</span>
					</div>
				</div>
					</dd>
				</dl>

				<div style="clear:both"></div>
				<textarea name="ex-solution-program" class="ace hide non-sce" style="height:120px"></textarea>
				<dl class="line">
					<dt class="left" >Sample code *</dt>
					<dd>
						<div id="ace-editor" style="width:100%;height:200px"></div>
					</dd>
				</dl>
			</div>

				<dl class="line">
					<dt class="left" >Public for *</dt>
					<dd>
						<label class="radio" for="ex-st"><input type="radio" name="ex-available" <?php if ($member['type'] == 'teacher') echo 'disabled' ?> value="student" id="ex-st" data-toggle="radio"/> Students</label>
						<label class="radio" for="ex-te"><input type="radio" name="ex-available" <?php if ($member['type'] == 'student') echo 'disabled' ?> value="teacher" id="ex-te" data-toggle="radio"/> Teachers</label>
						<label class="radio" for="ex-stte"><input checked type="radio" name="ex-available" value="both" id="ex-stte" checked data-toggle="radio"/> Both Students & Teachers</label>
					</dd>
				</dl>
		</div>
	</div>
	
	<div class="completed-print hide" id="completed-print">
		<h3>Finally!</h3>
		<div class="done-data"></div>
	</div>
</form>

<script src="<?php echo JS ?>/stepSetting.js"></script>
<script src="<?php echo JS ?>/exNew.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS ?>/teacher.css"/>

<?php } ?>
