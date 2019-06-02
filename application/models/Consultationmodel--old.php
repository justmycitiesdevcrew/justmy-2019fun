<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Consultationmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}
	public function getSubscriptionData($subId) 
	{	
		$this->db->select('*');
		$this->db->from('subscription_order');
		$this->db->where('sub_order_id',$subId);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getCustomerData($id) 
	{	
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id_customer', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	public function createConsultation($data){
		$arr = array(
			'customer_id ' => $data['id_customer'], 
			'city_id' => $data['city_id'], 
			'speciality_id' => $data['speciality_id'], 
			'query'=> $data['query'], 
			'consulting_medium'=> $data['consulting_medium'], 
			'customer_name' => $data['full_name'], 
			'customer_mob' => $data['mobile_no'], 
			'customer_age' => '', 
			'customer_email' => $data['email_id']
		);
		$insert_id = $this->db->insert('consultation',$arr);
		return $insert_id;
	}	
	function changeComplainStatus($data) 
	{
		
		$arr = array(			 
			  'comp_status'=>$data['value']
			  );
			  $this->db->where('complain_id', $data['compId']);
			  $this->db->update('cust_complains', $arr);
        
		return true;
				 
    }	
}
?>