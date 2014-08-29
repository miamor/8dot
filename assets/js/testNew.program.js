function submit_form_test_program () {
	$('form.form-new-test-program').submit(function () {
		$form = $(this);
		c = $form.attr('data-c');
		$form.find('.step:last').find('.required').not(':hidden .required').each(function() {
			check_valid(this);
			$(this).change(function () {
				check_valid(this)
			})
		});
		if (!$form.find('.invalid').not(':hidden .invalid').length) {
			var formData = new FormData($form[0]);
			$.ajax({
				url: MAIN_URL + '/pages/test.php?c='+c+'&mode=new&act=submit',
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
	$('.form-new-test-program').each(function () {
		$(this).find('.step, .type-display').not('#step-1').hide();
		step_settings(this)
	});
	submit_form_test_program()
});
