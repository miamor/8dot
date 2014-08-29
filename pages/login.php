<?php include '../lib/config.php' ?>
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

<script src="<?php echo JS ?>/login.js"></script>

<div class="front-bg" style="background:#fff url(<?php echo LIB ?>/bg/<?php echo rand(1, 21)?>.jpg);background-size:100% 100%">
</div>
<div class="front-up">
	<div class="welcome_text">
		<div id="check"></div>
		<h1>Welcome to <span style="color:#14ccb3">8</span><span style="color:#75bfff">d</span><span style="color:#ff8b85">o</span><span style="color:#85c6ff">t</span>.</h1>
		<p>Top fashion site.</p>
		<div>More than just fashion. It's passion.</div>
	</div>
	
	<div class="front-side">
	<div class="front-login">
		<form id="login" method="post">
			<input type="text" name="username" tabindex="1" class="text text-input" placeholder="Username" style="width:92%;margin-bottom:5px"><br/>
			<input type="submit" name="submit" tabindex="3" class="btn btn-primary" value="Login" style="float:right;margin:2px">
			<input type="password" name="password" tabindex="2" class="text text-input" placeholder="Password" style="width:67%;margin-bottom:10px">
		</form>
	</div>
	<div class="front-signup">
		<h2>New to Monaic? <span class="small">- Signup now</span></h2>
		<form action="<?php echo MAIN_URL ?>/#!register?act=submit" id="signup" method="post">
			<input type="text" name="username" tabindex="4" class="text text-input" placeholder="Username" style="width:92%;margin-bottom:5px"><br/>
			<input type="email" name="email" tabindex="5" class="text text-input" placeholder="Email" style="width:92%;margin-bottom:5px">
			<input type="submit" name="submit" tabindex="7" class="btn btn-warning button-orange" value="Register" style="float:right;margin:2px">
			<input type="password" name="password" tabindex="6" class="text text-input" placeholder="Password" style="width:60%;margin-bottom:10px">
		</form>
	</div>
	<div class="front-copyright">
		<div class="copyright">
			<div class="c-info">© 2013 bSchool. All rights reserved.
			<a href="<?php echo MAIN_URL ?>/about">About</a> <a href="<?php echo MAIN_URL ?>/help">Help</a> <a href="<?php echo MAIN_URL ?>/terms">Terms</a> <a href="<?php echo MAIN_URL ?>/privacy">Privacy</a>
			<a href="<?php echo MAIN_URL ?>/advertise">Advertise</a> <a href="<?php echo MAIN_URL ?>/resource">Resources</a> <a href="<?php echo MAIN_URL ?>/developers">Developers</a>
			</div>
			<div class="developer"><a href="<?php echo MAIN_URL ?>/user.php?u=1">Miamor West</a></div>
		</div>
	</div>
	</div>
</div>

<style>.page-content{z-index:99999}</style>
<?php
	}
} else {
	echo '<script>window.location.href = "./"</script>';
} ?>
