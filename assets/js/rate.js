function rate() {
	$('.rating-icons').not('.rated, .myrate').children('.rating-star-icon').hover(function () {
		a = $(this).attr('id').split('v')[1];
		for (i = 1; i <= a; i++) {
			$('.rating-star-icon.v'+i).css({
				'background-position' : '0 -32px'
			})
		}
	}).mouseout(function () {
		$('.rating-star-icon').css({
			'background-position' : '0 0'
		})
	}).click(function () {
		a = $(this).attr('id').split('v')[1];
		i = $(this).closest('.star-info').attr('data-course');
		if (i) {
			$.ajax({
				url: MAIN_URL + '/pages/course.php?c='+i+'&rate=' + a,
				type: "POST",
				datatype: 'json',
				success: function () {
					$('.star-info').load(MAIN_URL + '/pages/course.php?c='+i+' .rating-icons', function () {
						$('.tooltip').remove(); $(this).addClass('rated');
					})
				},
				error: function (xhr) {
					mtip('', 'error', xhr.status, 'Please try again or contact the administrators for help.')
				}
			})
		} else mtip('', 'error', '', 'Action failed.', 'Check your url again.')
	})
}

function vote () {
	$('#it-vote').not('.voted').children('.ld-button').click(function () {
		type = $(this).attr('id');
		i = window.location.href.split('c=')[1].split('&')[0];
		cl = $('#it-vote').attr('class');
		$.ajax({
			url: MAIN_URL + '/pages/course.php?c='+i+'&dos=' + type,
			type: "POST",
			datatype: 'json',
			success: function () {
//				if (cl == 'voted') $('#it-vote').removeClass('voted').load(MAIN_URL + '/pages/item.php?i='+i+' #it-vote > div');
//				else 
				$('#it-vote').addClass('voted').load(MAIN_URL + '/pages/course.php?c='+i+' #it-vote > div', function () {
					vote()
				});
				$('.item-bar.vote-bar').load(MAIN_URL + '/pages/course.php?c='+i+' .item-bar.vote-bar > div', function () {
					tipsy()
				})
			}
		})
	});
	$('#it-vote.voted').children('.vote-voted').click(function () {
		type = $(this).attr('id');
		i = window.location.href.split('c=')[1].split('&')[0];
		$.ajax({
			url: MAIN_URL + '/pages/course.php?c='+i+'&dos=' + type,
			type: "POST",
			datatype: 'json',
			success: function () {
				$('#it-vote').removeClass('voted').load(MAIN_URL + '/pages/course.php?c='+i+' #it-vote > div', function () {
					vote()
				});
				$('.item-bar.vote-bar').load(MAIN_URL + '/pages/course.php?c='+i+' .item-bar.vote-bar > div', function () {
					tipsy()
				})
			}
		})
	})
}

$(function () {
	vote();
	rate()
});
