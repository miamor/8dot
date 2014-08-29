$(function () {
	$('form#p_info').submit(function() {
		$('.required').each(function() {
			check_valid(this)
			$(this).change(function () {
				check_valid(this)
			})
		});
		if ($('.invalid').length) mtip('#p_info', 'error', '', 'Please fill in all required fields.');
		else {
			$.ajax({
				url: $("#p_info").attr("action"),
				type: $("#p_info").attr("method"),
				data: $("#p_info").serialize(),
				datatype: 'json',
				success: function (data) {
					$('form#p_info').html('<div class="alerts alert-success">Profile updated successfully. <a href="#!profile?t=info">Back to my profile setting</a></div>')
				},
				error: function (xhr) {
					$('form#p_info').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for more details. <a href="#!profile?t=info">Back to my profile setting</a></div>')
				}
			})
		}
		return false
	})
});