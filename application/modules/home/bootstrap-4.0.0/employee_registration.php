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

				<div class="login_form">
				<div class="stepwizard col-md-offset-3">
    				<div class="stepwizard-row setup-panel">
						 <div class="stepwizard-step">
						<a href="#step-4" type="" class="btn btn-primary btn-circle">1</a>
						
					  </div>
      				<!--div class="stepwizard-step">
					<a href="#step-2" type="" class="btn btn-default btn-circle" disabled="disabled">2</a>
					<p>Step 2</p>
				  </div>
				  <div class="stepwizard-step">
					<a href="#step-3" type="" class="btn btn-default btn-circle" disabled="disabled">3</a>
					<p>Step 3</p>
				  </div>
				   <div class="stepwizard-step">
					<a href="#step-4" type="" class="btn btn-default btn-circle" disabled="disabled">2</a>
					<p>Step 2</p>
				  </div-->
					</div>
				  </div>
  
				<div class="card">
				<div class="card-body">
				
    <!--div class="row setup-content" id="step-1">
        <div class="col-md-12">
		<h3>Please select your type</h3>
		<form role="form" action="" method="post">
			<div class="row">
				<div class="col-md-6">
			<div class="cfield">
				<input type="text" placeholder="Name">
				<i class="fa fa-user-o" aria-hidden="true"></i>	
				</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
			<div class="cfield">
				<input type="text" placeholder="Mobile">
				<i class="fa fa-mobile" aria-hidden="true"></i>		
				</div>
				</div>
			</div>
				</form>
				</div>
				 <div class="col-md-12">
          		<button class="btn btn-danger nextBtn btn-lg pull-right" type="button">Next</button>
        </div>
    </div>
	 <!--div class="row setup-content" id="step-2">
        <div class="col-md-12">
		<h3>Personal Details</h3>
		<form action="" method="post">
				<div class="row">
				<div class="col-md-6">
			<div class="cfield">
				<input type="text" placeholder="Name">
				<i class="fa fa-user-o" aria-hidden="true"></i>	
				</div>
				</div>
				<div class="col-md-6">
			<div class="cfield">
				<input type="text" placeholder="Email id">
				<i class="fa fa-mobile" aria-hidden="true"></i>		
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
			<div class="cfield">
				<input type="text" placeholder="Mobile">
				<i class="fa fa-envelope-o" aria-hidden="true"></i>		
				</div>
				</div>
				<div class="col-md-6">
			<div class="cfield">
				<input type="password" placeholder="Password">
				<i class="fa fa-key" aria-hidden="true"></i>		
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
				<div class="dropdown-field">
				<select data-placeholder="" class="chosen" style="display: none;">
					<option>--Total Work Exp.--</option>
					<option>1 Year</option>
					<option>2 Year</option>
					<option>4 Year</option>
				</select>
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
		</form>
		  <button class="btn btn-warning prevBtn btn-lg pull-left" type="button">Previous</button>
          <button class="btn btn-danger nextBtn btn-lg pull-right" type="button">Next</button>
        </div>
    </div>
	 <div class="row setup-content" id="step-3">
        <div class="col-md-12">
		<h3>Education Details</h3>
		<form action="" method="post">
				<div class="row">
				<div class="col-md-6">
			<div class="dropdown-field">
				<select data-placeholder="" class="chosen" style="display: none;">
					<option>--Highest Qualification--</option>
					<option>10th</option>
					<option>12th</option>
					<option>B.Sc</option>
				</select>
			</div>
				</div>
				<div class="col-md-6">
			<div class="dropdown-field">
				<select data-placeholder="" class="chosen" style="display: none;">
					<option>--Course--</option>
					<option>Course1</option>
					<option>Course2</option>
					<option>Course3</option>
				</select>
			</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
			<div class="dropdown-field">
				<select data-placeholder="" class="chosen" style="display: none;">
					<option>--Specialization--</option>
					<option>Specialization1</option>
					<option>Specialization2</option>
					<option>Specialization3</option>
				</select>
			</div>
				</div>
				<div class="col-md-6">
				<div class="cfield">
				<input type="password" placeholder="Search University / College">
			<i class="fa fa-university" aria-hidden="true"></i>	
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
				<div class="dropdown-field">
				<select data-placeholder="" class="chosen" style="display: none;">
					<option>--Course Type--</option>
					<option>Full</option>
					<option>Part</option>
					<option>Correspondence</option>
				</select>
			</div>
				</div>
				<div class="col-md-6">
				<div class="dropdown-field">
				<select data-placeholder="" class="chosen" style="display: none;">
					<option>--Passing Year--</option>
					<option>2005</option>
					<option>2006</option>
					<option>2008</option>
				</select>
			</div>
				</div>
				</div>
		</form>
		  <button class="btn btn-warning prevBtn btn-lg pull-left" type="button">Previous</button>
          <button class="btn btn-danger nextBtn btn-lg pull-right" type="button">Next</button>
        </div>
    </div-->
	 <div class="row setup-content" id="step-4">
        <div class="col-md-12">
		<h3>Employer Details</h3>
		<form action="" method="post">
<div class="row">
				<div class="col-md-6">
			<input type="text" placeholder="User Name">
				<i class="fa fa-user" aria-hidden="true"></i>		
				</div>
				<div class="col-md-6">
			<input type="text" placeholder="Company Name">
				<i class="fa fa-mobile" aria-hidden="true"></i>		
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
			<input type="text" placeholder="Email">
				<i class="fa fa-mobile" aria-hidden="true"></i>		
				</div>
				<div class="col-md-6">
				<div class="cfield">
				<input type="text" placeholder="Address">
				<i class="fa fa-mobile" aria-hidden="true"></i>		
				</div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
				<input type="password" placeholder="Password">
				<i class="fa fa-key" aria-hidden="true"></i>		
				</div>
				<div class="col-md-6">
				<input type="password" placeholder="Re-enter password">
				<i class="fa fa-key" aria-hidden="true"></i>		
				</div>
				</div>
				<div class="row">
				<div class="col-md-6">
				<input type="text" placeholder="Website URL">
				<i class="fa fa-key" aria-hidden="true"></i>		
				</div>
				</div>
		</form>
		  <!--button class="btn btn-warning prevBtn btn-lg pull-left" type="button">Previous</button-->
          <button class="btn btn-success nextBtn btn-lg pull-right" type="button">Submit</button>
        </div>
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
	</section>

	<?php require("footer.php");?>

</div>

<?php require("script.php");?>


<script>
$(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn'),
  		  allPrevBtn = $('.prevBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });
  
  allPrevBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

          prevStepWizard.removeAttr('disabled').trigger('click');
  });

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

