<? include '../lib/config.php' ?>

<div class="gmaker-wrapper">

<link rel="stylesheet" href="<? echo CSS ?>/gmaker.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">

<div id="m_tab">
	<div class="m_tab gmaker-main-tab">
		<div class="tabs active" id="gmaker-layouts-tab"><img src="<? echo silk ?>/layout.png"/> Layouts</div>
		<div class="tabs" id="gmaker-events-tab"><img src="<? echo silk ?>/controller.png"/> Event sheets</div>
		<div class="tabs" id="gmaker-source-tab"><img src="<? echo silk ?>/page_white_code.png"/> Source code</div>
	</div>
	<div class="tab-indexs gmaker-layouts-tab gmaker-main">
		<div class="gmaker-canvas">
			<div class="empty-canvas"></div>
		</div>
	</div>
	<div class="tab-indexs gmaker-events-tab gmaker-main hide">
		<div class="gmaker-event-sheets">
			<a class="new-evt right">New event sheet</a>
			<h2 style="margin-bottom:15px">Event sheets</h2>
			<div class="one-event">
				<div class="evt evt-condition">
					If <b>bullet</b> on collision with <b>enemies</b>
				</div>
				<div class="evt evt-action">
					<b>Destroy</b> enemies
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>

<div class="canvas-element-menu">
	<div class="behavior">Behavior</div>
	<div class="animation">Animation</div>
</div>

<div class="gmaker-board gmaker-board-behavior hide">
	<h2>Behavior</h2>
	<div class="left content">
		<a>Bullet</a>
		<a>Platform</a>
		<a>Solid</a>
	</div>
	<div class="right right-menu">
		<a class="add-to-canvas" id="sprite-1" data="<img src='<? echo IMG ?>/mail.png'/>">Sprite 1</a>
		<a class="add-to-canvas">Sprite 2</a>
		<a class="add-to-canvas">Sprite 3</a>
	</div>
</div>

<div class="gmaker-board gmaker-tool-board-1 hide">
	<h2>Add</h2>
	<div class="left content">
		<a id="sprites" class="selected">Sprites</a>
		<a id="quest">Quests</a>
	</div>
	<div class="right right-menu">
		<div class="menu-sprites selected">
			<a class="add-to-canvas" id="sprite-1"><img src='<? echo IMG ?>/8dot.png'/> 8dot</a>
			<a class="add-to-canvas"><img src='<? echo IMG ?>/8dot_1.png'/> 8dot_red</a>
			<a class="add-to-canvas"><img src='<? echo IMG ?>/8dot_2.png'/> 8dot_1</a>
		</div>
		<div class="menu-quest hide">
			<a class="add-to-canvas" id="sprite-1"><img src='<? echo IMG ?>/mail.png'/> Sprite 1</a>
			<a class="add-to-canvas">Sprite 2</a>
			<a class="add-to-canvas">Sprite 3</a>
		</div>
	</div>
</div>

<div class="gmaker-right-sidebar-corner">
	Right right side bar
</div>
<div class="gmaker-right-sidebar">
	Big right sidebar
</div>

</div>

<script src="<? echo JS ?>/gmaker.js"></script>
