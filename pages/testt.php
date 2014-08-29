<? include '../lib/config.php' ?>

<div id="ace-editor" style="width:100%;height:200px">// Add your results code here. See examples below.
// Use [{quest num} - {Result}] for one question result code.
// Seperate 2 result code with comma (,)

[1 - B], [2 - A],[3 - C],
[4 - E], // You can add comments here by using '//'
[5 - {Words with space}]</div>


<script>
$.getScript(PLUGINS + '/ace/src/ace.js', function () {
	$.when(
		$.getScript(PLUGINS + '/ace/src/mode-javascript.js'),
		$.getScript(PLUGINS + '/ace/src/theme-twilight.js'),
		$.Deferred(function(deferred) {
			$(deferred.resolve)
		})
	).done(function() {
		var ace_editor = ace.edit('ace-editor');
		var js_mode = require('ace/mode/javascript').Mode;
//		var theme = require('ace/theme/twilight').Theme;
		ace_editor.setTheme("ace/theme/twilight");
		ace_editor.getSession().setMode(new js_mode());
	});
});
</script>

