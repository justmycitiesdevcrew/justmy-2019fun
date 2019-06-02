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

	<section id="forget_section">
	<div class="bg-overlay"></div>
	<div class="block">
			<div class="container">
				<div class="row">
				<div class="col-md-12">
				<div class="col-md-6 offset-md-3">
					<h4 style="margin: 30px 0;">FORGET YOUR PASSWORD</h4>
				<div class="login_form">
				<div class="card">
				<div class="card-body">
				<form>
				<div class="row">
			<div class="col-md-12">
				<input type="text" placeholder="Enter your Email Id">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>			
				</div>
				</div>
				<div class="row">
			<div class="col-md-12">
			<div class="awe_btn">
			<input type="submit" value="SUBMIT"></div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
			<p class="remember-label pull-right">Already a member yet ?</p>
			</div>
			<div class="col-md-6">
			<a href="login.php" title="" class="pull-left" style="font-size: 18px;font-weight: 500;">SIGN IN</a>
			</div>
			</div>
		</form>
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

