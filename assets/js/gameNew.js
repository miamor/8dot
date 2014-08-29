$(function () {
	$('.form-new-game').each(function () {
		$(this).find('.step, .type-display').not('#step-1').hide();
		step_settings(this)
	}).submit(function () {
		$form = $(this);
		$form.find('.required').not('.hidden .required').each(function() {
			check_valid(this);
			$(this).change(function () {
				check_valid(this)
			})
		});
		if (!$form.find('.invalid').not('.hidden .invalid').length) {
			var formData = new FormData($form[0]);
			$.ajax({
				url: MAIN_URL + '/pages/game.php?mode=new&act=submit',
				type: 'POST',
				data: formData,
				mimeType: "multipart/form-data",
				contentType: false,
				cache: false,
				processData: false,
				success: function (data) {
					$form.find('.done-data').html(data);
				},
				error: function (xhr) {
					$form.find('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
				}
			})
		}
		return false
	});
	n = 3;
	$('.addbox').click(function() {
		n++;
		var id = $(this).parents('.all-thumbnais').find('.thums').attr('id');
		$(this).parents('.all-thumbnais').find('.thums').append('<input type="text" class="more-thumb thumb'+n+'" name="thumb'+id+n+'" id="thumb'+id+n+'" placeholder="Thumbnai '+n+'">');
	});
})
