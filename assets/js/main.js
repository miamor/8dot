var ASSETS = MAIN_URL + '/assets',
	IMG = ASSETS + '/img',
	CSS = ASSETS + '/css',
	JS = ASSETS + '/js',
	PLUGINS = ASSETS + '/plugins',
	path = window.location.href.split('#')[0];
// MAIN_URL is set in /jquery/jquery-1.7.2.js

jQuery.fx.interval = 50;

var duration = 5000;
var interval;

function redirect(location) {
	window.location.href = location;
}

$.fn.digits = function(){ 
    return this.each(function(){ 
        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ") ); 
    })
}

function checkChat () {
	setInterval(function () {
		$.ajax({
			url: MAIN_URL + '/pages/checkChat.php',
			type: 'post',
			datatype: 'json',
			success: function (data) {
				if (data != 0 && data != -1) {
					numChat = split('~', data)[1];
					$('.navbar-nav .chat-mes-count .icon-count').remove();
					$('.navbar-nav .chat-mes-count').prepend('<span class="badge badge-success icon-count">' + numChat + '</span>');
				} else $('.navbar-nav .chat-mes-count .icon-count').remove();
				if (data.indexOf('new') != -1) {
					alert('new');
				}
			}
		})
	}, 1000)
}

checkChat();

/*function fancyboxLoad () {
	$('img').each(function () {
		$(this).wrap('<a href="'+$(this).attr('src')+'" class="cboxElement"></a>').colorbox({
			rel : 'group4',
			transition : 'none',
			width : '75%',
			height : '75%',
			slideshow : true
		});
	});
	$(".colorbox-ajax").colorbox();
	$(".colorbox-youtube").colorbox({iframe:true, innerWidth:640, innerHeight:390});
	$(".colorbox-vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});
	$(".colorbox-iframe").colorbox({iframe:true, width:"80%", height:"80%"});
	$(".colorbox-inline").colorbox({inline:true, width:"50%"});
	$('.non-retina').colorbox({rel:'group5', transition:'none'})
	$('.retina').colorbox({rel:'group5', transition:'none', retinaImage:true, retinaUrl:true});
}
*/
function tab() {
//	tipsy();
	$('.tooltip').remove();
	$('.tab,.tabs').click(function () {
		var a = $(this).attr('id');
		$(this).closest('#m_tab').find('.tab-index,.tab-indexs').hide();
		$(this).closest('#m_tab').find('.' + a).show();
		$(this).closest('#m_tab').find('.tab,.tabs').removeClass('active');
		$(this).addClass('active')
	});
}
function pagination() {
	tab();
	$('.pagination').each(function () {
		$(this).find('a').click(function () {
			var url = $(this).attr('href');
				a = $(this).parents('.tab-index').attr('class').split('tab-index ')[1];
			if (url) {
				page = url.split('pages/')[1].split('.')[0];
				$(this).closest('.tab-index.'+a).html('<img src="' + IMG + '/loading6.gif"/>').load(url + ' .tab-index.'+a+' > span, .tab-index.'+a+' > div', function () {
					pagination();
					if (a == 'cmt') {
						fLoad();
						if (page == 'quest' || page == 'ex') cmtLib()
					}
				});
			}
			return false
		})
	})
}

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

function right_board (title, type, page, wi) {
//	var pa = page.split('.')[0];
	var pa = page;
	if (type == '' || !type) type = 'pages';
	else type = 'pages/' + type;
//	type = 'pages';
//	alert(MAIN_URL + '/' + type + '/' + page);
	$('body').addClass('fixed');
	if ($('div[data-link="' + pa + '"]').length) {
		$('.rb-fixed').show();
		$this = $('div[data-link="' + pa + '"]');
		zind = Number($this.children('.rb-container').css('z-index'));
		zm = zind - 1;
		zp = zind + 1;
		$('.right-board').not($this).children('.rb-container').each(function () {
			$(this).css('z-index', zm);
			$(this).addClass('unselected').removeClass('selected')
		});
		$this.find('.rb-container').removeClass('unselected isminimized').addClass('selected').animate({
			right : 0
		}, 1E3, function () {
//			rb_reload($(this));
			$(this).css('z-index' , zind);
			$(this).find('.rb-maximize').hide().prev('.rb-minimize').show();
		})
	} else {
		$('#wrapper').append('<div class="right-board" data-link="' + pa + '" data-type="' + type + '"><div class="rb-container" style="width:0"><div class="rb-control"><div class="rb-control-button rb-close" title="Close ' + title + '"></div><div class="rb-control-button rb-minimize" title="Minimize ' + title + '"></div><div class="rb-control-button rb-maximize hide" title="Maximize ' + title + '"></div><div class="rb-control-button rb-reload" title="Reload ' + title + ' content"></div></div><div class="rb-content"></div> <div class="wrapun"></div> </div></div>');
		$('.rb-fixed').show();
		$('body').addClass('fixed');
		$('div[data-link="' + pa + '"] .rb-container').animate({
			width : wi,
			right : 0
		}, 1E3, function () {
			zind = $(this).css('z-index');
			$('.rb-container').addClass('unselected').removeClass('selected').css({
				'z-index': zind - 1
			});
			$(this).removeClass('unselected').addClass('selected').css({
				'z-index' : zind
			})
		});
//		$pre = $('div[data-link="' + pa + '"]').prev('.right-board');
//		if ($pre.length) $('div[data-link="' + pa + '"]').find('.rb-control').css('top', $pre.find('.rb-control').offset().top + $pre.find('.rb-control').height() + 15);
		rbPosition();
		$.ajax({
			url: MAIN_URL + '/' + type + '/' + page,
			type: 'GET',
			success: function (page_data) {
				$thisBoard = $('div[data-link="' + pa + '"]');
				$thisBoard.find('.rb-content').html(page_data);
				flatApp(); pagination();
				formMiThing()
//				tipsy();
				rbControl(pa);
			},
			error: function (xhr) {
				mtip('rb-content', 'error', 'Error:', 'Something went wrong (' + xhr.status + '). Please try again or contact the administrators for more details.')
			}
		})
	}
}
function rbControl (alt) {
	$thisBoard = $('div[data-link="' + alt + '"]');
	pa = page = alt;
	$thisBoard.find('.rb-container').click(function () {
		zind = Number($(this).css('z-index'));
		zm = zind - 1;
		zp = zind + 1;
		$('.rb-container').not($(this)).each(function () {
			$(this).css('z-index', zm);
			$(this).addClass('unselected').removeClass('selected')
		});
		$(this).removeClass('unselected').addClass('selected').css({
			'z-index' : zind
		})
	});
	$thisBoard.find('.rb-reload').click(function () {
		rb_reload($(this).closest('.rb-container'))
	});
	$thisBoard.find('.rb-close').click(function () {
		var width = $(this).closest('.rb-container').width() - 3;
		$prev = $(this).closest('.right-board').prev('.right-board');
		$(this).closest('.rb-container').animate({
			right: "-=" + width
		}, 1E3, function () {
			$('.tooltip').remove();
			$(this).closest('.right-board').remove();
			rbPosition();
			$(this).find('.rb-minimize').hide().next('.rb-maximize').show();
			if (!$('div.rb-container[style*="right: 0"], div.rb-container[style*="right: -8px"]').length) {
				$('.rb-fixed').hide();
				$('body').removeClass('fixed');
			}
		});
//		if ($prev.length) $(this).closest('.rb-container').find('.rb-control').css('top', $prev.find('.rb-control').offset().top + $prev.find('.rb-control').height() + 15);
	});
	$thisBoard.find('.rb-minimize').click(function () {
		var width = $(this).closest('.rb-container').width() - 3;
		$(this).closest('.rb-container').animate({
			right : '-=' + width
		}, 1E3, function () {
			$(this).addClass('isminimized').find('.rb-minimize').hide().next('.rb-maximize').show();
			if (!$('div.rb-container[style*="right: 0"], div.rb-container[style*="right: -8px"]').length) {
				$('.rb-fixed').hide();
				$('body').removeClass('fixed')
			}
		});
	});
	$thisBoard.find('.rb-maximize').click(function () {
		$('.rb-fixed').show();
		$('body').addClass('fixed');
		$(this).closest('.rb-container').removeClass('isminimized').animate({
			right : 0
		}, 1E3, function () {
			$(this).find('.rb-maximize').hide().prev('.rb-minimize').show();
		})
	})
}
function rbPosition () {
	$('.right-board').each(function () {
		if ($(this).prev('.right-board').length) {
			to = Number($(this).prev('.right-board').find('.rb-control').offset().top);
			he = Number($(this).prev('.right-board').find('.rb-control').height());
			var topp = to + he + 10;
			$(this).find('.rb-control').css('margin-top', topp);
		} else $(this).find('.rb-control').css('margin-top', 5)
	});
}
function rb_reload($container) {
	$container.each(function () {
		$(this).find('.rb-content').html('Loading...');
		pas = $(this).closest('.right-board').attr('data-link');
		new_link = $(this).closest('.right-board').attr('data-link-new');
		if (!new_link) new_link = pas;
		type = $(this).closest('.right-board').attr('data-type');
		$(this).find('.rb-content').load(MAIN_URL + '/' + type + '/' + new_link, function () {
			flatApp(); pagination();
			formMiThing();
//			tipsy()
		})
	})
}

function leftBarContent (page) {
	if (page == 'fashion') $('.page-content').load(MAIN_URL + '?t=fashion .page-content li');
	else if (page == 'ushop') $('.page-content').load(MAIN_URL + '?t=ushop .page-content li');
	else if (page == 'mixxing') ;
	else if (page == 'des') ;
}

function isoo() {
	var $container = $('#isotope-wrap').isotope({
		itemSelector: '.element-item',
		masonry: {
			columnWidth: 1
		}
	});
}

/*function flatApp() {
	$('input[type="submit"], button, .button').not('[class*="btn-"]').addClass('btn btn-primary');
	$('input[type="reset"]').addClass('btn btn-default');
}*/

function getDot() {
	$('.one-line-dot').click(function () {
		d = $(this).attr('data-dot');
		url = MAIN_URL + '/pages/get-dot.php?d=' + d;
		$('.get-dot-board .dot-detail').slideUp(300, function () {
			$(this).html('Loading...').load(url + ' .get-dot-board .dot-detail > div', function () {
				$(this).slideDown(500)
			})
		});
	}).find('#dot-detail').click(function () {
		d = $(this).closest('.one-line-dot').attr('data-dot');
		smallBoard($('.sb-dot-detail'));
		$('.sb-dot-detail .sb-content').load(MAIN_URL + '/pages/get-dot.php?d=' + d + ' .dot-detail > div')
	});
/*	$('.one-dot-install.label-primary').mouseover(function () {
		$(this).removeClass('label-primary').addClass('label-danger').text('Uninstall')
	}).mouseout(function () {
		$(this).removeClass('label-danger').addClass('label-primary').text('Installed')
	});
	$('.one-dot-install.label-default').mouseover(function () {
		$(this).removeClass('label-default').addClass('label-primary')
	}).mouseout(function () {
		$(this).removeClass('label-primary').addClass('label-default')
	});
*/	$('.one-dot-install').click(function () {
		act = $(this).text();
		d = $(this).closest('.one-line-dot').attr('data-dot');
		url = MAIN_URL + '/pages/get-dot.php?d=' + d;
		$.ajax({
			url: url + '&act=' + act,
			type: 'POST',
			datatype: 'json',
			success: function (data) {
				$('.get-dot-board').html(data);
				$('#dotList .overflow').html('Loading...').load(MAIN_URL + '/pages/dotList.php .overflow > div', function () {
					getDot();
				});
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

function getTopic() {
	$('.one-topic-follow').click(function () {
		act = $(this).attr('alt');
		t = $(this).closest('.one-topic').attr('data-topic');
		url = MAIN_URL + '/pages/get-topic.php?t=' + t;
		$.ajax({
			url: url + '&act=' + act,
			type: 'POST',
			datatype: 'json',
			success: function (data) {
				$('#topicList .overflow').html('Loading...').load(url + ' .overflow > div', function () {
					getTopic()
				});
			},
			error: function (xhr) {
				$('.dot-note').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
			}
		})
	})
}

function smallBoard(a) {
	a.show().prev('.small-board-fixed').show();
	if (!a.has('.sb-close').length) {
		a.wrapInner('<div class="sb-content"></div>').children('.sb-content').hide();
		a.prepend('<ul class="bokeh"></ul>').children('.bokeh').prepend('<li></li> <li></li> <li></li> <li></li>');
		a.prepend('<div class="sb-close" title="Close">x</div>');
	} else {
		$('.sb-content').hide();
		$('.bokeh').show()
	}
	a.find('.sb-close').click(function () {
		a.hide().prev('.small-board-fixed').hide();
	});
	setTimeout(function () {
		a.children('.bokeh').hide();
		a.children('.sb-content').fadeIn(500);
	}, 1000)
}

var unavailableDates = ["08-07-2014", "28-05-2014"];
function unavailable (date) {
	dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
	if ($.inArray(dmy, unavailableDates) == -1) {
		return [true, ""];
	} else {
		return [false, "", "Unavailable"];
	}
}
function refreshScripts (file) {
//	tipsy();
//	fancyboxLoad();
	pagination(); flatApp();
//	getDot();
//	getTopic();
	$('.sb-open').click(function () {
		id = $(this).attr('id');
		smallBoard($('.sb-'+id))
	});
	page_title = $('#page-title').text();
	$('head').append('<title>'+page_title+'</title>');
// 	isoo();
//	leftBarContent(file);
	if (window.location.href.indexOf('l=') > -1) {
		c = Number(window.location.href.split('c=')[1].split('&')[0].split('#')[0]);
		l = Number(window.location.href.split('l=')[1].split('&')[0].split('#')[0]);
		$('.edit-lesson-li').show().find('.edit-lesson').click(function () {
			right_board('Edit lesson', 'teacher', 'lesson.php?c='+c+'&l='+l+'&mode=edit', '70%');
		});
		$('.add-exercise').click(function () {
			right_board('Add exercise', 'teacher', 'lesson.php?c='+c+'&l='+l+'&mode=addexercise', '70%');
		})
	} else $('.edit-lesson-li').hide();
	if (window.location.href.indexOf('a=') > -1) {
		c = Number(window.location.href.split('c=')[1].split('&')[0].split('#')[0]);
		a = Number(window.location.href.split('a=')[1].split('&')[0].split('#')[0]);
		$('.edit-announce-li').show().find('.edit-announce').click(function () {
			right_board('Edit announcement', 'teacher', 'announce.php?c='+c+'&a='+a+'&mode=edit', '70%');
		});
	} else $('.edit-announce-li').hide();
	if (window.location.href.indexOf('?c=') > 0) {
		c_tab();
		c = Number(window.location.href.split('c=')[1].split('&')[0].split('#')[0]);
		if ($('.manage-courses').length) {
			$('.manage-course').show();
		} else $('.manage-course').hide();
		$('.create-new-test').click(function () {
			right_board('Create a test', '', 'test.php?c='+c+'&mode=new', '70%');
		});
	} else {
		$('div[data-link*="lesson"], .manage-course .arrowDown, .manage-course .arrowUp').remove();
		if (!$('.right-board').length) $('.rb-fixed').hide()
		$('.manage-course').hide()
	}
	$('.right-board').each(function () {
		rb_reload($(this).children('.rb-container'))
	});
	cons = $('#right-container .right-one-content').length;
	$('#right-container').find('.right-one-content').css('height' , 95/cons + '%');
//	if ($('#right-container').length) $('#content-container').css('margin-right' , 254);
//	$('header').append('<script src="http://vjs.zencdn.net/4.3/video.js"></script>');
	$('.board-fix .close').not('.alerts .close, .alert .close').click(function () {
		$(this).closest('.board-fix').hide()
	});
	$('a[href^="#!login"]').click(function () {
		$('#login_board').show().find('.board-content').load(MAIN_URL + '/pages/login.php');
		return false
	});
	$('a[href^="#!logout"]').click(function () {
		$.ajax({
			url: MAIN_URL + '/pages/logout.php',
			type: "POST",
			datatype: 'json',
			success: function (data) {
				$('.sb-logout').html(data);
				smallBoard($('.sb-logout'));
			}
		});
		return false
	});
	$('.one-item-line').parents('.item-list').height($('.item-list .one-item-line').length * $('.item-list .one-item-line').height() + $('.m_tab').height());
	$('.button-remark').click(function () {
		id = $(this).attr('class').split('button-remark-')[1];
		if (id == 'comments') {
			if (!$('#edits').children('form#edit').length) $('#'+id).show()
		} else $('#'+id).toggle()
	});
	sce()
}

function scrollToContent (file, v) {
	if (v.length > 0) f_url = 'pages/' + file + '.php?' + v;
	else f_url = 'pages/' + file + '.php';
	$('body').addClass('fixed');
	$('#content').html('<div class="loading-screen"><ul class="bokeh"><li></li> <li></li> <li></li> <li></li> <li></li></ul></div>');
	$.ajax({
		url: MAIN_URL + '/' + f_url,
		type: 'GET',
		success: function (data) {
			setTimeout(function () {
				$('body').removeClass('fixed');
				$('#content').html(data).slideDown(100, function () {
					clearTimeout(interval);
//					setTimeout(function () {
						refreshScripts(file)
//					}, 200)
				})
			}, 100)
		},
		error: function (xhr) {
			setTimeout(function () {
				$('#content').html('This page does not exist or being under constructions or something\'s broken.');
//				redirect(MAIN_URL + '/404.php');
			}, 400)
/*			$.ajax({
				url: MAIN_URL + '/pages/404.php',
				type: 'GET',
				success: function (data) {
					setTimeout(function () {
						$('#content').html(data).slideDown(200, function () {
							clearTimeout(interval);
							setTimeout(function () {
								refreshScripts(file)
							}, 200)
						})
					}, 900)
				}
			})
*/		}
	})
}

function firstScroll () {
	if (window.location.href.indexOf('#!') > 0) {
		if (window.location.href.split('#!')[1].length) {
			lo = location.hash.replace('#!', '');
			if (window.location.href.indexOf('?') > 0) {
				scrollToContent(lo.split('?')[0], lo.split('?')[1])
			} else scrollToContent(lo, '')
		} else scrollToContent('feed', '')
	} else if (window.location.href == MAIN_URL + '/') scrollToContent('feed', '');
}

function alert_tip (content) {
	$('body').append('<div class="alert-tip">' + content + ' <div class="close-alert-tip"></div></div>')
}

function childUl ($a) {
//	alert($a.attr('class'));
	$a.children('ul').hide();
	$a.prepend('<span class="arrowDown"></span>');
	$a.children('a, span').click(function () {
		$bigLi = $(this).closest('li');
		$spanClass = $bigLi.children('span').attr('class');
		if ($spanClass.indexOf('showing') <= -1) {
			$bigLi.children('ul').show();
			$bigLi.children('span').addClass('arrowUp showing').removeClass('arrowDown')
		} else {
			$bigLi.children('ul').hide();
			$bigLi.children('span').removeClass('arrowUp showing').addClass('arrowDown')
		}
	})
}

function select_dot() {
	$('.dot').click(function () {
		dot = $(this).attr('alt');
		$('.dot').removeClass('dot-selected');
		$(this).addClass('dot-selected');
		$.ajax ({
			url: MAIN_URL + '/dot_session.php?dot=' + dot,
			type: 'POST',
			data: $(this).attr('alt'),
			success: function (data) {
				mtip('', 'info', '', 'Switch to dot ' + data);
				firstScroll()
			}
		})
	});
}

/*$(document).bind("contextmenu", function(event) {
	event.preventDefault();
	$("div.custom-menu").show().css({top: event.pageY + "px", left: event.pageX + "px"});
}).bind("click", function(event) {
	$("div.custom-menu").hide();
});
*/


function flatApp() {
//	$('.alerts, .alert').addClass('alert-square alert-bold-border');
	$('.tooltip').remove();
	$('.switch-cmt').click(function () {
		$('#edit, #comments').toggle()
	});
	$('input[type="submit"], button, .button').not('[class*="btn "]').addClass('btn btn-primary');
	$('input[type="reset"]').addClass('btn btn-default');
	$(':checkbox').not('[data-toggle="switch"], .onoffswitch-checkbox').checkbox();
	$(':radio').radio();
	$(".datepicker").datepicker({
		minDate: 0,
		dateFormat: 'dd-mm-yy',
		beforeShowDay: unavailable,
		onSelect: function(dateText, inst) {
			$(this).val(dateText);
			$(this).closest('.rb-content').find('.deadline-hidden').val(dateText);
		}
	});
	choosen();
	/** BEGIN TOOLTIP FUNCTION **/
	$('.tooltips').tooltip({
		selector: '*:not(".sceditor-dropdown img, #ui-datepicker-div a, #fancybox-buttons li a, #fancybox-buttons li, .fancybox-overlay li, .fancybox-overlay span, .fancybox-overlay div, .fancybox-overlay a")',
		container: "body"
	})
	/** BEGIN INPUT FILE **/
	if ($('.btn-file').length > 0){
		$(document).on('change', '.btn-file :file', function() {
				"use strict";
				var input = $(this),
				numFiles = input.get(0).files ? input.get(0).files.length : 1,
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect', [numFiles, label]);
		});
		$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
			var input = $(this).parents('.input-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;
			if( input.length ) {
				input.val(log);
			} else {
				if( log ) alert(log);
			}
		});
	}
	/** END INPUT FILE **/
}

function choosen() {
		"use strict";
		var configChosen = {
		  '.chosen-select'           : {},
		  '.chosen-select-deselect'  : {allow_single_deselect:true},
		  '.chosen-select-no-single' : {disable_search_threshold:10},
		  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		  '.chosen-select-width'     : {width:"100px"}
		}
		for (var selector in configChosen) {
			$(selector).chosen(configChosen[selector]);
		}
}

function animateExam () {
		if ($('.sidebar-left').hasClass('toggle') || $('.sidebar-left').hasClass('toggle-left')) {
			$('.mi-content.task-exam-do').animate({
				'left' : 0
			}, 200);
		} else {
			$('.mi-content.task-exam-do').animate({
				'left' : 220
			}, 100);
		}
		if ($('.sidebar-left').hasClass('toggle-left')) {
			$('.mi-content.task-exam-do').animate({
				'right' : 265
			}, 100);
		} else {
			$('.mi-content.task-exam-do').css({
				'right' : 15
			});
		}
}

function leftScroll () {
	/** SIDEBAR FUNCTION **/
	$('.sidebar-left ul.sidebar-menu li a').click(function() {
		"use strict";
		$('.sidebar-left li').removeClass('active');
		$(this).closest('li').addClass('active');	
		var checkElement = $(this).next();
			if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
				$(this).closest('li').removeClass('active');
				checkElement.slideUp('fast');
			}
			if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
				checkElement.slideUp('fast');
				checkElement.slideDown('fast');
			}
			if($(this).closest('li').find('ul').children().length == 0) {
				return true;
				} else {
				return false;	
			}
	});

	if ($(window).width() < 1025) {
		$(".sidebar-left").removeClass("sidebar-nicescroller");
		$(".sidebar-right").removeClass("sidebar-nicescroller");
		$(".nav-dropdown-content").removeClass("scroll-nav-dropdown");
	}
	
	/** BUTTON TOGGLE FUNCTION **/
	$(".btn-collapse-sidebar-left").click(function(){
		"use strict";
		$(".top-navbar").toggleClass("toggle");
		$(".sidebar-left").toggleClass("toggle");
		$(".page-content").toggleClass("toggle");
		$(".icon-dinamic").toggleClass("rotate-180");
		animateExam()
	});
	$(".btn-collapse-sidebar-right").click(function(){
		"use strict";
		$(".top-navbar").toggleClass("toggle-left");
		$(".sidebar-left").toggleClass("toggle-left");
		$(".sidebar-right").toggleClass("toggle-left");
		$(".page-content").toggleClass("toggle-left");
		animateExam()
	});
	$(".btn-collapse-nav").click(function(){
		"use strict";
		$(".icon-plus").toggleClass("rotate-45");
	});
	
	/** NICESCROLL AND SLIMSCROLL FUNCTION **/
	$(".sidebar-nicescroller").niceScroll({
		cursorcolor: "#121212",
		cursorborder: "0px solid #fff",
		cursorborderradius: "0px",
		cursorwidth: "0px"
	});
	$(".sidebar-nicescroller").getNiceScroll().resize();
	$(".right-sidebar-nicescroller").niceScroll({
		cursorcolor: "#111",
		cursorborder: "0px solid #fff",
		cursorborderradius: "0px",
		cursorwidth: "0px"
	});
	$(".right-sidebar-nicescroller").getNiceScroll().resize();
}

function rb_open () {
	$('.get-dot').click(function () {
		right_board('Get more dots', '', 'get-dot.php', '50%')
	});
	$('a.do-task').click(function () {
		t = $(this).attr('id');
		right_board('Complete tasks', '', 'task.php?t='+t, '82%');
	});
	$('.upload-game').click(function () {
		right_board('Upload your game', '', 'game.php?mode=new', '70%');
	});
	$('.manage-event-round').click(function () {
		i = window.location.href.split('i=')[1].split('&')[0];
		r = window.location.href.split('r=')[1].split('&')[0];
		right_board('Publish contest rounds', '', 'event.php?mode=edit&t=round&i='+i+'&r='+r+'', '70%');
	});
	$('.create-new-page').click(function () {
		right_board('Create a page', '', 'pageNew.php', '70%');
	});
	$('.create-new-course').click(function () {
		right_board('Create a course', 'teacher', 'courseNew.php', '70%');
	});
	$('.create-new-event').click(function () {
		right_board('Create an event', '', 'event.php?mode=new', '70%');
	});
	$('.create-new-quest').click(function () {
		right_board('Create a quest', '', 'quest.php?mode=new', '70%');
	});
	$('.create-new-exercise').click(function () {
		right_board('Create an exercise', '', 'exercise.php?mode=new', '80%');
	});
	$('.create-new-daily-ex').click(function () {
		right_board('Create a daily exercise', '', 'todayTask.php?mode=new', '80%');
	});
	$('.create-new-document').click(function () {
		right_board('Add a document', '', 'document.php?mode=new', '70%');
	});
	$('.create-new-lesson').click(function () {
		right_board('New lesson', 'teacher', 'lesson.php?mode=new&c=' + c, '70%');
	});
	$('.create-new-announcement').click(function () {
		right_board('New announcement', 'teacher', 'announce.php?mode=new&c=' + c, '70%');
	});
}

function chatPosition () {
	$('.chat-stick-one').each(function () {
		if ($(this).prev('.chat-stick-one').length) {
			ri = Number($(this).prev('.chat-stick-one').css('right').split('px')[0]);
			wi = Number($(this).prev('.chat-stick-one').width());
			right = ri + wi + 10;
			$(this).css('right', right);
		} else $(this).css('right', 20)
	});
}
function chatForm () {
	$('form.chat-submit').submit(function () {
		id = $(this).attr('id');
		uid = id.split('form')[1];
		$.ajax({
			url: MAIN_URL + '/pages/chat.php?u='+uid+'&act=send',
			type: 'POST',
			data: $('form.chat-submit#'+id).serialize(),
			datatype: 'json',
			success: function (data) {
				if (data && data != 'error') {
					$('.chat-content').html(data);
					$('.chat-submit#'+id+' input').val('');
				} else $('.chat-content').append('<div class="console error">Your message can\'t be sent.</div>');
			},
			error: function (xhr) {
				$('.chat-content').append('<div class="console error">Your message can\'t be sent.</div>');
			}
		});
		return false
	})
}
function chat (a) {
	chatPosition();
	tab();
	chatForm();
//	a.find('.chat-content').scrollTop = 15000;
	a.find('.chat-head .chat-minimize').click(function () {
		bottom = $(this).closest('.chat-stick-one').css('bottom');
		camTab = $(this).closest('.chat-stick-one').find('.chat-video-tab');
		sChat = $(this).closest('.chat-stick-one');
		if (bottom == '-255px') {
			$(this).closest('.chat-stick-one').animate({'bottom' : 0}, 300);
			if (camTab.attr('class').indexOf('open') > 0) {
				camTab.removeClass('open').show();
				sChat.addClass('webcam-chat');
			}
		} else {
			$(this).closest('.chat-stick-one').animate({'bottom' : -255}, 300);
			if (camTab.is(':visible')) {
				camTab.addClass('open').hide(400);
				sChat.removeClass('webcam-chat');
			}
		}
	});
	a.find('.chat-head li').not('.chat-minimize').click(function () {
		camTab = $(this).closest('.chat-stick-one').find('.chat-video-tab');
		sChat = $(this).closest('.chat-stick-one');
		$(this).closest('.chat-stick-one').animate({'bottom' : 0}, 300);
		if (camTab.attr('class').indexOf('open') > 0) {
			camTab.removeClass('open').show();
			sChat.addClass('webcam-chat');
		}
	});
	a.find('.close-chat a').click(function () {
		a = $(this).closest('.chat-stick-one');
		camTab = $(this).closest('.chat-stick-one').find('.chat-video-tab');
		if (camTab.is(':visible')) camTab.addClass('open').toggle(400);
		a.animate({
			'bottom' : -260
		}, 300, function () {
			a.remove()
			setTimeout("chatPosition()", 100);
		});
	});
	a.find('.dropdown-toggle').click(function () {
		var menu = $(this).next('.dropdown-menu');
		menu.toggle();
		if (menu.is(':visible')) $(this).closest('li.dropdown').addClass('open');
		else $(this).closest('li.dropdown').removeClass('open');
	});
	a.find('.chat-video').click(function () {
		camTab = $(this).closest('.chat-stick-one').find('.chat-video-tab');
		camTab.show();
		$(this).closest('.chat-stick-one').addClass('webcam-chat');
		$.ajax({
			url: MAIN_URL + '/pages/chatVideo.php?u=' + a.attr('data-u'),
			type: 'GET',
			datatype: 'json',
			success: function (data) {
				camTab.find('.chat-video-iframe').html('<iframe src="'+data+'" class="iframe-chat"></iframe>')
			},
			error: function (xhr) {
			}
		})
	});
	a.find('.close-chat-video').click(function () {
		camTab = $(this).closest('.chat-stick-one').find('.chat-video-tab');
		camTab.hide().find('.chat-video-iframe').html('<ul class="bokeh"><li></li> <li></li> <li></li> <li></li> <li></li></ul>');
		$(this).closest('.chat-stick-one').removeClass('webcam-chat')
	})
}


$(function () {
	select_dot();
	rb_open();
	leftScroll();
	firstScroll();

	$('.chat-mes-count').click(function () {
		$.ajax({
			url: MAIN_URL + '/pages/checkChat.php?read=read',
			type: 'post',
			datatype: 'json',
			success: function (data) {
				if (data != 0 && data != -1) {
					numChat = split('~', data)[1];
					$('.navbar-nav .chat-mes-count .icon-count').remove();
					$('.navbar-nav .chat-mes-count').prepend('<span class="badge badge-success icon-count">' + numChat + '</span>');
				} else $('.navbar-nav .chat-mes-count .icon-count').remove();
				if (data.indexOf('new') != -1) {
					alert('new');
				}
			}
		})
	});

	$('#online-user-sidebar li a').click(function () {
		uid = $(this).attr('id');
		$.ajax({
			url: MAIN_URL + '/pages/chat.php?u='+uid,
			type: 'GET',
			datatype: 'json',
			success: function (data) {
				if (!$('.chat-stick-one[data-u="'+uid+'"]').length) {
					$('.chat-stick').append(data);
					chat($('.chat-stick-one[data-u="'+uid+'"]'));
				} else $('.chat-stick-one[data-u="'+uid+'"]').animate({'bottom' : 0}, 300)
			},
			error: function (xhr) {
				mtip('', 'error', '', xhr+'. Please contact the administrators for help.')
			}
		});
	});

	$('a').live('click', function () {
	});
	$('#header .home').click(function () {
		scrollToContent('feed', '')
	});
	$('.notification-load').html('Loading....');
	$.ajax({
		url: MAIN_URL + '/pages/notification.php',
		type: 'GET',
		datatype: 'json',
		success: function (data) {
			$('.notification-load').html(data);
			$('.quote-stt').each(function () {
				qstt = $(this).text().substring(0, 60);
				$(this).text(qstt + '...')
			})
		},
		error: function (xhr) {
			mtip('', 'error', '', xhr+'. Please contact the administrators for help.')
		}
	});
/*	$('.notification-load').load(MAIN_URL + '/pages/notification.php li:lt(10)', function () {
		$('.quote-stt').each(function () {
			qstt = $(this).text().substring(0, 60);
			$(this).text(qstt + '...')
		})
	}) */
})

$(window).on('hashchange', function(e) {
	var origEvent = e.originalEvent
	newUrl = origEvent.newURL;
	if (newUrl.indexOf('#!') > -1) {
		file = newUrl.replace(MAIN_URL + '/#!', '');
		if (newUrl.indexOf('?') > 0) {
			file = file.split('?')[0];
			v = newUrl.split('?')[1];
			scrollToContent(file, v)
		} else scrollToContent(file, '')
	}
});
