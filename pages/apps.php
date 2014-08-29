<? include '../lib/config.php';
$myApps = $getRecord -> GET('app_install', "`uid` = '$u' ") ?>

<div class="apps-wrap">
	<div class="apps-sidebar-left">
		<div class="apps-sidebar-head">
			<div class="the-box bg-primary no-border no-margin heading">
				<h1>8apps</h1>
			</div>
		</div>
		<div class="apps-sidebar-content">
			<h2>Installed</h2>
		</div>
	</div>

	<div class="apps-main" id="m_tab">
		<div class="apps-tab-head m_tab">
			<div class="tab active" id="app-list">Apps list</div>
			<div class="tab" id="app-installer">Apps installer</div>
<? foreach ($myApps as $mal) {
	$aii = $mal['iid'];
	$apInfo = getRecord('app', "`id` = '$aii'");
	echo '<div class="tab" id="app'.$aii.'">'.$apInfo['title'].'</div>';
} ?>
		</div>
		<div class="tab-indexs app-list">
			<form class="url-bar">
				<div class="app-reload"><img src="<? echo IMG ?>/b-refresh.png"/></div>
				<div class="app-url app-url-blue"><img src="<? echo IMG ?>/b-lock-16.png"> 8dot apps</div>
				<input class="url-input" type="text" value=""/>
			</form>
			<div class="div-iframe-app">
				<? include 'views/appList.php' ?>
			</div> 
		</div>
		<div class="hide tab-indexs app-installer">
			<? include 'views/appInstall.php' ?>
		</div>
<? foreach ($myApps as $maL) {
	$aii = $maL['iid']; ?>
		<div class="hide tab-one-app tab-indexs app<? echo $aii ?>">
			<? include 'views/appOne.php' ?>
		</div>
<? } ?>
	</div>
</div>

<script src="<? echo JS ?>/apps.js"></script>
<style>.form-group, .form-group input{height:55px!important}
/*.top-navbar:after{content:'';position:absolute;left:0;right:0;bottom:0;height:5px;background:#1ad9c0;z-index:0;cursor:pointer!important}
*/.top-navbar{border-bottom:5px solid #37BC9B}
.sidebar-right-heading{transition:.3s;-webkit-transition:.3s}</style>
