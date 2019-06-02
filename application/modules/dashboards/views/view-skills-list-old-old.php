        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">All Skills List</h3>
				 <?php if($this->input->get('success')=='true'){echo ' <h4 class="alert alert-info"><i class="fa fa-check" aria-hidden="true"></i> Team Member Inserted Successfully</div>';}elseif($this->input->get('success')=='false'){ echo ' <h4 class="alert alert-warning"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Some error occured try after some time.</div>';}else{}?></h4>
                <!-- /.box-header -->
				<button class="btn btn-info pull-right" onclick="location.href='<?= base_url()?>skills/addSkills'">Add New Skill</button>
					<hr/>
					<table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style="min-width: 10px;">S No.</th>
                        <th style="min-width: 20px;">Skill Name</th>
                        <th style="min-width: 20px;">Skill Parse Name</th>				
                        <th style="min-width:10px;">Status</th>
                        <th style="min-width:110px;">Action</th>
                      </tr>
                    </thead>
                    <tbody>
					
                      <tr>
					  <?php if($allskills){?>
					  <?php $i=1; foreach($allskills as $list):?> 
					    <td><?php echo $i;?></td>
					    <td><?php echo ucfirst($list->skill_name);?></td>
					    <td><?php echo ucfirst($list->skill_parse_name);?></td>
					   
						<td>
						<?php 
							if($list->skill_status) $status=1; 
							
							else $status=0;
						?>
						<a href="#" onclick="activeEnactive(<?php echo $list->skill_id.', '.$status ?>)">
						<?php echo ($list->skill_status==1) ? '<span class="label label-success" style="font-size:12px;">Active</span>' 
						: '<span class="label label-danger" style="font-size:12px;">Inactive</span>'; ?>
						</a>
						</td>
                        <td>
							
							<a href="<?php echo base_url(); ?>skills/editSkill?id=<?php echo $list->skill_id; ?>" style="font-size:18px;">
						     <span class="fa fa-pencil-square-o" id="res"></span>
						    </a>&nbsp;
							
							
						</td>
                      </tr>
					  <?php $i++; endforeach; } else { ?>
					<center><tr><td colspan="5"><h3> Result Not found </h3></td></tr></center>
					<?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th style="min-width: 10px;">S No.</th>
                        <th style="min-width: 20px;">Skill Name</th>
                        <th style="min-width: 20px;">Skill Parse Name</th>				
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
  
		
		function activeEnactive(id, value) {
			if(value==1){
				value=0;
			}
			else{
				value=1;
			}
            var r = confirm("Do you want to change status ?");
            if (r == true) {
               window.location.assign("<?php echo base_url(); ?>team/ActiveStatus?inactiveStatusId="+id+"&statusValue="+value); 
	        }
    
        }
		</script>			

		