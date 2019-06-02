<!DOCTYPE html>
<html>
<head>

	<?php require("css_files.php");?>
	<script src="js/user_charts.js"></script>
</head>
<body>

<div class="page-loading">
	<img src="images/loader.gif" alt="" />
</div>

<div class="theme-layout" id="scrollup">
	<?php require("mobile_menu.php");?>
	
	
	<?php require("login_header.php");?>
<section id="inner_header">
<div class="bg-overlay"></div>
<div class="container">
<div class="row">
<div class="col-md-12 text-center">
					<div class="inner_heading">
					<img src="images/blog1.jpg">
						<h2>Welcome, User name</h2>
						</div>
						</div>
</div>
</div>
</section>
	<section id="single_job">
		<div class="block">
			<div class="container">
				 <div class="row no-gape">
				 	<aside class="col-lg-3 column border-right">
				 		<div class="widget">
				 			<div class="tree_widget-sec">
				 				<ul>
				 					<li class="inner-child active">
				 						<a href="#" title=""><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
				 					</li>
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="fa fa-briefcase" aria-hidden="true"></i> Trending jobs</a>
				 						
				 					</li>
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="fa fa-line-chart" aria-hidden="true"></i> Job Analytics <i class="fa fa-angle-down" aria-hidden="true" style="float: right;"></i></a>
				 						<ul>
				 							<li><a href="#" title="">Location Wise</a></li>
				 							<li><a href="#" title="">Skill Wise</a></li>
				 							<li><a href="#" title="">Qualification Wise</a></li>
				 						</ul>
				 					</li>
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="fa fa-paper-plane" aria-hidden="true"></i> Personality</a>
				 						
				 					</li>
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="fa fa-bell-o" aria-hidden="true"></i> Job Alerts</a>
				 					</li>
				 				</ul>
				 			</div>
				 		</div>
				 		<div class="widget">
				 			<div class="skill-perc">
				 				<h3>Skills Percentage </h3>
				 				<p>Put value for "Cover Image" field to increase your skill up to "15%"</p>
				 			
				 					<div id="chartContainer" style="position: absolute;bottom: 37%;"></div>
								   
				 				</div>
				 			</div>
				 	
				 	</aside>
				 	<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>Candidates Dashboard</h3>
						 		<div class="cat-sec">
									<div class="row no-gape">
										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category">
												<a href="#" title="">
													<i class="fa fa-briefcase" aria-hidden="true"></i>
												
													<span>Applied Job</span>
													<p>14 Applications</p>
												</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category view-resume-list">
												<a href="#" title="">
													<i class="fa fa-eye" aria-hidden="true"></i>
													<span>View Resume</span>
													<p>22 View Statistic</p>
												</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category">
												<a href="#" title="">
													<i class="fa fa-file-text-o" aria-hidden="true"></i>
													<span>My Resume</span>
													<p>Create New Resume</p>
												</a>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category" style="border-bottom:none;">
												<a href="#" title="">
													<i class="fa fa-check" aria-hidden="true"></i>
													<span>Appropriate For Me</span>
													<p>(05 Jobs)</p>
												</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category follow-companies-popup" style="border-bottom:none;">
												<a href="#" title="">
													<i class="fa fa-user-o" aria-hidden="true"></i>
													<span>Follow Companies</span>
													<p>56 Companies</p>
												</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category" style="border-bottom:none;">
												<a href="#" title="">
													<i class="fa fa-file-text-o" aria-hidden="true"></i>
													<span>My Profile</span>
													<p>View Profile</p>
												</a>
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
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

</body>

</html>

