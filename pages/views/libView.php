<?php $like = countRecord($votetb, "`iid` = '$vl' AND `type` = 'like'");
$dislike = countRecord($votetb, "`iid` = '$vl' AND `type` = 'dislike'");
$vote = $like - $dislike;
$star = countRecord($startb, "`iid` = '$vl'");
if ($libInfo['title'] == 'none' || !$libInfo['title']) $ltite = '<span class="prefix prefix-title prefix-red">None title</span>';
else $ltite = $libInfo['title'];
$avai = $libInfo['available'];
if ($typ == 'ex') $content = $libInfo['quest'];
else $content = $libInfo['content'];
if ($typ == 'ex') {
	if ($_GET['auth']) {
		$au = $_GET['auth'];
		$auInfo = getRecord('ex_solution', "`id` = '$au' ");
		if ($u == $libInfo['uid'] && $u != $auInfo['uid']) authSolution($au);
	}
	if ($_GET['go'] == 'submit') {
		if ($_GET['do'] == 'addsolution') {
			$mySolu = _content($_POST['my-solution']);
			if ($mySolu && countRecord('ex_solution', "`content` = '$mySolu' AND `iid` = '$vl'") <= 0) {
				$add = mysql_query("INSERT INTO `ex_solution` (`uid`, `iid`, `content`, `time`) VALUES ('$u', '$vl', '$mySolu', '$current')");
				if ($add) {
					if ($libInfo['uid'] == $u) changeValue('ex_solution', "`uid` = '$u' AND `iid` = '$vl'", "`authenticate` = 'yes'");
					else sendNoti('ex-add-solution', '', $vl, $libInfo['uid']);
				}
//				mysql_query("UPDATE `ex_solution` SET `authenticate` = 'yes' WHERE `uid` = '$u'");
			}
		} else if ($_GET['do'] == 'editmysolution') {
			$mmi = $_GET['mS'];
			$mSi = getRecord('ex_solution', "`id` = '$mmi' ");
			$mySolu = _content($_POST['edit-solution-'.$mmi]);
			echo $mySolu;
			if ($mSi['uid'] == $u) changeValue('ex_solution', "`id` = '$mmi' ", "`content` = '$mySolu' ");
		}
	}
	if ($_GET['solution'] && $_GET['do'] == 'star') {
		starSolution($_GET['solution']);
	}
	if ($_GET['do'] == 'updateresult') {
		$result = $_POST['result-field'];
		changeValue('ex', "`id` = '$e' ", "`result` = '$result' ");
	}
} ?>

<div class="right" id="q<?php echo $vl ?>"><span>
	<?php if (countRecord($votetb, "`iid` = '$vl' AND `type` = 'like' AND `uid` = '$u'") > 0) { ?>
		<a class="iic vote vote-up-on" data-href="act=like"></a>
	<?php } else { ?>
		<a class="iic vote vote-up-off" data-href="act=like"></a>
	<?php } ?>
		<div align="center" class="vote-count"><?php echo $vote ?></div>
	<?php if (countRecord($votetb, "`iid` = '$vl' AND `type` = 'dislike' AND `uid` = '$u'") > 0) {?>
		<a class="iic vote vote-down-on" data-href="act=dislike"></a>
	<?php } else { ?>
		<a class="iic vote vote-down-off" data-href="act=dislike"></a>
	<?php } ?>

	<?php if (countRecord($startb, "`iid` = '$vl' AND `uid` = '$u'") > 0 || $libInfo['uid'] == $u) { ?>
		<a class="iic star star-on" id="add" <?php if ($libInfo['uid'] != $u) echo 'data-href="act=star"' ?>></a>
		<div class="favoritecount selected" align="center"><b><?php echo $star ?></b></div>
	<?php } else if ($libInfo['uid'] != $u) { ?>
		<a class="iic star star-off" id="add" data-href="act=star"></a>
		<div class="favoritecount off" align="center"><b><?php echo $star ?></b></div>
	<?php } ?>
	<?php if ($libInfo['coin'] != 0) echo '<div class="lib-extra-coin" title="Extra coins for solving this problem"><img src="'.silk.'/coins_add.png"/> <b>'.$libInfo['coin'].'</b></div>' ?>
</span></div>

<div class="borderwrap <?php if ($libInfo['solve'] == 'solve') echo 'solved'; if ($u == $libInfo['uid'] /*|| countRecord($startb, "`uid` = '$u' AND `iid` = '{$qList['id']}'") > 0*/ ) echo ' stared'; if ($u != $libInfo['uid'] && countRecord($typ.'_cmt', "`uid` = '$u' AND `iid` = '{$libInfo['id']}'") > 0 ) echo ' joined' ?>" id="readme" style="margin-right:50px">
	<span class="icon dogear"></span>
	<div class="name">
		<div class="dott dot-<?php echo $dInfo['re'] ?>" alt="<?php echo $dInfo['id'] ?>" title="Dot <?php echo $dInfo['title'] ?>"><span class="dot-color" style="background:<?php echo $dInfo['color'] ?>"></span></div>
		<?php echo $ltite ?>
		<span style="margin-top:2px" class="right label label-<?php if ($avai == 'students') echo 'info'; else if ($avai == 'teachers') echo 'danger'; else echo 'primary' ?> capitalize"><?php echo $avai ?></span>
<!--		<div class="right gensmall" style="margin:-2px 10px 0"><i class="fa fa-clock-o"></i> <?php echo $libInfo['time'] ?></div> -->
	</div>
	<div class="plain" style="min-height:55px">
		<div class="solve-icon"></div>
	<?php echo $content;
		if ($typ == 'doc') {
			echo '<iframe class="iframe-document" src="'.PLUGINS.'/pdf-viewer/web/viewer.php?url='.$libInfo['frame'].'"></iframe>';
		}
		if ($typ == 'ex') {
			echo '<div class="ex-result">';
			if ($libInfo['type'] == 'test') {
				echo '<div><hr/>';
				if ($u == $libInfo['uid'] || $member['admin'] == 'admin') echo '<a class="fa fa-edit update-result right" style="margin-top:8px" title="Update result"></a>';
				echo '<div class="final-result">';
				$exChoii = explode('|', $libInfo['choices']);
				for ($j = 0; $j < count($exChoii); $j++) {
					echo '<label class="radio primary" for="option'.$j.$libInfo['id'].'"><input type="radio" id="option'.$j.$libInfo['id'].'" disabled ';
					if ($exChoii[$j] == $libInfo['result']) echo 'checked ';
					echo 'name="result'.$libInfo['id'].'"/> '.$exChoii[$j].'</label>';
				}
				echo '</div>';
				
				echo '<form class="result-edit hide">';
					$exChoii = explode('|', $libInfo['choices']);
					for ($j = 0; $j < count($exChoii); $j++) {
						echo '<label class="radio" for="option'.$j.$libInfo['id'].'"><input type="radio" id="option'.$j.$libInfo['id'].'" value="'.$exChoii[$j].'" ';
						if ($exChoii[$j] == $libInfo['result']) echo 'checked ';
						echo 'name="result-field" /> '.$exChoii[$j].'</label>';
					}
					echo '<input type="Submit" value="Submit" style="position:absolute;right:5px;margin-top:-5px"/>';
				echo '</form>
				</div>';
			} else if ($libInfo['result']) {
				echo '<div class="right">';
				if ($u == $libInfo['uid'] || $member['admin'] == 'admin') {
					echo '<a class="fa fa-edit update-result sb-open" id="edit-result" style="margin-top:-2px;margin-right:3px" title="Update result"></a>';
					echo '<form class="result-edit hide">';
						echo '<input type="text" name="result-field" value="'.$libInfo['result'].'"/>';
					echo '</form>';
				}
				echo '<span class="label label-info final-result" title="Result">'.$libInfo['result'].'</span>';
				echo '</div>';
			}
			echo '</div>';
			echo '<hr/><div class="main-solution"><b>Solution <a class="fa fa-edit add-new-solution" alt="'.$libInfo['type'].'" style="display:none" title="Add a solution"></a></b> ';

			if ($dInfo['type'] == 'program') {
				$tskeSampleFile = MAIN_PATH.$libInfo['answer'];
				$eSampleCode = '';
				$eSpOp = fopen($tskeSampleFile, 'r');
				while ($spcodeline = fgets($eSpOp)) $eSampleCode .= $spcodeline;
				fclose($eSpOp);
				$sCha = array('<', '>');
				$rCha   = array('&lt;', '&gt;');
				$eSampleCode = str_replace($sCha, $rCha, $eSampleCode);
				echo '<code>'.$eSampleCode.'</code>';
			} else echo $libInfo['answer'];

			echo '</div>' ?>
			<div class="test-solution">
				<form class="add-solution hide" method="post" <? if ($libInfo['type'] == 'program') echo 'style="margin-bottom:10px"' ?>>
				<? if ($libInfo['type'] == 'program') { ?>
<!--				<textarea name="my-solution" class="textarea-add-my-solution non-sce" style="height:130px"></textarea>
				<div id="ace-editor" style="width:100%;height:200px">#include <iostream>

using namespace std;

int main() {
   cout << "Hello World" << endl; 
   
   return 0;
}</div> -->
					<textarea name="my-solution" class="textarea-add-my-solution dafuk" style="height:130px"></textarea>
				<? } else echo '<textarea name="my-solution" class="textarea-add-my-solution dafuk" style="height:130px"></textarea>' ?>
				<input type="submit" value="Submit" style="margin-left:7px"/><input type="reset" value="Reset" style="margin:-1px 15px -1px -1px"/> <i class="gensmall">Adding new solution <a class="fa fa-times-circle close-add-new-solution" title="Close"></a></i></form>
			</div>
			<? if ($libInfo['type'] == 'program') {
				if ($libInput['input'] || $libInfo['output']) {
					$eInput = file_get_contents(MAIN_PATH.$libInfo['input']);
					$eOutput = file_get_contents(MAIN_PATH.$libInfo['output']);
					echo '<div class="main-test-case">
						<div class="s-input left"><h4>Input</h4><div class="m-input">'.$eInput.'</div></div>
						<div class="s-output right"><h4>Output</h4><div class="m-output">'.$eOutput.'</div></div>
						<div class="clearfix"></div>
					</div>';
				}
				if ($libInfo['testcase']) {
					$testcasePath = MAIN_PATH.$libInfo['testcase'];
					$testcaseInputPath = $testcasePath.'input/';
					$testcaseOutputPath = $testcasePath.'output/';
					$blacklist = array('.', '..');
					echo '<div class="more-test-case">
						<h3>More test case</h3>
							<div class="s-input left">
								<h4>Input</h4>';
								$inputFiles = 0;
								$mInputListFiles = array();
								if ($handle = opendir($testcaseInputPath)) {
									while (false !== ($file = readdir($handle))) {
										if (!in_array($file, $blacklist)) {
											$inputFiles++;
											$mInputListFiles[] = $file;
										}
									}
									closedir($handle);
									sort($mInputListFiles);
									foreach($mInputListFiles as $file) {
										$etInput = '';
										$etInputFile = fopen($testcaseInputPath.$file, 'r');
										while ($tinputline = fgets($etInputFile)) $etInput .= $tinputline;
										fclose($etInputFile);
										echo '<div class="m-input">'.$etInput.'</div>';
									}
								}
						echo '	</div>
							<div class="s-output right">
								<h4>Output</h4>';
								$outputFiles = 0;
								$mOutputListFiles = array();
								if ($handle = opendir($testcaseOutputPath)) {
									while (false !== ($file = readdir($handle))) {
										if (!in_array($file, $blacklist)) {
											$outputFiles++;
											$mOutputListFiles[] = $file;
										}
									}
									closedir($handle);
									sort($mOutputListFiles);
									foreach($mOutputListFiles as $file) {
										$etOutput = '';
										$etOutputFile = fopen($testcaseOutputPath.$file, 'r');
										while ($toutputline = fgets($etOutputFile)) $etOutput .= $toutputline;
										fclose($etOutputFile);
										echo '<div class="m-output">'.$etOutput.'</div>';
									}
								}
					echo '</div>';
					echo '<div class="clearfix"></div>
					</div>';
				}
			} ?>
		<? } ?>
	</div>
	<div class="more-solution-list">
<?php  if ($typ == 'ex') {
		$mS = $getRecord -> GET('ex_solution', "`iid` = '$vl'", '', '');
		foreach ($mS as $mS) {
			$mSu = getRecord('members', "`id` = '{$mS['uid']}'");
			echo '<div class="more-solution" id="sol-'.$mS['id'].'">';
			if ($u == $mS['uid']) echo '<a class="e-my-solution fa fa-edit" style="display:none" id="'.$mS['id'].'" alt="'.$libInfo['type'].'"></a>';
			
			if ($libInfo['uid'] == $u) {
				if ($mS['uid'] != $u) {
					if ($mS['authenticate'] == 'yes') echo '<span class="fa fa-check-circle auth to-auth authed" title="Deauthenticate this solution"></span>';
					else echo '<span class="fa fa-check-circle auth to-auth" title="Authenticate this solution" style="display:none"></span>';
				} else echo '<span class="fa fa-check-circle auth authed" title="Authenticated"></span> ';
			} else {
				if ($mS['authenticate'] == 'yes') echo '<span class="fa fa-check-circle auth authed" title="Authenticated by the author"></span> ';
			}
			
			echo '<div class="star-solution right"><span>';
			if (check($mS['star_list'], "|$u|") > 0) echo ' <span class="fa fa-star star stared"></span> '.$mS['star'];
			else echo ' <span class="fa fa-star-o star"></span> '.$mS['star'];
			echo '</span></div>';
			
			echo '<div class="solution-toggle"><a href="#!user?u='.$mS['uid'].'"><img style="height:26px;width:26px;border:1px solid #f3f3f3;border-radius:100%" src="'.$mSu['avatar'].'"/> '.$mSu['username'].'</a> added a solution.';
				echo '<span class="gensmall right" style="margin-top:2px"><i class="fa fa-clock-o"></i> '.$mS['time'].'</span>
			</div>';
			echo '<div class="more-solution-detail hide" id="s'.$mS['id'].'"><div>';
				if ($_GET['do'] == 'editmysolution') {
					echo '<form class="edit-my-solution" method="post"><textarea name="edit-solution-'.$mS['id'].'" class="dafuk" style="height:190px">'.$mS['content'].'</textarea>
						<i class="gensmall left" style="margin:10px 20px 0">Edit your solution <a class="fa fa-times-circle close-edit-my-solution" title="Close"></a></i>
						<div align="right" style="margin:5px 0 -4px"><input type="submit" value="Submit" style="margin-left:7px"/></div></form>';
				} else echo $mS['content'];
			echo '</div></div>';
			echo '</div>';
		}
	} ?>
	</div>
</div>

<div class="lib-auth-view-info right">
	<div class="gensmall">Submitted <span class="fa fa-clock-o"></span> <?php echo $libInfo['time'] ?></div>
	<a href="#!user?u=<?php echo $libInfo['uid'] ?>">
		<img class="lib-auth-thumbnai left" src="<?php echo $auth['avatar'] ?>"/>
		<?php echo $auth['username'] ?>
	</a>
	<div class="more-auth-info">
		<b><img src="<?php echo IMG ?>/ense110.png"/> <?php echo $auth['coin'] ?></b>
		<b><img src="<?php echo IMG ?>/table_10.png"/> <?php echo $auth['reputation'] ?></b>
	</div>
</div>

<div class="more-info">
		<?php for ($i = 0; $i < count($tidList); $i++) {
				$tInfo = getRecord('topic', "`id` = '{$tidList[$i]}'") ?>
			<a class="item-topic-one border-radius" style="color:<?php echo $dInfo['color'] ?>">
				<div class="dott dot-<?php echo $dInfo['re'] ?>" alt="<?php echo $dInfo['id'] ?>" title="Dot <?php echo $dInfo['title'] ?>"><span class="dot-color" style="background:<?php echo $dInfo['color'] ?>"></span></div>
			<?php echo $tInfo['title'] ?></a>
		<?php } ?>
</div>

<!-- <div class="lib-privacy"><i class="fa fa-lock"></i> Privacy: <span class="capitalize"><?php echo $libInfo['available'] ?></span></div> -->

<div class="clearfix"></div>

<div class="comment-bod" style="margin:60px 0 0">
	<?php $tb = $tbcmt = $typ.'_cmt'; $ttyp = 'q';
		if ($typ == 'ex') $pagg = 'exercise';
		else if ($typ == 'doc') $pagg = 'document';
		else $pagg = $typ ?>
	<?php include 'views/Comment.php' ?>
</div>

<?php if ($typ == 'ex') echo '<script src="'.JS.'/ex.js"></script>' ?>
