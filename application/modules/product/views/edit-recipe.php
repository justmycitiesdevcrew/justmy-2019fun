<style>
.ms-options ul{
	    margin-left: -35px;
    padding-right: 5px;
}
.ms-options ul li label{cursor:pointer;}
</style>
<section class="content">
<div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
             
                <div class="box-header">
                  <h3 class="box-title"><strong>Edit Recipe Form</strong></h3>
				  <?php if($this->session->flashdata('alert')){ ?>
					<div class="col-md-12 alert alert-info" style="margin-top:10px;margin-bottom:10px;">
						<?php  echo $this->session->flashdata('alert'); ?>
					</div>
				<?php } ?>
                </div><!-- /.box-header -->
				
                <div class="tab-content  col-md-12">
                  <div class="tab-pane active" id="tab_1">
				<?php  if(count( (array) ($project)) > 0){ ?>
                    <form role="form"  action="<?php echo base_url();?>product/editrecipes?recipe_id=<?php echo $project->recipe_id; ?>"  enctype="multipart/form-data" method="post" >
					
					<div class="form-group">
					<div class="col-md-3">					
                      <label for="inputOrderName">Recipe Name</label>
                      <input name="recipe_name" class="form-control" id="recipe_name" value="<?php echo $project->recipe_name; ?>" placeholder="Recipe Name" required>
					  <input type="hidden"  name="recipe_product_id" value="<?php echo $project->recipe_product_id; ?>">
                    </div>
					<div class="col-md-3">
                      <label>Recipe Kind</label>                      
                      <select class="form-control" name="recipe_kind" onchange="subcat(this.value)" required>
                    
						<option value="">Select</option>                        						
						<option value="Veg" <?php if($project->recipe_kind == 'Veg'){echo "selected";}?>>Veg</option>
						<option value="Non-Veg" <?php if($project->recipe_kind == 'Non-Veg'){echo "selected";}?>>Non-Veg</option>
						<option value="Vegan" <?php if($project->recipe_kind == 'Vegan'){echo "selected";}?>>Vegan</option>
						
                      </select>
                    </div> 
					<div class="col-md-3">					
                      <label for="inputOrderName">Recipe Serves</label>
                      <input type="text" name="recipe_serves" class="form-control" id="recipe_serves" value="<?php echo $project->recipe_serves; ?>" placeholder="eg:1" required>
                    </div>
					<div class="col-md-3">					
                      <label for="inputOrderName">Prepare Time</label>
                      <input type="text" name="recipe_prepare_time" class="form-control" id="recipe_prepare_time" value="<?php echo $project->recipe_prepare_time; ?>" placeholder="eg:30 mins" required>
                    </div>
					<div class="col-md-3">
                      <label>Recipe Difficulty</label>
                      <div id="">
						  <select class="form-control" name="recipe_difficulty" id="recipe_difficulty">
						  
							<option value="">Select</option>
							  <option value="Easy" <?php if($project->recipe_difficulty == 'Easy'){echo "selected";}?>>Easy</option>
							  <option value="Not too tricky" <?php if($project->recipe_difficulty == 'Not too tricky'){echo "selected";}?>>Not too tricky</option>
							  <option value="Tricky" <?php if($project->recipe_difficulty == 'Tricky'){echo "selected";}?>>Tricky</option>
								
						  </select>
					  </div>
                    </div>  
					
					<!--div class="col-md-3">					
					  <label for="inputOrderName">Product Hindi Name</label>
					  <input name="ProductHindiName" class="form-control" id="HindiName" value="" placeholder="Product Hindi Name" required>
					</div-->
					
						<!--div class="col-md-3">					
						  <label for="inputOrderName">Ingredients</label>
							
								
								<select class="form-control" multiple name="recipe_ingredients_products_id[]" id="langOpt3" style="width:100%">
								<?php /* $sub_ids = json_decode($project->recipe_ingredients_products_id,true);
								if($allProjects){
										foreach($allProjects as $slist){
									?>
									<option value="<?php echo $slist->product_id;?>" <?php  if(in_array($slist->product_id,$sub_ids)){echo 'selected';}  ?>><?php echo $slist->product_name ?></option>
								<?php }}  */?>
							
								</select>
						</div-->
						<div class="col-md-3">					
						  <label for="inputOrderName">Recipe Meal Type</label>
							 <select name="recipe_meal_type" id="recipe_meal_type" class="form-control" required="required">
								 <option value="Breakfast" <?php if($project->recipe_meal_type == 'Breakfast'){echo "selected";}?>>Breakfast</option>
								 <option value="Lunch" <?php if($project->recipe_meal_type == 'Lunch'){echo "selected";}?>>Lunch</option>
								 <option value="Dinner" <?php if($project->recipe_meal_type == 'Dinner'){echo "selected";}?>>Dinner</option>
								 <option value="Snacks" <?php if($project->recipe_meal_type == 'Snacks'){echo "selected";}?>>Snacks</option>
							 </select>
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Recipe Cusine</label>
							 <select name="recipe_cusine" id="recipe_cusine" class="form-control" required="required">
								 <option value="Indian" <?php if($project->recipe_cusine == 'Indian'){echo "selected";}?>>Indian</option>
								 <option value="Italian" <?php if($project->recipe_cusine == 'Italian'){echo "selected";}?>>Italian</option>
								 <option value="Asian" <?php if($project->recipe_cusine == 'Asian'){echo "selected";}?>>Asian</option>
								 <option value="Continental" <?php if($project->recipe_cusine == 'Continental'){echo "selected";}?>>Continental</option>
							 </select>
						</div>
						<div class="col-md-6">					
						  <label for="inputOrderName">Recipe Video Url</label>
						  <input type="text" name="recipe_video_url" class="form-control" id="recipe_video_url" value="<?php echo $project->recipe_video_url; ?>" placeholder="Recipe Video Url">
						</div>
					
									
					<div class="col-md-12">						
                      <label for="inputOrderName">Recipe Tips</label>
                      <textarea id="editor2" rows="4" cols="50" name="recipe_tips" class="form-control"><?php echo $project->recipe_tips; ?></textarea>
                    </div>
					<div class="col-md-12">						
                      <label for="inputOrderName">Recipe Steps</label>
                      <textarea id="editor4" rows="4" cols="50" name="recipe_steps" class="form-control"><?php echo $project->recipe_steps; ?></textarea>
                    </div>
					<div class="col-md-12">						
                      <label for="inputOrderName">Recipe Description</label>
                      <textarea id="editor1" rows="4" cols="50" name="recipe_description" class="form-control"><?php echo $project->recipe_description; ?></textarea>
                    </div>
					
					
					<div class="col-md-12">						
                      <label for="inputOrderName">Recipe Calories</label>
                      <textarea id="editor3" rows="4" cols="50" name="recipe_calories" class="form-control"><?php echo $project->recipe_calories; ?></textarea>
                    </div>
					
					<div class="col-md-12">						
                      <label for="inputOrderName">Recipe Other Ingredients</label>
                      <textarea id="editor5" rows="4" cols="50" name="recipe_other_ingredients" class="form-control"><?php echo $project->recipe_other_ingredients; ?></textarea>
                    </div>
					<!--div class="col-md-6">					
                      <label for="inputOrderName">Product Icon</label>
                      <input type="file" name="ProductIcon" class="form-control" id="productImage" value="" >
                    </div-->
					<div class="col-md-12">
                      <label for="InputProfilePhoto">Main Image&#160;</label>
                     <br/>
					 <?php if($project->recipe_img) { ?>
					  <a href="<?php echo base_url().'upload/'.$project->recipe_img; ?>" id="link" target="_blank">
							<span class="label label-success" style="font-size:11px;">View</span>
					  </a>
					  <?php } else { echo '<input type="file" name="recipe_img" id="InputProfilePhoto">'; } ?>
					  <?php if($project->recipe_img) { ?>
					  <span href="#" id="userLink" style="visibility:visible;" onclick="deleteUserDetails()">
							<span class="label label-danger" style="font-size:11px; cursor:pointer;">Change main image</span>
							
					  </span>
					  <br/>
					  <br/>
					           <input type="file" name="recipe_img" id="InputProfilePhoto" style="display:none">  
						
							
						<?php } ?>
                      
                    </div>
					<br/>
					
					<div class="col-md-12">	 
						<label for="inputOrderName">Ingredients</label><br>
						<div class="field_wrapper">
					<?php	$sub_ids = json_decode($project->recipe_ingredients_products_id,true); ?>
					<?php if($sub_ids){ $allCategories = getCat(null,true);
				//	echo "<pre>"; print_r($sub_ids); die;
					foreach($sub_ids as $key => $values){
						
						?>
							<div class="parent_div" id="record<?php echo $key; ?>">
								<div class="col-md-10" style="margin-top:10px;">
									<div class="col-md-3"> 	
										<select class="form-control" name="ProductcatId[]" onchange=filterProduct(this.value,"p<?php echo $key; ?>")>
											<option value="">---Select Category---</option> <?php if($allCategories){
												foreach($allCategories as $list):?>
											<option   <?php  if($values['productcatid'] == $list['id']){echo " selected";} ?> value="<?php echo $list['id']; ?>"><?php echo ucfirst($list['cat_name']); ?></option>
											<?php endforeach; }?>
										</select>
									</div>								
									<div class="col-md-3">	 					  
									   <select class="form-control productType"  name="recipe_ingredients_products_id[]" onchange="updatename(this.value,'p<?php echo $key; ?>')" id="p<?php echo $key; ?>" style="width:100%">
									   	<option value="">---Select Category---</option>  
										
												<?php 
												if($allProjects){
														foreach($allProjects as $slist){
													?>
													<option <?php  if($values['productid'] == $slist->product_id){echo " selected";} ?> catid="<?php echo $slist->product_cat_id; ?>" value="<?php echo $slist->product_id;?>" style='  <?php  if($values['productcatid'] == $slist->product_cat_id){echo " display:block";}else{ echo ' display:none;';} ?>'><?php echo $slist->product_name; ?></option>
												<?php }} ?>
											
										</select>
									</div>
									<div class="col-md-3">	 					  
										<input type="text" name="IngredientsQty[]" class="form-control" value="<?php echo $values['productqty']; ?>">
									</div>
									 <div class="col-md-2">
										<a href="javascript:void(0);" class="remove_button" title="Remove field" id="<?php echo $key; ?>"><i class="fa fa-minus btn btn-danger"></i></a>
									</div>
								</div>
							</div>	
					<?php 
					}}else{?>
					<div class="col-md-10">
						<div class="col-md-3"> 	
							<select class="form-control" name="ProductcatId[]" onchange=filterProduct(this.value,"p0")>
								<option value="">---Select Category---</option> <?php if($allCategories = getCat(null,true)){foreach($allCategories as $list):?>
								<option value="<?php echo $list['id']; ?>"><?php echo ucfirst($list['cat_name']); ?></option>
								<?php endforeach; }?>
							</select>
						</div>
						<div class="col-md-3">							 
							  <select class="form-control ProductId productType" name="recipe_ingredients_products_id[]" onchange="updatename(this.value,'p0')" id="p0">							
								<option value="0">---Select Product---</option>   
								<?php if($allProducts = getAllProducts()){
									foreach($allProducts as $plist):?>						
										<option catid="<?php echo $plist['product_cat_id']; ?>" value="<?php echo $plist['product_id']; ?>"><?php echo ucfirst($plist['product_name']); ?></option>
								<?php 
								endforeach; } ?>								
							  </select>
							<span class="ProductIdtext" style="color:red;"></span>
						</div>
						<div class="col-md-3">
							<input type="text" name="IngredientsQty[]" class="form-control productQTY" placeholder="eg:10grams"  >
							
							<span class="productQTYtext" style="color:red;"></span>
						</div>
						 
						
					  </div>
                      <div class="field_wrapper">
					  
					  </div>
					<?php }?>
						</div>
						  <div class="add_button btn btn-success pull-right">
							<i class="fa fa-plus"></i>
						  </div>
					</div>	
					
					<div class="col-md-12">
						<center>
							<label for="inputOrderName"> &nbsp;<br/></label>
							<input class="btn btn-success" id="orderEmailSubmit" type="submit" value="Submit" style=" margin-top: 20px;">
						</center>
					</div>
					
					</div>
					
					</form>
				<?php }else{
					echo  '<div class="alert alert-danger">No recipe found, <a href="'.base_url().'product">go back</a>!</div>';
				}?>
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
			</div><!--/.row -->
			
</section><!-- /.content -->	

<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script>
 function deleteUserDetails() {
		document.getElementById('InputProfilePhoto').style.display='block';
		document.getElementById('userLink').style.display='none';
		
		}
</script>

<script type="text/javascript">

$(document).ready(function(){
	
	var i = 1;
	i++;
	console.log(i);
	var maxField = 20; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
	//New input field html 
	var x = 1; //Initial field counter is 1
	$(addButton).click(function(){ 
		if(x < maxField){  
			x++;  	
			i++;
			var fieldHTML = '<div class="parent_div" id="record'+i+'"> <div class="col-md-10" style="margin-top:10px;"> <div class="col-md-3"> 			  <select class="form-control" name="ProductcatId[]" onchange=filterProduct(this.value,"p'+i+'")>	<option value="">---Select Category---</option> <?php if($allCategories = getCat(null,true)){foreach($allCategories as $list):?><option value="<?php echo $list['id']; ?>"><?php echo ucfirst($list['cat_name']); ?></option><?php endforeach; }?></select><span class="ProductcatIdtext" style="color:red;"></span></div> <div class="col-md-3"> <select class="form-control productType" name="recipe_ingredients_products_id[]" onchange=updatename(this.value,"p'+i+'") id="p'+i+'"><option value="">---Select Product---</option><?php if($allProducts = getAllProducts()){foreach($allProducts as $plist):?><option catid="<?php echo $plist['product_cat_id']; ?>" value="<?php echo $plist['product_id']; ?>"><?php echo ucfirst($plist['product_name']); ?></option><?php 	endforeach; } ?></select><span class="ProductIdtext" style="color:red;"></span></div> <div class="col-md-3"><input type="text" name="IngredientsQty[]" class="form-control"></div> <div class="col-md-2"><a href="javascript:void(0);" class="remove_button" title="Remove field" id="'+i+'"><i class="fa fa-minus btn btn-danger"></i></a></div></div>'; 
			$(wrapper).append(fieldHTML); // Add field html
		 
		}
	});
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
		e.preventDefault();
		var remove_id = $(this).attr("id");
		$('#record'+remove_id+'').remove();
		console.log(remove_id);
		$(this).parent('.parent_div').remove(); //Remove field html
		x--; //Decrement field counter

	});
});

function filterProduct(id,divid){	
	$('#'+divid).children('option').css('display','none');
	$('#'+divid).children('option[catid="'+id+'"]').css('display','block');
}

function updatename(id,divid,type2=null){
var text = $('#'+divid).children('option:selected').text();	
	 		 
			 $('.productType').each(function(e,f){ 
				if(	$(f).children('option:selected').val() == id){					 		
					if($(f).attr('id') != divid){	 			
					  $('#'+divid).children('option:eq(0)').css('display','block'); 
					  $('#'+divid).children('option:selected').prop('selected', false); 
					  $('#'+divid).children('option:eq(0)').prop('selected', true); 
					  alert('Product '+text+' already Selected!!');
					}				
				
				} 			
			}); 
	 
}
</script>