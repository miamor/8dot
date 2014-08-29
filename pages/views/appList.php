<div class="app-list">
<? $apList = $getRecord -> GET('app');
foreach ($apList as $apps) {
	$au = getRecord('members', "`id` = '{$apps['uid']}' "); ?>
<div class="one-app">
	<img class="one-app-thumb" src="<? echo $apps['thumbnai'] ?>"/>
	<div class="one-app-info">
		<div class="one-app-head">
			<a class="a-title bold a-info" id="<? echo $apps['id'] ?>" alt="<? echo $apps['code'] ?>"><? echo $apps['title'] ?></a>
			<? if ($apps['auth'] == 'yes') echo '<span class="right authed fa fa-check-circle text-primary" title="Authenticated"></span>' ?>
			<br/><span class="gensmall"><? echo $au['username'] ?></span>
		</div>
		<div class="app-button">
			<div class="app-run btn-square btn-sm btn-primary">Run</div>
	<? if (countRecord('app_install', "`uid` = '$u' AND `iid` = '{$apps['id']}' ") > 0)
		echo '<div class="app-install btn-square btn-sm btn-warning">Installed</div>';
	else echo '<div class="app-install btn-square btn-sm btn-success">Install</div>' ?>
		</div>
		<div class="shorten"><? echo $apps['des'] ?></div>
	</div>
</div>
<? } ?>
</div>
