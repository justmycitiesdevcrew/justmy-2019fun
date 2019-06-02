<!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Edit Testimonial List</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body">				  
				  <?php //foreach($customer as $customerDetail): ?>
					<form role="form" onsubmit="return UserValidation()" action="<?php echo base_url(); ?>feedback/updateFeedback?Id=<?php echo $feedback[0]['feedback_id'];?>" method="post" enctype="multipart/form-data"/>
                    <input type="hidden" name="id" value="<?php echo $feedback[0]['feedback_id']; ?>" >
					<div class="form-group">					
                      <label for="customerOrderId">Order Id</label>
                      <input type="text" name="orderId" class="form-control" id="customerOrderId" value="<?php echo $feedback[0]['customer_order_id']; ?>" required>
                    </div>
					<div class="form-group">
							<label>Created Date</label>				
							  <input readonly name="created_date" class="form-control" id="" value="<?php echo date('d-m-Y H:i',strtotime($feedback[0]['created_date'])); ?>" >
					</div>
					<div class="form-group">					
                      <label for="customerName">Customer Name</label>
                      <input type="text" name="name" class="form-control" id="customerName" value="<?php echo $feedback[0]['customer_name']; ?>" required>
                    </div>
					<div class="form-group">
                      <label for="customerMobile">Mobile No.</label>
                      <input type="text" name="phone" class="form-control" id="customerMobile" value="<?php echo $feedback[0]['moblie_no']; ?>" required>
                    </div>
					<div class="form-group">					
                    <label>City Name</label>								
								<select name="city" aria-controls="example1" class="form-control input-sm" style="width:100%; display:block" id="SelectCity" required>
								<option value="">City</option>
								<?php $status =getCities();
								foreach($status as $statusDetails): ?>
									<option value="<?php echo $statusDetails['city_id']; ?>" <?php if($feedback[0]['city_id'] == $statusDetails['city_id']){echo "selected";} ?>><?php echo $statusDetails['city_name']; ?></option>						
									<?php endforeach; ?>
								</select> 
                    </div>
					<div class="form-group">
					 <label for="customerRating">Rating</label>
						<select class="form-control" name="rating" id="customerRating">
								<option value="0">Rating</option>
								<option value="1" <?php if($feedback[0]['rating_id'] == '1'){	echo "selected";} ?>>1</option>
								<option value="2" <?php if($feedback[0]['rating_id'] == '2'){	echo "selected";} ?>>2</option>
								<option value="3" <?php if($feedback[0]['rating_id'] == '3'){	echo "selected";} ?>>3</option>
								<option value="4" <?php if($feedback[0]['rating_id'] == '4'){	echo "selected";} ?>>4</option>
								<option value="5" <?php if($feedback[0]['rating_id'] == '5'){	echo "selected";} ?>>5</option>
						</select>
					</div>
							
					
					<div class="form-group">					
                      <label for="customerHeadertext">Header Text</label>
                      <input type="text" name="header_text" class="form-control" id="HeaderText" value="<?php echo $feedback[0]['header_text']; ?>" required>
                    </div>
					<div class="form-group">					
                      <label for="customerMessage">Message</label>
                      <textarea type="text" name="message" class="form-control" id="Message" value="" required><?php echo $feedback[0]['message']; ?>
					  </textarea>
                    </div>
					
					<br/>
					<button class="btn btn-success" type="submit" value="submit" style="margin:10px;">Update</button>
					
					<?php //endforeach; ?>
					</form>
				  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
			  
			  
			  </div><!-- /.col (right) -->
          </div><!-- /.row -->

        </section><!-- /.content -->
		<script>
	function UserValidation(){
	//alert('sff');
	
    var customerOrderId = $("#customerOrderId").val();
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
