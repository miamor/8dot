<div id="isotope-wrap">
<?php $eList = $getRecord -> GET('contest', '', '%30', '');
foreach ($eList as $itemList) {
	if ($itemList['did'] == $dot || in_array($itemList['did'], $childDot)) {
		$auth = getRecord('members', "`id` = '{$itemList['uid']}'");
		$dInfo = getRecord('dot', "`id` = '{$itemList['did']}'") ?>
<div class="element-item item-masonry the-box one-item">
	<span class="icon dogear"></span>
	<div class="item-info-top">
		<div class="title">
			<div class="dott dot-<?php echo $dInfo['re'] ?>" alt="<?php echo $dInfo['id'] ?>" title="Dot <?php echo $dInfo['title'] ?>"><span class="dot-color" style="background:<?php echo $dInfo['color'] ?>"></span></div>
			<a style="color:<?php echo $dInfo['color'] ?>" href="#!event?i=<?php echo $itemList['id'] ?>"><?php echo $itemList['title'] ?></a>
		</div>
	</div>
	<div class="item-thumbnai">
		<a href="#!event?i=<?php echo $itemList['id'] ?>"><div class="thumbnai" style="background-image:url(<?php echo $itemList['thumbnai'] ?>)"></div></a>
	</div>
	<div class="item-info">
		<div class="item-sta">
		</div>
	</div>
</div>
<?php }
} ?>
</div>

<script src="<?php echo PLUGINS ?>/isotope/isotope.pkgd.js"></script>
<script>$('#isotope-wrap').html('Loading...').load(MAIN_URL + '/pages/event.php #isotope-wrap > div', function () {
	isoo()
});</script>
<style>#content{padding-right:0}</style>
