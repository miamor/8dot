$(function () {
	$('.c-info-right').addClass('fixed-top').closest('.c-info-view').addClass('no-right');
	$('.c-info-view > .alerts, h2.c-info-h3').remove();
	$('body').addClass('fixed');
	$('.task-quest').click(function () {
		id = $(this).closest('.one-task').attr('data-task');
		if ($('.task-do#task'+id).is(':hidden')) {
			$('.task-do, .one-task .ar-right').hide();
			$('.one-task').removeClass('selected');
			$(this).closest('.one-task').addClass('selected').find('.ar-right').show();
			$('.task-do#task'+id).show().removeClass('hide');
		}
	});

	$('.form-submit-task-ex').submit(function () {
		checkValid(this);
		t = $(this).closest('.form-submit-task').attr('data-task');
		e = $(this).attr('id');
		url = MAIN_URL + '/pages/task.php?t=' + t + '&e=' + e;
		formData = $(this).serialize();
//		alert(formData);
		if (!$(this).find('.invalid').length) {
			$.ajax({
				url: url + '&act=submit',
				type: 'POST',
				data: formData,
				datatype: 'json',
				success: function (data) {
					$('form.form-submit-task-ex#'+e).find('.quest-save').attr('disabled', '').closest('form').find('.done-data').html(data);
					$('.form-submit-task').find('.submit-button').load(url + ' .form-submit-task .submit-button > a', function () {
						$a = $(this).children('a');
						if (!$a.hasClass('dis')) {
							$a.removeClass('disabled');
							taskSubmit()
						}
					});
				},
				error: function (xhr) {
					$('form.form-submit-task-ex#'+e).find('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
				}
			});
		}
		return false
	}).each(function () {
		id = $(this).attr('id');
		$(this).find('.sceditor-container iframe').contents().find('body').bind("keyup keydown keypress", function(e) {
			$('.form-submit-task-ex#' + id).find('.quest-save').removeAttr('disabled');
		});
		$(this).find('input').on('change', function () {
			$(this).closest('.task-do').find('.quest-save').removeAttr('disabled');
		});
	});
});
