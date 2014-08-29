<?php include "../lib/config.php" ?>

<script src="<?php echo JS ?>/logout.js"></script>
<form id="logout" method="post">
	<h2>Are you sure want to leave?</h2>
<? if ($member['type'] == 'teacher') { ?>
	<p style="margin-top:5px">Be sure you've ended all lessons. When you leave, all running lessons will be killed (and yes, recorded)</p>
<? } ?>
	<p style="margin-top:5px">We'll miss you!</p>
	<div class="log-out-buttons right" style="margin-top:10px">
	<a class="btn btn-danger" style="margin-right:5px" onclick="$('.sb-logout').hide().prev().hide()">Cancel</a>
	<a class="logout-sure btn btn-primary">Sure</a>
	</div>
</form>

<?php if ($_GET['act'] == 'logout') {
	$useR = $member['id'];
	session_destroy();
} ?>
