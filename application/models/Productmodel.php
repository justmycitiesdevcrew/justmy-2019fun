<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends CI_Model

{

	public function productAdd($data)
	{
	    
		$query['product'] = array(
										'product_note' => $data['note'],
										'product_instruction' => $data['instruction'],
										'product_name' => ucfirst($data['pname']),
										'product_image' => $data['productphoto'],
										'product_price' => $data['pprice'],
										'description' => $data['description'],
										'product_discount_price' => $data['discountprice']
									   );
		
		$this->db->insert('product',$query['product']);
		return $query;
		
	}public function productAddWithOut($data)
	{
	    
		$query['product'] = array(
										'product_note' => $data['note'],
										'product_instruction' => $data['instruction'],
										'product_name' => ucfirst($data['pname']),
										'product_price' => $data['pprice'],
										'description' => $data['description'],
										'product_discount_price' => $data['discountprice']
									   );
		
		$this->db->insert('product',$query['product']);
		return $query;
		
	}
		public function addNewSubCategory($data)
	{
		if($data['SubCategoryImage']){
			$query['category'] = array(
		                                'parent_id' => $data['categoryName'],
										'category_name' => $data['SubCategoryName'],
										'category_icon_img' => $data['SubCategoryImage']
										 );
		}
		else
		{
		$query['category'] = array(
		                                'parent_id' => $data['categoryName'],
										'category_name' => $data['SubCategoryName']
										
										 );
		}
		$this->db->insert('category',$query['category']);
		return $query;
		
	}

	public function updateProduct($data)
	{
		$id = $this->input->get('productId');
		//echo "<pre>"; print_r($data); die;
	    if(!empty($data) && $data != NULL && ($data['pname'] != NULL && !empty($data['pname'])))
	    {
			$arr['product'] = array(
										'product_name' => $data['pname'],
										'product_image' => $data['productphoto'],
										'product_price' => $data['pprice'],
										'product_instruction' => $data['instruction'],
										'product_note' => $data['note'],
										'description' => $data['description'],
										'product_discount_price' => $data['discountprice']
			                           );
			$this->db->update('product', $arr['product'],array('product_id' => $id));
		    return $arr;
        }
		else
		{
			return false;
		}
	}public function updateProductWithOut($data)
	{
		$id = $this->input->get('productId');
		//echo "<pre>"; print_r($data); die;
	    if(!empty($data) && $data != NULL && ($data['pname'] != NULL && !empty($data['pname'])))
	    {
			$arr['product'] = array(
										'product_name' => $data['pname'],									
										'product_price' => $data['pprice'],
										'product_instruction' => $data['instruction'],
										'product_note' => $data['note'],
										'description' => $data['description'],
										'product_discount_price' => $data['discountprice']
			                           );
			$this->db->update('product', $arr['product'],array('product_id' => $id));
		    return $arr;
        }
		else
		{
			return false;
		}
	}
	public function productUpdateWi($data) 
	{
		   $id = $this->input->get('productId');
		   //echo "<pre>"; print_r($data); die;
	    if(!empty($data) && $data != NULL && ($data['pname'] != NULL && !empty($data['pname'])))
	    {
		    $arr['product'] = array(
										'product_name' => $data['pname'],
										'product_price' => $data['pprice'],
										'product_instruction' => $data['instruction'],
										'product_note' => $data['note'],
										'description' => $data['description'],
										'product_discount_price' => $data['discountprice']
			                            );
			$this->db->update('product', $arr['product'],array('product_id' => $id));
		    return $arr;
        }
		else
		{
			return false;
		}
	}
	
	public function getProductItem($status=NULL)
	{ 
			$this->db->select('*');
			$this->db->from('product');
			if($status){
				$this->db->where('product_status',$status);
			}
				$this->db->order_by('product_name','asc');
			$query = $this->db->get();
			return $query->result_array();
    }
	public function getProductById() 
	{
		//	echo "<pre>";print_r( $this->input->get('productId'));die;
			$id = $this->input->get('productId');
			$this->db->select('*');
			$this->db->from('product');
			$this->db->where('product_id', $id);		
			$query = $this->db->get();	
			//echo $this->db->last_query(); die;	
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			return $row;			
		}			
			return false;
    }
	
	public function getCategoryList()
	{
			$this->db->select('category_id,category_name');
			$this->db->from('category');
			$this->db->where('parent_id !=','0');
			$this->db->order_by('category_name', 'asc');
			$query = $this->db->get();
			return $query->result();
    }
		public function getCategorysList()
	{
			$this->db->select('category_id,category_name');
			$this->db->from('category');
			$this->db->where('parent_id =','0');
			$this->db->order_by('category_name', 'asc');
			$query = $this->db->get();
			return $query->result();
    }

	function cancelProductStatus($data) 
	{
			$id = $this->input->get('inactiveStatusId');
			$value = $this->input->get('statusValue');
			$arr = array(			 
				        'product_status'=>$value
				        );
			  $this->db->where('product_id', $id);
			  $this->db->update('product', $arr);

        return true;
				 
    }
	function deleteProduct($id) 
	{
			$tables = array('product');
			$this->db->where('product_id',$id);
			$this->db->delete($tables);
			return true;
    }
}