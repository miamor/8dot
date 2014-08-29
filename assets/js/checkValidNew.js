function check_valid(b) {
//	alert($(a).attr('class'));
//	if ($.isArray($(a).val()) == true) alert($(a).val());
	$a = $(b);
	$form = $a.closest('form');
	val = $.trim($a.val());
		stringExists = false;
	fieldRequire = false;
	if ($a.attr('class').indexOf('required') != -1) fieldRequire = true;
	if ( fieldRequire == true || parseInt(val.length) > 0) {
		if ($a.attr('class').indexOf('input-link') != -1) {
			strings = ['http://', '.'];
		} else if ($a.attr('class').indexOf('input-img') != -1) {
			strings = ['http://', '.jpg', '.png', '.gif', '.jpeg'];
		} else if ($a.attr('class').indexOf('input-number') != -1) {
			strings = ['1','2','3','4','5','6','7','8','9','0'];
		} else strings = [''];
		for (var i = 0; i < strings.length; i++) {
			if (val.indexOf(strings[i]) != -1) {
				stringExists = true;
				break
			} else stringExists = false
		}
	} else stringExists = true;
		if ( (fieldRequire == true && (val.length == 0 || val == '<p><span id="sceditor-start-marker" style="line-height: 0; display: none;" class="sceditor-selection sceditor-ignore"> </span><span id="sceditor-end-marker" style="line-height: 0; display: none;" class="sceditor-selection sceditor-ignore"> </span><br></p>' || val == '<p><br></p>') ) || stringExists == false) $a.addClass("invalid");
		else $a.removeClass("invalid")
}

function checkValid (a) {
	$form = $(a);
	if ($form.find('.c-topic').length) {
		if (!$form.find('.c-topic :checked').length) {
			$form.find('.c-topic-list').addClass('invalid');
//			$form.find('.done-data').html('<div class="alerts alert-error alert-no-checkbox">Please select a topic.</div>')
		} else {
			$form.find('.c-topic-list').removeClass('invalid');
//			$form.find('.done-data').find('.alert-no-checkbox').remove();
		}
	}
	$(a).find('input, select').not(':hidden').each(function() {
		check_valid(this);
		$(this).change(function () {
			check_valid(this)
		})
	});
}

function formMiThing () {
	$('input, select').not(':checkbox,:radio,:hidden').parent('dd').parent('dl').addClass('line-mar');
	
	$('.form-mi input, .form-mi textarea, .form-mi select:not(.c-day)').each(function () {
		name = $(this).attr('name');
		$(this).addClass(name)
	})
}
