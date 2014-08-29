<?php include '../lib/config.php' ?>
<div class="lock-screen">
		<div class="login-header dark text-center">
			<img src="assets/img/logo-login.png" class="logo" alt="Logo">
		</div>
		<div class="login-wrapper">
			<form role="form" action="<?php echo MAIN_URL ?>">
				<div class="form-group text-center">
					<img src="<?php echo $member['avatar'] ?>" class="avatar-lock img-circle" alt="Avatar">
				</div>
				<div class="form-group">
					<h4 class="text-center"><strong><?php echo $member['username'] ?></strong></h4>
				</div>
				<div class="form-group has-feedback lg left-feedback no-label">
					<input type="password" class="form-control no-border input-lg rounded" placeholder="Enter password" autofocus>
					<span class="fa fa-unlock form-control-feedback"></span>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block">LOGIN</button>
				</div>
			</form>
			<p class="text-center"><strong><a href="login.html">Logout</a></strong></p>
		</div><!-- /.login-wrapper -->
		<!--
		===========================================================
		END PAGE
		===========================================================
		-->
		<div class="backstretch" style="left: 0px; top: 0px; overflow: hidden; margin: 0px; padding: 0px; height: 100%; width: 100%; z-index: -999999; position: fixed;"><img style="position: absolute; margin: 0px; padding: 0px; border: none; width: 100%; height: 100%; max-height: none; max-width: none; z-index: -999999; left: 0px; top: 0;" src="assets/img/photo/large/img-14.jpg"></div>
		<style>body{overflow:hidden}</style>
</div>
