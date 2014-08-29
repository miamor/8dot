function countTotal() {
	totalPrice = 0;
	vat = Number($('.get-tick-vat .vat').text());
	mycoin = Number($('.my-money').text());
	$('.get-tick-line').not('.center').each(function () {
		if ($(this).find('.get-check').is(':checked')) {
			var checked = $(this).find('.get-tick-number-get .get-radio:checked');
			var num;
			if (checked.length > 0) num = Number(checked.val());
			else num = 0;
			var textLeft = $(this).find('.get-tick-number-left').attr('alt');
			var left = Number(textLeft);
			var lefn = left - num;
			if (textLeft == left) $(this).find('.get-tick-number-left').html(lefn);
			var had = Number($(this).find('.get-tick-number-had').attr('alt'));
			var have = had + num;
			$(this).find('.get-tick-number-had').html(have);
			price = Number($(this).find('.layprice').text());
			totalPrice = totalPrice + price * num;
		}
	});
	$('.get-tick-price .total').html(totalPrice);
	totalPrice = totalPrice + vat;
	$('.get-tick-total .total-vat').html(totalPrice);
	if (!$('.get-tick-tb').find('.get-check:checked').length || mycoin < totalPrice) $('.submit').attr('disabled', true);
	else $('.submit').removeAttr('disabled');
}

$(function () {
	countTotal();
	$('.get-tick-number-get :radio').change(function () {
//		alert('shit');
		id = $(this).attr('id').split('_')[0];
			$('.get-check#' + id).checkbox('check');
			$('.get-check#' + id).closest('label').removeClass('disabled');
			$('.get-check#' + id).removeAttr('disabled');
		countTotal()
	});
	$('.get-tick-price :radio').on('toggle', function () {
		$(this).closest('.get-tick-price').find('.layprice').html($(this).attr('alt'));
		countTotal()
	});
	$('.get-check').on('toggle', function() {
		if (!$(this).attr('checked')) {
			id = $(this).attr('id');
			id1 = id + '_1';
			id2 = id + '_2';
			if (!$(this).attr('disabled')) {
				if (!$('.get-radio#' + id1).attr('disabled')) $('.get-radio#' + id1).radio('uncheck');
				if (!$('.get-radio#' + id2).attr('disabled')) $('.get-radio#' + id2).radio('uncheck');
				$('.get-check#' + id).checkbox('uncheck');
				if (!$('.get-radio#' + id1).attr('disabled') && !$('.get-radio#' + id2).attr('disabled')) {
					$('.get-check#' + id).attr('disabled', true);
					$('.get-check#' + id).closest('label').addClass('disabled');
				}
			}
		}
		countTotal()
	});
	$('form.get-tick-tb').submit(function () {
		param = window.location.href.split('?')[1];
		$.ajax({
			url: MAIN_URL + '/pages/getTick.php?' + param + '&gettick=submit',
			type: 'POST',
			data: $("form.get-tick-tb").serialize(),
			datatype: 'json',
			success: function (data) {
				$('form.get-tick-tb').html(data)
			},
			error: function (xhr) {
				$('form.get-tick-tb').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
			}
		});
		return false
	});
})
