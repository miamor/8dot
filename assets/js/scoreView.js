function scoreSubmit () {
	codes = document.getElementsByClassName('my-solution');
	if ($('.my-solution').find('p').length) {
		for (var i = 0, l = codes.length; i < l; i++) {
			j = i+1;
			codes[i].innerHTML = '<ol class="wind"><li class="line"><div class="line-comment"><span class="fa fa-comments" title="Add comments"></span></div>' + codes[i].innerHTML.split(/\<\/p\s?\/?\>/).join('</li><li class="line"><div class="line-comment"><span class="fa fa-comments" title="Add comments"></span></div>') + '</li></ol>';
		}
	}
	$('.my-solution .wind > li:last-child').remove();
	$('.my-solution .wind > li').each(function (e) {
		e++;
		$(this).attr('id', e).addClass('line'+e);
		if ($('.one-line-cmt#line'+e).length) {
			$(this).append('<div class="comments-this-line"></div>');
			html = $('.one-line-cmt#line'+e).html();
			$('.one-line-cmt#line'+e).prependTo('.line'+e+' .comments-this-line');
			$('.line-comments .one-line-cmt#line'+e).remove();
		}
	});
	$('.line-comment span').hide().click(function () {
		$li = $(this).closest('li.line');
		id = $li.attr('id');
		line = $li.attr('id');
		te = $(this).closest('.rows').attr('id');
		if ($li.children('form.add-comment-line').length <= 0) {
			$li.append('<form method="post" class="add-comment-line" id="' + id + '"> <textarea name="comment-line-'+te+line+'" style="height:150px"></textarea> <div class="comment-line-note">Adding comments line <b>'+id+'</b> <a class="fa fa-times-circle close-add-cmt" title="Close"></a> <div class="add-comment-line-action right"><input type="submit" value="Submit" class="btn-xs"/></div></div> </form>');
			sce(); flatApp();
			$('.close-add-cmt').click(function () {
				$(this).closest('form.add-comment-line').remove();
				$('.tooltip').remove()
			});
			$('form.add-comment-line').submit(function () {
				action = $('.plain.answer').attr('data-action');
				url = MAIN_URL + '/pages/course.php?' + action + '&te=' + te;
//				alert($("form.add-comment-line").serialize());
				$.ajax({
					url: url + '&line=' + line + '&do=addcomment&act=submit',
					type: 'POST',
					data: $("form.add-comment-line").serialize(),
					datatype: 'json',
					success: function (data) {
						$('.plain.answer').load(url + ' .plain.answer > div', function () {
							scoreSubmit(); flatApp();
							$('#'+te+' .my-solution').slideDown()
						})
					},
					error: function (xhr) {
						$('.add-comment-line').find('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
					}
				});
				return false
			})
		}
	});
	$('.quest-content').click(function () {
		if ($('.my-solution').not($(this).next('.my-solution')).is(':visible')) {
			$('.my-solution').slideUp(function () {
//				$(this).closest('.rows').removeAttr('style');
				$(this).prev('.quest-content').removeClass('bold').prev('.close-solution').hide();
			});
		}
		$(this).next('.my-solution').slideDown(function () {
//			$(this).closest('.rows').css('background', '#fcfcfc')
			$(this).prev('.quest-content').addClass('bold').prev('.close-solution').show()
		})
	});
	$('.close-solution').click(function () {
		$(this).hide().parent('.rows').children('.my-solution').slideUp().prev('.quest-content').removeClass('bold')
	});
}

$(function () {
	$('.c-info-right').addClass('fixed-top').closest('.c-info-view').addClass('no-right');
	scoreSubmit();
	$('.score-form').submit(function () {
		if (!$('.score-square input').val().length) mtip('.done-data', 'error', '', 'Please fill in a grade first.');
		else {
			action = $(this).attr('data-action');
			url = MAIN_URL + '/pages/course.php?' + action;
			$.ajax({
				url: url + '&do=grade&act=submit',
				type: 'POST',
				data: $(".score-form").serialize(),
				datatype: 'json',
				success: function (data) {
					$('.score-board .plain.score').load(url + ' .plain.score > div')
				},
				error: function (xhr) {
					$('.score-form').prev('.done-data').html('<div class="alerts alert-error">'+xhr+'. Please contact the administrators for help.</div>')
				}
			})
		}
		return false
	})
});
