<?php if ($_GET['act'] == 'submit') include 'system/eventNew.php';
else { ?>

<div class="choose-types">
	<div class="type-course choose-type contest">
		<h3>Contest</h3>
	</div>
	<div class="type-course choose-type normal-event">
		<h3>Normal event</h3>
	</div>
</div>

<form method="POST" class="form-mi form-new-normal-event hide" style="margin-top:10px">
	<h2>Create a normal event</h2>
	<div class="done-data"></div>

	<div class="complete-bar">
		<div class="complete-bar-color"></div>
	</div>
	<div class="test-contest-info"></div>
	<div class="step new-event active" id="step-1" alt="Event info">
		<h3>Basic information</h3>
		<div class="left" style="width:58%">
			<dl class="line">
				<dt>Title *</dt>
				<dd>
					<input type="text" name="con-prefix" placeholder="Prefix" style="width:19%"/>
					<input type="text" name="con-title" class="right required" style="width:80%"/>
				</dd>
			</dl>
			<dl class="line">
				<dt>Description *</dt>
				<dd>
					<textarea name="con-des" class="required dafukk" style="height:150px"></textarea>
				</dd>
			</dl>
			<dl class="line line-mar">
				<dt>Hosts/Organizers *</dt> 
				<dd>
					<select multiple name="con-hosts[]" class="chosen-select">
							<option selected value="u-<? echo $u ?>"><? echo $member['username'] ?></option>
						<optgroup label="Your pages">
			<? $paggs = $getRecord -> GET('page', "`uid` = '$u' ");
			foreach ($paggs as $paggs) {
				echo '<option value="p-'.$paggs['id'].'">'.$paggs['title'].'</option>';
			} ?>
						</optgroup>
						<optgroup label="Your friends">
			<? $mems = $getRecord -> GET('friend', "`accept` = 'yes' AND (`uid` = '$u' OR `receive_id` = '$u')");
			foreach ($mems as $mems) {
				if ($mems['uid'] == $u) $mue = $mems['receive_id'];
				else $mue = $mems['uid'];
				$mInfo = getRecord('members', "`id` = '$mue' ");
				echo '<option value="u-'.$mInfo['id'].'">'.$mInfo['username'].' ('.$mInfo['type'].')</option>';
			} ?>
						</optgroup>
					</select>
				</dd>
			</dl>
		</div>
		<div class="right" style="width:39%">
			<dl class="line">
				<dt>Thumbnai *</dt>
				<dd><input type="text" name="con-thumbnai" class="required input-img"/></dd>
			</dl>
			<dl class="line">
				<dt>Banner </dt>
				<dd><input type="text" name="con-banner" class="input-img"/></dd>
			</dl>
			<dl class="line">
				<dt>Place </dt>
				<dd><input type="text" name="con-place" class="input-place"/></dd>
			</dl>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="step" id="step-2" alt="Sponsors">
		<h3>Sponsors *</h3>
		<input type="submit" value="Submit" class="right" style="margin-top:-30px"/>
		<div class="con-sponsors">
			<div class="one-con-sponsor con-sponsor-1">
				<input type="text" name="con-sponsors-name-1" placeholder="Sponsor name *" class="con-sponsor-name required"/>
				<input type="text" name="con-sponsors-link-1" placeholder="Sponsor link" class="con-sponsor-link"/>
				<input type="text" name="con-sponsors-logo-1" placeholder="Sponsor logo" class="con-sponsor-logo"/>
			</div>
		</div>
	</div>
	
	<div class="completed-print hide" id="completed-print">
		<h3>Finally!</h3>
		<div class="done-data"></div>
	</div>
</form>

<form method="POST" class="form-mi form-new-contest hide" style="margin-top:10px">
	<h2>Create a contest</h2>
	<div class="done-data"></div>

	<div class="complete-bar">
		<div class="complete-bar-color"></div>
	</div>
	<div class="test-contest-info"></div>
	<div class="step new-event active" id="step-1" alt="Event info">
		<h3>Basic information</h3>
		<div class="left" style="width:56%">
			<dl class="line">
				<dt>Title *</dt>
				<dd>
					<input type="text" name="con-prefix" placeholder="Prefix" style="width:19%"/>
					<input type="text" name="con-title" class="right required" style="width:80%"/>
				</dd>
			</dl>
			<dl class="line">
				<dt>Description *</dt>
				<dd>
					<textarea name="con-des" class="required dafukk" style="height:150px"></textarea>
				</dd>
			</dl>
		</div>
		<div class="right" style="width:42%">
			<dl class="line">
				<dt>Thumbnai *</dt>
				<dd><input type="text" name="con-thumbnai" class="required input-img"/></dd>
			</dl>
			<dl class="line">
				<dt>Banner </dt>
				<dd><input type="text" name="con-banner" class="input-img"/></dd>
			</dl>
			<dl class="line">
				<dt>Place </dt>
				<dd><input type="text" name="con-place" class="input-place"/></dd>
			</dl>
		</div>
		<div class="clearfix"></div>
	</div>

	<div class="step" id="step-2" alt="Generate application form">
		<h3>Generate application form</h3>
		<dl class="line">
			<dt style="width:40%">Does this contest need application form? *</dt> 
			<dd class="confirm-con-form" style="margin-left:42%;width:58%">
				<label class="radio" style="margin-right:20%!important"><input checked type="radio" name="con-form" value="yes"/> Yes</label>
				<label class="radio"><input type="radio" name="con-form" value="no"/> No</label>
				<div class="clearfix"></div>
			</dd>
		</dl>
		<div class="con-form-generate">
			<h4>Then generate your own</h4>
			<div class="gensmall">Click on <red>*</red> to toggle required option.<br/>
			Some fields might be available in their profile already, but for convinience and avoiding fake info, you can still add those fields to your form, we'll extract their info while they're completing the form.</div>
			<div class="c-settings left">
				<dl class="line">
					<dt><label class="checkbox"><input checked type="checkbox" name="con-form-content[]" value="fullname"/> Full Name</label></dt>
					<dd><div class="require-mark">*</div><input disabled type="text" placeholder="Full name"/></dd>
				</dl>
				<dl class="line">
					<dt><label class="checkbox"><input type="checkbox" name="con-form-content[]" value="age"/> Age</label></dt>
					<dd><div class="require-mark">*</div><input disabled type="text" placeholder="Age"/></dd>
				</dl>
				<dl class="line">
					<dt><label class="checkbox"><input type="checkbox" name="con-form-content[]" value="age"/> Gender</label></dt>
					<dd><div class="require-mark">*</div><input disabled type="text" placeholder="Gender"/></dd>
				</dl>
				<dl class="line">
					<dt><label class="checkbox"><input type="checkbox" name="con-form-content[]" value="school"/> School</label></dt>
					<dd><div class="require-mark">*</div><input disabled type="text" placeholder="School"/></dd>
				</dl>
				<dl class="line">
					<dt><label class="checkbox"><input type="checkbox" name="con-form-content[]" value="class"/> Class</label></dt>
					<dd><div class="require-mark">*</div><input disabled type="text" placeholder="Class"/></dd>
				</dl>
			</div>
			<div class="right new-item-thumbs"></div>
		</div>
	</div>

	<div class="step" id="step-3" alt="Settings">
		<div class="c-settings left">
			<h3>Contest Settings</h3>
			<dl class="line line-mar">
				<dt>Who can join *</dt> 
				<dd>
					<label class="radio"><input checked type="radio" name="con-join" value="everyone" id="b-lesson" data-toggle="radio"/> Everyone</label>
					<label class="radio"><input type="radio" name="con-join" value="host-invite" id="b-course" data-toggle="radio"/> Invited by host</label>
					<label class="radio" style="width:100%"><input type="radio" name="con-join" value="approve" id="b-course" data-toggle="radio"/> Everyone but needs approve</label>
					<div class="clearfix"></div>
				</dd>
			</dl>
			<dl class="line">
				<dt>Rounds *</dt> 
				<dd>
					<input type="number" name="con-rounds" min="1" class="required input-number" value="2"/>
				</dd>
			</dl>
			<dl class="line line-mar">
				<dt>Starting</dt> 
				<dd class="con-starting">
					<input type="text" name="con-start-1" class="datepicker required contest-starting" placeholder="Round 1 *"/> <i class="gensmall yes-form">// Contest starting time</i>
					<div class="gensmall">Other rounds can be defined starting time later.</div>
					<input type="text" name="con-start-2" class="datepicker" placeholder="Round 2"/>
				</dd>
				
				<i class="gensmall no-form"></i>
			</dl>
			<dl class="line line-mar">
				<dt>Hosts/Organizers *</dt> 
				<dd>
					<select multiple name="con-hosts[]" class="chosen-select">
							<option selected value="u-<? echo $u ?>"><? echo $member['username'] ?></option>
						<optgroup label="Your pages">
			<? $paggs = $getRecord -> GET('page', "`uid` = '$u' ");
			foreach ($paggs as $paggs) {
				echo '<option value="p-'.$paggs['id'].'">'.$paggs['title'].'</option>';
			} ?>
						</optgroup>
						<optgroup label="Your friends">
			<? $mems = $getRecord -> GET('friend', "`accept` = 'yes' AND (`uid` = '$u' OR `receive_id` = '$u')");
			foreach ($mems as $mems) {
				if ($mems['uid'] == $u) $mue = $mems['receive_id'];
				else $mue = $mems['uid'];
				$mInfo = getRecord('members', "`id` = '$mue' ");
				echo '<option value="u-'.$mInfo['id'].'">'.$mInfo['username'].' ('.$mInfo['type'].')</option>';
			} ?>
						</optgroup>
					</select>
				</dd>
			</dl>
		</div>
		
		<div class="right new-item-thumbs">
			<h3>Prize *</h3>
			<dl class="line">
				<dt>Prize type *</dt> 
				<dd>
					<label class="radio"><input checked type="radio" name="con-prize-type" value="8dot" id="8dot-credits"/> 8dot credits</label>
					<label class="radio"><input type="radio" name="con-prize-type" value="offline-prize" id="offline-prize"/> Offline prize</label>
					<div class="clearfix"></div>
				</dd>
			</dl>
			<div class="8dot-credits con-prize">
				<dl class="line">
					<dt>First prize *</dt> 
					<dd>
						<input type="number" min="1" name="con-first-prize-num" placeholder="Nums *" class="required input-number prize-number">
						<input type="number" min="1" name="con-first-prize-value" placeholder="Value / each *" class="required input-number prize-value">
						<input type="hidden" name="con-first-prize-img" value="<? echo silk ?>/award_star_gold_1.png">
						<span class="trophy"><img src="<? echo silk ?>/award_star_gold_1.png"/></span>
						<div class="trophy-list">
							<img src="<? echo silk ?>/award_star_gold_1.png"/>
							<img src="<? echo silk ?>/award_star_gold_2.png"/>
							<img src="<? echo silk ?>/award_star_gold_3.png"/>
						</div>
					</dd>
				</dl>
				<dl class="line">
					<dt>Second prize *</dt> 
					<dd>
						<input type="number" min="1" value="1" name="con-second-prize-num" placeholder="Nums *" class="required input-number prize-number">
						<input type="number" min="0" value="0" name="con-second-prize-value" placeholder="Value / each *" class="prize-value">
						<input type="hidden" name="con-second-prize-img" value="<? echo silk ?>/award_star_silver_1.png">
						<span class="trophy"><img src="<? echo silk ?>/award_star_silver_1.png"/></span>
						<div class="trophy-list">
							<img src="<? echo silk ?>/award_star_silver_1.png"/>
							<img src="<? echo silk ?>/award_star_silver_2.png"/>
							<img src="<? echo silk ?>/award_star_silver_3.png"/>
						</div>
					</dd>
				</dl>
				<dl class="line">
					<dt>Third prize *</dt> 
					<dd>
						<input type="number" min="1" value="1" name="con-third-prize-num" placeholder="Nums" class="input-number prize-number">
						<input type="number" min="0" value="0" name="con-third-prize-value" placeholder="Value / each" class="prize-value">
						<input type="hidden" name="con-third-prize-img" value="<? echo silk ?>/award_star_bronze_1.png">
						<span class="trophy"><img src="<? echo silk ?>/award_star_bronze_1.png"/></span>
						<div class="trophy-list">
							<img src="<? echo silk ?>/award_star_bronze_1.png"/>
							<img src="<? echo silk ?>/award_star_bronze_2.png"/>
							<img src="<? echo silk ?>/award_star_bronze_3.png"/>
						</div>
					</dd>
				</dl>
			</div>
		</div>
		
		<div class="clearfix"></div>
	</div>

	<div class="step" id="step-4" alt="Sponsors">
		<h3>Sponsors *</h3>
		<input type="submit" value="Submit" class="right" style="margin-top:-30px"/>
		<div class="con-sponsors">
			<div class="one-con-sponsor con-sponsor-1">
				<input type="text" name="con-sponsors-name-1" placeholder="Sponsor name *" class="con-sponsor-name required"/>
				<input type="text" name="con-sponsors-link-1" placeholder="Sponsor link" class="con-sponsor-link"/>
				<input type="text" name="con-sponsors-logo-1" placeholder="Sponsor logo" class="con-sponsor-logo"/>
			</div>
		</div>
	</div>
	
	<div class="completed-print hide" id="completed-print">
		<h3>Finally!</h3>
		<div class="done-data"></div>
	</div>
</form>

<script src="<?php echo JS ?>/stepSetting.js"></script>
<script src="<?php echo JS ?>/eventNew.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS ?>/teacher.css"/>

<?php } ?>
