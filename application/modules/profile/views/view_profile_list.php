<style>
	.status-group{
		padding-left: 0px !important;
	}
</style>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
     
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Profile List</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
          <!--form action="<?php //echo base_url()."profile"?>" name="" method="POST">
            <div class="row">
              <div class="col-sm-2">
              <div class="form-group">
                  <select class="form-control" name="status">
                    <option value="">---Status---</option>
                    <option value="">All</option>
                    <option value="Pending">Pending</option>
                    <option value="Live">Live</option>
                    <option value="Issue Review">Issue Review</option>
                    <option value="Billing">Billing</option>
                    <option value="Delete Pending">Delete Pending</option>
                  </select>
              </div>
            </div>
            <div class="col-sm-2">
              <input  type="submit" name="filter" class="btn btn-info" value="Submit"/>
            </div>
          </form-->
					
				  
  						<div class="col-sm-8 status-group">
  							<div class="btn-group">
							  <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo base_url(); ?>profile?statusall=All'">All</button>
							  <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo base_url(); ?>profile?status=Pending'">Pending</button>
							  <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo base_url(); ?>profile?status=Live'">Live</button>
							  <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo base_url(); ?>profile?status=Issue Review'">Issue Review</button>
							  <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo base_url(); ?>profile?status=Billing'">Billing</button>
							  <button type="button" class="btn btn-info" onclick="window.location.href='<?php echo base_url(); ?>profile?status=Delete Pending'">Delete Pending</button>
							</div>
  						</div>
  						<div class="col-sm-4">
	  						<form action="<?php echo base_url()."profile"?>" name="" method="POST">
	  							<div class="row">
		  							<div class="dataTables_length" id="example1_length">
		  								
		  							    <button  type="button" class="btn btn-info" style="float:right;" onclick="window.location.href='<?php echo base_url(); ?>profile/addProfile'" />Add profile</button>
		  							</div>
	  							</div>
							</form>
						</div>
					<hr/>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
					               <th>S No.</th>
					              <th>Name</th>
                        <th>Address</th>
                        <th>Status</th>
						            <th>Zip</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Web</th>
                        <th>Username</th>
                        <th>Action</th> 
                      </tr>
                    </thead>
                    <tbody>
					<?php if ($profile) { 
					//echo "<pre>"; print_r($profile); die;?>
					<?php $i=1; foreach($profile as $profile): ?>
					
                      <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $profile['profile_name'];; ?></td>
                        <td><?php echo $profile['profile_add']; ?></td>
                        <td><?php echo $profile['profile_status']; ?></td>
                        <td><?php echo $profile['profile_zip']; ?></td>
                        <td><?php echo $profile['profile_city']; ?></td>
                        <td><?php echo $profile['profile_st']; ?></td>
                        <td><?php echo $profile['profile_web']; ?></td>
                        <td><?php echo $profile['profile_username']; ?></td>
						<td>
							<a href="<?php echo base_url(); ?>profile/editProfile?id=<?php echo $profile['profile_id'] ?>">
							 <span class="fa fa-pencil-square-o" id="res"></span>
							</a> <span> | </span>
							<a href="<?php echo base_url(); ?>profile/deleteProfile?id=<?php echo $profile['profile_id'] ?>" class="delete">
							 <span class="fa fa-trash" id="res"></span>
							</a>
						</td>
					  </tr>
					<?php $i++; endforeach; } else { ?>
						<tr> 
						<td> <h3>Result Not Found </h3></td>
						</tr>
					<?php } ?>
                     
                      
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
    $("a.delete").click(function(e){
        if(!confirm('Are you sure? If you delete it, it will put profile to Delete Pending!')){
            e.preventDefault();
            return false;
        }
        return true;
    });
});
</script>		   