<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Skillsmodel extends CI_Model

{

	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}
	
	public function getSkills($id=NULL) 
	{    
		$this->db->select('*');
		$this->db->from('holisol_skills  s');	
		$this->db->order_by('s.skill_id', 'desc');
		if($id){
		$this->db->where('s.skill_id', $id);	
		}			
		$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			return $row;			
		}			
		return false;
    }
	public function submitNewSkill($data)
   {
	   $arr = array(
					'skill_name'  => $data['skillName'],
					'skill_parse_name'   => $data['skillParseName']
				  );
				  
		//echo "<pre>"; print_r($arr); die;		  
		$this->db->insert('holisol_skills', $arr);
		return true;
   }
	
   public function updateSkills($id,$data)
   {
	   $arr = array(
					'skill_name'  => $data['skillName'],
					'skill_parse_name'   => $data['skillParseName']
				  );
				  
		//echo "<pre>"; print_r($arr); die;		  
		$this->db->where('skill_id', $id);
		$this->db->update('holisol_skills', $arr);
		return true;
   }
	
	function ActiveStatus($data) 
	{
			$id = $this->input->get('inactiveStatusId');
			$value = $this->input->get('statusValue');
			$arr = array(			 
				        'skill_status'=>$value
				        );
			  $this->db->where('skill_id', $id);
			  $this->db->update('holisol_skills ', $arr);

        return true;
				 
    }
	
	
	
	
	
	
	
	
	
	
	
	
	/* public function getUser()
	{
	 $ProductStatus = $this->input->post('status'); 
            
			$this->db->select('*');
			$this->db->from('user  i');	
			$this->db->join('user_details id','id.id_user = i.id_user');
			if($ProductStatus!=Null)
		{
			$this->db->where('status', $ProductStatus);
		}	
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			return $row;			
		}			
			return false;
    }
	
	
	public function addUser($data)
	{
		
		$query=$this->db->get_where('user ',array('user_name' => $data['emailAddress']));

        if($query->num_rows() > 0)
		{
			redirect(base_url()."admin/User/addUser?msg=emailexits");
        }
		else
		{
			//echo "<pre>"; print_r ($data); die;
		$arr['user'] = array(
		                'user_name' => $data['emailAddress'],
						'password' => md5($data['password']),
						'user_role' => $data['userrole']
					    );
						
		$arr['user_details'] = array( 
		                  'email' => $data['emailAddress'],
		                  'name' => $data['name'],
					      'mobile_no' => $data['mobileno'],
					      'profile_photo_att' => $data['profile_photo_att']
					    );
						//echo "<pre>"; print_r ($arr); die;
			$this->db->insert('user ', $arr['user']);
            $arr['id_user'] = $this->db->insert_id();
            $this->db->set('id_user', $arr['id_user']);
            $res=$this->db->insert('user_details', $arr['user_details']);
		//echo "<pre>"; print_r ($res); die;
		return true;
 
        }
		
	}
	public function updateUser($data)
	{
		$id = $this->input->get('userId');
		//echo $id;die;
	    if($data)
	    {
			$arr['user'] = array(
		                'user_name' => $data['emailAddress'],
					//	'password' => md5($data['password'])
					    
					    );
		    $arr['user_details'] = array( 
		                  'email' => $data['emailAddress'],
		                  'name' => $data['name'],
					      'mobile_no' => $data['mobileno'],
					      'profile_photo_att' => $data['profile_photo_att']
					    );
			$this->db->update('user ', $arr['user'],array('id_user' => $id));
			
			$this->db->update('user_details',$arr['user_details'],array('id_user' => $id));
		    return $arr;
        }
		else{
			return false;
		}
	}
	public function userUpdateWi($data) 
	{
		   $id = $this->input->get('userId');
	    if($data)
	    {
	
			$arr['user'] = array(
		                'user_name' => $data['emailAddress']					    
					    );
		    $arr['user_details'] = array( 
		                  'email' => $data['emailAddress'],
		                  'name' => $data['name'],
					      'mobile_no' => $data['mobileno']
					      
					    );
			$this->db->update('user ', $arr['user'],array('id_user' => $id));
			
			$this->db->update('user_details',$arr['user_details'],array('id_user' => $id));
		    return $arr;
        }
		else
		{
			return false;
		}
	}
	public function getUserId() 
	{
            $id = $this->input->get('UserId'); 
            
			$this->db->select('*');
			$this->db->from('user  i');	
			$this->db->join('user_details id','id.id_user = i.id_user');
			$this->db->where('i.id_user', $id);		
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			return $row;			
		}			
			return false;
    }
	function cancelUserStatus($data) 
	{
			$id = $this->input->get('inactiveStatusId');
			$value = $this->input->get('statusValue');
			$arr = array(			 
				        'status'=>$value
				        );
			  $this->db->where('id_user', $id);
			  $this->db->update('user ', $arr);

        return true;
				 
    } */
	
}
?>