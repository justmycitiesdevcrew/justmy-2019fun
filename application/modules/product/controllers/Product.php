<?php 
class Product extends CI_Controller {
	
	public function __construct()
   {  
	parent::__construct(); 
		
		$this->load->helper('common');
		$this->load->model('Projectsmodel');
		$this->load->library('user_agent');
		$this->load->library('upload');
	//	  $this->load->library("PHPExcel"); 
        if(!isLoggedIn())
         redirect('login');
   }

	public function index(){
			if(isset($_POST['filter'])){
			//	echo "<pre>"; print_r($this->input->post()); die;
				if($this->input->post('status') == '0')
					$status = $this->input->post('status');
				else
					$status =$this->input->post('status');
				
				if($this->input->post('category')){
					$category = $this->input->post('category');
				}else{
					$category =NULL;
				}
				if($this->input->post('subcategory')){
					$subcategory = $this->input->post('subcategory');
				}else{
					$subcategory =NULL;
				}
				$data['allProjects']=$this->Projectsmodel->getProducts($status,'','',$category,$subcategory);
			}else{
				$data['allProjects']=$this->Projectsmodel->getProducts();
			}
		//echo "<pre>"; print_r($data); die;
		$this->load->view('include/header',$data);
		$this->load->view('include/breadcrum');
	    $this->load->view('view-projects-list');
		$this->load->view('include/footer');
	}

	public function subcategories(){
		$data = $this->input->post();
		$res = $this->Projectsmodel->getSubCategories($data['CategoryID']);
		if($res){
			$r = '<select class="form-control" name="subCatId" required>';
			foreach($res as $list){				
				$r .='<option value="'.$list['id'].'">'.ucfirst($list['cat_name']).' </option>';				
			}
			$r .='</select>';
			$result['Success'] = "True";
			$result['Message'] = ' ';
			$result['Result'] = $r;
			
		}else{			 
			$r = '<select class="form-control" name="subCatId"  >';
			$r .='<option value=""></option>';			 
			$r .='</select>';
			$result['Success'] = "False";
			$result['Message'] = ' ';
			$result['Result'] = $r;
		}
	//	echo $r;
		die(json_encode($result));
	}
	public function getUnits(){
		$data = $this->input->post('CategoryID');
	//	$res = $this->Projectsmodel->getSubCategories($data['CategoryID']);
		$units  = units(); $weightUnits = $units['weight']; $pieceUnits = $units['piece']; $drinkUnits = $units['drink'];
		if($data == 'weight'){
			echo '<select class="form-control" name="subcat" required>';
			foreach($weightUnits as $key => $values){
				echo '<option value="'.$key.'">'.$values.'</option>';
			}
			echo '</select>';
		}else if($data == 'per piece'){
			echo '<select class="form-control" name="subcat" required>';
			foreach($pieceUnits as $key => $values){
				echo '<option value="'.$key.'">'.$values.'</option>';
			}
			echo '</select>';
		}else if($data == 'drink'){
			echo '<select class="form-control" name="subcat" required>';
			foreach($drinkUnits as $key => $values){
				echo '<option value="'.$key.'">'.$values.'</option>';
			}
			echo '</select>';
		}
	}
	public function addproject()
	{
	//	$data['allProjects']=$this->Projectsmodel->getProducts();
		$data['allCategories']=$this->Projectsmodel->getCategories();
		//echo "<pre>"; print_r($data); die;
		$this->load->view('include/header',$data);
		$this->load->view('include/breadcrum');
	    $this->load->view('add-project');
		$this->load->view('include/footer');
	}
	public function viewprojects()
	{
		$data['allProjects']=$this->Projectsmodel->getProducts();
		//$data['allCategories']=$this->Projectsmodel->getCategories();
		//echo "<pre>"; print_r($data); die;
		$this->load->view('include/header',$data);
		$this->load->view('include/left-sidebar');
		$this->load->view('include/breadcrum');
	    $this->load->view('view-projects-list');
		$this->load->view('include/footer');
	}
	
	public function submitNewProduct(){
		
		$data['input'] = $this->input->post();	
		$attachment ="";
		$file=$_FILES;
			if($_FILES['ProductImg']['name'] !="")
		    {
				$fieldName = 'ProductImg';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'product_Img_'.time().'.'.$ext;
				//echo "<pre>";print_r($attachment);die;
				 $this->upload->initialize($this->set_upload_options($attachment)); 
				if($this->upload->do_upload($fieldName))
				{
					$msg = "upload success"; //die;
				}
				else
				{
					$error = array('error' => $this->upload->display_errors());
					
				}
			
			    //print_r($_FILES); die;
			}
			

		$data['input']['ProductImg'] = $attachment;		
		//echo "<pre>"; print_r($data); die;
		if($data['input']){
			$result=$this->Projectsmodel->insertProduct($data['input']);
		}
		if($result){
			redirect(base_url().'product?success=true');
		}else{
			redirect(base_url().'product?success=false');
		}			
	}
	public function editproject(){
		$data['input'] = $this->input->post();	
		if($data['input']){
			$attachment ="";
			$file=$_FILES;
		//	echo "<pre>"; print_r($data); die;
			if($_FILES['ProductImg']['name'] !="")
		    {
				$fieldName = 'ProductImg';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'ProdecttImg_'.time().'.'.$ext;
				//echo "<pre>";print_r($attachment);die;
				 $this->upload->initialize($this->set_upload_options($attachment)); 
				if($this->upload->do_upload($fieldName))
				{
					$msg = "upload success"; //die;
				}
				else
				{
					$error = array('error' => $this->upload->display_errors());
					
				}
			
			    //print_r($_FILES); die;
			}
			

			$data['input']['ProductImg'] = $attachment;		
			//echo "<pre>"; print_r($data); die;
			if($data['input']){
				if(isset($data['input']['product_selected_weight_unit'])){
				$units = units(); $weight = $units['weight']; $piece = $units['piece'];  $drink = $units['drink'];
				$usedunits = array();
				if($data['input']['UnitType'] =='weight'){
					if($data['input']['product_selected_weight_unit']){
						foreach($data['input']['product_selected_weight_unit'] as $value){
							if($value < 1000){
								$usedunits[$value] = $value.' grams';
							}else{
								
								$usedunits[$value] = ($value/1000).' kg';
							}
						}
					}
				}elseif($data['input']['UnitType'] =='per piece'){ 
					if($data['input']['product_selected_weight_unit']){
						foreach($data['input']['product_selected_weight_unit'] as $value){							
								$usedunits[$value] = $value.' piece';							 
						}
					}
				
				}elseif($data['input']['UnitType'] =='drink'){
					if($data['input']['product_selected_weight_unit']){
						foreach($data['input']['product_selected_weight_unit'] as $value){
							if($value < 1000){
								$usedunits[$value] = $value.' ml';
							}else{								
								$usedunits[$value] = ($value/1000).' L';
							}
						}
					}
				}
				$data['input']['usedunits'] = json_encode($usedunits);
				}else{					
					$data['input']['usedunits'] = '';
				}
			//	echo "<pre>"; print_r($data); die;
				$result=$this->Projectsmodel->updateProduct($data['input']);
			}
			if($result){
				$this->session->set_flashdata('alert', 'Product updated successfully!');
				redirect($this->agent->referrer());
			}else{
				$this->session->set_flashdata('alert', 'Product update failure!');
				redirect($this->agent->referrer());
			}
		}
		else{
			$data['allProjects']=$this->Projectsmodel->getProducts();
			$data['allCategories']=$this->Projectsmodel->getCategories();
			foreach($data['allProjects'] as $details){
				if($details->pid == $this->input->get('id')){
					$data['project']=$details;
				}
			}
			$data['attachment']=$this->Projectsmodel->getAttachments();			
			//echo "<pre>"; print_r($data['attachment']); die;
			$this->load->view('include/header',$data);
			$this->load->view('include/breadcrum');
			$this->load->view('edit-project');
			$this->load->view('include/footer');
		}
	}
	public function ActiveStatus(){
		$result = $this->Projectsmodel->ActiveStatus($this->input->post());
		if($result)			
		{				
	
			$this->session->set_flashdata('alert', 'Product status updated successfully!');
	         redirect(base_url().'product');		
	 
	    }
	}
	public function ActiveStatusrecipe(){
		$result = $this->Projectsmodel->ActiveStatusrecipe($this->input->post());
		if($result)			
		{		$this->session->set_flashdata('alert', 'Recipe status updated successfully!');
	       		
	         redirect($this->agent->referrer());		
	 
	    }
	}
	public function uploadAttachments(){
		$data['input'] = $this->input->post();
		for($i=0; $i < sizeof($_FILES['projectImg']['name']); $i++){
				$attachment ="";
				$file=$_FILES;				
				if($_FILES['projectImg']['name'][$i] !=""){
					$fieldName = 'projectImg';
					$ext = pathinfo($_FILES[$fieldName]['name'][$i], PATHINFO_EXTENSION);
					$attachment = 'product_Img_Attachments_'.$i.'_'.time().'.'.$ext;
					$this->upload->initialize($this->set_upload_options($attachment));
					$_FILES['fileName']['name'] = $_FILES[$fieldName]['name'][$i];
					$_FILES['fileName']['type'] = $_FILES[$fieldName]['type'][$i];
					$_FILES['fileName']['tmp_name'] = $_FILES[$fieldName]['tmp_name'][$i];
					$_FILES['fileName']['error'] = $_FILES[$fieldName]['error'][$i];
					$_FILES['fileName']['size'] = $_FILES[$fieldName]['size'][$i];					
					if($this->upload->do_upload('fileName')){
						$msg = "upload success"; //die;
					}
					else{
						$error = array('error' => $this->upload->display_errors());
						
					}
				}
				$data['image'] = $attachment;		
				$data['Name'] = 'product_Img';
				$result=$this->Projectsmodel->uploadAttachments($data);		
		}
		redirect($this->agent->referrer());
	}
	public function delattachment(){
		//echo base_url()."upload/".$this->input->get('name'); die;
	//	$res=unlink("upload/".$this->input->get('name'));		
		$result=$this->Projectsmodel->delattachment($this->input->get('id'));
		redirect($this->agent->referrer());
	}
	
	public function recipes(){
			if(isset($_POST['filter'])){
			//	echo "<pre>"; print_r($this->input->post()); die;
				if($this->input->post('status') == '0')
					$status = $this->input->post('status');
				else
					$status =$this->input->post('status');
				
				if($this->input->post('category')){
					$category = $this->input->post('category');
				}else{
					$category =NULL;
				}
				if($this->input->post('subcategory')){
					$subcategory = $this->input->post('subcategory');
				}else{
					$subcategory =NULL;
				}
				$data['allProjects']=$this->Projectsmodel->getAllRecipes($status,'','',$category,$subcategory,'',$proId = $this->input->get('product_id'));
			}else{
				$data['allProjects']=$this->Projectsmodel->getAllRecipes('','','','','','',$proId = $this->input->get('product_id'));
			}
		//echo "<pre>"; print_r($data); die;
		$this->load->view('include/header',$data);
		$this->load->view('include/breadcrum');
	    $this->load->view('view-recipes-list');
		$this->load->view('include/footer');
	}
	public function addrecipes(){
		
		$data['allProjects']=$this->Projectsmodel->getProducts($status='1');
		$this->load->view('include/header',$data);
		$this->load->view('include/breadcrum');
	    $this->load->view('add-recipes');
		$this->load->view('include/footer');
	}
	
	public function submitNewRecipe(){
		
		$data['input'] = $this->input->post();
		if(isset($data['input']['recipe_ingredients_products_id'])){
			foreach($data['input']['recipe_ingredients_products_id'] as $key => $list){
				if($list){
					$data['input']['ingredients'][$key] = array(
						'productid'=>$list, 
						'productqty'=>$data['input']['IngredientsQty'][$key], 
							'productcatid'=>$data['input']['ProductcatId'][$key], 
						);
				}
			}
		}else{
				$data['input']['ingredients'] = array();
		}
		$attachment ="";
		$file=$_FILES;
			if($_FILES['recipe_img']['name'] !="")
		    {
				$fieldName = 'recipe_img';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'recipe_Img_'.time().'.'.$ext;
				//echo "<pre>";print_r($attachment);die;
				 $this->upload->initialize($this->set_upload_options($attachment)); 
				if($this->upload->do_upload($fieldName))
				{
					$msg = "upload success"; //die;
				}
				else
				{
					$error = array('error' => $this->upload->display_errors());
					
				}
			
			    //print_r($_FILES); die;
			}
			

		$data['input']['recipe_img'] = $attachment;		
		//echo "<pre>"; print_r($data); die;
		if($data['input']){
			$result=$this->Projectsmodel->submitNewRecipe($data['input']);
		}
		if($result){
			$this->session->set_flashdata('alert', 'Recipe Submitted successfully!');
			redirect(base_url().'product/recipes?product_id='.$this->input->get('product_id'));
		}else{
			$this->session->set_flashdata('alert', 'Recipe already added.');
			redirect(base_url().'product/recipes?product_id=131'.$this->input->get('product_id'));
		}			
	}
	
	
	public function editrecipes(){
		$data['input'] = $this->input->post();	
		
		if($data['input']){
			$attachment ="";
			$file=$_FILES;
			
			if(isset($data['input']['recipe_ingredients_products_id'])){
				foreach($data['input']['recipe_ingredients_products_id'] as $key => $list){
					if($list){
						$data['input']['ingredients'][$key] = array(
							'productid'=>$list, 
							'productqty'=>$data['input']['IngredientsQty'][$key], 
							'productcatid'=>$data['input']['ProductcatId'][$key], 
							);
					}
				}
			}else{
					$data['input']['ingredients'] = array();
			} 
		
	 		if($_FILES['recipe_img']['name'] !="")
		    {
				$fieldName = 'recipe_img';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'recipe_img_'.time().'.'.$ext;
				//echo "<pre>";print_r($attachment);die;
				 $this->upload->initialize($this->set_upload_options($attachment)); 
				if($this->upload->do_upload($fieldName))
				{
					$msg = "upload success"; //die;
				}
				else
				{
					$error = array('error' => $this->upload->display_errors());
					
				}
			
			    //print_r($_FILES); die;
			}
			

			$data['input']['recipe_img'] = $attachment;		
			//echo "<pre>"; print_r($data); die;
			if($data['input']){
				$result=$this->Projectsmodel->updateRecipe($data['input']);
			}
			if($result){
				$this->session->set_flashdata('alert', 'Recipe Updated successfully!');
				redirect(base_url().'product/editrecipes?id='.$this->input->get('recipe_id'));
			}else{
				$this->session->set_flashdata('alert', 'Recipe Updated successfully!');
				redirect(base_url().'product/editrecipes?id='.$this->input->get('recipe_id'));
			}
		}
		else{
			$data['project']= (object) $this->Projectsmodel->getAllRecipes('','','','','',$this->input->get('id'))[0];
			$data['allProjects']=$this->Projectsmodel->getProducts($status='1');
			if(!$data['project']){
				$data['project'] = '';
			}
				
			//	$data['attachment']=$this->Projectsmodel->getAttachments();			
			//	echo "<pre>"; print_r($data['project']); die;
			$this->load->view('include/header',$data);
			$this->load->view('include/breadcrum');
			$this->load->view('edit-recipe');
			$this->load->view('include/footer');
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	private function set_upload_options($attachment){   
        $config = array();
        $config['upload_path']   = FCPATH . 'upload';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 0;
        $config['overwrite']     = TRUE;		
		$config['file_name']	 = $attachment;

        return $config;
    }
	public function uploadPaper(){
		echo '<form role="form" action="'.base_url().'product/Product/submitPaper" enctype="multipart/form-data" method="post">
				
					<div class="form-group">
                      <label>Upload Excel</label><span id="concity" style="color:red;"></span>
						<input type="file" name="upload_excel" class="form-control" value="" required=""> 
					</div>
					
					
					<center><input class="btn btn-success" type="submit" value="Submit"></center>
					
					
					</form>';
	}
	public function submitPaper(){
		$data = $this->input->post();
		  $this->load->library("PHPExcel"); 
		  $objReader = PHPExcel_IOFactory::createReader('Excel2007');
		  $objReader->setReadDataOnly(true);

		  $path=$_FILES["upload_excel"]["tmp_name"];
		  $objPHPExcel = $objReader->load($path);
		  $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
	//	  echo "<pre>"; print_r($objWorksheet); die;
		for($i=1; $i<=$objWorksheet->getHighestRow(); $i++){
		   $ProductName = $objWorksheet->getCellByColumnAndRow(1,$i)->getValue();
		   $ProductInfo = $objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
		   $how_to_store = $objWorksheet->getCellByColumnAndRow(3,$i)->getValue();
		   $tip = $objWorksheet->getCellByColumnAndRow(4,$i)->getValue();
		   $category = $objWorksheet->getCellByColumnAndRow(5,$i)->getValue();
		   $subCategory = $objWorksheet->getCellByColumnAndRow(6,$i)->getValue();
		   if($category == 'Exotic'){
			   $cat = '10';
			   if($subCategory == 'Greens'){
				   $subcat = '15';
			   }
		   }
		   if($category == 'Grains'){
			   $cat = '3';
			  
				   $subcat =0;
			   
		   }
		   if($category == 'Fruits'){
			   $cat = '2';
			  
				   $subcat =0;
			   
		   }
		   if($category == 'Vegetables' || $category == 'Vegetable'){
			   $cat = '1';
			   if($subCategory == 'Greens'){
				   $subcat = '12';
			   }	
			   if($subCategory == 'Exotic'){
				   $subcat = '11';
			   }				   
				
			   if($subCategory == 'Seasonal'){
				   $subcat = '13';
			   }				   
				
			   if($subCategory == 'Essential'){
				   $subcat = '14';
			   }				   
				
				
			}
			//if(!empty($cityId) && !empty($categoryId))
			{
			   $inventryDatas = array(
				"product_cat_id" => $cat,
				"product_sub_cat_id" =>$subcat,
				"product_url"=>strtolower(str_ireplace(')','-',str_ireplace('(','',str_ireplace('&','-',str_ireplace(' ','-',($ProductName)))))),
				"product_name"=>$ProductName,
				"product_discount"=>0,
				"product_price"=>0,
				"product_weight"=>0,
				"product_weight_unit"=>'kg',
				"product_details"=>$ProductInfo,
				"how_to_store"=>$how_to_store,
				"product_tip"=>$tip,
				"product_icon"=>'',
				"product_actual_img"=>'',
				"product_qty"=>0,
				"product_source"=>'',
				"product_stamp"=>'',
				"product_nutritional"=>'',
				"status"=>'1',
				);
			
			}
		//	echo "<pre>"; print_r($inventryDatas);die;
			$res=$this->Projectsmodel->submitPaperExcel($inventryDatas);
			
			/* if($res){
			   $data['res'] = "succssufuly inserted";
			   $this->load->view('top');
			   $this->load->view('excel',$data);
			   
		   }else{
				echo "not uploading";
			   
		   } */
		}
		$this->session->set_flashdata('alert', 'Paper uploaded successfully');	
		redirect(base_url().'product/Product/uploadPaper');
		
	}
}
?>