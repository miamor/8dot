function c_tab () {
	if (window.location.href.indexOf('&t=') <= -1) $('.c-info-one-tab.home').addClass('selected');
	else {
		var cType = window.location.href.split('&t=')[1].split('&')[0];
		if (!cType || cType == 'info') $('.c-info-one-tab.home').addClass('selected');
		else {
			if ($('.c-info-one-tab.' + cType).length) $('.c-info-one-tab.' + cType).addClass('selected');
		}
	}
}

function courseAction () {
	$('.button-remark-tickets').not('.disabled').click(function () {
		bo = $(this).attr('alt');
		$('.get-tick-board').show();
		param = window.location.href.split('?')[1];
		right_board('Get ticks', '', 'getTick.php?' + param, '60%');
	});
	$('.button-remark-join, .button-remark-star').click(function () {
		param = window.location.href.split('?')[1];
		clk = MAIN_URL + '/pages/course.php?'+param;
		ac = $(this).attr('class').split('button-remark-')[1];
		$.ajax({
			url: clk+'&'+ac+'=submit',
			type: 'POST',
			datatype: 'json',
			success: function (data) {
				$('.c-info-actions').load(clk + ' .c-info-actions > span', function () {
					courseAction(); // tipsy()
				})
				$('ul.stats').load(clk + ' ul.stats > li', function () {
					$(this).find('.sb-open').click(function () {
						id = $(this).attr('id');
						smallBoard($('.sb-'+id))
					});
				})
				mtip('', 'success', '', 'Success!')
			},
			error: function (xhr) {
				mtip('', 'error', '', xhr+'. Please contact the administrators for help.</div>')
			}
		})
	});
}

$(function () {
	courseAction();
	$('.notice-schedule label').not('.disabled').click(function () {
		param = window.location.href.split('?')[1];
		clk = MAIN_URL + '/pages/course.php?'+param;
		$.ajax({
			url: clk+'&do=noticeme',
			type: 'POST',
			datatype: 'json',
			success: function (data) {
/*				$('.notice-schedule').load(clk + ' .notice-schedule > label', function () {
					$('#notice-input').checkbox();
				})
*/				mtip('', 'success', '', 'Success!')
			},
			error: function (xhr) {
				mtip('', 'error', '', xhr+'. Please contact the administrators for help.</div>')
			}
		})
	});
	$('.small-thumbs').click(function () {
		var img = $(this).attr('src');
//		$(this).attr('src', IMG + '/loading.gif').attr('src', $('.active-thumbnai').attr('src'));
		$('.small-thumbs').removeClass('selected');
		$(this).addClass('selected');
		$('.active-thumbnai').attr('src', img)
	});
});
