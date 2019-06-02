<!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit Delivery Data List</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body">				  
				  <?php 
				  foreach($cityList as $list): ?>
					<form role="form" onsubmit="return UserValidation()" action="<?php echo base_url(); ?>city/updateCityDeliveryPrice?id=<?php echo $list->cityId;?>" method="post" enctype="multipart/form-data"/>
                    <input type="hidden" name="id" value="<?php echo $list->cityId; ?>" >
					
					<!--div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group">
                      <label for="inputProduct">State</label>
                     <select name="state" id="state" aria-controls="example1" class="form-control input-sm" style="width:100%; display:block" onchange="subCat(this.value)">
								<option value="">State</option>
								<?php $status= getStatesList();
								foreach($status as $statusDetails): ?>
									<option value="<?php echo $statusDetails['city_id']; ?>" <?php if($list->stateId == $statusDetails['city_id']){echo "selected";} ?>><?php echo $statusDetails['state_name']; ?></option>						
									<?php endforeach; ?>
					</select> 
                    </div-->
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group" >					
						<div id="subCatIddiv">	
						<label for="city">City</label>						
						<input type="text" name="city" class="form-control" id="inputProduct" value="<?php echo $list->cityName;?>">
						 </div>
                    </div>
					
					<div class=" col-lg-6 col-md-6 col-sm-6 col-xs-6 form-group">					
                      <label for="customerName">City Delivery Price</label>
					   <input type="number" name="deliveryPrice" class="form-control" id="inputProduct" value="<?php echo $list->deliveryCharges;?>">
                    
                    </div>
					
					<?php  $qua = explode(',',($list->deliveryDays	));?>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group days-alert">
					<label for="inputProduct">City Delivery Days</label>
						<select class="form-control langOpt3 y0 deliveryDays custom2" multiple name="deliveryDays[]" id="deliveryDaysmultiselect" style="width:100%">
									<option class="kd" <?php if(in_array('Monday',$qua)){echo "selected";} ?> value="Monday">Monday</option>
									<option class="kd"   <?php if(in_array('Tuesday',$qua)){echo "selected";} ?> value="Tuesday">Tuesday</option>
									<option class="kd"  <?php if(in_array('Wednesday',$qua)){echo "selected";} ?> value="Wednesday">Wednesday</option>
									<option class="kd"  <?php if(in_array('Thursday',$qua)){echo "selected";} ?> value="Thursday">Thursday</option>
									<option class="kd"  <?php if(in_array('Friday',$qua)){echo "selected";} ?> value="Friday">Friday</option>
									<option class="kd"  <?php if(in_array('Saturday',$qua)){echo "selected";} ?> value="Saturday">Saturday</option>
									<option class="kd"  <?php if(in_array('Sunday',$qua)){echo "selected";}  ?> value="Sunday">Sunday</option>
						</select>
					</div>
				
					
					<br>
					<div class="text-center">
					<button class="btn btn-success" type="submit" value="submit" style="margin:10px;">Update</button>
					</div>
					<?php endforeach; ?>
					</form>
				  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
			  
			  
			  </div><!-- /.col (right) -->
          </div><!-- /.row -->

        </section><!-- /.content -->
		<script>
	function UserValidation(){
	//alert('sff');
	
    var state = $("#customerOrderId").val();
	var customerName = $("#customerName").val();
	var customerMobile = $("#customerMobile").val();
	var SelectCity = $("#SelectCity").val();
	var customerRating = $("#customerRating").val();
	var HeaderText = $("#HeaderText").val();
	var Message = $("#Message").val();
	
	
	 if(customerOrderId=="")
	 {
	 $("#customerOrderId").html('Enter Order Id ');
	 $("#customerOrderId").focus();
	  $("#customerOrderId").fadeOut(10000);
	 return false;
	 }
	 if(customerName=="")
	 {
	 $("#customerName").html('Enter Customer Name');
	 $("#customerName").focus();
	  $("#customerName").fadeOut(10000);
	 return false;
	 }
	 if(customerMobile=="")
	 {
	 $("#customerMobile").html('Enter your Mobile No');
	 $("#customerMobile").focus();
	  $("#customerMobile").fadeOut(10000);
	 return false;
	 }
	  if(SelectCity=="")
	 {
	 $("#SelectCity").html('Please Select your city');
	 $("#SelectCity").focus();
	  $("#SelectCity").fadeOut(10000);
	 return false;
	 }
	 if(customerRating=="")
	 {
	 $("#customerRating").html('Please Enter Rating');
	 $("#customerRating").focus();
	  $("#customerRating").fadeOut(10000);
	 return false;
	 }
	 if(HeaderText=="")
	 {
	 $("#HeaderText").html('Please Enter Text');
	 $("#HeaderText").focus();
	  $("#HeaderText").fadeOut(10000);
	 return false;
	 }
	 if(Message=="")
	 {
	 $("#Message").html('Please Enter Message');
	 $("#Message").focus();
	  $("#Message").fadeOut(10000);
	 return false;
	 }
   return true;
     
}	


</script>
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
function subCat(id) {
	var stateId = id;
	//var load = ``;
	//$("#setproductlist").html(load);
//	return false;
	if(stateId){
		$.ajax({
			type: "POST",
			url: '<?php echo base_url(); ?>city/subcategories',
		//	dataType: 'json',
			data: {"stateId":stateId},
			success: function(result){
				var obj = JSON.parse(result); 
					$("#subCatIddiv").html(obj.Result);					
				if(obj.Success == 'True' ){
					$("#subCatIds").attr('required','true');
				}else{
					$("#subCatIds").removeAttr('required','');
				}					
	
				}
			
		});
	}
}

</script>

</script>
<style>
.unselected{
	background-color:#fff!important;
}
</style>


