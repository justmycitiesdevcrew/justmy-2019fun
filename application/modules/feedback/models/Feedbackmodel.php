<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Feedbackmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function getFeedback($status=NULL,$id=NULL){
		$this->db->select('*');
		$this->db->from('testimonials');
		$this->db->join('city','city.city_id = testimonials.city_id');
		$this->db->order_by('feedback_id','desc');	
		if($status){
			$this->db->where("fd_state", $status);
		}if($id){
			$this->db->where("feedback_id", $id);
		}
		$query = $this->db->get();
	//	echo $this->db->last_query(); die;
		return $query->result_array();
	}
	public function feedbackUpdate($data) 
	{
			$query = array(
						'customer_order_id' => $data['orderId'],
						//'allocated_beautician_id' => $data['beauticianId'],
						'customer_name' => $data['name'],
						//'email_id' => $data['email'],
						'moblie_no' => $data['phone'],
						'city_id' => $data['city'],
						'rating_id' => $data['rating'],
						'header_text' => $data['header_text'],
						'message' => $data['message'],
						//'created_date' => date('Y-m-d')
					  );
					 // echo "<pre>"; print_r($query); die;
			$result1=$this->db->update('testimonials',$query,array('feedback_id' => $data['id']));
			return true;
	    }
	
}