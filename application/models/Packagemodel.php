<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Packagemodel extends CI_Model

{

	public function packageAdd($data)
	{
		//echo "<pre>"; print_r($data); die;
	
		$arr = array(
					'package_name' => mb_strtolower(trim($data['pname'])),
					'package_url' => str_replace('&','',str_replace(',','',str_replace(' ','-',mb_strtolower(trim($data['pname']))))),
					
					'package_image' => $data['PackageImage'],
					'package_price' => $data['price'],
					'package_discount_price' => $data['fproduct'],
					'package_note' => $data['note'],
					'package_instruction' => $data['instruction'],
					'package_description' => $data['description']
					);
					//echo "<pre>";print_r($arr);die;
		$this->db->insert('package',$arr);
		//echo "<pre>"; print_r($this->db->last_query());die;
		return true;
	}
	public function packageAddWithout($data)
	{
		//echo "<pre>"; print_r($data); die;
	
		$arr = array(
					'package_name' => mb_strtolower(trim($data['pname'])),
					'package_url' => str_replace('&','',str_replace(',','',str_replace(' ','-',mb_strtolower(trim($data['pname']))))),					
					'package_price' => $data['price'],
					'package_discount_price' => $data['fproduct'],
					'package_note' => $data['note'],
					'package_instruction' => $data['instruction'],
					'package_description' => $data['description']
					);
					//echo "<pre>";print_r($arr);die;
		$this->db->insert('package',$arr);
		//echo "<pre>"; print_r($this->db->last_query());die;
		return true;
	}
	function cancelPackageStatus($data) 
	{
			$id = $this->input->get('inactiveStatusId');
			$value = $this->input->get('statusValue');
			$arr = array(			 
				        'package_status'=>$value
				        );
			  $this->db->where('id_package', $id);
			  $this->db->update('package', $arr);

        return true;
				 
    }
	public function updatePackage($data)
	{
		$id = $this->input->get('packageId');
		$arr['package'] = 
			array(
				   
					'package_name' => $data['pname'],
					'package_price' => $data['price'],
					'package_discount_price' => $data['fproduct'],
					'package_note' => $data['note'],
					'package_instruction' => $data['instruction'],
					'package_description' => $data['description']
					
			    );
			//	echo "<pre>";print_r($arr);die;
			$this->db->update('package', $arr['package'],array('id_package' => $id));
		    return $arr;
      
	}
	public function packageUpdateWi($data) 
	{
		   $id = $this->input->get('packageId');
	    if($data)
	    {
		    $arr['package'] = array(
		                                
					'package_image' => $data['PackageImage'],
					'package_name' => $data['pname'],
					'package_price' => $data['price'],
					'package_discount_price' => $data['fproduct'],
					'package_note' => $data['note'],
					'package_instruction' => $data['instruction'],
					'package_description' => $data['description']
					);
				//	echo "<pre>";print_r($arr);die;
			    
			$this->db->update('package', $arr['package'],array('id_package' => $id));
		    return $arr;
        }
		else
		{
			return false;
		}
	}
	public function packageAdmin($status=NULL)
	{
		$this->db->select('*');		
		$this->db->from('package');
		if($status){
			$this->db->where('package_status',$status);
		}
			$this->db->order_by('id_package','desc');
		$query=$this->db->get();
		$result=$query->result_array();
		return $result;
		
		
	}
	public function product($id)
	{	//echo "<pre>";print_r($this->session->userdata("city_id"));die;
		$this->db->select('*');
		
		$this->db->from('product ');
		$this->db->join('category','category.category_id=product.category_id');
		//$this->db->join('product_price', 'product_price.product_id=product.product_id');
		//$this->db->where('product_price.city_id', $this->session->userdata("city_id"));
		$this->db->where('parent_id', $id);
		$this->db->where('product_status =', '1');
		$this->db->order_by('(product_price)','asc');
		$query=$this->db->get();
		$result=$query->result();
		//echo "<pre>";print_r($result);die;
		return $result;
		
		
	}
	public function getPackageById() 
	{
			//echo "<pre>";print_r($_REQUEST);die;
			$id = $this->input->get('Id');
			$this->db->select('*');
			$this->db->from('package');	
			//$this->db->join('category id','id.category_id = i.category_id');
			$this->db->where('id_package', $id);		
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			return $row;			
		}			
			return false;
    }
	
	public function getPackageDetail($status,$searchTerm) 
	{
			$this->db->select('*');
			$this->db->from('package');	
			//$this->db->join('category id','id.category_id = i.category_id');
			$this->db->where('package_status', '1');		
			$this->db->where('package_url', $searchTerm);		
			$query = $this->db->get();
			if ($query->num_rows() > 0) 
			{				
				$row = $query->result_array();
				return $row;			
			}			
			return false;
    }
	
	public function getPackageAll() 
	{
		$this->db->select('*');
		$this->db->from('package');
		$this->db->where('package_default', 0);
		$this->db->where('package_status',1);
		$this->db->order_by('(package_price - package_discount_price)','asc');
		$query=$this->db->get();
		$result=$query->result_array();
		//echo "<pre>";print_r($result);die;
		return $result;
	}
	public function productOffer($product_ids)
	{	//echo "<pre>";print_r($this->session->userdata("city_id"));die;
		$this->db->select('*');
		
		$this->db->from('product');
		//$this->db->join('category','category.category_id=product.category_id');
		$this->db->where_in('product_id', $product_ids);
		$this->db->where('product_status =', '1');
		$this->db->order_by('(product_price)','asc');
		$query=$this->db->get();
		$result=$query->result();
		//echo "<pre>";print_r($result);die;
		return $result;
		
		
	}
	public function getAllCategory()
	{	//echo "<pre>";print_r($this->session->userdata("city_id"));die;
		$this->db->select('*');
		$this->db->from('category');
		$this->db->order_by('(category_id)','asc');
		$query=$this->db->get();
		$result=$query->result_array();
		//echo "<pre>";print_r($result);die;
		return $result;
		
		
	}
   public function getCategoryList()
   {
			$this->db->select('category_id,category_name');
			$this->db->from('category');
			$this->db->where('parent_id =','0');
			//$this->db->order_by('display_order', 'asc');
			$query = $this->db->get();
			return $query->result_array();
   }
  public function getSubCategoryList($id)
   {
			$this->db->select('category_id,category_name');
			$this->db->from('category');
			$this->db->where('parent_id !=','0');
			$this->db->where('parent_id',$id);
			$this->db->order_by('category_name', 'asc');
			$query = $this->db->get();
			return $query->result_array();
   }
   public function getProductList($id)
   {
	  // echo '<pre>'; print_r($id); die;
			$this->db->select('*');
			$this->db->from('product');
			$this->db->where('category_id',$id);
			$this->db->where('product_status','1');
			$this->db->order_by('product_price', 'asc');
			$query = $this->db->get();
			$result = $query->result_array();
			//echo '<pre>'; print_r($result); die;
			return $result;
			
   }
	public function getBridalAll() 
	{	
		$arr = array(2, 3);
		$this->db->select('*');
		$this->db->from('package');
		$this->db->where_in('package_default', $arr);
		//$this->db->where('package_category', 'bridal');
		//$this->db->where_or('package_category', 'prebridal');
		$this->db->where('package_status',1);
		//$this->db->limit(3);
		$this->db->order_by('(package_price - package_discount_price)','asc');
		$query=$this->db->get();
		$result=$query->result_array();
		//echo "<pre>";print_r($result);die;
		return $result;
	}   

}

?>