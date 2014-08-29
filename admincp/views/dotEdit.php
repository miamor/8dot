<?php $dotInfo = getRecord('dot', "`id` = '$iid' ");
if ($_GET['act'] == 'submit') {
	$dDid = $_POST['d-did'];
	$dTitle = $_POST['d-title'];
	$dName = $_POST['d-name'];
	$dRe = $_POST['d-re'];
	$dColor = $_POST['d-color'];
	$dThumbnai = $_POST['d-thumbnai'];
	$dDes = $_POST['d-des'];
	if ($dName && $dTitle && $dColor && $dDes && $dRe) {
		if (countRecord('dot', "`title` = '$dTitle' ") > 1) echo 'Please choose another title';
		else if (countRecord('dot', "`name` = '$dName' ") > 1) echo 'Please choose another name';
		else if (countRecord('dot', "`re` = '$dRe' ") > 1) echo 'Please choose another name';
		else if (countRecord('dot', "`color` = '$dColor' ") > 1) echo 'Please choose another color';
		else {
			$add = changeValue('dot', "`id` = '$iid' ", "`title` = '$dTitle', `did` = '$dDid', `name` = '$dName', `re` = '$dRe', `color` = '$dColor', `thumbnai` = '$dThumbnai', `content` = '$dDes' ");
			if ($add) echo 'Done!';
		}
	} else echo 'Please fill in all required fields.';
} ?>

<form method="post" class="form-new-dot" action="?mode=edit&i=<?php echo $iid ?>&act=submit">
	<input type="text" name="d-did" placeholder="Parent dot" value="<?php echo $dotInfo['did'] ?>"/>
	<input type="text" name="d-re" placeholder="Represent character" value="<?php echo $dotInfo['re'] ?>"/>
	<input type="text" name="d-title" placeholder="Dot title" value="<?php echo $dotInfo['title'] ?>"/>
	<input type="text" name="d-name" placeholder="Dot name" value="<?php echo $dotInfo['name'] ?>"/>
	<input type="text" name="d-color" placeholder="Dot color" value="<?php echo $dotInfo['color'] ?>"/>
	<input type="text" name="d-thumbnai" placeholder="Dot thumbnai" value="<?php echo $dotInfo['thumbnai'] ?>"/>
	<textarea name="d-des" placeholder="Dot description"><?php echo $dotInfo['content'] ?></textarea>
	<input type="reset" value="Reset"/>
	<input type="submit" value="Submit"/>
</form>
