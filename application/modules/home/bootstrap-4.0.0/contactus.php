
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
.contactus-topPortion{
	background: linear-gradient(to right, #2437a2 , #a900ff); padding: 45px; padding-top: 20px;
}
.padding-top-15{
	 padding-top: 15px;
}
.Heading{
	font-size: 40px; color: white;
}
.icon-portion{
	padding-top: 15px; padding-left: 70px;
}
	.Button{
	background: linear-gradient(to right, #2437a2 , #a900ff);
    border: none;
    color: white;
    display: block;
    padding: 11px 0;
    text-align: center;
    width: 91%;
    font-size: 17px;
    font-weight: 500;
    margin-right: 52px;
    margin-top: 15px;
     }
     .Button:hover{
     	background: linear-gradient(to right, #fb236a , #fb236a);
     }
     .icon-location i{
     	color: white;
		font-size: 40px;
		border-width: 1px!important;
		border-radius: 50%;
		transition: all ease-in .2s;
		display: inline-block;
		text-align: center;
		width: 100px;
		height: 100px;
		background: #ed3000;
		padding-top: 28px;
     }
	 .icon-location i:hover{
		 background-color: #13467b;
		 border: 1px solid #fff;
	 }
     .contact-tag{
     	font-weight: bold;
		font-size: 24px;
		color: #ffffff;
		padding: 10px 0 10px 0;
     }
     .color-white{
     	color: #fff;
     }
     .message-us{
     	padding-top: 40px;font-size: 40px; color: #00447e;
     }
     .message-info{
     	padding-left:215px;padding-top: 15px;  color: #777777;
     }
     .padding-top-130{
     	padding-top: 65px;
     }
     .margin-left{
     	margin-left: -15px;
     }
	 input[type="text"], input[type="password"], input[type="email"], textarea{
		 padding: 12px 12px;
		 border: 1px solid #ccc;
                 width: 91%;
	 }
    #message{
           width: 91%;
          }
    .content .form-group {
   			 margin-bottom: 5px;
			}
	.input_btn{
		padding: 6px 10px 9px 10px;
    bottom: 105px;
    right: 0;
	}
</style>
<section class="contactus-topPortion">
  <div class="row">
    <div class="content">
    	
    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-top-15 text-center" >
    			<h2 class="Heading">Get In Touch</h2>
    		</div>
    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 icon-portion text-center" >
    			<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12" style="    padding-left: 105px;"></div>
	    		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
	    			<div class="icon-location">
	    				<i class="fa fa-map-marker" aria-hidden="true" ></i>
	    			</div>
	    			<div class="adress">
	    				<div class="contact-tag">Address</div>
	    				<div class="color-white">Holisol People</div>
	    				<div class="color-white">A-1, Cariappa Marg, Sainik Farms, Gate No. 2 New Delhi 110062. India</div>

	    			</div>
	    		</div>
	    		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
	    			<div class="icon-location">
	    				<i class="fa fa-phone" aria-hidden="true" ></i>
	    			</div>
	    			<div class="phone">
	    				<div class="contact-tag">Phone</div>
	    				<div class="color-white">+91 9816089902,</div>
	    				<div class="color-white">+91 8826889221</div>

	    			</div>
	    		</div>
	    		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
	    			<div class="icon-location">
	    				<i class="fa fa-envelope" aria-hidden="true" ></i>
	    			</div>
	    			<div class="email">
	    				<div class="contact-tag">Email</div>
	    				<div class="color-white">tsg@holisolpeople.com</div>

	    			</div>
	    		</div>
	    		<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>
	    	</div>	
  </div>
</section>
<section>
  <div class="row">
    <div class="content">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom: 45px;">
    	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
    		<h2 class="message-us text-center" >Message Us</h2>
    		<p class="message-info" >Yes, you are at the go-to-place for logisticians ! Contact us to know more</p>
    	</div>
    	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 padding-top-130">
    		<form>
    			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group margin-left" >
	    				
	    				<input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name">
	    			</div>
	    			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 form-group">
	    				
	    				<input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last name">
	    			</div>
	    		</div>	
	    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    			
	    			<input type="email" name="email" id="email" class="form-control" placeholder="Email">
	    		</div>
	    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    			
	    			<textarea type="text" name="message" id="message" class="form-control" placeholder="Your Message" ></textarea> 
	    		</div>
	    		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    			<button type="button" class="Button" name="submit">Submit</button>
	    		</div>
    		</form>
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