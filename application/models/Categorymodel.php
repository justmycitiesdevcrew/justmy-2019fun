<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Categorymodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function getCategoryList($id=NULL,$parent_id=NULL)
   {
			$this->db->select('*');
			$this->db->from('category');
			$this->db->where('parent_id',$parent_id);
			if($id){
				$this->db->where('category_id',$id);
			}
			$this->db->order_by('category_name', 'asc');
			$query = $this->db->get();
			return $query->result();
   }
   public function getSubCategoryList($id=NULL,$parent_id=NULL, $serachTerm=NULL)
   {
			$this->db->select('c.symptoms,c.medical_condition,c.status,c.category_content, c.category_id, c.category_name speciality_name,cp.category_name department_name');
			$this->db->from('category c');
			$this->db->join('category cp','c.parent_id = cp.category_id');
			$this->db->where('c.parent_id !=',0);
			if($id){
				$this->db->where('c.category_id',$id);
			}
			if($serachTerm){
				$this->db->like(array('c.symptoms' => $serachTerm));
				$this->db->or_like(array('c.medical_condition' => $serachTerm));
				$this->db->or_like(array('c.category_name' => $serachTerm));
			}
			$this->db->order_by('c.category_name', 'asc');
			$query = $this->db->get();
			//echo  $this->db->last_query(); die;
			return $query->result();
   }
   public function submitCategory($data){
	   	$query = array(
						'parent_id' => 0,
						'category_name' => $data['category_name'],
						'category_content' => $data['category_content']				
					);
		$res=$this->db->insert('category',$query);
		//echo $this->db->last_query(); die;
		return $res;
		
   }
   public function submitSubCategory($data){
	   	$query = array(
						'parent_id' => $this->input->get('Id'),
						'category_name' => $data['category_name'],
						'symptoms' => $data['symptoms'],
						'medical_condition' => $data['medical_condition'],
						'category_content' => $data['category_content']				
					);
		$res=$this->db->insert('category',$query);
		return $res;
		
   }
   
	function updateCategory($data) 	
	{
		$arr = array(
					'category_name' => $data['category_name'],
					'category_content' => $data['category_content']					  
			  );
			  $this->db->where('category_id', $this->input->get('Id'));
			  $this->db->update('category', $arr);
        return true;
				 
    }
	function updateSubCategory($data) 	
	{
		$arr = array(
					'category_name' => $data['category_name'],
						'symptoms' => $data['symptoms'],
						'medical_condition' => $data['medical_condition'],
					'category_content' => $data['category_content']					  
			  );
			  $this->db->where('category_id', $this->input->get('Id'));
			  $this->db->update('category', $arr);
        return true;
				 
    }
	function categoryActiveStatus() 
	
	{
		$id = $this->input->get('categoryActiveStatus');
		$value = $this->input->get('statusValue');
		$arr = array(			 
			  'status'=>$value			  
			  );
			  $this->db->where('category_id', $id);
			  $this->db->update('category', $arr);
        return true;
				 
    }
}
?>