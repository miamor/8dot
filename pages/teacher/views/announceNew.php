<?php if ($_GET['act'] == 'submit') include 'system/announceNew.php';
else { ?>

<h2>Add new announcement (<span class="cuprum"><?php echo $cInfo['title'] ?></span>)</h2>

<div class="done-data"></div>

<form method="POST" class="form-mi form-new-announce" data-course="<?php echo $c ?>">
		<dl class="line">
			<dt>Title *:</dt>
			<dd>
				<select name="a-prefix" style="width:19%">
					<option value="announce">Annouce</option>
					<option value="sticky">Sticky</option>
					<option value="note">Note</option>
					<option value="rule">Rule</option>
				</select>
				<input type="text" name="an-title" class="right required" style="width:80%"/>
			</dd>
		</dl>
		<dl class="line">
			<dt>Thumbnai *:</dt> <dd><input type="text" name="a-thumbnai" class="input-img required"/></dd>
		</dl>
		<dl class="line">
			<dt>Content *:</dt> <dd><textarea name="a-content" class="required"></textarea></dd>
		</dl>
	
	<div style="margin-top:10px">
		<input type="submit" value="Submit"/>
		<input type="reset" value="Reset"/>
	</div>
</form>

<?php } ?>

<script type="text/javascript" src="<?php echo JS ?>/announceNew.js"></script>
