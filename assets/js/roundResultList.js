function passCan (u) {
	$('.one-tsk-score#u' + u).find('.pass-candidate .pass-can').click(function () {
		param = window.location.href.split('?')[1];
		url = MAIN_URL + '/pages/event.php?' + param;
		$.ajax({
			url: url + '&u=' + u + '&do=pass',
			type: 'post',
			datatype: 'json',
			success: function (data) {
				$('.one-tsk-score#u' + u + ' .pass-candidate').load(url + ' .one-tsk-score#u' + u + ' .pass-candidate > div', function () {
					passCan(u)
				});
			},
			error: function (xhr) {
				mtip('', 'error', '', 'Something went wrong. Please contact the administrator for help.');
			}
		})
	});
}

$(function () {
	$('.pass-candidate').each(function () {
		u = $(this).attr('id');
		passCan(u)
	})
});
