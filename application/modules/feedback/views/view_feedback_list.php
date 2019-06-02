        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
     
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Testimonial List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
			
					<hr/>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					    <th>S No.</th>
						<th>Order Id</th>
						<th>Created Date</th>
                        <th>Customer Name</th>
                        <th style="max-width: 12px;">Mobile No</th>
                        <!--th style="max-width: 12px;">Email ID</th-->
                        <th style="max-width: 12px;">City Name</th>
                        <th style="max-width: 12px;">Rating</th>
						 <th style="max-width: 12px;">Header Text</th>
                       <th style="max-width: 12px;">Message</th>
                       <th style="max-width: 12px;">Status</th>
                        <th style="max-width: 12px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
					
                      <tr>
					  <?php if($feedback){?>
                       <?php $i = 1; foreach($feedback as $feedbackList):?>
                        <td><?php echo $i;?></td>
						<td><?php if($feedbackList['customer_order_id']){echo "".$feedbackList['customer_order_id'];}else{echo "";}?></td>
						<td><?php echo date('d-m-Y',strtotime($feedbackList['created_date']));?></td>
                        <td><?php echo $feedbackList['customer_name'];?></td>
                        <td><?php echo $feedbackList['moblie_no'];?></td>
                        <!--td><?php //echo $feedbackList['email_id'];?></td-->
                        <td><?php echo $feedbackList['city_name'];?></td>
                        <td><?php echo $feedbackList['rating_id'];?></td>
						<td><?php echo $feedbackList['header_text'];?></td>
                       <td><?php echo $feedbackList['message'];?></td>
                       <td><?php if($feedbackList['fd_state']) $status=1; else $status=2; ?>
										<a href="#" onclick="activeEnactive(<?php echo $feedbackList['feedback_id'].','.$status; ?>)">
										<?php echo ($feedbackList['fd_state']==1) ? '<span class="label label-success" style="font-size:12px;">Active</span>' : '<span class="label label-danger" style="font-size:12px;">Inactive</span>'; ?></a>
										</td>
                      <td>
							<a href="<?php echo base_url(); ?>feedback/editFeedback?id=<?php echo $feedbackList['feedback_id'] ?>">
							 <span class="fa fa-pencil-square-o" id="res"></span>
							</a>
						</td>
					  </tr>
					
						<?php $i++; endforeach; } else { ?>
					<center><tr><td colspan="5"><h3> Result Not found </h3></td></tr></center>
					<?php } ?>
					
                    
                      
                    </tbody>
                    <tfoot>
                      <tr>
					    <th>S No.</th>
						<th>Order Id</th>
						<th>Created Date</th>
                        <th>Customer Name</th>
                        <th>Mobile No</th>
                        <!--th >Email ID</th-->
                        <th>City Name</th>
                        <th>Rating</th>
						<th>Header Text</th>
                       <th>Message</th>
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
		
		function activeEnactive(id, value) {
			if(value==1){
				value=0;
			}
			else{
				value=1;
			}
            var r = confirm("Do you want to change status ?");
            if (r == true) {
               window.location.assign("<?php echo base_url(); ?>admin/Citycontent/feedbackActiveStatus?inactiveStatusId="+id+"&&statusValue="+value); 
	        }
    
        }
		</script>			