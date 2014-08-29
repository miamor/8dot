<?php if (!$n) $n = 1;
	if ($_GET['act'] == 'submit') {
			$cTitle = _content($_POST['c-title']);
			$cType = $_POST['c-type'];
			$cTopic = $_POST['c-topic'];
			asort($cTopic);
			$cTopic = implode(',', $cTopic);
			$cThumbnai = $_POST['c-thumbnai'];
			$thumbs = array();
			for ($j = 0; $j <= 100; $j++) {
				if ($_POST['thumb'.$j]) {
					substr_replace($thumbs, '~~~', 0, 0);
					array_push($thumbs, $_POST['thumb'.$j]);
				}
			}
			$thumm = implode("|", $thumbs);
//			echo $thumm;
			$cPayType = $_POST['c-pay'];
			if (!$cPayType) $cPayType = $_POST['c-pay-hidden'];
			$cTicketType = $_POST['c-ticket'];
			$cPriceType = $_POST['c-price-type'];
			$cPrice = $_POST['c-price-'.$cPayType];
			$cPriceTypeNormal = $_POST['c-price-normal-type'];
			$cPriceNormal = $_POST['c-price-normal'];
//			echo $cPriceType.$cPrice.$cPriceTypeNormal.$cPriceNormal.$cTimeType;
			$cPrivacy = $_POST['c-privacy'];
			if ($cPrivacy == 'trash') $cTrash = 'yes';
			$cAvailable = $_POST['c-tick-available'];
			if (!$cAvailable) $cAvailable = 'both';
			$cLimit = $_POST['c-limit'];
			$cTicksPublic = $_POST['c-tick-public'];
			$cDays = $_POST['c-day'];
			$cTimeType = $_POST['c-time-type'];
			$cTime = array();
			if ($cTimeType == 'one-time') {
				$cTime = $_POST['c-time'];
				foreach ($cDays as $cOneDay) {
					$cTimeOne = $cOneDay.'-'.$cTime;
					array_push($cTime, $cTimeOne);
				}
			} else {
				foreach ($cDays as $cOneDay) {
					$cTiiOne = $_POST['c-time-'.$cOneDay];
					$cTimeOne = $cOneDay.'-'.$cTiiOne;
					array_push($cTime, $cTimeOne);
				}
				$cTime = implode('|', $cTime);
			}
//			echo $cTime;
			$cDays = implode(',', $cDays);
//			echo $cDays;
			$cPlist = $_POST['c-people-list'];
			$cPlist = implode('|', $cPlist);
			$cDes = _content($_POST['c-des']);
			$cDuration = $_POST['c-duration'];
			
			if (countRecord('course', "`title` = '$cTitle'") <= 0) {
				$add = mysql_query("INSERT INTO `course` (`type`, `did`, `tid`, `uid`, `title`, `thumbnai`, `thumbs`, `des`, `price-type`, `price`, `price-normal-type`, `price_normal`, `available`, `limit`, `duration`, `pay`, `ticks_public`, `time_type`, `lesson_time`, `privacy`, `trash`, `people_list`, `time`) VALUES ('$cType', '$dot', '$cTopic', '$u', '$cTitle', '$cThumbnai', '$thumm', '$cDes', '$cPriceType', '$cPrice', '$cPriceTypeNormal', '$cPriceNormal', '$cAvailable', '$cLimit', '$cDuration', '$cPayType', '$cTicksPublic', '$cTimeType', '$cTime', '$cPrivacy', '$cTrash', '$cPlist', '$current')");
				if ($add) {
					echo '<div class="alerts alert-success">Course <b>'.$cTitle.'</b> has been created successfully.</div>';
					$newCou = getRecord('course', "`title` = '$cTitle' AND `type` = '$cType' AND `tid` = '$cTopic' AND `uid` = '$u' ");
					if ($cPrivacy == 'public') activityAdd('create-course', $newCou['id']);
//					mysql_query("INSERT INTO `activity` (`type`, `uid`, `iid`, `time`) VALUES ('create-course', '$u', '$c', '$current')");
				} else echo '<div class="alerts alert-error">Something went wrong. Please contact the administrators for help.</div>';
			} else echo '<div class="alerts alert-error">You\'re already owned a course named <b>'.$cTitle.'</b>. Is this the different one? For avoiding spamming, please choose another name.</div>';
	}
?>
