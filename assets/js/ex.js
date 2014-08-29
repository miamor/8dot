function updateResult () {
	$('.update-result').click(function () {
		$('.result-edit, .final-result').toggle();
		if ($('.result-edit').is(':visible')) {
			$('.result-edit').css('display', 'inline');
			$('.ex-result > div').css('margin-top', -5)
		} else $('.result-edit, .ex-result > div').removeAttr('style')
	});
	$('.result-edit').submit(function () {
		id = $(this).closest('.more-solution').attr('id');
		url = MAIN_URL + '/pages/exercise.php?' + e;
		e = window.location.href.split('?')[1];
		$.ajax({
			url: url + '&do=updateresult',
			type: 'POST',
			data: $('.result-edit').serialize(),
			datatype: 'json',
			success: function () {
				$('.ex-result').load(url + ' .ex-result > div', function () {
					updateResult(); flatApp()
				});
			}
		});
		return false
	})
}

function editMySolution () {
	$('.e-my-solution').click(function () {
		type = $(this).attr('alt');
		$(this).closest('.more-solution').find('.more-solution-detail').show();
		id = $(this).attr('id');
		e = window.location.href.split('?')[1];
		paths = MAIN_URL + '/pages/exercise.php?'+e+'&mS='+id;
		url = paths+'&do=editmysolution';
		$('.more-solution-detail#s'+id).load(url + ' .more-solution-detail#s'+id+' > div', function () {
			sce(); flatApp();
			$('.close-edit-my-solution').click(function () {
				$('.more-solution-detail').load(paths + " .more-solution-detail#s"+id+" > div", function () {
					if (type == 'program') fCode();
				});
				$('.tooltip').remove();
			});
			$('form.edit-my-solution').submit(function () {
				$.ajax({
					url: url + '&go=submit',
					type: 'POST',
					data: $("form.edit-my-solution").serialize(),
					datatype: 'json',
					success: function (data) {
						$('.more-solution-detail#s'+id).load(paths + ' .more-solution-detail#s'+id+' > div', function () {
							editMySolution();
							if (type == 'program') fCode();
						})
					},
					error: function (xhr) {
						mtip('', 'error', 'Error: ', xhr.status)
					}
				});
				return false
			});
		});
	});
}

function solutionAct () {
	editMySolution();
	$('.solution-toggle').click(function () {
		$(this).next('.more-solution-detail').toggle()
	});
	$('.more-solution').mouseover(function () {
		$(this).find('.to-auth:not(".authed"), .e-my-solution').show()
	}).mouseout(function () {
		$(this).find('.to-auth:not(".authed"), .e-my-solution').hide()
	});
	$('.ex-result').mouseover(function () {
		$(this).find('.update-result').show()
	}).mouseout(function () {
		$(this).find('.update-result').hide()
	});
	$('.to-auth').click(function () {
		id = $(this).closest('.more-solution').attr('id');
		au = id.split('-')[1];
		e = window.location.href.split('?')[1];
		$.ajax({
			url: MAIN_URL + '/pages/exercise.php?' + e + '&auth=' + au,
			type: 'POST',
			datatype: 'json',
			success: function () {
				clas = $('#' + id + ' .auth').attr('class').split(' ');
				if ($.inArray('authed', clas) >= 0) $('#' + id).find('.auth').removeClass('authed');
				else $('#' + id).find('.auth').addClass('authed')
			}
		})
	});
	$('.more-solution').each(function () {
		starSolution(this)
	});
}

function starSolution (a) {
	$(a).find('.star.stared').closest('.star-solution').addClass('stared');
	$(a).find('.star:not(.stared)').mouseover(function () {
		$(this).removeClass('fa-star-o').addClass('fa-star');
	}).mouseout(function () {
		$(this).removeClass('fa-star').addClass('fa-star-o');
	}).closest('.star-solution').removeClass('stared');
	$(a).find('.star').click(function () {
		id = $(this).closest('.more-solution').attr('id');
		au = id.split('-')[1];
		e = window.location.href.split('?')[1];
		$.ajax({
			url: MAIN_URL + '/pages/exercise.php?' + e + '&solution=' + au + '&do=star',
			type: 'POST',
			datatype: 'json',
			success: function () {
				$('#' + id).find('.star-solution').load(MAIN_URL + '/pages/exercise.php?' + e + ' #'+id+' .star-solution > span', function () {
					starSolution(this)
				})
			}
		})
	})
}

$(function () {
	solutionAct(); updateResult();
	sce();
	e = window.location.href.split('?')[1];
	path = MAIN_URL + '/pages/exercise.php?' + e + '&do=addsolution';
	$('.main-solution').mouseover(function () {
		$(this).find('.add-new-solution').show()
	}).mouseout(function () {
		$(this).find('.add-new-solution').hide()
	});
	$('.add-new-solution').click(function () {
		type = $(this).attr('alt');
		$("form.add-solution").slideDown(300);
		$('.close-add-new-solution').click(function () {
			$('form.add-solution').slideUp(300);
			$('.tooltip').remove()
		});
		$('form.add-solution').submit(function () {
			$.ajax({
				url: path + '&go=submit',
				type: 'POST',
				data: $("form.add-solution").serialize(),
				datatype: 'json',
				success: function (data) {
					$('.more-solution-list').load(path + ' .more-solution-list > div', function () {
						solutionAct(); $('.add-solution').hide().find('textarea').val('').next('sceditor-container').contents().find('body').html('<p><br></p>');
						if (type == 'program') fCode();
					})
				},
				error: function (xhr) {
					mtip('.test-solution', 'error', 'Error: ', xhr.status)
				}
			});
			return false
		})
	})
});
