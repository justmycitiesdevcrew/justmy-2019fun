<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Doctormodel extends CI_Model

{

	public function doctorAdd($data)
	{
	    if($data['password']){
			$this->db->insert('doctor',$data);
			return true;
		}
		$query = array(
						'doctor_name' => $data['name'],
						'department' => $data['department'],
						'speciality' => $data['speciality'],
						'doctor_mobile_no' => $data['mobile'],
						'alternate_mobile' => $data['altmobile'],
						'doctor_email_id' => $data['email'],
						'doctor_address' => $data['address'],		
						'city_id' => $data['city'],
						'doctor_profile_img' => $data['profilePhoto']			
					);
		$this->db->insert('doctor',$query);
		//echo $result;
		//echo $this->db->last_query();
	//		die;
		return true;
		
	}
	
	public function doctorUpdate($data)
	{
		//echo "<pre>";print_r($data);die;
	    $id = $this->input->get('Id');
		
		if($data)
		{
		   if(!empty($_FILES['doctor_profile_img']['name']))
		    {
		        $query = array(
						'doctor_name' => $data['name'],
						'department' => $data['department'],
						'speciality' => $data['speciality'],
						'doctor_mobile_no' => $data['mobile'],
						'doctor_title' => $data['title'],
						'alternate_mobile' => $data['altmobile'],
						'doctor_email_id' => $data['email'],
						'doctor_address' => $data['address'],		
						'city_id' => $data['city'],
						'doctor_profile_img' => $data['profilePhoto']			
										
					);
			}
					$this->db->where('doctor_id',$id);
					$this->db->update('doctor',$query);
					return true;
        }
		else{
			return false;
		}
	}
	public function doctorWithOutUpdate($data)
	{
		
	    $id = $this->input->get('Id');

		$query = array(
						
					'doctor_name' => $data['name'],
					'department' => $data['department'],
					'speciality' => $data['speciality'],
					'doctor_mobile_no' => $data['mobile'],
					'doctor_title' => $data['title'],
					'alternate_mobile' => $data['altmobile'],
					'doctor_email_id' => $data['email'],
					'doctor_address' => $data['address'],		
					'city_id' => $data['city']
										
					);
		//echo "<pre>";print_r($query);die;
		$this->db->where('doctor_id',$id);
		$this->db->update('doctor',$query);
		return true;
		
	}
	
	public function adddoctorFormFront($data)
	{
	    //echo "<pre>";print_r($data);die;
		$query = array(
						
						'doctor_name' => $data['name'],
						'doctor_mobile_no' => $data['mobile'],
						'alternate_mobile' => $data['phone'],
						'doctor_email_id' => $data['email'],
						'doctor_address' => $data['address'],
						'area_covered'	=> $data['area'],
						'city_id' => $data['city'],
						'doctor_age' => date('Y-m-d',strtotime($data['age'])),
						'doctor_profile_img' => $data['profilePhoto'],
						'doctor_id_proof' => $data['proof'],
						
						'doctor_certificate' => $data['certificate'],
						'doctor_experience' => $data['exp']
										
					);
					//echo "<pre>";print_r($query);die;
		$this->db->insert('doctor',$query);
		//echo "<pre>";print_r($this->db->last_query());die;
		return true;
	}
	public function getdoctor($status=NULL,$departmentId=NULL, $doctorId=NULL ,$specialityId=NULL)
	{
	        $city = $this->input->post('cityname');
			
			$this->db->select('*,category.category_name as speciality_name');
			$this->db->from('doctor');
			$this->db->join('city','city.id_city = doctor.city_id');
			$this->db->join('category','category.category_id = doctor.speciality');
			$this->db->order_by('doctor.doctor_id', 'desc');
			if($specialityId)
			{
				$this->db->where('category_id', $specialityId);
			}
			if($departmentId)
			{
				$this->db->where('department', $departmentId);
			}
			if($doctorId)
			{
				$this->db->where('doctor_id', $doctorId);
			}
			if($status)
			{
				$this->db->where('doctor_status', $status);
			}
			if($city!=NULL)
			{
				$this->db->where('city_name', $city);
			}
			$query = $this->db->get();
			//echo $this->db->last_query(); //die;
			if($query->num_rows() > 0) 
			{				
				$row = $query->result_array();
				return $row;			
			}			
				return false;
    }
	
	public function getdoctorbyId($id)
	{
			$this->db->select('*');
			$this->db->from('doctor');
			$this->db->where('doctor_id',$id);
			$this->db->join('city','city.id_city = doctor.city_id');
			$query = $this->db->get();
			//echo "<pre>";print_r($data['query']);die; 
			if ($query->num_rows() > 0) 
			{				
				$row = $query->result_array();
				return $row;			
			}			
				return false;
    }
	public function verifyDoctor($emailId)
	{
			$this->db->select('*');
			$this->db->from('doctor');
			$this->db->where('doctor_email_id',$emailId);
			$query = $this->db->get(); 
			
		//	echo "<pre>";print_r($this->db->last_query());die;
			if ($query->num_rows() > 0) 
			{				
				$row = $query->result_array();
				
				return $row;			
			}		else{	
			
				return false;
			}
    }
	function canceldoctorStatus() 
	{
			$id = $this->input->get('inactiveStatusId');
			$value = $this->input->get('statusValue');
			if($id){
			$arr = array(			 
				        'doctor_status'=>$value
				        );
			  $this->db->where('doctor_id', $id);
			  $this->db->update('doctor', $arr);
			}
        return true;
				 
    }
	function deletedoctor($id) 
	{
			$tables = array('doctor');
			$this->db->where('doctor_id',$id);
			$this->db->delete($tables);
			return true;
    }
	public function getAlldoctor()
	{
		$this->db->select('*');
		$this->db->from('doctor');
		$query = $this->db->get();

		return $query->result();

    }
	public function bridaldoctors($cityId= null) {
		$this->db->select('doctor_id,doctor_name,doctor_mobile_no,city_id,doctor_profile_img,doctor_age,gallery_icon,feedback_msg,rating,per_event_price');
        $this->db->from('doctor');
		/*if($cityId){
				$this->db->where("city_id", $cityId);	
		}*/

		$this->db->where("is_providing_bridal", '1');
		$this->db->where("doctor_status", '1');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	function updateFeedbackClient($data) 
	{
			$arr = array(			 
				        'rating'=>$data['rating'],
				        'feedback_msg'=>$data['message']
				        );
			  $this->db->where('doctor_id', $data['doctorId']);
			  $this->db->update('doctor', $arr);

        return true;
				 
    }	
	//New function for bridal and update Profile
	public function bridaldoctorDetail($id=null) {
		$this->db->select('*');
        $this->db->from('doctor');
		$this->db->join('doctor_work_gallery','doctor_work_gallery.doctor_id=doctor.doctor_id');
		$this->db->where("doctor.is_providing_bridal", '1');
		$this->db->where("doctor.doctor_status", '1');
		if($id){
			$this->db->where("doctor.doctor_id", $id);	
		}
		$this->db->where("doctor_work_gallery.is_default", '1');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}	
	public function doctorFeedback($id) {
		//$this->db->select('*, count(feedback_id) as totalFeedback, sum(rating_id) as totalRating, avg(rating_id) as reviewAvg');
		$this->db->select('*');
        $this->db->from('feedback');
		$this->db->where("fd_state", '1');
		$this->db->where("allocated_doctor_id", $id);	
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function addBridalGalleryImg($doctorId=NULL, $imageName=NULL) 
	{	//echo $doctorId;
		//echo $imageName;die;
		if($imageName)
		{
			$query['doctor_bridal_work']= array(
					'doctor_id'=>$doctorId,
					'image'=>$imageName,
					'is_default'=>'1',
					'status'=>'0'
				);
			$this->db->insert('doctor_work_gallery', $query['doctor_bridal_work']);
			return TRUE;
		}
		else{
			return false;
		}
	}
	public function updateProfileImage($data)
	{
		//echo print_r($data);die;
		if($data)
		{
		   if(!empty($_FILES['doctor_profile_img']['name']))
		    {
		        $query = array(
						'doctor_profile_img' => $data['profilePhoto'],
						'doctor_name' => $data['name'],
						'doctor_mobile_no' => $data['mobile'],
						'doctor_experience' => $data['exp'],
						'aboutyourself' => $data['aboutyourself'],
						'discriptionyourself' => $data['discription']
					);
			}
			else{
				$query = array(
						'doctor_name' => $data['name'],
						'doctor_mobile_no' => $data['mobile'],
						'doctor_experience' => $data['exp'],
						'aboutyourself' => $data['aboutyourself'],
						'discriptionyourself' => $data['discription']
					);
			}
					$this->db->where('doctor_id',$data['doctorId']);
					$this->db->update('doctor',$query);
					return true;
        }
		else{
			
			return false;
		}
	}	
	public function getdoctorDetailbyId($id)
	{	
			$this->db->select('*');
			$this->db->from('doctor');
			$this->db->where('doctor_id',$id);
			$this->db->join('city','city.id_city = doctor.city_id');
			$query = $this->db->get();
			//echo "<pre>";print_r($data['query']);die; 
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			return $row;			
		}			
			return false;
    }
	public function getdoctorBridalWork($id)
	{	
			$this->db->select('*');
			$this->db->from('doctor_work_gallery');
			$this->db->where('doctor_id',$id);
			$query = $this->db->get();
			//echo "<pre>";print_r($data['query']);die; 
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			return $row;			
		}			
			return false;
    }
	public function deleteBridalImagesbyId($id)
	{	
			$tables = array('doctor_work_gallery');
			$this->db->where('work_gallery_id',$id);
			$this->db->delete($tables);
			return true;
    }	
}
?>