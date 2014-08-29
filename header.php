<?php require_once 'lib/config.php' ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="8dot, effective eLearning site">
		<meta name="keywords" content="8dot,eLearning,social">
		<meta name="author" content="Miamor West">
		<title>8dot</title>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMG ?>/8dot.png"/>
<!-- -->
		
		<!-- PLUGINS CSS -->
<!--		<link rel="stylesheet" href="assets/plugins/fancybox/fancybox.min.css"> -->
<!--		<link rel="stylesheet" href="<? echo PLUGINS ?>/colorbox/colorbox.css" /> -->

		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/plugins/flat-ui/css/flat-ui.css"/>
		<link rel="stylesheet" href="assets/plugins/chosen/chosen.min.css">
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" href="assets/css/style.css">
 		<link rel="stylesheet" href="assets/css/main.css"/>
		<link rel="stylesheet" href="assets/plugins/sceditor/minified/themes/default.min.css"/>
		<!-- FONT CSS -->
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
		<? if ($dot) echo '<style>.rb-control:before{background-color:'.$dotInn['color'].'}</style>' ?>
<? 		echo '<script> var MAIN_URL = "'.MAIN_URL.'"</script>' ?>
	</head>
 
	<body class="tooltips">
		
		<!--
		===========================================================
		BEGIN PAGE
		===========================================================
		-->
		<div class="wrapper" id="wrapper">
			<div class="rb-fixed"></div>
			<!-- BEGIN TOP NAV -->
			<div class="top-navbar">
				<div class="top-navbar-inner">
					
					<!-- Begin Logo brand -->
					<div class="logo-brand">
						<a href="#!"><img src="assets/img/8dot-white.png" alt="Sentir logo"> <span class="fa fa-circle"></span></a>
					</div><!-- /.logo-brand -->
					<!-- End Logo brand -->
					
					<div class="top-nav-content">
						
						<!-- Begin button sidebar left toggle -->
						<div class="btn-collapse-sidebar-left">
							<i class="fa fa-long-arrow-right icon-dinamic"></i>
						</div><!-- /.btn-collapse-sidebar-left -->
						<!-- End button sidebar left toggle -->
						
						<!-- Begin button sidebar right toggle -->
						<div class="btn-collapse-sidebar-right">
							<i class="fa fa-bullhorn"></i>
						</div><!-- /.btn-collapse-sidebar-right -->
						<!-- End button sidebar right toggle -->
						
						<!-- Begin button nav toggle -->
						<div class="btn-collapse-nav" data-toggle="collapse" data-target="#main-fixed-nav">
							<i class="fa fa-plus icon-plus"></i>
						</div><!-- /.btn-collapse-sidebar-right -->
						<!-- End button nav toggle -->
						
						
						<!-- Begin user session nav -->
						<ul class="nav-user navbar-right">
							<li class="dropdown">
							  <a class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo $member['avatar'] ?>" class="avatar img-circle" alt="Avatar">
								Hi, <strong><?php echo $member['username'] ?></strong>
							  </a>
							  <ul class="head-dropdown dropdown-menu square primary margin-list-rounded with-triangle">
								<li class="one-account current-account">
									<img class="head-info-ava left" src="<? echo $member['avatar'] ?>"/>
									<div class="account-info">
										<div style="height:19px">
											<a href="#!user?u=<? echo $u ?>"><h3 class="text-primary left"><? echo $member['username'] ?></h3></a>
											<div class="left" style="margin:-4px 5px"><a class="gensmall" href="#!information"><i class="fa fa-edit"></i></a></div>
										</div>
										<span class="gensmall"><? echo $member['type'] ?></span>
										<span class="right label label-<? echo $myLvClas ?>"><? echo $myLv ?></span>
										<div <? if ($myExp < 10) echo 'title="Exp: '.$myExp.'%"' ?> class="progress progress-sm progress-striped active">
											<div class="progress-bar progress-bar-<? echo $myLvClas ?>" style="width: <? echo $myExp ?>%">
												<div class="small"><? if ($myExp >= 10) echo $myExp.'%' ?></div>
											</div>
										</div>
										<div class="exp-coin">
											<div class="left" style="width:120px"><img style="margin-top:-2px" src="<? echo IMG ?>/dollar_coin.png"/> <? echo $member['coin'] ?></div>
											<div class="left"><img style="margin-top:-3px" src="<? echo silk ?>/coins.png"/> <? echo $member['reputation'] ?></div>
											<div class="clearfix"></div>
										</div>
									</div>
									<div class="clearfix"></div>
								</li>
<!--								<li><a href="#fakelink">Account setting</a></li>
								<li><a href="#fakelink">Payment setting</a></li>
								<li><a href="#fakelink">Change password</a></li>
								<li><a href="#fakelink">My public profile</a></li>
								<li class="divider"></li>
-->								<div class="head-dropdown-bottom">
									<a class="head-dropdown-button btn-primary left" href="#!newaccount"><span class="fa fa-plus"></span> New account</a></li>
									<a class="head-dropdown-button btn-danger right" href="#!logout"><span class="fa fa-sign-out"></span> Log out</a></li>
									<a class="head-dropdown-button btn-warning right" style="margin-right:5px" href="#!lock"><span class="fa fa-lock"></span> Lock screen</a>
									<div class="clearfix"></div>
								</div>
							  </ul>
							</li>
						</ul>
						<!-- End user session nav -->
						
						<!-- Begin Collapse menu nav -->
						<div class="collapse navbar-collapse" id="main-fixed-nav">

							<ul class="nav navbar-nav navbar-left">
								<!-- Begin nav notification -->
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown">
										<?php if ($notiNums > 0) echo '<span class="badge badge-primary icon-count">'.$notiNums.'</span>' ?>
										<i class="fa fa-globe" style="font-size:17px"></i>
									</a>
									<ul class="dropdown-menu square with-triangle">
										<li>
											<div class="nav-dropdown-heading">
											Notifications
											</div><!-- /.nav-dropdown-heading -->
											<div class="nav-dropdown-content scroll-nav-dropdown">
												<ul class="notification-load">
												</ul>
											</div><!-- /.nav-dropdown-content scroll-nav-dropdown -->
											<button class="btn btn-primary btn-square btn-block">See all notifications</button>
										</li>
									</ul>
								</li>
								<!-- End nav notification -->
								

								<!-- Begin nav schedule notification -->
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown">
	<?php $eventToday = 0;
		$myCalList = $getRecord -> GET('calendar', "`uid` = '$u' ");
		foreach ($myCalList as $myCall) {
			$startDays = explode('T', $myCall['start']);
			$startDay = explode('-', $startDays[0]);
			$endDays = explode('T', $myCall['end']);
			$endDay = explode('-', $endDays[0]);
			$startDayD = (int)$startDay[2];					(int)$startDayM = $startDay[1];					(int)$startDayY = $startDay[0];
			$endDayD = (int)$endDay[2];					(int)$endDayM = $endDay[1];					(int)$endDayY = $endDay[0];
			if ($todayY >= $startDayY && $todayY <= $endDayY) {
				if ($todaym >= $startDayM && $todaym <= $endDayM) {
					if ($todayd >= $startDayD && $todayd <= $endDayD) {
//						if ($endDays[1] != '00:00:00')
						$eventToday++;
					}
				}
			}
		}
		$scheNotice = $eventToday;
		$myNoticeSche = $getRecord -> GET('mark_notice', "`uid` = '$u' ");
		foreach ($myNoticeSche as $myNSche) {
			if ($myNSche['type'] == 'course') {
				$cinn = getRecord('course', "`id` = '{$myNSche['iid']}' ");
				$ctime = explode('|', $cinn['lesson_time']);
				for ($j = 0; $j < count($ctime); $j++) {
					$ctimm = explode('-', $ctime[$j]);
					$ctimeday = $ctimm[0];
					$ctimetime = $ctimm[1];
					if ($ctimeday == $todayl) $scheNotice++;
				}
			} else if ($myNSche['type'] == 'contest') {
				$cinn = getRecord('contest', "`id` = '{$myNSche['iid']}' ");
				$ctime = explode('|', $cinn['start_rounds']);
				for ($j = 0; $j < count($ctime); $j++) {
					$ctimm = explode('>', $ctime[$j]);
					if ($ctimm[1] == $today) $scheNotice++;
				}
			}
		} ?>
										<?php if ($scheNotice > 0) echo '<span class="badge badge-danger icon-count">'.$scheNotice.'</span>' ?>
										<i class="fa fa-bell"></i>
									</a>
									<ul class="dropdown-menu square with-triangle">
										<li>
											<div class="nav-dropdown-heading">
											Schedule alarm
											</div><!-- /.nav-dropdown-heading -->
											<div class="nav-dropdown-content scroll-nav-dropdown">
												<ul>
<?php $todayEvs = array();
	foreach ($myNoticeSche as $myNoticeSche) {
		if ($myNoticeSche['type'] == 'course') {
			$cinn = getRecord('course', "`id` = '{$myNoticeSche['iid']}' ");
			$ctime = explode('|', $cinn['lesson_time']);
			for ($j = 0; $j < count($ctime); $j++) {
				$ctimm = explode('-', $ctime[$j]);
				$ctimeday = $ctimm[0];
				$ctimetime = $ctimm[1];
				if ($ctimeday == $todayl) {
					$cArray = array($today => array('id' => $cinn['id'], 'type' => 'course') );
					$todayEvs = array_merge($todayEvs, $cArray) ?>
									<li class="unread" id="<?php echo $today ?>">
										<a class="dropdown-alarm" href="#!course?c=<?php echo $cinn['id'] ?>">
											<img src="<?php echo $cinn['thumbnai'] ?>" class="absolute-left-content img-circle" alt="Thumbnai">
											<span class="a-title"><?php echo $cinn['title'] ?></span>
											<span class="small-caps">
												Starts <?php echo $ctimetime ?> today
											</span>
										</a>
									</li>
<?php 			}
			}
		} else if ($myNoticeSche['type'] == 'contest') {
			$cinn = getRecord('contest', "`id` = '{$myNoticeSche['iid']}' ");
			$ctime = explode('|', $cinn['start_rounds']);
			for ($j = 0; $j < count($ctime); $j++) {
				$ctimm = explode('>', $ctime[$j]);
				$ctimeday = $ctimm[1];
				if ($ctimeday == $today) {
					$cArray = array($today => array('id' => $cinn['id'], 'type' => 'event') );
					$todayEvs = array_merge($todayEvs, $cArray) ?>
									<li class="<? if ($myNoticeEv['uid'] == $u) echo 'stared' ?> unread" id="<?php echo $today ?>">
										<a class="dropdown-alarm" href="#!event?i=<?php echo $cinn['id'] ?>">
											<span class="icon dogear" title="You're the host"></span>
											<img src="<?php echo $cinn['thumbnai'] ?>" class="absolute-left-content img-circle" alt="Thumbnai">
											<span class="a-title"><?php echo $cinn['title'] ?></span>
											<span class="small-caps">
												Round <? echo $ctimm[0] ?> starts <?php echo $ctimetime ?> today
											</span>
										</a>
									</li>
<?php 			}
			}
		}
	}
		foreach ($myCalList as $myCal) {
			$startDays = explode('T', $myCal['start']);
			$startDay = explode('-', $startDays[0]);
			$endDays = explode('T', $myCal['end']);
			$endDay = explode('-', $endDays[0]);
			$startDayD = (int)$startDay[2];					(int)$startDayM = $startDay[1];					(int)$startDayY = $startDay[0];
			$endDayD = (int)$endDay[2];					(int)$endDayM = $endDay[1];					(int)$endDayY = $endDay[0];
			$sArray = array($startDayD.'-'.$startDayM.'-'.$startDayY => array('id' => $myCal['id'], 'type' => 'schedule', 'end' => $endDayD.'-'.$endDayM.'-'.$endDayY) );
			if ($todayY >= $startDayY && $todayY <= $endDayY) {
				if ($todaym >= $startDayM && $todaym <= $endDayM) {
					if ($todayd >= $startDayD && $todayd <= $endDayD) {
//						if ($endDays[1] != '00:00:00') {
							$fullStartDay = $startDayD.'-'.$startDayM.'-'.$startDayY;
							$fullEndDay = $endDayD.'-'.$endDayM.'-'.$endDayY;
							$todayEvs = array_merge($todayEvs, $sArray); ?>
									<li id="<?php echo $startDayD.'-'.$startDayM.'-'.$startDayY ?>">
										<a class="dropdown-noti" href="#!schedule">
											<img src="<?php if ($myCal['thumbnai']) echo $myCal['thumbnai']; else echo $member['avatar'] ?>" class="absolute-left-content img-circle" alt="Thumbnai">
											<span class="a-title"><?php echo $myCal['title'] ?></span>
											<span class="small-caps">
												<?php echo $fullStartDay;
													if ($fullStartDay !== $fullEndDay) echo ' till '.$fullEndDay;
													else echo ' <i class="gensmall">one day event</i>' ?>
											</span>
										</a>
									</li>
<?php //					}
					}
				}
			}
		} ?>
												</ul>
											</div><!-- /.nav-dropdown-content scroll-nav-dropdown -->
											<button class="btn btn-primary btn-square btn-block">See all alarms</button>
										</li>
									</ul>
								</li>
								<!-- End nav schedule notification -->



								<!-- Begin nav task -->
<? if ($member['type'] == 'student') { ?>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown">
<?php $tWarn = 0;
	$fCourse = $getRecord -> GET('course_join', "`uid` = '$u' ");
	foreach ($fCourse as $fC) {
		$task = $getRecord -> GET('task', "`public` = 'yes' AND `cid` = '{$fC['cid']}' ");
		foreach ($task as $task) {
			$lList = getRecord('lesson', "`id` = '{$task['lid']}' ");
			$checkMyTsk = countRecord('task_submit', "`uid` = '$u' AND `tid` = '{$task['id']}' ");
			$checkMyTskEx = countRecord('task_ex_submit', "`uid` = '$u' AND `tid` = '{$task['id']}' ");
			if ($task && $task['deadline'] == $today && $checkMyTsk <= 0 /*&& $checkMyTskEx > 0*/)
//			if ($checkMyTsk <= 0)
				$tWarn++;
		}
	} ?>
										<?php if ($tWarn > 0) echo '<span class="badge badge-warning icon-count">'.$tWarn.'</span>' ?>
										<i class="fa fa-tasks"></i>
									</a>
									<ul class="dropdown-menu square margin-list-rounded with-triangle">
										<li>
											<div class="nav-dropdown-heading">
											Tasks
											</div><!-- /.nav-dropdown-heading -->
											<div class="nav-dropdown-content scroll-nav-dropdown task-list-noti">
												<ul>
<? foreach ($fCourse as $fCourse) {
	$task = $getRecord -> GET('task', "`public` = 'yes' AND `cid` = '{$fCourse['cid']}' ");
	foreach ($task as $task) {
		$lList = getRecord('lesson', "`id` = '{$task['lid']}' ");
		$checkMyTsk = countRecord('task_submit', "`uid` = '$u' AND `tid` = '{$task['id']}' ");
		$checkMyTskEx = countRecord('task_ex_submit', "`uid` = '$u' AND `tid` = '{$task['id']}' ");
		if ($task /*&& $task['deadline'] == $today && $checkMyTsk <= 0 && $checkMyTskEx > 0*/) {
			$tDay = intval(date('d')); $tMonth = intval(date('m')); $tYear = intval(date('Y'));
			$dead = explode('-', $task['deadline']);
			$dDay = intval($dead[0]); $dMonth = intval($dead[1]); $dYear = intval($dead[2]);
			if ($checkMyTsk > 0) $label = 'success';
			else {
				if ($today == $task['deadline']) $label = 'warning';
				else if ($tYear < $dYear) $label = 'danger';
				else if ($tYear > $dYear) $label = 'primary';
				else {
					if ($tMonth < $dMonth) $label = 'primary';
					else if ($tMonth > $dMonth) $label = 'danger';
					else {
						if ($tDay < $dDay) $label = 'primary';
						else if ($tDay > $dDay) $label = 'danger';
					}
				}
				if ($label == 'danger') $dTitle = 'Deadline passed';
				else if ($label == 'warning') $dTitle = 'Today is deadline!';
				else {
					if ($tYear < $dYear) {
						$lft = $dYear - $tYear;
						if ($lft > 1) $dTitle = $lft.' years till deadline';
						else $dTitle = $lft.' year till deadline';
					} else if ($tMonth < $dMonth) {
						$lft = $dMonth - $tMonth;
						if ($lft > 1) $dTitle = $lft.' months till deadline';
						else $dTitle = $lft.' month till deadline';
					} else if ($tDay < $dDay) {
						$lft = $dDay - $tDay;
						if ($lft > 1) $dTitle = $lft.' days till deadline';
						else $dTitle = $lft.' day till deadline';
					}
				}
			}
				$tskExNum = countRecord('task_ex', "`tid` = '{$task['id']}' ");
				$tsk = $getRecord -> GET('task_ex', "`tid` = '{$task['id']}' ");
				$myDoneEx = 0;
				foreach ($tsk as $tsk) {
					$tskSubmit = $getRecord -> GET('task_ex_submit', "`uid` = '$u' AND `teid` = '{$tsk['id']}' ");
					if (countRecord('task_ex_submit', "`uid` = '$u' AND `teid` = '{$tsk['id']}' ") > 0) $myDoneEx++;
				}
				$pComplete = round($myDoneEx/$tskExNum * 100, 2);
				if ($pComplete == 100) $pClass = 'primary';
				else if ($pComplete < 100 && $pComplete >= 90) $pClass = 'success';
				else if ($pComplete < 90 && $pComplete >= 30) $pClass = 'warning';
				else if ($pComplete < 30) $pClass = 'danger';
				if ($checkMyTsk > 0) {
					$clas = 'completed';
					$icon = 'fa-check-circle-o';
					$myTk = getRecord('task_submit', "`uid` = '$u' AND `tid` = '{$task['id']}' ");
				} else {
					if ($label == 'danger') {
						$icon = 'fa-exclamation-circle';
						$clas = 'uncompleted';
					} else if ($label == 'warning') {
						$icon = 'fa-clock-o';
						$clas = 'progress';
					} else if ($checkMyTskEx > 0) {
						$icon = 'fa-edit';
						$clas = 'primary';
					} else {
						$icon = 'fa-circle-o';
						$clas = 'default';
					}
				} ?>
									<li class="<?php if ($clas == 'progress') echo 'unread' ?>">
										<a class="dropdown-task <?php if ($checkMyTsk <= 0 || $myTk['grade'] == '0') echo 'do-task' ?>" id="<?php echo $task['id'] ?>">
											<i class="fa <?php echo $icon ?> absolute-left-content icon-task <?php echo $clas ?>"></i>
											<span class="a-title" title="<?php echo $lList['title'] ?>"><?php if ($lList['prefix']) echo '<span class="label label-info">'.$lList['prefix'].'</span> '; echo $lList['title'] ?></span>
											<span class="badge badge-warning" title="<?php echo $tskExNum ?> exercise include"><?php echo $tskExNum ?></span>
											<span class="small-caps">
												<span class="label label-<?php echo $label ?> right"><?php echo $task['deadline'] ?></span>
									<? if ($checkMyTsk <= 0 && $checkMyTskEx > 0) { ?>
										<div class="task-progress-bar-header progress progress-sm progress-striped active">
											<div class="progress-bar progress-bar-<? if ($clas == 'uncompleted') echo 'danger'; else echo $pClass ?>" aria-valuenow="90" style="width: <?php echo $pComplete ?>%">
												<div class="small" title="<?php echo $myDoneEx.'/'.$tskExNum ?>"><?php echo $pComplete ?>%</div>
											</div><!-- /.progress-bar .progress-bar-danger -->
										</div>
									<?php } ?>
									<? if ($clas == 'completed') echo '<span class="fa fa-clock-o" title="Submitted"></span> '.$myTk['time'];
										// else if ($clas == 'uncompleted') echo 'Deadline passed'; ?>
											</span>
										</a>
									</li>
<?php 		}
		}
	} ?>
												</ul>
											</div><!-- /.nav-dropdown-content scroll-nav-dropdown -->
											<button class="btn btn-primary btn-square btn-block">See all tasks</button>
										</li>
									</ul>
								</li>
								<!-- End nav task -->
<? } ?>

								<!-- Begin nav message -->
								<li class="dropdown">
									<a class="dropdown-toggle chat-mes-count" data-toggle="dropdown">
										<? if ($mesNums > 0) echo '<span class="badge badge-success icon-count">'.$mesNums.'</span>' ?>
										<i class="fa fa-comments"></i>
									</a>
<? if ($mesNums > 0) { ?>
									<ul class="dropdown-menu square margin-list-rounded with-triangle">
										<li>
											<div class="nav-dropdown-heading">
											Messages
											</div><!-- /.nav-dropdown-heading -->
											<div class="nav-dropdown-content scroll-nav-dropdown">
												<ul>
												</ul>
											</div><!-- /.nav-dropdown-content scroll-nav-dropdown -->
											<button class="btn btn-primary btn-square btn-block">See all messages</button>
										</li>
									</ul>
<? } ?>
								</li>
								<!-- End nav message -->

								<!-- Begin nav friend requuest -->
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown">
										<?php if ($frRequestNums > 0) echo '<span class="badge badge-info icon-count">'.$frRequestNums.'</span>' ?>
										<i class="fa fa-users"></i>
									</a>
<? if ($frRequestNums > 0) { ?>
									<ul class="dropdown-menu square margin-list-rounded with-triangle">
										<li>
											<div class="nav-dropdown-heading">
											Friend requests
											</div><!-- /.nav-dropdown-heading -->
											<div class="nav-dropdown-content static-list scroll-nav-dropdown">
												<ul>
			<?php $fR = $getRecord -> GET('friend', "`receive_id` = '$u' AND `accept` != 'yes'");
				foreach ($fR as $fR) {
					$fRsend = getRecord('members', "`id` = '{$fR['uid']}'");
					$mutualF = 0;
					$fRsendFriend = $getRecord -> GET('friend', "`accept` = 'yes' AND (`receive_id` = '{$fR['uid']}' OR `uid` = '{$fR['uid']}')");
					foreach ($fRsendFriend as $fRsendFriend) {
						if (countRecord('friend', "`accept` = 'yes' AND (`receive_id` = '$u' OR `uid` = '$u')") > 0) $mutualF++;
					} ?>
													<li>
														<img src="<?php echo $fRsend['avatar'] ?>" class="absolute-left-content img-circle" alt="Avatar">
														<div class="row">
															<div class="col-xs-6">
																<strong><?php echo $fRsend['username'] ?></strong>
																<span class="small-caps"><?php echo $mutualF ?> murtual friends</span>
															</div>
															<div class="col-xs-6 text-right btn-action">
																<button class="btn btn-success btn-xs">Accept</button><button class="btn btn-danger btn-xs">Ignore</button>
															</div><!-- /.col-xs-5 text-right btn-cation -->
														</div><!-- /.row -->
													</li>
			<?php } ?>
												</ul>
											</div><!-- /.nav-dropdown-content scroll-nav-dropdown -->
											<button class="btn btn-primary btn-square btn-block">See all requests</button>
										</li>
									</ul>
<? } ?>
								</li>
								<!-- End nav friend requuest -->
							</ul>

							<!-- Begin nav search form -->
							<form class="navbar-form navbar-left" role="search">
								<div class="form-group">
									<input class="input-search" placeholder="Search">
								</div>
							</form>
							<!-- End nav search form -->

						</div><!-- /.navbar-collapse -->
						<!-- End Collapse menu nav -->

<!--			<div class="dott get-dot"></div> -->
		<div id="dots">
	<?php $dotUseList = $getRecord -> GET('dot_use', "`uid` = '$u'", '', '`did` ASC');
		foreach ($dotUseList as $dotUseList) {
			$dotInfo = getRecord('dot', "`id` = '{$dotUseList['did']}'"); ?>
			<div class="dot dot-<?php echo $dotInfo['re'] ?> <?php if ($dot == $dotInfo['title'] || $dot == $dotInfo['id']) echo 'dot-selected' ?>" alt="<?php echo $dotInfo['id'] ?>" title="Dot <?php echo $dotInfo['title'] ?>"><span class="dot-color" style="background:<?php echo $dotInfo['color'] ?>"></span></div>
	<?php } ?>
		</div>
						
					</div><!-- /.top-nav-content -->
				</div><!-- /.top-navbar-inner -->
			</div><!-- /.top-navbar -->
			<!-- END TOP NAV -->
			
			
			
			<!-- BEGIN SIDEBAR LEFT -->
			<?php include 'left-side-bar.php' ?>
			<!-- END SIDEBAR LEFT -->
			
			
			
			<!-- BEGIN SIDEBAR RIGHT HEADING -->
			<div class="sidebar-right-heading">
				<ul class="nav nav-tabs square nav-justified">
				  <li class="active"><a href="#online-user-sidebar" data-toggle="tab"><i class="fa fa-comments"></i></a></li>
				  <li><a href="#noti-sidebar" data-toggle="tab"><i class="fa fa-tasks"></i></a></li>
				  <li><a href="#setting-sidebar" data-toggle="tab"><i class="fa fa-cogs"></i></a></li>
				</ul>
			</div><!-- /.sidebar-right-heading -->
			<!-- END SIDEBAR RIGHT HEADING -->
			
			
			
			<!-- BEGIN SIDEBAR RIGHT -->
			<?php include 'right-side-bar.php' ?>
			<!-- END SIDEBAR RIGHT -->
			
			
			<div class="hide small-board-fixed"></div>
			<div class="hide small-board sb-logout"></div>
			
			
<div class="chat-stick"></div>
			
			
			
			<!-- BEGIN PAGE CONTENT -->
			<div class="page-content">
				<div class="container-fluid" id="content">
				
				
