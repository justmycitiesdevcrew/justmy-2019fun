<section class="content">
<div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Edit Team Member</a></li>
                 
                 
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <form role="form"  action="<?php echo base_url();?>team/editMember?id=<?= $this->input->get('id') ?>"  enctype="multipart/form-data" method="post" >
					
					<div class="col-md-6">					
                      <label for="inputOrderName">Member Name</label>
                      <input name="name" class="form-control" id="name" value="<?= $member->member_name ?>" placeholder="Name" required>
                    </div>
					<div class="col-md-6">					
                      <label for="inputOrderName">Member Designation</label>
                      <input name="designation" class="form-control" id="Designation" value="<?= $member->member_designation ?>" placeholder="Designation" required>
                    </div>
					<div class="col-md-12">					
                      <label for="inputOrderName">About</label>
                      <textarea id="editor1" rows="4" cols="50" name="about" class="form-control"><?= $member->about ?></textarea>
                    </div>
					<div class="col-md-6">					
                      <label for="inputOrderName">Member Email Id</label>
                      <input type="text" name="email" class="form-control" id="" value="<?= $member->email ?>">
                    </div>
					<div class="col-md-6">					
                      <label for="inputOrderName">Member Twitter Link</label>
                      <input type="text" name="twitter" class="form-control" id="" value="<?= $member->facebook ?>">
                    </div>
					<div class="col-md-6">					
                      <label for="inputOrderName">Member Facebook Link</label>
                      <input type="text" name="facebook" class="form-control" id="" value="<?= $member->twitter ?>">
                    </div>
					<!--div class="col-md-6">					
                      <label for="inputOrderName">Member Photo</label>
                      <input type="file" name="memberImg" class="form-control" id="productImage" value="" >
                    </div-->
					<div class="form-group">
                      <label for="InputProfilePhoto">Image</label>
                     
					 <?php if($member->member_img) { ?>
					  <a href="<?php echo base_url().'upload/'.$member->member_img; ?>" id="link" target="_blank">
							<span class="label label-success" style="font-size:11px;">View</span>
					  </a>
					  <?php } else { echo '<input type="file" name="memberImg" id="InputProfilePhoto">'; } ?>
					  <?php if($member->member_img) { ?>
					  <a href="#" id="userLink" style="visibility:visible;" onclick="deleteUserDetails()">
							<span class="label label-danger" style="font-size:11px;">Update</span>
							
					  </a>
					           <input type="file" name="memberImg" id="InputProfilePhoto" style="display:none">  
						
							
						<?php } ?>
                      
                    </div>
					<br/>
					<div class="form-group">
						<center>
							<label for="inputOrderName"> &nbsp;<br/></label>
							<input class="btn btn-success" id="orderEmailSubmit" type="submit" value="Submit" style=" margin-top: 20px;">
						</center>
					</div>
					
					</form>
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
			</div><!--/.row -->
			
</section><!-- /.content -->	
<script>
 function deleteUserDetails() {
		//alert('hi');
		document.getElementById('InputProfilePhoto').style.display='block';
		document.getElementById('userLink').style.display='none';
		
		}
</script>