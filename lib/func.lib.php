<?php
function check_db ($db, $condition) {
	$nums = countRecord($db, $condition);
	if (isset($_SESSION[$db])) {
		if ($_SESSION[$db] == $nums) return $nums;
		else {
			$_SESSION[$db] = $nums;
			changeValue('members', "`id` = '$u' ", "`mes_new` = '$nums' ");
			return 'new~'.$nums;
		}
	} else {
		$_SESSION[$db] = -1;
		return -1;
	}
}

function alertChat () {
	global $u;
	$ch = check_db('chat');
	if ($ch > 0) ;
}

function activityAdd($type, $iid) {
	global $u, $current;
	if ($iid) mysql_query("INSERT INTO `activity` (`type`, `uid`, `to_uid`, `iid`, `time`) VALUES ($type, '$u' ,'$u', '$iid', '$current')");
}

function rrmdir($dir) {
	if (is_dir($dir)) {
		$files = scandir($dir);
		foreach ($files as $file)
			if ($file != "." && $file != "..") rrmdir("$dir/$file");
		rmdir($dir);
	}
	else if (file_exists($dir)) unlink($dir);
}

function xcopy ($src, $dest) {
	foreach (scandir($src) as $file) {
		if (!is_readable($src . '/' . $file)) continue;
		if (is_dir($file) && ($file != '.') && ($file != '..') ) {
			mkdir($dest . '/' . $file);
			xcopy($src . '/' . $file, $dest . '/' . $file);
		} else {
			copy($src . '/' . $file, $dest . '/' . $file);
		}
	}
}

function rcopy ($src, $dst) {
	if (is_dir($src)) {
		if (!is_dir($dst)) mkdir($dst);
		$files = scandir($src);
		foreach ($files as $file) {
			if ($file != "." && $file != "..") {
				rcopy ("$src/$file", "$dst/$file");
				chmod ("$dst/$file", 0777);
			}
		}
	} else if (file_exists ($src)) copy($src, $dst);
	rrmdir($src);
}

function compileCode ($languageID) {
	switch($languageID)
			{
				case "c":
				{
					include("compilers/c.php");
					break;
				}
				case "c_cpp":
				{
					include("compilers/cpp.php");
					break;
				}
				case "java":
				{	
					include("compilers/java.php");
					break;
				}
				case "python2.7":
				{
					include("compilers/python27.php");
					break;
				}
				case "python3.2":
				{
					include("compilers/python32.php");
					break;
				}
			}
}

function rCode ($rCode) {
	$returnAr = array();
	$rCodeAr = explode('@', $rCode);
	for ($j = 1; $j < count($rCodeAr); $j++) {
		$rCodeOne = $rCodeAr[$j];
		$rOneAr = explode('[', $rCodeOne);
		$rAns = $rOneAr[0];
		$rAr = explode('::', $rOneAr[1]);
		$rQuestAr = explode('"', $rAr[0]);
		$rQuest = '';
		for ($rr = 0; $rr < count($rQuestAr); $rr++) {
			$rQuest .= $rQuestAr[$rr];
		}
		$rResultAr = explode(']', $rAr[1]);
		$rResultAr = explode('::', $rResultAr[0]);
		$rResultAr = explode('"', $rResultAr[0]);
		$rResult = '';
		for ($rr = 0; $rr < count($rResultAr); $rr++) {
			$rResult .= $rResultAr[$rr];
		}
		$rAnswerAr = explode(']', $rAr[2]);
		$rAnswerAr = explode('"', $rAnswerAr[0]);
		$rAnswer = '';
		for ($rr = 0; $rr < count($rAnswerAr); $rr++) {
			$rAnswer .= $rAnswerAr[$rr];
		}
//		array_push($returnAr, );
		$returnAr['q'.$j] = $j;
		$returnAr['ans'.$j] = $rAns;
		$returnAr['result'.$j] = $rResult;
		$returnAr['answer'.$j] = $rAnswer;
	}
	return $returnAr;
}

function is_dir_empty($dir) {
	if (!is_readable($dir)) return NULL; 
	return (count(scandir($dir)) == 2);
}

function generateRandomString($length) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

function getRecordingMeetings ($lid) {
	$bbb = new BigBlueButton();
	$recordingsParams = array(
		'meetingId' => $lid, 			// OPTIONAL - comma separate if multiples
	);

	$itsGood = true;
	try {$result = $bbb->getRecordingsWithXmlResponseArray($recordingsParams);}
	catch (Exception $e) {
//		echo 'Caught exception: ', $e->getMessage(), "\n";
		$itsGood = false;
	}

	if ($itsGood == true) {
		if ($result == null) return "Failed server.";
		else { 
			if ($result['returncode'] == 'SUCCESS') return $result[0]['playbackFormatUrl'];
			else return false;
		}
	}
}

function endMeeting ($endParams) {
	$bbb = new BigBlueButton();
	$itsAllGood = true;
	try {$result = $bbb->endMeetingWithXmlResponseArray($endParams);}
	catch (Exception $e) {
		echo 'Caught exception: ', $e->getMessage(), "\n";
		$itsAllGood = false;
	}

	if ($itsAllGood == true) {
		// If it's all good, then we've interfaced with our BBB php api OK:
		if ($result == null) {
			// If we get a null response, then we're not getting any XML back from BBB.
			echo "Failed to get any response. Maybe we can't contact the BBB server.";
		}	
		else { 
		// We got an XML response, so let's see what it says:
		print_r($result);
			if ($result['returncode'] == 'SUCCESS') {
				// Then do stuff ...
				echo "<p>Meeting succesfullly ended.</p>";
			}
			else {
				echo "<p>Failed to end meeting.</p>";
			}
		}
	}
}

function checkBBB ($l) {
	global $u;
	$bbb = new BigBlueButton();
	$member = getRecord('members', "`id` = '$u'");
	$lesson = countRecord('lesson', "`id` = '$l' ");
	$lInfo = getRecord('lesson', "`id` = '$l'");
	$cInfo = getRecord('course', "`id` = '{$lInfo['cid']}'");
	if ($u == $cInfo['uid']) $pw = $member['password'];
	else $pw = 'ap';
	
	$itsAllGood = true;
	try {$result = $bbb->isMeetingRunningWithXmlResponseArray($l);}
	catch (Exception $e) {
		echo 'Caught exception: ', $e->getMessage(), "\n";
		$itsAllGood = false;
	}
	if ($itsAllGood == true) {
		$status = $result['running'];
		return $status;
	}
}

function checkAndJoinBBB ($l) {
	global $u;
	$bbb = new BigBlueButton();
	$member = getRecord('members', "`id` = '$u'");
	$lesson = countRecord('lesson', "`id` = '$l' ");
	$lInfo = getRecord('lesson', "`id` = '$l'");
	$cInfo = getRecord('course', "`id` = '{$lInfo['cid']}'");
	if ($u == $cInfo['uid']) $pw = $member['password'];
	else $pw = 'ap';
	
	if ($lesson > 0) {
		$itsAllGood = true;
		try {$result = $bbb->isMeetingRunningWithXmlResponseArray($l);}
		catch (Exception $e) {
			echo 'Caught exception: ', $e->getMessage(), "\n";
			$itsAllGood = false;
		}
		if ($itsAllGood == true) {
			$status = $result['running'];

			$holdMessage = '<div id="status"><div class="alerts alert-warning lesson-not-start">
						<p>This lesson has not yet started.</p>
						<img class="right" src="'.IMG.'/ajax_loading.gif" alt="Contacting server..." />
						<p>You should check again the lesson time, or wait for the educator to start the lesson.</p>
						<p>You will be connected as soon as the lesson starts.</p>
					</div></div>
					<script type="text/javascript">
function checkLes () {
	$("#status").html("nuybtvre").load("'.MAIN_URL.'/pages/course.php?c='.$lInfo['cid'].'&t=learning&l='.$l.' #status > div", function () {
		if ($(".lesson-not-start").length) window.setTimeout("checkLes()", 5000);
		else firstScroll()
	})
}
checkLes();
					</script>';
						
			if ($status == 'false') {
				if ($lInfo['run'] == 'end') echo '<div class="alerts alert-warning">This lesson is ended, the recording is in process.</div>';
				else {
					if ($u == $cInfo['uid']) createBBB($l);
					else echo $holdMessage;
				}
			} else joinBBB($l);
		}
	} else {
		$infoParams = array(
			'meetingId' => $l, 		// REQUIRED - We have to know which meeting.
			'password' => 'mp',			// REQUIRED - Must match moderator pass for meeting.
		);
		$itsAllGood = true;
		try {$result = $bbb->getMeetingInfoWithXmlResponseArray($infoParams);}
			catch (Exception $e) {
				echo 'Caught exception: ', $e->getMessage(), "\n";
				$itsAllGood = false;
			}
		if ($itsAllGood == true) {
			if ($result == null) echo "Failed to get any response. Maybe we can't contact the BBB server.";
			else { 
				if (!isset($result['messageKey'])) joinBBBConfigXML($l, array('layout' => 'Video Chat') );
				else echo createBBB($l);
			}
		}
	}
}

function createBBB ($l) {
	global $u;
	$bbb = new BigBlueButton();
	$member = getRecord('members', "`id` = '$u'");
	$lesson = countRecord('lesson', "`id` = '$l' ");
	$lInfo = getRecord('lesson', "`id` = '$l'");
	$cInfo = getRecord('course', "`id` = '{$lInfo['cid']}'");
	if ($lesson > 0) {
		if ($lInfo['prefix']) $meetingName = '['.$lInfo['prefix'].'] '.$lInfo['title'];
		else $meetingName = $lInfo['title'];
		if ($cInfo['duration'] != 0) $duration = $cInfo['duration'];
		else $duration = $lInfo['duration'];
		$logoutUrl = MAIN_URL.'#!course?c='.$c.'&t=learning&l='.$l;
		if ($cInfo['limit']) $limit = $cInfo['limit'];
		else $limit = -1;
		$mp = $member['password'];
		$recordOption = 'true';
	} else {
		$meetingName = 'Video Chat';
		$duration = 0;
		$logoutUrl = '';
		$limit = -1;
		$mp = 'mp';
		$recordOption = 'false';
	}
	$creationParams = array(
			'meetingId' => $l, 					// REQUIRED
			'meetingName' => $meetingName, 	// REQUIRED
			'attendeePw' => 'ap', 					// Match this value in getJoinMeetingURL() to join as attendee.
			'moderatorPw' => $mp, 					// Match this value in getJoinMeetingURL() to join as moderator.
			'welcomeMsg' => '', 					// ''= use default. Change to customize.
			'dialNumber' => '', 					// The main number to call into. Optional.
			'voiceBridge' => '12345', 				// 5 digit PIN to join voice conference.  Required.
			'webVoice' => '', 						// Alphanumeric to join voice. Optional.
			'logoutUrl' => $logoutUrl, 						// Default in bigbluebutton.properties. Optional.
			'maxParticipants' => $limit, 				// Optional. -1 = unlimitted. Not supported in BBB. [number]
			'record' => $recordOption, 					// New. 'true' will tell BBB to record the meeting.
			'duration' => $duration, 						// Default = 0 which means no set duration in minutes. [number]
			//'meta_category' => '', 				// Use to pass additional info to BBB server. See API docs.
	);
	$createGood = true;
	try {$result = $bbb->createMeetingWithXmlResponseArray($creationParams);}
	catch (Exception $e) {
		$createGood = false;
	}
	if ($createGood == true) {
		if ($result == null) echo '<div class="alerts alert-error">Something went wrong when connecting to server. Please contact the administrators for help.</div>';
		else {
			if ($result['returncode'] == 'SUCCESS') {
				if ($lesson > 0) joinBBB($l);
				else joinBBBConfigXML($l, array('layout' => 'Video Chat') );
			}
		}
	}
}

function joinBBB ($l) {
	global $u;
	$bbb = new BigBlueButton();
	$member = getRecord('members', "`id` = '$u'");
	$lInfo = getRecord('lesson', "`id` = '$l'");
	$cInfo = getRecord('course', "`id` = '{$lInfo['cid']}'");
	if ($u == $cInfo['uid']) $pw = $member['password'];
	else $pw = 'ap';
	if ($lInfo['prefix']) $title = '['.$lInfo['prefix'].'] '.$lInfo['title'];
	else $title = $lInfo['title'];
	
	$joinParams = array(
		'meetingId' => $l, 			// REQUIRED - We have to know which meeting to join.
		'username' => $member['username'],	// REQUIRED - The user display name that will show in the BBB meeting.
		'password' => $pw,				// REQUIRED - Must match either attendee or moderator pass for meeting.
		'createTime' => '',				// OPTIONAL - string
		'userId' => $u,				// OPTIONAL - string
		'configToken' => '',				// OPTIONAL - string
		'avatarURL' => $member['avatar'],		// OPTIONAL - url
		'webVoiceConf' => ''			// OPTIONAL - string
	);
	$allGood = true;
	try {$result = $bbb->getJoinMeetingURL($joinParams);}
	catch (Exception $e) {
		echo 'Caught exception: ', $e->getMessage(), "\n";
		$allGood = false;
	}
	if ($allGood == true) echo '<div class="controlbar-interact-lesson fixed-control">
		<a class="btn btn-xs btn-primary end-lesson" href="c='.$lInfo['cid'].'&t=learning&l='.$l.'&do=endlesson" title="End this lesson"><span class="fa fa-dot-circle-o"></span></a>
		<a class="btn btn-xs btn-primary minimize-iframe" title="Minimize"><span class="fa fa-chevron-down"></span></a>
		<a class="btn btn-xs btn-primary maximize-iframe" title="Maximize" style="display:none"><span class="fa fa-chevron-up"></span></a>
	</div><iframe class="interact-lesson-iframe" src="'.$result.'"></iframe>';
	else echo '<div class="alerts alert-error">Something went wrong on joining to this lesson.</div>';
}

function joinBBBConfigXML ($meetingID, $configArray) {
	global $u;
	$bbb = new BigBlueButton();
	$member = getRecord('members', "`id` = '$u'");
	$configXmlName = 'config';
	
	$configXml = $bbb -> getConfigXml($configXmlName);
	$configXml->layout['showHelpButton'] = 'false';
	
	if (!$configArray['layout']) $configXml = 'Video Chat';
	else $configXml->layout['defaultLayout'] = $configArray['layout'];
	if ($configArray['mod'] == 'mod') $pw = $member['username'];
	else $pw = 'ap';
	
	$videoConfModule = reset($configXml->xpath('//module[@name="VideoconfModule"]'));
	$videoConfModule['autoStart'] = 'true';
	$configXml = preg_replace('/\s+/', ' ', trim($configXml->asXML()));
	$configToken = $bbb -> setConfigXmlForMeeting($meetingID, $configXml);
	
	$joinParams = array(
		'meetingId' => $meetingID, 			// REQUIRED - We have to know which meeting to join.
		'username' => $member['username'],	// REQUIRED - The user display name that will show in the BBB meeting.
		'password' => $pw,				// REQUIRED - Must match either attendee or moderator pass for meeting.
		'createTime' => '',				// OPTIONAL - string
		'userId' => $u,				// OPTIONAL - string
		'configToken' => '',				// OPTIONAL - string
		'avatarURL' => $member['avatar'],		// OPTIONAL - url
		'webVoiceConf' => ''			// OPTIONAL - string
	);
	
	if (is_string($configToken)) {
		echo 'Error : '.$configToken;
	} else {
		$allGood = true;
		try {$result = $bbb -> getJoinURLConfigXml($joinParams, (string)$configToken);}
		catch (Exception $e) {
			echo 'Caught exception: ', $e->getMessage(), "\n";
			$allGood = false;
		}
		if ($allGood == true) echo $result;
		else echo '<div class="alerts alert-error">Something went wrong on joining to this lesson.</div>';
	}
}

function friendList ($status) {
	global $u;
	$getRecord = new getRecord();
	$fR = $getRecord -> GET('friend', " (`receive_id` = '$u' OR `uid` = '$u') AND `accept` = 'yes'");
	foreach ($fR as $fR) {
		if ($fR['uid'] == $u) $fRu = $fR['receive_id'];
		else $fRu = $fR['uid'];
		$fRm = getRecord('members', "`id` = '$fRu'");
		$mutualF = 0;
		$lastMes = getRecord('chat', " (`to_uid` = '$fRu' AND `uid` = '$u') OR (`to_uid` = '$u' AND `uid` = '$fRu') ");
		if ($fRm['online'] == $status) {
			echo '<li><a id="'.$fRu.'">
					<span class="user-status'; if ($status == 'online') echo ' success'; else if ($status == 'idle') echo ' warning'; else if ($status == 'offline') echo ' danger'; echo '"></span>
					<img src="'.$fRm['avatar'].'" class="ava-sidebar img-circle" alt="Avatar">
<!--					<i class="fa fa-mobile-phone device-status"></i> -->
					<span class="activity">'.$fRm['username'].'</span>
					<span class="small-caps"> ';
			if ($lastMes['uid'] == $u) echo '<span class="fa fa-mail-forward"></span> ';
			echo $lastMes['content'].'</span>
			</a></li>';
	 	}
	}
}

function authSolution ($s) {
//	mysql_query("UPDATE `ex_solution` SET `authenticate` = 'yes' WHERE `id` = '$s'");
	$solution = getRecord('ex_solution', "`id` = '$s' ");
	if ($solution['authenticate'] == 'yes') {
		changeValue('ex_solution', "`id` = '$s'", "`authenticate` = '' ");
		substractRep($solution['uid'], 5);
	} else {
		changeValue('ex_solution', "`id` = '$s'", "`authenticate` = 'yes' ");
		addRep($solution['uid'], 5);
	}
}

function starSolution ($s) {
	global $u;
	$mS = getRecord('ex_solution', "`id` = '$s'");
	if (check($mS['star_list'], "|$u|") <= 0) {
		$newStarList = $mS['star_list'].'|'.$u.'|';
		$newStarCount = $mS['star'] + 1;
		substractRep($solution['uid'], 3);
	} else {
		$newStarList = str_replace("|$u|", '', $mS['starList']);
		$newStarCount = $mS['star'] - 1;
		substractRep($solution['uid'], 3);
	}
	changeValue('ex_solution', "`id` = '$s'", "`star_list` = '$newStarList', `star` = '$newStarCount'");
}

function right_container ($width, $pages) {
/*	$u = $values['u'];
	$dot = $values['dot'];
	$pdot = $values['pdot'];
	$c = $values['c'];
*/	global $u, $dot, $pdot, $c;
	$getRecord = new getRecord();
	echo '<div id="right-container" style="width:'.$width.'"><style>#content{margin-right:calc('.$width.' + 31px); margin-right:-webkit-calc('.$width.' + 31px)}</style>';
	for ($i = 0; $i < count($pages); $i++) {
		$dataLink = explode('/', $pages[$i]);
		$dataLink = explode('.', $dataLink[1]);
		echo '<div class="right-one-content the-box" id="'.$dataLink[0].'">';
			include $pages[$i];
		echo '</div>';
	}
	echo '</div>';
}

function addNumField ($uid, $coin, $field) {
	$uInfo = getRecord('members', "`id` = '$uid'");
	$oldcoin = (int)$uInfo[$field];
	$newcoin = $oldcoin + $coin;
	$cha = changeValue('members', "`id` = '$uid'", "`$field` = '$newcoin'");
}

function substractNumField ($uid, $coin, $field) {
	$uInfo = getRecord('members', "`id` = '$uid'");
	$oldcoin = (int)$uInfo[$field];
	$newcoin = $oldcoin - $coin;
	changeValue('members', "`id` = '$uid'", "`$field` = '$newcoin'");
}

function addCoin ($u, $coin) {
	addNumField($u, $coin, 'coin');
}

function substractCoin ($u, $coin) {
	substractNumField($u, $coin, 'coin');
}

function addRep ($u, $coin) {
	addNumField($u, $coin, 'reputation');
}

function substractRep ($u, $coin) {
	substractNumField($u, $coin, 'reputation');
}

function addfriend ($u, $to, $time) {
	$uInfo = getRecord('members', "`id` = '$u'");
	$toInfo = getRecord('members', "`id` = '$to'");
	if (countRecord('friend', "(`uid` = '$u' AND `receive_id` = '$to') OR (`uid` = '$to' AND `receive_id` = '$u')") <= 0) {
		$notinew = $toInfo['friend_new'];
		$notinew++;
		mysql_query("INSERT INTO `friend` (`uid`, `receive_id`) VALUES ('$u', '$to')");
//		mysql_query("INSERT INTO `notification` (`type`, `uid`, `to_uid`, `time`) VALUES ('friend_request', '$u', '$to', '$current')");
		sendNoti('friend_request', '', '', $to);
		changeValue('members', "`id` = '$to'", "`friend_new` = '$notinew'");
	}
}
function acceptfriend ($id_send, $u, $to, $current) {
	$m_send = getRecord('members', "`id` = '$id_send'");
	if (countRecord('friend', "`uid` = '$id_send' AND `receive_id` = '$u' AND (`accept` != 'yes' OR `accept` != 'no')") > 0) {
		$notinew = $m_send['friend_new'];
		$notinew++;
//		$notinewS = $member['friend_new'];
//		$notinewS--;
//		mysql_query("INSERT INTO `notification` (`type`, `uid`, `to_uid`, `time`) VALUES ('accept_friend_request', '$u', '$id_send', '$current')");
		sendNoti('accept_friend_request', '', '', $id_send);
		mysql_query("INSERT INTO `activity` (`type`, `uid`, `to_uid`, `time`) VALUES ('become-friend', '$u', '$id_send', '$current')");
//		mysql_query("DELETE FROM `notification` WHERE `type` = 'friend_request' AND `uid` = '$id_send' AND `to_uid` = '$u'");
		changeValue('members', "`id` = '$id_send'", "`friend_new` = '$notinew'");
//		changeValue('members', "`id` = '$u'", "`friend_new` = '$notinewS'");
		changeValue('friend', "`uid` = '$id_send' AND `receive_id` = '$u'", "`accept` = 'yes'");
	}
}

function unfollow ($u, $to, $time) {
	mysql_query("DELETE FROM `follow` WHERE `uid` = '$u' AND `followed_id` = '$to'");
	changeValue('notification', "`type` = 'follow' AND `uid` = '$u' AND `to_uid` = '$to'", "`type` = 'unfollow'");
}
function follow ($u, $to, $time) {
	$uInfo = getRecord('members', "`id` = '$u'");
	$toInfo = getRecord('members', "`id` = '$to'");
	if ($uInfo['type'] == 'student' || ($uInfo['type'] == 'teacher' && $toInfo['type'] == 'teacher')) {
		$notinew = $toInfo['follow_new'];
		$notinew++;
		mysql_query("INSERT INTO `follow` (`uid`, `followed_id`) VALUES ('$u', '$to')");
//		mysql_query("INSERT INTO `notification` (`type`, `uid`, `to_uid`, `time`) VALUES ('follow', '$u', '$to', '$time')");
		sendNoti('follow-person', '', '', $to);
		mysql_query("INSERT INTO `activity` (`type`, `uid`, `to_uid`, `time`) VALUES ('follow', '$u', '$to', '$time')");
		changeValue('members', "`id` = '$to'", "follow_new = '$notinew'");
	}
}

function courseJoin ($u, $c) {
	$uIn = getRecord('members', "`id` = '$u'");
	$uType = $uIn['type'];
	$cInfo = getRecord('course', "`id` = '$c' ");
	if (countRecord('course_join', "`cid` = '$c' AND `uid` = '$u'") <= 0) {
		mysql_query("INSERT INTO `course_join` (`cid`, `uid`, `utype`, `time`) VALUES ('$c', '$u', '$uType', '$current')");
		sendNoti('course_join', '', $c, $cInfo['uid']);
	} else {
		mysql_query("DELETE FROM `course_join` WHERE `cid` = '$c' AND `uid` = '$u'");
		removeNoti('course_join', '', $c, $cInfo['uid']);
	}
}

function addNoti ($u) {
	$getNoti = getRecord('members', "`id` = '$u'");
	$notinum = $getNoti['noti_new'];
	$notinum++;
	changeValue('members', "`id` = '$u'", "`noti_new` = '$notinum'");
}

function subtractNoti ($u) {
	$getNoti = getRecord('members', "`id` = '$u'");
	$notinum = $getNoti['noti_new'];
	$notinum--;
	changeValue('members', "`id` = '$u'", "`noti_new` = '$notinum'");
}

function sendNoti ($type, $i, $pi, $to, $content) {
	global $u, $current;
	mysql_query("INSERT INTO `notification` (`type`, `i`, `pi`, `uid`, `to_uid`, `content`, `time`) VALUES ('$type', '$i', '$pi', '$u', '$to', '$content', '$current')");
	addNoti($to);
}

function removeNoti ($type, $from, $to, $content) {
	mysql_query("DELETE FROM `notification` WHERE `type` = '$type' AND `uid` = '$from' AND `to_uid` = '$to' AND `content` = '$content'");
	subtractNoti($to);
}

function _content($content) {
	$need = array("'");
	$replaced = array("\'");
	return str_replace($need, $replaced, $content);
}

function _GET ($string) {
	if (checkURL('#!') > 0) {
		$ar = explode($string.'=', $_SERVER['REQUEST_URI']);
		$ars = explode('&', $ar[1]);
		return $ars[0];
	} else {
		return $_GET[$string];
	}
}

function voteLib ($tb, $act, $vl, $u, $current) {
	$votetb = $tb.'_vote';
	$tbInfo = getRecord($tb, "`id` = '$vl' ");
	if ($act == 'like') $acta = 'thumbed up';
	else $acta = 'thumbed down';
	if (countRecord($votetb, "`iid` = '$vl' AND `type` = '$act' AND `uid` = '$u'") <= 0) {
		mysql_query("INSERT INTO `$votetb` (`uid`, `type`, `iid`, `time`) VALUES ('$u', '$act', '$vl', '$current')");
		if ($u != $tbInfo['uid']) {
			if ($tb == 'quest') addRep($tbInfo['uid'], 1);
			else addRep($tbInfo['uid'], 3);
//			sendNoti($vote, '', $vl, $tbInfo['uid'], $acta);
		}
	} else {
		mysql_query("DELETE FROM `$votetb` WHERE `iid` = '$vl' AND `type` = '$act' AND `uid` = '$u'");
		if ($u != $tbInfo['uid']) {
			if ($tb == 'quest') substractRep($tbInfo['uid'], 1);
			else substractRep($tbInfo['uid'], 3);
		}
	}
}

function starLib ($tb, $vl, $u, $current) {
	$startb = $tb.'_star';
	$tbInfo = getRecord($tb, "`id` = '$vl' ");
	if (countRecord($startb, "`iid` = '$vl' AND `uid` = '$u'") <= 0) {
		mysql_query("INSERT INTO `$startb` (`uid`, `iid`, `time`) VALUES ('$u', '$vl', '$current')");
		if ($u != $tbInfo['uid']) {
			if ($tb == 'quest') addRep($tbInfo['uid'], 2);
			else addRep($tbInfo['uid'], 5);
		}
	} else {
		mysql_query("DELETE FROM `$startb` WHERE `iid` = '$vl' AND `uid` = '$u'");
		if ($u != $tbInfo['uid']) {
			if ($tb == 'quest') substractRep($tbInfo['uid'], 2);
			else substractRep($tbInfo['uid'], 5);
		}
	}
}

function solveQuest ($vl, $cmii) {
	$qInfo = getRecord('quest', "`id` = '$vl'");
	$cminfo = getRecord('quest_cmt', "`id` = '$cmii' ");
	$coin = $qInfo['coin'] + 10;
	if (!$qInfo['solve'] || $qInfo['solve'] != 'solve') {
		mysql_query("UPDATE `quest_cmt` SET `solve` = 'solve' WHERE `id` = '$cmii'");
		mysql_query("UPDATE `quest` SET `solve` = 'solve' WHERE `id` = '$vl'");
		if ($u != $cminfo['uid']) addRep($cminfo['uid'], $coin);
	}
}

function likeCmt($tbcmt, $acct, $cmii, $u) {
//	$acct = $_GET['act'];
	$vl = $cmii;
	$cmiInfo = getRecord($tbcmt, "`id` = '$vl'");
	$List = $cmiInfo[$acct.'_list'];
	$aAr = explode('|', $List);
	$mLike = $cmiInfo[$acct];
	if (in_array($u, $aAr)) {
		$mLike--;
		if (($key = array_search($u, $aAr)) !== false) unset($aAr[$key]);
	} else {
		$mLike++;
		array_push($aAr, $u);
	}
	$updateLikeList = implode('|', $aAr);
	mysql_query("UPDATE `$tbcmt` SET `{$acct}_list` = '$updateLikeList', `$acct` = '$mLike' WHERE `id` = '$vl'");
	if ($tbcmt == 'quest_cmt') {
		if ($u != $cminfo['uid']) {
			if ($acct == 'like') addRep($cminfo['uid'], 4);
			else substractRep($cminfo['uid'], 4);
		}
	}
}

function likeItem ($tb, $iid, $u, $time) {
	$tbvote = $tb.'_vote';
	if (countRecord($tbvote, "`uid` = '$u' AND `iid` = '$iid' AND `type` = 'like'") <= 0) {
		mysql_query("INSERT INTO `$tbvote` (`uid`, `iid`, `type`, `time`) VALUES ('$u', '$iid', 'like', '$time')");
		sendNoti($tbvote, '', $c, $cInfo['uid'], 'like');
	} else {
		mysql_query("DELETE FROM `$tbvote` WHERE `uid` = '$u' AND `iid` = '$iid' AND `type` = 'like'");
		removeNoti($tbvote, '', $c, $cInfo['uid'], 'like');
	}
}

function dislikeItem ($tb, $iid, $u, $time) {
	$tbvote = $tb.'_vote';
	if (countRecord('item_vote', "`uid` = '$u' AND `iid` = '$iid' AND `type` = 'dislike'") <= 0) {
		mysql_query("INSERT INTO `$tbvote` (`uid`, `iid`, `type`, `time`) VALUES ('$u', '$iid', 'dislike', '$time')");
		sendNoti($tbvote, '', $c, $cInfo['uid'], 'dislike');
	} else {
		mysql_query("DELETE FROM `$tbvote` WHERE `uid` = '$u' AND `iid` = '$iid' AND `type` = 'dislike'");
		removeNoti($tbvote, '', $c, $cInfo['uid'], 'dislike');
	}
}

function voteItem ($type, $iid, $u, $time) {
	if ($type == 'like') likeItem('course', $iid, $u, $time);
	else if ($type == 'dislike') dislikeItem('course', $iid, $u, $time);
}

function rate ($type, $iid, $star, $u, $time) {
	$table = $type.'_rate';
	$cInfo = getRecord($type, "`id` = '$iid' ");
	if (countRecord($table, "`uid` = '$u' AND `iid` = '$iid'") <= 0) {
		mysql_query("INSERT INTO `$table` (`uid`, `iid`, `rate`, `time`) VALUES ('$u', '$iid', '$star', '$time')");
		sendNoti($table, '', $iid, $cInfo['uid'], $star);
	}
}

function getRecord ($table, $condition) {
	$con = mysql_connect (DB_SERVER, DB_USER, DB_PASS);
	$db_select = mysql_select_db($dbName);
	if (!$con) die('Error Connection:' . mysql_error());
	if ($table == '') return false;
	if (check($table, '^') > 0) {
		$tableSpl = explode('^', $table);
		$table = $tableSpl[0];
		$col = $tableSpl[1];
	} else $col = '*';
	if ($condition == '' || !$condition) $sql = "SELECT $col FROM `$table` ORDER BY `id` DESC";
	else $sql = "SELECT $col FROM `$table` WHERE $condition ORDER BY `id` DESC";
	$getResult = mysql_query($sql, $con);
	if ($getResult === FALSE) die(mysql_error());
	else return mysql_fetch_array($getResult);
}

function countRecord ($table, $condition) {
	if ($table == '') return false;
	if (!$condition) $getResult = mysql_query("SELECT * FROM `$table`");
	else $getResult = mysql_query("SELECT * FROM `$table` WHERE $condition");
	if ($getResult === FALSE) die(mysql_error());
	else return mysql_num_rows($getResult);
}

function removeSpace ($content) {
	return str_replace(' ', '', $content);
}
	
function emo ($content) {
	$emodir = IMG.'/emo';
	$kitu = array();
	$em = array();
	$mE = mysql_query("SELECT * FROM `emo` WHERE type='emo' ORDER BY `order` DESC");
	while ($es = mysql_fetch_array ($mE)) {
		$eid = $es['id'];
		$eicon = $es['icon'];
		$ename = $es['name'];
		$edot = $es['dot'];
		$eimg = "<img src='$emodir/{$es['cat']}/{$es['img']}.$edot'/>";
		array_push($kitu, $eicon);
		array_push($em, $eimg);
	}
	$content = str_replace( $kitu, $em, nl2br($content) );
	return $content;
}

function emoTextareaDropdown () {
	$Array = array();
	$mE = mysql_query("SELECT * FROM `emo` WHERE type='emo' ORDER BY `id` ASC LIMIT 12");
	while ($es = mysql_fetch_array ($mE)) {
		$eid = $es['id'];
		$eicon = $es['icon'];
		$ename = $es['name'];
		$edot = $es['dot'];
		$eimg = $es['img'];
		$ecat = $es['cat'];
		echo "'$eicon' : '$ecat/$eimg.$edot', ";
	}
}

function emoTextareaMore () {
	$Array = array();
	$mE = mysql_query("SELECT * FROM `emo` WHERE type='emo' ORDER BY `id` ASC");
	while ($es = mysql_fetch_array ($mE)) {
		$eid = $es['id'];
		$eicon = $es['icon'];
		$ename = $es['name'];
		$edot = $es['dot'];
		$eimg = $es['img'];
		$ecat = $es['cat'];
		if ($eid > 10) echo "'$eicon' : '$ecat/$eimg.$edot', ";
	}
}

function check ($string, $word) {
	return strlen(strstr($string, $word));
}

function checkURL ($word) {
	return check($_SERVER['REQUEST_URI'], $word);
}

function changeValue ($table, $condition, $value) {
	if ($table == '' || countRecord($table, $condition) <= 0) return false;
	if ($condition == '') $result = mysql_query("UPDATE `$table` SET $value");
	else $result = mysql_query("UPDATE `$table` SET $value WHERE $condition");
	if ($result === FALSE) die(mysql_error());
	else return $result;
}

function display_like_stt ($u, $lid, $time) {
	$getRecord = new getRecord();
	$member = getRecord('members', "`id` = '$u' ");
		$solike = countRecord('activity_like', "`iid` = '$lid'");
		$solik = $solike - 3;
		$socmt = countRecord('activity_cmt', "`iid` = '$lid'");
		$soshare = countRecord('activity', "`type` = 'share' AND `img_url` = '$lid'");
		echo "<div id='tool'>
		<span class='like-unlike'>";
		if ( countRecord('activity_like', "`iid` = '$lid' AND `uid` = '$u'") <= 0 )
			echo "<a class='lik' id='like_$lid' alt='$up_id' href='?do=like&p=$lid'>Like</a>";
		else echo "<a class='unlike' id='unlike_$lid' alt='$up_id' href='?do=unlike&p=$lid'>Unlike</a>";
		echo "</span><a class='cmt' id='cmt_$lid'>Comment</a>
			<a class='share' id='share_$lid'>Share</a>";
		
		echo "<span class='nums'><span>";
		if ($solike > 0) echo "<span id='like'><i class='fa fa-thumbs-up'></i> $solike</span>";
		if ($socmt > 0) echo "<span id='cmt'><i class='fa fa-coffee'></i> $socmt</span>";
		if ($soshare > 0) echo "<span id='share'><i class='fa fa-share-alt'></i> $soshare</span>";
		echo "</span></span>";
		echo "<span class='deta gensmall' style='color:#888;padding:5px'><i class='fa fa-clock-o'></i> $time</span>
		</div>";
		
		echo "<div class='like_list'>
		";
		if ($solike > 0) {
			echo "<div id='likelist'>";
			if ( countRecord('activity_like', "`iid` = '$lid' AND `uid` = '$u'") > 0 ) {
				echo "<div class='num_line'>
				<span><span id='iy'></span>";
				if ($solike <= 2) {
					$lay_like = mysql_query("SELECT * FROM `activity_like` WHERE `iid` = '$lid' AND `uid` != '$u' ORDER BY `id` DESC LIMIT 1");
					echo "<span class='a'>You</span> ";
					while($ll= mysql_fetch_array($lay_like)){
						$nguoilike = $ll['uid'];
						$laymem = mysql_fetch_array(mysql_query("SELECT * FROM `members` WHERE `id` = '$nguoilike'"));
						$mnamem = $laymem['username'];
						$mu = $laymem['id'];
						echo "<span class='commo'>and</span> <a href='#!user?u=$mu' class='a'>$mnamem</a>";
					}
				} else if ($solike == 3) {
					$lay_like = mysql_query("SELECT * FROM `activity_like` WHERE `iid` = '$lid' AND `uid` != '$u' ORDER BY `id` DESC LIMIT 2");
					echo "<span class='a'>You</span><span class='commo'>,</span> ";
					while($ll= mysql_fetch_array($lay_like)){
						$nguoilike = $ll['uid'];
						$laymem = mysql_fetch_array(mysql_query("SELECT * FROM `members` WHERE `id` = '$nguoilike'"));
						$mnamem = $laymem['username'];
						$mu = $laymem['id'];
						echo "<a href='#!user?u=$mu' class='a'>$mnamem</a> <span class='commo'>and</span> ";
					}
				} else {
					$lay_like=mysql_query("SELECT * FROM `activity_like` WHERE `iid` = '$lid' AND `uid` != '$u' ORDER BY `id` DESC LIMIT 2");
					echo "<span class='a'>You</span>";
					while($ll= mysql_fetch_array($lay_like)){
						$nguoilike = $ll['uid'];
						$laymem = mysql_fetch_array( mysql_query("SELECT * FROM `members` WHERE `id` = '$nguoilike'") );
						$mnamem = $laymem['username'];
						$mu = $laymem['id'];
						echo "<span class='commo'>,</span> <a href='#!user?u=$mu' class='a'>$mnamem</a>";
					echo " and $solik others";
					}
				}
				echo " <span class='lt'>liked this</span></span>
				</div>";
			} else {
				echo "<div class='num_line'><span><span id='iy'></span>";
				if ($solike <= 3) {
					$lay_like = mysql_query("SELECT * FROM `activity_like` WHERE `iid`='$lid' ORDER BY `id` DESC LIMIT 2");
					while($ll= mysql_fetch_array($lay_like)){
						$nguoilike = $ll['uid'];
						$laymem = mysql_fetch_array(mysql_query("SELECT * FROM `members` WHERE `id` = '$nguoilike'"));
						$mnamem = $laymem['username'];
						$mu = $laymem['id'];
						echo "<a href='#!user?u=$mu' class='a'>$mnamem</a> <span class='commo'>and</span> ";
					}
				} else {
					$lay_like=mysql_query("SELECT * FROM `activity_like` WHERE `iid` = '$lid' ORDER BY `id` DESC LIMIT 2");
					while($ll= mysql_fetch_array($lay_like)){
						$nguoilike = $ll['uid'];
						$laymem = mysql_fetch_array( mysql_query("SELECT * FROM `members` WHERE `id` = '$nguoilike'") );
						$mnamem = $laymem['username'];
						$mu = $laymem['id'];
						echo "<span class='commo'>,</span> <a href='#!user?u=$mu' class='a'>$mnamem</a>";
					}
					echo "and $solik others";
				}
				echo " <span class='lt'>liked this</span></span>
				</div>";
			}
			echo "</div>";
		} else echo "<div class='num_line'><span><span id='iy'></span> <span class='lt'></span></div>";
		echo "</div>";
	echo '<div class="stt-cmt-list">';
	if ($socmt > 0) {
		$cmtL = $getRecord -> GET('activity_cmt', "`iid` = '$lid'");
		foreach ($cmtL as $cmtL) {
			$cmtAuth = getRecord('members', "`id` = '{$cmtL['uid']}' ");
			$cmtlikenum = countRecord('activity_like', "`iid` = '{$cmtL['id']}' ");
			echo '<div class="one-cmt-stt">
				<a class="bold" href="#!user?u='.$cmtAuth['id'].'"><img src="'.$cmtAuth['avatar'].'" class="img-circle left"/>
				<span class="stt-user left">'.$cmtAuth['username'].'</span></a>
				'.$cmtL['content'].'
				<div class="cmt-tool" id="p'.$cmtL['id'].'" alt="'.$cmtL['id'].'"><span>';
				if ($cmtlikenum <= 0) echo '<a class="like" id="like_'.$cmtL['id'].'" href="?do=like&p='.$cmtL['id'].'">Like</a>';
				else echo '<a class="like" id="like_'.$cmtL['id'].'" href="?do=unlike&p='.$cmtL['id'].'">Unlike</a>';
			echo '	<span class="like-num" style="margin-right:5px">';
				if ($cmtlikenum > 0) echo '<span class="fa fa-thumbs-up"></span> '.$cmtlikenum;
			echo '	</span>
					<span class="time gensmall"><span class="fa fa-clock-o"></span> '.$cmtL['time'].'</span>
				</span></div>
			</div>';
		}
	}
	echo '</div>';
	echo '<form class="cmt-form" id="'.$lid.'">
		<img class="my-avatar" src="'.$member['avatar'].'"/>
		<textarea name="cmt-stt-'.$lid.'" class="no-toolbar"></textarea>
		<input type="submit" class="right" value="Submit"/>
	</form>';
}


class getRecord {
	private function _open_connection() {
		$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
		if (!$con) die('Error Connection:' . mysql_error());
		$db_select = mysql_select_db(DB_NAME, $con);
		if (!$db_select) die('Error Selection: ' . mysql_error());
		return $con;
	}
	
	private function _confirm_query($result) {
		if(!$result) die('Error Query: ' . mysql_error());
		return $result;
	}

	function countRecord ($table, $condition) {
		if ($table == '') return false;

		if (!$condition) $getResult = mysql_query("SELECT * FROM `$table`");
		else $getResult = mysql_query("SELECT * FROM `$table` WHERE $condition");

		if ($getResult === FALSE) die(mysql_error());
		else return mysql_num_rows($getResult);
	}

	public function GET ($table, $condition, $display, $order) {
		if ($table == 'comment_quest_new') $query = "SELECT COUNT(id) FROM `comment_quest`";
		else $query = "SELECT COUNT(id) FROM `$table`";

		$miis = $display;
		if (check($display, '^') > 0) {
			$display = explode('^', $display);
			$display = $display[1];
		}
		if ($display && $display != 0 && check($display, '%') <= 0) {
			if (isset($_GET['page']) && (int)$_GET['page'] >= 0) {
				$page = $_GET['page'];
			} else {
				$result = mysql_query($query);
				$rows = mysql_fetch_array($result);
				if ($table == 'comment_quest_new') $record = countRecord ("comment_quest", $condition);
				else $record = countRecord ($table, $condition);
				if($record > $display) $page = ceil($record/$display);
				else $page = 1;
			}
			$start = (isset($_GET['start']) && (int)$_GET['start'] >= 0) ? $_GET['start'] : 0;
			$current = ($start/$display)+1;
			$next = $start + $display;
			$previous = $start - $display;
			$last = ($page - 1)*$display;
			if (check($miis, '^') <= 0) {
				if ($current >= 4) {
					$start_page = $current - 2;
					if ($page > $current + 2) $end_page = $current + 2;
					else if ($current <= $page && $current > $page - 3) {
						$start_page = $page - 3;
						$end_page = $page;
					} else $end_page = $page;
				} else {
					$start_page = 1;
					if ($page > 4) $end_page = 4;
					else $end_page = $page;
				}
			} else {
				$start_page = 1;
				$end_page = $page;
			}

//			$fl = $_SERVER['REQUEST_URI'];
			$fl = explode('8dot', $_SERVER['REQUEST_URI']);
			$fl = $fl[1];
			$fls = explode("?", $fl);
			$mm = $fls[1].'&';
			echo '<div class="pagination primary right">';
			//echo '<span class="bold" title="<b>'.$page.'</b> pages available">['.$page.']</span>';
			if ($current > 1) echo "<li><a href='".MAIN_URL.$fls[0]."?".$mm."start=0&page=$page' data-toggle='tooltip' title='To the first page'><i class='fa fa-chevron-left'></i></a></li>";
			else echo "<li class='disabled'><a data-toggle='tooltip' title='To the first page'><i class='fa fa-chevron-left'></i></a></li>";
			for ($i = $start_page; $i <= $end_page; $i++) {
				if ($current == $i) echo "<li class='active'><a>$i</a></li>";
				else {
					if (strlen(strstr($fl, '?')) <= 0) echo "<li><a class='page' href='".MAIN_URL.$fls[0]."?start=".($display*($i-1))."&page=$page'>$i</a></li>";
					else {
						echo "<li><a class='page' href='".MAIN_URL.$fls[0]."?".$mm."start=".($display*($i-1))."&page=$page'>$i</a></li>";
					}
				}
			}
			if ($current < $page) echo "<li><a data-toggle='tooltip' href='".MAIN_URL.$fls[0]."?".$mm."start=$last' title='To the last page'><i class='fa fa-chevron-right'></i></a></li>";
			else echo "<li class='disabled'><a data-toggle='tooltip' title='To the last page'><i class='fa fa-chevron-right'></i></a></li>";
			echo '</div>';
		}

		if (!$condition) {
			if (check($display, '%') > 0) {
				$dis = explode('%', $display);
				if ($order) $sql = "SELECT * FROM `$table` ORDER BY $order LIMIT ".$dis[1];
				else $sql = "SELECT * FROM `$table` ORDER BY `id` DESC LIMIT ".$dis[1];
			} else if ($display == 0 || !$display) {
				if ($order) $sql = "SELECT * FROM `$table` ORDER BY $order";
				else $sql = "SELECT * FROM `$table` ORDER BY `id` DESC";
			} else {
				if ($order) $sql = "SELECT * FROM `$table` ORDER BY $order LIMIT $start, $display";
				else $sql = "SELECT * FROM `$table` ORDER BY `id` DESC LIMIT $start, $display";
			}
		} else {
			if (check($display, '%') > 0) {
				$dis = explode('%', $display);
				if ($order) $sql = "SELECT * FROM `$table` WHERE $condition ORDER BY $order LIMIT ".$dis[1];
				else $sql = "SELECT * FROM `$table` WHERE $condition ORDER BY `id` DESC LIMIT ".$dis[1];
			} else if ($display == 0 || !$display) {
				if ($order) $sql = "SELECT * FROM `$table` WHERE $condition ORDER BY $order";
				else $sql = "SELECT * FROM `$table` WHERE $condition ORDER BY `id` DESC";
			} else {
				if ($order) $sql = "SELECT * FROM `$table` WHERE $condition ORDER BY $order LIMIT $start, $display";
				else $sql = "SELECT * FROM `$table` WHERE $condition ORDER BY `id` DESC LIMIT $start, $display";
			}
		}

		$db = $this -> _open_connection();
		$result = mysql_query($sql, $db);
		$Array = array();
		
		if ($this -> _confirm_query($result)) {
			while ($r = mysql_fetch_array($result)) {
				$row = array();
				foreach ($r as $k=>$v){
					$row[$k] = $v;
				}
				array_push($Array, $row);
				unset($row);
			}
		}
		
		return $Array;
	}
}

$getRecord = new getRecord();

?>
