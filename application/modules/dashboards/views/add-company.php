
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
            Company Registration
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
                    <form role="form"  action="<?php echo base_url();?>companymanagement/submitnewCompany"  enctype="multipart/form-data" method="post" >
					
					<div class="col-md-6">					
                      <label for="inputOrderName">Company Name</label>
                      <input name="companyname" class="form-control" id="name" value="" placeholder="Company Name" required>
                    </div>
					<div class="col-md-6">					
                      <label for="inputOrderName">Company Address</label>
                      <input name="companyaddress" class="form-control" id="Company Address" value="" placeholder="Company Address" required>
                    </div>
					
					<br/>
					<div class="form-group">
						<center>
							<label for="inputOrderName"> &nbsp;<br/></label>
							<input class="btn btn-success" id="orderEmailSubmit" type="submit" value="Submit" style=" margin-top: 20px;">
						</center>
					</div>
					
					</form>
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
					</div>  
					</div>
				</div>
			</div>
		</section>
	</div>	
