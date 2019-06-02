<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reportmodel extends CI_Model

{

	public function getBeauticiantoHsbpPaid($postfromdate,$posttodate,$beautician_id)
	{	//echo date("Y-m").'-01 00:00:00';die;
			$this->db->select('*');
			$this->db->from('beautician_payment');
			$this->db->join('beautician','beautician.beautician_id = beautician_payment.beautician_id','left');
			$this->db->join('city','city.id_city = beautician.city_id');
		if(!empty($postfromdate))
		{
			$this->db->where('beautician_payment.created_date >=', $postfromdate.' 00:00:00');
		}
		else
		{
			$this->db->where('beautician_payment.created_date >=', date("Y-m").'-01 00:00:00');
		}	
		if(!empty($posttodate))
		{
			$this->db->where('beautician_payment.created_date <=', $posttodate.' 23:59:59');
		}
		if(!empty($beautician_id))
		{
			$this->db->where('beautician_payment.beautician_id', $beautician_id);
			
		}
		$this->db->order_by("beautician_payment.payment_id", "desc");
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			return $row;			
		}			
			return false;
    }
	public function totalAmountPaidtoHsbp($postfromdate,$posttodate,$beautician_id)
	{	
		$this->db->select('*, sum(amount) as amount');
		$this->db->from('beautician_payment');
		if(!empty($postfromdate))
		{
			$this->db->where('created_date >=', $postfromdate.' 00:00:00');
		}
		else
		{
			$this->db->where('created_date >=', date("Y-m").'-01 00:00:00');
		}
		if(!empty($posttodate))
		{
			$this->db->where('created_date <=', $posttodate.' 23:59:59');
		}
		if(!empty($beautician_id))
		{
			$this->db->where('beautician_id', $beautician_id);
			
		}
		
		$this->db->order_by("payment_id", "desc");
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			return $row;			
		}			
			return false;
    }	

}
?>