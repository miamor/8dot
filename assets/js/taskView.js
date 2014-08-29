function leave(a) {
	var r = confirm('You are on your task. We\'ll open your link in new tab so your data will not lose.');
	if (r == true) window.open(a);
}

$(window).on('beforeunload', function () {
	if ($('.quest-save').not(':disabled').length)
		return 'Hey, we found some data which you haven\'t saved from your task. Leaving without saving it may cause loss of your work.';
});

function taskSubmit () {
	$('.task-submit').click(function () {
		t = $(this).closest('.form-submit-task').attr('data-task');
		url = MAIN_URL + '/pages/task.php?t=' + t;
		$.ajax({
			url: url + '&act=submit',
			type: 'POST',
			data: $(".form-submit-task").serialize(),
			datatype: 'json',
			success: function (data) {
				$('.form-submit-task').prev('.done-data').html(data);
				htip('.form-submit-task .done-data .alerts');
				$('.form-submit-task').find('.submit-button a').addClass('disabled')
			},
			error: function (xhr) {
				$('.form-submit-task').prev('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
			}
		});
		return false
	})
}


$(function () {
	sce();
	taskSubmit();
	$('.alert-box').each(function () {
		if ($(this).find('.alerts').length > 1) {
			$(this).find('.alerts').css({
				'width' : '46%',
				'margin-right' : 0
			})
		}
	});
	$('a[href]').each(function() {
		$(this).attr('onclick', 'leave("' + $(this).attr("href") + '"); return false');
	});
/*	$('.form-submit-task').each(function () {
		$(this).find('.one-task:eq(0)').addClass('selected').next('form.task-do').show()
	});
*/	$('.task-quest').click(function () {
		id = $(this).attr('data-task');
		if ($('.task-do#'+id).is(':hidden')) {
			$('.task-do').hide();
			$('.one-task').removeClass('selected');
			$('[data-task="'+id+'"]').closest('.one-task').addClass('selected');
			$('.task-do#'+id).show().removeClass('hide');
			$('.one-task .ar-right').hide();
			$('.one-task.'+id+' .ar-right').show()
/*			$('.task-do').slideUp(300, function () {
				setTimeout(function () {
					$('.one-task').removeClass('selected');
					$('[data-task="'+id+'"]').closest('.one-task').addClass('selected');
					$('.task-do#'+id).slideDown().removeClass('hide');
					$('.one-task .ar-right').hide();
					$('.one-task.'+id+' .ar-right').show()
				}, 200)
			}).addClass('hide');
*/		}
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
					setTimeout("htip('.done-data .alerts')", 2E3);
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
