var n = 0;
$(function() {
	$('.new-word').click(function () {
		right_board('Add new word', '', 'dictionary.php?do=add', '74%');
		return false
	});
	$('.contribute-word').click(function () {
		right_board('Add new word', '', 'dictionary.php?' + $(this).attr('href'), '70%');
		return false
	})
	$('.searchword').submit(function () {
		$.ajax({
			url: MAIN_URL + '/pages/dictionary.php',
			type: 'post',
			data: $(this).serialize(),
			success: function (data) {
				$('.word-show').html(data);
			}
		});
		return false
	});
});
