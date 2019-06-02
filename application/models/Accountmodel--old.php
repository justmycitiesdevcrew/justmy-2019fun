<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Accountmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function loginRegistration($name, $emailid, $password, $city, $mobile){
	$data=array(
			'city_id'=>$city,
			'mobile_no'=>$mobile,
			'password'=>md5($password),
			'full_name'=>$name,
			'email_id'=>$emailid
			); 
			
		$this->db->insert('customer', $data);
		$customerId = $this->db->insert_id();	
		return $customerId;
	}
	function checkMobileNo($email){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('mobile_no',$email);
		$query = $this->db->get();
		$res=$query->result();
//		echo "<pre>"; print_r($this->db->last_query()); die;
        if($res){
			return $res;
		}else{
			return false;
		}
	}
	function checkEmailId($email){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('email_id',$email);
		$query = $this->db->get();
		$res=$query->result();
//		echo "<pre>"; print_r($this->db->last_query()); die;
        if($res){
			return $res;
		}else{
			return false;
		}
	}
	function checkUser($email,$password){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->order_by("id_customer", "desc");
		$this->db->join('city','customer.city_id=city.id_city');
		$this->db->where('mobile_no',$email);
		$this->db->where('password',md5($password));
		$query = $this->db->get();
		$res=$query->result();
//		echo "<pre>"; print_r($this->db->last_query()); die;
        if($res){
			return $res;
		}else{
			return false;
		}
	}
	function customerDetail($custId){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->order_by("id_customer", "desc");
		$this->db->join('city','customer.city_id=city.id_city');
		$this->db->where('id_customer',$custId);
		$query = $this->db->get();
		$res=$query->result();
		
        if($res){
			return $res;
		}else{
			return false;
		}
	}
	public function getCustomerby_id()
	{
		$id=$this->input->get('Id');
		//echo "<pre>";print_r($id);die;
		$this->db->select('*');
		$this->db->from('customer hc');
		//$this->db->where('id_customer',$id);
		$this->db->join('city hci','hc.city_id=hci.id_city');
		$this->db->where('id_customer',$id);
		$query = $this->db->get();
		//echo "<pre>";print_r($query);die;
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
					//   echo "<pre>"; print_r($update1); die;
		$result1=$this->db->update('customer',$update1,array('id_customer' => $data['id']));
		return true;
	}
	
	

	
	function getCustomerCsv($city) 
	{
		$this->db->select('full_name,mobile_no,email_id,city_name,medium');
		$this->db->from('customer');
		$this->db->order_by("id_customer", "desc");
		$this->db->join('city','customer.city_id=city.id_city','left');
		if($city!=NULL)
		{
			$this->db->where('city_name', $city);
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
	/* public function getCustomerOrderList(){
		$this->db->select('*');
			$this->db->from('order');
			$this->db->Where('city_id', $cityId);
			$this->db->or_Where('full_name', NULL);
			if($medium){
			$this->db->Where('medium', $medium);	
			}
			$this->db->order_by('full_name', 'asc');
			$query = $this->db->get();
			//echo "<pre>";print_r($this->db->last_query());die;
			return $query->result_array();
	} */
	
}
?>