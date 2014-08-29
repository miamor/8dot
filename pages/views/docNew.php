<?php if ($_GET['act'] == 'submit') include 'system/docNew.php';
else { ?>

<h2>Add new document</h2>

<form method="POST" class="form-mi form-new-lib" id="document">
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
						<label class="checkbox" for="d-<?php echo $tList['id'] ?>"><input type="checkbox" name="d-topic[]" value="<?php echo $tList['id'] ?>" id="d-<?php echo $tList['id'] ?>" data-toggle="checkbox"> <?php echo $tList['title'] ?></label>
					</div>
			<?php }
			} ?>
		</div>
		
		<div class="divide-c-green"></div>

		<div class="c-basic-info" style="margin-top:-20px;padding-top:30px">
			<dl class="line">
				<dt>Title *</dt> <dd><input type="text" name="d-title" class="required"/></dd>
			</dl>
			<dl class="line">
				<dt>Document frame *</dt> <dd><input type="text" name="d-frame" class="required input-link"/></dd>
			</dl>
			<dl class="line">
				<dt>Public for *</dt>
				<dd>
					<label class="radio" for="p-st"><input type="radio" name="d-available" <?php if ($member['type'] == 'teacher') echo 'disabled' ?> value="student" id="p-st" data-toggle="radio"/> Students</label>
					<label class="radio" for="p-te"><input type="radio" name="d-available" <?php if ($member['type'] == 'student') echo 'disabled' ?> value="teacher" id="p-te" data-toggle="radio"/> Teachers</label>
					<label class="radio" for="p-stte"><input checked type="radio" name="d-available" value="both" id="p-stte" checked data-toggle="radio"/> Both Students & Teachers</label>
				</dd>
			</dl>
			<dl class="line">
				<dt>Price </dt> <dd><input type="number" min="0" name="d-price" style="width:30%"/> <span class="text-info" style="margin-left:20px"><span class="fa fa-bell"></span> To share is to joy</span></dd>
			</dl>
		</div>
</form>

<script type="text/javascript" src="<?php echo JS ?>/libNew.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CSS ?>/teacher.css"/>

<?php } ?>
