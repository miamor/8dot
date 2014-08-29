invalid_array = ['exercise', 'quest', 'document'];
pagge = window.location.href.split('#!')[1].split('?')[0];

function rep(idtype, idcomment, uid) {
//	$('form#comments').attr('alt', idcomment);
//	$('.traloicua').html("Trả lời comment <b>#" + idcomment + "</b>")
//	$('#cancel,#comments').show();
//	$('#edits').hide()
	$('.rows.cmt.cmt' + idcomment).find('.add-comment-form').toggle(300)
}
function cancel() {
	$('form#comments').attr('alt', '0');
	$('.traloicua').html("");
	$('#cancel').hide()
}

function like() {
	$('a#like').click(function() {
//		var iid = window.location.href.split('i=')[1].split('&')[0];
		var cmt = $(this).attr('alt');
			fu = window.location.href.split('#!')[1].split('?')[0];
			v = window.location.href.split('?')[1].split('&do')[0];;
			path = MAIN_URL + '/pages/' + fu + '.php?' + v;
//			path = MAIN_URL + '/pages/item.php?i=' + iid + '&cmt=' + cmt;
			id = $(this).parents('.tool').attr('id');
		$(this).html('<img src="' + IMG + '/loading.gif"/>');
		$.ajax({
			url: path + '&cmt=' + cmt + '&act=like',
			type: 'POST',
			datatype: 'json',
			success: function () {
				$("#" + id).load(path + " #" + id + " > span", function () {
					like()
				})
			},
			error: function (xhr) {
				mtip('', 'error', 'Error: ', xhr.status)
			}
		});
		return false
	})
}

function mi_ajax() {
	cmtSubmit();
//	path = MAIN_URL + '/pages/' + window.location.href.split('#!')[1].split('&')[0].split('#comments')[0];
	ppa = window.location.href.split('#!')[1].split('&do')[0];
//	iid = window.location.href.split('c=')[1].split('&')[0];
	fu = window.location.href.split('#!')[1].split('?')[0];
	v = window.location.href.split('?')[1].split('&do')[0];;
	path = MAIN_URL + '/pages/' + fu + '.php?' + v;
	$("a#editcm").click(function() {
		$('#comments').hide();
		$("#edits").show().html('<img src="' + IMG + '/loadingIcon.gif" title="Loading...."/>');
		var cmt = $(this).attr('class');
			ttyp = $(this).attr('data-type');
		$.ajax({
			url: path + '&mode=edit&cmt=' + cmt,
			type: 'POST',
			datatype: 'json',
			success: function() {
				$("#edits").load(path + "&mode=edit&cmt=" + cmt + " #edit", function () {
					flatApp();
					$("#edit").fadeIn('5000'); sce();
					$("#edit").submit(function() {
						$("#coms").html('<img src="' + IMG + '/loading6.gif" title="Loading...."/>');
						formData = $(this).serialize();
						var cmi = $("#edit").attr('alt');
						$("#test").load(path + "&mode=edit&cmt=" + cmi + " #test", function () {
							$("#coms").html('<img src="' + IMG + '/loading6.gif" title="Loading...."/>');
							$('#textareas').val($('#textareas').val());
							$.ajax({
								url: path + "&mode=edit&cmt=" + cmt + "&act=do",
								type: 'POST',
								data: formData,
								datatype: 'json',
								success: function(data) {
									mtip('.comment-bod', 'success', '', 'Comment successfully sent.');
//									var link = $("#edit").attr("action").split('&do=')[0];
									$('#edit').remove();
									$('#coms,#edit,#comments').slideDown(500);
									$('#textarea').val('').next('.sceditor-container').find('iframe').contents().find('body').html('<p><br></p>');
									$(".tab-index.cmt").html('<img src="'+IMG+'/loading6.gif"/>').load(path + " .tab-index.cmt > span", function () {
										mi_ajax(); page_ajax(this);
									})
									if (window.location.href.indexOf('l=') > -1) {
										$(".tab-index.l-quest").html('<img src="'+IMG+'/loading6.gif"/>').load(path + " .tab-index.l-quest > span", function () {
											page_ajax(this);
										})
									}
								},
								error: function (xhr) {
									mtip('comment-bod', 'error', 'Error: ', xhr.status)
								}
							})
						});
						return false
					})
				})
			}
		});
		return false
	})
}

function page_ajax(a) {
	tab(); fLoad(); flatApp();
	if ($.inArray(pagge, invalid_array) >= 0) {
		$('.cmt_ans').each(function () {
			cmtLib($(this).find('.right-vote-ans'))
		})
	} else like();
	$(a).find('.pagination').find('a').not('.active a').click(function () {
		var url = $(this).attr('href');
			a = $(this).parents('.tab-index').attr('class').split('tab-index ')[1];
		if (url) {
			page = url.split('pages/')[1].split('.')[0];
			$(this).closest('.tab-index.'+a).html('<img src="' + IMG + '/loading6.gif"/>').load(url + ' .tab-index.'+a+' > span:eq(0)', function () {
				page_ajax(a); 
			});
		}
		return false
	})
}

function aja() {
	$("#comments").submit(function() {
		var c = $("#comments").attr('alt');
			clink = window.location.href;
			ttyp = $(this).attr('data-type');
			dataPage = clink.split('#!')[1].split('?')[0];
			dataAction = clink.split('?')[1].split('#')[0];
			dataPostType = $(this).attr('data-post-type');
			path = MAIN_URL + '/pages/' + dataPage + '.php?' + dataAction;
			$form = $(this);
		$(".cmt_num").html('<img src="' + IMG + '/loading.gif" title="Loading...."/>');
		$("#coms").html('<img src="' + IMG + '/loading6.gif" title="Loading...."/>');
		$("#test").load(path + " #test", function () {
			$("#coms").html('<img src="' + IMG + '/loading6.gif" title="Loading...."/>');
			formData = $form.serialize();
//			alert(formData);
			if (c == 0) postURL = path + '&type=' + dataPostType + '&do=comment';
			else postURL = path + '&cmt=' + c + '&type=' + dataPostType + '&do=comment';
				$.ajax({
					url: postURL,
					type: 'POST',
					data: formData,
					datatype: 'json',
					success: function (data) {
						$('#textarea').val('').next('.sceditor-container').find('iframe').contents().find('body').html('<p><br></p>');
						$(".tab-index.cmt").load(path + " .tab-index.cmt > span", function () {
							$(".cmt_num").load(path + " .cmt_num:eq(0) > span");
							mi_ajax(); page_ajax(this);
						});
						if (window.location.href.indexOf('l=') > -1) {
							$(".tab-index.l-quest").load(path + " .tab-index.l-quest > span", function () {
								$(".l-quest_num").load(path + " .l-quest_num:eq(0) > span");
								page_ajax(this);
							})
						}
					},
					error: function (xhr) {
						mtip('.comment-bod', 'error', 'Error: ', xhr.status)
					}
				})
		});
		return false
	})
}

function cmtSubmit () {
	$('.form-add-comment').submit(function () {
		var cmt = id = $(this).attr('alt');
			fu = window.location.href.split('#!')[1].split('?')[0];
			v = window.location.href.split('?')[1].split('&do')[0];;
			path = MAIN_URL + '/pages/' + fu + '.php?' + v;
			dataPostType = $(this).attr('dataPostType');
//			$form = $(this);
//			formData = $(this).serialize();
		$("#test").load(path + " #test", function () {
			formData = $('.form-add-comment[alt="' + cmt + '"]').serialize();
			$.ajax({
				url: path + '&cmt=' + cmt + '&type=' + dataPostType + '&do=comment',
				type: 'POST',
				data: formData,
				datatype: 'json',
				success: function () {
					$('.comt-child-list#child' + id).load(path + ' .comt-child-list#child' + id + ' > div').slideDown(300);
					$('.tool#cmti' + id + ' .toggle-comment').load(path + ' .tool#cmti' + id + ' .toggle-comment > span')
				},
				error: function (xhr) {
					mtip('', 'error', 'Error: ', xhr.status)
				}
			})
		});
		return false
	})
}

function selectCode(a) {
    var y = a.parentNode.parentNode.getElementsByTagName('OL')[0];
    if(window.getSelection) {
        var i = window.getSelection();
        if(i.setBaseAndExtent) {
            i.setBaseAndExtent(y, 0, y, y.innerText.length - 1)
        } else {
            if(window.opera && y.innerHTML.substring(y.innerHTML.length - 4) == '<BR>') {
                y.innerHTML = y.innerHTML + ' '
            }
            var r = document.createRange();
            r.selectNodeContents(e);
            i.removeAllRanges();
            i.addRange(r)
        }
    } else if(document.getSelection) {
        var i = document.getSelection();
        var r = document.createRange();
        r.selectNodeContents(e);
        i.removeAllRanges();
        i.addRange(r)
    } else if(document.selection) {
        var r = document.body.createTextRange();
        r.moveToElementText(y);
        r.select()
    }
}

function fLoad() {
/*	if ($('form#comments').attr('data-page') != 'quest' && $('form#comments').attr('data-page') != 'exercise') {
		var $cmt = $('.rows.cmt');
		for (var i=0, cmts = $cmt.length; i < cmts; i+=(cmts/2)) {
		    $cmt.slice(i, i+(cmts/2)).wrapAll('<div class="cmt-one-col"/>');
		}
		$('#comts .cmt-one-col:eq(0), .rows.cmt:has("code")').addClass('col-left');
		$('#comts .cmt-one-col:eq(1)').addClass('col-right');
	}
*/	$('.tool .toggle-comment').click(function () {
		$childComs = $(this).parents('.rows.cmt').find('.comt-child-list');
		$childComs.toggle(300);
	});
	$('.rows.cmt').each(function () {
		if ($(this).find('code').length) $(this).css('width', '100%')
	});
	fCode()
}

function fCode () {
	$('blockquote').prepend('<cite>Quote</cite>');
	$('code').wrap('<dl class="codebox contcode"><dd class="code-dd"></dd></dl>');
	$('.code-dd').before('<dt>Code <a onclick="selectCode(this); return false;" class="right"><font>Select All</font></a></dt>');
	if ($(".codebox.contcode dd").filter(function () {
		var a = $(this).text().indexOf("["),
		b = $(this).text().indexOf("]"),
		c = $(this).text().indexOf("[/"),
		d = $(this).text().indexOf("<"),
		e = $(this).text().indexOf('"'),
		f = $(this).text().indexOf("'"),
		g = $(this).text().indexOf("/");
		return a == -1 || b == -1 || c == -1 || a > b || b > c || d != -1 && d < a || e != -1 && e < a || f != -1 && f < a || g != -1 && g < a
	}).each(function () {
		$(this).wrapInner('<pre class="prettyprint' + ($(this).text().indexOf("<") == -1 && /[\s\S]+{[\s\S]+:[\s\S]+}/.test($(this).text()) ? " lang-css" : "") + ' linenums" />')
	}).length) {
		var s = document.createElement("script");
		s.type = "text/javascript";
		s.async = !0;
		s.src = JS + "/prettyprint.js";
		document.getElementsByTagName("head")[0].appendChild(s)
	}
//	codes = document.getElementsByTagName('code');
//	for (var i = 0, l = codes.length; i < l; i++) codes[i].innerHTML = '<ol class="wind"><li class="code">' + codes[i].innerHTML.split(/\<br\s?\/?\>/).join('</li><li class="code">') + '</li></ol>';
}

$(function () {
	like();
	aja();
	mi_ajax();
	fLoad();
	$('.ask-lesson').click(function () {
		$('form#comments').attr('data-post-type', 'quest').find('.alert-info').html('Add question');
	});
	$('.normal-cmt').click(function () {
		$('form#comments').attr('data-post-type', 'cmt').find('.alert-info').html('Add comment');
	});
});
