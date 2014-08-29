<?php if ($u) { ?>
<form class="<?php echo $vl ?>" alt="0" data-type="<?php echo $ttyp ?>" data-page="<?php echo $pagg ?>" id="comments" method="post" data-action="<?php echo "$ttyp=$vl" ?>" data-post-type="cmt" style="display:none">
	<textarea class="summernote-sms" name="comment" id="textarea" style="width:100%;height:140px" placeholder="Content *"></textarea>
	<div class="alerts alert-info left" style="margin-top:15px">Add comment<i style="font-size:10px;font-weight:400" class="traloicua"></i> <a href="javascript:void()" onclick="cancel()" id="cancel" title="Hủy trả lời bình luận" style="display:none"><img src="<?php echo $imgdir ?>/Close_icon.gif" width="15px" style="margin-bottom:-3px"/></a> </div>
	<input type="submit" name="submit" style="float:right;margin:15px 10px 0 0" value="Send" title="Send"/>
</form>

<div class="clearfix"></div>

<div id="edits"></div><div id="test"></div>
<?php } else { ?>
	<div class="alerts alert-error">You must <a href="#!login">login</a> or <a href="#!register">register</a> to add comment</div>
<?php } ?>

<?php include 'system/comment.php' ?>


<?php if ($_GET['mode'] == "edit") {
		$cmi = $_GET['cmt'];
		$cmS = getRecord($tb, "`id` = '$cmi'");
		$cont = $cmS['content'];
		$cOm = (_content($_POST['edit'])); ?>

<form class="<?php echo $vl ?>" alt="<?php echo $cmi ?>" id="edit" style="margin-top:20px;<?php if ($l) echo 'width:calc(100% - 275px)'?>" method="post">
<textarea name="edit" id="textareas" style="width:100%!important;height:180px" placeholder="Text your comment...">
<?php echo $cmS['content'] ?></textarea>
	<div class="alerts alert-info left" style="margin-top:15px">Edit <a class="switch-cmt fa fa-exchange"></a></div>
<input type="submit" name="submit" style="float:right;margin:15px 10px 0 0" value="Submit" title="Submit">
</form>

<?php if ( $_GET['act'] == 'do' ) {
		mysql_query("UPDATE `$tb` SET `content` = '".$cOm."' WHERE `id` = $cmi");
	}
} ?>
	
	<script type="text/javascript" src="<?php echo JS ?>/comment.js"></script>
