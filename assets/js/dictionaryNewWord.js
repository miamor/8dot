function sortContacts() {
	var contacts = $('ul.w-list'),
		cont = contacts.children('li');
	cont.detach().sort(function (a, b) {
		var astts = $(a).data('sid');
		var bstts = $(b).data('sid')
		return (astts > bstts) ? (astts > bstts) ? 1 : 0 : -1;
	});
	contacts.append(cont);
}

function rm() {
	sce();
	$('.removeBox').click(function() {
		var t = $(this).parents('.box').remove()
	});
}

var n = 0;
$(function() {
	rm();
	$('.addword').submit(function () {
		$('textarea').each(function () {
			val = $(this).next('.sceditor-container').find('iframe').contents().find('body').html();
			$(this).val(val);
		});
		$.ajax({
			url: MAIN_URL + '/pages/dictionary.php?do=add&act=submit',
			type: 'post',
			data: $(this).serialize(),
			success: function (data) {
				$('.addword').html(data);
			}
		});
		return false
	});
	$('.addBox').click(function() {
		var t = $(this).closest('.row-def').attr('alt');
		n++;
		$(this).parents('.row').append('<div class="box box'+n+'"><img style="cursor:pointer" class="removeBox right" src="'+IMG+'/famfamfam/silk/delete.png"/><input style="margin:5px 0" type="text" name="'+t+n+'" placeholder="Meaning '+t+n+'"/><div style="margin:0 0 10px 0" title="Some examples for this meaning <i>(Optional)</i>"><textarea style="height:150px!important" class="dafukk" name="'+t+'-eg'+n+'"></textarea></div><div class="divide-h"></div></div>');
		rm();
	});
	$('input[type="checkbox"]').on('change', function() {
		var n = $(this).attr('name');
		if ($(this).is(':checked')) {
			$('.'+n+'-define').show()
		} else {
			$('.'+n+'-define').hide()
		}
	});
	sortContacts();
});
