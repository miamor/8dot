<?php include '../lib/config.php';

if ($l) {
	$lInfo = getRecord('lesson', "`id` = '$l' ");
	$myNote = getRecord('lesson_note', "`uid` = '$u' AND `lid` = '$l' "); ?>
	<div class="col-left-content">
<?php if (check($lInfo['video'], 'youtube') > 0) {
		$param = explode('v=', $lInfo['video']);
		echo '<iframe width="100%" height="100%" src="//www.youtube.com/embed/'.$param.'" frameborder="0" allowfullscreen></iframe>';
	} else echo '<video class="video-lesson video-js" controls preload="auto" poster="'.$lInfo['thumbnai'].'" data-setup="{}">
		<source src="'.$lInfo['video'].'" type="video/mp4">
	</video>' ?>
	</div>
	<div class="col-right-content">
		<div class="frame-lesson-info">
			<img class="left avatar img-circle" style="margin:5px 10px 0 0" src="<?php echo $lInfo['thumbnai'] ?>"/>
			<b class="text-primary"><?php echo $lInfo['title'] ?></b> <span class="gensmall right"><span class="fa fa-clock-o"></span> <?php echo $lInfo['time'] ?></span>
		</div>
		<div class="iframe-content">
			<div class="iframe-lesson-content">
				<?php echo $lInfo['content'] ?>
			</div>
			
			
			<div class="iframe-note">
				<form method="post" name="post" action="" class="notepad">
<!--					<textarea id="notep" name="notepad_text" cols="50" row="10">Nothing's to see here~</textarea> -->
					<div class="notepad-box">
						<div class="notepad-content"><textarea id="notepad" name="notepad_text" cols="50" row="10" placeholder="Add your note..."><?php echo $myNote['content'] ?></textarea></div>
						<img src="<?php echo IMG ?>/blue-notepad.png" width="100%" height="280" onclick="document.getElementById('notepad').focus();">
					</div>
					<div class="right save-notepad"><input type="submit" value="Save" class="icon_ok btn btn-primary btn-xs"></div>
				</form>
				<script src="<?php echo JS ?>/lessonView.js"></script>
			</div>
		</div>
	</div>
<?php } ?>
