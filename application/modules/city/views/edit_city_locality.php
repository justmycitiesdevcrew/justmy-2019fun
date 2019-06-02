<section class="content">
<div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
				<div class="box-header">
                  <h3 class="box-title">City Locality Form</h3>
                </div>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                    <form  action="<?php echo base_url()."city/cityLocalityDetailsUpdate"?>"  enctype="multipart/form-data" method="post">
					<?php foreach($cityLocalityDetails as $cityLocalityList): ?>
					<div class="form-group">
                      <label for="inputProduct">Locality Name</label>
                      <input name="localityname" class="form-control" id="inputProduct" value="<?php echo $cityLocalityList->city_locality_name;?>" required>
					  <input name="cityid" class="form-control" id="inputProduct" value="<?php echo $cityLocalityList->city_id;?>" type="hidden">
					  <input name="citylocalityid" class="form-control" id="inputProduct" value="<?php echo $cityLocalityList->city_locality_id;?>" type="hidden">
                    </div>
					<?php endforeach?>
					
					
					
					
					<center><input class="btn btn-success" type="submit" value="Submit"></center>
					</form>
					<?php  //endforeach;?>
                  </div><!-- /.tab-pane -->
                  
                  
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
			</div><!--/.row -->
			
</section><!-- /.content -->	
