<? $apInfo = getRecord('app', "`id` = '$aii'") ?>
<form class="url-bar">
	<div class="app-reload"><img src="<? echo IMG ?>/b-refresh.png"/></div>
	<div class="app-url"><img src="<? echo IMG ?>/g-lock-16.png"> 8dot apps</div>
	<input class="url-input" type="text" value="<? echo $apInfo['code'] ?>" data-src="<? echo $apps['url'] ?>"/>
</form>
<div class="div-iframe-app">
	<? if (!$apInfo) echo '<div class="alerts alert-error">This app is not currently available. This could happen when the app :
		<ol>
			<li>Never exists</li>
			<li>Under construction</li>
			<li>Has been removed</li>
		</ol>
	You should contact the app developers or the administrators for supports.</div>';
	else echo '<iframe class="iframe-app" src="'.$apInfo['url'].'"></iframe>' ?>
</div> 
