function loadTab ($element, title, url) {
	$element.find('.url-input').val(title);
	$element.find('.div-iframe-app').html('<ul class="bokeh" style="margin-top:20%"><li></li> <li></li> <li></li> <li></li> <li></li></ul>');
	$.ajax({
		url: url,
		type: 'get',
		datatype: 'json',
		success: function (data) {
			setTimeout(function () {
				$element.find('.div-iframe-app').html(data);
			}, 300)
		},
		error: function (xhr) {
			mtip('', 'error', 'Error: ', xhr.status)
		}
	})
}

$(function () {
	$('iframe').each(function () {
//		alert($(this).attr('class'));
//		alert($(this).contents().find("div").html());
		$(this).contents().find('a').append("I'm in an iframe!");
	});
	$('body').addClass('fixed');
	$('.sidebar-left').addClass('toggle');
	$('.btn-collapse-sidebar-left i').addClass('rotate-180');
	$('.top-navbar, .sidebar-right-heading').css({
		'top' : '-55px'
	});
	$('.sidebar-right-heading, .top-navbar, .top-navbar div, .top-navbar a, .top-navbar span, .top-navbar i, .top-navbar form, .top-navbar input').click(function () {
		$('.top-navbar, .sidebar-right-heading').css({
			'top' : '0'
		});
	});
	$('.apps-wrap').click(function () {
		$('.top-navbar, .sidebar-right-heading').css({
			'top' : '-55px'
		});
		if (!$('.sidebar-left').hasClass('toggle')) $('.sidebar-left').addClass('toggle')
		if ($('.sidebar-right').hasClass('toggle-left')) $('.sidebar-right').removeClass('toggle-left')
	});
	$('.one-app-head .a-info').click(function () {
		id = $(this).attr('id');
		tit = $(this).attr('alt');
		$tab = $(this).closest('.tab-indexs');
		loadTab($tab, tit, MAIN_URL + '/pages/appInfo.php?i=' + id)
	});
	$('.app-reload').click(function () {
		$a = $(this).closest('.tab-indexs');
		iframe = $a.find('.div-iframe-app .iframe-app');
		iframe.attr('src', iframe.attr('src'));
	});
})
