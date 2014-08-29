var ace_editorRCode = ace.edit('ace-editor-results-code');
function submit_form_test () {
	$('form.form-new-test').submit(function () {
		$form = $(this);
		c= $form.attr('data-c');
		$form.find('.t-ans-console').val(ace_editorRCode.getSession().getValue());
		$form.find('.step:last').find('.required').not(':hidden .required').each(function() {
			check_valid(this);
			$(this).change(function () {
				check_valid(this)
			})
		});
		if (!$form.find('.invalid').not(':hidden .invalid').length) {
			var formData = new FormData($form[0]);
			$.ajax({
				url: MAIN_URL + '/pages/test.php?c='+c+'&mode=new&act=submit',
				type: 'POST',
				data: formData,
				mimeType: "multipart/form-data",
				contentType: false,
				cache: false,
				processData: false,
				success: function (data) {
					$form.find('.complete-bar-color').animate({
						'width' : '100%'
					}, 500, function () {
						$form.addClass('completed-form').find('.step-2-bar').removeClass('ongoing').addClass('completed');
					});
					$form.find('.step:last').removeClass('active').hide('slide', {direction: 'left'}, 500, function () {
						$form.find('.completed-print').addClass('active').show().find('.done-data').html(data);
						$form.find('.complete-des').show()
					});
				},
				error: function (xhr) {
					$form.find('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
				}
			})
		}
		return false
	})
}

function showSheet (sheets) {
	input = $('.t-sheets .t-sheet-one').length;
	tf = sheets - input;
	if (tf > 0) {
		for (i = input + 1; i <= sheets; i++) {
			$('.t-sheets').append('<div class="t-sheet-one"><label class="checkbox"><input type="checkbox" name="t-ans-'+i+'" class="t-ans-'+i+'" value="ans"/></label> <input type="text" name="t-result-'+i+'" class="required t-result-'+i+'"/> <i class="gensmall">// Correct answer for quest '+i+'</i></div>');
			$('.t-ans-'+i).checkbox();
		}
	} else if (tf < 0) $('.t-sheets .t-sheet-one').slice(tf).remove()
}

$(function () {
	ace_theme = 'crimson_editor';
	ace_mode = 'javascript';
	$.when(
		$.getScript(PLUGINS + '/ace/src/mode-'+ace_mode+'.js'),
		$.getScript(PLUGINS + '/ace/src/theme-'+ace_theme+'.js'),
		$.Deferred(function(deferred) {
			$(deferred.resolve)
		})
	).done(function() {
		ace_editorRCode.setTheme("ace/theme/"+ace_theme);
		ace_editorRCode.getSession().setMode("ace/mode/"+ace_mode);
	});
	$('.form-new-test').each(function () {
		$(this).find('.step, .type-display').not('#step-1').hide();
		step_settings(this)
	});
	submit_form_test();
	$('.set-result-type :radio').on('toggle', function () {
		a = $('.set-result-type :checked').val();
		if ($('.set-correct-ans.' + a).is(':hidden')) {
			$('.set-correct-ans').slideUp(200, function () {
				$('.set-correct-ans.' + a).show()
			})
		}
	});
	$('.up-type :radio').on('toggle', function () {
		a = $('.up-type :checked').val();
		if ($('.up-type-' + a).is(':hidden')) {
			$('[class^="up-type-"]').slideUp(200, function () {
				$('.up-type-' + a).slideDown(200)
			})
		}
	});
	$('.up-problem-type :radio').on('toggle', function () {
		a = $('.up-problem-type :checked').val();
		if ($('.up-problem-' + a).is(':hidden')) {
//			$('.up-problem-' + a).slideDown(200)
			$('.up-problem').slideUp(200, function () {
				$('.up-problem-' + a).slideDown(200)
			})
		}
	});
	$('[name="t-nums"]').change(function () {
		showSheet($(this).val())
	});
});
