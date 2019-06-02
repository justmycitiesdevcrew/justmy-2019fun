        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">City Page List</h3>
                </div><!-- /.box-header -->
				
				<div class="box-body">
					<form action="#<?php //echo base_url()."admin/Beautician"?>" name="beauticianForm" method="POST">
					<div class="row">
						
						<div class="col-sm-4">
							<div class="dataTables_length" id="example1_length">
								<label>City</label>
								
								<select name="cityname" aria-controls="example1" value="<?php echo base_url(); ?>" class="form-control input-sm" style="width:50%;">
								<option value="">All City</option>
								<?php foreach($city as $cityDetails): ?>
									<option value="<?php echo $cityDetails['city_name']; ?>"><?php echo $cityDetails['city_name']; ?></option>
									
									<?php endforeach; ?>
								</select> 
							</div>
						</div>
						
						<div class="col-sm-2">
							<div class="dataTables_length" id="example1_length">
								<button type="submit" class="btn btn-primary">Filter</button>
								
							</div>
						</div>
						</form>
					<div class="col-sm-3">
							<div class="dataTables_length" id="example1_length">
								<button  type="button" class="btn btn-success" style="float:right;" onclick="window.location.href='<?php echo base_url(); ?>city/addCityLocality?id=<?php echo $cityId; ?>'" />Add City Locality</button>
							</div>
						</div>
						
					
					</div>
					<hr/>
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>S No.</th>
                        <th>City Name</th>
                        <th>City Locality</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody><?php if($cityLocality){?>
					  <tr>
					  <?php $i=1; foreach($cityLocality as $cityLocalityList):?>
					    <td><?php echo $i;?></td>
					    <td><?php echo $cityLocalityList->city_name;?></td>
					    <td><?php echo $cityLocalityList->city_locality_name;?></td>
					    
                        <td>
						<?php 
							if($cityLocalityList->status) $status=1; 
							
							else $status=0;
						?>
						<a href="#" onclick="activeEnactive(<?php echo $cityLocalityList->city_locality_id.', '.$status.', '.$cityLocalityList->city_id; ?>)">
						<?php echo ($cityLocalityList->status==1) ? '<span class="label label-success" style="font-size:12px;">Active</span>' 
						: '<span class="label label-danger" style="font-size:12px;">Inactive</span>'; ?>
						</a>
						</td>
                        <td>
							<a href="<?php echo base_url(); ?>city/editCityLocalityDetails?id=<?php echo $cityLocalityList->city_locality_id;?>">
							  <span class="fa fa-pencil-square-o" id="viewDet"></span>
						    </a> 
						</td>
                      </tr>
					  <?php $i++; endforeach; }else{?>
					  
					<center><tr><td colspan="5"><h3> Result Not found </h3></td></tr></center>
					<?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                       <th>S No.</th>
                        <th>City Name</th>
                        <th>City Locality</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
			
<script>
       /* function deleteBeauticianDetails(id) {
			var r = confirm("Do you want to Delete  information ?");
			if (r == true) {
				window.location.assign("<?php echo base_url(); ?>admin/Beautician/deleteBeauticianInfo/"+id); 
			}
		} */
		
		function activeEnactive(id, value, cityid) {
			if(value==1){
				value=0;
			}
			else{
				value=1;
			}
            var r = confirm("Do you want to change status ?");
            if (r == true) {
               window.location.assign("<?php echo base_url(); ?>city/cityLocalityActiveStatus?inactiveStatusId="+id+"&&statusValue="+value+"&&cityId="+cityid); 
	        }
    
        }
		</script>
		