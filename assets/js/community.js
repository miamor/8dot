main = $(window);

function startUpload() {
    return true
}
function stopUpload(success) {
    var result = '';
    link = window.location.href;
    if (success == 1) {
        result = '<span class="msg">The file was uploaded successfully!<\/span><br/><br/>';
    } else {
        result = '<span class="emsg">There was an error during file upload!<\/span><br/><br/>';
    }
    $("#statuss").html('<img src="' + IMG + '/loading6.gif"/>');
    $(".loading").show();
    $("#statuss").load(link + " #statuss", function () {
        $(".loading").hide();
        $("#test").html('');
        $("#update_stt, #stt_photo").val('');
    });
    return true
}

function ajaxLoadsS() {
    $('#stt_photo').live('change', function () {
        var img = $(this).val();
        $("#test").html('Loading...');
        $("#test").html(img)
    })
}

function showS() {
	$(".statuss .nums").click(function () {
		$(this).parents("#tool").next('.like_list').children('#likelist').toggle()
	})
}

function showM(a) {
	$(a+" .nums").click(function () {
//		$(this).parents("#tool").next('.like_list').children('#likelist').toggle()
	})
}

function ajaxS() {
	ajaxSCmt();
	$('.statu').each(function () {
		ajaxSLike($(this).attr('id'));
		ajaxSLikeCmt($(this).attr('id'))
	})
}

function cmtStt() {
}

function ajaxSCmt() {
	$('.cmt-form').submit(function () {
		p = $(this).attr('id');
		content = $(this).find('iframe').contents().find("body").html();
		url = MAIN_URL + '/pages/feed.php?p=' + p + '&do=cmt';
		$.ajax({
			url: url,
			type: 'POST',
			data: 'cmt-stt-' + p + '=' + content,
			datatype: 'json',
			success: function () {
				$('.statu#' + p).find('.stt-cmt-list').load(MAIN_URL + "/pages/feed.php?note=undividepage .statu#" + p + " .stt-cmt-list > div", function () {
					$('.cmt-form#' + i).find('iframe').contents().find("body").html('');
					ajaxSLikeCmt(p);
				})
			}
		});
		return false
	})
}

function showLikeList (i) {
	$(".statu#"+i+" .nums, .cmt-tool#p"+i+" .like-num").click(function () {
		$.ajax({
			url: MAIN_URL + '/pages/feed.php?id=' + i + '&display=like',
			type: "POST",
			datatype: 'json',
			success: function (data) {
				$('.sb-stt-likelist').html(data);
				smallBoard($('.sb-stt-likelist'))
			}
		})
	})
}

function ajaxSLike(i) {
//	$('.tooltip').remove();
	showLikeList(i);
	$(".statu#" + i).find('.like_list').each(function () {
		$(this).find('.a:last + .commo').remove()
	});
	$(".statu#" + i).find(".like-unlike a").click(function () {
		var p = $(this).attr('id');
		i = p.split('_')[1];
		ty = p.split('_')[0];
		u = $(this).attr('alt');
		url = MAIN_URL + '/pages/feed.php' + $(this).attr('href');
		$.ajax({
			url: url,
			type: 'POST',
			datatype: 'json',
			success: function () {
//				$('.tooltip').remove();
				if (ty == 'like' || ty == 'unlike') {
					$(".statu#" + i + " .num_line").html("<img src='" + IMG + "/ajaxload.gif' title='Loading...' style='margin-right:7px'/>");
					$(".statu#" + i + " .like-unlike").html("<img src='" + IMG + "/load1.gif' title='Loading...' style='margin-right:7px'/>");
					$(".statu#" + i + " .like-unlike").load(MAIN_URL + "/pages/feed.php?note=undividepage #" + i + " .like-unlike > a", function () {
						ajaxSLike(i)
					});
					$(".statu#" + i).find(".like_list").load(MAIN_URL + "/pages/feed.php?note=undividepage #" + i + " #likelist");
				}
				$("#" + i + " .nums").load(MAIN_URL + "/pages/feed.php #" + i + " .nums > span");
			}
		});
		return false
	});
}

function ajaxSLikeCmtOne (i) {
	showLikeList(i);
	$('.cmt-tool#p' + i + ' .like').click(function () {
		var p = $(this).attr('id');
		ty = p.split('_')[0];
		u = $(this).attr('alt');
		url = MAIN_URL + '/pages/feed.php' + $(this).attr('href');
		$.ajax({
			url: url,
			type: 'POST',
			datatype: 'json',
			success: function () {
				$(".cmt-tool#p" + i).load(MAIN_URL + "/pages/feed.php?note=undividepage .cmt-tool#p" + i + " > span", function () {
					ajaxSLikeCmtOne(i)
				})
			}
		});
		return false
	})
}

function ajaxSLikeCmt (i) {
	$('.statu#' + i).find('.one-cmt-stt .cmt-tool').each(function () {
		ajaxSLikeCmtOne($(this).attr('alt'));
	})
}

function all() {
	ajaxS();
	sce();
	flatApp();
//	showS();
	if (window.location.href.indexOf('undividepage') == -1) loadmore(0);
}

function loadmore(i) {
    main.scroll(function () {
		var scrollBottom = $('.following').height() - main.scrollTop() - 400;
		if (scrollBottom <= 10) {
			var page = $('.pagination .page').length;
			if (!$('#more #load-more'+i).length) $('#more').append('<div class="load-more load-more'+i+'" style="display:none" id="load-more'+i+'"></div>');
			link = $('.pagination .page:eq('+i+')').attr('href');
			$('#load-more'+i+':hidden').html('<center>Loading... <img class="loading-status" src="'+IMG+'/alw_loading.png"/></center>');
			$('#load-more'+i+':hidden').load(link + ' .statuss .statu', function () {
				$('#load-more'+i).find('.no-toolbar').sceditor({
					toolbar: '',
					emoticons: emoticonsList
				});
				$('#load-more'+i).find('.cmt-form input').addClass('right btn btn-primary');
//				showM('#load-more'+i);
				ajaxS();
				if (i < page) {
					i++;
					loadmore(i)
				}
			});
			if ($('#load-more'+i).find('.loading-status').length) {
				$('#load-more'+i).html('<div class="statu follow">No more data to show.</div>')
			}
			$('#load-more'+i+':hidden').fadeIn(800)
        }
    });
}

$(function () {
	all();
	pagination();

	$(".head b a").click(function () {
		$(".head b a").css('color', '#058030');
		$(this).css('color', '#444');
	});

	$('#submitstt').submit(function (e) {
		var type = $(this).attr('data-type');
//		alert(type);
		$('#test').load(MAIN_URL + '/pages/feed.php #test', function () {
			var formData = new FormData($('#submitstt')[0]);
//			alert($('#submitstt').serialize());
			if (window.FormData !== undefined) {
				$.ajax({
					url: MAIN_URL + '/pages/feed.php?type='+type+'&do=submitstt',
					type: 'POST',
					data: formData,
					mimeType: "multipart/form-data",
					contentType: false,
					cache: false,
					processData: false,
					success: function (data, textStatus, jqXHR) {
						$('.following').load(MAIN_URL + '/pages/feed.php .following > div', function () {
							all();
							$('#update_stt').val('');
							var control = $("#stt_photo");
							control.replaceWith( control = control.clone( true ) );
						});
					},
					error: function (xhr) {
						$('#submitstt').before('<div class="alerts alert-error">Your message can\'t be sent.</div>');
					}
				});
			}
		});
		return false
	})
});
