function eAction () {
	$('.button-remark-join, .button-remark-watch').click(function () {
		param = window.location.href.split('?')[1];
		clk = MAIN_URL + '/pages/event.php?'+param;
		ac = $(this).attr('class').split('button-remark-')[1];
		$.ajax({
			url: clk+'&do='+ac,
			type: 'POST',
			datatype: 'json',
			success: function (data) {
				$('.e-actions').load(clk + ' .e-actions > a', function () {
					eAction(); // tipsy()
				})
				$('ul.stats').load(clk + ' ul.stats > li')
				mtip('', 'success', '', 'Success!')
			},
			error: function (xhr) {
				mtip('', 'error', '', xhr+'. Please contact the administrators for help.</div>')
			}
		})
	})
}

$(function () {
	eAction();
	$('.notice-schedule label').not('.disabled').click(function () {
		param = window.location.href.split('?')[1];
		clk = MAIN_URL + '/pages/event.php?'+param;
		$.ajax({
			url: clk+'&do=noticeme',
			type: 'POST',
			datatype: 'json',
			success: function (data) {
				mtip('', 'success', '', 'Success!')
			},
			error: function (xhr) {
				mtip('', 'error', '', xhr+'. Please contact the administrators for help.</div>')
			}
		})
	});
});
