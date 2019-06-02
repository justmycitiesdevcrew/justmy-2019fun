<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Healthqueriesmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}
	public function getHealthQueriesList($status=NULL,$id=NULL){		
		$this->db->order_by("title", "asc");
		if($status){
			$this->db->where("status", $status);
		}if($id){
			$this->db->where("id", $id);
		}
		$query = $this->db->get('health_queries');
		return $query->result_array();
	}
	public function submitquery($data){
		$query = array(
			'title' => ucfirst($data['query']),	
			'description' => ucfirst($data['description'])
		);
		$res=$this->db->insert('health_queries',$query);
		return $res;
	}
	public function updateQuery($data){
		$query = array(
			'title' => ucfirst($data['query']),	
			'description' => ucfirst($data['description'])
		);
		$this->db->where('id',$this->input->get('Id'));
		$res=$this->db->update('health_queries',$query);
		return $res;
	}
	public function getCityName($id) 
	{		
		if(!empty($id)) {	
		$query  = $this->db->select('city_name')		
		->from('city')				
		->where('id_city',$id)	
		->get();		
		if($query->num_rows()>0) {	
		$result = $query->row();	
		return $result->city_name;		
		}	
		}		
	}
	public function getCustomerFeedback() 
	{
		$this->db->where('fd_state','1');
		$this->db->order_by('feedback_id','desc');
		$query = $this->db->get('feedback');
		return $query->result_array();
	}
	public function getManageFeedback() 
	{
		$this->db->select('*');
		$this->db->from('feedback');
		$this->db->order_by('feedback_id','desc');
		$query = $this->db->get();
	   // echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	
	public function addFeedbackClient($data)
	{
		//echo "<pre>";print_r($query);die;
		$query = array(
				'customer_order_id' => $data['orderId'],
				'allocated_beautician_id' => $data['beauticianId'],
		        'customer_name' => $data['name'],
		        'email_id' => $data['email'],
		        'moblie_no' => $data['phone'],
		        'city_id' => $data['city'],
				'rating_id' => $data['rating'],
		        'message' => $data['message'],
		        'fd_state' => '0',
		        'created_date' => date('Y-m-d')
		);
		//echo "<pre>";print_r($query);die;
		$this->db->insert('feedback',$query);
		//echo "<pre>";print_r($this->db->last_query());die;
		return $query;
	}
	function cancelFeedbackStatus($data){
		$id = $this->input->get('inactiveStatusId');
		$value = $this->input->get('statusValue');
		$arr = array(			 
			  'fd_state'=>$value
			  
			  );		  
			  $this->db->where('feedback_id', $id);
			  $this->db->update('feedback', $arr);

        return true;
				 
    }
	public function getCustomerFeedbackByCityName($cityId) 
	{
		$this->db->where('fd_state','1');
		$this->db->where('city_id',$cityId);
		$this->db->order_by('feedback_id','desc');
		$query = $this->db->get('feedback');
		return $query->result_array();
	}
	public function addMoreCity($data)
	{ 
		$arr = array(
				'city_name' => $data['cityname']
				);
		$result1 = $this->db->insert('more_city', $arr);
		return true;
		
	}
	
	function ActiveStatus() 
	
	{
		$id = $this->input->get('inactiveStatusId');
		$value = $this->input->get('statusValue');
		$arr = array(			 
			  'status'=>$value			  
			  );
			  $this->db->where('id', $id);
			  $this->db->update('health_queries', $arr);
			 // echo $this->db->last_query(); die;
        return true;
				 
    }
	function ActiveStatusFaq() 
	
	{
		$id = $this->input->get('inactiveStatusId');
		$value = $this->input->get('statusValue');
		$arr = array(			 
			  'faq_status'=>$value			  
			  );
			  $this->db->where('faq_id', $id);
			  $this->db->update('faq', $arr);
			 // echo $this->db->last_query(); die;
        return true;
				 
    }
	function categoryActiveStatus() 
	
	{
		$id = $this->input->get('inactiveStatusId');
		$value = $this->input->get('statusValue');
		$arr = array(			 
			  'help_status'=>$value			  
			  );
			  $this->db->where('help_id', $id);
			  $this->db->update('help', $arr);
			 // echo $this->db->last_query(); die;
        return true;
				 
    }
	public function getFAQList($status=NULL,$id=NULL){		
		$this->db->order_by("faq_title", "asc");
		if($status){
			$this->db->where("faq_status", $status);
		}if($id){
			$this->db->where("faq_id", $id);
		}
		$query = $this->db->get('faq');
		return $query->result_array();
	}
	public function getHelpList($status=NULL,$id=NULL){		
		$this->db->order_by("help_title", "asc");
		if($status){
			$this->db->where("help_status", $status);
		}if($id){
			$this->db->where("help_id", $id);
		}
		$query = $this->db->get('help');
		//echo "<pre>"; print_r($this->db->last_query()); die;
		return $query->result_array();
	}
	public function submitFaq($data){
		$query = array(
			'faq_title' => ucfirst($data['query']),	
			'faq_description' => ucfirst($data['description'])
		);
		$res=$this->db->insert('faq',$query);
		return $res;
	}
	public function submithelp($data){
		$query = array(
			'help_title' => ucfirst($data['help_title']),	
			'help_description' => ucfirst($data['help_description'])
		);
		$res=$this->db->insert('help',$query);
		return $res;
	}
	public function updateFaq($data){
		$query = array(
			'faq_title' => ucfirst($data['query']),	
			'faq_description' => ucfirst($data['description'])
		);
		$this->db->where('faq_id',$this->input->get('Id'));
		$res=$this->db->update('faq',$query);
		return $res;
	}
	public function updateHelp($data){
		$query = array(
			'help_title' => ucfirst($data['help_title']),	
			'help_description' => ucfirst($data['help_description'])
		);
		$this->db->where('help_id',$this->input->get('Id'));
		$res=$this->db->update('help',$query);
		return $res;
	}
	public function getConsultQueryList($queryId=NULL,$doctorId=NULL){
		$this->db->select('*');
		$this->db->from('query q');
		$this->db->join('customer c','c.id_customer=q.customer_id');
		$this->db->join('doctor d','d.doctor_id=q.doctor_id');
		$this->db->join('category cat','cat.category_id=q.category_id');
		$this->db->join('global_appointment_status status','status.id_appointment_status=q.query_status_id');
		if($queryId){
			
			$this->db->where('query_id',$queryId);
		}if($doctorId){
			
			$this->db->where('query_id',$queryId);
		}
		$this->db->order_by('q.query_id','desc');
		$query = $this->db->get();
	   // echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function submitConsultQuery($data){
		$query = array(
			'customer_id' => $this->session->userdata('login_customer_id'),	
			'category_id' => $this->session->userdata('user_category_id'),
			'query' => $this->session->userdata('user_quey'),
			'doctor_id' => $this->session->userdata('user_doctor_id')
		);
		$res=$this->db->insert('query',$query);
		return $res;
	}
			
}
?>