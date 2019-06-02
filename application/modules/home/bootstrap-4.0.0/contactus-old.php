<!DOCTYPE html>
<html>
<head>
	<?php require("css_files.php");?>
</head>
<body>

<div class="page-loading">
	<img src="images/loader.gif" alt="" />
</div>

<div class="theme-layout" id="scrollup">
	<?php require("mobile_menu.php");?>
	
	
	<?php require("header.php");?>
<section id="inner_header">
<div class="bg-overlay"></div>
<div class="container">
<div class="row">
					<div class="inner2">
							<div class="inner-title2">
								<h3>Contact</h3>
								<span>Yes, you are at the go-to-place for logisticians ! Contact us to know more</span>
							</div>
							<div class="page-breacrumbs">
								<ul class="breadcrumbs">
									<li><a href="#" title="">Home</a></li>
									<li><a href="#" title="">Contact</a></li>
								</ul>
							</div>
						</div>
</div>
</div>
</section>
	<section id="contactus">
		<div class="block">
			<div class="container">
				<div class="col-md-12">
				<h2>We are happy to help you !!</h2>
				<p></p>
				<div class="contact_form">
				<div class="row">
				<div class="col-md-4">
				<div class="quick_contact">
				<h4>Quick Contact</h4>
				<p>If you have any questions simply use the following contact detail</p>
				<div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
				<div class="detail"><h5>ADDRESS :<br><span>A-1, Cariappa Marg, Sainik Farms, Gate No. 2 New Delhi 110062. India</span></h5></div>
				<div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
				<div class="detail"><h5>EMAIL :<br><span>tsg@holisolpeople.com</span></h5></div>
				<div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
				<div class="detail"><h5>PHONE :<br><span>+91 9816089902, +91 8826889221</span></h5></div>
				</div>
				</div>
				<div class="col-md-4">
				<div class="send_msg">
				<h4>Send Message Us</h4>
				<form class="contact_form_send" action="" method="post">
				<div class="row">
			<div class="col-md-6">
				<input type="text" placeholder="First Name">
				<i class="fa fa-user-o" aria-hidden="true"></i>				
				</div>
				<div class="col-md-6">
				<input type="text" placeholder="Last Name">
				<i class="fa fa-user-o" aria-hidden="true"></i>				
				</div>
				</div>
				<div class="row">
			<div class="col-md-12">
				<input type="text" placeholder="Email Id">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>			
				</div>
				</div>
				<div class="row">
			<div class="col-md-12">
				<div class="dropdown-field">
				<select data-placeholder="Please Select Specialism" class="chosen" style="display: none;">
					<option>--Select Subject--</option>
					<option>New Delhi</option>
					<option>Punjab</option>
					<option>Haryana</option>
				</select>
			</div>			
				</div>
				</div>
				<div class="row">
			<div class="col-md-12">
				<textarea class="form-control" rows="3" placeholder="Your Message"></textarea>			
				</div>
				</div>
				<div class="awe_btn">
			<input type="submit" value="SUBMIT">
			</div>
				</form>
				</div>
				</div>
				<div class="col-md-4">
				<img src="images/happy.png" style="    width: 100%;
    padding: 55px 0;">
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