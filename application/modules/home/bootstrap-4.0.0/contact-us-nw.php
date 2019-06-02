
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
<style>
	.Button-con{
		    background: linear-gradient(to right, #2437a2 , #a900ff);
		    border: none;
		    color: white;
		    display: block;
		    padding: 8px 0;
		    text-align: center;
		    width: 30%;
			margin-top: 12px;
		    font-size: 16px;
		    font-weight: 500;
			float: left;
	}
	.content{
		background-image: url("images/bgimg.png");
		background-size: cover;
		width: 100%;
		padding-top: 10px;
		padding-bottom: 30px;
	}
	
	.bgcolor{
		background-color:#3f3d3d;
		color:#fff;
	}
	.mainbg{
		background-color:#0000008c;
		padding-top: 50px;
	}
	.brrdi img{
		border-radius:50%;
	}
	.breadcrumb{
		background-color:#0000!important;
	}
	a{
		color:#fff;
	}
	input[type="checkbox"] {
    /* position: absolute; */
    opacity: unset;
	z-index: 1;
	position: relative;
	}
	label::before {
		display: none;
	}
	label{
		padding: 0px;
		margin-right: 0px;
	}
	.contactHeading{
		color: #13467b;
		text-align: center;
		font-weight: bold;
		padding-bottom: 12px;
	}
	.textinformation p{
		line-height: unset;
	}
</style>

<body>
	<section class="">
  		<div class="row">
     		<div class="content">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h2 class="contactHeading">CONTACT US</h2>
						</div>
						
    	 		<div class="container">
    				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mainbg">
    					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 50px;" >
    						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="background: white; padding-bottom: 12px;">
    							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    								<h2>Feel Free To Contact Us</h2>
    							</div>
    							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 textinformation">
    								<p>Yes, you are at the go-to-place for logisticians ! Contact us to know more</p>
    								<p>
									   <strong>Mandatory fields are marked with</strong> 
									   <span class="red-highlight">*</span>
								    </p>
    							</div>
    							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height: auto;">
    								<form>
    									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
	    				                    <label>Full Name</label>
	    				                    <span class="mandatory" style="color:red;">*</span>
	    									<input type="text" name="firstName" id="firstName" class="form-control" >
	    								</div>
	    								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<label>Email</label>
											<span class="mandatory" style="color:red;">*</span>
	    									<input type="email" name="email" id="email" class="form-control" >
	    								</div>
	    								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
											<label>Phone Number</label>
											<span class="mandatory" style="color:red;">*</span>
	    									<input type="text" name="number" id="number" class="form-control">
	    								</div>
	    								
	    								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
	    									<label>Please describe what you are interested in</label>
	    									<span class="mandatory" style="color:red;">*</span>
	    									<textarea type="text" name="message" id="message" class="form-control"></textarea> 
	    								</div>
	    								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 10px;">
	    									<input type="checkbox" name="checkbox"> Subscribe to updates and news from Holisol BPM
	    								</div>
	    								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							    			<button type="button" class="Button-con" name="submit">Submit</button>
							    		</div>
    								</form>
    							</div>
    						</div>
    						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
								<img src="images/cont.jpg" style="width:100%;height: 548px;">
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
    	
