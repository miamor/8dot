<?php if ($_GET['act'] == 'submit') include 'system/lessonEdit.php';
else { ?>

<h2>Edit lesson (<span class="cuprum"><?php echo $lInfo['title'] ?></span>)</h2>

<div class="done-data"></div>

<form method="POST" class="form-mi form-edit-lesson" data-course="<?php echo $c ?>" data-lesson="<?php echo $l ?>">
	<div class="l-basic-info right">
		<h3>Basic information</h3>
		<dl class="line">
			<dt>Title *:</dt> <dd><input placeholder="Prefix (optional)" type="text" name="l-prefix" style="width:19%" value="<?php echo $lInfo['prefix'] ?>"/> <input type="text" name="l-title" class="required" style="width:71%" value="<?php echo $lInfo['title'] ?>"/></dd>
		</dl>
		<dl class="line">
			<dt>Thumbnai *:</dt> <dd><input type="text" name="l-thumbnai" class="input-img required" value="<?php echo $lInfo['thumbnai'] ?>"/></dd>
		</dl>
		<dl class="line">
			<dt>Document *:</dt> <dd><input type="text" name="l-document" class="input-link required" value="<?php echo $lInfo['document'] ?>"/></dd>
		</dl>
		<dl class="line">
			<dt>Video :</dt> <dd><input type="text" name="l-video" value="<?php echo $lInfo['video'] ?>"/></dd>
		</dl>
		<dl class="line">
			<dt>Content *:</dt> <dd><textarea name="l-content" class="required"><?php echo $lInfo['content'] ?>"</textarea></dd>
		</dl>
	</div>
	<div class="l-settings">
		<h3>Lesson setting</h3>
		<dl class="line">
			<dt>Price *:</dt> <dd><input type="number" name="l-price" class="input-number required" <?php if ($cInfo['price'] != 0) echo 'value="'.$cInfo['price'].'" disabled'; else echo $lInfo['price'] ?> style="width:60%"/> $c</dd>
		</dl>
	</div>
	
	<div style="margin-top:10px">
		<input type="submit" value="Submit"/>
		<input type="reset" value="Reset"/>
	</div>
</form>

<?php } ?>

<script type="text/javascript" src="<?php echo JS ?>/lessonEdit.js"></script>
