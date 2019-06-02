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
		$this->db->from('blog_category');	
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
	    $this->db->from('blog_category');
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
		$this->db->from('blog_category');
        $this->db->where('cat_id', $id);
	    $query = $this->db->get();
		return $query->result_array();
		
		}
	function getCategoryById($id) 
	{
		//echo "<pre>";print_r($id);die;
		
		$this->db->select('*');
        $this->db->from('blog_category');	
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
						'cat_name'=> strtolower(trim($data['category'])),
						'blog_category_icon'=>$data['logoIcon'],
						'blog_cat_url'=> makeseofriendlyurl(strtolower(trim($data['category']))),
					  ); 
			$this->db->where('cat_id', $this->input->get('categoryId'));
			$result1=$this->db->update('blog_category',$query);
		 	return true;
	} 
	function ActiveStatus($data) 
	{
			$id = $this->input->get('inactiveStatusId');
			$value = $this->input->get('statusValue');
			$arr = array(			 
				        'cat_status'=>$value
				        );
			  $this->db->where('cat_id', $id);
			  $this->db->update('blog_category', $arr);

        return true;
				 
    }	
	function addCategory($data=NULL)
	{	
		
		
			$arr = array(
					'market'=> strtolower(trim($data['category'])),
					'blog_category_icon'=>$data['logoIcon'],
					'blog_cat_url'=> makeseofriendlyurl(strtolower(trim($data['category']))), 
				);
			$this->db->insert('blog_category', $arr); 
			return true;;
		}
	
	 
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