$(function () {
	$('.award-submit').submit(function () {
		$form = $(this);
		url = MAIN_URL + '/pages/event.php?' + $(this).attr('data-action');
		$.ajax({
			url: url + '&do=award',
			type: 'post',
			data: $form.serialize(),
			datatype: 'json',
			success: function (data) {
				location.reload()
			},
			error: function (xhr) {
				mtip('', 'error', '', 'Something went wrong. Please contact the administrator for help.');
			}
		});
		return false
	})
});
