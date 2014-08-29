<?php if ($_GET['act'] == 'submit') {
	$lPrefix = _content($_POST['l-prefix']);
	$lTitle = _content($_POST['l-title']);
	$lThumbnai = $_POST['l-thumbnai'];
	$lContent = _content($_POST['l-content']);
	$lVid = $_POST['l-video'];
	$lDoc = $_POST['l-document'];
	$lPrice = $_POST['l-price'];
	$lPriceNormal = $_POST['l-price-normal'];
	if ($cInfo['duration'] == 0) $duration = $_POST['l-duration'];
	else $duration = $cInfo['l-duration'];
	if ($lPrice == $cInfo['price']) $lPrice = 0;
	if ($lPrefix) $lTtitle = '['.$lPrefix.'] '.$lTitle;
	else $lTtitle = $lTitle;
	if (countRecord('lesson', "`cid` = '$c' AND `prefix` = '$lPrefix' AND `title` = '$lTitle'") > 0) echo '<div class="alerts alert-error">You already have a lesson name <b>'.$lTtitle.'</b> in this course. Please choose another name.</div>';
	else {
		$a = mysql_query("INSERT INTO `lesson` (`cid`, `prefix`, `title`, `thumbnai`, `content`, `document`, `video`, `duration`, `price`, `price_normal`, `time`) VALUES ('$c', '$lPrefix', '$lTitle', '$lThumbnai', '$lContent', '$lDoc', '$lVid', '$duration', '$lPrice', '$lPriceNormal', '$current')");
		if ($a) {
			$lInfo = getRecord('lesson', "`cid` = '$c' AND `prefix` = '$lPrefix' AND `title` = '$lTitle'");
			$lid = $lInfo['id'];

			$lInfo = getRecord('lesson', "`cid` = $c AND `title` = '$lTitle' AND `prefix` = '$lPrefix' ");
			foreach ($joinList as $joinnist) sendNoti('new-lesson', $lid, $c, $joinnist['uid']);

			if ($lPrefix) $meetingName = '['.$lInfo['prefix'].'] '.$lInfo['title'];
			else $meetingName = $lInfo['title'];
			$creationParams = array(
				'meetingId' => $lInfo['id'], 					// REQUIRED
				'meetingName' => $meetingName, 	// REQUIRED
				'attendeePw' => 'ap', 					// Match this value in getJoinMeetingURL() to join as attendee.
				'moderatorPw' => $member['password'], 					// Match this value in getJoinMeetingURL() to join as moderator.
				'welcomeMsg' => '', 					// ''= use default. Change to customize.
				'dialNumber' => '', 					// The main number to call into. Optional.
				'voiceBridge' => '12345', 				// 5 digit PIN to join voice conference.  Required.
				'webVoice' => '', 						// Alphanumeric to join voice. Optional.
				'logoutUrl' => '', 						// Default in bigbluebutton.properties. Optional.
				'maxParticipants' => $cInfo['limit'], 				// Optional. -1 = unlimitted. Not supported in BBB. [number]
				'record' => 'true', 					// New. 'true' will tell BBB to record the meeting.
				'duration' => $duration, 						// Default = 0 which means no set duration in minutes. [number]
				//'meta_category' => '', 				// Use to pass additional info to BBB server. See API docs.
			);

			// Create the meeting and get back a response:
			$itsAllGood = true;
			try {$result = $bbb->createMeetingWithXmlResponseArray($creationParams);}
				catch (Exception $e) {
					echo '<div class="alerts alert-error">Caught exception: ', $e->getMessage(), '</div>';
					$itsAllGood = false;
				}

			if ($itsAllGood == true) {
				if ($result == null) echo '<div class="alerts alert-error">Something went wrong when connecting to server. Please contact the administrators for help.</div>';
				else { 
		//			print_r($result);
					if ($result['returncode'] == 'SUCCESS') echo '<div class="alerts alert-success">Lesson <b>'.$lTtitle.'</b> added successfully.</div>';
					else echo '<div class="alerts alert-error">Something went wrong when creating an advanced lesson. Please contact the administrators for help.</div>';
				}
			}
		} else echo '<div class="alerts alert-error">Something went wrong when creating a lesson. Please contact the administrators for help.</div>';
	}
} ?>
