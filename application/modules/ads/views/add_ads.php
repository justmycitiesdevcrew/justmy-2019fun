        <!-- Main content -->
<section class="content">
    <div class="row">
            <!-- left column -->
		<div class="col-md-12">
              <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header" style="background-color: rgba(19, 17, 17, 0.21);">
                  <h3 class="box-title">Add Ads </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
				
				
				
			    <div class="box-body">
					<form  action="<?php echo base_url();?>ads/insertAd" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">					
								  <label for="market">Market Name</label>
								  <select class="form-control" name="market_name"  required>
									 <option value="">---Select Market---</option>
							   
								<?php if($marketLists){
									foreach($marketLists as $keys=>$marketList):
								?>	
								  <option value="<?php echo $marketList['market_id'] ?>" ><?php echo ucfirst($marketList['market_name']); ?></option>
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
								  <option value="<?php echo $profileList['profile_id'] ?>"><?php echo ucfirst($profileList['profile_name']); ?></option>
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
									<option value="1">Site</option>
									<option value="2">Channel</option>
									<option value="3">Member</option>
									<option value="4">Non-Member</option>
									<option value="5">Sponsorship</option>
								  </select>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-6">
								<div class="form-group">					
								  <label for="ad_size">Ad Size</label>
								  <select class="form-control" name="ad_size"  required>
									<option value="">---Select Ad-Size---</option>
									<option value="1">3/4 Width</option>
									<option value="2">Full Width</option>
									<option value="3">3/4 Width - Interactive</option>
									<option value="4">Full Width - Interactive</option>
									<option value="5">Skyscraper</option>
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
									<option value="1">Site</option>
									<option value="2">Channel</option>
									<option value="3">Member</option>
									<option value="4">Non-Member</option>
									<option value="5">Sponsorship</option>
								  </select>
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <label for="ad_code">Ad Code</label>
								  <input type="text" name="ad_code" id="ad_code" class="form-control" placeholder="Enter Ad Code">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <label for="ad_url">Ad Url</label>
								  <input type="text" name="ad_url" id="ad_url" class="form-control" placeholder="Enter Ad Url" pattern="https?://.+">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <label for="ad_video">Video</label>
								  <input type="file" name="ad_video" id="ad_video" accept="video/*">
								</div>
							</div>
							<div class="col-lg-6 col-sm-6 col-xs-12">
								<div class="form-group">
								  <label for="ad_banner">Banner</label>
								  <input type="file" name="ad_banner" id="ad_banner" accept="image/x-png,image/gif,image/jpeg,image/jpg">
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
