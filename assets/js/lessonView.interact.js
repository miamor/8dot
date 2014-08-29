$(function () {
	$('.maximize-iframe').click(function () {
		$('.lesson-content iframe').addClass('interact-lesson-iframe');
		$('.controlbar-interact-lesson').addClass('fixed-control')
		$(this).hide().prev('.minimize-iframe').show()
	});
	$('.minimize-iframe').click(function () {
		$('.lesson-content iframe').removeClass('interact-lesson-iframe');
		$('.controlbar-interact-lesson').removeClass('fixed-control')
		$(this).hide().next('.maximize-iframe').show()
	});
	$('.end-lesson').click(function () {
		$.ajax({
			url: MAIN_URL + '/pages/course.php?' + $(this).attr('href'),
			type: 'post',
			datatype: 'json',
			success: function (data) {
				location.reload()
			},
			error: function (xhr) {
				mtip('', 'error', '', 'Oops! Seems like something went wrong when ending a lesson. Please check out our <a>FAQ</a> page for quick fix or contact the administrators for full support.')
			}
		})
		return false
	});
})
