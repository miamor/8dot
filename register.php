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
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo IMG ?>/logo_24.png"/>

		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/plugins/flat-ui/css/flat-ui.css"/>
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link rel="stylesheet" href="assets/css/style.css">
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

		<div class="login-wrapper" style="margin-top:170px">
			<form id="login" method="post">
				<div class="form-group has-feedback lg left-feedback no-label">
					<input type="text" class="form-control no-border input-lg rounded" placeholder="Enter username" name="username" autofocus>
					<span class="fa fa-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback lg left-feedback no-label">
					<input type="password" class="form-control no-border input-lg rounded" placeholder="Enter password" name="password">
					<span class="fa fa-unlock-alt form-control-feedback"></span>
				</div>
				<div class="form-group">
					<div class="checkbox">
						<label class="checkbox">
							<input type="checkbox" value="remember"/> Remember me
						</label>
					</div>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block">LOGIN</button>
				</div>
			</form>
			<p class="text-center"><strong><a href="forgot-password.html">Forgot your password?</a></strong></p>
			<p class="text-center">or</p>
			<p class="text-center"><strong><a href="register.html">Create new account</a></strong></p>
		</div><!-- /.login-wrapper -->
<?php }
} else {
	echo '<script>window.location.href = "./"</script>';
} ?>

		<!-- JQUERY (REQUIRED ALL PAGE)-->
		<script src="<?php echo JQUERY ?>/jquery-1.7.2.min.js"></script>
		<script src="<?php echo JQUERY ?>/jquery-ui-1.10.4.js"></script>
		<!-- LOGIN JS -->
		<script src="<?php echo JS ?>/login.js"></script>
		
	</body>
</html>
