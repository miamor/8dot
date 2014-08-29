function getTopic() {
	$('.one-topic-follow').click(function () {
		act = $(this).text();
		t = $(this).closest('.one-topic').attr('data-topic');
		url = MAIN_URL + '/pages/get-topic.php?t=' + t;
		$.ajax({
			url: url + '&act=' + act,
			type: 'POST',
			datatype: 'json',
			success: function (data) {
				$('.get-dot-board').html(data);
				getTopic()
			},
			error: function (xhr) {
				$('.dot-note').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
			}
		})
	})
}

$(function () {
	getTopic()
})
