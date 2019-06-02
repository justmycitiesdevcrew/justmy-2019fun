<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class ComplainModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}
	public function getComplainList() 
	{	
		$this->db->select('*');
		$this->db->from('cust_complains');
		$this->db->join('customer', 'customer.id_customer = cust_complains.customer_id' );
		$this->db->order_by('cust_complains.customer_id','desc');
		$query = $this->db->get();
	   // echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
	}
	public function getComplain($data=null) 
	{	
		$this->db->select('*');
		$this->db->from('cust_complains');
		$this->db->join('customer', 'customer.id_customer = cust_complains.customer_id' );
		$this->db->where('comp_status', $data['compStatus']);
		
		$this->db->order_by('cust_complains.customer_id','desc');
		$query = $this->db->get();
	   // echo "<pre>";print_r($query->result_array());die;
		return $query->result_array();
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