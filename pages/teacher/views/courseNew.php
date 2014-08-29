<?php if ($_GET['act'] == 'submit') include 'system/courseNew.php';
else { ?>

<h2>Create new course</h2>

<form method="POST" class="form-mi form-new-course">
	<div class="complete-bar">
		<div class="complete-bar-color"></div>
	</div>

	<div class="step active" id="step-1" alt="Chose course type">
		<h3>Which type of course?</h3>
		Define which type of course do you want to create<br/>

<!--		<label for="normal-c" class="choose-type"><input type="radio" name="c-type" value="Normal course" id="normal-c"/> Normal course</label>
		<br/>
		<label for="interact-c" class="choose-type"><input <?php if ($member['coin'] < 5) echo 'disabled="yes"' ?> type="radio" name="c-type" value="Interact course" id="interact-c"/> Interact course</label>
		<span class="tip" style="color:#a1a9b3" title="Advanced course. Required 5c for this.">?</span>
-->		<div class="type-course choose-type normal">
			<h3>Normal course</h3>
			Create a normal course with lessons and exercises.
		</div>
		<div class="type-course choose-type interact">
			<h3>Interact course</h3>
			Create an advanced course with interaction between teachers - students.
		</div>
		<div class="clearfix"></div>
		<div class="step-1-info">* <i>You haven't chosen any type.</i></div>
		<input type="hidden" name="c-type"/>
	</div>

	<div class="step" id="step-2" alt="Course settings">
		<div class="c-settings left">
			<h3>Course settings</h3>
			<dl class="line">
				<dt>Tickets type * <?php if ($member['reputation'] < 20) echo '<span class="tip" style="color:#a1a9b3" title="Oops! You need to have at least 20 reputation to choose this."><span class="fa fa-exclamation-circle"></span></span>' ?></dt> 
				<dd class="c-pay">
					<label class="radio" for="b-lesson"><input checked <?php if ($member['reputation'] < 20) echo 'disabled="yes"' ?> type="radio" name="c-pay" value="by-lesson" id="b-lesson" data-toggle="radio"/> By each lesson</label>
					<label class="radio" for="b-course"><input <?php if ($member['reputation'] < 20) echo 'disabled="yes"' ?> type="radio" name="c-pay" value="by-course" id="b-course" data-toggle="radio"/> By whole course </label>
					<input type="hidden" value="by-lesson" name="c-pay-hidden"/>
				</dd>
			</dl>
			<dl class="line c-priice">
				<dt>Price per tick *</dt> 
				<dd class="c-price by-lesson">
					<label class="radio" for="one-price"><input type="radio" name="c-price-type" checked value="one-price" id="one-price" data-toggle="radio"/> One price</label>
					<label class="radio" for="many-price"><input type="radio" name="c-price-type" value="many-price" id="many-price" data-toggle="radio"/> Depend on each lesson</label>
					<div class="price-course"><input type="number" name="c-price-by-lesson" class="required input-number" min="0"/></div>
				</dd>
				<dd class="c-price by-course hide"><input type="number" name="c-price-by-course" class="required input-number" min="0"/></dd>
			</dl>
			<dl class="line c-priice-normal for-interact hide">
				<dt>Price/tick <i class="gensmall">Normal</i> *</dt> 
				<dd class="c-price-normal by-lesson">
					<label class="radio" for="one-price-normal"><input type="radio" name="c-price-normal-type" checked value="one-price" id="one-price-normal" data-toggle="radio"/> One price</label>
					<label class="radio" for="many-price-normal"><input type="radio" name="c-price-normal-type" value="many-price" id="many-price-normal" data-toggle="radio"/> Depend on each lesson</label>
					<div class="price-course-normal"><input type="number" name="c-price-normal" class="required input-number" min="0"/></div>
				</dd>
				<dd class="c-price-normal by-course hide"><input type="number" name="c-price-normal" class="required input-number" min="0"/></dd>
			</dl>
			<dl class="line">
				<dt>Public ticks * <span class="fa fa-exclamation-circle" title="Oops! We're still working on this"></span></dt> 
				<dd>
					<label class="radio" for="p-auto"><input checked disabled type="radio" name="c-tick-public" value="auto" id="p-auto" data-toggle="radio"/> Automatic</label>
					<label class="radio" for="p-edit"><input disabled type="radio" name="c-tick-public" value="edit" id="p-edit" data-toggle="radio"/> I'll public myself </label>
				</dd>
			</dl>
			<dl class="line there-col">
				<dt>Ticks available *</dt> 
				<dd>
					<label class="radio" for="p-st"><input checked type="radio" name="c-tick-available" value="student" id="p-st" data-toggle="radio"/> Students</label>
					<label class="radio" for="p-te"><input type="radio" name="c-tick-available" value="teacher" id="p-te" data-toggle="radio"/> Teachers</label>
					<label class="radio" for="p-stte"><input checked type="radio" name="c-tick-available" value="both" id="p-stte" data-toggle="radio"/> Both</label>
				</dd>
			</dl>
			<dl class="line privacy">
				<dt>Privacy *</dt> 
				<dd>
					<label class="radio" for="p-public" title="<b>Public.</b> This will allow everyone (who is in availability) to access this course."><input checked type="radio" name="c-privacy" value="public" id="p-public" data-toggle="radio"/> <span class="fa fa-globe"></span></label>
					<label class="radio" for="p-exclude" title="Public this course to everyone <b>excludes</b>..."><input type="radio" name="c-privacy" value="exclude" id="p-exclude" data-toggle="radio"/> <span class="fa fa-minus-square"></span></label>
					<label class="radio" for="p-include" title="Public this course to only <b>these</b> people..."><input type="radio" name="c-privacy" value="include" id="p-include" data-toggle="radio"/> <span class="fa fa-plus-square"></span></label>
					<label class="radio" for="p-link" title="Only who gets <b>link</b> can access to this course."><input type="radio" name="c-privacy" value="link" id="p-link" data-toggle="radio"/> <span class="fa fa-link"></span></label>
					<label class="radio" for="p-trash" title="This option will create a course to <b>draff</b>. You can still republic or remove it anytime."><input type="radio" name="c-privacy" value="trash" id="p-trash" data-toggle="radio"/> <span class="fa fa-trash-o"></span></label>
					<div class="public-list-div hide">
						<select name="c-people-list[]" multiple class="chosen-select public-list" data-placeholder="Choose from your friendlists...">
					<?php $fList = $getRecord -> GET('friend', "`accept` = 'yes' AND (`uid` = '$u' OR `receive_id` = '$u')");
						foreach ($fList as $fList) {
							if ($fList['uid'] == $u) $fid = $fList['receive_id'];
							else $fid = $fList['uid'];
							$fInfo = getRecord('members', "`id` = '$fid'");
							echo '<option value="'.$fid.'">'.$fInfo['username'].' <i class="gensmall">('.$fInfo['type'].')</i></option>';
						} ?>
						</select>
					</div>
				</dd>
			</dl>
			<div class="for-interact hide" style="margin-top:15px">
				<h4>Advanced course settings</h4>
				<dl class="line">
					<dt>Lesson during *</dt>
					<dd class="c-duration-ty">
						<label class="radio" for="one-du"><input type="radio" name="c-duration-type" checked value="one-du" id="one-du" data-toggle="radio"/> For all</label>
						<label class="radio" for="day-du"><input type="radio" name="c-duration-type" value="day-du" id="day-du" data-toggle="radio"/> Depend on each one</label>
						<div class="course-during"><input type="number" name="c-duration" class="required input-number" min="10"/></div>
					</dd>
				</dl>
				<dl class="line line-mar">
					<dt>Limit students *</dt> <dd><input type="number" name="c-limit" class="required input-number" min="20" value="20"/></dd>
				</dl>
				<dl class="line schedule line-mar">
					<dt>Schedule *</dt> 
					<dd>
						<select name="c-day[]" multiple data-placeholder="Select days" class="chosen-select select-block c-day">
							<option value="Monday" selected>Monday</option>
							<option value="Tuesday">Tuesday</option>
							<option value="Wednesday">Wednesday</option>
							<option value="Thursday">Thursday</option>
							<option value="Friday">Friday</option>
							<option value="Saturday">Saturday</option>
							<option value="Sunday">Sunday</option>
						</select>
					</dd>
					<dl class="line">
						<dt>Starting time *</dt>
						<dd class="c-time-choose">
							<label class="radio" for="one-time"><input type="radio" name="c-time-type" checked value="one-time" id="one-time" data-toggle="radio"/> One time for everyday</label>
							<label class="radio" for="day-time"><input type="radio" name="c-time-type" value="day-time" id="day-time" data-toggle="radio"/> Depend on each day</label>
							<div class="time-course">
								<div class="one-time cc-time">
									<input type="hidden" name="c-time" class="required input-number" value="20:00"/>
									<input type="number" name="c-hour" class="required input-number" min="00" max="23"/> :
									<select name="c-minute">
										<option value="00" selected>00</option>
										<option value="30">30</option>
									</select>
									<i style="color:#a1a9b3">// Set time for all lessons</i>
								</div>
								<div class="day-time hide cc-time"></div>
							</div>
						</dd>
					</dl>
				</dl>
			</div>
		</div>
		<div class="c-ava right new-item-thumbs">
			<h3>Course thumbnais</h3>
			<div class="all-thumbnais">
				<input type="text" class="required input-img" name="c-thumbnai" placeholder="Input main thumbnai *"/>
				<div class="addbox minibutton right"><i class="fa fa-plus"></i></div>
				<div class="thums" id="">
					<input type="text" class="more-thumb" name="thumb1" id="thumb1" placeholder="Thumbnai 1"/>
					<input type="text" class="more-thumb" name="thumb2" id="thumb2" placeholder="Thumbnai 2"/>
					<input type="text" class="more-thumb" name="thumb3" id="thumb3" placeholder="Thumbnai 3"/>
				</div>
			</div>
		</div>
	</div>
	
	<div class="step" id="step-3" alt="Fill in basic information" style="padding-top:5px">
			<div class="done-data" style="margin-top:-6px;padding-bottom:15px"></div>
		<input class="right" type="submit" value="Submit" style="margin-top:-10px"/>
			<h3 class="left" style="margin-top:0!important">Topic *</h3>
			<div class="c-topic-list left">
			<?php $tList = $getRecord -> GET('topic', "", '', '');
				foreach ($tList as $tList) {
					if ($tList['did'] == $dot || in_array($tList['did'], $childDot)) { ?>
					<div class="c-topic">
						<label class="checkbox" for="c-<?php echo $tList['id'] ?>"><input type="checkbox" name="c-topic[]" value="<?php echo $tList['id'] ?>" id="c-<?php echo $tList['id'] ?>" data-toggle="checkbox"> <?php echo $tList['title'] ?></label>
					</div>
			<?php }
			} ?>
			</div>
		
		<div class="divide-c-green"></div>

		<div class="c-basic-info" style="margin-top:-5px">
			<h3 style="width:60%;margin:5px 0 0 10px!important">Basic information</h3>
			<dl class="line">
				<dt>Title *:</dt> <dd><input type="text" name="c-title" class="required"/></dd>
			</dl>
			<dl class="line">
				<dt>Description *:</dt> <dd><textarea name="c-des" class="required" style="height:140px"></textarea></dd>
			</dl>
		</div>
	</div>
	
	<div class="completed-print hide" id="completed-print">
		<h3>Finally!</h3>
		<div class="done-data"></div>
	</div>
</form>

<script src="<?php echo JS ?>/stepSetting.js"></script>
<script src="<?php echo JS ?>/checkValidNew.js"></script>
<script src="<?php echo JS ?>/courseNew.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS ?>/teacher.css"/>

<?php } ?>
