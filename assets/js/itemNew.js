var n = 3;
function check_valid(a) {
	if ($.trim($(a).val()).length == 0) {
		$(a).addClass("invalid")
	} else {
		$(a).removeClass("invalid")
	}
}

$(function () {
	$('.addbox').click(function() {
		n++;
		var id = $(this).parents('.all-thumbnais').find('.thums').attr('id');
		$(this).parents('.all-thumbnais').find('.thums').append('<input type="text" class="more-thumb" name="thumb'+id+n+'" id="thumb'+id+n+'" placeholder="Thumbnai '+n+'">');
	});
	
	$('form#manage-item').submit(function() {
		$('.required').each(function() {
			check_valid(this)
			$(this).change(function () {
				check_valid(this)
			})
		});
		if ($('.invalid').length) mtip('#manage-item', 'error', '', 'Please fill in all required fields.');
		else {
			$.ajax({
				url: $("#manage-item").attr("action"),
				type: $("#manage-item").attr("method"),
				data: $("#manage-item").serialize(),
				datatype: 'json',
				success: function (data) {
					var mode = $("#manage-item").attr("action").split('mode=')[1].split('&act=')[0];
					if (mode == 'edit') {
						var iid = $("#manage-item").attr("action").split('&act=')[0].split('i=')[1];
						$('form#manage-item').html('<div class="alerts alert-success">Item successfully updated. <a href="#!item?mode=edit&i='+iid+'">Back</a> <a href="#!item">Back to item list</a></div>')
					} else if (mode == 'new') {
						$('form#manage-item').html('<div class="alerts alert-success">Item added successfully. <a href="#!item">Back to item list</a></div>')
					}
				},
				error: function (xhr) {
					$('form#manage-item').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for more details. <a href="#!item">Back to item list</a></div>')
				}
			})
		}
		return false
	})
});