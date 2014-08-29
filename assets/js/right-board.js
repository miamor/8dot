$(function () {
	$('.rb-minimize').click(function () {
		var width = $(this).closest('.rb-container').width();
		$(this).closest('.rb-container').animate({
			right : '-=' + width
		}, function () {
			$(this).find('.rb-minimize').hide().next('.rb-maximize').show();
			$(this).closest('.right-board').find('.rb-fixed').hide()
		})
	});
	$('.rb-maximize').click(function () {
		var width = $(this).closest('.rb-container').width();
		$(this).closest('.right-board').find('.rb-fixed').show();
		$(this).closest('.rb-container').animate({
			right : 0
		}, function () {
			$(this).find('.rb-maximize').hide().prev('.rb-minimize').show();
		})
	});
})
