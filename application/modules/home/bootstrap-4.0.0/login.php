<!DOCTYPE html>
<html>
<head>
	<?php require("css_files.php");?>
    <link href="bootstrap-4.0.0/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="page-loading">
	<img src="images/loader.gif" alt="" />
</div>

<div class="theme-layout" id="scrollup">
	<?php require("mobile_menu.php");?>
	
	
	<?php require("header.php");?>

	<section id="login_section">
	<div class="bg-overlay"></div>
	<div class="block">
			<div class="container">
				<div class="row">
				<div class="col-md-12">
				<div class="col-md-6 offset-md-3">
				<h4>SIGN IN TO YOUR ACCOUNT</h4>
				<div class="login_form">
				<div class="card">
				<div class="card-body">
				<form>
				<div class="row">
			<div class="col-md-12">
				<input type="text" placeholder="Username">
				<i class="fa fa-user-o" aria-hidden="true"></i>				
				</div>
				</div>
				<div class="row">
			<div class="col-md-12">
				<input type="password" placeholder="********">
				<i class="fa fa-key" aria-hidden="true"></i>	
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
			<p class="remember-label">
				<input type="checkbox" name="cb" id="cb1"><label for="cb1">Keep me sign in</label>
			</p></div>
			<div class="col-md-6"><a href="forget_password.php" title="" class="pull-right">Forget Password?</a></div>
			<div class="col-md-12">
			<div class="awe_btn">
			<input type="submit" value="SIGN IN"></div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
			<p class="remember-label pull-right">Not a member yet ?</p>
			</div>
			<div class="col-md-6">
			<a href="register.php" title="" class="pull-left" style="font-size: 18px;font-weight: 500;">REGISTER NOW</a>
			</div>
			</div>
		</form>
		<div class="extra-login">
									<span>Or</span>
									<div class="login-social">
									<div class="row">
									<div class="col-md-6">
										<a class="fb-login" href="#" title=""><i class="fa fa-facebook"></i> Facebook</a>
										</div>
											<div class="col-md-6">
										<a class="tw-login" href="#" title=""><i class="fa fa-google" aria-hidden="true"></i> Google</a>
										</div>
									</div>
								</div>
								
				</div>
				</div>
				</div>
				</div>
				</div>
				</div>
			</div>
	</div>
	</section>

	<?php require("footer.php");?>

</div>

<?php require("script.php");?>


</body>

</html>

