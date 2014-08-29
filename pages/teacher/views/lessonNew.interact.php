<?php if ($_GET['act'] == 'submit') include 'system/lessonNew.interact.php';
else { ?>

<h2>Add new lesson (<span class="cuprum"><?php echo $cInfo['title'] ?></span>)</h2>

<div class="done-data"></div>

<form method="POST" class="form-mi form-new-lesson" data-course="<?php echo $c ?>">
	<div class="l-basic-info right" style="width:60%">
		<h3>Basic information</h3>
		<dl class="line">
			<dt>Title *</dt> <dd><input placeholder="Prefix (optional)" type="text" name="l-prefix" style="width:19%"/> <input type="text" name="l-title" class="required" style="width:79%"/></dd>
		</dl>
		<dl class="line">
			<dt>Thumbnai *</dt> <dd><input type="text" name="l-thumbnai" class="input-img required"/></dd>
		</dl>
		<dl class="line">
			<dt>Document </dt> <dd><input type="text" name="l-document" class="input-link"/></dd>
		</dl>
		<dl class="line">
			<dt>Video </dt> <dd><input type="text" name="l-video"/></dd>
		</dl>
		<dl class="line">
			<dt>Content </dt> <dd><textarea name="l-content"></textarea></dd>
		</dl>
	</div>
	<div class="l-settings" style="width:38%;margin:0">
		<h3>Lesson setting</h3>
		<dl class="line">
			<dt>Duration *</dt> <dd><input type="number" name="l-duration" class="input-number required" min="10" <?php if ($cInfo['duration'] != 0) echo 'value="'.$cInfo['duration'].'" disabled' ?> style="width:60%"/>  (<i class="gensmall">minutes</i>)</dd>
		</dl>
		<dl class="line">
			<dt>Price *</dt> <dd><input type="number" name="l-price" class="input-number required" <?php if ($cInfo['price-type'] == 'one-price') echo 'value="'.$cInfo['price'].'" disabled' ?> style="width:80%"/> $c</dd>
		</dl>
		<dl class="line">
			<dt>Price (<i class="gensmall">Normal</i>) *</dt> <dd><input type="number" name="l-price-normal" class="input-number required" <?php if ($cInfo['price-normal-type'] == 'one-price') echo 'value="'.$cInfo['price_normal'].'" disabled' ?> style="width:80%"/> $c</dd>
		</dl>
	</div>
	
	<div style="margin-top:10px">
		<input type="submit" value="Submit"/>
		<input type="reset" value="Reset"/>
	</div>
</form>



<?php } ?>
