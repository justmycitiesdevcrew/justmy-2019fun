<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class CustomerModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function getCustomer($customerId=NULL,$city = NULL){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->order_by("id_customer", "desc");
		$this->db->join('city','customer.city_id=city.id_city');
		if($customerId){
			$this->db->where('id_customer',$customerId);
		}
		if($city){
			$this->db->where('city_id',$city);
		}
		$query = $this->db->get();
//	echo "<pre>";print_r($this->db->last_query());die;
	
		return $query->result_array();

	} 
	function getCustomerSubscriptionDetails($id){
		$this->db->select('*');
		$this->db->from('subscription_order so');
		//$this->db->join('subscription s','so.subscription_id =s.subscription_id');
		$this->db->where('so.sub_order_id',$id);	
		$query = $this->db->get();
		return $query->result_array();
	} 
	public function getCustomerby_id($customerId=NULL)
	{
		$id=$this->input->get('Id');
		//echo "<pre>";print_r($id);die;
		$this->db->select('*');
		$this->db->from('customer hc');
		//$this->db->where('id_customer',$id);
		$this->db->join('city hci','hc.city_id=hci.id_city');
		if($id){
			$this->db->where('id_customer',$id);
		}
		
		$query = $this->db->get();		
		
		//echo $this->db->_error_message();die;
		return $query->result_array();
	}
	public function getCustomerbyByIdFrontend($id)
	{
		
		//echo "<pre>";print_r($id);die;
		$this->db->select('*');
		$this->db->from('appointment ap');
		
		$this->db->order_by("id_appointment", "desc");
	    $this->db->join('appointment_detail det','ap.id_appointment=det.appointment_id','left');
		$this->db->join('customer cu','ap.customer_id=cu.id_customer','left');
		$this->db->join('appointment_status as','ap.appointment_status_id=as.id_appointment_status','left');
		$this->db->where('ap.id_appointment',$id);
		
		$query = $this->db->get();
		//echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	function getNewCustomerDashboard() 

	{

		$city = $this->input->post('cityname');
		$this->db->select('*');
		$this->db->from('customer ap');
		$this->db->order_by("id_customer", "desc");	
		$this->db->limit(20);
		$this->db->join('city ci','ap.city_id=ci.id_city','lelt');
		if($city!=NULL)
		{
			$this->db->where('city_name', $city);
		}
		$query = $this->db->get();

		return $query->result_array();

	}

	public function updateCustomer($data)
	{
		$update1=array('full_name'=>$data['name'],
					   'mobile_no'=>$data['mobile'],
					   'email_id'=>$data['email'],
					   'city_id'=>$data['city']);
		$result1=$this->db->update('customer',$update1,array('id_customer' => $data['id']));
		return true;
	}
	
	function insertCustomer($data=NULL)
	{			$customerId = '';
		$customerId = $this->checkMobileNo($data['mobile_no']);
	//echo "<pre>";print_r($customerId);
	
		if(!$customerId){
		
			$this->db->insert('customer', $data);
			$customerId = $this->db->insert_id();
		//	print_r($this->db->last_query());
		//	echo "<pre>";print_r($customerId);
	
		
		}
		//echo "<pre>";print_r("wait");die;
	
		return $customerId;
	}
	
	function checkMobileNo($mobileNo) 
	{
		$query = $this->db->get_where('customer', array('mobile_no' => $mobileNo));
		if($query->result()){
			$customers = $query->result();
			foreach($customers as $customer){
				$customerId = $customer->id_customer;
			}
			return $customerId;
		}else{
			return false;
		}
		
	}
	function getCustomerCsv($city) 
	{
		$this->db->select('full_name,mobile_no,email_id,city_name,medium');
		$this->db->from('customer');
		$this->db->order_by("id_customer", "desc");
		$this->db->join('city','customer.city_id=city.id_city','left');
		if($city)
		{
			$this->db->where('id_city', $city);
		}
		$query = $this->db->get();

		return $query->result_array();

	}
	public function getCustomerByCityId($cityId, $medium=null)
	{
			$this->db->select('*');
			$this->db->from('customer');
			$this->db->Where('city_id', $cityId);
			$this->db->or_Where('full_name', NULL);
			if($medium){
			$this->db->Where('medium', $medium);	
			}
			$this->db->order_by('full_name', 'asc');
			$query = $this->db->get();
			//echo "<pre>";print_r($this->db->last_query());die;
			return $query->result_array();
	}
	
}
?>