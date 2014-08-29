<?php if ($_GET['act']) include 'system/lessonAddEx.php';
else {
	$taskInfo = getRecord('task', "`lid` = '$l'") ?>

<script src="<?php echo JS ?>/lessonAddEx.js"></script>

<div class="alerts alert-classic right" style="width:400px;margin:10px 30px 0">
	<img src="<?php echo IMG ?>/stress.jpg" class="right" style="height:30px"/>
	<blockquote>Too much homework can cause students stress, depression and lower grades!</blockquote>
</div>

<h3>Add task to lesson <span class="bold"><?php if ($lInfo['prefix']) echo '['.$lInfo['prefix'].'] '; echo $lInfo['title'] ?></span></h3>

<div class="line" style="margin-top:10px">
	<div class="left" style="margin:6px 10px 0 0">Deadline *</div> 
	<div class="left">
		<?php if (countRecord('task', "`lid` = '$l'") <= 0) echo '<input type="text" class="datepicker" style="width:253px"><input type="text" class="hide deadline-hidden">';
			else echo '<input type="text" class="datepicker" disabled style="width:253px" value="'.$taskInfo['deadline'].'"><input type="text" class="hide deadline-hidden" value="'.$taskInfo['deadline'].'">'; ?>
	</div>
		<div class="public-action left"><div>
	<? if (countRecord('task', "`lid` = '$l' AND `public` = 'yes' ") > 0) { ?>
		<div class="fa fa-globe" style="color:#37bc9b" id="<? echo $taskInfo['id'] ?>" title="This task is published"></div>
	<? } else { ?>
		<div class="fa fa-globe public-task" id="<? echo $taskInfo['id'] ?>" title="Public this task"></div>
	<? } ?>
		</div></div>
</div>

<div class="add-ex-alert" style="clear:both;padding-top:10px"></div>

<div class="add-ex-tab">
<?php if ($taskInfo['public'] == 'yes') 
	echo '<div class="alerts alert-warning">This task is published. You can no longer add/edit exercise in it.</div>';
else { ?>

<div class="alerts alert-info">
	Use tab below to add tasks to this lesson.<br/>
	We suggest using ex available for <b class="label label-danger">teachers</b> only, which does not allow students to access (ect view/read/add) solution/result from ex storage.
</div>

<div style="clear:both"></div>

<?php $tcList = explode(',', $cInfo['tid']) ?>
<div id="m_tab">
	<div class="m_tab">
		<li class="tab active" id="f-teacher">For teachers</li>
		<li class="tab" id="all">All <span class="label label-danger">Not recommended</span></li>
	</div>

	<div class="tab-index f-teacher">
		<?php $condition = "`available` = 'teacher'";
			include 'lessonAddExerciseTab.php'?>
	</div>
	
	<div class="hide tab-index all">
		<?php $condition = '';
			include 'lessonAddExerciseTab.php'?>
	</div>
</div>

<?php }
} ?>
</div>
