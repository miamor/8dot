<?php include '../lib/config.php';
include 'system/schedule.php' ?>

<link href='assets/plugins/fullcalendar/fullcalendar.css' rel='stylesheet' />
<script src='assets/plugins/fullcalendar/lib/moment.min.js'></script>
<!--<link href='assets/plugins/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='../lib/jquery.min.js'></script>
<script src='../lib/jquery-ui.custom.min.js'></script>
<script src='assets/plugins/sceditor/minified/jquery.sceditor.js'></script>-->
<script src='assets/plugins/fullcalendar/fullcalendar.min.js'></script>
<script src="<?php echo JS ?>/calendar.js"></script>

	<div class="the-box heading bg-primary full-width no-border">
		<h1 class="no-padding no-margin"><i class="fa fa-calendar icon-lg icon-circle icon-bordered"></i> Schedule</h1>
	</div>
	
	<div class='the-box full-width no-border'>
		<div id='external-events'>
			<h4>Draggable Events</h4>
	<?php $ev = $getRecord -> GET('calendar', "`uid` = '$u' ");
		$evArray = array();
		foreach ($ev as $ev) {
			if (!in_array($ev['title'], $evArray)) {
				array_push($evArray, $ev['title']) ?>
			<div class="external-event" <?php echo 'data-id="'.$ev['id'].'" data-bg="'.$ev['bg'].'" data-color="'.$ev['color'].'" data-url="'.$ev['url'].'"' ?> style="<?php if (!$ev['bg']) echo '*'; echo 'background:'.$ev['bg'].';'; if (!$ev['color']) echo '*'; echo ' color:'.$ev['color'].';' ?>">
				<?php echo $ev['title'] ?>
			</div>
	<?php 	}
		} ?>
			<p><label class="checkbox" style="margin-left:0!important">
				<input type='checkbox' id='drop-remove' />
				Remove after drop
			</label></p>
			<div class="sb-open btn btn-primary" id="newevent">Add</div>
		</div>

		<div id='calendar' style="width:84%"></div>
		
		<div class="hide small-board-fixed"></div>
		<div class="hide small-board sb-newevent">
			<h3>Add new event</h3>
			<form method="post" class="form-new-event">
				<dl class="line line-mar">
					<dt>Title *</dt>
					<dd><input type="text" name="en_title"/></dd>
				</dl>
				<dl class="line line-mar">
					<dt>Description </dt>
					<dd><textarea name="en_des" style="width:100%!important;height:100px"></textarea></dd>
				</dl>
				<dl class="line line-mar">
					<dt>URL </dt>
					<dd><input type="text" name="en_url"/></dd>
				</dl>
				<dl class="line line-mar">
					<dt>Duration <label class="checkbox" title="Allday"><input type="checkbox" name="en_allday" value="true"/></label></dt>
					<dd>
						<input type="text" name="en_start" placeholder="Start" class="left start-event" style="width:48%"/>
						<input type="text" name="en_end" placeholder="End" class="right end-event" style="width:48%"/>
						<div style="clear:both"></div>
					</dd>
				</dl>
				<dl class="line line-mar">
					<dt>Settings </dt>
					<dd>
						<input type="text" name="en_bg" placeholder="Background" class="left" style="width:48%"/>
						<input type="text" name="en_color" placeholder="Text color" class="right" style="width:48%"/>
						<div style="clear:both"></div>
					</dd>
				</dl>
				<div class="new-event-submit right">
					<input type="reset" value="Reset"/>
					<input type="submit" value="Submit"/>
				</div>
			</form>
		</div>

		<div class="hide small-board-fixed"></div>
		<div class="hide small-board sb-editevent">
			<h3>Edit/Remove event</h3>
			<form method="post" class="form-edit-event"><span>
<?php $ev = $_GET['id'];
	$eve = getRecord('calendar', "`id` = '$ev' ") ?>
				<dl class="line line-mar">
					<dt>Title *</dt>
					<dd><input type="text" name="ee_title" value="<?php echo $eve['title'] ?>"/></dd>
				</dl>
				<dl class="line line-mar">
					<dt>Description </dt>
					<dd><textarea name="ee_des" style="width:100%!important;height:100px"><?php echo $eve['des'] ?></textarea></dd>
				</dl>
				<dl class="line line-mar">
					<dt>URL </dt>
					<dd><input type="text" name="ee_url" value="<?php echo $eve['url'] ?>"/></dd>
				</dl>
				<dl class="line line-mar">
					<dt>Duration <label class="checkbox" title="Allday"><input type="checkbox" name="ee_allday" value="true"/></label></dt>
					<dd>
						<input type="text" name="ee_start" value="<?php echo $eve['start'] ?>" placeholder="Start" class="left start-event" style="width:48%"/>
						<input type="text" name="ee_end" value="<?php echo $eve['end'] ?>" placeholder="End" class="right end-event" style="width:48%"/>
						<div style="clear:both"></div>
					</dd>
				</dl>
				<dl class="line line-mar">
					<dt>Settings </dt>
					<dd>
						<input type="text" name="ee_bg" value="<?php echo $eve['bg'] ?>" placeholder="Background" class="left" style="width:48%"/>
						<input type="text" name="ee_color" value="<?php echo $eve['color'] ?>" placeholder="Text color" class="right" style="width:48%"/>
						<div style="clear:both"></div>
					</dd>
				</dl>
				<div class="left">
					<a class="btn btn-success act-edit-event" id="complete"><span class="fa fa-check-circle-o"></span> Completed</a>
					<a class="btn btn-danger act-edit-event" id="remove"><span class="fa fa-times-circle"></span> Remove</a>
				</div>
				<div class="new-event-submit right">
					<input type="submit" value="Submit"/>
				</div>
			</span></form>
		</div>

		<div style='clear:both'></div>

	</div>
