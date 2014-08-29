<?php include 'views/commentCore.php' ?>

<div id="m_tab" class="comment-board">
	<div class="m_tab" style="padding-left:20px">
<? if ($tb =='lesson_cmt') { ?>
		<div class="right normal-cmt minibutton button-remark button-remark-comments" style="display:none">Comment</div>
		<div class="right ask-lesson minibutton button-remark button-remark-comments">Ask</div>
		<div class="tab active" id="l-quest" title="Order by most likes and submitted time" onclick="$('.comment-board .button-remark').toggle()">
			Quests
			(<b class="l-quest_num"><span><?php echo countRecord("$tb", "`iid` = '$vl' AND `type` = 'quest' ") ?></span></b>)
		</div>
		<div class="tab" id="cmt" title="Order by most likes and submitted time" onclick="$('.comment-board .button-remark').toggle()">
			Comments
			(<b class="cmt_num"><span><?php echo countRecord("$tb", "`iid` = '$vl' AND `type` != 'quest' ") ?></span></b>)
		</div>
<? } else { ?>
		<div class="right fui-chat minibutton button-remark button-remark-comments">
			<?php if ($tb == 'quest_cmt') echo 'Answer';
				else echo 'Comment' ?>
		</div>
		<div class="tab active" id="cmt" title="Order by most likes and submitted time">
			<?php if ($tb == 'quest_cmt') echo 'Answers';
				else echo 'Comments' ?>
			(<b class="cmt_num"><span><?php echo countRecord("$tb", "`iid` = '$vl'") ?></span></b>)
		</div>
<? } ?>
	</div>

<? if ($tb == 'lesson_cmt') { ?>
	<div id="coms" class="tab-index l-quest">
		<?php $tbl = $tb; $orderr = ''; $condii = "AND `type` = 'quest' ";
		include 'commentRead.php' ?>
	</div>
	<div id="coms" class="hide tab-index cmt">
		<?php $tbl = $tb; $orderr = ''; $condii = "AND `type` != 'quest' ";
		include 'commentRead.php' ?>
	</div>
<? } else { ?>
	<div id="coms" class="tab-index cmt">
		<?php $tbl = $tb; $condii = '';
			if ($tb == 'quest_cmt') $orderr = "`solve` DESC, `like` DESC, `dislike` ASC, `id` DESC";
			else if ($tb == 'ex_cmt') $orderr = "`like` DESC, `dislike` ASC, `id` DESC";
			else $orderr = '';
		include 'commentRead.php' ?>
	</div>
<? } ?>
</div>
