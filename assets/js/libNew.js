$(function () {
	sce();
	
	$('.form-new-lib').not('#exercise').submit(function () {
		page = $(this).attr('id');
		checkValid(this);
		if (!$(this).find('.invalid').not(':hidden .invalid').length) {
			$.ajax({
				url: MAIN_URL + '/pages/' + page + '.php?mode=new&act=submit',
				type: 'POST',
				data: $(".form-new-lib#" + page).serialize(),
				datatype: 'json',
				success: function (data) {
					$('form.form-new-lib#' + page).find('.done-data').html(data)
				},
				error: function (xhr) {
					$('form.form-new-lib#' + page).find('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
				}
			})
		}
		return false
	})
})
