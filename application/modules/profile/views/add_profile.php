<style>
span.constraint {
    font-size: 10px;
    color: #676565;
}
.urlpost{
		display: inline-block;
    	width: 60%;
	}
.urlfont{
	font-weight: 100;
	display: inline-block !important;
}
.web {
    display: block!important;
}
</style>
<?php //echo "<pre>"; print_r($data['marketLists']);die;  ?>     
		<!-- Main content -->
<section class="content">
    <div class="row">
            <!-- left column -->
		<div class="col-md-12">
              <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header" style="background-color: rgba(19, 17, 17, 0.21);">
                  <h3 class="box-title">Add Profile </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
					  <div class="box-body">
							<form  action="<?php echo base_url();?>profile/insertProfile" method="post" enctype="multipart/form-data">
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-xs-6">
										<div class="form-group">					
										  <label for="ProfileName">Name</label>
										  <input type="text" name="name" class="form-control" id="ProfileName" placeholder="Enter name" value="" required>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-xs-6">
										<div class="form-group">
										  <label for="UserName">Username</label><span class="constraint"> (No Special Characters and Spaces are allowed.)</span>
										  <input type="text" name="user_name" value="" class="form-control" id="UserName" placeholder="Enter Username" onkeypress="return checkSpcialChar(event)" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-xs-12">
										<div class="form-group">					
										  <label for="Contact">Contact No.</label>
										  <input type="text" name="contact" class="form-control" id="Contact" placeholder="Enter Contact No." value="" required>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-xs-12">
										<div class="form-group">
										  <label for="Zip">Zip</label>
										  <input type="text" name="zip" value="" class="form-control" id="zip" placeholder="Enter Zip No." required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-xs-12">
										<div class="form-group">					
										  <label for="Email">Email</label>
										  <input type="text" name="email" class="form-control" id="Email" placeholder="Enter Email" value="" required>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-xs-12">
										<div class="form-group">
										  <label for="Web" class="web">Web</label>
										  <label class="urlfont">www.</label><input type="text" name="web" value="" class="form-control urlpost" id="web" placeholder="Enter Web" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 col-sm-12 col-xs-12">
										<div class="form-group">					
										  <label for="Address">Address</label>
										  <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" value="" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-6 col-sm-6 col-xs-6">
										<div class="form-group">
										  <label for="City">City</label>
										  <input type="text" name="city" value="" class="form-control" id="City" placeholder="Enter City" required>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-xs-6">
										<div class="form-group">
										  <label for="State">State</label><span class="constraint"> (Enter 2-characters state abbreviation.)</span>
										  <input type="text" name="state" value="" class="form-control" id="State" placeholder="Enter State" maxlength="2" required>
										</div>
									</div>
								</div>
								<center><input class="btn btn-info" type="submit" value="Submit" ></center>	
							</form>
						</div><!-- /.box -->
					</div>
				</div>
			</div>
</section>
					
<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
<script type="text/javascript">
         function checkSpcialChar(event){
            if(!((event.keyCode >= 65) && (event.keyCode <= 90) || (event.keyCode >= 97) && (event.keyCode <= 122) || (event.keyCode >= 48) && (event.keyCode <= 57))){
               event.returnValue = false;
               return;
            }
            event.returnValue = true;
         }
</script>