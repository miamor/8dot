<?php

/* _____ PHP Big Blue Button API Usage ______
* by Peter Mentzer peter@petermentzerdesign.com
* Use, modify and distribute however you like.
*/

// Require the bbb-api file:
require_once('../includes/config.php');
require_once('../includes/bbb-api.php');


// Instatiate the BBB class:
$bbb = new BigBlueButton();

/* ___________ JOIN MEETING w/ OPTIONS ______ */
/* Determine the meeting to join via meetingId and join it.
*/

$joinParams = array(
	'meetingId' => 'Demo Meeting', 			// REQUIRED - We have to know which meeting to join.
	'username' => 'Test Attendee',	// REQUIRED - The user display name that will show in the BBB meeting.
	'password' => 'ap',				// REQUIRED - Must match either attendee or moderator pass for meeting.
	'createTime' => '',				// OPTIONAL - string
	'userId' => '',					// OPTIONAL - string
	'avatarURL' => 'http://bschool.net76.net/lib/_i/logo/logo3.png',					// OPTIONAL - string
	'webVoiceConf' => ''			// OPTIONAL - string
);

// Get the URL to join meeting:
$itsAllGood = true;
try {$result = $bbb->getJoinMeetingURL($joinParams);}
	catch (Exception $e) {
		echo 'Caught exception: ', $e->getMessage(), "\n";
		$itsAllGood = false;
	}

if ($itsAllGood == true) {
	//Output results to see what we're getting:
	print_r($result);
}	
?>
