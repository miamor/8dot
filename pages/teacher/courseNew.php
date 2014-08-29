<?php include '../../lib/config.php';

if (!$dot || $dot == null || $dot == '') echo '<div class="alerts alert-error">Please select a dot before using these links.</div>';
else include 'views/courseNew.php';
?>

