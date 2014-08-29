<? $apInfo = getRecord('app', "`id` = '$iid'") ?>

<div class="one-app-info-heading">
	<div class="one-app-info-logo left">Logo</div>
	<div class="right app-action">
		<a class="app-install btn-lg btn-primary btn-perspective">Install</a>
	</div>
<!--	<img class="one-app-info-thumbnai left" src="<? echo $apInfo['thumbnai'] ?>"/> -->
	<h2><? echo $apInfo['title'] ?></h2>
	<span class="app-code gensmall"><? echo $apInfo['code'] ?></span>
</div>

<div class="app-detail">
	<img class="left app-thumb" src="<? echo $apInfo['thumbnai'] ?>"/>
	<div class="des"><? echo $apInfo['des'] ?></div>
</div>
