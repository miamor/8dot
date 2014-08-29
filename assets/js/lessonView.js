$(function () {
	$('.notepad').submit(function () {
		param = window.location.href.split('?')[1];
		clk = MAIN_URL + '/pages/course.php?'+param;
		$.ajax({
			url: clk+'&do=addnote',
			type: 'POST',
			data: $('.notepad').serialize(),
			datatype: 'json',
			success: function (data) {
				mtip('', 'success', '', 'Note saved!')
			},
			error: function (xhr) {
				mtip('', 'error', '', xhr+'. Please contact the administrators for help.</div>')
			}
		});
		return false
	})
});
