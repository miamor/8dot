function submit_form_event () {
	$('form.form-new-contest').submit(function () {
		$form = $(this);
		$form.find('.step:last').find('.required').each(function() {
			check_valid(this);
			$(this).change(function () {
				check_valid(this)
			})
		});
		if (!$form.find('.invalid').not(':hidden .invalid').length) {
			$.ajax({
				url: MAIN_URL + '/pages/event.php?mode=new&act=submit',
				type: 'POST',
				data: $form.serialize(),
				datatype: 'json',
				success: function (data) {
					$form.find('.complete-bar-color').animate({
						'width' : '100%'
					}, 500, function () {
						$form.addClass('completed-form').find('.step-4-bar').removeClass('ongoing').addClass('completed');
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

function roundTime (rounds) {
	input = $('.con-starting input').length;
	tf = rounds - input;
	lastname = $('.con-starting input:last').attr('name');
	if (tf > 0) {
		for (i = input + 1; i <= rounds; i++) {
			$('.con-starting').append('<input type="text" name="con-start-'+i+'" class="datepicker-'+i+' con-start-'+i+'" placeholder="Round '+i+'"/>');
			$(".datepicker-"+i).datepicker({
				minDate: 0,
				dateFormat: 'dd-mm-yy',
				beforeShowDay: unavailable,
				onSelect: function(dateText, inst) {
					$(this).val(dateText);
				}
			});
		}
	} else if (tf < 0) $('.con-starting input').slice(tf).remove()
}

$(function () {
//	sce();
	$('.choose-type').click(function () {
		type = $(this).attr('class').split('choose-type ')[1].split(' ')[0];
		name = $(this).children('h3').text();
		$(this).closest('.choose-types').hide();
		$('.form-new-'+type).show().find('.step-1-bar').addClass('ongoing');
		$('input, select').not(':checkbox,:radio,:hidden').parent('dd').parent('dl').addClass('line-mar');
	});
	$('.form-new-contest, .form-new-normal-event').each(function () {
		$(this).find('.step, .type-display').not('#step-1').hide();
		step_settings(this)
	});
	$('.require-mark').click(function () {
		val = $(this).closest('dl').find('dt :checkbox').val();
		$(this).toggleClass('marked').closest('dl').find('dt :checkbox').checkbox('check');
		if ($(this).hasClass('marked')) $(this).closest('dl').find('dt :checkbox').val(val + '-require');
		else $(this).closest('dl').find('dt :checkbox').val(val);
	});
	$('.con-form-generate :checkbox').on('toggle', function () {
		if (!$(this).is(':checked')) $(this).closest('dl').find('.require-mark').removeClass('marked')
	});
	$('.confirm-con-form :radio').on('change', function () {
		if ($('.confirm-con-form :checked').val() == 'yes') $('.con-form-generate').slideDown();
		else $('.con-form-generate').slideUp()
	});
	submit_form_event();
	
	$('.trophy').click(function() {
		$('.trophy').not(this).removeClass('active').next().hide(200);
		$(this).next('.trophy-list').toggle(300, function () {
			if ($(this).is(':visible')) $(this).prev().addClass('active');
			else $(this).prev().removeClass('active');
		});
	});
	
	$('.con-rounds').change(function () {
		roundTime($(this).val())
	});
});
