<?php if ($u != $cInfo['uid']) {
		if ($cInfo['price-type'] == 'one-price' && $member['coin'] < $cInfo['price']) echo '<div class="note alerts alert-warning">You don\'t have enough coins to get ticks for this course.</div>';
		else if ($cInfo['price-type'] == 'one-price' && $cInfo['pay'] == 'by-course') echo '<div class="note alerts alert-info">This course is <b>one-price</b> and <b>full-packaged</b>. <br/>Get ticks for whole course now!</div>';
		else if ($cInfo['price-type'] == 'one-price' && $cInfo['pay'] == 'by-lesson') echo '<div class="note alerts alert-info">This course is <b>one-price</b>. <br/>Get ticks for each lesson now!</div>';
	
	if ($cInfo['available'] == 'both' || $cInfo['available'] == $member['type']) {
		if ($cInfo['pay'] == 'by-course') { ?>
			<div class="right fui-check minibutton button-remark button-remark-tickets tick-course <?php if ($member['coin'] < $cInfo['price']) echo 'disabled' ?>" title="One tick for whold course. Get ticks now!">Get tickets</div>
			<div class="price round reverse"><span><?php echo $cInfo['price'] ?></span></div>
			<div class="course-get-tick">
				
			</div>
	<?php } else if ($cInfo['price-type'] == 'one-price') { ?>
			<div class="right fui-check minibutton button-remark button-remark-tickets tick-lesson <?php if ($member['coin'] < $cInfo['price']) echo 'disabled' ?>" title="Get ticks for lessons now!">Get tickets</div>
			<div class="price round reverse"><div><?php echo $cInfo['price'] ?></div></div>
	<?php } else if ($l) {
			if (countRecord('lesson', "`id` = '$l' AND `cid` = '$c'") > 0) {
				$lInfo = getRecord('lesson', "`id` = '$l'") ?>
				<div class="right fui-check minibutton button-remark button-remark-tickets tick-lesson <?php if ($member['coin'] < $lInfo['price']) echo 'disabled' ?>" title="Get ticks for lessons now!">Get tickets</div>
				<div class="price round reverse"><div><?php echo $lInfo['price'] ?></div></div>
				<?php if ($cInfo['price-type'] == 'one-price' && $member['coin'] < $cInfo['price']) { ?>
					<div class="note alerts alert-warning">You don't have enough coins to get ticks for this lesson.</div>
				<?php } ?>
	<?php   	  }
		}
		
	} else if ($cInfo['available'] != 'both') echo '<div class="note alerts alert-info">This course is only available for <b>'.$cInfo['available'].'</b>.</div>';
} else echo '<div class="note alerts alert-info">You are the course creator. Try manage links from the left side.</div>' ?>
