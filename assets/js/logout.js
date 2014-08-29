$(function () {
	$('.logout-sure').click(function () {
		$.ajax({
			url: MAIN_URL + '/pages/logout.php?act=logout',
			type: "POST",
			datatype: 'json',
			success: function (data) {
				mtip('', 'success', '', 'Redirecting...');
				setTimeout(redirect(MAIN_URL), 1E3);
			},
			error: function (xhr) {
				mtip('', 'error', 'Error', xhr)
			}
		});
		return false
	})
})
