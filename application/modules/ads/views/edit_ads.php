<style>
.form-group label {
    display: block;
    font-size: 14px;
    font-weight: 500;
}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/build.min.css">
<script src="<?php echo base_url(); ?>assets/dist/js/build.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/fastselect.min.css">
<script src="<?php echo base_url(); ?>assets/dist/js/fastselect.standalone.js"></script> 
       <!-- Main content -->
<section class="content">
    <div class="row">
            <!-- left column -->
		<div class="col-md-12">
              <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header" style="background-color: rgba(19, 17, 17, 0.21);">
                  <h3 class="box-title">Edit Ads</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				
				
				
			    <div class="box-body">
					<?php //echo "<pre>";print_r($categories); die; ?>
					<?php $i=1; foreach ($ads as $ads):$i++;?>
					<form id="" role="form" action="<?php echo base_url(); ?>ads/updateAd?Id=<?php echo $ads['id'];?>" enctype="multipart/form-data" method="post"  class="attireCodeToggleBlock"/>
                    <input type="hidden" name="id" value="<?php echo $ads['id']; ?>" >
						<div class="row">
									<div class="col-lg-6 col-sm-6 col-xs-6">
										<div class="form-group">
											  <label for="InputMarket">Category</label>
											  <select class="form-control multipleSelect" name="categories[]"  multiple>
												 <option value="">---Select Categories---</option>
										  
											<?php if($categoryLists){
												//echo "<pre>"; print_r($categoryLists);die;
												foreach($categoryLists as $keys=>$categoryList):
												$isSelected = '';
														foreach($categoryAddedLists as $categoryAddedList){
															if($categoryAddedList['cat_id'] == $categoryList['id']){
																$isSelected = 'selected';
															}
														}
											?>	
											  <option value="<?php echo $categoryList['id'] ?>" <?php echo $isSelected; ?>><?php echo ucfirst($categoryList['cc_title']); ?></option>
												<?php 
												endforeach; } ?>
					
											</select>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-xs-6">
										<div class="form-group">
											  <label for="InputProfile">Profile Channel</label>
											  <select class="form-control multipleSelect" name="channel[]"  multiple>
												 <option value="">---Select Channels---</option>
										  
											<?php if($channelLists){
												//echo "<pre>"; print_r($categoryLists);die;
												foreach($channelLists as $keys=>$channelList):
												$isSelected = '';
														foreach($channelAddedLists as $channelAddedList){
															if($channelAddedList['channel_id'] == $channelList['channel_id']){
																$isSelected = 'selected';
															}
														}
											?>	
											  <option value="<?php echo $channelList['channel_id'] ?>" <?php echo $isSelected; ?>><?php echo ucfirst($channelList['channel_name']); ?></option>
												<?php 
												endforeach; } ?>
					
											</select>
										</div>
									</div>
								</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">					
								  <label for="market">Market Name</label>
								  <select class="form-control" name="market_name"  required>
									 <option value="">---Select Market---</option>
							   
								<?php if($marketLists){
									foreach($marketLists as $keys=>$marketList):
								?>	
								  <option value="<?php echo $marketList['market_id'] ?>" <?php if($marketList['market_id'] ==   $ads['market_id']){ echo "selected"; }?>><?php echo ucfirst($marketList['market_name']); ?></option>
									<?php 
									endforeach; } ?>
								
								  </select>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <label for="profile">Profile</label>
								  <select class="form-control" name="profile_name"  required>
									 <option value="">---Select Profile---</option>
							   
								<?php if($profileLists){
									foreach($profileLists as $keys=>$profileList):
								?>	
								  <option value="<?php echo $profileList['profile_id'] ?>" <?php if($profileList['profile_id'] ==   $ads['profile_id']){ echo "selected"; }?>><?php echo ucfirst($profileList['profile_name']); ?></option>
									<?php 
									endforeach; } ?>
								
								  </select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-6">
								<div class="form-group">					
								  <label for="ad_type">Ad Type</label>
								  <select class="form-control" name="ad_type"  required>
									 <option value="">---Select Ad-Type---</option>
									<option value="1" <?php if($ads['ad_type'] == "site") {?> <?php echo "selected"?> <?php } ?>>Site</option>
									<option value="2" <?php if($ads['ad_type'] == "channel") {?> <?php echo "selected"?> <?php } ?>>Channel</option>
									<option value="3" <?php if($ads['ad_type'] == "member") {?> <?php echo "selected"?> <?php } ?>>Member</option>
									<option value="4" <?php if($ads['ad_type'] == "non-member") {?> <?php echo "selected"?> <?php } ?>>Non-Member</option>
									<option value="5" <?php if($ads['ad_type'] == "sponsorship") {?> <?php echo "selected"?> <?php } ?>>Sponsorship</option>
									
								  </select>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-6">
								<div class="form-group">					
								  <label for="ad_size">Ad Size</label>
								  <select class="form-control" name="ad_size"  required>
									<option value="">---Select Ad-Size---</option>
									<option value="1" <?php if($ads['ad_size'] == "3/4 width ad") {?> <?php echo "selected"?> <?php } ?>>3/4 Width</option>
									<option value="2" <?php if($ads['ad_size'] == "full width ad") {?> <?php echo "selected"?> <?php } ?>>Full Width</option>
									<option value="3" <?php if($ads['ad_size'] == "3/4 width ad - interactive") {?> <?php echo "selected"?> <?php } ?>>3/4 Width - Interactive</option>
									<option value="4" <?php if($ads['ad_size'] == "full width ad - interactive") {?> <?php echo "selected"?> <?php } ?>>Full Width - Interactive</option>
									<option value="5" <?php if($ads['ad_size'] == "skyscraper ad") {?> <?php echo "selected"?> <?php } ?>>Skyscraper</option>
									
								  </select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <label for="ad_link">Ad Link</label>
								  <select class="form-control" name="ad_link"  required>
									<option value="">---Select Ad-Link---</option>
									<option value="1" <?php if($ads['ad_link'] == "site") {?> <?php echo "selected"?> <?php } ?>>Site</option>
									<option value="2" <?php if($ads['ad_link'] == "channel") {?> <?php echo "selected"?> <?php } ?>>Channel</option>
									<option value="3" <?php if($ads['ad_link'] == "member") {?> <?php echo "selected"?> <?php } ?>>Member</option>
									<option value="4" <?php if($ads['ad_link'] == "non-member") {?> <?php echo "selected"?> <?php } ?>>Non-Member</option>
									<option value="5" <?php if($ads['ad_link'] == "sponsorship") {?> <?php echo "selected"?> <?php } ?>>Sponsorship</option>
								  </select>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <label for="ad_code">Ad Code</label>
								  <input type="text" name="ad_code" id="ad_code" class="form-control" placeholder="Enter Ad Code" value="<?php echo $ads['ad_code']; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <label for="ad_url">Ad Url</label>
								  <input type="text" name="ad_url" id="ad_url" class="form-control" placeholder="Enter Ad Url" value="<?php echo $ads['ad_url']; ?>" pattern="https?://.+">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
									  <label for="ad_video">Video</label>
									 
									 <?php if($ads['ad_video']) { ?>
									  <a href="<?php echo base_url().'upload/adsdata/'.$ads['ad_video']; ?>" id="link" target="_blank">
											<span class="label label-success" style="font-size:11px;">View</span>
									  </a>
									  <?php } else { echo '<input type="file" name="ad_video" id="ad_video">'; } ?>
									  <?php if($ads['ad_video']) { ?>
									  <a href="#" id="ad_videoedit" style="visibility:visible;" onclick="deleteadvideo()">
											<span class="label label-danger" style="font-size:11px;">Update</span>
									  </a>
									  <input type="file" name="ad_video" id="ad_video" style="display:none" accept="video/*"> 
										<?php } ?>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
									  <label for="ad_banner">Banner</label>
									 
									 <?php if($ads['ad_banner']) { ?>
									  <a href="<?php echo base_url().'upload/adsdata/'.$ads['ad_banner']; ?>" id="link" target="_blank">
											<span class="label label-success" style="font-size:11px;">View</span>
									  </a>
									  <?php } else { echo '<input type="file" name="ad_banner" id="ad_banner">'; } ?>
									  <?php if($ads['ad_banner']) { ?>
									  <a href="#" id="ad_banneredit" style="visibility:visible;" onclick="deleteadbanner()">
											<span class="label label-danger" style="font-size:11px;">Update</span>
									  </a>
									  <input type="file" name="ad_banner" id="ad_banner" style="display:none" accept="image/x-png,image/gif,image/jpeg,image/jpg> 
										<?php } ?>
								</div>
							</div>
						</div>
						<center><input class="btn btn-info" type="submit" value="Submit" ></center>	
					</form>
					<?php  endforeach;?>
				</div><!-- /.box -->
			</div>
		</div>
	</div>
</section>
<script>
 function deleteadbanner() {
		//alert('hi');
		document.getElementById('ad_banner').style.display='block';
		document.getElementById('ad_banneredit').style.display='none';
		
		}
function deleteadvideo() {
		//alert('hi');
		document.getElementById('ad_video').style.display='block';
		document.getElementById('ad_videoedit').style.display='none';

		}	
</script>					
<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>	
<script>
	$('.multipleSelect').fastselect();
</script>				
