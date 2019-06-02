<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class CityModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}
	public function getCity($status=NULL,$stateId=NULL,$citiesonly=null){
		$this->db->order_by("city_name", "asc");
		if($status){
			$this->db->where('city_status',$status);
		}
		if($stateId){
			$this->db->where('parent_id',$stateId);
		}
		if($citiesonly){
			$this->db->where('parent_id !=','0');
		}
		$query = $this->db->get('city');
		return $query->result_array();
	}
	public function get_cities_bk($cityId=Null){
		$this->db->select('*, c.city_id as cityId, c.city_name as cityName,s.state_name as stateName, cd.delivery_charges as deliveryCharges,cd.delivery_days as deliveryDays');
		$this->db->from('city c');
		$this->db->join('city_detail cd','cd.city_id = c.city_id');
		$this->db->join('city s','s.city_id = c.parent_id');
		$this->db->where('c.parent_id != ','0');
		$this->db->order_by('cd.city_id','asc');
		if($cityId) 
		$this->db->where('c.city_id',$cityId);
		$query = $this->db->get();
		return $query->result();
	}
	public function submitCity($data){
		$query = array(
						'city_name' => ucfirst($data['city_name'])			
					);
		$res=$this->db->insert('city',$query);
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
		$this->db->join('city','city.city_id = feedback.city_id');
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
		$id = $this->input->get('ActiveStatus');
		$value = $this->input->get('statusValue');
		$arr = array(			 
			  'city_status'=>$value			  
			  );
			  $this->db->where('id_city', $id);
			  $this->db->update('city', $arr);
        return true; 
				 
    }
	public function get_cities_bk_price($cityId=Null){
		$this->db->select('*, c.city_id as cityId, c.city_name as cityName,s.state_name as stateName,s.city_id as stateId, cd.delivery_charges as deliveryCharges,cd.delivery_days as deliveryDays');
		$this->db->from('city c');
		$this->db->join('city_detail cd','cd.city_id = c.city_id');
		$this->db->join('city s','s.city_id = c.parent_id');
		$this->db->where('c.parent_id != ','0');
		$this->db->order_by('cd.city_id','asc');
		if($cityId) 
		$this->db->where('c.city_id',$cityId);
		$query = $this->db->get();
		return $query->result();
	}
	public function insertDeliverypriceBycity($data){
		
		$query = array(
						'parent_id' => $data['state'],
						'city_name' => $data['city'],	
						'status' => 1		
					);
		$res=$this->db->insert('city',$query);
		$insertid= $this->db->insert_id();
		if($insertid){
		$query1 = array(
						'city_id' => $insertid,
						'delivery_charges' => $data['deliveryPrice'],
						'delivery_days' => implode(',',($data['deliveryDays'])),				
					);
		$resu=$this->db->insert('city_detail',$query1);
		return true;
		}
		return false;
	}
	public function updateCityDeliveryPrice($data){		
		$query = array(
						//'parent_id' => $data['state'],
						'city_name' => $data['city'],	
						'status' => 1						
					);
		$result1=$this->db->update('city',$query,array('city_id' => $data['id']));
		//print_r($this->db->last_query());die;
		$query1 = array(
						'delivery_charges' => $data['deliveryPrice'],
						'delivery_days' => implode(',',($data['deliveryDays'])),						
					);
		$result2=$this->db->update('city_detail',$query1,array('city_id' => $data['id']));
			return true;
	}
	
			
}
?>