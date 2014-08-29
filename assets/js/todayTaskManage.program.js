$(function () {
	$('.one-submitter .select-user').click(function () {
		u = $(this).closest('.one-submitter').attr('data-u');
		e = $(this).closest('.one-submitter').attr('data-e');
		$('.one-submitter').find('.ar-right').hide();
		$(this).closest('.one-submitter').find('.ar-right').show();
		$('.submission-detail').html('<ul class="bokeh"><li></li> <li></li> <li></li> <li></li> <li></li></ul>').load(MAIN_URL + '/pages/todayTask.php?e='+e+'&u='+u+' .submission-detail > span', function () {
			flatApp();
			var ace_editorUCode = ace.edit('ace-editor-u'+u+'-code');
			ace_editorUCode.setTheme("ace/theme/"+ace_theme);
			ace_editorUCode.getSession().setMode("ace/mode/"+ace_mode);
			ace_editorUCode.setReadOnly(true);
			$('.u-code .compile-code-submit').click(function () {
				$(this).closest('.compile-code-form').find('.textarea-my-code').val(ace_editorUCode.getSession().getValue());
			});
			compileCode();
			$('#ace-editor-u'+u+'-code').css({
				'position' : 'absolute',
				'left' : 0,
				'bottom' : 240,
				'top' : 0,
				'right' : 0
			}).prev('.compile-window').css('bottom', 89);
			$('.daily-task-manage-bar').submit(function () {
				formData = $(this).serialize();
				$.ajax({
					url: MAIN_URL + '/pages/todayTask.php?e='+e+'&u='+u+'&do=transfercoin',
					type: 'post',
					data: formData,
					datatype: 'json',
					success: function (data) {
						$('.submission-detail .daily-task-manage-bar').load(MAIN_URL + '/pages/todayTask.php?e='+e+'&u='+u+' .submission-detail .daily-task-manage-bar > span');
						$('.one-submitter#u'+u+' .check-transfer-coin').load(MAIN_URL + '/pages/todayTask.php?e='+e+'&u='+u+' .one-submitter#u'+u+' .check-transfer-coin > span')
					}
				});
				return false
			})
		})
	});
});
