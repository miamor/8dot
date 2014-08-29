function flatApp() {
	$('.tooltip').remove();
	$('.switch-cmt').click(function () {
		$('#edit, #comments').toggle()
	});
/*	$(".rb-content").niceScroll({
		cursorcolor: "#121212",
		cursorborder: "0px solid #fff",
		cursorborderradius: "0px",
		cursorwidth: "0px"
	});
	$(".sidebar-nicescroller").getNiceScroll().resize();
*/	$('input[type="submit"], button, .button').not('[class*="btn "]').addClass('btn btn-primary');
	$('input[type="reset"]').addClass('btn btn-default');
//	$(':checkbox').closest('label').addClass('checkbox');
	$(':checkbox').not('[data-toggle="switch"], .onoffswitch-checkbox').checkbox();
	$(':radio').radio();
//	$("select").selectpicker({style: 'btn-default', menuStyle: 'dropdown-default'});
	$(".tagsinput").each(function () {
		if (!$(this).next('div.tagsinput').length) {
//			alert('none');
//			$(this).tagsInput()
		}
	});

	/** BEGIN CHOSEN JS **/
	choosen()
	/** END CHOSEN JS **/
	

	/** BEGIN TOOLTIP FUNCTION **/
	$('.tooltips').tooltip({
	  selector: '*:not(".sceditor-dropdown img, #ui-datepicker-div a, #fancybox-buttons li a, #fancybox-buttons li, .fancybox-overlay li, .fancybox-overlay span, .fancybox-overlay div, .fancybox-overlay a")',
	  container: "body"
	})
/*	$('.popovers').popover({
	  selector: "[data-toggle=popover]",
	  container: "body"
	})
*/	/** END TOOLTIP FUNCTION **/

	/** BEGIN INPUT FILE **/
	if ($('.btn-file').length > 0){
		$(document)
			.on('change', '.btn-file :file', function() {
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
	
function datepicker() {
	/** BEGIN DATEPICKER **/
	if ($('.datepicker').length > 0){
		$('.datepicker').datepicker()
	}
	
	if ($('#datepicker1').length > 0){
		var nowTemp = new Date();
		var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
		 
		var checkin = $('#datepicker1').datepicker({
		  onRender: function(date) {
			return date.valueOf() < now.valueOf() ? 'disabled' : '';
		  }
		}).on('changeDate', function(ev) {
		  if (ev.date.valueOf() > checkout.date.valueOf()) {
			var newDate = new Date(ev.date)
			newDate.setDate(newDate.getDate() + 1);
			checkout.setValue(newDate);
		  }
		  checkin.hide();
		  $('#datepicker2')[0].focus();
		}).data('datepicker');
		var checkout = $('#datepicker2').datepicker({
		  onRender: function(date) {
			return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
		  }
		}).on('changeDate', function(ev) {
		  checkout.hide();
		}).data('datepicker');
	}
	/** END DATEPICKER **/
}
	
	
function timePicker() {
	/** BEGIN TIMEPICKER **/
	if ($('.timepicker').length > 0){
		$('.timepicker').timepicker();
	}
	/** END TIMEPICKER **/
}
	
function inputMask() {	
	/** BEGIN INPUT MASK **/
	$(function () {
		"use strict";
		$('.cc_masking').mask('0000-0000-0000-0000');
		$('.cc_security_masking').mask('0000');
		$('.date_masking').mask('00/00/0000');
		$('.time_masking').mask('00:00:00');
		$('.date_time_masking').mask('00/00/0000 00:00:00');
		$('.phone_us_masking').mask('(000) 000-0000');
		$('.cpf_masking').mask('000.000.000-00', {reverse: true});
		$('.money_masking').mask('000.000.000.000.000,00', {reverse: true});
		$('.money2_masking').mask("#.##0,00", {reverse: true, maxlength: false});
		$('.ip_address_masking').mask('0ZZ.0ZZ.0ZZ.0ZZ', {translation: {'Z': {pattern: /[0-9]/, optional: true}}});
		$('.ip_address_masking').mask('099.099.099.099');
		$('.percent_masking').mask('##0,00%', {reverse: true});
	});
	/** END INPUT MASK **/
}
	
function sWizard() {	
	/** BEGIN EXAMPLE SIMPLE WIZARD **/
	if ($('.NextStep').length > 0){
		$('.NextStep').click(function(){
		"use strict";
		  var nextId = $(this).parents('.tab-pane').next().attr("id");
		  $('[href=#'+nextId+']').tab('show');
		})
	}
	if ($('.PrevStep').length > 0){
		$('.PrevStep').click(function(){
		"use strict";
		  var prevId = $(this).parents('.tab-pane').prev().attr("id");
		  $('[href=#'+prevId+']').tab('show');
		})
	}
	/** END EXAMPLE SIMPLE WIZARD **/
}

function slider() {
	/** BEGIN SLIDER **/
	if ($('#sl1').length > 0){
		$('#sl1').slider({
		  formater: function(value) {
			return 'Current value: '+value;
		  }
		});
	}
	if ($('#sl2').length > 0){
		$('#sl2').slider();
	}
	if ($('#eg').length > 0){
		$('#eg input').slider();
	}
	/** END SLIDER **/
}
	

function magPop() {
	/** BEGIN MAGNIFIC POPUP **/
	if ($('.magnific-popup-wrap').length > 0){
			$('.magnific-popup-wrap').each(function() {
			"use strict";
				$(this).magnificPopup({
					delegate: 'a.zooming',
					type: 'image',
					removalDelay: 300,
					mainClass: 'mfp-fade',
					gallery: {
					  enabled:true
					}
				});
			}); 
	}
	
	if ($('.inline-popups').length > 0){
			$('.inline-popups').magnificPopup({
			  delegate: 'a',
			  removalDelay: 500,
			  callbacks: {
				beforeOpen: function() {
				   this.st.mainClass = this.st.el.attr('data-effect');
				}
			  },
			  midClick: true
			});
	}
	/** END MAGNIFIC POPUP **/
}

function owlC() {
	/** BEGIN OWL CAROUSEL **/
	if ($('#owl-lazy-load').length > 0){
	  $("#owl-lazy-load").owlCarousel({
		items : 5,
		lazyLoad : true,
		navigation : true
	  });
	}

	if ($('#owl-lazy-load-autoplay').length > 0){
	  $("#owl-lazy-load-autoplay").owlCarousel({
		autoPlay: 3000,
		items : 5,
		lazyLoad : true
	  });
	}
	
	if ($('#owl-lazy-load-gallery').length > 0){
	  $("#owl-lazy-load-gallery").owlCarousel({
		items : 5,
		lazyLoad : true,
		navigation : true
	  });
	}
	
	
	var Owltime = 7;
	var $progressBar,
	  $bar, 
	  $elem, 
	  isPause, 
	  tick,
	  percentTime;
	 
	if ($('#owl-single-progress-bar').length > 0){
		$("#owl-single-progress-bar").owlCarousel({
		  slideSpeed : 500,
		  paginationSpeed : 500,
		  singleItem : true,
		  afterInit : progressBar,
		  afterMove : moved,
		  startDragging : pauseOnDragging
		});
	}
 
	function progressBar(elem){
	  $elem = elem;
	  buildProgressBar();
	  start();
	}
 
	function buildProgressBar(){
	  $progressBar = $("<div>",{
		id:"OwlprogressBar"
	  });
	  $bar = $("<div>",{
		id:"Owlbar"
	  });
	  $progressBar.append($bar).prependTo($elem);
	}
		 
	function start() {
	  percentTime = 0;
	  isPause = false;
	  tick = setInterval(interval, 10);
	};
 
	function interval() {
	  if(isPause === false){
		percentTime += 1 / Owltime;
		$bar.css({
		   width: percentTime+"%"
		 });
		if(percentTime >= 100){
		  $elem.trigger('owl.next')
		}
	  }
	}
		 
	function pauseOnDragging(){
	  isPause = true;
	}
 
	function moved(){
	  clearTimeout(tick);
	  start();
	}
	/** END OWL CAROUSEL **/
}

function blogDezign() {	
	/** BEGIN BLOG DESIGN JS FUNCTION **/
	  if ($('#blog-slide-1').length > 0){
		  $("#blog-slide-1").owlCarousel({
				navigation : false,
				pagination: false,
				slideSpeed : 1000,
				paginationSpeed : 400,
				singleItem:true,
				autoPlay: 3000,
				transitionStyle : 'goDown'
		  });
	  }
	  if ($('#blog-slide-2').length > 0){
		  $("#blog-slide-2").owlCarousel({
				navigation : false,
				pagination: false,
				slideSpeed : 1000,
				paginationSpeed : 400,
				singleItem:true
		  });
	  }
	/** END BLOG DESIGN JS FUNCTION **/
}

function photoCollection () {
	/** BEGIN MY PHOTOS COLLECTION FUNCTION **/
	if ($('#photo-collection-1').length > 0){
	  $("#photo-collection-1").owlCarousel({
			navigation : false,
			pagination: false,
			slideSpeed : 1000,
			paginationSpeed : 400,
			singleItem:true,
			autoPlay: 3000,
			transitionStyle : 'fadeUp'
	  });
	}
	/** BEGIN MY PHOTOS COLLECTION FUNCTION **/
}
	

function chart() {	
	/** BEGIN WIDGET MORRIS JS FUNCTION **/
	if ($('#morris-widget-1').length > 0){
	Morris.Line({
	  element: 'morris-widget-1',
	  data: [
		{ y: '2000', a: 34},
		{ y: '2001', a: 55},
		{ y: '2002', a: 60},
		{ y: '2003', a: 65},
		{ y: '2004', a: 20},
		{ y: '2005', a: 75},
		{ y: '2006', a: 55},
		{ y: '2007', a: 77},
		{ y: '2008', a: 90},
		{ y: '2009', a: 125},
		{ y: '2010', a: 100},
		{ y: '2011', a: 15},
		{ y: '2012', a: 20},
		{ y: '2013', a: 85}
	  ],
		xkey: 'y',
		ykeys: ['a'],
		labels: ['Earning (in 10K USD)'],
		resize: true,
		lineColors: ['#1F91BD'],
		pointFillColors :['#fff'],
		pointStrokeColors : ['#3EAFDB'],
		gridTextColor: ['#fff'],
		pointSize :3,
		grid: false
	});
	}
	
	if ($('#morris-widget-2').length > 0){
	//MORRIS
	Morris.Bar({
	  element: 'morris-widget-2',
	  data: [
		{ y: 'Indonesia', a: 952},
		{ y: 'India', a: 985},
		{ y: 'United Kingdom', a: 421 },
		{ y: 'United States', a: 725 },
		{ y: 'Taiwan', a: 350 },
		{ y: 'New Zealand', a: 120 },
		{ y: 'Germany', a: 85 },
		{ y: 'Thailand', a: 20 },
		{ y: 'Korea', a: 65 },
		{ y: 'Malaysia', a: 955},
		{ y: 'China', a: 785 },
		{ y: 'Philipina', a: 700 },
		{ y: 'Autralia', a: 601 },
		{ y: 'Japan', a: 50 },
		{ y: 'Singapore', a: 124}
	  ],
	  xkey: 'y',
	  ykeys: ['a'],
	  labels: ['Companies'],
	  resize: true,
	  barColors: ['#E6563C'],
	  gridTextColor: ['#E6563C'],
	  gridTextSize: 11,
	  grid :false,
	  axes: false
	});
	}
	
	
	if ($('#morris-widget-3').length > 0){
	Morris.Area({
	  element: 'morris-widget-3',
	  data: [
		{ y: '2006', a: 100, b: 90 },
		{ y: '2007', a: 75,  b: 65 },
		{ y: '2008', a: 50,  b: 40 },
		{ y: '2009', a: 75,  b: 65 },
		{ y: '2010', a: 50,  b: 40 },
		{ y: '2011', a: 75,  b: 65 },
		{ y: '2012', a: 100, b: 90 }
	  ],
	  xkey: 'y',
	  ykeys: ['a', 'b'],
	  labels: ['Series A', 'Series B'],
	  resize: true,
	  grid :false,
	  axes: false,
	  lineColors: ['#967ADC', '#D770AD']
	});
	}
	/** END WIDGET MORRIS JS FUNCTION **/
	
	
	/** BEGIN WIDGET PIE FUNCTION **/
	if ($('.widget-easy-pie-1').length > 0){
		$('.widget-easy-pie-1').easyPieChart({
			easing: 'easeOutBounce',
			barColor : '#3BAFDA',
			lineWidth: 10,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});
	}
	if ($('.widget-easy-pie-2').length > 0){
		$('.widget-easy-pie-2').easyPieChart({
			easing: 'easeOutBounce',
			barColor : '#F6BA48',
			lineWidth: 10,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});
	}
	/** END WIDGET PIE FUNCTION **/
	
	

if ($('#realtime-chart-widget').length > 0){
		var data1 = [];
		var totalPoints = 250;
		function GetData() {
		"use strict";
		data1.shift();
		while (data1.length < totalPoints) {
		var prev = data1.length > 0 ? data1[data1.length - 1] : 50;
		var y = prev + Math.random() * 10 - 5;
		y = y < 0 ? 0 : (y > 100 ? 100 : y);
		data1.push(y);
		}
		var result = [];
		for (var i = 0; i < data1.length; ++i) {
			result.push([i, data1[i]])
			}
		return result;
		}
		var updateInterval = 500;
		var plot = $.plot($("#realtime-chart-widget #realtime-chart-container-widget"), [
			GetData()], {
			series: {
				lines: {
					show: true,
					fill: false
				},
				shadowSize: 0
			},
			yaxis: {
				min: 0,
				max: 100,
				ticks: 10,
				show: false
			},
			xaxis: {
				show: false
			},
			grid: {
				hoverable: true,
				clickable: true,
				tickColor: "#f9f9f9",
				borderWidth: 0,
				borderColor: "#eeeeee"
			},
			colors: ["#699B29"],
			tooltip: false,
			tooltipOpts: {
				defaultTheme: false
			}
		});
		function update() {
			"use strict";
			plot.setData([GetData()]);
			plot.draw();
			setTimeout(update, updateInterval);
		}
		update();
}

	
}


$(document).ready(function() {

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
	/** END SIDEBAR FUNCTION **/
	
	
	/** BUTTON TOGGLE FUNCTION **/
	$(".btn-collapse-sidebar-left").click(function(){
		"use strict";
		$(".top-navbar").toggleClass("toggle");
		$(".sidebar-left").toggleClass("toggle");
		$(".page-content").toggleClass("toggle");
		$(".icon-dinamic").toggleClass("rotate-180");
	});
	$(".btn-collapse-sidebar-right").click(function(){
		"use strict";
		$(".top-navbar").toggleClass("toggle-left");
		$(".sidebar-left").toggleClass("toggle-left");
		$(".sidebar-right").toggleClass("toggle-left");
		$(".page-content").toggleClass("toggle-left");
	});
	$(".btn-collapse-nav").click(function(){
		"use strict";
		$(".icon-plus").toggleClass("rotate-45");
	});
	/** END BUTTON TOGGLE FUNCTION **/
	
	
	
	
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
	
	/** END NICESCROLL AND SLIMSCROLL FUNCTION **/
	
	
	
});
