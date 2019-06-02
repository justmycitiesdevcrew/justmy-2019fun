<!DOCTYPE html>
<html>
<head>

	<?php require("css_files.php");?>
	<style>
	.stepwizard-row:before {
    top: 50%;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard {
    margin: 28px 0;
}
	</style>
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
						<h2>Welcome, Employer</h2>
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
				 					<li class="inner-child">
				 						<a href="employer_dashboard.php" title=""><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
				 					</li>
									<li class="inner-child">
				 						<a href="reports.php" title=""><i class="fa fa-tachometer" aria-hidden="true"></i> Reports</a>
				 					</li>
									<li class="inner-child">
				 						<a href="skill.php" title=""><i class="fa fa-tachometer" aria-hidden="true"></i> Analyze Organizational Skill</a>
				 					</li>
									<li class="inner-child">
				 						<a href="emp.php" title=""><i class="fa fa-tachometer" aria-hidden="true"></i> Manage Employee Lifecycle</a>
				 					</li>
									<li class="inner-child">
				 						<a href="train.php" title=""><i class="fa fa-tachometer" aria-hidden="true"></i> Training Plans</a>
				 					</li>
				 					<!--li class="inner-child">
				 						<a href="#" title=""><i class="fa fa-briefcase" aria-hidden="true"></i> Salary Analytics</a>
				 						
				 					</li>
				 					
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="fa fa-paper-plane" aria-hidden="true"></i> Manage Jobs</a>
				 						
				 					</li>
				 					<li class="inner-child">
				 						<a href="#" title=""><i class="fa fa-bell-o" aria-hidden="true"></i> Resumes</a>
				 					</li>
									<li class="inner-child">
				 						<a href="#" title=""><i class="fa fa-bell-o" aria-hidden="true"></i> Packages</a>
				 					</li>
									<li class="inner-child active">
				 						<a href="#" title=""><i class="fa fa-bell-o" aria-hidden="true"></i> Post a now Job</a>
				 					</li>
									<li class="inner-child">
				 						<a href="#" title=""><i class="fa fa-bell-o" aria-hidden="true"></i> Job Alert</a>
				 					</li>
									<li class="inner-child">
				 						<a href="#" title=""><i class="fa fa-bell-o" aria-hidden="true"></i> Test Employees</a>
				 					</li>
									<li class="inner-child">
				 						<a href="#" title=""><i class="fa fa-bell-o" aria-hidden="true"></i> Job Market Activity</a>
				 					</li>
									
									<li class="inner-child">
				 						<a href="#" title=""><i class="fa fa-line-chart" aria-hidden="true"></i> Dropdown menu demo <i class="fa fa-angle-down" aria-hidden="true" style="float: right;"></i></a>
				 						<ul>
				 							<li><a href="#" title="">Submenu 1</a></li>
				 							<li><a href="#" title="">Submenu 2</a></li>
				 							<li><a href="#" title="">Submenu 3</a></li>
				 						</ul>
				 					</li-->
				 				</ul>
				 			</div>
				 		</div>
				 		
				 	</aside>
					<div class="col-lg-9 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>Candidates Dashboard</h3>
						 		<div class="cat-sec">
									<div class="row no-gape">
										<!--div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category">
												<a href="#" title="">
													<i class="fa fa-briefcase" aria-hidden="true"></i>
												
													<span>Explained in Sheet "10"</span>
													<!--p>14 Applications</p-->
												<!--/a>
											</div>
										</div>
										<!--div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category view-resume-list">
												<a href="#" title="">
													<i class="fa fa-eye" aria-hidden="true"></i>
													<span>Post a Job</span>
													<p>22 View Statistic</p>
												</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category view-resume-list">
												<a href="#" title="">
													<i class="fa fa-eye" aria-hidden="true"></i>
													<span>Job Tracker</span>
													<p>22 View Statistic</p>
												</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category">
												<a href="#" title="">
													<i class="fa fa-file-text-o" aria-hidden="true"></i>
													<span>Open Jobs</span>
													<p>Create New Resume</p>
												</a>
											</div>
										</div>

										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category" style="border-bottom:none;">
												<a href="#" title="">
													<i class="fa fa-check" aria-hidden="true"></i>
													<span>Total Applicants</span>
													<p>(05 Jobs)</p>
												</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category follow-companies-popup" style="border-bottom:none;">
												<a href="#" title="">
													<i class="fa fa-user-o" aria-hidden="true"></i>
													<span>Shortlisted Applicants</span>
													<p>56 Companies</p>
												</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category" style="border-bottom:none;">
												<a href="#" title="">
													<i class="fa fa-file-text-o" aria-hidden="true"></i>
													<span>Closed Jobs</span>
													<p>View Profile</p>
												</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category" style="border-bottom:none;">
												<a href="#" title="">
													<i class="fa fa-file-text-o" aria-hidden="true"></i>
													<span>Interview Schedule</span>
													<p>View Profile</p>
												</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category" style="border-bottom:none;">
												<a href="#" title="">
													<i class="fa fa-file-text-o" aria-hidden="true"></i>
													<span>Saved Candidates</span>
													<p>View Profile</p>
												</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-xs-12">
											<div class="candidate-category" style="border-bottom:none;">
												<a href="#" title="">
													<i class="fa fa-file-text-o" aria-hidden="true"></i>
													<span>Feature of add notes on a given job</span>
													<p>View Profile</p>
												</a>
											</div>
										</div-->
									</div>
								</div>
					 		</div>
					 	</div>
					</div>
				 	<!--div class="col-lg-5 column">
				 		<div class="padding-left">
					 		<div class="manage-jobs-sec">
					 			<h3>Post A  New job</h3>
								<div class="profile-form-edit">
								<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
        </div>
    </div>
</div>
    <div class="row setup-content" id="step-1">
            <div class="col-md-12">
               
				   <div class="col-md-12">
				    <h3> Basic Details</h3>
				<form action="" method="post" id="post_job">
				<div class="row">
										<div class="col-md-6">
										<p>Job Title<span>*</span></p>
										<input type="text" placeholder="Enter job Title">			
										</div>
										<div class="col-md-6">
										<p>Job Catagory<span>*</span></p>
											<div class="dropdown-field">
											<select data-placeholder="Please Select Specialism" class="chosen" style="display: none;">
												<option>--Select Catagory--</option>
												<option>Catagory1</option>
												<option>Catagory2</option>
												<option>Catagory3</option>
											</select>
										</div>	
										</div>
										</div>
				<div class="row">
										<div class="col-md-6">
										<p>Job Location<span>*</span></p>
										<input type="text" placeholder="Enter Job Location">			
										</div>
										<div class="col-md-6">
										<p>Job Type<span>*</span></p>
										<div class="dropdown-field">
						<select data-placeholder="Please Select Specialism" class="chosen" style="display: none;">
							<option>--Select Job Type--</option>
							<option>Catagory1</option>
							<option>Catagory2</option>
							<option>Catagory3</option>
						</select>
					</div>			
										</div>
										</div>
				</form>
				</div>
				<div class="row">
				 <div class="col-md-12">
					  <button class="btn btn-warning preBtn btn-lg pull-left" type="button" >Pre</button>
					<button class="btn btn-danger nextBtn btn-lg pull-right" type="button" >Next</button>
				</div></div>
        	</div>
    </div>
    <div class="row setup-content" id="step-2">
            <div class="col-md-12">
                 
				 <div class="col-md-12">
				 <h3> Company details</h3>
				<form action="" method="post" id="post_job">
               <div class="row">
								<div class="col-md-6">
								<p>Salary Package<span>*</span></p>
								<div class="row">
								<div class="col-md-6">
								<input type="text" placeholder="Sal Min">			
								</div>
								<div class="col-md-6">
								<input type="text" placeholder="Sal Max">			
								</div>
								</div>
								</div>
								<div class="col-md-6">
								<p>Skill Required<span>*</span></p>
								<input type="text" placeholder="Skill Required">			
								</div>
								</div>
				<div class="row">
								<div class="col-md-6">
								<p>Notice Period<span>*</span></p>
								<div class="dropdown-field">
				<select data-placeholder="Please Select Specialism" class="chosen" style="display: none;">
					<option>--Select Notice Period--</option>
					<option>2 Days</option>
					<option>5 Days</option>
					<option>! week</option>
				</select>
			</div>				
								</div>
								<div class="col-md-6">
								<p>Total Experience<span>*</span></p>
							<div class="dropdown-field">
				<select data-placeholder="Please Select Specialism" class="chosen" style="display: none;">
					<option>--Select Experience--</option>
					<option>1 Year</option>
					<option>2 Year</option>
					<option>3 Year</option>
				</select>
			</div>						
								</div>
								</div>
								</form>
								</div>
				<div class="row">
				 <div class="col-md-12">
                <button class="btn btn-warning preBtn btn-lg pull-left" type="button" >Pre</button>
                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" >Next</button>
				</div>
				</div>
            </div>
    </div>
    <div class="row setup-content" id="step-3">
            <div class="col-md-12">
                
				 <div class="col-md-12">
				  <h3> Qualification details</h3>
				<form action="" method="post" id="post_job">
				<div class="row">
								<div class="col-md-6">
								<p>Gender<span>*</span></p>
								<div class="dropdown-field">
				<select data-placeholder="Please Select Specialism" class="chosen" style="display: none;">
					<option>--Select Gender--</option>
					<option>Male</option>
					<option>Female</option>
				</select>
			</div>					
								</div>
								<div class="col-md-6">
								<p>Max Qualification<span>*</span></p>
								<div class="dropdown-field">
				<select data-placeholder="Please Select Specialism" class="chosen" style="display: none;">
					<option>--Select Qualification--</option>
					<option>MA</option>
					<option>BA</option>
				</select>
			</div>					
								</div>
								<div class="col-md-6">
								<p>Total vacancies<span>*</span></p>
								<div class="dropdown-field">
				<select data-placeholder="Please Select Specialism" class="chosen" style="display: none;">
					<option>--Select vacancies--</option>
					<option>2</option>
					<option>4</option>
				</select>
			</div>						
								</div>
								</div>
				</form>
				</div>
				<div class="row">	
				 <div class="col-md-12">		
                <button class="btn btn-warning preBtn btn-lg pull-left" type="button" >Pre</button>
                <button class="btn btn-success nextBtn btn-lg pull-right" type="button" >Next</button>
				</div>
				</div>
            </div>
    </div>

								</div>
					 		</div>
					 	</div>
					</div-->
				 </div>
			</div>
		</div>
	</section>

	<?php require("footer.php");?>

</div>

<?php require("script.php");?>

<script>
$(document).ready(function () {



    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>
</body>

</html>

