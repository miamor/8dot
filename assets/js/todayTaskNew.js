function submit_form_daily_ex () {
	$('form.form-new-daily-exercise').submit(function () {
		$form = $(this);
		exType = $form.find('input.ex-type').val();
		if (exType == 'program') {
			var ace_editor = ace.edit('ace-editor');
			$('.ex-solution-program').val(ace_editor.getSession().getValue());
		}
		var formData = new FormData($form[0]);
//		alert(formData + '~~~~~~~~~' + $('.ex-solution-program').val());
		$thisStep = $form.find('.step-2');
		checkValid($thisStep);
		var checkReturn = false;
		if (!$thisStep.find('.invalid').not(':hidden .invalid').length) {
//			alert($thisStep.attr('class'));
			if ($thisStep.find('.c-topic').length) {
				if (!$thisStep.find('.c-topic :checked').length) checkReturn = false;
				else checkReturn = true;
			} else checkReturn = true;
		}
		if (checkReturn == true) {
			$.ajax({
				url: MAIN_URL + '/pages/todayTask.php?mode=new&act=submit',
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


$(function () {
	$('.form-new-daily-exercise').each(function () {
		step_settings(this);
		$(this).find('.step-1 .next-step').hide()
	});

	// Step 1
	$('.form-new-daily-exercise .step-1 .choose-type').not('.disabled').each(function () {
		$(this).append('<div class="ex-num-div"><span>Number:</span> <input type="number" min="1" value="1"/></div>')
	}).click(function () {
		type = $(this).attr('class').split('choose-type ')[1].split(' ')[0];
		name = $(this).children('h3').text();
		$('.choose-type').removeClass('selected');
		$(this).addClass('selected');
		$(this).find('.ex-num-div > input').attr({'name' : 'ex-num_'+type, 'class' : 'ex-num_'+type}).closest('.step-1').find('.step-1-info i').html('You chose <b class="type-chosen">' + name + '</b>');
		$('input.ex-type').val(type);
		if ($(this).find('.ex-num-div').is(':hidden')) {
//			$('.ex-num-div').slideUp();
//			$(this).find('.ex-num-div').slideDown();
		}
		$(this).closest('.step-1').find('.next-step').show();
	});
	
	// Step 2
//	$('.step-2 .next-step').show();
	if ($('#sl1').length > 0) {
		$('#sl1').slider({
			formater: function(value) {
				return 'Current value: '+value
			}
		})
	}

	$('.form-new-daily-exercise .step-1 .next-step').click(function () {
		type = $('input.ex-type').val();
		nums = $('.ex-num_'+type).val();
//		$('.form-new-lib#exercise').find('.step-2').prepend(nums + ' ex');
		$('.form-new-daily-exercise #'+type).removeClass('hide').show();
		$('.form-new-daily-exercise #'+type).find('input, select').not(':checkbox,:radio').parent('dd').parent('dl').addClass('line-mar');
		$('.test-choice dd').find('input').each(function () {
			nnc = $(this).attr('name').split('ex-choice-')[1];
			$(this).after('<div class="fa fa-check-circle-o choose-correct-ans choose-'+nnc+'"></div>')
		});
		$('.ex-add-choice').click(function () {
			nc = $('.test-choice dd').find('input:last').attr('name').split('ex-choice-')[1];
			nc++;
			if (nc <= 10) {
				$('.test-choice dd').append('<input type="text" name="ex-choice-'+nc+'" class="ex-choice-'+nc+'" placeholder="Choice '+nc+'"/>');
				$('.ex-choice-'+nc).after('<div class="fa fa-check-circle-o choose-correct-ans choose-'+nc+'"></div>');
				$('.choose-correct-ans').click(function () {
					$('.choose-correct-ans').prev('input').removeClass('input-success');
					$(this).prev('input').addClass('input-success');
				})
			}
		});
		$('.choose-correct-ans').click(function () {
			$('.choose-correct-ans').prev('input').removeClass('input-success');
			$(this).prev('input').addClass('input-success');
			$('.ex-result-tracnghiem').val($(this).prev('input').val())
		});
		if (type == 'program') {
			$('.dt-normal').hide(); $('.dt-program').show()
		} else {
			$('.dt-normal').show(); $('.dt-program').hide()
		}
	});

		/* Program type */
			$.getScript(PLUGINS + '/ace/src/ace.js').done(function () {
				ace_theme = 'crimson_editor';
				ace_mode = 'c_cpp';
				$.when(
					$.getScript(PLUGINS + '/ace/src/mode-'+ace_mode+'.js'),
					$.getScript(PLUGINS + '/ace/src/theme-'+ace_theme+'.js'),
					$.Deferred(function(deferred) {
						$(deferred.resolve)
					})
				).done(function() {
					var ace_editor = ace.edit('ace-editor');
					ace_editor.setTheme("ace/theme/"+ace_theme);
					ace_editor.getSession().setMode("ace/mode/"+ace_mode);
				})
			});
			$('.ex-choose-sample-type :radio').on('toggle', function () {
				type = $(this).val();
				$('.ex-sample-type-custom').slideUp(200);
				$('.ex-sample-type-' + type).slideDown(300);
			});
			$('.ex-choose-test-case-type :radio').on('toggle', function () {
				type = $(this).val();
				$('.ex-test-case-type-custom').slideUp(200);
				$('.ex-test-case-type-' + type).slideDown(300);
			});

	submit_form_daily_ex();
});
