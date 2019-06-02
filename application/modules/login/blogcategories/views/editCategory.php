<div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="">
             
                  <div class="box-body">
				  
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header" style="background-color: rgba(19, 17, 17, 0.21);">
                  <h3 class="box-title">Edit Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body"><?php  $i=0; foreach ($category as $categoryRecord):$i++; ?>
					<form  action="<?php echo base_url()?>categories/Categoriesmanage/updateCategory?categoryId=<?php echo $this->input->get('cat_id'); ?>" method="post" enctype="multipart/form-data">
					
                    <div class="form-group">
                      <label for="inputServicesName">Category Name</label>
                      <input type="text" name="category" class="form-control" id="inputCategoryName"  value="<?php echo ucfirst($categoryRecord['cat_name'])?>" required>
                    </div>
					
					<?php endforeach;?>
					</div>
					

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
				  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
			  
                  </div>
                  </div><!-- /.tab-pane -->
				  
     
            </div><!-- /.col -->

            
          </div>
		  
<style>
	.viewPart input[type="text"]{
		disabled:'disabled';
	}
</style>
<script>
function showUploader(){
 document.getElementById('uploader').style.display='block';
 document.getElementById('updateBtn').style.display='none';
}
</script>