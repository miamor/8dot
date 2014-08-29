function likeOne(i) {
	$('a#like_' + i).click(function() {
		var fu = window.location.href.split('#!')[1].split('?')[0];
			v = window.location.href.split('?')[1].split('&do')[0];;
			path = MAIN_URL + '/pages/' + fu + '.php?' + v;
			act = $(this).attr('href');
//		alert(path + '&' + act);
		$(this).html('<img src="' + IMG + '/loading.gif"/>');
		$.ajax({
			url: path + '&' + act,
			type: 'POST',
			datatype: 'json',
			success: function () {
				$(".box-feed#" + i + " .num_line").html("<img src='" + IMG + "/ajaxload.gif' title='Loading...' style='margin-right:7px'/>");
				$(".box-feed#" + i + " .like-unlike").html("<img src='" + IMG + "/load1.gif' title='Loading...' style='margin-right:7px'/>");
				$('.box-feed#' + i + ' .like-unlike').load(path + ' .box-feed#' + i + ' .like-unlike > a', function () {
					likeOne(i)
				});
				$(".box-feed#" + i).find(".like_list").load(path + ' .box-feed#' + i + ' #likelist');
				$(".box-feed#" + i + " .nums").load(path + ' .box-feed#' + i + ' .nums > span');
			},
			error: function (xhr) {
				mtip('', 'error', 'Error: ', xhr.status)
			}
		});
		return false
	})
}

function cmtChild () {
	$('.cmt-form').submit(function () {
		id = $(this).attr('id');
		$form = $(this);
		textVal = $form.find('textarea').next('.sceditor-container').find('iframe').contents().find('body').html();
		formData = 'cmt-stt=' + textVal;
		clink = window.location.href;
		dataPage = clink.split('#!')[1].split('?')[0];
		dataAction = clink.split('?')[1].split('#')[0];
		path = MAIN_URL + '/pages/' + dataPage + '.php?' + dataAction;
		postURL = path + '&cmt=' + id + '&do=comment';
		$.ajax({
			url: postURL,
			type: 'POST',
			data: formData,
			datatype: 'json',
			success: function (data) {
				$form.find('textarea').val('').next('.sceditor-container').find('iframe').contents().find('body').html('<p><br></p>');
				$('.box-feed#' + id + ' .stt-cmt-list').load(path + ' .box-feed#' + id + ' .stt-cmt-list > div')
			},
			error: function (xhr) {
				mtip('.comment-bod', 'error', 'Error: ', xhr.status)
			}
		});
		return false
	})
}

$(function () {
	cmtChild();
	$('.statu.box-feed').each(function () {
		id = $(this).attr('id');
		likeOne(id);
	});
	$('#comments').submit(function () {
		$form = $(this);
		textVal = $form.find('textarea').next('.sceditor-container').find('iframe').contents().find('body').html();
		formData = 'comment=' + textVal;
		clink = window.location.href;
		dataPage = clink.split('#!')[1].split('?')[0];
		dataAction = clink.split('?')[1].split('#')[0];
		path = MAIN_URL + '/pages/' + dataPage + '.php?' + dataAction;
		postURL = path + '&do=comment';
		$.ajax({
			url: postURL,
			type: 'POST',
			data: formData,
			datatype: 'json',
			success: function (data) {
				$form.find('textarea').val('').next('.sceditor-container').find('iframe').contents().find('body').html('<p><br></p>');
				$('.course-feed').load(path + ' .course-feed > div', function () {
					sce();
					cmtChild()
				})
			},
			error: function (xhr) {
				mtip('.comment-bod', 'error', 'Error: ', xhr.status)
			}
		});
		return false
	});
})
