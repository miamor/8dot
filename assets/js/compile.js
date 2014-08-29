function compileCode () {
	$('.compile-code-form .compile-code-submit').click(function() {
		$form = $(this).closest('.compile-code-form');
		$form.find('#compile-output').hide().html('<br/>Generating the output &nbsp;&nbsp;&nbsp; <img src="'+IMG+'/loading3.gif" />').fadeIn();
		$form.find('.compile-code-submit').addClass("disabled");
		$form.find('.error').html('');
		var isFocus=0;
		var isError=0;
		var code = $form.find('.textarea-my-code').val();
		var codeFileName = $form.find('.code-file-name').val();
		var input = $form.find('.input-file').val();
		var outputFile = $form.find('.output-file').val();
		var dir = $form.find('.dir-to-compile').val();
		var testcaseDir = $form.find('.testcase-dir').val();
		var language = $form.find('.code-language').text();
		// Validate the data
		if ($.trim(code) == '') {
			$form.find('#errorCode').show().html('The code area is empty');
//			$('#form #code').focus();
			isFocus=1;
			isError=1;
		}
		// Terminate the script if an error is found
		if (isError == 1) {
			$form.find('#compile-output').html('');
			$form.find('#compile-output').hide();
			$form.find('.compile-code-submit').removeClass("disabled");
			return false
		}
		if (!language.length) $form.find('#compile-output').html('<div class="console console-error"><b>Errors</b> Oops! We found no language to compile. This might be uploader\'s fault. You can contact them or the administrators for more details and get this fixed.</div>');
		else {
			var dataString = 'code='+ encodeURIComponent(code) + '&dir=' + encodeURIComponent(dir) + '&codeFileName=' + encodeURIComponent(codeFileName) + '&inputFile=' + encodeURIComponent(input) + '&outputFile=' + encodeURIComponent(outputFile) + '&testcaseDir=' + testcaseDir + '&language=' + encodeURIComponent(language);
			$.ajax({
				type: "POST",
				url: MAIN_URL + "/pages/compile.php",
				data: dataString,
				success: function (msg) {
					$form.find('#compile-output').html(msg);
					if (msg.indexOf('Percentage of correct tests') != -1) {
						per = msg.split('Percentage of correct tests: ')[1].split('%')[0];
						$form.find('.correct-test-per').val(per);
					} else $form.find('.correct-test-per').val('');
					$form.find('.compile-code-submit').removeClass("disabled");
					$form.find(':submit').removeAttr('disabled');
				},
				error: function (ob,errStr) {
					$form.find('#compile-output').html('');
					$form.find('.compile-code-submit').removeClass("disabled");
				}
			})
		}
		return false
	})
}

$(function () {
	compileCode()
})
