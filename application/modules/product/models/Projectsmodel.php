<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Projectsmodel extends CI_Model

{

	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}
	
	public function getProducts($status=NULL,$proName=NULL,$catstatus=NULL,$cat_id=NULL,$subcat_id=NULL)
	{
			$this->db->select('*,products.product_id as pid,categories.cat_name as categoryname, sub.cat_name as subcatname');
			$this->db->from('products');	
			$this->db->join('categories','categories.id = products.product_cat_id');
			$this->db->join('categories sub','sub.id = products.product_sub_cat_id','left');
			if($proName){
				$this->db->where('product_name',  str_replace("-"," ",$proName));
			}
			if($status){
				$this->db->where('status',$status);
			}
			if($catstatus){
				$this->db->where('cat_status','1');
			}
			if($cat_id){
				$this->db->where('categories.id',$cat_id);
			}
			if($subcat_id){
				$this->db->where('sub.id',$subcat_id);
			}
			$this->db->order_by('products.product_id','desc');
			$query = $this->db->get();
			//echo $this->db->last_query(); //die;
			if ($query->num_rows() > 0) 
			{				
				$row = $query->result();
				return $row;			
			}else			
				return false;
		}
	public function getAllRecipes($status=NULL,$proName=NULL,$catstatus=NULL,$cat_id=NULL,$subcat_id=NULL,$recipe_id=NULL,$productId=NULL)
	{
			$this->db->select('*');
			$this->db->from('recipes');
			$this->db->join('products','recipes.recipe_product_id = products.product_id');	
			if($proName){
				$this->db->where('product_name',  str_replace("-"," ",$proName));
			}
			if($status){
				$this->db->where('status',$status);
			}
			if($catstatus){
				$this->db->where('cat_status','1');
			}
			if($cat_id){
				$this->db->where('categories.id',$cat_id);
			}
			if($subcat_id){
				$this->db->where('sub.id',$subcat_id);
			}
			if($recipe_id){
				$this->db->where('recipes.recipe_id',$recipe_id);
			}
			if($productId){
				$this->db->where('recipe_product_id',$productId);
			}
			$this->db->order_by('recipes.recipe_id','desc');
			$query = $this->db->get();
		//	echo $this->db->last_query(); //die;
			if ($query->num_rows() > 0) 
			{				
				$row = $query->result();
				return $row;			
			}else			
				return false;
	}
	function getCategories(){
		$this->db->select('*');
		$this->db->from('categories');	
		$this->db->where('parent_id','0');	
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			return $row;			
		}else			
			return false;
	}
	function getSubCategories($catId){
		$this->db->select('*');
		$this->db->from('categories');	
		$this->db->where('parent_id',$catId);	
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			return $row;			
		}else			
			return false;
	}
	function getAttachments(){
		$this->db->select('*');
		$this->db->from('product_attachment');	
		$this->db->where('product_id',$this->input->get('id'));	
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			return $row;			
		}else			
			return false;
	}
	function insertProduct($data){
		 $this->db->select('*');
		$this->db->from('products');	
		$this->db->where('product_name',strtolower(trim($data['ProductName'])));	
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() > 0) 
		{				
			return false;			
		}else			{
			
		if(!isset($data['alternateproducts'])){
			$data['alternateproducts'] = array();
		}
		$arr = array(
		                'product_cat_id' => $data['catId'],
		                'product_sub_cat_id' => $data['subCatId'],
						'product_name' => strtolower(trim($data['ProductName'])),
						'product_name_hindi' => strtolower(trim($data['ProductHindiName'])),
	'product_url' => strtolower(str_ireplace(')','-',str_ireplace('(','',str_ireplace('&','-',str_ireplace(' ','-',($data['ProductName'])))))),
						'product_details' => $data['ProductDescription'],
						'product_icon' => $data['ProductImg'],
						'product_actual_img' => $data['ProductImg'],
						'product_weight' => $data['ProductWeight'],
						'product_unit_type' => $data['UnitType'],
						'product_weight_unit' => $data['ProductWeightUnit'],
			//			'product_discount' => $data['ProductDiscount'],
						'product_qty' => $data['ProductQTY'],
						'product_source' => $data['source'],
						'product_stamp' => $data['stamp'],
						'product_nutritional' => $data['ProductNutritional'],
						'how_to_store' => $data['HowtoStore'],
						'product_type' => $data['product_type'],
						'product_tip' => $data['Tip'],
						'product_gst_tax' => $data['gst_tax'],
						'alternate_prroducts' => json_encode($data['alternateproducts']),
						'product_price' => (trim($data['ProductLocation']))
					    );
		$this->db->insert('products', $arr);
        return $this->db->insert_id();
		}
	}
	function updateProduct($data){
		if(!isset($data['alternateproducts'])){
			$data['alternateproducts'] = array();
		}
		if($data['ProductImg']){
		$arr = array(
		                'product_cat_id' => $data['catId'],
		                'product_sub_cat_id' => $data['subCatId'],
						'product_name' => strtolower(trim($data['ProductName'])),
						'product_name_hindi' => strtolower(trim($data['ProductHindiName'])),
			'product_url' => strtolower(str_ireplace(')','-',str_ireplace('(','',str_ireplace('&','-',str_ireplace(' ','-',($data['ProductName'])))))),
			'product_details' => $data['ProductDescription'],
						'product_icon' => $data['ProductImg'],
						'product_actual_img' => $data['ProductImg'],
					//	'product_discount' => $data['ProductDiscount'],
						'product_weight' => $data['ProductWeight'],
						'product_qty' => $data['ProductQTY'],
						'product_source' => $data['source'],
						'product_stamp' => $data['stamp'],
						'product_nutritional' => $data['product_nutritional'],
						'how_to_store' => $data['HowtoStore'],
						'product_tip' => $data['Tip'],
						'product_unit_type' => $data['UnitType'],
						'product_type' => $data['product_type'],
						'product_weight_unit' => $data['ProductWeightUnit'],
						'product_gst_tax' => $data['gst_tax'],
						'product_selected_weight_unit' => ($data['usedunits']),
						'alternate_prroducts' => json_encode($data['alternateproducts']),
						'product_price' => (trim($data['ProductLocation']))
					);
		}else{
			$arr = array(
						'product_cat_id' => $data['catId'],
		                'product_sub_cat_id' => $data['subCatId'],
						'product_name' => strtolower(trim($data['ProductName'])),
						'product_name_hindi' => strtolower(trim($data['ProductHindiName'])),
						'product_url' => strtolower(str_ireplace(')','-',str_ireplace('(','',str_ireplace('&','-',str_ireplace(' ','-',strtolower(trim(($data['ProductName'])))))))),
						'product_details' => $data['ProductDescription'],
					//	'product_discount' => $data['ProductDiscount'],
						'product_weight' => $data['ProductWeight'],
						'product_qty' => $data['ProductQTY'],
						'product_unit_type' => $data['UnitType'],
						'product_weight_unit' => $data['ProductWeightUnit'],
						'product_source' => $data['source'],
						'product_stamp' => $data['stamp'],
						'product_nutritional' => $data['product_nutritional'],
						'how_to_store' => $data['HowtoStore'],
						'product_type' => $data['product_type'],
						'product_gst_tax' => $data['gst_tax'],
						'product_tip' => $data['Tip'],
						'product_selected_weight_unit' => ($data['usedunits']),
						'alternate_prroducts' => json_encode($data['alternateproducts']),
						'product_price' => (trim($data['ProductLocation']))
						);
		}
	//	echo "<pre>"; print_r($arr); die;
		$this->db->where('product_id',$this->input->get('id'));
		$res=$this->db->update('products', $arr);
	//echo $this->db->last_query(); die;
		if($res)
			return true;
		else
			return false;
	}
	function updateRecipe($data){
		if($data['recipe_img']){
		$arr = array(
		                'recipe_kind' => $data['recipe_kind'],
						'recipe_prepare_time' => $data['recipe_prepare_time'],
		                'recipe_product_id' => $data['recipe_product_id'],
						'recipe_name' => strtolower(trim($data['recipe_name'])),
						'recipe_url' => strtolower(str_ireplace(')','-',str_ireplace('(','',str_ireplace('&','-',str_ireplace(' ','-',($data['recipe_name'])))))),
						'recipe_serves' => (trim($data['recipe_serves'])),			
						'recipe_difficulty' => $data['recipe_difficulty'],
'recipe_ingredients_products_id' => json_encode($data['ingredients']),
						'recipe_meal_type' => $data['recipe_meal_type'],
						'recipe_cusine' => $data['recipe_cusine'],
						'recipe_video_url' => $data['recipe_video_url'],
						'recipe_description' => $data['recipe_description'],
						'recipe_steps' => $data['recipe_steps'],
						'recipe_tips' => $data['recipe_tips'],
						'recipe_calories' => $data['recipe_calories'],
						'recipe_other_ingredients' => $data['recipe_other_ingredients'],
						'recipe_img' => $data['recipe_img'],						
					);
		}else{
			$arr = array(
						'recipe_kind' => $data['recipe_kind'],
						'recipe_prepare_time' => $data['recipe_prepare_time'],
		                'recipe_product_id' => $data['recipe_product_id'],
						'recipe_name' => strtolower(trim($data['recipe_name'])),
						'recipe_url' => strtolower(str_ireplace(')','-',str_ireplace('(','',str_ireplace('&','-',str_ireplace(' ','-',($data['recipe_name'])))))),
						'recipe_serves' => (trim($data['recipe_serves'])),			
						'recipe_difficulty' => $data['recipe_difficulty'],
'recipe_ingredients_products_id' => json_encode($data['ingredients']),
						'recipe_meal_type' => $data['recipe_meal_type'],
						'recipe_cusine' => $data['recipe_cusine'],
						'recipe_video_url' => $data['recipe_video_url'],
						'recipe_description' => $data['recipe_description'],
						'recipe_steps' => $data['recipe_steps'],
						'recipe_tips' => $data['recipe_tips'],
						'recipe_calories' => $data['recipe_calories'],
						'recipe_other_ingredients' => $data['recipe_other_ingredients'],
						);
		}
		
		$this->db->where('recipe_id',$this->input->get('recipe_id'));
		$res=$this->db->update('recipes', $arr);
	//echo $this->db->last_query(); die;
		if($res)
			return true;
		else
			return false;
	}
	function ActiveStatus($data) 
	{
			$id = $this->input->get('inactiveStatusId');
			$value = $this->input->get('statusValue');
			$arr = array(			 
				        'status'=>$value
				        );
			  $this->db->where('product_id', $id);
			  $this->db->update('products', $arr);

        return true;
				 
    }
	function ActiveStatusrecipe($data) 
	{
		$id = $this->input->get('inactiveStatusId');
		$value = $this->input->get('statusValue');
		$arr = array(			 
	        'recipe_status'=>$value
	        );
      $this->db->where('recipe_id', $id);
	    $this->db->update('recipes', $arr);
        return true;				 
    }
	function uploadAttachments($data){
		$arr = array(
		                'product_id' => $this->input->get('id'),
						'product_attachment_name' => strtolower(trim($data['Name'])),
						'product_attachment' => $data['image']
					    );
		$this->db->insert('product_attachment', $arr);
        return $this->db->insert_id();
	}
	function delattachment($id){		
	   $this->db->where('id', $id);
	   $this->db->delete('product_attachment'); 
	   return true;
	}
	function getAttachmentsFront($id){
		$this->db->select('*');
			$this->db->from('product_attachment');	
			if($id){
				$this->db->where('product_id',$id);
			}			
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			if ($query->num_rows() > 0) 
			{				
				$row = $query->result();
				return $row;			
			}else			
				return false;
	}
	
	function submitNewRecipe($data){
		$this->db->select('*');
		$this->db->from('ecom_recipes');	
		$this->db->where('recipe_name',strtolower(trim($data['recipe_name'])));	
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() > 0) 
		{				
			return false;			
		}else			{ 
		$arr = array(
		                'recipe_name' => strtolower(trim($data['recipe_name'])),
						'recipe_url' => strtolower(str_ireplace(')','-',str_ireplace('(','',str_ireplace('&','-',str_ireplace(' ','-',($data['recipe_name'])))))),
						
		                'recipe_description' => $data['recipe_description'],
						'recipe_product_id' => $data['recipe_product_id'],
						'recipe_kind' => (trim($data['recipe_kind'])),
	
						'recipe_serves' => $data['recipe_serves'],
						'recipe_prepare_time' => $data['recipe_prepare_time'],
						'recipe_difficulty' => $data['recipe_difficulty'],
						'recipe_ingredients_products_id' => json_encode($data['ingredients']),
						'recipe_steps' => $data['recipe_steps'],
						'recipe_tips' => $data['recipe_tips'],
						'recipe_meal_type' => $data['recipe_meal_type'],
						'recipe_cusine' => $data['recipe_cusine'],
						'recipe_calories' => $data['recipe_calories'],
						'recipe_video_url' => $data['recipe_video_url'],
						'recipe_other_ingredients' => $data['recipe_other_ingredients'],
						'recipe_img' => $data['recipe_img'],
						
					    );
	//	echo "<pre>"; print_r($arr); die;
		$this->db->insert('ecom_recipes', $arr);
        return $this->db->insert_id();
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	  public function submitPaperExcel($data){
	
		$res=$this->db->insert('products',$data);
		return $res;
		
   }
   
}
?>