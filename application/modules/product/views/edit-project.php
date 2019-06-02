<style>
.close{
    font-size: 60px;
    right: 10px;
    top: 5px;
    position: absolute;
}
.form-group div{
	margin-bottom: 10px;
}
.padding-0{
	padding:0px;
}
ul li label{    cursor: pointer!important;}
ul li{
	    margin-left: -36px;
		cursor:pointer;
}
</style>
<section class="content">
<div class="row">
            <div class="col-md-12">
              <!-- Custom Tabs -->
              <div class="" style="    background: #fff;"> 				
                <div class="box-header">
                  <h3 class="box-title"><strong>Edit Product Details</strong></h3>
				  <?php if($this->session->flashdata('alert')){ ?>
				
					<div class="col-md-12 alert alert-info" style="margin-top:10px;margin-bottom:10px;">
						<?php  echo $this->session->flashdata('alert'); ?>
					</div>
				<?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="" id="tab_1">
                    <form role="form"  action="<?php echo base_url();?>product/editproject?id=<?= $this->input->get('id') ?>"  enctype="multipart/form-data" method="post" name="myform" onsubmit="return(validate());" >
					
					<div class="form-group">
					<div class="col-md-3">
                      <label>Category Name</label>
                      
                      <select class="form-control" name="catId" onchange="subcat(this.value)" required>
                    
                        <?php if($allCategories){foreach($allCategories as $list):?>
						
                      <option value="<?php echo $list->id; ?>" <?php if($list->id ==  $project->product_cat_id){ echo "selected";
					  }?>><?php echo ucfirst($list->cat_name); ?></option>
                        <?php 
						endforeach; } ?>
						
                      </select> 
                     </div>
					 <div class="col-md-3">
						<label>Sub Category Name</label>
                      
			<?php $allsubCategories = $this->Projectsmodel->getSubCategories($project->product_cat_id);
			?>
		
                      <select class="form-control" name="subCatId" id="subCatId">
						<option value="0">---Select SubCategory---</option>  
			  <?php if($allsubCategories){foreach($allsubCategories as $lists):?>
									
								  <option value="<?php echo $lists['id']; ?>" <?php if($lists['id'] ==  $project->product_sub_cat_id){ echo "selected";
								  }?>><?php echo ucfirst($lists['cat_name']); ?></option>
									<?php 
									endforeach; } ?>						
                      </select>
                    </div>  
						<div class="col-md-3">					
						  <label for="inputOrderName">Product Name</label>
						  <input name="ProductName" class="form-control" id="projectName" value="<?= $project->product_name?>" placeholder="Product Name" required>
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Product Hindi Name</label>
						  <input name="ProductHindiName" class="form-control" id="HindiName" value="<?= $project->product_name_hindi?>" placeholder="Product Hindi Name">
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Product Price</label>
						  <input type="text" name="ProductLocation" class="form-control" id="projectLocation" value="<?= $project->product_price?>" placeholder="Project Location" required>
						</div>
						
						<div class="col-md-3">					
						  <label for="inputOrderName">Unit Type</label>
							  <select name="UnitType"   class="form-control" onchange="getUnits(this.value);" required>
								<option value="">--Select Unit Type--</option>
								
								<option value="weight" <?php if($project->product_unit_type == 'weight'){ echo "selected";}?>>weight</option>
								<option value="per piece" <?php if($project->product_unit_type == 'per piece'){ echo "selected";}?>>per piece</option>
								<option value="drink" <?php if($project->product_unit_type == 'drink'){ echo "selected";}?>>liquid</option>
								
							  </select>
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Product Weight Unit</label>
							 <select name="ProductWeightUnit"  id="UnitType" class="form-control">
								<option>--Select Weigth Unit--</option>
								
								<option value="kg" <?php if($project->product_weight_unit == 'kg'){ echo "selected";}?>>kg</option>
								<option value="g" <?php if($project->product_weight_unit == 'g'){ echo "selected";}?>>g</option>
								<option value="mg" <?php if($project->product_weight_unit == 'mg'){ echo "selected";}?>>mg</option>
								<option value="per piece" <?php if($project->product_weight_unit == 'per piece'){ echo "selected";}?>>per piece</option>
								
							  </select>
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Product Weight</label>
						  <input type="number" name="ProductWeight" class="form-control" id="" value="<?= $project->product_weight?>" placeholder="Product Weight">
						</div>			
						<div class="col-md-3">			  			
						  <label for="inputOrderName">In Stock(In kg)</label>
						  <input type="number" name="ProductQTY" class="form-control" value="<?= $project->product_qty;?>">
						</div>
							<div class="col-md-3">					
						  <label for="inputOrderName">Source</label>
						  <input type="text" name="source" class="form-control" id="" value="<?= $project->product_source;?>" placeholder="Product Source">
						</div>
						<div class="col-md-3">					
						  <label for="inputOrderName">Stamp</label>
						  <input type="text" name="stamp" class="form-control" id="" value="<?= $project->product_stamp;?>" placeholder="Product Stamp">
						</div>
						
						<div class="col-md-3">					
						  <label for="inputOrderName">Top Products</label>
							  <select name="product_type"   class="form-control" required>
								<option value="">--Select Top Products--</option>
								
								<option value="top" <?php if($project->product_type == 'top'){ echo "selected";}?>>Top</option>
								<option value="other" <?php if($project->product_type == 'other'){ echo "selected";}?>>Other</option>
								
							  </select>
						</div>
						<div class="col-md-3">					
						  <label for="inputGstTax">GST Tax Percentage</label>
						  <input type="text" name="gst_tax" class="form-control" id="gst_tax" value="<?= $project->product_gst_tax;?>" placeholder="Gst Tax Percentage">
						</div>
						<div class="col-md-6">					
						  <label for="inputGstTax">Select Quantity to Display</label>
						  <br>
						  <?php $units = units(); $weight = $units['weight']; $piece = $units['piece'];  $drink = $units['drink'];
								
								$selectedunits = json_decode($project->product_selected_weight_unit,true);
								if(!$selectedunits)
									$selectedunits = array();
								//print_r($selectedunits); die;
								if($project->product_unit_type =='weight'){
									$used = $units['weight'];
									$new = '<option  value="grams">Grams</option><option  value="kg">Kg</option>';
								}elseif($project->product_unit_type =='per piece'){
									$used = $units['piece']; 
									$new = '<option  value="piece">piece</option>';
								}elseif($project->product_unit_type =='drink'){
									$used = $units['drink'];
									$new = '<option  value="ml">ml</option><option  value="L">L</option>';
								}
								if($used){
									//print_r($used); die;
									foreach($used as $key=>$value){?>
									<input type="checkbox" name="product_selected_weight_unit[]" <?php if($r=array_key_exists($key,$selectedunits)){echo 'checked';} ?> value="<?php echo $key; ?>"> <?php echo $value; ?> &nbsp;
							<?php	}
								/* 	if($selectedunits){
										foreach($selectedunits as $key=>$value){?>
									<input type="checkbox" name="product_selected_weight_unit[]" <?php if($r=array_key_exists($key,$selectedunits)){echo 'checked';}else{echo 'un '.$r;} ?> value="<?php echo $key; ?>"> <?php echo $value; ?> &nbsp;
									
							<?php		}
									} */
									
								}
						  ?>
						  <span id="newqty"></span>
						</div>
						<!--div class="col-md-3">					
						  <label for="inputGstTax">Add Quantity</label>
						  <br>
						  <input type="number" name="" class="form-control" id="addquantity" value="" style="width:30%;display:inline;">
						  <select type="text" name="" class="form-control" id="addquantityunit" onchange="" style="width:30%;display:inline;padding-left:0">
							<?php //echo $new; ?>
						  </select>
						  <span class="btn btn-success" style="border-radius:0px;" onclick="addnewquantity(this.value);"><i class="fa fa-plus"></i> Add</span>
						</div-->
						<div class="col-md-3">					
						  <label for="inputOrderName">You may also like (Products)</label>								
								<select class="form-control" multiple name="alternateproducts[]" id="productsmultiselect" style="width:100%">
								<?php $sub_ids = json_decode($project->alternate_prroducts,true);
									if(!$sub_ids){
										$sub_ids = array();
									}
								$allProjects = getAllProducts();
								if($allProjects){
									$SelectedWeight = $selectedunits;$usedd=array();
										foreach($allProjects as $slist){
											if(count($SelectedWeight) > 0){
												if($slist['product_unit_type'] =='weight'){
													$usedd = ($SelectedWeight);
													$used = $units['weight']; 
												}elseif($slist['product_unit_type'] =='per piece'){
													$usedd=  ($SelectedWeight ); 
													$used = $units['piece'];  
												}elseif($slist['product_unit_type'] =='drink'){
													$usedd =  ($SelectedWeight );
													$used = $units['drink'];  
												}
											}else{
												if($slist['product_unit_type'] =='weight'){
													$used = $units['weight']; 
												}elseif($slist['product_unit_type'] =='per piece'){
													$used = $units['piece'];  
												}elseif($slist['product_unit_type'] =='drink'){
													$used = $units['drink']; 
												}
											} 
									?>
									<option value="<?php echo $slist['product_id'];?>" <?php  if(in_array($slist['product_id'],$sub_ids)){echo 'selected';}  ?>><?php echo ucfirst($slist['product_name']) ?> (Rs<?php echo $slist['product_price']; ?>/<?php if((array_key_exists($slist['product_weight_unit'],$usedd))!=''){echo $usedd[$slist['product_weight_unit']]; }else{echo $used[$slist['product_weight_unit']]; }?>)</option>
								<?php }} ?>
							
								</select>
						</div>
						<div class="col-md-12">					
						  <label for="inputOrderName">Product Description</label>
						  <textarea id="editor1" rows="4" cols="50" name="ProductDescription" class="form-control"><?= $project->product_details?></textarea>
						</div>
					
					<div class="col-md-12">						
                      <label for="inputOrderName">Nutritional Value</label>
                      <textarea id="editor2" rows="4" cols="50" name="product_nutritional" class="form-control"><?= $project->product_nutritional?></textarea>
                    </div>
					
					<div class="col-md-12">						
                      <label for="inputOrderName">How to Store</label>
                      <textarea id="editor4" rows="4" cols="50" name="HowtoStore" class="form-control"><?= $project->how_to_store?></textarea>
                    </div>
					<div class="col-md-12">						
                      <label for="inputOrderName">Tip</label>
                      <textarea id="editor3" rows="4" cols="50" name="Tip" class="form-control"><?= $project->product_tip?></textarea>
                    </div>
					<div class="col-md-12">
                      <label for="InputProfilePhoto">Main Image&#160;</label>
                     <br/>
					 <?php if($project->product_actual_img) { ?>
					  <a href="<?php echo base_url().'upload/'.$project->product_actual_img; ?>" id="link" target="_blank">
							<span class="label label-success" style="font-size:11px;">View</span>
					  </a>
					  <?php } else { echo '<input type="file" name="ProductImg" id="InputProfilePhoto">'; } ?>
					  <?php if($project->product_actual_img) { ?>
					  <span href="#" id="userLink" style="visibility:visible;" onclick="deleteUserDetails()">
							<span class="label label-danger" style="font-size:11px; cursor:pointer;">Change main image</span>
							
					  </span>
					  <br/>
					  <br/>
					           <input type="file" name="ProductImg" id="InputProfilePhoto" style="display:none">  
						
							
						<?php } ?>
                      
                    </div>
					<div class="col-md-12">
						<center>
							<label for="inputOrderName"> &nbsp;<br/></label>
							<input class="btn btn-success" id="orderEmailSubmit" type="submit" value="Update" style=" margin-top: 20px;">
						</center>
					</div>
</div>
					</form>
					<!--div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h3>Manage Recipes</h3>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding-0">
	
						</div>
					</div-->
                  </div><!-- /.tab-pane -->

                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
            </div><!-- /.col -->
			</div><!--/.row -->
			
</section><!-- /.content -->	
<section class="content" style="background:#fff;">
	<div class="row">
		<div class="col-md-12">		
			<H2>Additional Images</H2>
		</div>
		<form action="<?= base_url()?>product/uploadAttachments?id=<?php echo $this->input->get('id');?>" method="post"   enctype="multipart/form-data">
		<div class="col-md-6">					
            <label for="inputOrderName">Add Images</label>
			<input type="file" name="projectImg[]" id="" multiple required>  
        </div>
		<div class="col-md-6">					
           
            <label for="inputOrderName"></label><br>
            <button class="btn btn-success">UPLOAD</button>
        </div>
		</form>
		<div class="col-md-12" style="margin-top:20px;">
			<?php if($attachment){
				foreach($attachment as $list){ ?>
			<div class="col-md-6" style="padding:2px;">		
				<div style="border:1px solid #ddd;    overflow: hidden;">
				<div class="close" onclick="delAttach('<?php echo $list->id;?>','<?php echo $list->product_attachment ?>')">
					<i class="fa fa-times-circle-o" aria-hidden="true"></i>
				</div>
				<img src="<?php echo base_url() ?>upload/<?php echo $list->product_attachment ?>" style="382px; height:300px;margin:5px;"/>
				</div>
			</div>
			<?php } }else {
				echo "<p>No Product Images uploaded</p>";
			}?>
		</div>
	</div>
</section>
<script type="text/javascript">
        function validate() {
            var outputPercentageString = document.myForm.gst_tax.value;
            var outputPercentage = parseInt(gst_tax);
            if (gst_tax <= 0 || gst_tax >= 100) {
                alert("Please the correct percentage.");
                document.myForm.gst_tax.focus();
                return false;
            }
        }
    </script>
<script>
 function deleteUserDetails() {
		//alert('hi');
		document.getElementById('InputProfilePhoto').style.display='block';
		document.getElementById('userLink').style.display='none';
		
		}
</script>
<script>
function delAttach(id,name) {
    x = confirm("You want to delete it!");
	if(x){
		location.href='<?php echo base_url();?>product/delattachment?id='+id+'&name='+name;
	}
}
</script>

<script>
function subcat(id) {
	var CategoryID = id;
	//var load = ``;
	//$("#setproductlist").html(load);
//	return false;
	if(CategoryID){
		$.ajax({
			type: "POST",
			url: '<?php echo base_url(); ?>product/Product/subcategories',
		//	dataType: 'json',
			data: {"CategoryID":CategoryID},
			success: function(result){
				console.log(result);
				console.log(result.Result);
					$("#subCatId").html(result.Result);					
				if(result.Success == 'True' ){
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
					$("#UnitType option[value='<?php echo $project->product_weight_unit;?>']").prop('selected', true) ;
				}else{
					$("#UnitType").removeAttr('required','');
				}					
	
				}
			
		});
	}
}
</script>
<script>
function addnewquantity(value=null){
	var addquantity = $("#addquantity").val();	
	var addquantityunit = $("#addquantityunit").val(); 
	if(!addquantity.trim()){
		alert('Enter quantity first!');
		$("#addquantity").focus();
		return false;
	}
	var qty = 0;
<?php  if($project->product_unit_type == 'weight'){ ?>
	if(addquantityunit == 'grams'){
		qty = addquantity;
	}else{
		qty = addquantity  * 1000;
	}
<?php }elseif($project->product_unit_type =='per piece'){ ?>
	 	qty = addquantity;
	 
<?php }elseif($project->product_unit_type =='drink'){?>
	if(addquantityunit == 'ml'){
		qty = addquantity;
	}else{
		qty = addquantity  * 1000;
	}
<?php } 
?>
	
						
	var x='<input type="checkbox" name="product_selected_weight_unit[]" checked value="'+qty+'"> '+addquantity+' '+addquantityunit+' &nbsp;';
	$('#newqty').append(x);
	$("#addquantity").val('')
}
</script>
