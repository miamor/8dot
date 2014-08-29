<?php $pagg = getRecord('page', "`id` = '$p'") ?>

<div class="user-right-col the-box">
	<div class="user-info-avatar">
		<img src="<?php echo $pagg['avatar'] ?>"/>
	</div>
	<h2><?php echo $pagg['title'] ?></h2>
</div>

<div class="user-main-col">
	<div class="user-info-cover" style="background-image:url('<?php echo $pagg['cover'] ?>')"></div>
	<div class="user-info-menubar">
	<? if ($pagg['uid'] == $u) {
		echo '<div class="user-info-acts right" style="margin-top:3px">';
		echo '<div class="btn btn-primary btn-perspective create-test">New test</div>';
		echo '<div class="btn btn-primary btn-perspective create-new-event">New contest</div>';
		echo '</div>';
	} ?>
		<div class="user-info-acts right" style="position:absolute;right:440px">
	<? if (countRecord('page_like', "`iid` = '$p' AND `uid` = '$u'") > 0) echo '<a class="btn btn-info"><i class="fa fa-check-circle"></i> Liked</a>';
		else echo '<a class="btn btn-default"><i class="fa fa-check-circle"></i> Like</a>' ?>
		</div>

		<li class="selected">Home</li>
		<li>About</li>
		<li>Course</li>
		<li>Library</li>
		<li>Friends/Follow</li>
		<li>Statistics</li>
	</div>
</div>

					<!-- BEGIN TIMELINE -->
					<ul class="timeline">
						<li class="centering-line"></li>
						
						<!-- BEGIN POST FORM -->
						<li class="item-timeline post-form-timeline">
							<div class="buletan"></div>
							<div class="inner-content">
								<ul class="nav nav-tabs">
								  <li class="active"><a href="#fakelink"><i class="fa fa-comment"></i></a></li>
								  <li><a href="#fakelink"><i class="fa fa-quote-left"></i></a></li>
								  <li><a href="#fakelink"><i class="fa fa-picture-o"></i></a></li>
								</ul>
								<form role="form" style="margin-top: -1px">
									<p>
									<textarea style="height: 75px;width:100%" placeholder="Write something on your timeline"></textarea>
									</p>
								<p class="text-right"><button type="submit" class="btn btn-primary btn-sm">Post</button></p>
								</form>
							</div><!-- /.inner-content -->
						</li>
						<!-- END POST FORM -->
						
						<!-- BEGIN TIME CAT-->
						<li class="center-timeline-cat">
							<div class="inner">
							March 2014
							</div><!-- /.inner -->
						</li>
						<!-- END TIME CAT-->
					</ul>	
						
					<ul class="timeline">
						<!-- BEGIN CENTERING LINE -->
						<li class="centering-line"></li>
						<!-- END CENTERING LINE -->
						

<?php $psts = $getRecord -> GET('activity', "`pid` = '$p' ") ?>


						<!-- BEGIN ITEM TIMELINE -->
						<li class="item-timeline">
							<div class="buletan"></div>
							<div class="inner-content">
								<!-- BEGIN HEADING TIMELINE -->
								<div class="heading-timeline">
									<img src="assets/img/avatar/avatar-1.jpg" class="avatar" alt="Avatar">
									<div class="user-timeline-info">
										<p>
										Paris Hawker
										<small>Yesterday at 05:13 AM</small></p>
									</div><!-- /.user-timeline-info -->
								</div><!-- /.heading-timeline -->
								<!-- END HEADING TIMELINE -->
								
								<h4>Responsive full width image</h4>
								<p>
								Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica
								</p>
								<img src="assets/img/photo/small/img-1.jpg" class="img-responsive" alt="Image">
								
								<!-- BEGIN FOOTER TIMELINE -->
								<div class="footer-timeline">
									<ul class="timeline-option">
										<li class="option-row">
											<div class="row">
												<div class="col-xs-6">
													<ol>
														<li><a href="#fakelink">Like</a></li>
														<li><a href="#fakelink">Comment</a></li>
													</ol>
												</div><!-- /.col-xs-6 -->
												<div class="col-xs-6 text-right">
													<ol>
														<li><a href="#fakelink"><i class="fa fa-thumbs-o-up"></i> 124</a></li>
														<li><a href="#fakelink"><i class="fa fa-comments"></i> 26</a></li>
													</ol>
												</div><!-- /.col-xs-6 -->
											</div><!-- /.row -->
										</li>
										<li class="option-row">
											<img src="assets/img/avatar/avatar-1.jpg" class="avatar" alt="Avatar">
											<div class="reply">
												<form role="form">
												<input type="text" class="form-control input-sm" placeholder="Write your comment...">
												</form>
											</div><!-- /.reply -->
										</li>
										<li class="option-row">
											<strong><a href="#fakelink"><i class="fa fa-comments"></i> View 22 more comments</a></strong>
										</li>
										<li class="option-row">
											<img src="assets/img/avatar/avatar-16.jpg" class="avatar" alt="Avatar">
											<div class="reply">
												<p><strong><a href="#fakelink">Ryan Ortega</a></strong> 
												Woh, kok ketoe gayeng tenan kui acarane nduk?</p>
												<p class="text-muted reply-time">3 hours ago</p>
											</div><!-- /.reply -->
										</li>
										<li class="option-row">
											<img src="assets/img/avatar/avatar-7.jpg" class="avatar" alt="Avatar">
											<div class="reply">
												<p><strong><a href="#fakelink">Elizabeth Owens</a></strong> wah, aku telat oleh informasine je,
												malah tabrakan karo jadwalku manggung karo Sera ning mbantul wingi kae</p>
												<p class="text-muted reply-time">4 hours ago</p>
											</div><!-- /.reply -->
										</li>
										<li class="option-row">
											<img src="assets/img/avatar/avatar-5.jpg" class="avatar" alt="Avatar">
											<div class="reply">
												<p><strong><a href="#fakelink">Mihaela Cihac</a></strong> do ra tau ngabari aku nek ono acara ngene iki cah-cah,
												aku sedih bingit kie lah :(</p>
												<p class="text-muted reply-time">7 hours ago</p>
											</div><!-- /.reply -->
										</li>
										<li class="option-row">
											<img src="assets/img/avatar/avatar-20.jpg" class="avatar" alt="Avatar">
											<div class="reply">
												<p><strong><a href="#fakelink">Jason Crawford</a></strong> kok potoku ora ono ki?</p>
												<p class="text-muted reply-time">8 hours ago</p>
											</div><!-- /.reply -->
										</li>
									</ul>
								</div><!-- /.footer-timeline -->
								<!-- END FOOTER TIMELINE -->
							</div><!-- /.inner-content -->
						</li>
						<!-- END ITEM TIMELINE -->
						
						
					
						<!-- BEGIN TIME CAT-->
						<li class="center-timeline-cat">
							<div class="inner">
							February 2014
							</div><!-- /.inner -->
						</li>
						<!-- BEGIN END CAT-->
						
						
						
						<!-- BEGIN ITEM HIGHLIGHT TIMELINE -->
						<li class="item-timeline highlight">
							<div class="buletan"></div>
							<div class="inner-content">
								<!-- BEGIN HEADING TIMELINE -->
								<div class="heading-timeline">
									<img src="assets/img/avatar/avatar-1.jpg" class="avatar" alt="Avatar">
									<div class="user-timeline-info">
										<p>
										Paris Hawker
										<small>February 21, 2014 at 07:52 AM</small></p>
									</div><!-- /.user-timeline-info -->
								</div><!-- /.heading-timeli ne -->
								<!-- END HEADING TIMELINE -->
								
								<h4 class="text-center">Highlight post here</h4>
								<p>
								Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica
								Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica
								Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica
								Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica
								</p>
								
								<!-- BEGIN FOOTER TIMELINE -->
								<div class="footer-timeline">
									<ul class="timeline-option">
										<li class="option-row">
											<div class="row">
												<div class="col-xs-6">
													<ol>
														<li><a href="#fakelink">Like</a></li>
														<li><a href="#fakelink">Comment</a></li>
													</ol>
												</div><!-- /.col-xs-6 -->
												<div class="col-xs-6 text-right">
													<ol>
														<li><a href="#fakelink" data-toggle="tooltip" title="Harry Nichols and 253 other like this post"><i class="fa fa-thumbs-o-up"></i> 254</a></li>
													</ol>
												</div><!-- /.col-xs-6 -->
											</div><!-- /.row -->
										</li>
										<li class="option-row">
											<img src="assets/img/avatar/avatar-1.jpg" class="avatar" alt="Avatar">
											<div class="reply">
												<form role="form">
												<input type="text" class="form-control input-sm" placeholder="Write your comment...">
												</form>
											</div><!-- /.reply -->
										</li>
									</ul>
								</div><!-- /.footer-timeline -->
								<!-- END FOOTER TIMELINE -->
							</div><!-- /.inner-content -->
						</li>
						<!-- END  ITEM HIGHLIGHT TIMELINE -->
						
						
						<!-- BEGIN ITEM TIMELINE -->
						<li class="item-timeline">
							<div class="buletan"></div>
							<div class="inner-content">
								<!-- BEGIN HEADING TIMELINE -->
								<div class="heading-timeline">
									<img src="assets/img/avatar/avatar-1.jpg" class="avatar" alt="Avatar">
									<div class="user-timeline-info">
										<p>
										Paris Hawker
										<small>10 hours ago</small></p>
									</div><!-- /.user-timeline-info -->
								</div><!-- /.heading-timeline -->
								<!-- END HEADING TIMELINE -->
								
								<p>
								Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica
								</p>
								
								<!-- BEGIN FOOTER TIMELINE -->
								<div class="footer-timeline">
									<ul class="timeline-option">
										<li class="option-row">
											<div class="row">
												<div class="col-xs-6">
													<ol>
														<li><a href="#fakelink">Like</a></li>
														<li><a href="#fakelink">Comment</a></li>
													</ol>
												</div><!-- /.col-xs-6 -->
												<div class="col-xs-6 text-right">
													<ol>
														<li><a href="#fakelink" data-toggle="tooltip" title="Harry Nichols and 253 other like this post"><i class="fa fa-thumbs-o-up"></i> 254</a></li>
													</ol>
												</div><!-- /.col-xs-6 -->
											</div><!-- /.row -->
										</li>
										<li class="option-row">
											<img src="assets/img/avatar/avatar-1.jpg" class="avatar" alt="Avatar">
											<div class="reply">
												<form role="form">
												<input type="text" class="form-control input-sm" placeholder="Write your comment...">
												</form>
											</div><!-- /.reply -->
										</li>
									</ul>
								</div><!-- /.footer-timeline -->
								<!-- END FOOTER TIMELINE -->
							</div><!-- /.inner-content -->
						</li>
						<!-- END ITEM TIMELINE -->
					
						<!-- BEGIN TIME CAT-->
						<li class="center-timeline-cat">
							<div class="inner">
							January 2014
							</div><!-- /.inner -->
						</li>
						<!-- BEGIN END CAT-->
					
						<!-- BEGIN TIME CAT-->
						<li class="center-timeline-cat">
							<div class="inner">
							December 2013
							</div><!-- /.inner -->
						</li>
						<!-- BEGIN END CAT-->
					
						<!-- BEGIN TIME CAT-->
						<li class="center-timeline-cat">
							<div class="inner">
							November 2013
							</div><!-- /.inner -->
						</li>
						<!-- BEGIN END CAT-->
					
						<!-- BEGIN HIGHLIGHT TIMELINE MOMENT -->
						<li class="item-timeline highlight text-center">
							<div class="buletan"></div>
							<div class="inner-content">
								<h2 class="text-primary"><i class="fa fa-flag-checkered"></i></h2>
								<h4>Joined Cleret Gombel</h4>
								<p class="text-muted">November 28, 2013</p>
							</div><!-- /.inner-content -->
						</li>
						<!-- END HIGHLIGHT TIMELINE MOMENT -->
					
						<!-- BEGIN HIGHLIGHT TIMELINE MOMENT -->
						<li class="item-timeline highlight text-center">
							<div class="buletan"></div>
							<div class="inner-content">
								<h2 class="text-primary"><i class="fa fa-male"></i></h2>
								<h4>Born</h4>
								<p class="text-muted">January 01, 1990</p>
							</div><!-- /.inner-content -->
						</li>
						<!-- END HIGHLIGHT TIMELINE MOMENT -->
					</ul>	
					<!-- END TIMELINE -->
