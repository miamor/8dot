function scoreSubmit () {
	$('.quest-content').click(function () {
		if ($('.my-solution').not($(this).next('.my-solution')).is(':visible')) {
			$('.my-solution').slideUp(function () {
//				$(this).closest('.rows').removeAttr('style');
				$(this).prev('.quest-content').removeClass('bold').prev('.close-solution').hide();
			});
		}
		$(this).next('.my-solution').slideDown(function () {
//			$(this).closest('.rows').css('background', '#fcfcfc')
			$(this).prev('.quest-content').addClass('bold').prev('.close-solution').show()
		})
	});
	$('.close-solution').click(function () {
		$(this).hide().parent('.rows').children('.my-solution').slideUp().prev('.quest-content').removeClass('bold')
	});
}

$(function () {
	$('.c-info-right').addClass('fixed-top').closest('.c-info-view').addClass('no-right');
	scoreSubmit();
	$('.score-form').submit(function () {
		if (!$('.score-square input').val().length) mtip('.done-data', 'error', '', 'Please fill in a grade first.');
		else {
			action = $(this).attr('data-action');
			url = MAIN_URL + '/pages/event.php?' + action;
			$.ajax({
				url: url + '&do=grade&act=submit',
				type: 'POST',
				data: $(".score-form").serialize(),
				datatype: 'json',
				success: function (data) {
					$('.score-board .plain.score').load(url + ' .plain.score > div')
				},
				error: function (xhr) {
					$('.score-form').prev('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
				}
			})
		}
		return false
	})
});
