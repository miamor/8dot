<?php include '../lib/config.php' ?>			
<div class="mail-apps-wrap">
	<?php include 'views/mail-head.php' ?>
	<?php if ($mode == 'new') include 'views/mailNew.php';
		else {
			if ($t == 'sent') include 'views/mailSent.php';
			else if ($t == 'draff') include 'views/mailDraff.php';
			else if ($t == 'trash') include 'views/mailTrash.php';
			else if ($t == 'contact') include 'views/mailContact.php';
			else include 'views/mailInbox.php';
		} ?>
</div><!-- /.mail-apps-wrap -->
		
		
