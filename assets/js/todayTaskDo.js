function leave(a) {
	var r = confirm('You are on your task. We\'ll open your link in new tab so your data will not lose.');
	if (r == true) window.open(a);
}

$(window).on('beforeunload', function () {
	return 'You\'re working on a daily exercise. Leaving this will cause lost of your work.';
});

function todayTaskSubmit () {
	$('.form-submit-daily-task').submit(function () {
		t = $(this).attr('data-task');
		$form = $(this);
		url = MAIN_URL + '/pages/todayTask.php?e=' + t;
		$form.find('textarea').each(function () {
			val = $(this).next('.sceditor-container').find('iframe').contents().find('body').text();
			$(this).val(val);
		})
//		alert($form.serialize());
		$.ajax({
			url: url + '&act=submit',
			type: 'POST',
			data: $form.serialize(),
			datatype: 'json',
			success: function (data) {
//				$form.find('.done-data').html(data);
//				$form.find(':submit').attr('disabled', true)
				location.reload();
			},
			error: function (xhr) {
				$form.find('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
			}
		});
		return false
	})
}


$(function () {
//	sce();
	todayTaskSubmit();
	$('a[href]').each(function() {
		$(this).attr('onclick', 'leave("' + $(this).attr("href") + '"); return false')
	})
});
