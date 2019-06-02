        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Products List</h3>
				  
				 <?php if($this->input->get('success')=='true'){echo ' <h4 class="alert alert-info"><i class="fa fa-check" aria-hidden="true"></i> Product Inserted Successfully</h4>';}elseif($this->input->get('success')=='false'){ echo ' <h4 class="alert alert-warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Product Already Exist.</h4>';}elseif($this->input->get('success')=='updatefalse'){ echo ' <h4 class="alert alert-warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Some error occured during updates, try after some time.</h4>';}elseif($this->input->get('success')=='updatetrue'){ echo '<h4 class="alert alert-info"><i class="fa fa-check" aria-hidden="true"></i> Product Updated Successfully</h4>';}else{}?></h4>
                <!-- /.box-header -->
				<form action="<?php echo base_url()."product"?>" name="" method="POST">
					<div class="row">
						
						<!--div class="col-sm-2">	
							<div class="dataTables_length" id="example1_length">
								<label>Date&#160;:</label>
								<input style="width:100%;" type="text" name="fromdate" id="datetimepicker2" class="form-control input-sm" placeholder="From Date"  autocomplete="off"/>

							</div>
						</div>
						<div class="col-sm-2">
						<label>&#160;</label>
							<div class="dataTables_length" id="example1_length1">
								<input type="text" name="todate" id="datetimepicker3" aria-controls="example1"  class="form-control input-sm" style="width:100%;" placeholder="To Date"  autocomplete="off">
								
							</div>
						</div--->
						<!--div class="col-sm-2">
							<div class="dataTables_length" id="example1_length">
								<label>Status&#160;:</label>								
								<select name="status" aria-controls="example1" value="<?php echo base_url(); ?>" class="form-control input-sm" style="width:100%; display:block">
								<option value="">All</option>
									<option value="1">Active</option>		
									<option value="0">InActive</option>		
								</select> 
							</div>
						</div-->
						<div>&nbsp;</div>
						<div class="col-sm-2">
							<div class="dataTables_length" id="example1_length">
								<label>Select Category&#160;:</label>								
								<select name="category" aria-controls="example1" value="<?php echo base_url(); ?>" class="form-control input-sm" style="width:100%; display:block" onchange="subcategory1(this.value)">
								<option value="">Category</option>
								<?php $status = getCat();
								foreach($status as $statusDetails): 
								if($statusDetails['parent_id'] == 0 ){?>
									<option value="<?php echo $statusDetails['id']; ?>"><?php echo ucfirst($statusDetails['cat_name']); ?></option>						
									<?php 
								}endforeach; ?>
								</select> 
							</div>
						</div>
						<div class="col-sm-2">
							<div class="dataTables_length" id="example1_length">
								<label>Select Sub Category&#160;:</label>								
								<select name="subcategory" id="subcategory" aria-controls="example1" class="form-control input-sm" style="width:100%; display:block">
								<option value="">Sub Category</option>
								<?php
								foreach($status as $statusDetails): 
								if($statusDetails['parent_id'] != 0 ){?>
									<option value="<?php echo $statusDetails['id']; ?>" parent_id="<?php echo $statusDetails['parent_id']; ?>"><?php echo ucfirst($statusDetails['cat_name']); ?></option>						
									<?php 
								}endforeach; ?>
								</select> 
							</div>
						</div>
						<div class="col-sm-1">
							<label>&#160;</label>
							<div class="dataTables_length" id="example1_length">
								<button type="submit" name="filter" class="btn btn-primary">Filter</button>
								
							</div>
						</div>
						
						
					</form>
					<div class="dataTables_length" id="example1_length">
								<div class="col-md-2">
									<label>&#160;</label><br>
									<a href="<?php echo base_url(); ?>product/addproject" class="btn btn-success pull-right">Add New Product</a>
								</div>
					</div>
				</div>
				<div class="box-body">
					
							
				
					
					</form>
					<hr/>
					<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="min-width: 10px;">S No.</th>
                        <th style="min-width: 10px;">Category Name</th>
                        <th style="min-width: 10px;">Sub Category Name</th>
                        <th style="min-width: 20px;">Product Name</th>
                        <th style="min-width: 20px;">Product Price(INR)</th>
                        <th style="min-width: 20px;">Product Icon</th>	  
						<th style="min-width: 20px;">Gst Tax Percentage</th>						
                        <th style="min-width: 20px;">In Stock(kg)</th>						
                        <th style="min-width:10px;">Status</th>
                        <th style="min-width:110px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
					
                      <tr>
					  <?php if($allProjects){?>
					  <?php $i=1; foreach($allProjects as $list):?>
					    <td><?php echo $i;?></td>
					    <td><?php echo ucfirst($list->categoryname);?></td>
					    <td><?php echo ucfirst($list->subcatname);?></td>
					    <td><?php echo ucfirst($list->product_name);?></td>
					    <td><i class="fa fa-inr"></i> <?php echo ucfirst($list->product_price);?></td>
					    <td><?php if($list->product_icon){ ?>
							<img src="<?php echo base_url();?>upload/<?php echo $list->product_icon;?>" style="width:100px; height:60px;">
						<?php }else{ ?>
							<img src="<?php echo base_url();?>upload/no_image.jpg" style="width:100px; height:60px;">
						<?php }?>
						</td>
						<td><?php echo ucfirst($list->product_gst_tax);?></td>
					    <td><?php echo ucfirst($list->product_qty);?></td>
						<td>
							<?php 
								if($list->status) $status=1; 
								
								else $status=0;
							?>
							<a href="#" onclick="activeEnactive(<?php echo $list->pid.', '.$status ?>)">
							<?php echo ($list->status==1) ? '<span class="label label-success" style="font-size:12px;">Active</span>' 
							: '<span class="label label-danger" style="font-size:12px;">Inactive</span>'; ?>
							</a>
						</td>
                        <td>
							
							<a href="<?php echo base_url(); ?>product/editproject?id=<?php echo $list->pid; ?>" style="font-size:18px;">
						     <span class="fa fa-pencil-square-o" id="res"></span>
						    </a>&nbsp;
							<a href="<?php echo base_url(); ?>product/recipes?product_id=<?php echo $list->pid;?>"  style="font-size:18px; color:red"> View Recipes 	
						    </a>
							
						</td>
                      </tr>
					  <?php $i++; endforeach; } else { ?>
					<center><tr><td colspan="5"><h3> Result Not found </h3></td></tr></center>
					<?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style="min-width: 10px;">S No.</th>
                        <th style="min-width: 10px;">Category Name</th>
                        <th style="min-width: 10px;">Sub Category Name</th>
                        <th style="min-width: 20px;">Product Name</th>
                        <th style="min-width: 20px;">Product Price(INR)</th>
                        <th style="min-width: 20px;">Product Icon</th>	
						<th style="min-width: 20px;">Gst Tax Percentage</th>						
                        <th style="min-width: 20px;">In Stock(kg)</th>						
                        <th style="min-width:10px;">Status</th>
                        <th style="min-width:110px;">Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
				
<script> 
function subcategory1(id) {
	console.log(id);
     $("#subcategory option").each(function(i){
		 if(id){
			 if($(this).attr('parent_id') != id ){
				 $(this).prop("selectedIndex", 0);
				 $(this).hide();
				 if($(this).attr('value') == ''){						
					$(this).show();
				 }
			 }else{				 
				 $(this).show();
			 }
		 }else{		 
		 $(this).show();
	 }
     //   alert($(this).text() + " : " + $(this).val());
	//	$("#selectAddQty"+result.Result['id']+" option[value='"+result.Result['qty']+"']").prop('selected', true) ;

    }); 
}
</script>
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
               window.location.assign("<?php echo base_url(); ?>product/ActiveStatus?inactiveStatusId="+id+"&statusValue="+value); 
	        }
    
        }
		</script>