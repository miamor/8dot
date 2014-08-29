function submit_form_round () {
	i = window.location.href.split('i=')[1].split('&')[0];
	r = window.location.href.split('r=')[1].split('&')[0];
	$('form.form-new-round').submit(function () {
		$form = $(this);
		$form.find('.step:last').find('.required').not(':hidden .required').each(function() {
			check_valid(this);
			$(this).change(function () {
				check_valid(this)
			})
		});
		if (!$form.find('.invalid').not(':hidden .invalid').length) {
			var formData = new FormData($form[0]);
			$.ajax({
				url: MAIN_URL + '/pages/event.php?mode=edit&t=round&i='+i+'&r='+r+'&act=submit',
				type: 'POST',
				data: formData,
				mimeType: "multipart/form-data",
				contentType: false,
				cache: false,
				processData: false,
				success: function (data) {
					$form.find('.complete-bar-color').animate({
						'width' : '100%'
					}, 500, function () {
						$form.addClass('completed-form').find('.step-2-bar').removeClass('ongoing').addClass('completed');
					});
					$form.find('.step:last').removeClass('active').hide('slide', {direction: 'left'}, 500, function () {
						$form.find('.completed-print').addClass('active').show().find('.done-data').html(data);
						$form.find('.complete-des').show()
					});
				},
				error: function (xhr) {
					$form.find('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
				}
			})
		}
		return false
	})
}

$(function () {
	$('.form-new-round').each(function () {
		$(this).find('.step, .type-display').not('#step-1').hide();
		step_settings(this)
	});
	$('[name*="public_time_hour"], [name*="public_time_minute"]').on('change', function () {
		val = $(this).val();
		if (val < 10 && val != 0 && val.indexOf('0') == -1) val = '0' + val;
		else if (val == 0) val = '00';
		$(this).val(val);
	});
	submit_form_round();
});
