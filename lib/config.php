<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

define("DB_SERVER", "localhost:8080");
define("DB_USER", "root");
define("DB_PASS", "abc123");
define("DB_NAME", "bschool");
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

$dbName = DB_NAME;
$con = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
$db_select = mysql_select_db(DB_NAME, $con);

define('MAIN_PATH', '/var/lib/tomcat6/webapps/ROOT/8dot');
// define('HOST_URL', 'http://192.168.93.101');
define('HOST_NAME', 'localhost');
 define('HOST_URL', 'http://localhost:8080/8dot');
define('MAIN_URL', HOST_URL);
define('COMPILE_URL', 'http://localhost:8080/8dot');
define("CONFIG_SECURITY_SALT", "9b7fe5b4bb9fb52d9a625b483304521b");
define("CONFIG_SERVER_URL", 'http://192.168.93.100/');
define("CONFIG_SERVER_BASE_URL", CONFIG_SERVER_URL."bigbluebutton/");
define('LIB', MAIN_URL.'/lib');
define('ASSETS', MAIN_URL.'/assets');
define('CSS', ASSETS.'/css');
define('IMG', ASSETS.'/img');
define('silk', IMG.'/famfamfam/silk');
define('JS', ASSETS.'/js');
define('JQUERY', JS.'/jquery');
define('PLUGINS', ASSETS.'/plugins');
define(FLAT_UI, PLUGINS.'/flat-ui');
$serverUrl = $_SERVER['REQUEST_URI'];

require_once 'func.lib.php';
require_once MAIN_PATH.'/lib/bbb/includes/bbb-api.php';
$bbb = new BigBlueButton();
$itsAllGood = true;

$blacklist = array('.', '..');

$current = $time = date('d-m-Y H:i');
$today = date('d-m-Y');
$todayYMD = date('Y-m-d');
$todayl = date('l');
$todayD = date('D');
$todayd = (int)date('d');
$todaym = (int)date('m');
$todayY = (int)date('Y');
$now = date('dHis');
$nowFull = (int)date('YmdHis');
$nowMS = date('is');
$nowH = date('H');
$nowS = date('s');
$nowM = date('i');
$m_y = date('ym');
$month = date('ym');
/*$thisMonthDays = date('t-m-Y', strtotime($today));
echo $thisMonthDays.'~~~~~~~~';
$a_date = "2002-11-23";
echo date("Y-m-t", strtotime($a_date));
echo '~~~~';
echo cal_days_in_month(CAL_GREGORIAN, 2, 2014);
*/
$iid = _GET('i');
$t = _GET('t');
$r = _GET('r');
$d = _GET('d');
$c = _GET('c');
$a = _GET('a');
$l = _GET('l');
$q = _GET('q');
$p = _GET('p');
$e = _GET('e');
$uid = _GET('u');
$g = _GET('g');
$mode = _GET('mode');
$n = _GET('n');
$cmii = _GET('cmt');

	$dot = $_SESSION['dot'];
if (!$dot) $dot = 1;
	$dotInn = getRecord('dot', "`id` = '$dot'");
	$dot_title = $dotInn['title'];
	$pdotInn = getRecord('dot', "`id` = '{$dotInn['did']}'");
	$pdot = $pdotInn['id'];
	$pdot_title = $pdotInn['title'];
$childDot = array();
$dl = $getRecord -> GET('dot', "`did` = '$dot'", '', '');
foreach ($dl as $dl) array_push($childDot, $dl['id']);
$childDotStr = $childDot;
array_push($childDotStr, $dot);
$childDotStr = implode(',', $childDotStr);

// if (!$c || !$_SESSION['c']) unset($_SESSION['c']);

/* if (check($serverUrl, 'pages') > 0) {
	$reqMm = explode('pages/', $serverUrl);
	$reqMm = explode('.', $reqMm[1]);
	$reqm = $reqMm[0];
	if (check($reqMm[0], '/') > 0) {
		$reqMm = explode('/', $reqMm[0]);
		$reqm = $reqMm[1];
	}
//	echo $reqm;
	$pagMm = array('course', 'lessonNew', 'announceNew');
	if (!in_array($reqm, $pagMm)) unset($_SESSION['c']);
	else if ($c) $_SESSION['c'] = $c;
//	echo $_SESSION['c'];
} */

$vat = 0;

if ( $_SESSION['user_id'] ) {
	global $user_id, $u, $dot, $pdot;
	$user_id = $u = intval($_SESSION['user_id']);
	$member = getRecord('members', '`id` = '.$u);
	$type = $member['type'];
	$avatar = $member['avatar'];
	$username = $member['username'];
	$coins = $member['coin'];
	$rep = $member['reputation'];
	$myExp = round($rep/15000 * 100, 2);
	if ($myExp < 0) $myExp = 0;
	if ($myExp > 100) $myExp = 100;
	if ($myExp >= 90) 		{		$myLv = 'Expert';			$myLvClas = 'primary';		}
	else if ($myExp >= 80) 	{		$myLv = 'Pro';			$myLvClas = 'success';	}
	else if ($myExp >= 70) 	{		$myLv = 'High senior';		$myLvClas = 'info';		}
	else if ($myExp >= 60) 	{		$myLv = 'Senior';		$myLvClas = 'info';		}
	else if ($myExp < 60 && $myExp >= 20) {	$myLv = '+'.floor($myExp).' Member';	$myLvClas = 'warning';	}
	else if ($myExp >= 10) 	{		$myLv = 'Beginner';		$myLvClas = 'default';		}
	else 					{		$myLv = 'Elita';			$myLvClas = 'default';		}
	$m_stt = $member['online'];
	$mlevel = $member['level'];
	$mgroup = $member['group'];
	$slist = explode(',', $member['cart']);
	$stotalprice = 0;
	$frRequestNums = countRecord('friend', "`receive_id` = '$u' AND `accept` != 'yes'");
	$notiNums = countRecord('notification', "`read` != 'read' AND `to_uid` = '$u' ");
	$mesNums = $member['mes_new'];

	$followTopic = array();
	$mftp = $getRecord -> GET('topic_follow', "`uid` = '$u'", '', '');
	foreach ($mftp as $mftp) array_push($followTopic, $mftp['tid']);
} ?>
