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
								<h3>Job Listing</h3>
								<span>Keep up to date with the job listing</span>
							</div>
							<div class="page-breacrumbs">
								<ul class="breadcrumbs">
									<li><a href="#" title="">Home</a></li>
									<li><a href="#" title="">Job Listing</a></li>
								</ul>
							</div>
						</div>
</div>
</div>
</section>
	<section id="job_listing">
		<div class="block">
			<div class="container">
				 <div class="row no-gape">
				 	<aside class="col-lg-3 column">
					<h4 style="background: #dedede;
    padding: 12px 0px;
    text-align: center;
    font-size: 19px;">Filter By</h4>
				 		<div class="widget border">
				 			<h3 class="sb-title closed">Date Posted</h3>
				 			<div class="posted_widget" style="">
								<input type="radio" name="choose" id="232"><label for="232">Last Hour</label><br>
								<input type="radio" name="choose" id="wwqe"><label for="wwqe">Last 24 hours</label><br>
								<input type="radio" name="choose" id="erewr"><label for="erewr">Last 7 days</label><br>
								<input type="radio" name="choose" id="qwe"><label for="qwe">Last 14 days</label><br>
								<input type="radio" name="choose" id="wqe"><label for="wqe">Last 30 days</label><br>
								<input type="radio" name="choose" id="qweqw"><label class="nm" for="qweqw">All</label><br>
				 			</div>
				 		</div>
				 		<div class="widget border">
				 			<h3 class="sb-title closed">Job Type</h3>
				 			<div class="type_widget" style="">
								<p class="flchek"><input type="checkbox" name="choosetype" id="33r"><label for="33r">Freelance (9)</label></p>
								<p class="ftchek"><input type="checkbox" name="choosetype" id="dsf"><label for="dsf">Full Time (8)</label></p>
								<p class="ischek"><input type="checkbox" name="choosetype" id="sdd"><label for="sdd">Internship (8)</label></p>
								<p class="ptchek"><input type="checkbox" name="choosetype" id="sadd"><label for="sadd">Part Time (5)</label></p>
								<p class="tpchek"><input type="checkbox" name="choosetype" id="assa"><label for="assa">Temporary (5)</label></p>
								<p class="vtchek"><input type="checkbox" name="choosetype" id="ghgf"><label for="ghgf">Volunteer (8)</label></p>
				 			</div>
				 		</div>
				 		<div class="widget border">
				 			<h3 class="sb-title closed">Specialism</h3>
				 			<div class="specialism_widget" style="">
								<div class="field_w_search">
				 					<input type="text" placeholder="Search Spaecialisms">
				 				</div><!-- Search Widget -->
				 				<div class="simple-checkbox scrollbar ss-container"><div class="ss-wrapper"><div class="ss-content">
									<p><input type="checkbox" name="spealism" id="as"><label for="as">Accountancy (2)</label></p>
									<p><input type="checkbox" name="spealism" id="asd"><label for="asd">Banking (2)</label></p>
									<p><input type="checkbox" name="spealism" id="errwe"><label for="errwe">Charity &amp; Voluntary (3)</label></p>
									<p><input type="checkbox" name="spealism" id="fdg"><label for="fdg">Digital &amp; Creative (4)</label></p>
									<p><input type="checkbox" name="spealism" id="sc"><label for="sc">Estate Agency (3)</label></p>
									<p><input type="checkbox" name="spealism" id="aw"><label for="aw">Graduate (2)</label></p>
									<p><input type="checkbox" name="spealism" id="ui"><label for="ui">IT Contractor (7)</label></p>
									<p><input type="checkbox" name="spealism" id="saas"><label for="saas">Charity &amp; Voluntary (3)</label></p>
									<p><input type="checkbox" name="spealism" id="rrrt"><label for="rrrt">Digital &amp; Creative (4)</label></p>
									<p><input type="checkbox" name="spealism" id="eweew"><label for="eweew">Estate Agency (3)</label></p>
									<p><input type="checkbox" name="spealism" id="bnbn"><label for="bnbn">Graduate (2)</label></p>
									<p><input type="checkbox" name="spealism" id="ffd"><label for="ffd">IT Contractor (7)</label></p>
				 				</div></div><div class="ss-scroll" style="height: 52.968%; top: 0%; right: -214px;"></div></div>
				 			</div>
				 		</div>
				 		<div class="widget border">
				 			<h3 class="sb-title closed">Offerd Salary</h3>
				 			<div class="specialism_widget" style="display: none;">
				 				<div class="simple-checkbox">
									<p><input type="checkbox" name="smplechk" id="1"><label for="1">10k - 20k</label></p>
									<p><input type="checkbox" name="smplechk" id="2"><label for="2">20k - 30k</label></p>
									<p><input type="checkbox" name="smplechk" id="3"><label for="3">30k - 40k</label></p>
									<p><input type="checkbox" name="smplechk" id="4"><label for="4">40k - 50k</label></p>
				 				</div>
				 			</div>
				 		</div>
				 		<div class="widget border">
				 			<h3 class="sb-title closed">Career Level</h3>
				 			<div class="specialism_widget" style="display: none;">
				 				<div class="simple-checkbox">
									<p><input type="checkbox" name="smplechk" id="5"><label for="5">Intermediate</label></p>
									<p><input type="checkbox" name="smplechk" id="6"><label for="6">Normal</label></p>
									<p><input type="checkbox" name="smplechk" id="7"><label for="7">Special</label></p>
									<p><input type="checkbox" name="smplechk" id="8"><label for="8">Experienced</label></p>
				 				</div>
				 			</div>
				 		</div>
				 		<div class="widget border">
				 			<h3 class="sb-title closed">Experince</h3>
				 			<div class="specialism_widget" style="display: none;">
				 				<div class="simple-checkbox">
									<p><input type="checkbox" name="smplechk" id="9"><label for="9">1Year to 2Year</label></p>
									<p><input type="checkbox" name="smplechk" id="10"><label for="10">2Year to 3Year</label></p>
									<p><input type="checkbox" name="smplechk" id="11"><label for="11">3Year to 4Year</label></p>
									<p><input type="checkbox" name="smplechk" id="12"><label for="12">4Year to 5Year</label></p>
				 				</div>
				 			</div>
				 		</div>
				 		<div class="widget border">
				 			<h3 class="sb-title closed">Gender</h3>
				 			<div class="specialism_widget" style="display: none;">
				 				<div class="simple-checkbox">
									<p><input type="checkbox" name="smplechk" id="13"><label for="13">Male</label></p>
									<p><input type="checkbox" name="smplechk" id="14"><label for="14">Female</label></p>
									<p><input type="checkbox" name="smplechk" id="15"><label for="15">Others</label></p>
				 				</div>
				 			</div>
				 		</div>
				 		<div class="widget border">
				 			<h3 class="sb-title closed">Industry</h3>
				 			<div class="specialism_widget" style="display: none;">
				 				<div class="simple-checkbox">
									<p><input type="checkbox" name="smplechk" id="16"><label for="16">Meezan Job</label></p>
									<p><input type="checkbox" name="smplechk" id="17"><label for="17">Speicalize Jobs</label></p>
									<p><input type="checkbox" name="smplechk" id="18"><label for="18">Business Jobs</label></p>
				 				</div>
				 			</div>
				 		</div>
				 		<div class="widget border">
				 			<h3 class="sb-title closed">Qualification</h3>
				 			<div class="specialism_widget" style="display: none;">
				 				<div class="simple-checkbox">
									<p><input type="checkbox" name="smplechk" id="19"><label for="19">Matriculation</label></p>
									<p><input type="checkbox" name="smplechk" id="20"><label for="20">Intermidiate</label></p>
									<p><input type="checkbox" name="smplechk" id="21"><label for="21">Gradute</label></p>
				 				</div>
				 			</div>
				 		</div>
			 			<div class="banner_widget">
			 				<a href="#" title=""><img src="images/ad1.jpg" alt=""></a>
						</div>
						<div class="banner_widget">
			 				<a href="#" title=""><img src="images/ad3.png" alt=""></a>
						</div>
				 	</aside>
				 	<div class="col-lg-9 column">
				 		<div class="modrn-joblist np">
					 		<div class="filterbar">
					 			
					 			<div class="sortby-sec">
					 				<span>Sort by</span>
					 				<select data-placeholder="Most Recent" class="chosen" style="display: none;">
										<option>Most Recent</option>
										<option>2 Days Ago</option>
										<option>4 Days Ago</option>
										<option>1 Week Ago</option>
									</select>
									
									<select data-placeholder="20 Per Page" class="chosen" style="display: none;">
										<option>30 Per Page</option>
										<option>40 Per Page</option>
										<option>50 Per Page</option>
										<option>60 Per Page</option>
									</select>
									<select data-placeholder="20 Per Page" class="chosen" style="display: none;">
										<option>Job Type</option>
										<option>Full Time</option>
										<option>Part Time</option>
										<option>Free</option>
									</select>
					 			</div>
					 			<h5>9102 Jobs &amp; Vacancies</h5>
					 		</div>
						 </div><!-- MOdern Job LIst -->
						 <div class="job-list-modern">
						 	<div class="job-listings-sec no-border">
								<div class="job-listing wtabs">
									<div class="job-title-sec">
										<div class="c-logo"> <img src="images/1.png" alt=""> </div>
										<h3><a href="#" title="">Web Designer / Developer</a></h3>
										<span>Company Name</span>
										<div class="job-lctn"><i class="fa fa-map-marker" aria-hidden="true"></i> New Delhi -110018</div>
									</div>
									<div class="job-style-bx">
										 <span class="job-is ft">Full time</span><span class="apply_now"><a href="#">Apply Now</a></span>
										<span class="fav-job"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
										<i>5 months ago</i>
									</div>
								</div>
								<div class="job-listing wtabs">
									<div class="job-title-sec">
										<div class="c-logo"> <img src="images/2.png" alt=""> </div>
										<h3><a href="#" title="">C Developer (Senior) C .Net</a></h3>
										<span>Company Name</span>
										<div class="job-lctn"><i class="fa fa-map-marker" aria-hidden="true"></i> New Delhi -110018</div>
									</div>
									<div class="job-style-bx">
										<span class="job-is pt ">Part time</span><span class="apply_now"><a href="#">Apply Now</a></span>
										<span class="fav-job"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
										<i>5 months ago</i>
									</div>
								</div><!-- Job -->
								<div class="job-listing wtabs">
									<div class="job-title-sec">
										<div class="c-logo"> <img src="images/3.png" alt=""> </div>
										<h3><a href="#" title="">Regional Sales Manager South</a></h3>
										<span>Company Name</span>
										<div class="job-lctn"><i class="fa fa-map-marker" aria-hidden="true"></i> New Delhi -110018</div>
									</div>
									<div class="job-style-bx">
										<span class="job-is ft ">Full time</span><span class="apply_now"><a href="#">Apply Now</a></span>
										<span class="fav-job"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
										<i>5 months ago</i>
									</div>
								</div><!-- Job -->
								<div class="job-listing wtabs">
									<div class="job-title-sec">
										<div class="c-logo"> <img src="images/4.png" alt=""> </div>
										<h3><a href="#" title="">Marketing Dairector</a></h3>
										<span>Company Name</span>
										<div class="job-lctn"><i class="fa fa-map-marker" aria-hidden="true"></i> New Delhi -110018</div>
									</div>
									<div class="job-style-bx">
										<span class="job-is ft ">Full time</span><span class="apply_now"><a href="#">Apply Now</a></span>
										<span class="fav-job"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
										<i>5 months ago</i>
									</div>
								</div><!-- Job -->
								<div class="job-listing wtabs">
									<div class="job-title-sec">
										<div class="c-logo"> <img src="images/5.png" alt=""> </div>
										<h3><a href="#" title="">Application Developer</a></h3>
										<span>Company Name</span>
										<div class="job-lctn"><i class="fa fa-map-marker" aria-hidden="true"></i> New Delhi -110018</div>
									</div>
									<div class="job-style-bx">
										<span class="job-is pt ">Part time</span><span class="apply_now"><a href="#">Apply Now</a></span>
										<span class="fav-job"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
										<i>5 months ago</i>
									</div>
								</div><!-- Job -->
								<div class="job-listing wtabs">
									<div class="job-title-sec">
										<div class="c-logo"> <img src="images/6.png" alt=""> </div>
										<h3><a href="#" title="">Social Media and Public</a></h3>
										<span>Company Name</span>
										<div class="job-lctn"><i class="fa fa-map-marker" aria-hidden="true"></i> New Delhi -110018</div>
									</div>
									<div class="job-style-bx">
										<span class="job-is fl ">Freelance</span><span class="apply_now"><a href="#">Apply Now</a></span>
										<span class="fav-job"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
										<i>5 months ago</i>
									</div>
								</div><!-- Job -->
								<div class="job-listing wtabs">
									<div class="job-title-sec">
										<div class="c-logo"> <img src="images/1.png" alt=""> </div>
										<h3><a href="#" title="">C Developer (Senior) C .Net</a></h3>
									<span>Company Name</span>
										<div class="job-lctn"><i class="fa fa-map-marker" aria-hidden="true"></i> New Delhi -110018</div>
									</div>
									<div class="job-style-bx">
										<span class="job-is pt ">Part time</span><span class="apply_now"><a href="#">Apply Now</a></span>
										<span class="fav-job"><i class="fa fa-heart-o" aria-hidden="true"></i></span>
										<i>5 months ago</i>
									</div>
								</div><!-- Job -->
							</div>
							<div class="pagination">
								<ul>
									<li class="prev"><a href=""><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Prev</a></li>
									<li><a href="">1</a></li>
									<li class="active"><a href="">2</a></li>
									<li><a href="">3</a></li>
									<li><span class="delimeter">...</span></li>
									<li><a href="">14</a></li>
									<li class="next"><a href="">Next <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></li>
								</ul>
							</div><!-- Pagination -->
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

