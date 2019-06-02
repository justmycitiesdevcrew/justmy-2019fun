<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Accountsmodel extends CI_Model
{
	
	
public function getSettings(){
		$this->db->select('*');
		$this->db->from('settings');
		$query = $this->db->get();
		if($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			return $row;			
		}else{		
			return false;
		}
	}
	


	public function updatesettinglogo($data){
		
		if($this->input->get('id')){
			$arr = array(
				'company_name'=>$data['company_name'],
				'email'=>$data['email'],
				'website_url'=>$data['website_url'],
				'address'=>$data['address'],
				'city'=>$data['city'],
				'country'=>$data['country'],
				'postcode'=>$data['postcode'],
				'telephone'=>$data['telephone'],
				'regno'=>$data['regno'],
				'vatno'=>$data['vatno'],
				'logo'=>$data['profilePhoto'],
			);
			$this->db->update('settings',$arr,array('id'=>$this->input->get('id')));
		}else{
			$arr = array(
				'company_name'=>$data['company_name'],
				'email'=>$data['email'],
				'website_url'=>$data['website_url'],
				'address'=>$data['address'],
				'city'=>$data['city'],
				'country'=>$data['country'],
				'postcode'=>$data['postcode'],
				'telephone'=>$data['telephone'],
				'regno'=>$data['regno'],
				'vatno'=>$data['vatno'],
				'logo'=>$data['profilePhoto'],
			);
			$this->db->insert('settings',$arr);
		}
	}

	public function updatesetting($data){
		
		if($this->input->get('id')){
			$arr = array(
				'company_name'=>$data['company_name'],
				'email'=>$data['email'],
				'website_url'=>$data['website_url'],
				'address'=>$data['address'],
				'city'=>$data['city'],
				'country'=>$data['country'],
				'postcode'=>$data['postcode'],
				'telephone'=>$data['telephone'],
				'regno'=>$data['regno'],
				'vatno'=>$data['vatno'],
			);
			$this->db->update('settings',$arr,array('id'=>$this->input->get('id')));
		}else{
			$arr = array(
				'company_name'=>$data['company_name'],
				'email'=>$data['email'],
				'website_url'=>$data['website_url'],
				'address'=>$data['address'],
				'city'=>$data['city'],
				'country'=>$data['country'],
				'postcode'=>$data['postcode'],
				'telephone'=>$data['telephone'],
				'regno'=>$data['regno'],
				'vatno'=>$data['vatno'],
			);
			$this->db->insert('settings',$arr);
		}
	}





























	
	
	public function employeeWithOutUpdate($data)
	{
		
	    $id = $this->input->get('Id');

		$query = array(
						
					'employee_name' => $data['name'],
					'department' => $data['title'],
					'employee_mobile_no' => $data['mobile'],
					'employee_email_id' => $data['email'],
						'salary' => $data['salary'],	
					'employee_address' => $data['address']
										
					);
		//echo "<pre>";print_r($query);die;
		$this->db->where('employee_id',$id);
		$this->db->update('employee',$query);
		return true;
		
	}
	public function updateBankDetails($data ,$Flag = NULL){
			
			if(!$Flag){
					$query = array(
					'bank_ifsc_code' => $data['bank_ifsc_code'],
					'bank_account_no' => $data['bank_account_no'],
					'bank_name' => $data['bank_name'],		
							
					);
			
					$this->db->where('employee_id',$this->input->get('Id'));
					$this->db->update('employee_bank_detail',$query);
					return true;
			}else{
					$query = array(
					'bank_ifsc_code' => $data['bank_ifsc_code'],
					'bank_account_no' => $data['bank_account_no'],
					'bank_name' => $data['bank_name'],		
					'employee_id' => $this->input->get('Id'),							
					);
					$this->db->insert('employee_bank_detail',$query);
					return true;
				
			}
	}
	public function addemployeeFormFront($data)
	{
	    //echo "<pre>";print_r($data);die;
		$query = array(
						
						'employee_name' => $data['name'],
						'employee_mobile_no' => $data['mobile'],
						'alternate_mobile' => $data['phone'],
						'employee_email_id' => $data['email'],
						'employee_address' => $data['address'],
						'area_covered'	=> $data['area'],
						'city_id' => $data['city'],
						'employee_age' => date('Y-m-d',strtotime($data['age'])),
						'employee_profile_img' => $data['profilePhoto'],
						'employee_id_proof' => $data['proof'],
						
						'employee_certificate' => $data['certificate'],
						'employee_experience' => $data['exp']
										
					);
					//echo "<pre>";print_r($query);die;
		$this->db->insert('employee',$query);
		//echo "<pre>";print_r($this->db->last_query());die;
		return true;
	}
	public function getemployee($status=NULL,$departmentId=NULL, $employeeId=NULL ,$specialityId=NULL)
	{
	        $city = $this->input->post('cityname');
			
			$this->db->select('*');
			$this->db->from('employee');
		//	$this->db->join('city','city.id_city = employee.city_id');
		//	$this->db->join('category','category.category_id = employee.speciality');
			$this->db->order_by('employee.employee_id', 'desc');
			if($specialityId)
			{
				$this->db->where('category_id', $specialityId);
			}
			if($departmentId)
			{
				$this->db->where('department', $departmentId);
			}
			if($employeeId)
			{
				$this->db->where('employee_id', $employeeId);
			}
			if($status)
			{
				$this->db->where('employee_status', $status);
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
	public function employeeBankDetailsById($empId)
	{
	        $city = $this->input->post('cityname');
			
			$this->db->select('*');
			$this->db->from('employee_bank_detail');
			$this->db->where('employee_id', $empId);
			
			$query = $this->db->get();
			//echo $this->db->last_query(); //die;
			if($query->num_rows() > 0) 
			{				
				$row = $query->result_array();
				return $row[0];			
			}			
				return false;
    }
	
	public function getemployeebyId($id)
	{
			$this->db->select('*');
			$this->db->from('employee');
			$this->db->where('employee_id',$id);
		//	$this->db->join('city','city.id_city = employee.city_id');
			$query = $this->db->get();
			//echo "<pre>";print_r($data['query']);die; 
			if ($query->num_rows() > 0) 
			{				
				$row = $query->result_array();
				return $row;			
			}			
				return false;
    }
	public function verifyemployee($emailId)
	{
			$this->db->select('*');
			$this->db->from('employee');
			$this->db->where('employee_email_id',$emailId);
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
	function cancelemployeeStatus() 
	{
			$id = $this->input->get('inactiveStatusId');
			$value = $this->input->get('statusValue');
			if($id){
			$arr = array(			 
				        'account_status'=>$value
				        );
			  $this->db->where('account_id', $id);
			  $this->db->update('platform_accounts', $arr);
			}
        return true;
				 
    }
	function deleteemployee($id) 
	{
			$tables = array('employee');
			$this->db->where('employee_id',$id);
			$this->db->delete($tables);
			return true;
    }
	public function getAllemployee()
	{
		$this->db->select('*');
		$this->db->from('employee');
		$query = $this->db->get();

		return $query->result();

    }
	public function bridalemployees($cityId= null) {
		$this->db->select('employee_id,employee_name,employee_mobile_no,city_id,employee_profile_img,employee_age,gallery_icon,feedback_msg,rating,per_event_price');
        $this->db->from('employee');
		/*if($cityId){
				$this->db->where("city_id", $cityId);	
		}*/

		$this->db->where("is_providing_bridal", '1');
		$this->db->where("employee_status", '1');
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
			  $this->db->where('employee_id', $data['employeeId']);
			  $this->db->update('employee', $arr);

        return true;
				 
    }	
	//New function for bridal and update Profile
	public function bridalemployeeDetail($id=null) {
		$this->db->select('*');
        $this->db->from('employee');
		$this->db->join('employee_work_gallery','employee_work_gallery.employee_id=employee.employee_id');
		$this->db->where("employee.is_providing_bridal", '1');
		$this->db->where("employee.employee_status", '1');
		if($id){
			$this->db->where("employee.employee_id", $id);	
		}
		$this->db->where("employee_work_gallery.is_default", '1');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}	
	public function employeeFeedback($id) {
		//$this->db->select('*, count(feedback_id) as totalFeedback, sum(rating_id) as totalRating, avg(rating_id) as reviewAvg');
		$this->db->select('*');
        $this->db->from('feedback');
		$this->db->where("fd_state", '1');
		$this->db->where("allocated_employee_id", $id);	
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function addBridalGalleryImg($employeeId=NULL, $imageName=NULL) 
	{	//echo $employeeId;
		//echo $imageName;die;
		if($imageName)
		{
			$query['employee_bridal_work']= array(
					'employee_id'=>$employeeId,
					'image'=>$imageName,
					'is_default'=>'1',
					'status'=>'0'
				);
			$this->db->insert('employee_work_gallery', $query['employee_bridal_work']);
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
		   if(!empty($_FILES['employee_profile_img']['name']))
		    {
		        $query = array(
						'employee_profile_img' => $data['profilePhoto'],
						'employee_name' => $data['name'],
						'employee_mobile_no' => $data['mobile'],
						'employee_experience' => $data['exp'],
						'aboutyourself' => $data['aboutyourself'],
						'discriptionyourself' => $data['discription']
					);
			}
			else{
				$query = array(
						'employee_name' => $data['name'],
						'employee_mobile_no' => $data['mobile'],
						'employee_experience' => $data['exp'],
						'aboutyourself' => $data['aboutyourself'],
						'discriptionyourself' => $data['discription']
					);
			}
					$this->db->where('employee_id',$data['employeeId']);
					$this->db->update('employee',$query);
					return true;
        }
		else{
			
			return false;
		}
	}	
	public function getemployeeDetailbyId($id)
	{	
			$this->db->select('*');
			$this->db->from('employee');
			$this->db->where('employee_id',$id);
			$this->db->join('city','city.id_city = employee.city_id');
			$query = $this->db->get();
			echo "<pre>";print_r($data['query']);die; 
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			return $row;			
		}			
			return false;
    }
	public function getemployeeBridalWork($id)
	{	
			$this->db->select('*');
			$this->db->from('employee_work_gallery');
			$this->db->where('employee_id',$id);
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
			$tables = array('employee_work_gallery');
			$this->db->where('work_gallery_id',$id);
			$this->db->delete($tables);
			return true;
    }	
}
?>