function submit_form () {
	$('form.form-new-course').submit(function () {
		$form = $(this);
		$thisStep = $form.find('.step-3');
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
				url: MAIN_URL + '/pages/teacher/courseNew.php?act=submit',
				type: 'POST',
				data: $form.serialize(),
				datatype: 'json',
				success: function (data) {
					$form.find('.complete-bar-color').animate({
						'width' : '100%'
					}, 500, function () {
						$form.addClass('completed-form').find('.step-3-bar').removeClass('ongoing').addClass('completed');
					});
					$form.find('.step-3').removeClass('active').hide('slide', {direction: 'left'}, 500, function () {
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

function time(a) {
	$('.'+a+' [name="c-hour"], .'+a+' [name="c-minute"]').change(function () {
		hour = $('.'+a+' .c-hour').val();
		if ((hour != 0 && hour < 10 && hour.indexOf('0') <= -1) || hour == 0) $('.'+a+' .c-hour').val('0' + hour);
		$('.'+a+' .c-time').val($('.'+a+' .c-hour').val() + ':' + $('.'+a+' .c-minute').val())
	});
}

function cPriceType() {
	$('.c-price :radio').on('toggle', function() {
		if ($(this).val() == 'one-price') $('.price-course').show().find('input').addClass('required');
		else $('.price-course').hide().find('.c-price').removeClass('required invalid')
	});
	$('.c-price-normal :radio').on('toggle', function() {
		if ($(this).val() == 'one-price') $('.price-course-normal').show().find('input').addClass('required');
		else $('.price-course-normal').hide().find('.c-price-normal').removeClass('required invalid')
	});
}

$(function () {
	$('.form-new-course').each(function () {
		$(this).find('.c-settings dd').each(function () {
			$(this).find('.radio:last').after('<div style="clear:both"></div>');
		});
		step_settings(this);
		$(this).find('.step-1 .next-step').hide()
	});

	// Step 1
	$('.step-1 .choose-type').not('.disabled').click(function () {
		type = $(this).attr('class').split('choose-type ')[1].split(' ')[0];
		name = $(this).children('h3').text();
		$('.choose-type').removeClass('selected');
		$(this).addClass('selected');
		$('.step-1-info i').html('You chose <b class="type-chosen">' + name + '</b>');
		$('input.c-type').val(type);
		$('.step-1 .next-step').show();
		if (type == 'interact') $('.for-interact').removeClass('hide').show();
		else $('.for-interact').addClass('hide').hide();
	});

	// Step 2
	$('.step-2 .next-step').show();
	cPriceType();
	$('.c-pay :radio').on('toggle', function() {
		$('.c-priice').show()
		if ($(this).val() == 'by-lesson') {
			$('.by-lesson').show();
			$('.by-course').hide().find('.c-price, .c-price-normal').removeClass('required invalid').closest('dl').removeClass('line-mar');
			$('#one-price, #one-price-normal').radio('check');
			$('.price-course, .price-course-normal').show().find('.c-price, .c-price-normal').addClass('required')
		} else {
			$('.by-lesson').hide();
			$('.by-course').show().find('.c-price, .c-price-normal').addClass('required invalid').closest('dl').addClass('line-mar');
			$('.price-course, .price-course-normal').hide().find('.c-price, .c-price-normal').removeClass('required invalid')
		}
	});
	$('.c-time-choose :radio').on('toggle', function() {
		if ($(this).val() == 'one-time') {
			$('.time-course .one-time').show().find('input').addClass('required');
			$('.time-course .day-time').hide().find('input').removeClass('required invalid')
		} else {
			$('.time-course .one-time').hide().find('input').removeClass('required invalid');
			$('.time-course .day-time').show().find('input').addClass('required')
		}
	});
	$('.privacy :radio').on('toggle', function() {
		if ($(this).val() == 'exclude' || $(this).val() == 'include') {
			$('.public-list-div').show().find('select').addClass('required');
		} else {
			$('.public-list-div').hide().find('select').removeClass('required invalid');
		}
	});
	$('.c-duration-ty :radio').on('toggle', function() {
		if ($(this).val() == 'one-du') {
			$('.course-during').show().find('input').addClass('required');
		} else {
			$('.course-during').hide().find('input').removeClass('required invalid');
		}
	});

	function changeDay(a) {
		days = $(a).val();
		Day = $(a).children(':selected').text();
		$('.time-course .day-time').html('');
		for (i = 0; i < days.length; i++) {
			$('.time-course .day-time').append('<div class="time-for-one-day time-for-' + days[i] + '"><input type="hidden" name="c-time-' + days[i] + '" class="c-time" value="20:00"/><input type="number" name="c-hour-' + days[i] + '" class="c-hour" min="00" max="23"/> : <select name="c-minute-' + days[i] + '" class="c-minute"><option value="00" selected>00</option><option value="30">30</option></select> <i style="color:#a1a9b3">// Set time for ' + days[i] + '</i></div>');
			time('time-for-' + days[i]);
		}
//		$('.time-for-one-day select').selectpicker({style: 'btn-default', menuStyle: 'dropdown-default'});
	}
	changeDay('.c-day');
	$('.c-day').change(function () {
		changeDay(this);
	});

	time('one-time');
	n = 3;
	$('.addbox').click(function() {
		n++;
		var id = $(this).parents('.all-thumbnais').find('.thums').attr('id');
		$(this).parents('.all-thumbnais').find('.thums').append('<input type="text" class="more-thumb thumb'+n+'" name="thumb'+id+n+'" id="thumb'+id+n+'" placeholder="Thumbnai '+n+'">');
	});

	// Step 3
//	$('.step-3 .next-step').show()
	submit_form();
});
