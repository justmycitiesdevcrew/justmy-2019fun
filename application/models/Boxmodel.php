<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Boxmodel extends CI_Model

{

	public function getboxdetails($data)
	{
		//echo "<pre>"; print_r($data); die;
	
		$arr = array(
					'box_name' => mb_strtolower(trim($data['pname'])),
					'box_url' => str_replace('&','',str_replace(',','',str_replace(' ','-',mb_strtolower(trim($data['pname']))))),
					
					'box_image' => $data['PackageImage'],
					'box_price' => $data['price'],
					'box_discount_price' => $data['fproduct'],
					'box_note' => $data['note'],
					'box_instruction' => $data['instruction'],
					'box_description' => $data['description']
					);
					//echo "<pre>";print_r($arr);die;
		$this->db->insert('box',$arr);
		//echo "<pre>"; print_r($this->db->last_query());die;
		return true;
	}
	
}

?>