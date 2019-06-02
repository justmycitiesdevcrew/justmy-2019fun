
<style>
.top-border{
	    border-top: 3px solid #3c8dbc;
}
.skillClose {
position: relative;
    margin-top: -30px;
    margin-left: 100%;
    background: #000;
    color: #fff;
    border-radius: 50%;
    padding: 0px 4px;
    width: 20px;
    height: 20px;
}
.btn-default {
    background-color: #f4f4f4;
    color: #444;
    border-color: #ddd;
    height: 35px;
    margin-right: 10px;
	text-transform:capitalize;
	margin-bottom:10px;
}
.background-color-exp{
	background: #fbfbfb;
    border: 1px solid #ddd;
}

</style>
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Edit Skill
            <small></small>
          </h1>
        </section>
		
        <!-- Main content -->
        <section class="content">
			<div class="row">
				<div class="col-md-12"> 
					<div class="box">
					<div class="box-body">
					<div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
				  <?php if($allskills){?>
					  <?php $i=1; foreach($allskills as $list):?> 
                    <form role="form"  action="<?php echo base_url();?>skills/updateSkills?id=<?= $this->input->get('id') ?>"  enctype="multipart/form-data" method="post" >
					
					<div class="col-md-6">					
                      <label for="inputOrderName">Skill Name</label>
                      <input name="skillName" class="form-control" id="name" value="<?= $list->skill_name ?>" placeholder="Name" required>
                    </div>
					<div class="col-md-6">					
                      <label for="inputOrderName">Skill Parse Name</label>
                      <input name="skillParseName" class="form-control" id="Designation" value="<?= $list->skill_parse_name ?>" placeholder="Designation" required>
                    </div>
					
					<br/>
					<div class="form-group">
						<center>
							<label for="inputOrderName"> &nbsp;<br/></label>
							<input class="btn btn-success" id="orderEmailSubmit" type="submit" value="Submit" style=" margin-top: 20px;">
						</center>
					</div>
					 <?php $i++; endforeach; }  ?>
					</form>
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
					</div>  
					</div>
				</div>
			</div>
		</section>
	</div>	
	
<script>
 function deleteUserDetails() {
		//alert('hi');
		document.getElementById('InputProfilePhoto').style.display='block';
		document.getElementById('userLink').style.display='none';
		
		}
</script>