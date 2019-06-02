<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="msvalidate.01" content="1759CD3E53A8F71FFFC4D772C2A17D6B" />
    <title>Just My| Dashboard</title>
	
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	
	<!--link rel="shortcut icon" href="<?php echo base_url();?>public/images/logo_favicon.png" type="image/x-icon"-->
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
	
	<!--######################## Table CSS  --->
	 <!-- DATA TABLES -->
    <link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
	<!-- ####### End table CSS --->
	
	<!--######################## Form CSS  ---><!-- daterange picker -->
    <link href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="<?php echo base_url(); ?>assets/plugins/iCheck/all.css" rel="stylesheet" type="text/css" />
    <!-- Bootstrap Color Picker -->
    <link href="<?php echo base_url(); ?>assets/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
    <!-- Bootstrap time Picker -->
    <link href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
	<!--######################## End Form CSS  --->
	
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />
    
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/css/newcustom.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/datepickar/jquery.datetimepicker.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
 </head>
<style>
	.user-panel>.image>img {
		width: 100%;
		max-width: 100%;
		height: auto;
	}
	.img-circle {
		border-radius:0px;
	}
	.skin-red .sidebar a {
		color: unset;
	}
	.skin-red .main-header .logo:hover {
		background-color: #b4d333;
	}
	.skin-red .main-header .navbar .sidebar-toggle:hover {
		background-color: #b4d333;
	}
	.skin-red .sidebar-menu>li:hover>a, .skin-red .sidebar-menu>li.active>a {
		border-left-color: #dd4b39;
	}
	.skin-red .main-header .navbar .sidebar-toggle {
		color: #000;
	}
	.skin-red .wrapper, .skin-red .main-sidebar, .skin-red .left-side {
		   background-color: #fff;
		background-color: #fff;
	}
	.skin-red .main-header .navbar {
		  background-color: #b4d333;
		/* background-color: rgba(180, 211, 51, 0.6588235294117647); */
		background: #fff;
		height: 50px;
	}
	
	.main-header .logo {
		height: auto;
		padding-bottom: 15px;
	}
	.sidebar span {
		font-size: 16px;
	}
	.sidebar-menu{
		display: inline-flex;
	}
	.logo-top{
		padding-top: 10px !important;
	}
	.sidebar-menu li>a {
		position: relative;
		color: #5a5757;
		font-size: 20px;
		font-weight: 600;
	}
	.border-bottom{
		border-bottom:1px solid #ddd;
	}
	.main-header {
		position: relative;
		max-height: 100px;
		z-index: 1030;
		padding-top: 15px;
	}
	.navbar-static-top{
		padding-top:10px;
	}
</style>

</head>
	
<header class="main-header">
<div class="row border-bottom">
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <img src="<?php echo base_url(); ?>assets/dist/img/logo_justmy.jpg" class="">
        </a>
	</div>
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-center">
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
		  	<?php $currPage = $this->router->fetch_class();?>
          
		    <ul class="sidebar-menu">
				<li class="<?php if($currPage == 'dashboard'){echo 'active';} ?>">
				  <a href="<?php echo base_url(); ?>Market">
					<!--i class="fa fa-dashboard"></i--> <span>Markets</span>
				  </a>
				</li>
				<li class="<?php if($currPage == 'orders'){echo 'active';} ?>">
				  <a href="<?php echo base_url(); ?>user">
					<!--i class="fa fa-cart-arrow-down"></i--> <span>Users</span>
				  </a>
				</li>
				<li class="<?php if($currPage == 'Packaging'){echo 'active';} ?>"> 
				  <a href="<?php echo base_url(); ?>post">
					<!--i class="fa fa-file-text-o"></i--> <span>Posts</span>
				  </a>
				</li>
				<li class="<?php if($currPage == 'Categoriesmanage'){echo 'active';} ?>"> 
				  <a href="<?php echo base_url(); ?>categories">
					<!--i class="fa fa-file-text-o"></i--> <span>Categories</span>
				  </a>
				</li>
				<li class="<?php if($currPage == 'product'){echo 'active';} ?>"> 
				  <a href="<?php echo base_url(); ?>channel">
					<!--i class="fa fa-pinterest-p"></i--> <span>Channels</span>
				  </a>
				</li>
				<li class="<?php if($currPage == 'profile'){echo 'active';} ?>"> 
				  <a href="<?php echo base_url(); ?>profile">
					<!--i class="fa fa-pinterest-p"></i--> <span>Profiles</span>
				  </a>
				</li>
				<li class="<?php if($currPage == 'section'){echo 'active';} ?>"> 
				  <a href="<?php echo base_url(); ?>section">
					<!--i class="fa fa-pinterest-p"></i--> <span>Sections</span>
				  </a>
				</li>
				<li class="<?php if($currPage == 'ads'){echo 'active';} ?>"> 
				  <a href="<?php echo base_url(); ?>ads">
					<!--i class="fa fa-pinterest-p"></i--> <span>Ads</span>
				  </a>
				</li>
			</ul>
        </nav>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 text-center">
		<div class="dataTables_length" id="example1_length" style="padding-top: 20px;">
			<button  type="button" class="btn btn-info" onclick="window.location.href='<?php echo base_url(); ?>login/logout'" />Logout</button>
		</div>
	</div>
	</div>
	
</header>


      