<?php include 'lib/config.php' ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="description" content="8dot, effective eLearning site">
		<meta name="keywords" content="8dot,eLearning,social">
		<meta name="author" content="Miamor West">
		<title>8dot</title>
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMG ?>/8dot.png"/>

		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/plugins/flat-ui/css/flat-ui.css"/>
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/main.css">
		<link rel="stylesheet" href="assets/css/login.css">
		<!-- FONT CSS -->
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
<? 		echo '<script> var MAIN_URL = "'.MAIN_URL.'"</script>' ?>
	</head>
 
	<body class="tooltips">

<?php if ( !$u ) {
	if ( $_GET['act'] == "login" ) {
		// Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
		$username = addslashes( $_POST['username'] );
		$password = md5( addslashes( $_POST['password'] ) );
		$pass = addslashes( $_POST['password'] );
		// Lấy thông tin của username đã nhập trong table members
		$sql_query = @mysql_query("SELECT * FROM members WHERE username='{$username}'");
		$member = @mysql_fetch_array( $sql_query );
		// Nếu username này không tồn tại thì....
		if ( mysql_num_rows( $sql_query ) <= 0 ) {
			echo 'error';
		}
		// Nếu username này tồn tại thì tiếp tục kiểm tra mật khẩu
		if ( $pass != $member['password'] ) {
			echo 'error';
		}
		// Khởi động phiên làm việc (session)
		$_SESSION['user_id'] = $member['id'];
		$_SESSION['user_admin'] = $member['admin'];
		// Thông báo đăng nhập thành công
		echo $_SESSION['user_id'];
	} else { ?>

<img class="front-bg" src="<?php echo LIB ?>/bg/<?php echo rand(4, 17)?>.jpg" width="100%" height="100%"/>

<div class="front-up">
	<div class="welcome_text">
		<div id="check"></div>
		<h1>Welcome to <span style="color:#14ccb3">8</span><span style="color:#75bfff">d</span><span style="color:#ff8b85">o</span><span style="color:#85c6ff">t</span>.</h1>
		<p>Top fashion site.</p>
		<div>More than just fashion. It's passion.</div>
	</div>
	
	<div class="front-side">
	<div class="front-login front-signin">
		<h2>Already a member?</h2>
		<form id="login" method="post">
			<input type="text" name="username" tabindex="1" class="text text-input" placeholder="Username" style="width:100%;margin-bottom:5px"><br/>
			<input type="submit" name="submit" tabindex="3" class="btn btn-primary" value="Login" style="float:right;margin:2px">
			<input type="password" name="password" tabindex="2" class="text text-input" placeholder="Password" style="width:67%;margin-bottom:10px">
		</form>
	</div>
	<div class="front-signup">
		<h2>New to Monaic? <span class="small">- Signup now</span></h2>
		<form action="<?php echo MAIN_URL ?>/#!register?act=submit" id="signup" method="post">
			<input type="text" name="username" tabindex="4" class="text text-input" placeholder="Username" style="width:100%;margin-bottom:5px"><br/>
			<input type="email" name="email" tabindex="5" class="text text-input" placeholder="Email" style="width:100%;margin-bottom:5px">
			<input type="submit" name="submit" tabindex="7" class="btn btn-warning button-orange" value="Register" style="float:right;margin:2px">
			<input type="password" name="password" tabindex="6" class="text text-input" placeholder="Password" style="width:60%;margin-bottom:10px">
		</form>
	</div>
	<div class="front-copyright">
		<div class="copyright">
			<div class="c-info">© 2013 8dot. All rights reserved.<br/>
			<a href="<?php echo MAIN_URL ?>/about">About</a> <a href="<?php echo MAIN_URL ?>/help">Help</a> <a href="<?php echo MAIN_URL ?>/terms">Terms</a> <a href="<?php echo MAIN_URL ?>/privacy">Privacy</a>
			<a href="<?php echo MAIN_URL ?>/advertise">Advertise</a> <a href="<?php echo MAIN_URL ?>/resource">Resources</a> <a href="<?php echo MAIN_URL ?>/developers">Developers</a>
			</div>
			<div class="developer"><a href="<?php echo MAIN_URL ?>/user.php?u=1">Miamor West</a></div>
		</div>
	</div>
	</div>
</div>

<?php }
} else {
	echo '<script>window.location.href = "./"</script>';
} ?>

		<!-- JQUERY (REQUIRED ALL PAGE)-->
		<script src="<?php echo JQUERY ?>/jquery-1.7.2.min.js"></script>
		<script src="<?php echo JQUERY ?>/jquery-ui-1.10.4.js"></script>
		<!-- LOGIN JS -->
		<script src="<?php echo JS ?>/login.js"></script>

<!--		<div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 100%; width: 100%; z-index: -999999; position: fixed;"><img style="position: absolute; margin: 0px; padding: 0px; border: none; width: 100%; height: 100%; max-height: none; max-width: none; z-index: -999999; left: 0px; top: 0;" src="assets/img/photo/large/img-14.jpg"></div> -->
		
<style>
</style>

	</body>
</html>
