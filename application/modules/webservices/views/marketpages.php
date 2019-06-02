<! DOCTYPE html>
<html>
<head>
<title><?php echo $marketData[0]['market_name']; ?></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<style>
		
			.footer {
			 text-align: left;
    font-size: 20px;
    padding: 15px 0px 19px 0px;
			}
			.market-banner{
				width: 100%;
			}
			.main-header {
    width: 100%;
    background: #e5e5e5;
}
.contanier {
    width: 85%;
    margin: auto;
}
.social-media{
	
			}
.social-media li img {
    margin: 12px 0px 0px 20px;
}
.social-media li {
    list-style: none;
    float: left;
}
.logo {
    position: absolute;
}
.marketname {
    margin: 8px 0px 0px 123px;
    font-size: 20px;
    display: block;
}
.logo {
    position: absolute;
}
.logo img {
    width: 114px;
}
.contanier h2 {
       color: black;
    margin-top: 0;
    padding: 13px 0px;
    margin-bottom: 30px;
}
.contanier h2 a {
    color: black;
    font-size: 20px;
    margin: 0% 0% 0% 14%;
}
.market-banner img {
    width: 1146px;
    height: auto;
}
.clr {
    clear: both;
}
.footer-last {
    width: 100%;
    background: #000;
    text-align: center;
    padding: 15px 0px 19px 0px;
}
.footer-content {
    margin: 8px 0px 0px 123px;
    font-size: 20px;
    display: block;
    color: #b7afaf;
}
.banner-image{
     background-image: url("<?php echo base_url();?>upload/images/<?php echo  $marketData[0]['market_header_image']; ?>");
}

		</style>
	</head>
        <?php// echo "<pre>";print_r($marketData[0]); die;?>
	<body>
		<header>
			<div class="main-header">
			   <div class="contanier">
			   <div class="row">
				<div class="col-md-9">
						<div class="logo">
							<a href="#"><img src="<?php echo base_url();?>assets/images/logo_justmy.jpg" alt="logo"></a>
						</div>
					
						<span class="marketname"><?php echo $marketData[0]['market_site_title']; ?></span>
				</div>
				<div class="col-md-3">
					<ul class="social-media pull-right">
					<?php if($marketData[0]['market_facebook']){?>
					  <li><a href="<?php echo $marketData[0]['market_facebook']; ?>"><img src="<?php echo base_url();?>assets/images/facebook.png"></a></li>
					<?php }?>
					<?php if($marketData[0]['market_twitter']){?>
					  <li><a href="<?php echo $marketData[0]['market_twitter']; ?>"><img src="<?php echo base_url();?>assets/images/twitter.png"></a></li>
					<?php }?>
					<?php if($marketData[0]['market_youtube']){?>
					  <li><a href="<?php echo $marketData[0]['market_youtube']; ?>"><img src="<?php echo base_url();?>assets/images/youtube.png"></a></li>
					<?php }?>
					<?php if($marketData[0]['market_instagram']){?>
					  <li><a href="<?php echo $marketData[0]['market_instagram']; ?>"><img src="<?php echo base_url();?>assets/images/instagram.png"></a></li>
					<?php }?>
					<?php if($marketData[0]['market_snapchat']){?>
					  <li><a href="<?php echo $marketData[0]['market_snapchat']; ?>"><img src="<?php echo base_url();?>assets/images/snapchat.png"></a></li>
					<?php }?>
					</ul>
				</div>
				</div>
				</div>
			</div>
		</header>
			<div class="contanier">
			 <h2><a href="#">Home</a></h2>
                                       
					<div class="market-banner">
						<img src="<?php echo base_url();?>upload/images/<?php echo  $marketData[0]['market_header_image']; ?>" alt="market-banner">
					</div>
					<!--div class="banner-image">
						<a href="#"><img src="<?php echo base_url();?>upload/images/logo_justmy.jpg" alt="company-logo"><span class="marketname"><?php echo $marketData[0]['market_site_title']; ?></span></a>
					</div-->
			</div>
			
			<div class="row contanier footer">
				<div class="footer-text">
					<strong>Recent <?php echo $marketData[0]['market_name']; ?> Feature</strong>
				</div>
			</div>
            <div class="footer-last">
                <span class="footer-content"> CREATED BY THE FUN CREW OF JustMy | COPYRIGHT @ JustMyCities Corp.</span>
            </div>
		
	</body>
</html>
<?php die();?>