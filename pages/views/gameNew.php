<!--<div class="alerts alert-classic right"><a href="#!faq#make+my+own+game">Click</a> Make your own game! <b>Without coding!</b></div> -->
<?php if ($_GET['act'] == 'submit') include 'system/gameNew.php';
else { ?>
<h2>Upload your game</h2>

<form class="form-mi form-new-game" enctype="multipart/form-data" method="post">
	<input class="submit right" type="submit" value="Submit" style="margin-top:-35px"/>

	<div class="done-data"></div>

	<div class="left" style="width:55%">
		<h3>Basic info</h3>
		<dl class="line">
			<dt>Title *</dt>
			<dd class="choose-g-up-type">
				<input type="text" name="g-title" class="required"/>
			</dd>
		</dl>
		<dl class="line">
			<dt>Version *</dt>
			<dd class="choose-g-up-type">
				<input type="text" name="g-version" class="required"/>
			</dd>
		</dl>

		<dl class="line">
			<dt>Choose type *</dt>
			<dd class="choose-g-up-type">
				<label class="radio">
					<input type="radio" name="g-up-type" checked value="upload"/> Upload from computer
				</label>
				<label class="radio">
					<input type="radio" name="g-up-type" value="import"/> Import from my projects
				</label>
				<div class="clearfix"></div>
			</dd>
		</dl>

		<dl class="line line-mar upload">
			<dt>Upload a zip *</dt>
			<dd class="input-test-prob input-group">
				<input readonly type="text" placeholder=".zip" class="required">
				<span class="input-group-btn">
					<span class="btn btn-primary btn-file">
						Browse… <input type="file" name="g-zip-file" accept=".zip,application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed">
					</span>
				</span>
			</dd>
		</dl>
		<div class="alerts alert-info left"><b>.zip</b> file must contains <b>1 folder</b> in which contains all your game files.</a></div>
	</div>

	<div class="c-ava right new-item-thumbs g-thumbs" style="width:43%">
		<h3>Add game thumbnais</h3>
		<div class="all-thumbnais">
			<input type="text" class="required input-img" name="g-thumbnai" placeholder="Input main thumbnai *"/>
			<div class="addbox minibutton right" style="margin-right:-5px"><i class="fa fa-plus"></i></div>
			<div class="thums" id="">
				<input type="text" class="more-thumb" name="g-thumb1" id="thumb1" placeholder="Thumbnai 1"/>
				<input type="text" class="more-thumb" name="g-thumb2" id="thumb2" placeholder="Thumbnai 2"/>
				<input type="text" class="more-thumb" name="g-thumb3" id="thumb3" placeholder="Thumbnai 3"/>
			</div>
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	<div id="m_tab" class="g-info" style="margin-top:10px">
		<div class="m_tab">
			<div class="tab active" id="info">Info *</div>
			<div class="tab" id="guide">Guide *</div>
			<div class="tab" id="issues">Issues</div>
			<div class="tab" id="source">Source</div>
			<div class="tab" id="credits">Credits *</div>
		</div>
		<div class="tab-index game-box active info"><textarea name="g-des" class="required"></textarea></div>
		<div class="tab-index game-box hide guide"><textarea name="g-guide" class="required"></textarea></div>
		<div class="tab-index game-box hide issues"><textarea name="g-issues"></textarea></div>
		<div class="tab-index game-box hide source"><textarea name="g-source"></textarea></div>
		<div class="tab-index game-box hide credits"><textarea name="g-credits" class="required"></textarea></div>
		<style>.g-info textarea{height:170px}</style>
	</div>
</form>

<script src="<?php echo JS ?>/stepSetting.js"></script>
<script src="<?php echo JS ?>/gameNew.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS ?>/teacher.css"/>
<?php } ?>
