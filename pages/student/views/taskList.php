<div class="row task-boxes">
	<div class="col-sm-7">
		<div class="the-box">
			<h3>In progress <span class="badge badge-warning"></span></h3>
			<?php include 'student/views/taskProgress.php' ?>
		</div>
	</div>
	<div class="col-sm-5">
		<div class="the-box">
			<h3>Deadline today <span class="label label-warning right" style="margin-top:3px"><?php echo $today ?></span></h3>
			<?php include 'student/views/taskDeadlineToday.php' ?>
		</div>
	</div>
	<div style="clear:both"></div>

	<div class="col-sm-4">
		<div class="the-box task-list">
			<h3>Undo tasks <span class="badge badge-warning"></span></h3>
			<?php include 'student/views/taskTab.php' ?>
		</div>
	</div>
	<div class="col-sm-4 the-box task-submitted-list">
		<div id="m_tab">
			<div class="m_tab">
				<li class="tab active" id="ungrade">Submitted</li>
				<li class="tab" id="grade">Graded</li>
			</div>
			<div class="tab-index ungrade">
				<?php $grade = 0; include 'student/views/taskSubmitted.php' ?>
			</div>
			<div class="hide tab-index grade">
				<?php $grade = 1; include 'student/views/taskSubmitted.php' ?>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
		<div class="the-box">
			<h3>Out of deadline</h3>
			<?php include 'student/views/taskOutDeadline.php' ?>
		</div>
	</div>
	<div style="clear:both"></div>
	</div>

</div>

<div style="clear:both"></div>

