<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	public function inserCustomer($data){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('email_id', $data['email_id']);
		$query = $this->db->get();
		$row = $query->result_array();
		if(!$row){	
			$this->db->insert('customer',$data);
			$res = $this->db->insert_id();
			return $res;
		}else{
			return $row[0]['id_customer'];
		}
	}
	 public function insertOrder($data){
		$this->db->insert('orders',$data);
		$res = $this->db->insert_id();
		return $res;
	} 

	/* function update_cart($rowid, $qty, $price, $amount) {
 		$data = array(
			'rowid'   => $rowid,
			'qty'     => $qty,
			'price'   => $price,
			'amount'   => $amount
		);

		$this->cart->update($data);
	}
	function getProductService($id){
		$this->db->select('product_id, product_price,product_discount_price,cityprice');
		$this->db->from('product');
		$this->db->where('product_id', $id);
		$query = $this->db->get();
		return $query->result_array();
	}
	function getPackages($id){
		$this->db->select('id_package,package_price,package_discount_price,cityprice');
		$this->db->from('package');
		$this->db->where('id_package', $id);
		$query = $this->db->get();
		return $query->result_array();
	}	 */	
}