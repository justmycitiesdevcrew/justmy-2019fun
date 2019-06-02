<section class="content">
<div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                
				<div class="box-header">
                  <h3 class="box-title">Add Delivery Data Form</h3>
                </div>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <form onsubmit="return UserValidation()"  action="<?php echo base_url()."city/insertDeliverypriceBycity"?>"  enctype="multipart/form-data" method="post" required>
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group">
                      <label for="inputProduct">State</label>
                     <select name="state" id="state" aria-controls="example1" class="form-control input-sm" style="width:100%; display:block" required>
								<option value="">Select State</option>
								<?php $status= getStatesList();
								foreach($status as $statusDetails): ?>
									<option value="<?php echo $statusDetails['city_id']; ?>" ><?php echo $statusDetails['state_name']; ?></option>						
									<?php endforeach; ?>
					</select> 
                    </div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group">
                      <label for="inputProduct">City</label>
                      <input type="text" name="city" class="form-control" id="city" value="" placeholder="Enter City Name" required>
                    </div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group">
                      <label for="inputProduct">City Delivery Price</label>
                      <input type="number" name="deliveryPrice" class="form-control" id="price" value="" placeholder="0.0" required>
                    </div>
								
					<div class=" col-lg-6 col-md-6 col-xs-6 col-sm-6 form-group">
                      <label for="inputProduct">City Delivery Days</label>
					  <select class="form-control langOpt3 y0 deliveryDays custom2" multiple name="deliveryDays[]" id="deliveryDaysmultiselect" style="width:100%" required>
							<option value="Monday">Monday</option>
							<option value="Tuesday" >Tuesday</option>
							<option value="Wednesday">Wednesday</option>
							<option value="Thursday">Thursday</option>
							<option value="Friday">Friday</option>
							<option value="Saturday">Saturday</option>
							<option value="Sunday">Sunday</option>
					  </select>
                    </div>
					<div class="">
						<input class="btn btn-success" type="submit" value="Submit">
					</div>
					
					
					
					</form>
					<?php  //endforeach;?>
                  </div><!-- /.tab-pane -->
                  
                  
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
			</div><!--/.row -->
			
</section><!-- /.content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">	</script>
<script>

 $(document).ready(function(){

	$('input[type=checkbox]').on('click', function (e) {
		if ($('input[type=checkbox]:checked').length > 2) {
			$(this).prop('checked', false); 
			alert("Please Select only 2 days");
			$(this).parent().attr('class','unselected').delay(2000);
			
		}
	});
});
</script>	
<script>
	function UserValidation(){
	//alert('sff');
	
    var state = $("#state").val();
	var city = $("#city").val();
	var price = $("#price").val();
	var deliveryDaysmultiselect = $("#deliveryDaysmultiselect").val();
	
	
	 if(state=="")
	 {
	 $("#state").html('Please Select State');
	 $("#state").focus();
	  $("#state").fadeOut(10000);
	 return false;
	 }
	 if(city=="")
	 {
	 $("#city").html('Please Enter City');
	 $("#city").focus();
	  $("#city").fadeOut(10000);
	 return false;
	 }
	 if(price=="")
	 {
	 $("#price").html('Please Enter Delivery Price');
	 $("#price").focus();
	  $("#price").fadeOut(10000);
	 return false;
	 }
	  if(deliveryDaysmultiselect=="")
	 {
	 $("#deliveryDaysmultiselect").html('Please Select delivery Days');
	 $("#deliveryDaysmultiselect").focus();
	  $("#deliveryDaysmultiselect").fadeOut(10000);
	 return false;
	 }
	 
   return true;
     
}	


</script>
