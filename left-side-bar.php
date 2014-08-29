		<div class="sidebar-left ">
			<div class="right-shadow"></div>
			<div class="sidebar-nicescroller">
				<ul class="sidebar-menu">
					<li><a href="#!feed"><i class="fa fa-globe icon-sidebar"></i>Feeds</a></li>

					<li class="static">Course</li>
					<li><a href="#!course"><i class="fa fa-fire icon-sidebar"></i> Course list <span class="badge badge-warning span-sidebar"><?php echo $newCourseCount ?></span></a></li>
				<?php if ($member['type'] == 'teacher') 
					echo '<li><a class="create-new-course"><i class="fa fa-plus-square icon-sidebar"></i> Create a course <span class="label label-info span-sidebar">BS3</span></a></li>
						<li><a href="#!mycourse"><i class="fa fa-folder-open icon-sidebar"></i> My courses <span class="badge badge-warning span-sidebar">'.countRecord('course', "`uid` = '$u'").'</span></a></li>' ?>

					<div class="manage-course hide">
						<li class="static">
							<i class="fa fa-cog icon-sidebar"></i>
							Manage this course
						</li>
						<ul class="submenu manage-course-list">
							<li class="manage-course-edit"><a><i class="fa fa-cog icon-sidebar"></i> Edit course</a></li>
							<li class="manage-course-ticks"><a><i class="fa fa-ticket icon-sidebar"></i> Tickets</a></li>
							<li class="manage-course-lesson"><a><i class="fa fa-book icon-sidebar"></i> <i class="fa fa-angle-right chevron-icon-sidebar"></i> Lesson</a>
								<ul class="submenu">
									<li><a class="create-new-lesson">New lesson</a></li>
									<li class="edit-lesson-li"><a class="edit-lesson">Edit this lesson</a></li>
									<li class="edit-lesson-li"><a class="add-exercise">Add exercise</a></li>
									<li class="edit-lesson-li"><a class="delete-lesson">Delete this lesson</a></li>
								</ul>
							</li>
							<li><a class="create-new-test"><i class="fa fa-puzzle-piece icon-sidebar"></i> Create a test <span class="label label-danger span-sidebar" style="margin-top:7px">BS3</span></a></li>
							<li class="manage-course-announcement"><a><i class="fa fa-bullhorn icon-sidebar"></i> <i class="fa fa-angle-right chevron-icon-sidebar"></i> Announcement</a>
								<ul class="submenu">
									<li><a class="create-new-announcement">New announcement</a></li>
									<li class="edit-announce-li"><a class="edit-announce">Edit this announcement</a></li>
									<li class="edit-announce-li"><a class="delete-announce">Delete this announcement</a></li>
								</ul>
							</li>
							<li class="manage-course-score"><a><i class="fa fa-file-text icon-sidebar"></i> Score</a></li>
							<li class="manage-course-delete"><a><i class="fa fa-times icon-sidebar"></i> Delete this course</a></li>
						</ul>
					</div>

					<li class="static">Libraries</li>
					<li class="create-lib">
						<a>
							<i class="fa fa-plus-square icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							<div class="app-create-course"></div> Create new
						</a>
						<ul class="submenu create-new-lib-list">
							<li class="create-new-quest"><a>New quest</a></li>
							<li class="create-new-exercise"><a>New exercise</a></li>
							<li class="create-new-document"><a>New document</a></li>
							<li class="create-new-daily-ex"><a>New daily exercise</a></li>
						</ul>
					</li>
					<li><a href="#!todayTask"><i class="fa fa-book icon-sidebar"></i> Daily exercise
						<? $todayEx = countRecord('daily_ex', "`day` = '$today' "); if ($todayEx > 0) echo '<span class="badge badge-info span-sidebar">'.$todayEx.'</span>' ?></a></li>
					<li><a href="#!quest"><i class="fa fa-question-circle icon-sidebar"></i> Quest library</a></li>
					<li><a href="#!exercise"><i class="fa fa-book icon-sidebar"></i> Exercise storage</a></li>
					<li><a href="#!document"><i class="fa fa-paperclip icon-sidebar"></i> Document sharing</a></li>
					<li><a href="#!dictionary"><i class="fa fa-book icon-sidebar"></i> Dictionary <span class="label label-info span-sidebar" title="Language dot supporter">L</span></a></li>

					<li class="static">Games</li>
					<li class="upload-game"><a><i class="fa fa-plus-square icon-sidebar"></i><div class="app-create-course"></div> Upload game</a></li>
					<li><a href="#!game"><i class="fa fa-gamepad icon-sidebar"></i> <div class="app-course-list"></div> Game centre</a></li>
					<li><a href="#!mygame"><i class="fa fa-cube icon-sidebar"></i> <div class="app-course-list"></div> My game</a></li>

					<li class="static">Pages</li>
					<li>
						<a>
							<i class="fa fa-heart icon-sidebar"></i>
							Following <?php if (countRecord('page_like', "`uid` = '$u'") > 0) echo '<span class="badge badge-warning span-sidebar">'.countRecord('page_like', "`uid` = '$u'").'</span><i class="fa fa-angle-right chevron-icon-sidebar"></i>' ?>
						</a>
			<?php if (countRecord('page_like', "`uid` = '$u'") > 0) { ?>
						<ul class="submenu">
					<?php $fPage = $getRecord -> GET('page_like', "`uid` = '$u'");
						foreach ($fPage as $fPage) {
							$pageInfo = getRecord('page', "`id` = '{$fPage['iid']}'") ?>
							<li><a href="#!page?p=<?php echo $pageInfo['id'] ?>">
								<?php echo $pageInfo['title'];
									if ($pageInfo['uid'] == $u) echo '<span class="label label-danger span-sidebar">Founder</span>';
									else if (countRecord('page_admin', "`uid` = '$u' AND `iid` = '{$pageInfo['id']}'") > 0) echo '<span class="label label-info span-sidebar">Admin</span>' ?>
							</a></li>
					<?php } ?>
						</ul>
			<?php } ?>
					</li>
					<li><a class="create-new-page"><i class="fa fa-plus-square icon-sidebar"></i> Create a page</a></li>

					<li class="static">Groups</li>
					<li>
						<a>
							<i class="fa fa-heart icon-sidebar"></i>
							Following <?php if (countRecord('group_join', "`uid` = '$u'") > 0) echo '<span class="badge badge-warning span-sidebar">'.countRecord('group_join', "`uid` = '$u'").'</span><i class="fa fa-angle-right chevron-icon-sidebar"></i>' ?>
						</a>
			<?php if (countRecord('group_join', "`uid` = '$u'") > 0) { ?>
						<ul class="submenu">
					<?php $fGroup = $getRecord -> GET('group_join', "`uid` = '$u'");
						foreach ($fGroup as $fGroup) {
							$gInfo = getRecord('group', "`id` = '{$fGroup['iid']}'") ?>
							<li><a href="#!groups?p=<?php echo $gInfo['id'] ?>">
								<?php echo $gInfo['title'];
									if ($gInfo['uid'] == $u) echo '<span class="label label-danger span-sidebar">Founder</span>';
									else if (countRecord('group_admin', "`uid` = '$u' AND `iid` = '{$gInfo['id']}'") > 0) echo '<span class="label label-info span-sidebar">Admin</span>' ?>
							</a></li>
					<?php } ?>
						</ul>
			<?php } ?>
					</li>
					<li><a class="create-new-group"><i class="fa fa-plus-square icon-sidebar"></i> Create a group</a></li>

					<li class="static">Events</li>
					<li><a href="#!event"><i class="fa fa-fire icon-sidebar"></i> All event list <span class="badge badge-warning span-sidebar"><?php echo $newCourseCount ?></span></a></li>
					<li><a class="create-new-event"><i class="fa fa-plus-square icon-sidebar"></i> Create an event <span class="label label-info span-sidebar">BS3</span></a></li>
					<div class="manage-event hide">
						<li class="static">
							<i class="fa fa-cog icon-sidebar"></i>
							Manage this contest
						</li>
						<ul class="submenu manage-event-list">
							<li class="manage-event-round"><a><i class="fa fa-cog icon-sidebar"></i> Edit this round</a></li>
							<li class="manage-event-round-mem"><a><i class="fa fa-cog icon-sidebar"></i> Round members</a></li>
							<li class="manage-event-result"><a><i class="fa fa-ticket icon-sidebar"></i> Contest result</a></li>
						</ul>
					</div>


					<li class="static">Personal</li>
					<li><a href="#!profile"><i class="fa fa-user icon-sidebar"></i>Profile </a></li>
					<li><a href="#!apps"><i class="fa fa-cloud icon-sidebar"></i>Apps </a></li>
					<li><a href="#!package"><i class="fa fa-suitcase icon-sidebar"></i>My package </a></li>
				<?php if ($member['type'] == 'student') {
					 echo '<li><a href="#!task"><i class="fa fa-tasks icon-sidebar"></i>Tasks ';
						if ($tWarn > 0) echo '<span class="badge badge-warning span-sidebar">'.$tWarn.'</span>';
					echo '</a></li>';
					} ?>
					<li><a href="#!schedule"><i class="fa fa-calendar icon-sidebar"></i>My schedule
				<?php if ($eventToday > 0) echo '<span class="badge badge-danger span-sidebar">'.$eventToday.'</span>' ?>
						</a></li>
					<li>
						<a>
							<i class="fa fa-inbox icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							Mail apps
						</a>
						<ul class="submenu">
							<li><a href="#!mail">Inbox <span class="badge badge-success span-sidebar">5</span></a></li>
							<li><a href="#!mail?t=sent">Sent mail</a></li>
							<li><a href="#!mail?mode=new">New mail</a></li>
							<li><a href="#!mail?t=contact">Mail contact</a></li>
						</ul>
					</li>
					<li><a href="#!preferences"><i class="fa fa-cogs icon-sidebar"></i>Preferences </a></li>
					<li><a href="#!statistics"><i class="fa fa-bar-chart-o icon-sidebar"></i>Statistics <span class="label label-success span-sidebar">TOP</span></a></li>

<!--					<li class="static">Apps</li>
					<li><a><i class="fa fa-question-circle icon-sidebar"></i> <div class="app-course-list"></div> Mindmaps</a></li>
					<li><a><i class="fa fa-book icon-sidebar"></i> <div class="app-course-list"></div> Math type</a></li>
					<li><a><i class="fa fa-paperclip icon-sidebar"></i> <div class="app-course-list"></div> Grading tool</a></li>					
					
					<li class="static">SYSTEM SETTING</li>
					<li class="text-content">
						<div class="switch">
							<div class="onoffswitch blank">
								<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="alertme" checked>
								<label class="onoffswitch-label" for="alertme">
									<span class="onoffswitch-inner"></span>
									<span class="onoffswitch-switch"></span>
								</label>
							</div>
						</div>
						Alert me when system down
					</li>
					<li class="text-content">
						<div class="switch">
							<div class="onoffswitch blank">
								<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="autoupdate">
								<label class="onoffswitch-label" for="autoupdate">
									<span class="onoffswitch-inner"></span>
									<span class="onoffswitch-switch"></span>
								</label>
							</div>
						</div>
						Automatic update
					</li>
					<li class="text-content">
						<div class="switch">
							<div class="onoffswitch blank">
								<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="dailyreport">
								<label class="onoffswitch-label" for="dailyreport">
									<span class="onoffswitch-inner"></span>
									<span class="onoffswitch-switch"></span>
								</label>
							</div>
						</div>
						Daily task report
					</li>
					<li class="text-content">
						<div class="switch">
							<div class="onoffswitch blank">
								<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="remembercomputer" checked>
								<label class="onoffswitch-label" for="remembercomputer">
									<span class="onoffswitch-inner"></span>
									<span class="onoffswitch-switch"></span>
								</label>
							</div>
						</div>
						Remember this computer
					</li>
-->
				</ul>
			</div>
		</div><!-- /.sidebar-left -->
