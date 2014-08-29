var secs = mins * 60;
var hour = Math.floor(mins / 60);
var currentSeconds = 0;
var currentMinutes = 0;
var currentHour = 0;

function Decrement() {
	currentMinutes = Math.floor(secs / 60);
	currentHour = Math.floor(currentMinutes / 60);
	currentMinutes = (currentMinutes % 60);
	currentSeconds = secs % 60;
	if (currentSeconds <= 9) currentSeconds = "0" + currentSeconds;
	if (currentMinutes <= 9) currentMinutes = "0" + currentMinutes;
	if (currentHour <= 9) currentHour = "0" + currentHour;
	secs--;
	$("#time.time-countdown").html('<span class="count-hour">' + currentHour + '</span> : <span class="count-min">' + currentMinutes + '</span> : <span class="count-sec">' + currentSeconds + '</span>');
        if (secs !== -1) setTimeout('Decrement()', 1000);
        if (currentHour == 0 && currentMinutes == 0 && currentSeconds == 0) {
		alert('Time out!');
		c = window.location.href.split('c=')[1].split('&')[0];
		e = window.location.href.split('e=')[1].split('&')[0];
		$.ajax({
			url: MAIN_URL + '/pages/course.php?c=' + c + '&t=exam&e=' + e + '&act=submit',
			type: 'POST',
			data: $('form.form-submit-test').serialize(),
			datatype: 'json',
			success: function (data) {
				location.reload()
			}
		});
	}
}

function leave(a) {
	var r = confirm('You are on your test. We\'ll open your link in new tab. Remember, your clock is counting down, finish your test before time out!');
	if (r == true) window.open(a);
}

$(window).on('beforeunload', function () {
	c = window.location.href.split('c=')[1].split('&')[0];
	e = window.location.href.split('e=')[1].split('&')[0];
	$.ajax({
		url: MAIN_URL + '/pages/course.php?c=' + c + '&t=exam&e=' + e + '&act=submit',
		type: 'POST',
		data: $('form.form-submit-test').serialize(),
		datatype: 'json',
		success: function (data) {
		}
	});
	return 'You are on the test. Leaving this will submit your work! Please be sure you\'re done before leaving/submitting.';
});

$(function () {
	$('.form-submit-test').submit(function () {
		c = window.location.href.split('c=')[1].split('&')[0];
		e = window.location.href.split('e=')[1].split('&')[0];
		$form = $(this);
		$.ajax({
			url: MAIN_URL + '/pages/course.php?c=' + c + '&t=exam&e=' + e + '&act=submit',
			type: 'POST',
			data: $form.serialize(),
			datatype: 'json',
			success: function (data) {
				location.reload()
			}
		});
		return false
	});
	$('a[href]').each(function() {
		$(this).attr('onclick', 'leave("' + $(this).attr("href") + '"); return false');
	});
	setTimeout('Decrement()', 1000);
});
