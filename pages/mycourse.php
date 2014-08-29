<?php include '../lib/config.php' ?>
<link href="assets/plugins/morris-chart/morris.min.css" rel="stylesheet">
<script src="assets/plugins/morris-chart/raphael.min.js"></script>
<script src="assets/plugins/morris-chart/morris.min.js"></script>
<script src="assets/js/myCourse.js"></script>

<div class="right preview-course">
	<div class="the-box">
		<h4 class="small-title">MORRIS LINE</h4>
		<div id="morris-line-example" style="height: 250px;width:500px"></div>
	</div><!-- .the-box -->
	<script>
Morris.Line({
  element: 'morris-line-example',
  data: [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 75,  b: 65 },
    { y: '2012', a: 100, b: 90 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Join', 'Views'],
//  resize: true,
  lineColors: ['#8CC152', '#F6BB42']
});
	</script>
</div>

<div id="m_tab" class="mycourse-list">
	<ul class="m_tab" style="margin-bottom:-1px">
		<li class="tab active" id="mine">Mine</li>
		<li class="tab" id="join">Watching</li>
		<li class="tab" id="star">Star</li>
		<li class="tab" id="trash">Trash</li>
	</ul>

	<div class="the-box no-padding tab-index mine">
<?php $condition = "`uid` = '$u'"; include 'views/myCourseTab.php' ?>
	</div>

	<div class="the-box no-padding hide tab-index trash">
<?php $condition = "`uid` = '$u' AND `trash` = 'yes'"; include 'views/myCourseTab.php' ?>
	</div>

	<div class="the-box no-padding hide tab-index join">
<?php $tbll = 'course_join'; $roww = 'cid'; include 'views/myCourseTab1.php'; ?>
	</div>

	<div class="the-box no-padding hide tab-index star">
<?php $tbll = 'course_star'; $roww = 'iid'; include 'views/myCourseTab1.php'; ?>
	</div>
</div>

<div style="clear:both"></div>
