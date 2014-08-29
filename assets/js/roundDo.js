var hour = Math.floor(mins / 60);
var secs = mins * 60;
var currentSeconds = 0;
var currentMinutes = 0;

function Decrement() {
	currentMinutes = Math.floor(secs / 60);
	currentHour = Math.floor(currentMinutes / 60);
	currentMinutes = currentMinutes % 60;
	currentSeconds = secs % 60;
	if (currentSeconds <= 9) currentSeconds = "0" + currentSeconds;
	if (currentMinutes <= 9) currentMinutes = "0" + currentMinutes;
	if (currentHour <= 9) currentHour = "0" + currentHour;
	secs--;
	$("#time.time-countdown").html('<span class="count-min">' + currentHour + '</span> : <span class="count-min">' + currentMinutes + '</span> : <span class="count-sec">' + currentSeconds + '</span>');
        if (secs !== -1) setTimeout('Decrement()', 1000);
}

function leave(a) {
	var r = confirm('You are on your test. Leaving this will submit your test immediately! So instead, we\'ll open your link in new tab.');
	if (r == true) window.open(a);
}

$(window).on('beforeunload', function () {
	i = window.location.href.split('i=')[1].split('&')[0];
	r = window.location.href.split('r=')[1].split('&')[0];
	$.ajax({
		url: MAIN_URL + '/pages/event.php?i=' + i + '&r=' + r + '&act=submit',
		type: 'POST',
		data: $('form.form-submit-round-test').serialize(),
		datatype: 'json',
		success: function (data) {
		}
	});
	return 'You are on the test. Leaving this will submit your test immediately!';
});


$(function () {
	$('.form-submit-round-test').submit(function () {
		i = window.location.href.split('i=')[1].split('&')[0];
		r = window.location.href.split('r=')[1].split('&')[0];
		$.ajax({
			url: MAIN_URL + '/pages/event.php?i=' + i + '&r=' + r + '&act=submit',
			type: 'POST',
			data: $('form.form-submit-round-test').serialize(),
			datatype: 'json',
			success: function (data) {
				location.reload()
			}
		});
		return false
	});
	$('a').each(function() {
		$(this).attr('onclick', 'leave("' + $(this).attr("href") + '"); return false');
	});
	setTimeout('Decrement()', 1000);
});
