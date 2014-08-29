$(function () {
	$('.c-info-right').addClass('fixed-top').closest('.c-info-view').addClass('no-right');
	$('.c-info-view .alerts, h2.c-info-h3, .le-title').remove();
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
	$('.score-form').submit(function () {
		if (!$('.score-square input').val().length) mtip('.done-data', 'error', '', 'Please fill in a grade first.');
		else {
			action = $(this).attr('data-action');
			url = MAIN_URL + '/pages/course.php?' + action;
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
