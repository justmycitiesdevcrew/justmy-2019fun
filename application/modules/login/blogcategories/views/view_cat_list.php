    <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Category List</h3>
                </div><!-- /.box-header -->
				<div class="box-body">
					<form action="#<?php //echo base_url();?>" name="" method="POST">
					<!--div class="row">	
						<div class="col-sm-3">
							<div class="dataTables_length" id="example1_length">
								<label>Status</label>
								
								<select name="status" aria-controls="example1" value="<?php //echo base_url(); ?>" class="form-control input-sm" style="width:50%;">
								<option value="">All Status</option>
								
									<option value="0">Inactive</option>
									<option value="1">Active</option>
									
									
									
								</select> 
							</div>
						</div-->
						
						<div class="col-sm-6">
							<div class="dataTables_length" id="example1_length">
								<!--button type="submit" class="btn btn-primary">Filter</button-->
							<button  type="button" class="btn btn-success" onclick="window.location.href='<?php echo base_url(); ?>categories/Categoriesmanage/addCategory'" />Create Category</button>
							</div>
						</div>
					</form>
					<hr/>
					<?php if($this->session->flashdata('alert')){ ?>
						<div class="col-md-12 alert alert-info">
							<?php  echo $this->session->flashdata('alert'); ?>
						</div>
					<?php } ?>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>S No.</th>
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead><?php //echo"<pre>";print_r($user);die;?>
                    <tbody><?php if ($category) { ?>
					<?php $i=1; foreach ($category as $userDetails): ?>
                      <tr>
					    <td><?php echo $i; ?></td>
                        <td><?php echo ucfirst($userDetails['cat_name']); ?></td>
						
                        <td><?php 
							if($userDetails['cat_status']) $status=1; 
							
							else $status=0;
						?>
						<a href="#" onclick="activeEnactive(<?php echo $userDetails['cat_id'].', '.$status; ?>)">
						<?php echo ($userDetails['cat_status']==1) ? '<span class="label label-success" style="font-size:12px;">Active</span>' 
						: '<span class="label label-danger" style="font-size:12px;">Inactive</span>'; ?>
						</a></td>
  						<td>
						    <a href="<?php echo base_url()."categories/Categoriesmanage/editCategory?categoryId=".$userDetails['cat_id']; ?>">
						     <span class="fa fa-pencil-square-o" id="res"></span> Edit Category
							</a> &nbsp;&nbsp;
						    <!--a style="color:green" href="<?php echo base_url()."categories/Categoriesmanage/viewSubCategory?categoryId=".$userDetails['cat_id']; ?>">
						     <span class="fa fa-eye" id="res"></span> View Sub Categories
							</a> &nbsp;&nbsp;
						    <a href="<?php echo base_url()."categories/Categoriesmanage/addSubCategory?categoryId=".$userDetails['cat_id']; ?>" style="color:red;">
						     <span class="fa fa-plus" id="res"></span> Add Sub Category
						    </a-->
							
						</td>
						
                      </tr>
					<?php $i++; endforeach; } else { ?>
					<center><tr><td colspan="5"><h2> Result Not found </h2></td></tr></center>
					<?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>S No.</th>
                        <th>Category Name</th>
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
               window.location.assign("<?php echo base_url(); ?>categories/Categoriesmanage/ActiveStatus?inactiveStatusId="+id+"&&statusValue="+value); 
	        }
    
        }
		</script>