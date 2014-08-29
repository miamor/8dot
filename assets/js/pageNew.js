function submit_form_page () {
	$('form.form-new-page').submit(function () {
		$form = $(this);
		exType = $form.find('input.page-type').val();
		var formData = new FormData($form[0]);
		$thisStep = $form.find('.step-2');
		checkValid($thisStep);
		var checkReturn = false;
		if (!$thisStep.find('.invalid').not(':hidden .invalid').length) {
			if ($thisStep.find('.c-topic').length) {
				if (!$thisStep.find('.c-topic :checked').length) checkReturn = false;
				else checkReturn = true;
			} else checkReturn = true;
		}
		if (checkReturn == true) {
			$.ajax({
				url: MAIN_URL + '/pages/page.php?mode=new&act=submit',
				type: 'POST',
				data: formData,
				datatype: 'json',
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
	$('.form-new-page').each(function () {
		step_settings(this);
		$(this).find('.step-1 .next-step').hide()
	});

	// Step 1
	$('.form-new-page .step-1 .choose-type').not('.disabled').click(function () {
		type = $(this).attr('class').split('choose-type ')[1];
		name = $(this).children('h3').text();
		$('.choose-type').removeClass('selected');
		$(this).addClass('selected');
		$('input.page-type').val(type);
		$(this).closest('.step-1').find('.next-step').show();
	});
	
	// Step 2
	$('.form-new-page .step-1 .next-step').click(function () {
		type = $('input.page-type').val();
		nums = $('.page-num_'+type).val();
//		$('.form-new-lib#exercise').find('.step-2').prepend(nums + ' ex');
		$('.form-new-page #'+type).removeClass('hide').show();
		$('.form-new-page #'+type).find('input, select').not(':checkbox,:radio').parent('dd').parent('dl').addClass('line-mar');
	});
	submit_form_page();
});
