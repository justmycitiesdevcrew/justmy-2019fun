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
				<div class="col-md-10 offset-md-1">
				<h4>SIGN UP TO YOUR ACCOUNT</h4>
				<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#personal">Personal Account<br><span>I am looking a job</span></a></li>
				<li class="nav-item"><a class="nav-link" data-toggle="tab" href="#company">Company Account<br><span>We are heiring Employees</span></a></li>
               </ul>
			    <div class="tab-content">
				 <div id="personal" class="tab-pane active">
				<div class="login_form">
				<div class="card">
				<div class="card-body">
				<form>
				<div class="row">
				<div class="col-md-6">
			<div class="cfield">
				<input type="text" placeholder="Username">
				<i class="fa fa-user-o" aria-hidden="true"></i>		
				</div>
				</div>
				<div class="col-md-6">
			<div class="cfield">
				<input type="text" placeholder="Mobile">
				<i class="fa fa-mobile" aria-hidden="true"></i>		
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
			<div class="cfield">
				<input type="text" placeholder="Email">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>		
				</div>
				</div>
				<div class="col-md-6">
		<div class="dropdown-field">
				<select data-placeholder="Please Select Specialism" class="chosen" style="display: none;">
					<option>--Select City--</option>
					<option>New Delhi</option>
					<option>Punjab</option>
					<option>Haryana</option>
				</select>
			</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
			<div class="cfield">
				<input type="password" placeholder="********">
				<i class="fa fa-key" aria-hidden="true"></i>		
				</div>
				</div>
				<div class="col-md-6">
				<div id="file_select_button">
					<div id="uploadifive-file_upload" class="uploadifive-button upload_button" style="height: 30px; line-height: 30px; overflow: hidden; position: relative; text-align: center; width: 100px;"><span class="select_files_button_text"><i class="fa fa-cloud-upload" aria-hidden="true" style="    position: relative;
    color: white;
    top: 0;"></i>  Upload Resume</span><input id="file_upload" name="file_upload[]" type="file" multiple="true" style="visibility: hidden;"><input type="file" style="opacity: 0; position: absolute; z-index: 999; left: -16.5px; top: -3px;" multiple="multiple"></div><span style="    color: white;
    font-size: 10px;
    display: block;
    margin-top: -12px;">DOC, DOCS, RTF, PDF - 300kb MAX</span>
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-12">
				<div class="col-md-8 offset-md-2">
			<p class="remember-label">
				<input type="checkbox" name="cb" id="cb1"><label for="cb1">I agreed to the <a href="#">Terms and conditions</a> governing the use of jobportal.</label>
			</p>
			<div class="awe_btn">
			<input type="submit" value="SIGN UP"></div>
			</div>
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
				<div id="company" class="tab-pane fade">
				<div class="login_form">
				<div class="card">
				<div class="card-body">
				<form>
				<div class="row">
				<div class="col-md-6">
			<div class="cfield">
				<input type="text" placeholder="Username">
				<i class="fa fa-user-o" aria-hidden="true"></i>		
				</div>
				</div>
				<div class="col-md-6">
			<div class="cfield">
				<input type="text" placeholder="Company Name">
				<i class="fa fa-mobile" aria-hidden="true"></i>		
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
			<div class="cfield">
				<input type="text" placeholder="Email">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>		
				</div>
				</div>
				<div class="col-md-6">
		<div class="cfield">
				<input type="text" placeholder="Vat No.">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>		
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
			<div class="cfield">
				<input type="password" placeholder="Password">
				<i class="fa fa-key" aria-hidden="true"></i>		
				</div>
				</div>
				<div class="col-md-6">
				<div class="cfield">
				<input type="password" placeholder="Re-enter Password">
				<i class="fa fa-key" aria-hidden="true"></i>		
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
			<div class="cfield">
				<input type="text" placeholder="Website URL">
				<i class="fa fa-key" aria-hidden="true"></i>		
				</div>
				</div>
				<div class="col-md-6">
				<div class="cfield">
				<input type="password" placeholder="Address">
				<i class="fa fa-key" aria-hidden="true"></i>		
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-12">
				<div class="col-md-8 offset-md-2">
			<p class="remember-label">
				<input type="checkbox" name="cb" id="cb1"><label for="cb1">I agreed to the <a href="#">Terms and conditions</a> governing the use of jobportal.</label>
			</p>
			<div class="awe_btn">
			<input type="submit" value="SIGN UP"></div>
			</div>
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
	</div>
	</section>

	<?php require("footer.php");?>

</div>

<?php require("script.php");?>

</body>

</html>

