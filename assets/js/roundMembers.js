function eMemAction () {
	$('.approve-mem').click(function () {
		id = $(this).closest('.one-can').attr('id');
		clk = MAIN_URL + '/pages/event.php' + $(this).attr('data-href') + '&t=members';
		$.ajax({
			url: clk + '&do=approve',
			type: 'POST',
			datatype: 'json',
			success: function (data) {
				$('.one-can#' + id).find('.action-mem').load(clk + ' .one-can#' + id + ' .action-mem > div', function () {
					eMemAction(); // tipsy()
				})
				mtip('', 'success', '', 'Success!')
			},
			error: function (xhr) {
				mtip('', 'error', '', xhr+'. Please contact the administrators for help.</div>')
			}
		})
	})
}

$(function () {
	eMemAction()
});
