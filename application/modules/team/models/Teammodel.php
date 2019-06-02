<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Teammodel extends CI_Model{

	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}
	
	public function getTeam($status=NULL,$name=NULL)
	{
			$this->db->select('*');
			$this->db->from('team');	
			if($status){
				$this->db->where('status','1');
			}
			if($name){
				$this->db->where('member_name',$name);
			} 
				$this->db->order_by('id','desc');
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
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
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			return $row;			
		}else			
			return false;
	}
	function insertMember($data){
		$arr = array(
		                'member_name' => $data['name'],
						'member_designation' => $data['designation'],
						'about' => $data['about'],
						'email' => $data['email'],
						'twitter' => $data['twitter'],
						'facebook' => $data['facebook'],
						'member_img' => $data['memberImg']
					    );
		$this->db->insert('team', $arr);
        return $this->db->insert_id();
	}
	function updateMember($data){
		if($data['memberImg']){
		$arr = array(
		                'member_name' => $data['name'],
						'member_designation' => $data['designation'],
						'about' => $data['about'],
						'email' => $data['email'],
						'member_img' => $data['memberImg'],
						'twitter' => $data['twitter'],
						'facebook' => $data['facebook']
					);
		}else{
			$arr = array(
		                'member_name' => $data['name'],
						'member_designation' => $data['designation'],
						'about' => $data['about'],
						'email' => $data['email'],
						'twitter' => $data['twitter'],
						'facebook' => $data['facebook']
						);
		}
		
		$this->db->where('id',$this->input->get('id'));
		$res=$this->db->update('team', $arr);
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
			  $this->db->where('id', $id);
			  $this->db->update('team ', $arr);

        return true;
				 
    }
	
	
}
?>