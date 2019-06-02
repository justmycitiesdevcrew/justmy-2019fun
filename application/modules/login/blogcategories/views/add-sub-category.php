        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header" style="background-color: rgba(19, 17, 17, 0.21);">
                  <h3 class="box-title">Add Sub Category </h3>
				  	
                </div><!-- /.box-header -->
                <!-- form start -->
				<?php if($this->session->flashdata('alert')){ ?>
				<br/>
						<div class="col-md-12 alert alert-info">
							<?php  echo $this->session->flashdata('alert'); ?>
						</div>
					<?php } ?>
                  <div class="box-body">
					<form role="form" method="post" action="<?php echo base_url();?>categories/Categoriesmanage/addSubCategoryData?categoryId=<?php echo $this->input->get('categoryId');?>" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="newsInputHeading">Sub Category Name</label>
                      <input type="text" name="category" class="form-control" id="InputCategory" placeholder="Enter Category" required>
                    </div>
					<div class="form-group">						
					  <label for="inputName">Sub Category Banner</label><span id="Name" style="color:red;"></span>
					  <input type="file" name="logo" id="" class="form-control" value=""  onchange="readURL(this);" required>
					</div>
					<div class="form-group">
					  <img src="" id="logo" width="200px">						
					</div>
                   
					
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
				  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
			  
			  
			  </div><!-- /.col (right) -->
          </div><!-- /.row -->

        </section><!-- /.content -->

<script>
 function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#logo')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>		