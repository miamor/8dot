function mtip(a, c, title, content) {
	$(".alert").length && $(".alert").remove();
	if (a && a.length) $(a).prepend('<div class="alerts alert-' + c + ' just-add"><a class="close" onclick="htip(\'just-add\')" data-dismiss="alert">\u00d7</a><strong>' + title + " </strong>" + content + "</div>");
	else $('body').append('<div class="alert alert-' + c + ' just-add"><a class="close" onclick="htip(\'just-add\')" data-dismiss="alert">\u00d7</a><strong>' + title + " </strong>" + content + "</div>");
	stip('just-add')
}
function htip(a) {
	var l = $('.' + a).attr('class');
	if (l.indexOf('alerts') > -1) {
		$("." + a).slideUp(function () {
			$("." + a).remove()
		})
	} else {
		$(".alert").animate({
			right: "-=500"
		}, 1E3, function () {
			$(".alert").remove()
		})
	}
}
function stip(d) {
    $("." + d).fadeIn(1E3);
    setTimeout("htip('" + d + "')", 5E3)
}

function redirect(location) {
	window.location.href = location;
}

$(function () {
	$('#login').submit(function () {
		$.ajax({
			url: MAIN_URL + '/pages/login.php?act=login',
			type: "POST",
			data: $("#login").serialize(),
			datatype: 'json',
			success: function (data) {
				mtip('', 'success', '', 'Redirecting...');
//				redirect(MAIN_URL);
				setTimeout(redirect(MAIN_URL), 1E3);
			},
			error: function (xhr) {
				mtip('', 'error', 'Error', xhr)
			}
		});
		return false
	})
})
