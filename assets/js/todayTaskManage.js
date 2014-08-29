$(function () {
	$('.one-submitter .select-user').click(function () {
		u = $(this).closest('.one-submitter').attr('data-u');
		e = $(this).closest('.one-submitter').attr('data-e');
		$('.one-submitter').find('.ar-right').hide();
		$(this).closest('.one-submitter').find('.ar-right').show();
		$('.submission-detail').html('<ul class="bokeh"><li></li> <li></li> <li></li> <li></li> <li></li></ul>').load(MAIN_URL + '/pages/todayTask.php?e='+e+'&u='+u+' .submission-detail > span', function () {
			flatApp();
			$('.daily-task-manage-bar').submit(function () {
				formData = $(this).serialize();
				$.ajax({
					url: MAIN_URL + '/pages/todayTask.php?e='+e+'&u='+u+'&do=transfercoin',
					type: 'post',
					data: formData,
					datatype: 'json',
					success: function (data) {
						$('.submission-detail .daily-task-manage-bar').load(MAIN_URL + '/pages/todayTask.php?e='+e+'&u='+u+' .submission-detail .daily-task-manage-bar > span');
						$('.one-submitter#u'+u+' .check-transfer-coin').load(MAIN_URL + '/pages/todayTask.php?e='+e+'&u='+u+' .one-submitter#u'+u+' .check-transfer-coin > span')
					}
				});
				return false
			})
		})
	});
});
