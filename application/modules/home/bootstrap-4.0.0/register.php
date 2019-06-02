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
<style>
.job_seeker2{
	background-image: linear-gradient(90deg, #cc3300, #d906fa)!important;
}
.job_seeker1{
	
}
.slider_detail{
	font-family: "Times New Roman", Times, serif!important;
}
.slider_detail h2{
	font-family: "Times New Roman", Times, serif!important;
}
.mar-top{
	margin-top:35px;
}
.mar-top1{
	margin-top:70px;
}
</style>
<div class="theme-layout" id="scrollup">
	<?php require("mobile_menu.php");?>
	
	
	<?php require("header.php");?>

	<section id="main_header">
		<div class="block no-padding">
			<div class="container fluid">
				<div class="row">
				<div class="col-md-6 no-padding">
				<div class="job_seeker1">
				<div class="slider_detail">
				<h2>Join as Candidate</h2>
				<p>A job is a regular activity performed in exchange becoming an employee, volunteering.</p>
				<div class="awe_btn">
				<a href="candidate_registration.php">CREATE ACCOUNT</a>
				</div>
				<div class="awe_btn mar-top">
				<a href="#">UPLOAD CV</a>
				</div>
				</div>
				</div>
				</div>
				<div class="middle_or">OR</div>
				<div class="col-md-6 no-padding">
				<div class="job_seeker2">
				<div class="slider_detail">
				<h2>Join as Employer</h2>
				<p>A job is a regular activity performed in exchange becoming an employee, volunteering.</p>
				<div class="awe_btn2 mar-top1">
				<a href="https://abym.in/clientProof/HolisolPeople/HolisolPeople/employee_registration.php">CREATE ACCOUNT</a>
				</div>
				</div>
				</div>
				</div>
						<!--<div class="main-featured-sec">
							<div class="scroll-to">
								<a href="#scroll-here" title=""><i class="fa fa-long-arrow-down" aria-hidden="true"></i></a>
							</div>
						</div>-->
				</div>
			</div>
		</div>
	</section>

	<?php require("footer.php");?>

</div>

<?php require("script.php");?>

</body>

</html>

