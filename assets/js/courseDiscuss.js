function cmtLib () {
	$('.right[id^="cmt"] .vote').click(function() {
		var path = window.location.href;
			id = $(this).closest('.right').attr('id');
			page = path.split('#!')[1].split('?')[0];
			act = path.split('?')[1];
			href = $(this).attr('data-href');
			dact = href.split('act=')[1];
			mLink = MAIN_URL + '/pages/' + page + '.php?' + act;
		$.ajax({
			url: mLink + '&' + href,
			type: 'POST',
			datatype: 'json',
			success: function (data) {
				$(".one-discuss-vote#"+id).load(mLink + " .one-discuss-vote#"+id+" > div", function () {
					cmtLib(); //tipsy()
				})
			},
			error: function (xhr) {
				mtip('', 'error', 'Error: ', xhr.status)
			}
		})
	})
}

function cmtSubmit () {
	$('.form-add-comment').submit(function () {
		var cmt = $(this).attr('alt');
			fu = window.location.href.split('#!')[1].split('?')[0];
			v = window.location.href.split('?')[1].split('&do')[0];;
			path = MAIN_URL + '/pages/' + fu + '.php?' + v;
		$(this).before('<img class="loading-img" src="' + IMG + '/loading.gif"/>');
		$.ajax({
			url: path + '&id=' + cmt + '&do=comment',
			type: 'POST',
			data: $('.form-add-comment[alt="' + cmt + '"]').serialize(),
			datatype: 'json',
			success: function () {
//				alert($('.form-add-comment[alt="' + cmt + '"]').serialize() + '~~~' + path + '&id=' + cmt + '&do=comment');
				$('.one-discuss#' + cmt + ' .one-discuss-comment-list').load(path + ' .one-discuss#' + id + ' .one-discuss-comment-list > div', function () {
					like();
					$('.loading-img').remove(300)
				})
			},
			error: function (xhr) {
				mtip('', 'error', 'Error: ', xhr.status)
			}
		});
		return false
	})
}

$(function () {
	sce();
	cmtLib();
	cmtSubmit();
	
	$('.add-comment').click(function () {
		$(this).closest('.one-discuss').find('.add-comment-form').toggle(300)
	});
	
	$('.toggle-comment').click(function () {
		$(this).closest('.one-discuss').find('.one-discuss-comment-list').toggle(300)
	});
	
	$('.add-discuss').submit(function () {
		param = window.location.href.split('?')[1];
		clk = MAIN_URL + '/pages/course.php?'+param;
		$.ajax({
			url: clk+'&do=adddis',
			type: 'POST',
			data: $('.add-discuss').serialize(),
			datatype: 'json',
			success: function (data) {
				$('.discuss-board').load(clk + ' .discuss-board > div', function () {
					mtip('.discuss-board', 'success', '', 'Success!');
				});
			},
			error: function (xhr) {
				mtip('', 'error', '', xhr+'. Please contact the administrators for help.</div>')
			}
		});
		return false
	})
});
