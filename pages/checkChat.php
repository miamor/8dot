<? include '../lib/config.php';
if ($_GET['read'] == 'read') {
	changeValue('members', "`id` = '$u' ", "`mes_new` = 0");
}
echo check_db('chat', "`to_uid` = '$u' ") ?>
