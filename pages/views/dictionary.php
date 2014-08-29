<? if ( ($_POST['word'] && $_POST['lang']) || ($_GET['word'] && $_GET['lang']) ) include 'views/dictionaryWordShow.php';
else { ?>

<a href="#!dictionary?do=add" class="new-word right" style="margin-top:6px">New word</a>

<form type="post" class="searchword">
	<div class="word-input-box" style="margin-bottom:6px">
		<input type="text" name="word" style="width:80%" placeholder="Input a word"/>
		<input type="submit" value="Submit" style="margin-top:-3px"/>
	</div>
	<label class="radio">
		<input type="radio" name="lang" tabindex="1" checked value="en-en" id="en"> English - English
	</label>
	<label class="radio">
		<input type="radio" name="lang" tabindex="2" value="en-vi" id="vi"> English - Vietnamese
	</label>
	<label class="radio">
		<input type="radio" name="lang" tabindex="2" value="vi-en" id="vi"> Vietnamese - English
	</label>
	<label class="radio">
		<input type="radio" name="lang" tabindex="2" value="fr-en" id="vi"> France - English
	</label>
	<div class="clearfix"></div>
</form>

<div class="word-show">
</div>

<script type="text/javascript" src="<?php echo JS ?>/dictionary.js"></script>

<? } ?>
