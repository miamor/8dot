<?php include '../lib/config.php';
if ($_GET['act'] == 'submit') include 'system/exNew.php';
else { ?>

<h2>Add new exercise</h2>

<div class="done-data"></div>

<form method="POST" enctype="multipart/form-data" class="form-mi form-new-lib form-new-page">
	<div class="complete-bar">
		<div class="complete-bar-color"></div>
	</div>

	<div class="step active" id="step-1" alt="Choose a type">
		<h3>Choose a type</h3>
		Define which type of ex you would like to add.<br/>
		<div class="type-page choose-type school">
			<h3>School</h3>
			Real estate of school.<br/>
			This type allow adding courses to.
		</div>
		<div class="type-page choose-type extra">
			<h3>Extra classes</h3>
			Centre for extra classes.<br/>
			This type allow adding courses to.
		</div>
		<div class="type-page choose-type org">
			<h3>Organization</h3>
			An organization
		</div>
		<div class="type-page choose-type community">
			<h3>Community</h3>
			Just a community
		</div>
		<div class="clearfix"></div>
		
		<div class="step-1-info">* <i>You haven't chosen any type.</i></div>
		<input type="hidden" name="page-type"/>
		<input type="hidden" name="page-num-hidden"/>
	</div>
	
	
	<div class="step" id="step-2" alt="Basic information" style="padding-top:5px">
		<div class="done-data" style="margin-top:-9px;padding-bottom:15px"></div>
		<input class="right" type="submit" value="Submit" style="margin-top:-10px"/>
		
		<div class="type-display hide" id="school">
			<h3 style="width:60%">Basic information</h3>
			<dl class="line">
				<dt>School name *</dt>
				<dd><input type="text" name="page-title" class="required" placeholder="Title *"/></dd>
			</dl>
			<dl class="line">
				<dt>Place *</dt>
				<dd><input type="text" name="page-plac" class="required" placeholder="Where does your school locate? *"/></dd>
			</dl>
			<dl class="line">
				<dt>School website </dt>
				<dd><input type="text" name="page-website" class="input-link" placeholder="http://"/></dd>
			</dl>
			<div class="line" style="margin-top:15px">
				<div class="left" style="margin-right:30px">Should this be authenticated by 8dot? </div>
				<div>
					<label class="radio"><input type="radio" name="page-authorised" value="yes"/> Yes</label>
					<label class="radio"><input type="radio" checked name="page-authorised" value="no"/> No</label>
				</div>
				<div class="clearfix"></div>
				<div class="alerts alert-square alert-bold-border alert-info">If this page is authorised and official representation of this school then select Yes.<br/>
				Note that only one school with this name is authenticated and we'll confirm by contacting you through your profile info.<br/>
				If the info is incorrect, the page won't be authenticated and won't display as a school local page but only as a normal community page.</div>
				<span class="gensmall"></span>
			</div>
		</div>
	</div>
	
	<div class="completed-print hide" id="completed-print">
		<h3>Finally!</h3>
		<div class="done-data"></div>
	</div>
</form>

<script src="<?php echo JS ?>/stepSetting.js"></script>
<script src="<?php echo JS ?>/pageNew.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS ?>/teacher.css"/>

<?php } ?>
