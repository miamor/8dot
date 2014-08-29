function canvasElement (element) {
	element.draggable().bind("contextmenu", function (event) {
		event.preventDefault();
		$("div.canvas-element-menu").attr('id', element.attr('id')).show().css({top: event.pageY - 60 + "px", left: event.pageX - 250 + "px"});
	}).children('img').resizable();
}
$(document).bind("click", function (event) {
	$("div.canvas-element-menu").hide();
})

$(function () {
	$('.menu-sprites a').each(function () {
		data = $(this).find('img').attr('src');
		$(this).attr('data', '<img src="' + data + '"/>')
	});
	$('.gmaker-board .content > a').click(function () {
		id = $(this).attr('id');
		$('.gmaker-board .content > a').removeClass('selected');
		$(this).addClass('selected');
		$('.right-menu > div').hide();
		$(this).closest('.gmaker-board').find('.menu-' + id).show().addClass('selected');
	});
	$('.canvas-element-menu > div').click(function () {
		i = $(this).parent().attr('id');
		b = $(this).attr('class');
		$('.gmaker-board-'+b).attr('id', i).show()
	});
	$('.gmaker-canvas, .gmaker-board').draggable().resizable();
	$('.gmaker-board').each(function () {
		$(this).children('h2').prepend('<div class="gmaker-board-close"><span class="fa fa-times"></span></div>').append('<div class="clearfix"></div>');
//		$(this).after('<div class="gmaker-board-fixed hide"></div>');
	});
	$('.empty-canvas').dblclick(function () {
		$('.gmaker-tool-board-1').show()
	})
	$('.gmaker-board-close').click(function () {
		$(this).closest('.gmaker-board').hide()
	});
	$('.add-to-canvas').click(function () {
		$('.gmaker-canvas').append('<div class="canvas-element" id="' + $(this).attr('id') + '">' + $(this).attr('data') + '</div>');
		canvasElement($('.canvas-element#' + $(this).attr('id')));
		$('.gmaker-tool-board-1').hide()
	});
});
