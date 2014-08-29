<div id="m_tab">
	<ul class="m_tab">
		<li class="tab active" id="c-lesson-list">All (<b class="cmt_num"><span><?php echo countRecord('lesson', "`cid` = '$c'") ?></span></b>)</li>
	</ul>
	<div class="tab-index c-lesson-list">
	
<?php $lList = $getRecord -> GET('course_test', "`cid` = '$c'", '10', '');
	foreach ($lList as $lList) {
		$tDay = intval(date('d')); $tMonth = intval(date('m')); $tYear = intval(date('Y'));
		$dead = explode('-', $task['deadline']);
		$dDay = intval($dead[0]); $dMonth = intval($dead[1]); $dYear = intval($dead[2]);
		if ($today == $task['deadline']) $label = 'warning';
		else if ($tYear < $dYear) $label = 'danger';
		else if ($tYear > $dYear) $label = 'primary';
		else {
			if ($tMonth > $dMonth) $label = 'primary';
			else if ($tMonth < $dMonth) $label = 'danger';
			else {
				if ($tDay < $dDay) $label = 'primary';
				else if ($tDay > $dDay) $label = 'danger';
			}
		} ?>
		<div class="c-one-lesson the-box" style="margin-bottom:20px">
			<span class="right gensmall"><span class="fa fa-clock-o"></span> <?php echo $lList['time'] ?></span>
				<img class="c-one-lesson-thumb left" src="<?php echo $lList['thumbnai'] ?>"/>
				<a class="a-title title bold" href="#!course?c=<? echo $c ?>&t=exam&e=<? echo $lList['id'] ?>"><?php if ($lList['prefix']) echo '<span class="prefix">'.$lList['prefix'].'</span>'; echo ''.$lList['title'] ?> <span class="label label-danger"><? echo $lList['test_time'] ?></span></a>
			<div class="shorten"><?php echo $lList['des'] ?></div>
			<div class="right c-one-lesson-links">
	<?php echo '<a class="btn btn-perspective btn-'.$label.' btn-sm" href="#!course?c='.$c.'&t=exam&e='.$lList['id'].'">'.$lList['deadline'].'</a>';  ?>
			</div>
		</div>
<?php } ?>
	</div>
</div>
