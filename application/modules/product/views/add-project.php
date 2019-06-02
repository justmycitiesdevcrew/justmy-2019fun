<section class="content">
<div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
             
                <div class="box-header">
                  <h3 class="box-title"><strong>New Product Form</strong></h3>
                </div><!-- /.box-header -->
                <div class="tab-content  col-md-12">
                  <div class="tab-pane active" id="tab_1">
                    <form role="form"  action="<?php echo base_url();?>product/submitNewProduct"  enctype="multipart/form-data" method="post" name="myform" onsubmit="return(validate());" >
					
					<div class="form-group">
					<div class="col-md-3">
                      <label>Category Name</label>                      
                      <select class="form-control" name="catId" onchange="subcat(this.value)" required>
                    
						<option value="">---Select Category---</option>   
                        <?php if($allCategories){foreach($allCategories as $list):?>						
						<option value="<?php echo $list->id; ?>"><?php echo ucfirst($list->cat_name); ?></option>
                        <?php 
						endforeach; } ?>
						
                      </select>
                    </div> 
					<div class="col-md-3">
                      <label>Sub Category Name</label>
                      <div id="subCatIddiv">
						  <select class="form-control" name="subCatId" id="subCatIds" onchange="subCatId(this.value)">
						  
							<option value="">---Select SubCategory---</option>
							<?php //if($allCategories){foreach($allCategories as $list):?>
							
						  <option value="<?php //echo $list->id; ?>"><?php //echo ucfirst($list->cat_name); ?></option>
							<?php 
						//	endforeach; } ?>
								
						  </select>
					  </div>
                    </div>  
					<div class="col-md-3">					
                      <label for="inputOrderName">Product Name</label>
                      <input name="ProductName" class="form-control" id="ProductName" value="" placeholder="Product Name" required>
                    </div>
					<div class="col-md-3">					
					  <label for="inputOrderName">Product Hindi Name</label>
					  <input name="ProductHindiName" class="form-control" id="HindiName" value="" placeholder="Product Hindi Name" required>
					</div>
					<div class="col-md-3">					
                      <label for="inputOrderName">Product Price(INR)</label>
                      <input type="text" name="ProductLocation" class="form-control" id="ProductLocation" value="" placeholder="Product Price" required>
                    </div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Unit Type</label>
							  <select name="UnitType"   class="form-control" onchange="getUnits(this.value);" required>
							  
								<option value="">--Select Unit Type--</option>
								<option value="weight">Weight</option>
								<option value="per piece">Per piece</option>
								<option value="drink">Liquid</option>
								
							  </select>
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Product Weight Unit</label>
							 <select name="ProductWeightUnit" id="UnitType" class="form-control" required="required">
								 <option value="">100 grams</option>
								 <option value="">200 grams</option>
								 <option value="">500 grams</option>
								 <option value="">1 kg</option>
								 <option value="">2 kg</option>
								 <option value="">3 kg</option>
								 <option value="">5 kg</option>
							 </select>
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Product Weight</label>
						  <input type="number" name="ProductWeight" class="form-control" id="" value="" placeholder="Product Weight">
						</div>
					
					<!--div class="col-md-3">					
						  <label for="inputOrderName"> Discounted Price(INR)</label>
						  <input type="hidden" name="ProductDiscount" class="form-control" id="" value="" placeholder="Product Discounted Price" required>
					<!--/div-->
					
					<div class="col-md-3">						
                      <label for="inputOrderName">In Stock(In kg)</label>
                      <input type="number" clas name="ProductQTY" class="form-control">
                    </div>
					
					
						<div class="col-md-3">					
						  <label for="inputOrderName">Source</label>
						  <input type="text" name="source" class="form-control" id="" value="" placeholder="Product Source">
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Stamp</label>
						  <input type="text" name="stamp" class="form-control" id="" value="" placeholder="Product Stamp">
						</div>
					
						<div class="col-md-3">					
						  <label for="inputOrderName">Top 5</label>
							  <select name="product_type"   class="form-control" required>
								<option value="">--Select Top 5--</option>
								
								<option value="top">Top</option>
								<option value="other" selected>Other</option>
								
							  </select>
						</div>
						<div class="col-md-3">					
						  <label for="inputGstTax">GST Tax Percentage</label>
						  <input type="text" name="gst_tax" class="form-control" id="gst_tax" value="" placeholder="Gst Tax Percentage" required>
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">You may also like (Products)</label>
							
								
								<select class="form-control" multiple name="alternateproducts[]" id="productsmultiselect" style="width:100%">
								<?php  $units = units(); $weight = $units['weight']; $piece = $units['piece'];  $drink = $units['drink'];  $allProjects = getAllProducts();
								if($allProjects){
										foreach($allProjects as $slist){
											 if($slist['product_unit_type'] =='weight'){
												$used = $units['weight']; 
											}elseif($slist['product_unit_type'] =='per piece'){
												$used = $units['piece'];  
											}elseif($slist['product_unit_type'] =='drink'){
												$used = $units['drink']; 
											}
										//	echo "<pre>"; print_r($used); echo $used[$slist['product_weight_unit']]; die;
									?>
									<option value="<?php echo $slist['product_id'];?>" ><?php echo ucfirst($slist['product_name']) ?> (Rs<?php echo $slist['product_price'] ?>/<?php if(array_key_exists($slist['product_weight_unit'],$used)){echo $used[$slist['product_weight_unit']]; }?>)</option>
								<?php }} ?>
							
								</select>
						</div>
					<div class="col-md-12">						
                      <label for="inputOrderName">Product Description</label>
                      <textarea id="editor1" rows="4" cols="50" name="ProductDescription" class="form-control"></textarea>
                    </div>
					<div class="col-md-12">						
                      <label for="inputOrderName">Nutritional Value</label>
                      <textarea id="editor4" rows="4" cols="50" name="ProductNutritional" class="form-control"></textarea>
                    </div>
					<div class="col-md-12">						
                      <label for="inputOrderName">How to Store</label>
                      <textarea id="editor2" rows="4" cols="50" name="HowtoStore" class="form-control"></textarea>
                    </div>
					<div class="col-md-12">						
                      <label for="inputOrderName">Tip</label>
                      <textarea id="editor3" rows="4" cols="50" name="Tip" class="form-control"></textarea>
                    </div>
					<!--div class="col-md-6">					
                      <label for="inputOrderName">Product Icon</label>
                      <input type="file" name="ProductIcon" class="form-control" id="productImage" value="" >
                    </div-->
					<div class="col-md-6">					
                      <label for="inputOrderName">Product Image</label>
                      <input type="file" name="ProductImg" class="form-control" id="productImage" value="" required>
                    </div>
					
					<br/>
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
function validate()
    {
       
   if( document.myForm.gst_tax.value <= 0||>=100)

   {
     alert( "Please the correct percentage." );
     document.myForm.gst_tax.focus() ;
     return false;
   }
  } 
	 
</script>
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
				var obj = JSON.parse(result); 
					$("#subCatIddiv").html(obj.Result);					
					if(obj.Success == 'True' ){
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