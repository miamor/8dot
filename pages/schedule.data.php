<?php include '../lib/config.php';
$getEvent = $getRecord -> GET('calendar', "`uid` = '$u'");
//$events = array();
foreach ($getEvent as $getEvent) {
	$eventsArray['id'] = $getEvent['id'];
	$eventsArray['title'] = $getEvent['title'];
	$eventsArray['start'] = $getEvent['start'];
	$eventsArray['end'] = $getEvent['end'];
	$eventsArray['allday'] = $getEvent['allday'];
	$eventsArray['color'] = $getEvent['bg'];
	$eventsArray['textColor'] = $getEvent['color'];
	$events[] = $eventsArray;
}
echo json_encode($events); ?>
