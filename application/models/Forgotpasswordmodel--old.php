<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Forgotpasswordmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		
	}
		function checkUser($email){
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
		function checkOtp($otp,$email){
			$this->db->select('*');
			$this->db->from('customer');
			$this->db->where('otp',$otp);
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
		function updateOtp($emailId,$otp){
			$update=array('otp'=>$otp
					   );
			$result=$this->db->update('customer',$update,array('email_id' => $emailId));
			if($this->db->affected_rows() == 1){
				return true;
			}else{
				return false;
			}
		}
		function updatePass($emailId,$password){
			$update=array('password'=>$password);
			$result=$this->db->update('customer',$update,array('email_id' => $emailId));
			if($this->db->affected_rows() == 1){
				return true;
			}else{
				return false;
			}
		}
}
?>