$(function () {
	$('.c-info-right').addClass('fixed-top').closest('.c-info-view').addClass('no-right');
	$('.c-info-view > .alerts, .contest-problem > .alerts, h2.c-info-h3').remove();
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
});
