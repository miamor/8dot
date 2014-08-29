<?php if ($_GET['act'] == 'submit') {
	$dDid = $_POST['d-did'];
	$dTitle = $_POST['d-title'];
	$dName = $_POST['d-name'];
	$dRe = $_POST['d-re'];
	$dColor = $_POST['d-color'];
	$dThumbnai = $_POST['d-thumbnai'];
	$dDes = $_POST['d-des'];
	if ($dName && $dTitle && $dColor && $dDes && $dRe) {
		if (countRecord('dot', "`title` = '$dTitle' ") > 0) echo 'Please choose another title';
		else if (countRecord('dot', "`name` = '$dName' ") > 0) echo 'Please choose another name';
		else if (countRecord('dot', "`re` = '$dRe' ") > 0) echo 'Please choose another name';
		else if (countRecord('dot', "`color` = '$dColor' ") > 0) echo 'Please choose another color';
		else {
			$add = mysql_query("INSERT INTO `dot` (`title`, `did`, `name`, `re`, `color`, `thumbnai`, `content`, `time`) VALUES ('$dTitle', '$dDid', '$dName', '$dRe', '$dColor', '$dThumbnai', '$dDes', '$current')");
			if ($add) echo 'Done!';
		}
	}
} ?>

<form method="post" class="form-new-dot" action="?mode=new&act=submit">
	<input type="text" name="d-did" placeholder="Parent dot"/>
	<input type="text" name="d-re" placeholder="Represent character"/>
	<input type="text" name="d-title" placeholder="Dot title"/>
	<input type="text" name="d-name" placeholder="Dot name"/>
	<input type="text" name="d-color" placeholder="Dot color"/>
	<input type="text" name="d-thumbnai" placeholder="Dot thumbnai"/>
	<textarea name="d-des" placeholder="Dot description"></textarea>
	<input type="reset" value="Reset"/>
	<input type="submit" value="Submit"/>
</form>
