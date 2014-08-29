<div id="m_tab" class="exercises">
	<ul class="m_tab">
		<li class="tab active" id="alltask"><?php if ($typ == 'ex') echo 'Exercise storage'; else if ($typ == 'quest') echo 'Quest lib'; else echo 'Pdf lib' ?></li>
	</ul>
	<div class="tab-index alltask">
		<?php include 'libTab.php' ?>
	</div>
</div>
