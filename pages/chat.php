<?php include '../lib/config.php';
$uid = $_GET['u'];
$uInfo = getRecord('members', "`id` = '$uid' ");

if ($_GET['act'] == 'send') include 'system/chat.php';
else { ?>
<div class="chat-stick-one" data-u="<?php echo $uid ?>">
	<div class="simple-chat panel with-nav-tabs panel-primary" id="m_tab">
		<div class="chat-head panel-heading">
			<ul class="nav nav-tabs">
				<li class="chat-minimize"></li>
				<li class="tabs active" id="chat-tab"><a>Chat</a></li>
				<li class="tabs" id="profile-tab"><a><?php echo $uInfo['username'] ?></a></li>
<!--				<li class="tabs" id="about-tab"><a><span class="fa fa-question-circle"></span></a></li> -->
				<li class="right close-chat"><a>
					<span class="fa fa-times-circle-o"></span>
				</a></li>
				<li class="dropdown chat-drop-li right">
					<a class="dropdown-toggle">
						<span class="fa fa-cog"></span> <span class="caret"></span>
					</a>
					<ul class="dropdown-menu primary" role="menu">
						<li><a class="chat-video"><span class="fa fa-video-camera"></span> Video call</a></li>
						<li><a class="chat-add-friends"><span class="fa fa-users"></span> Add friends to chat</a></li>
						<li><a class="chat-poke"><span class="fa fa-"></span> Poke</a></li>
						<li class="divider"></li>
						<li><a class="chat-mute"><span class="fa fa-microphone-slash"></span> Mute</a></li>
					</ul>
				</li>
			</ul>
		</div>
		
		<div class="panel-body hide tab-indexs profile-tab">
			<div class="chat-profile-content">
				<img class="chat-uinfo-cover" src="<?php echo $uInfo['cover'] ?>"/>
				<img class="chat-uinfo-avatar" src="<?php echo $uInfo['avatar'] ?>"/>
			</div>
		</div>
		<div class="panel-body hide tab-indexs about-tab">
			<div class="chat-profile-content rows">
				<h3>About wChat <span class="fa fa-external-link-square"></span></h3>
				<p class="gensmall">wChat is simple chat integrating with bigbluebutton conference.<br/><b class="gensmall">Current version: Beta 0.1</b></p>
				<h4>Features <span class="fa fa-external-link-square"></span></h4>
				
			</div>
		</div>
		<div class="panel-body tab-indexs chat-tab">
			<div class="chat-content">
				<?php include 'views/chatContent.php' ?>
			</div>
			<form class="chat-submit" method="post" id="form<?php echo $uid ?>">
				<input type="text" name="chat-content-<?php echo $uid ?>" class="chat-text non-sce"/>
				<div class="chat-form-buttons">
					<div class="fa fa-smile-o"></div>
					<div class="fa fa-camera-retro"></div>
				</div>
			</form>
		</div>
	</div>
	<div class="chat-video-tab hide">
		<div class="close-chat-video"><span class="fa fa-times-circle-o"></span></div>
		<div class="chat-video-iframe">
			<ul class="bokeh">
				<li></li> <li></li> <li></li> <li></li> <li></li> 
			</ul>
		</div>
	</div>
</div>
<?php } ?>
