<?php if ($_GET['act'] == 'submit') include 'system/questNew.php';
else { ?>

<h2>Add new quest</h2>

<form method="POST" class="form-mi form-new-lib" id="quest">
	<div class="right" style="margin-top:-35px">
		<input type="submit" value="Submit"/>
		<input type="reset" value="Reset"/>
	</div>
	<div class="clearfix"></div>
	<div class="done-data"></div>

		<div class="c-topic-list left">
			<?php $tList = $getRecord -> GET('topic', "", '', '');
				foreach ($tList as $tList) {
					if ($tList['did'] == $dot || in_array($tList['did'], $childDot)) { ?>
					<div class="c-topic">
						<label class="checkbox" for="q-<?php echo $tList['id'] ?>"><input type="checkbox" name="q-topic[]" value="<?php echo $tList['id'] ?>" id="c-<?php echo $tList['id'] ?>" data-toggle="checkbox"> <?php echo $tList['title'] ?></label>
					</div>
			<?php }
			} ?>
		</div>
		
		<div class="divide-c-green"></div>

		<div class="c-basic-info" style="margin-top:-20px;padding-top:30px">
			<dl class="line">
				<dt>Title *</dt> <dd><input type="text" name="q-title" class="required"/></dd>
			</dl>
			<dl class="line">
				<dt>Quest content *</dt> <dd><textarea name="q-content" class="required" style="height:200px"></textarea></dd>
			</dl>
			<dl class="line">
				<dt>Public for *</dt>
				<dd>
					<label class="radio" for="p-st"><input type="radio" name="q-available"  <?php if ($member['type'] == 'teacher') echo 'disabled' ?> value="student" id="p-st" data-toggle="radio"/> Students</label>
					<label class="radio" for="p-te"><input type="radio" name="q-available"  <?php if ($member['type'] == 'student') echo 'disabled' ?> value="teacher" id="p-te" data-toggle="radio"/> Teachers</label>
					<label class="radio" for="p-stte"><input checked type="radio" name="q-available" value="both" id="p-stte" checked data-toggle="radio"/> Both Students & Teachers</label>
				</dd>
			</dl>
			<dl class="line">
				<dt>Extra coin </dt> <dd><input type="number" min="0" name="q-coin"/></dd>
			</dl>
		</div>
</form>

<script type="text/javascript" src="<?php echo JS ?>/libNew.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS ?>/teacher.css"/>

<?php } ?>
