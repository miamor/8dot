<? if ( ($_POST['word'] && $_POST['lang']) || ($_GET['word'] && $_GET['lang']) ) {
	if ($_POST['word']) $word = $_POST['word'];
	else $word = $_GET['word'];
	if ($_POST['lang']) $lang = $_POST['lang'];
	else $lang = $_GET['lang'];
	$getDefine = $getRecord -> GET("dictionary", "`word` = '$word' AND `lang` = '$lang'", '', '`star` DESC');
	echo '<div><a class="contribute-word right" style="margin-top:6px">Contribute translations</a><h3 class="main-title">'.$word.'</h3></div><div class="divide-h"></div>';
	foreach ($getDefine as $getDefine) {
	$deU = getRecord('members', '`id` = '.$getDefine['uid']) ?>
	<div class="w-dict" style="margin-bottom:10px">
		<div style="float:left">
			<div class="left">
			<?php if (strlen(strstr($getDefine['star_list'], $u.', ')) > 0) { ?>
				<a class="iic star star-on star-word" id="add" href="?word=<?php echo $word ?>&lang=<?php echo $lang ?>&id=<?php echo $getDefine['id'] ?>&act=star"></a>
				<div class="favoritecount selected" align="center"><b><?php echo $getDefine['star'] ?></b></div>
			<?php } else { ?>
				<a class="iic star star-off star-word" id="add" href="?word=<?php echo $word ?>&lang=<?php echo $lang ?>&id=<?php echo $getDefine['id'] ?>&act=star"></a>
				<div class="favoritecount off" align="center"><b><?php echo $getDefine['star'] ?></b></div>
			<?php } ?>
			</div>
			<img title="<b><?php echo $deU['username'] ?></b>'s definition" src="<?php echo $deU['avatar'] ?>" class="thumbnai west right">
		</div>
		<ul class="wlist"><?php echo $getDefine['definition'] ?></ul>
	</div>
<?php } ?>
<style>.west{width:45px;height:45px;border-radius:100%;margin-left:6px}
.wlist{list-style:none;padding-left:0;margin-left:95px}
.wlist li{padding-left:15px;border-left:2px solid #ddd;margin-bottom:4px}</style>
<script>$('.contribute-word').click(function () {
	right_board('Contribute word', '', 'dictionary.php?do=add&word=<? echo $word ?>&lang=<? echo $lang ?>', '74%');
});
$('.star-word').click(function () {
	$.ajax({
		url: MAIN_URL + '/pages/dictionary.php' + $(this).attr('href'),
		type: 'post',
		data: $(this).serialize(),
		success: function (data) {
			$('.word-show').html(data);
		}
	});
	return false
})</script>
<? } ?>
