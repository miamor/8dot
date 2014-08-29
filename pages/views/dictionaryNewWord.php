<div id="test"></div>

<style>
.mi-board .main-content{border:0;margin-top:20px;*padding:10px 20px}
.mi-board .row{position:relative;min-height:30px;border:1px solid #f3f3f3!important;margin:1% .5% 2%!important;float:left;width:49%;background:#fff;padding:10px}
.def-tit{font-size:18px;margin-top:-23px;font-family:'CuprumRegular', 'Adobe Caslon Pro'}
.row-def input{width:94%}
.row-def .removeBox{margin-top:14px}
</style>

<?php
	$word = $_GET['word'];
	$lang = $_GET['lang'];
		if ($_GET['act'] == 'submit') {
			$tWord = $_POST['word'];
			if (!$tWord) $tWord = $_POST['word-hidden'];
			$tLang = $_POST['lang'];
			if (!$tLang) $tLang = $_POST['lang-hidden'];
			$tEg = (nl2br($_POST['example']));
			$array = array();
			for ($i = 0; $i <= 100; $i++) {
				if ($_POST['v-eg'.$i]) $vEg = _content($_POST['v-eg'.$i]);
				$nEg = _content($_POST['n-eg'.$i]);
				$adjEg = _content($_POST['adj-eg'.$i]);
				$advEg = _content($_POST['adv-eg'.$i]);
				$tDef = array();
				if ($_POST['v'.$i]) {
					if ($_POST['v-eg'.$i]) $tDef[] = '<li class="verb" data-sid="1"><i>(verb)</i> <b>'.$_POST['v'.$i].'</b>'.$vEg.'</li>';
					else $tDef[] = '<li class="verb" data-sid="1"><i>(verb)</i> <b>'.$_POST['v'.$i].'</b></li>';
				}
				if ($_POST['n'.$i]) {
					if ($_POST['n-eg'.$i]) $tDef[] = '<li class="noun" data-sid="2"><i>(noun)</i> <b>'.$_POST['n'.$i].'</b>'.$nEg.'</li>';
					else $tDef[] = '<li class="noun" data-sid="2"><i>(noun)</i> <b>'.$_POST['n'.$i].'</b></li>';
				}
				if ($_POST['adj'.$i]) {
					if ($_POST['adj-eg'.$i]) $tDef[] = '<li class="adj" data-sid="3"><i>(adj)</i> <b>'.$_POST['adj'.$i].'</b>'.$adjEg.'</li>';
					else $tDef[] = '<li class="adj" data-sid="3"><i>(adj)</i> <b>'.$_POST['adj'.$i].'</b></li>';
				}
				if ($_POST['adv'.$i]) {
					if ($_POST['v-eg'.$i]) $tDef[] = '<li class="adv" data-sid="4"><i>(adv)</i> <b>'.$_POST['adv'.$i].'</b>'.$advEg.'</li>';
					else $tDef[] = '<li class="adv" data-sid="4"><i>(adv)</i> <b>'.$_POST['adv'.$i].'</b></li>';
				}
				if ($_POST['v'.$i] || $_POST['n'.$i] || $_POST['adj'.$i] ||$_POST['adv'.$i]) {
					array_push($array, $tDef[0]);
				}
			}
			$tDefine = implode(' ', $array);
//			echo $tWord.'~~~'.$tLang.'~~~'.$tDefine;
			if ($tWord && $tLang && $tDefine) {
				if (countRecord("dictionary", "`word` = '$tWord' AND `uid` = '$u'") > 0)
					echo '<div class="alerts alert-error">You\'ve been already created a definition for this word. Please use "edit" feature if you have different ones now.</div>';
				else {
					$add = mysql_query("INSERT INTO `dictionary` (`uid`, `word`, `lang`, `definition`) VALUES ('$u', '$tWord', '$tLang', '$tDefine')");
					if ($add) echo '<div class="alerts alert-success">Submitted successfully.</div>';
					else echo '<div class="alerts alert-error">Something went wrong. Contact the administrators for more details please.</div>';
				}
			} else echo '<div class="alerts alert-error">Please fill in all required (*) fields</div>';
		} else { ?>
		<form action="?do=add&act=submit" method="POST" name="addword" class="addword">
			<div class="mi-board" style="margin-top:-5px">
				<input style="float:right;margin:0px 15px 0 0" type="submit" value="Submit"/>
				<h2 class="main-title" style="margin-left:5px!important">Add new <?php if ($word) echo 'definition'; else echo 'word to open dictionary' ?></h2>
				
				<div style="margin-bottom:7px">
					<input name="word" style="width:65%;margin:5px 0 5px 5px" type="text" placeholder="Word *" <? if ($word) echo 'disabled' ?> value="<?php echo $word ?>"/>
					<input name="word-hidden" type="hidden" value="<?php echo $word ?>"/>
					<input name="lang-hidden" type="hidden" value="<?php echo $lang ?>"/>
					<div class="word-type right" style="margin-top:12px">
						<label class="checkbox">
							<input id="verb" type="checkbox" name="v"> <label for="verb">Verb</label>
						</label>
						<label class="checkbox">
							<input id="noun" type="checkbox" name="n"> <label for="noun">Noun</label>
						</label>
						<label class="checkbox">
							<input id="adj" type="checkbox" name="adj"> <label for="adj">Adj</label>
						</label>
						<label class="checkbox">
							<input id="adv" type="checkbox" name="adv"> <label for="adv">Adv</label>
						</label>
					</div>
				</div>
						<label class="radio primary">
							<input type="radio" name="lang" tabindex="1" <? if ($lang) echo 'disabled '; if (!$lang || $lang == 'en-en') echo 'checked' ?> value="en-en"> English - English
						</label>
						<label class="radio primary">
							<input type="radio" name="lang" tabindex="2" <? if ($lang) echo 'disabled '; if ($lang == 'en-vi') echo 'checked' ?> value="en-vi"> English - Vietnamese
						</label>
						<label class="radio primary">
							<input type="radio" name="lang" tabindex="3" <? if ($lang) echo 'disabled '; if ($lang == 'vi-en') echo 'checked' ?> value="vi-en"> Vietnamese - English
						</label>
						<label class="radio primary">
							<input type="radio" name="lang" tabindex="4" <? if ($lang) echo 'disabled '; if ($lang == 'fr-en') echo 'checked' ?> value="fr-en"> France - English
						</label>
					<div class="clearfix"></div>
				<div class="main-content">
					<div class="row row-def v-define" alt="v" style="display:none">
						<div class="def-tit">Verb definition
							<img class="addBox" style="cursor:pointer" src="<?php echo silk ?>/add.png"/>
						</div>
					</div>
					<div class="row row-def n-define" alt="n" style="display:none">
						<div class="def-tit">Noun definition
							<img class="addBox" style="cursor:pointer" src="<?php echo silk ?>/add.png"/>
						</div>
					</div>
					<div class="row row-def adj-define" alt="adj" style="display:none">
						<div class="def-tit">Adj definition
							<img class="addBox" style="cursor:pointer" src="<?php echo silk ?>/add.png"/>
						</div>
					</div>
					<div class="row row-def adv-define" alt="adv" style="display:none">
						<div class="def-tit">Adv definition
							<img class="addBox" style="cursor:pointer" src="<?php echo silk ?>/add.png"/>
						</div>
					</div>
				</div>
			</div>
		</form>
<?php	} ?>

<script src="<?php echo JS ?>/dictionaryNewWord.js"></script>
