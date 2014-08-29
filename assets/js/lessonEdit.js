$(function () {
	sce();

	$('.form-edit-lesson').submit(function () {
		checkValid(this);
		c = $(this).attr('data-course');
		l = $(this).attr('data-lesson');
		if (!$(this).find('.invalid').not(':hidden .invalid').length) {
			$.ajax({
				url: MAIN_URL + '/pages/teacher/lesson.php?c=' + c + '&l=' + l + '&mode=edit&act=submit',
				type: 'POST',
				data: $(".form-edit-lesson").serialize(),
				datatype: 'json',
				success: function (data) {
					$('form.form-edit-lesson').prev('.done-data').html(data)
				},
				error: function (xhr) {
					$('form.form-edit-lesson').prev('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
				}
			})
		}
		return false
	})
})
