$(function () {
	$('a.do-task').click(function () {
		t = $(this).attr('id');
		right_board('Complete tasks', '', 'task.php?t='+t, '82%');
	})
});
