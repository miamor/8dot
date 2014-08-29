function addOneEx (ex) {
	$(ex).find('.addex-action > div').click(function () {
		c = $(this).closest('.addex-action').attr('data-course');
		l = $(this).closest('.addex-action').attr('data-lesson');
		e = $(this).closest('.addex-action').attr('data-ex');
		deadline = $('.deadline-hidden').val();
		id = $(this).attr('id');
		if (deadline) {
			if (id == 'difficult') path = MAIN_URL + '/pages/teacher/lesson.php?c='+c+'&l='+l+'&mode=addexercise&e='+e+'&difficult=yes&deadline='+deadline;
			else path = MAIN_URL + '/pages/teacher/lesson.php?c='+c+'&l='+l+'&mode=addexercise&e='+e+'&deadline='+deadline;
			if (id == 'mark-difficult') url = path + '&act=mark';
			else url = path + '&act=add';
			$.ajax({
				url: url,
				type: "POST",
				datatype: 'json',
				success: function (data) {
					$('add-ex-alert').html(data);
					$('#datepicker').attr('disabled', true);
					$('.public-action').load(path + ' .public-action > div', function () {
						publicTask()
					});
					$('.tab-index').each(function () {
						$(this).find('#ex'+e).load(path + ' #ex'+e+':eq(0) > div', function () {
							addOneEx(this)
						})
					})
				},
				error: function (xhr) {
					mtip('', 'error', xhr.status, 'Please try again or contact the administrators for help.')
				}
			})
		} else mtip('.add-ex-alert', 'error', '', 'No deadline found!')
	})
}

function publicTask () {
	$('.tooltip').remove();
	$('.public-task').click(function () {
		t = $(this).attr('id');
		path = MAIN_URL + '/pages/teacher/lesson.php?c='+c+'&l='+l+'&mode=addexercise&t='+t;
		$.ajax({
			url: path+'&act=public',
			type: "POST",
			datatype: 'json',
			success: function (data) {
				$('.public-action').load(path + ' .public-action > div', function () {
					publicTask()
				});
				$('.add-ex-tab').load(path + ' .add-ex-tab > div')
			},
			error: function (xhr) {
				mtip('', 'error', xhr.status, 'Please try again or contact the administrators for help.')
			}
		})
	})
}

$(function () {
	publicTask();
	$('.one-row').each(function () {
		addOneEx(this)
	})
});
