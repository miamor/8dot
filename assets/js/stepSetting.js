function step_settings (a) {
	sce();
	var steps = $(a).find('.step').length;
		width_one = 100/steps;
	$(a).find('.step, .type-display').not('#step-1').hide();
	$(a).find('.step').each(function () {
		step = $(this).attr('id');
		nstep = step.split('-')[1];
		$(this).addClass(step);
		if ($(this).next('.step').length > 0) $(this).prepend('<div class="button next-step right btn btn-primary">Next</div>');
		$(a).find('.complete-bar').append('<div class="step-bar ' + step + '-bar" id="' + step + '" style="width: ' + width_one + '%"><div class="step-bar-color ' + step + '-bar-color" style="width: 0"></div><div class="step-des"><b>Step ' + nstep + '</b>: ' + $(this).attr('alt') + '</div><div class="' + step + '-point begin-point"></div></div>');
		$(a).find('.' + step + '-bar .begin-point').attr('title', '<b>Step ' + nstep + '</b>: ' + $(this).attr('alt'));
		if ($(this).is(":visible")) {
			$(a).find('.' + step + '-bar').addClass('ongoing')
		}
	});
	$(a).find('.complete-bar').append('<div class="complete-point" title="Completed"></div><div class="complete-des">Completed</div>');

	$(a).find('.next-step').click(function () {
		var steps = $(a).find('.step').length;
			width_one = 100/steps;
		$(a).find('.step-des').each(function () {
			lf = $(this).width()/2;
			mrl = $(this).css('margin-left');
			mal = 0 - lf - mrl;
//			alert(lf + '~~~~' + mrl);
			$(this).css('margin-left', '-' + lf + 'px')
		});
		$thisStep = $(this).closest('.step');
		$nextStep = $thisStep.next('.step');
		done_step = $thisStep.attr('id');
		next_step = $nextStep.attr('id');
		did = done_step.split('-')[1];
		$thisStep.find('textarea').each(function () {
			valTextarea = $(this).next('.sceditor-container').find('iframe').contents().find("body").html();
			if ($(this).hasClass('required')) {
				if (valTextarea.length && valTextarea != null && valTextarea != '<p><br></p>')
					$(this).removeClass('invalid');
				else $(this).addClass('invalid')
			}
			$(this).val(valTextarea);
		});
		checkValid($thisStep);
		var checkReturn = false;
		if (!$thisStep.find('.invalid').not(':hidden .invalid').length) {
			if ($thisStep.find('.c-topic').length) {
				if (!$thisStep.find('.c-topic :checked').length) checkReturn = false;
				else checkReturn = true;
			} else checkReturn = true;
		}
//		alert(done_step + '~~~~' + $thisStep.find('.invalid').length);
//		if ($('.invalid').length) mtip('', 'error', '', 'Please fill in all required fields.');
		if (checkReturn == true) {
			if ($nextStep.length) {
				$(a).find('.complete-bar-color').animate({
					'width' : width_one * did + '%'
				}, 500, function () {
					$(a).find('.' + done_step + '-bar').removeClass('ongoing').addClass('completed');
					$(a).find('.' + next_step + '-bar').addClass('ongoing')
				});
				$thisStep.removeClass('active').hide('slide', {direction: 'left'}, 500, function () {
					$nextStep.addClass('active').show(100, function () {
						$(this).find('textarea').next('.sceditor-container').find('iframe').contents().find('head').html('<head><style>.ie * {min-height: auto !important}</style><meta http-equiv="Content-Type" content="text/html;charset=utf-8"><link rel="stylesheet" type="text/css" href="'+PLUGINS+'/sceditor/minified/jquery.sceditor.default.min.css"></head>').next('body').html('<p><br></p>').attr({
							'contenteditable' : true,
							'dir' : 'ltr'
						})
					});
				});
			} else {
				$(a).find('.complete-bar-color').animate({
					'width' : '100%'
				}, 500, function () {
					$(a).find('.' + done_step + '-bar').removeClass('ongoing').addClass('completed');
					$(a).find('form').addClass('completed-form');
				});
				$thisStep.removeClass('active').hide('slide', {direction: 'left'}, 500, function () {
					$(a).find('.completed-print').addClass('active').show();
					$(a).find('.complete-des').show()
				});
			}
		}
	});
	$(a).find('.begin-point').click(function () {
		id = $(this).closest('.step-bar').attr('id');
		current = $(a).find('.step.active').attr('id');
		nid = Number(id.split('-')[1]);
		if (current == 'completed-print' || current == 'underfined' || !current) {
			current = 'completed-print';
			cuid = 100;
//			nid++;
		} else cuid = Number(current.split('-')[1]);
		if (nid != 2) $('.type-display').hide();
//		alert(cuid + '~~~~' + nid + '~~~~' + current);
		if (nid < cuid) {
			for (i = steps; i > nid; i--) $(a).find('.step-' + i + '-bar').removeClass('ongoing completed')
			$(a).find('.complete-bar-color').animate({
				'width' : width_one * (nid - 1) + '%'
			}, 500, function () {
				$(a).find('.' + id + '-bar').addClass('ongoing').removeClass('completed');
			});
			$(a).find('.' + current).removeClass('active').hide('slide', {direction: 'right'}, 500, function () {
				$(a).find('.' + id).addClass('active').show(100, function () {
					val = $(this).find('textarea').val();
					$(this).find('textarea').next('.sceditor-container').find('iframe').contents().find('head').html('<head><style>.ie * {min-height: auto !important}</style><meta http-equiv="Content-Type" content="text/html;charset=utf-8"><link rel="stylesheet" type="text/css" href="'+PLUGINS+'/sceditor/minified/jquery.sceditor.default.min.css"></head>').next('body').html(val).attr({
						'contenteditable' : true,
						'dir' : 'ltr'
					})
				});
			});
			$(a).find('.' + current + '-bar').removeClass('ongoing');
			$(a).removeClass('completed-form');
		}
	})
/**/
}


