<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categoriesmodel extends CI_Model

{

	public function __construct()

	{

		parent::__construct();

		$this->load->database(); 

	}
	

	function getCategories($status=NULL){
		$this->db->select('*');
		$this->db->from('categories');	
		$this->db->where('parent_id','0');
		if($status){
			$this->db->where("cat_status", $status);
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
	public function getSelectCategory(){
	$type = $this->input->post('cat-id');
	    $this->db->select('*');
	    $this->db->from('categories');
		if($type!=Null)
		{
        $this->db->where('cat_name', $type);
		}
	    $query = $this->db->get();
	    return $query->result_array();
		
		}
	public function getsubCategory($id){
		//echo "<pre>";print_r($id);die;
		$this->db->select('*');
		$this->db->from('categories');
        $this->db->where('cat_id', $id);
	    $query = $this->db->get();
		return $query->result_array();
		
		}
	function getCategoryById($id) 
	{
		//echo "<pre>";print_r($id);die;
		
		$this->db->select('*');
        $this->db->from('categories');	
        $this->db->where('cat_id', $id);		
		$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			//echo "<pre>";print_r($row);die;
			return $row;
					
		}			
			return false;
    }
	
	 public function categoryUpdate($data)
	{
		 $query = array(
						'cat_name'=> strtolower($data['category']),
					  );
					 // echo "<pre>"; print_r($query); die;
			$result1=$this->db->update('categories',$query);
			return true;
	}
	/* public function categoryUpdatewithLogo($data)
	{
		 $updateQues=array(
					'cat_name'=>$data['category'],
					'category_banner'=> $data['profilePhoto'],
					); 
		$result1=$this->db->update('categories',$updateQues,array('id' => $this->input->get('categoryId')));
		return true;
	}*/
	function ActiveStatus($data) 
	{
			$id = $this->input->get('inactiveStatusId');
			$value = $this->input->get('statusValue');
			$arr = array(			 
				        'cat_status'=>$value
				        );
			  $this->db->where('cat_id', $id);
			  $this->db->update('categories', $arr);

        return true;
				 
    }	
	function addCategory($data=NULL)
	{	
		
		
			$arr = array(
					'cat_name'=> strtolower($data['category']),
					//'category_banner'=> $data['profilePhoto'],
				);
			$this->db->insert('categories', $arr);
			//$customerId = $this->db->insert_id();
		//	print_r($this->db->last_query());		
			return true;;
		}
	
		
	/*function addSubCategory($data=NULL)
	{	$categoryId = $this->input->get('categoryId');
		$pageId = $this->checkSub(strtolower($data['category']),$categoryId);
		if(!$pageId){
			$arr = array(
					'cat_name'=> strtolower($data['category']),
					'category_banner'=> $data['profilePhoto'],
					'parent_id'=> $categoryId,
				);
			$this->db->insert('categories', $arr);
			$customerId = $this->db->insert_id();
		//	print_r($this->db->last_query());		
			return $customerId;
		}else{
			return false;
		}
	
	}*/
	
	function checkMobileNo($mobileNo) 
	{
		$query = $this->db->get_where('categories', array('cat_name' => $mobileNo));
		if($query->result()){
			return true;
		}else{
			return false;
		}
		
	}
	function checkSub($name,$parent_id) 
	{
		$query = $this->db->get_where('categories', array('cat_name' => $name,'parent_id' => $parent_id,));
		if($query->result()){
			return true;
		}else{
			return false;
		}
		
	}
}

?>