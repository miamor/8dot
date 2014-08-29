<div id="m_tab" class="exercises">
	<ul class="m_tab">
		<li class="tab active" id="todaytsk">Today tasks <span class="label label-primary"><? echo countRecord('daily_ex', "`day` = '$today' AND `did` IN ($childDotStr) ") ?></span></li>
		<li class="tab" id="others">Others <span class="label label-warning"><? echo countRecord('daily_ex', "`day` != '$today' AND `did` IN ($childDotStr) ") ?></span></li>
	</ul>
	<div class="tab-index todaytsk">
		<? $condition = "`day` = '$today' "; include 'todayTaskTab.php' ?>
	</div>
	<div class="hide tab-index others">
		<? $condition = "`day` != '$today' "; include 'todayTaskTab.php' ?>
	</div>
</div>
