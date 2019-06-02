
<style>
.table-x tr td{
	border: 1px solid #d8d8d8 !important;
}
.ms-options label, .ms-options input{cursor:pointer}
.ms-options ul{
	margin-left: -40px !important;
}
.ms-options-wrap > .ms-options > ul label {
	
    padding:3px 25px!important;
	
}
.ms-options-wrap > .ms-options > ul input[type="checkbox"] { 
    left: 6px!important;
    top: 4px!important;
}
.ms-selectall,.skills-view{
	text-transform: capitalize!important; 	
}
.tooltip5 {
            position: relative;
            display: inline-block;
        }
.tooltip5:hover .tooltiptext {
            visibility: visible;
        }
.tooltip5 .tooltiptext{
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 75%;
    left: 50%;
    margin-left: -60px;
}
</style>
   <div class="content-wrapper">  
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
			<?php if($this->session->flashdata('alert')){ ?>
						<div class="col-md-12 alert alert-info">
							<?php  echo $this->session->flashdata('alert'); ?>
						</div>
					<?php } ?>
						
						<!--form action="<?php //echo base_url(); ?>Resumeparsing/listCandidates" method="post"   enctype="multipart/form-data">
						<h3>Filter</h3>
							<div class="col-md-4">
							<label>Select Profile </label> </br>
							<select    class="form-control  " name="profileFilter"  >
								<option value="">Select Profile</option>
								<?php /* if($profilearray){ 
										foreach($profilearray as $skey =>$slist){?>										
											<option value="<?php echo $slist['skill_set']; ?>"><?php echo ucfirst($slist['profile_name']); ?></option>
										<?php }
										} */ ?>
							</select>
							</div>
							<div class="col-md-4">
							<label>Select Skill </label> </br>
							<select multiple  class="form-control productsmultiselect" name="skillsFilter[]"  >
								<?php /* if($skillsarray){ 
										foreach($skillsarray as $skey =>$slist){
												$skillsData[$slist['skill_id']] = $slist['skill_name'];
											?>										
											<option value="<?php echo $slist['skill_id']; ?>"><?php echo ucfirst($slist['skill_name']); ?></option>
										<?php }
										} */ ?>
							</select>
							</div>
							<div class="col-md-2">
							<label> &nbsp; </label> </br>
							<input type="submit" class="btn btn-info" name="filter" value="Filter">
							</div>
						</form-->
						
							<div class="col-md-12">
							<a href="<?php echo base_url(); ?>skills/addnewSkill" class="btn btn-info pull-right">Add New Skill</a>
							</div>
						<div class="col-md-12">
						<hr>
						<h3>Skill Lists</h3>
					
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
				  </div>
				  </div>
				  </div>
				  </div>
				  </div>
	</section>
	</div>
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
               window.location.assign("<?php echo base_url(); ?>skills/ActiveStatus?inactiveStatusId="+id+"&statusValue="+value); 
	        }
    
        }
		</script>	