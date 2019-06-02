<style>
	.multiselect-container li a label{
		padding-left:10px;
		cursor:pointer;
	}
	.multiselect-container{
		height:400px;
		overflow:auto;
		
	}
	
</style>
<section class="content">
<div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <div class="box-header"><h3>Edit Company Setting</h3></div>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <form role="form" action="<?php echo base_url(); ?>settings/updatesetting?id=<?php echo $settings[0]['id']; ?>" enctype="multipart/form-data"  method="post" onsubmit="return UserValidation();">
					<div class="col-md-12">
					 <div class="form-group">				
						  <label for="inputName">Company Name</label><span id="" style="color:red;"></span>
						<input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo $settings[0]['company_name']; ?>">
					 </div>
					 
					<hr>
					</div>
					<div class="col-md-6"> 
					  <div class="form-group">						
						  <label for="inputName">Email Id</label><span id="Name" style="color:red;"></span>
						  <input name="email" id="email" class="form-control" value="<?php echo $settings[0]['email']; ?>">
						</div>
						<div class="form-group">						
						  <label for="inputName">Website Url</label><span id="Name" style="color:red;"></span>
						  <input name="website_url" id="website_url" class="form-control" value="<?php echo $settings[0]['website_url']; ?>">
						</div>
						<div class="form-group">						
						  <label for="inputName">Logo</label><span id="Name" style="color:red;"></span>
						  <input type="file" name="logo" id="" class="form-control" value=""  onchange="readURL(this);" >
						</div>
						<div class="form-group">
						  <img src="<?php echo base_url().'upload/'.$settings[0]['logo']; ?>" id="logo" width="200px">						
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="form-group">
						  <label for="inputMobile">Address</label><span id="Mobile" style="color:red;"></span>
						  <input name="address" id="address" class="form-control" value="<?php echo $settings[0]['address']; ?>">
						</div>
						<div class="form-group">
						  <label for="inputMobile">City</label><span id="Mobile" style="color:red;"></span>
						  <input class="form-control" name="city" id="city" value="<?php echo $settings[0]['city']; ?>">
						</div>
						<div class="form-group">
						  <label for="inputMobile">Country</label><span id="" style="color:red;"></span>
						  <input name="country" class="form-control" id="country" value="<?php echo $settings[0]['country']; ?>">
						</div>
						<div class="form-group">
						  <label for="inputMobile">Postcode</label><span id="" style="color:red;"></span>
						  <input name="postcode" class="form-control" id="postcode" value="<?php echo $settings[0]['postcode']; ?>">
						</div>
						<div class="form-group">
						  <label for="inputMobile">Telephone</label><span id="" style="color:red;"></span>
						  <input name="telephone" class="form-control" id="telephone" value="<?php echo $settings[0]['telephone']; ?>">
						</div>
						<div class="form-group">
						  <label for="inputMobile">Reg No.</label><span id="" style="color:red;"></span>
						  <input name="regno" class="form-control" id="regno" value="<?php echo $settings[0]['regno']; ?>">
						</div>
                                           
						<div class="form-group">
						  <label for="inputMobile">VAT No.</label><span id="" style="color:red;"></span>
						  <input name="vatno" class="form-control" id="vatno" value="<?php echo $settings[0]['vatno']; ?>">
						</div>
                                                <div class="form-group">
						  <label for="inputMobile">GST No.</label><span id="" style="color:red;"></span>
						  <input name="Gstno" class="form-control" id="Gstno" value="<?php //echo $settings[0]['gstno']; ?>">
						</div>

                                                
					</div>
					<center><input class="btn btn-success" type="submit" value="Update" ></center>					
		
					</form>
                  </div><!-- /.tab-pane -->
                  
                  
				  
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
			</div><!--/.row -->
			
</section><!-- /.content -->  
    <script>  
      var j = jQuery.noConflict();  
          j(function() {   
          j( "#datepicker" ).datepicker({
              changeMonth:true,
            changeYear:true,
            yearRange: "1965:2020",
            dateFormat: 'dd-mm-yy',
            showButtonPanel: true,
            });    
         
          });  
          
</script>	
<script>
 function doctorPhotoAdd() {
		//alert('hi');
		document.getElementById('Logo').style.display='block';
		document.getElementById('logoLink').style.display='none';
		
		}
		function doctorIdproofAdd() {
		//alert('hi');
		document.getElementById('id').style.display='block';
		document.getElementById('idLink').style.display='none';
		
		}
		function doctorTrainingAdd() {
		//alert('hi');
		document.getElementById('training').style.display='block';
		document.getElementById('trainingLink').style.display='none';
		
		}
		function doctorCertificateAdd() {
		//alert('hi');
		document.getElementById('Certificate').style.display='block';
		document.getElementById('certificateLink').style.display='none';
		
		}
</script>
<script>
 function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#logo')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>		
<script>
function UserValidation(){
		var company_name = $("#company_name").val();
		var email = $("#email").val();
		var address = $("#address").val();
		var website_url = $("#website_url").val();
		var city = $("#city").val();
		//var logo = $("#logo").val();
		var country = $("#country").val();
		var postcode = $("#postcode").val();
		var telephone = $("#telephone").val();
		var regno = $("#regno").val();
		var vatno = $("#vatno").val();
        var Gstno = $("#Gstno").val();
               		 if(company_name=="")
		 {
		var msg = 'Enter User Name';
		 alert(msg);
		 $("#company_name").focus();
		 return false;
		 }
		 if(email=="")
		 {
		 var msg = 'Enter Vailid Email Id';
		 alert(msg);
		 $("#email").focus();
		 return false;
		 }
		 if(address=="")
		 {
		 var msg = 'Enter Your Address.';
		 $("#address").focus();
		 alert(msg);
		 return false;
		 }
		  if(website_url=="")
		 {
		 var msg= 'Enter Your Website URL.';
		 $("#website_url").focus();
		 alert(msg);
		 return false;
		 }
		  if(city=="")
		 {
		 var msg= 'Enter Your City.';
		 $("#city").focus();
		 alert(msg);
		 return false;
		 }
		/*   if(logo=="")
		 {
		 var msg= 'Choose Logo';
		 $("#logo").focus();
		 alert(msg);
		 return false;
		 } */
		  if(country=="")
		 {
		 var msg= 'Enter Your Country';
		 $("#country").focus();
		 alert(msg);
		 return false;
		 }
		  if(postcode=="")
		 {
		 var msg= 'Enter Your Postcode';
		 $("#postcode").focus();
		 alert(msg);
		 return false;
		 }
		  if(telephone=="")
		 {
		 var msg= 'Enter Your Telephone No';
		 $("#telephone").focus();
		 alert(msg);
		 return false;
		 }
		  if(regno=="")
		 {
		 var msg= 'Entet REG No.';
		 $("#regno").focus();
		 alert(msg);
		 return false;
		 }
		  if(vatno=="")
		 {
		 var msg= 'Enter VAT No.';
		 $("#vatno").focus();
		 alert(msg);
		 return false;
		 }
                  if(Gstno=="")
		 {
		 var msg= 'Enter GST No.';
		 $("#Gstno").focus();
		 alert(msg);
		 return false;
		 }

                  
	   return true;
		 
	}	
</script>