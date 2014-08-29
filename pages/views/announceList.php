<div id="m_tab">
	<ul class="m_tab">
		<li class="tab active" id="c-lesson-list">All (<b class="cmt_num"><span><?php echo countRecord('announcement', "`cid` = '$c'") ?></span></b>)</li>
	</ul>
	<div class="tab-index c-lesson-list">
	
<?php $lList = $getRecord -> GET('announcement', "`cid` = '$c'", '10', '');
	foreach ($lList as $lList) { ?>
		<div class="c-one-lesson the-box more-margin">
			<span class="right gensmall"><span class="icon-time"></span> <?php echo $lList['time'] ?></span>
			<a href="<?php echo "#!course?c=$c&t=announcement&a={$lList['id']}" ?>" class="title bold">
				<img class="c-one-lesson-thumb left" src="<?php echo $lList['thumbnai'] ?>"/>
				<?php if ($lList['prefix']) echo '<span class="prefix">'.$lList['prefix'].'</span>'; echo $lList['title'] ?></a>
			<div class="shorten"><?php echo $lList['content'] ?></div>
			<div class="right c-one-lesson-links">
				<a class="btn btn-primary btn-embossed" href="<?php echo "#!course?c=$c&t=announcement&a={$lList['id']}" ?>">View</a>
			</div>
		</div>
<?php } ?>
	</div>
</div>
