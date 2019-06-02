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
                  <h3 class="box-title">Edit News Category</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                  <div class="box-body"><?php  $i=0; foreach ($category as $categoryRecord):$i++; ?>
					<form  action="<?php echo base_url()?>blogcategories/BlogCategoriesmanage/updateCategory?categoryId=<?php echo $this->input->get('categoryId'); ?>" method="post" enctype="multipart/form-data">
					
                    <div class="form-group">
                      <label for="inputServicesName">Category Name</label>
                      <input type="text" name="category" class="form-control" id="inputCategoryName"  value="<?php echo ucfirst($categoryRecord['cat_name'])?>" required>
                    </div>
					
					<div class="col-md-12">
                      <label for="categoryicon">Category icon&#160;</label>
                     <br/>
					 <?php if($categoryRecord['blog_category_icon']) { ?>
					  <a href="<?php echo base_url().'upload/blogcategory/'.$categoryRecord['blog_category_icon']; ?>" id="" target="_blank">
							<span class="label label-success" style="font-size:11px;">View</span>
					  </a>
					  <?php } else { echo '<input type="file" name="logoIcon" id="idProof">'; } ?>
					  <?php if($categoryRecord['blog_category_icon']) { ?>
					  <span href="#" id="userLink" style="visibility:visible;" onclick="deleteUserDetails()">
							<span class="label label-danger" style="font-size:11px; cursor:pointer;">Change main image</span>
							
					  </span>
					  <br/>
					  <br/>
					    <input type="file" name="logoIcon" id="InputProfilePhoto" style="display:none">  
						
							
						<?php } ?>
                      
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
 function deleteUserDetails() { 
		document.getElementById('InputProfilePhoto').style.display='block';
		document.getElementById('userLink').style.display='none';
		
		}


</script>