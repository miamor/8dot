function add() {
	$('a#add, .right[id^="q"] .vote').click(function() {
		var path = window.location.href;
			id = $(this).closest('.right').attr('id');
			page = path.split('#!')[1].split('?')[0];
			act = path.split('?')[1];
			href = $(this).attr('data-href');
			mLink = MAIN_URL + '/pages/' + page + '.php?' + act;
		$(this).html('<img src="' + IMG + '/loading.gif"/>');
		$.ajax({
			url: mLink + '&' + href,
			type: 'POST',
			datatype: 'json',
			success: function (data) {
				$("#" + id).load(mLink + " #" + id + " > span", function () {
					add(); //tipsy()
				})
			},
			error: function (xhr) {
				mtip('', 'error', 'Error: ', xhr.status)
			}
		})
	});
}
function cmtLib ($a) {
	solve();
//	$a = $(a);
	$a.find('a.vote, a.thank.vote-accepted-off').click(function() {
		var path = window.location.href;
			id = $(this).closest('.right').attr('id');
			page = path.split('#!')[1].split('?')[0];
			act = path.split('?')[1];
			href = $(this).attr('data-href');
			mLink = MAIN_URL + '/pages/' + page + '.php?' + act;
		$.ajax({
			url: mLink + '&' + href,
			type: 'POST',
			datatype: 'json',
			success: function (data) {
				$a.load(mLink + " .right-vote-ans#" + id + " > div", function () {
					alert('Load done' + $(this).attr('id'));
					cmtLib($(this)); //tipsy()
				})
			},
			error: function (xhr) {
				mtip('', 'error', 'Error: ', xhr.status)
			}
		})
	})
}

function solve() {
	$('a.thank.vote-accepted-off').click(function () {
		var r = confirm("This selection will close topic. Are you sure this quest is solved? Remember this cannot be undone.");
		if (r == true) {
			$.ajax({
				url: $(this).attr('href'),
				type: 'POST',
				datatype: 'json',
				success: function () {
					location.reload()
				}
			})
		}
	})
}

$(function () {
	add();
	$('.cmt_ans').each(function () {
		cmtLib($(this).find('.right-vote-ans'));
	})
})
