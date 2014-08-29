<h3>Topics</h3>
<div class="overflow">
<?php $childDot = array();
$dl = $getRecord -> GET('dot', "`did` = '$dot'", '', '');
foreach ($dl as $dl) array_push($childDot, $dl['id']);
$tList = $getRecord -> GET('topic', '', '', '');
foreach ($tList as $tList) {
	if ($tList['did'] == $dot || in_array($tList['did'], $childDot)) {
		$dInfo = getRecord('dot', "`id` = '{$tList['did']}'");
		$checkFollowTopic = countRecord('topic_follow', "`uid` = '$u' AND `tid` = '{$tList['id']}'"); ?>
	<div class="one-topic <?php if ($checkFollowTopic > 0) echo 'followed' ?>" data-topic="<?php echo $tList['id'] ?>">
		<div class="dott dot-<?php echo $dInfo['re'] ?>" alt="<?php echo $dInfo['id'] ?>" title="Dot <?php echo $dInfo['title'] ?>"><span class="dot-color" style="background:<?php echo $dInfo['color'] ?>"></span></div>
		<a style="color:<?php echo $dInfo['color'] ?>"><?php echo $tList['title'] ?></a>
		<div class="right follow one-topic-follow" alt="<?php if ($checkFollowTopic > 0) echo 'unfollow'; else echo 'follow' ?>">
			 <?php if ($checkFollowTopic <= 0) echo '<span class="fui fui-check"></span> <span class="text hide">Follow</span>';
			 else echo '<span class="fui fui-cross"></span> <span class="text hide">Unfollow</span>' ?>
		</div>
		<div class="gensmall"><?php echo countRecord('topic_follow', "`tid` = '{$tList['id']}'") ?> following</div>
	</div>
<?php }
} ?>
</div>

<script>getTopic();</script>
