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
                  <h3 class="box-title"><strong>New Recipe Form</strong></h3>
                </div><!-- /.box-header -->
                <div class="tab-content  col-md-12">
                  <div class="tab-pane active" id="tab_1">
                    <form role="form"  action="<?php echo base_url();?>product/submitNewRecipe?product_id=<?php echo $this->input->get('product_id'); ?>"  enctype="multipart/form-data" method="post" >
					
					<div class="form-group">
					<div class="col-md-3">					
                      <label for="inputOrderName">Recipe Name</label>
                      <input name="recipe_name" class="form-control" id="recipe_name" value="" placeholder="Recipe Name" required>
					  <input type="hidden"  name="recipe_product_id" value="<?php echo $this->input->get('product_id'); ?>">
                    </div>
					<div class="col-md-3">
                      <label>Recipe Kind</label>                      
                      <select class="form-control" name="recipe_kind" onchange="subcat(this.value)" required>
                    
						<option value="">---Select---</option>   
                        						
						<option value="Veg">Veg</option>
						<option value="Non-Veg">Non-Veg</option>
						<option value="Vegan">Vegan</option>
						
                      </select>
                    </div> 
					<div class="col-md-3">					
                      <label for="inputOrderName">Recipe Serves</label>
                      <input type="text" name="recipe_serves" class="form-control" id="recipe_serves" value="" placeholder="eg:1" required>
                    </div>
					<div class="col-md-3">					
                      <label for="inputOrderName">Prepare Time</label>
                      <input type="text" name="recipe_prepare_time" class="form-control" id="recipe_prepare_time" value="" placeholder="eg:30 mins" required>
                    </div>
					<div class="col-md-3">
                      <label>Recipe Difficulty</label>
                      <div id="">
						  <select class="form-control" name="recipe_difficulty" id="recipe_difficulty">
						  
							<option value="">---Select---</option>
							  <option value="Easy">Easy</option>
							  <option value="Not too tricky">Not too tricky</option>
							  <option value="Tricky">Tricky</option>
								
						  </select>
					  </div>
                    </div>  
					
					<!--div class="col-md-3">					
					  <label for="inputOrderName">Product Hindi Name</label>
					  <input name="ProductHindiName" class="form-control" id="HindiName" value="" placeholder="Product Hindi Name" required>
					</div-->
					
						<div class="col-md-3">					
						  <label for="inputOrderName">Ingredients</label>
							  <!--select name="recipe_ingredients_products_id"   class="form-control" required>
							  
								<option value="">---Select(Multiple)---</option>
								
							  </select-->
							  
								
								<select class="form-control" multiple name="recipe_ingredients_products_id[]" id="langOpt3" style="width:100%">
								<?php /* $sub_ids = json_decode($customer[0]['subject_ids']); 
								if(!$sub_ids){ $sub_ids = array(); }
								if($subject = getSubjects()){
										foreach($subject as $slist){
									?>
									<option value="<?php echo $slist['category_id'];?>" <?php if($slist['category_id']){if(in_array($slist['category_id'],$sub_ids)){echo 'selected';}} ?>><?php echo $slist['category_name']; ?></option>
								<?php }} */?>
								<?php 
								if($allProjects){
										foreach($allProjects as $slist){
									?>
									<option value="<?php echo $slist->product_id;?>"><?php echo ucfirst($slist->product_name); ?></option>
								<?php }}?>
								</select>
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Recipe Meal Type</label>
							 <select name="recipe_meal_type" id="recipe_meal_type" class="form-control" required="required">
								 <option value="Breakfast">Breakfast</option>
								 <option value="Lunch">Lunch</option>
								 <option value="Dinner">Dinner</option>
								 <option value="Snacks">Snacks</option>
							 </select>
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Recipe Cusine</label>
							 <select name="recipe_cusine" id="recipe_cusine" class="form-control" required="required">
								 <option value="Indian">Indian</option>
								 <option value="Italian">Italian</option>
								 <option value="Asian">Asian</option>
								 <option value="Continental">Continental</option>
							 </select>
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Recipe Video Url</label>
						  <input type="text" name="recipe_video_url" class="form-control" id="recipe_video_url" value="" placeholder="Recipe Video Url">
						</div>
					
					
					
					<div class="col-md-12">						
                      <label for="inputOrderName">Recipe Description</label>
                      <textarea id="editor1" rows="4" cols="50" name="recipe_description" class="form-control"></textarea>
                    </div>
					<div class="col-md-12">						
                      <label for="inputOrderName">Recipe Steps</label>
                      <textarea id="editor4" rows="4" cols="50" name="recipe_steps" class="form-control"></textarea>
                    </div>
					<div class="col-md-12">						
                      <label for="inputOrderName">Recipe Tips</label>
                      <textarea id="editor2" rows="4" cols="50" name="recipe_tips" class="form-control"></textarea>
                    </div>
					<div class="col-md-12">						
                      <label for="inputOrderName">Recipe Calories</label>
                      <textarea id="editor3" rows="4" cols="50" name="recipe_calories" class="form-control"></textarea>
                    </div>
					<div class="col-md-12">						
                      <label for="inputOrderName">Recipe Other Ingredients</label>
                      <textarea id="editor5" rows="4" cols="50" name="recipe_other_ingredients" class="form-control"></textarea>
                    </div>
					<!--div class="col-md-6">					
                      <label for="inputOrderName">Product Icon</label>
                      <input type="file" name="ProductIcon" class="form-control" id="productImage" value="" >
                    </div-->
					<div class="col-md-6">					
                      <label for="inputOrderName">Recipe Image</label>
                      <input type="file" name="recipe_img" class="form-control" id="recipe_img" value="" required>
                    </div>
					
					<br/>
					<div class="form-group pinput">	
					
					<hr style="border-top:2px solid #ddd">
					<div class="col-md-12" style="padding:0px;">
                      <label for=" ">Ingredients</label>
					  </div>
					   <div class="col-md-10" style="padding:0px;">
						<div class="col-md-3">
							<label for="PackageDescription">Product Name</label>						
						</div>
						<div class="col-md-3">							
							<label for="PackageDescription">Product Qty</label>
						</div>
						<div class="col-md-3"> 						
						</div>
						<div class="col-md-3"> 						
						</div>						
					  </div>
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
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
			</div><!--/.row -->
			
</section><!-- /.content -->	

<script>
function subcat(id) {
	var CategoryID = id;
	var load = '<i class="fa fa-spinner fa-spin"></i>';
	$("#subCatIds").html(load);
//	return false;
	if(CategoryID){
		$.ajax({
			type: "POST",
			url: '<?php echo base_url(); ?>product/Product/subcategories',
		//	dataType: 'json',
			data: {"CategoryID":CategoryID},
			success: function(result){
					$("#subCatIds").html(result);
if(result){
	$("#subCatIds").attr('required','true');
}else{
	$("#subCatIds").removeAttr('required','');
}					
				
				}
			
		});
	}
}

</script>

<script>
function getUnits(id) {
	var CategoryID = id;
	var load = '<i class="fa fa-spinner fa-spin"></i>';
	$("#UnitType").html(load);
//	return false;
	if(CategoryID){
		$.ajax({
			type: "POST",
			url: '<?php echo base_url(); ?>product/Product/getUnits',
		//	dataType: 'json',
			data: {"CategoryID":CategoryID},
			success: function(result){
					$("#UnitType").html(result);					
				if(result){
					$("#UnitType").attr('required','true');
				}else{
					$("#UnitType").removeAttr('required','');
				}					
	
				}
			
		});
	}
}
</script>

<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
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
	$(addButton).click(function(){ //Once add button is clicked
		if(x < maxField){ //Check maximum number of input fields
			x++; //Increment field counter			
			i++;
			var fieldHTML = '<div class="parent_div" id="record'+i+'"> <div class="col-md-10" style="margin-top:10px;"><div class="col-md-3"> 			  <select class="form-control" name="ProductcatId[]" onchange=filterProduct(this.value,"p'+i+'")>	<option value="">---Select Category---</option> <?php if($allCategories = getCat(null,true)){foreach($allCategories as $list):?><option value="<?php echo $list['id']; ?>"><?php echo ucfirst($list['cat_name']); ?></option><?php endforeach; }?></select><span class="ProductcatIdtext" style="color:red;"></span></div>  <div class="col-md-3"> <select class="form-control productType" name="recipe_ingredients_products_id[]" onchange=updatename(this.value,"p'+i+'") id="p'+i+'"><option value="">---Select Product---</option><?php if($allProducts = getAllProducts()){foreach($allProducts as $plist):?><option catid="<?php echo $plist['product_cat_id']; ?>" value="<?php echo $plist['product_id']; ?>"><?php echo ucfirst($plist['product_name']); ?></option><?php 	endforeach; } ?></select><span class="ProductIdtext" style="color:red;"></span></div> <div class="col-md-3"><input type="text" name="IngredientsQty[]" class="form-control"></div> <div class="col-md-2"><a href="javascript:void(0);" class="remove_button" title="Remove field" id="'+i+'"><i class="fa fa-minus btn btn-danger"></i></a></div></div>'; 
			$(wrapper).append(fieldHTML); // Add field html
		 
		}
	});
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
		e.preventDefault();
		var remove_id = $(this).attr("id");
		$('#record'+remove_id+'').remove();
		//alert('fgvdfsgh');
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