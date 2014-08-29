<?php if ($_GET['act'] == 'submit') include 'system/lessonNew.normal.php';
else { ?>

<h2>Add new lesson (<span class="cuprum"><?php echo $cInfo['title'] ?></span>)</h2>

<div class="done-data"></div>

<form method="POST" class="form-mi form-new-lesson" data-course="<?php echo $c ?>">
	<div class="l-basic-info right">
		<h3>Basic information</h3>
		<dl class="line">
			<dt>Title *:</dt> <dd><input placeholder="Prefix (optional)" type="text" name="l-prefix" style="width:19%"/> <input type="text" name="l-title" class="required" style="width:80%"/></dd>
		</dl>
		<dl class="line">
			<dt>Thumbnai *:</dt> <dd><input type="text" name="l-thumbnai" class="input-img required"/></dd>
		</dl>
		<dl class="line">
			<dt>Document *:</dt> <dd><input type="text" name="l-document" class="input-link required"/></dd>
		</dl>
		<dl class="line">
			<dt>Video :</dt> <dd><input type="text" name="l-video"/></dd>
		</dl>
		<dl class="line">
			<dt>Content *:</dt> <dd><textarea name="l-content" class="required"></textarea></dd>
		</dl>
	</div>
	<div class="l-settings">
		<h3>Lesson setting</h3>
		<dl class="line">
			<dt>Price *:</dt> <dd><input type="number" name="l-price" class="input-number required" <?php if ($cInfo['price-type'] == 'one-price') echo 'value="'.$cInfo['price'].'" disabled' ?> style="width:70%"/> $c</dd>
		</dl>
	</div>
	
	<div style="margin-top:10px">
		<input type="submit" value="Submit"/>
		<input type="reset" value="Reset"/>
	</div>
</form>



<?php } ?>
