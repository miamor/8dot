$(function () {
	sce();

	$('.form-new-announce').submit(function () {
		checkValid(this);
		c = $(this).attr('data-course');
		if (!$(this).find('.invalid').length) {
			$.ajax({
				url: MAIN_URL + '/pages/teacher/announce.php?mode=new&c=' + c + '&act=submit',
				type: 'POST',
				data: $(".form-new-announce").serialize(),
				datatype: 'json',
				success: function (data) {
					$('form.form-new-announce').prev('.done-data').html(data)
				},
				error: function (xhr) {
					$('form.form-new-announce').prev('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
				}
			})
		}
		return false
	})
});
