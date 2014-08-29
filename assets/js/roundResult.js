$(function () {
	$('.submit-result').click(function () {
		url = MAIN_URL + '/pages/event.php?' + $(this).attr('data-href');
		$.ajax({
			url: url + '&do=submitresult',
			type: 'post',
			datatype: 'json',
			success: function (data) {
				location.reload();
				$('.exam-answer-sheet').load(url + '&do=submitresult  > form')
			},
			error: function (xhr) {
				mtip('', 'error', '', 'Something went wrong. Please contact the administrators for help.')
			}
		})
	})
});
