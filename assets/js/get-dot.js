function getDots() {
	$('.one-line-dot').click(function () {
		d = $(this).attr('data-dot');
		url = MAIN_URL + '/pages/get-dot.php?d=' + d;
		$('.get-dot-board .dot-detail').slideUp(300, function () {
			$(this).html('Loading...').load(url + ' .get-dot-board .dot-detail > div', function () {
				$(this).slideDown(500)
			})
		});
	});
	$('.one-dot-install').click(function () {
		act = $(this).text();
		d = $(this).closest('.one-line-dot').attr('data-dot');
		url = MAIN_URL + '/pages/get-dot.php?d=' + d;
		$.ajax({
			url: url + '&act=' + act,
			type: 'POST',
			datatype: 'json',
			success: function (data) {
				$('.get-dot-board').html(data);
				getDots();
				$('.top-navbar #dots').load(MAIN_URL + ' .top-navbar #dots > div', function () {
					select_dot()
				})
			},
			error: function (xhr) {
				$('.dot-note').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
			}
		})
	})
}

$(function () {
	getDots()
})
