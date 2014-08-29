$(function () {
	sce();

	$('.form-new-lesson').submit(function () {
		checkValid(this);
		c = $(this).attr('data-course');
		if (!$(this).find('.invalid').not(':hidden .invalid').length) {
			$.ajax({
				url: MAIN_URL + '/pages/teacher/lesson.php?mode=new&c=' + c + '&act=submit',
				type: 'POST',
				data: $(".form-new-lesson").serialize(),
				datatype: 'json',
				success: function (data) {
					$('form.form-new-lesson').prev('.done-data').html(data)
				},
				error: function (xhr) {
					$('form.form-new-lesson').prev('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
				}
			})
		}
		return false
	})
})
