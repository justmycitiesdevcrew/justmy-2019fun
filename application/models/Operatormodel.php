<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Operatormodel extends CI_Model

{

	public function operatorAdd($data)
	{
	    
		$query['operater'] = array(
		                                'operator_name' => $data['operatorName'],
										'operator_mobile_no' => $data['mobileNo'],
										'operator_alternet_no' => $data['alternetNo'],
										'operator_email_no' => $data['email'],
										'operator_address' => $data['address'],
										'id_city' => $data['city'],
										'operator_id_proof' => $data['idProof']
										
									   );
		//echo "<pre>";print_r($query);die;
		$this->db->insert('operater',$query['operater']);
		return $query;
		
	}
	public function operatorBankDetailAdd($data)
	{
				//echo "<pre>"; print_r ($data); die;


	    $query=$this->db->get_where('operater_bank_detail',array('id_operater' => $data['operatorName']));

        if($query->num_rows() > 0)
		{
			redirect(base_url()."admin/Operator/addOperator?msg=emailexits");
        }
		else
		{
			//echo "<pre>"; print_r ($data); die;
		$query = array(
		                                'id_operater' => $data['operatorName'],
										'bank_name' => $data['bname'],
										'bank_account_no' => $data['account_no'],
										'bank_ifsc_code' => $data['ifsc'],
										'bank_branch_name' => $data['branch']
										
										
									   );
		//echo "<pre>";print_r($query);die;
		$this->db->insert('operater_bank_detail',$query);
		return $query;
		}
	}
	public function updateOperator($data)
	{
		$id = $this->input->get('operatorId');
		//echo $id;die;
	    if($data)
	    {
			$arr['operater'] = array(
				                        'operator_name' => $data['operatorName'],
										'operator_mobile_no' => $data['mobileNo'],
										'operator_alternet_no' => $data['alternetNo'],
										'operator_email_no' => $data['email'],
										'operator_address' => $data['address'],
										'id_city' => $data['city'],
										'operator_id_proof' => $data['idProof']
			                           );
			$this->db->update('operater', $arr['operater'],array('operater_id' => $id));
		    return $arr;
        }
		else
		{
			return false;
		}
	}
	public function operatorUpdateWi($data) 
	{
		   $id = $this->input->get('operatorId');
	    if($data)
	    {
		    $arr['operater'] = array(
				                        'operator_name' => $data['operatorName'],
										'operator_mobile_no' => $data['mobileNo'],
										'operator_alternet_no' => $data['alternetNo'],
										'operator_email_no' => $data['email'],
										'operator_address' => $data['address'],
										'id_city' => $data['city']
										
			                           );
			$this->db->update('operater', $arr['operater'],array('operater_id' => $id));
		    return $arr;
        }
		else
		{
			return false;
		}
	}
	public function getOperator()
	{
	        $citylist = $this->input->post('cityname');
	        $productstatus = $this->input->post('product_status');
			//echo $citylist;die;
			$this->db->select('*');
			$this->db->from('operater');
			$this->db->join('city','city.id_city = operater.id_city');
			$this->db->join('operater_bank_detail','operater.operater_id = operater_bank_detail.id_operater','left');
			if($citylist!=Null)
		    {
			$this->db->where('city_name', $citylist);
		    }
			if($productstatus!=Null)
		    {
			$this->db->where('operator_status', $productstatus);
		    }
			$query = $this->db->get();
		    return $query->result_array();
    }
	
	public function getOperatorList()
	{
			$this->db->select('operater_id,operator_name');
			$this->db->from('operater');
			
			$this->db->order_by('operator_name', 'asc');
			$query = $this->db->get();
			return $query->result();
    }
	public function getOperatorById() 
	{
			//echo "<pre>";print_r($_REQUEST);die;
			$id = $this->input->get('operatorId');
			$this->db->select('*');
			$this->db->from('operater i');	
			$this->db->join('city id','id.id_city = i.id_city');
			$this->db->join('operater_bank_detail bn','bn.id_operater = i.operater_id','left');
			$this->db->where('i.operater_id', $id);		
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			return $row;			
		}			
			return false;
    }
	function cancelProductStatus($data) 
	{
			$id = $this->input->get('inactiveStatusId');
			$value = $this->input->get('statusValue');
			$arr = array(			 
				        'operator_status'=>$value
				        );
			  $this->db->where('operater_id', $id);
			  $this->db->update('operater', $arr);

        return true;
				 
    }
}
?>