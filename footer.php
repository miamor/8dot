				</div><!-- /.container-fluid -->

				<div style="clear:both"></div>
				
				<div class="footer">Copyrights here</div>

			</div><!-- /.page-content -->
		</div><!-- /.wrapper -->
		<!-- END PAGE CONTENT -->
		

		<!-- JQUERY (REQUIRED ALL PAGE)-->
		<script src="<?php echo JQUERY ?>/jquery-1.7.2.min.js"></script>
		<script src="<?php echo JQUERY ?>/jquery-ui-1.10.4.js"></script>
		<!-- SCROLL JS -->
		<script src="assets/plugins/nicescroll/jquery.nicescroll.js"></script>
		<!-- BOOTSTRAP JS -->
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- CHOOSEN (SELECT) -->
		<script src="assets/plugins/chosen/chosen.jquery.min.js"></script>
		<!-- FLAT UI -->
		<script src="assets/plugins/flat-ui/js/flatui-checkbox.js"></script>
		<script src="assets/plugins/flat-ui/js/flatui-radio.js"></script>
		<!-- PLUGINS -->
<!--		Set in lesson page only
		<script src="assets/plugins/fancybox/fancybox.js"></script> -->
<!--		<script src="<? echo PLUGINS ?>/colorbox/jquery.colorbox.js"></script> -->
		<!-- MAIN APPS JS -->
		<script src="assets/js/main.js"></script>
		<script src="assets/js/checkValidNew.js"></script>
		<script src="assets/plugins/sceditor/minified/jquery.sceditor.js"></script>
		
<script> var emoticonsList = {
			dropdown: {<?php echo emoTextareaDropdown() ?>},
			more: {<?php echo emoTextareaMore() ?>}
		};
function sce() {
	$("textarea").not('.dafuk, .no-toolbar, .dafukk, .text-square textarea, .add-comment-line textarea, .non-sce, .ace_text-input').sceditor({
		emoticons: emoticonsList
	});
	$('.no-toolbar').sceditor({
		toolbar: '',
		emoticons: emoticonsList
	});
	$('.dafuk').sceditor({
		toolbar: 'bold,italic,underline|font,size,color,bulletlist,orderedlist|table,code,quote,emoticon|source',
		emoticons: emoticonsList
	});
	$('.dafukk').sceditor({
		toolbar: 'bold,italic,underline|font,size,color,bulletlist,orderedlist|table,quote,emoticon',
		emoticons: emoticonsList
	});
	$('.add-comment-line textarea').sceditor({
		toolbar: 'bold,italic,underline|font,size,color,bulletlist,orderedlist|code,quote|source'
	});
}
function seditor() {
	$('#update_stt').sceditor({
		toolbar: 'bold,italic,underline|quote,emoticon,font,size,color|source',
		emoticons: emoticonsList
	})
}
</script>
		<div class="custom-menu hide">
			<div><a>Custom menu 1</a></div>
			<div><a>Custom menu 2</a></div>
			<div><a>Custom menu 3</a></div>
			<div><a>Custom menu 4</a></div>
			<div><a>Custom menu 5</a></div>
			<hr/>
			<div><a>Custom menu 1</a></div>
			<div><a>Custom menu 2</a></div>
			<div><a>Custom menu 3</a></div>
		</div>
	</body>
</html>
