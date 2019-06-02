        <!-- Main content -->
        <section class="content">
		<?php if(isset($_GET['msg'])):  ?>
           <div class="errors" style="color:red;text-align: center;"><?php echo' This City Content Details already exits';?></div>
         <?php endif; ?>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Delivery Management</h3>
				  <a href="<?php echo base_url();?>city/addDeliverydata" class="pull-right">  <button class="btn bg-maroon btn-flat margin">Add Delivery Data</button></a>
                </div><!-- /.box-header -->
				
				<div class="box-body">
					
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>S.No.</th>
                        <th>State Name</th>
                        <th>City Name</th>
                        <th>City Delivery Price</th>
                        <th>City Delivery days</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
					  <?php if($cityName){?>
					  <?php $i=1; foreach($cityName as $cityNameList):?>
					    <td><?php echo $i;?></td>
					    <td><?php echo $cityNameList->stateName;?></td>
					    <td><?php echo $cityNameList->cityName;?></td>
					    <td><?php echo $cityNameList->deliveryCharges;?></td>
					    <td><?php echo $cityNameList->deliveryDays;?></td>
					   
                        <td>
							<!--a href="<?php echo base_url(); ?>admin/Citycontent/getCityContent?id=<?php echo $cityNameList->cityId;?>">
							  <span class="fa fa-laptop" id="viewDet"></span>
						    </a-->					
						    <!--  <a href="<?php echo base_url(); ?>admin/Citycontent/addCityContent?id=<?php echo $cityNameList->cityId;?>">
						     <span class="fa fa-pencil-square-o" id="res"></span>
						    </a>-->
							
							<a href="<?php echo base_url(); ?>city/editCityDeliveryPrice?id=<?php echo $cityNameList->cityId;?>">
							  <span class="fa fa-edit" id="viewDet"></span>
						    </a>		
						</td>
                      </tr>
					  <?php $i++; endforeach; } else { ?>
					<center><tr><td colspan="5"><h3> Result Not found </h3></td></tr></center>
					<?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>S.No.</th>
                        <th>State Name</th>
                        <th>City Name</th>
                        <th>City Delivery Price</th>
                        <th>City Delivery days</th>
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
       function deleteBeauticianDetails(id) {
			var r = confirm("Do you want to Delete Beautician information ?");
			if (r == true) {
				window.location.assign("<?php echo base_url(); ?>admin/Beautician/deleteBeauticianInfo/"+id); 
			}
		}
		
		function activeEnactive(id, value) {
			if(value==1){
				value=0;
			}
			else{
				value=1;
			}
            var r = confirm("Do you want to change status ?");
            if (r == true) {
               window.location.assign("<?php echo base_url(); ?>admin/Beautician/beauticianActiveStatus?inactiveStatusId="+id+"&&statusValue="+value); 
	        }
    
        }
		</script>
		