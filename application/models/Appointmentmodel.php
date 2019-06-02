<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class AppointmentModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function customerConsultationList($customer_ID) 	
	{				
		if(!empty($customer_ID)) 
		{			 
		$query = $this->db->select('*')
			->from('consultation c')					
			->join('city ct', 'c.city_id = ct.id_city')					
			->join('category s', 'c.speciality_id = s.category_id')					
			->where('c.customer_id',$customer_ID)
			->order_by('id_consultation','DESC')					
			->get();			
			if($query->num_rows()>0) {				
				return $query->result();			
			}										 
		}
		
	}
	public function getAppointment($customer_ID) 	
	{				
		if(!empty($customer_ID)) 
		{			 
		$query = $this->db->select('id_appointment')
			->from('appointment')					
			->where('customer_id',$customer_ID)					
			->limit(1)					
			->order_by('id_appointment','DESC')					
			->get();			
			if($query->num_rows()>0) {				
				return $query->result();			
			}										 
		}
		
	}
	public function customerOrderList($customer_ID) 	
	{				
		if(!empty($customer_ID)) 
		{			 
		$query = $this->db->select('*')
			->from('appointment')					
			->where('customer_id',$customer_ID)					
			//->limit(1)					
			->order_by('id_appointment','DESC')					
			->get();			
			if($query->num_rows()>0) {				
				return $query->result();			
			}										 
		}
		
	}
	
	function insertAppointment($data)
	{		
		//echo "<pre>"; print_r($data); die;
		$this->db->insert('appointment', $data);

		//echo "<pre>"; print_r($this->db->last_query()); die;		
		return $this->db->insert_id();
	}
	public function insert_order_detail($data)
	{    
	    //echo "<pre>"; print_r($data); die;
		$this->db->insert('appointment_detail', $data);
	}
	public function sendLinks($data,$id)
	{    
	    // echo "<pre>"; print_r($data);die;
		$this->db->where('id_appointment',$id);
		$this->db->insert('appointment_detail', $data);
	}
	function getAppointmentBackend($status=NULL,$postdatacity=NULL,$postfromdate=NULL,$posttodate=NULL,$beautician_id=NULL,$isreport=false) 

	{	//echo $beautician_id; die;
	
	
		$this->db->select('*,SUM(price) as total');
		$this->db->from('appointment ap');
		$this->db->where('ap.appointment_status_id !=',9);
		
		if($isreport)
		{	
			$this->db->where('ap.appointment_status_id', 6);
		}
		
		if(!empty($status))
		{	
			$this->db->where('ap.appointment_status_id', $status);
		}
		
		if(!empty($postdatacity))
		{
			$this->db->where('ap.city_id', $postdatacity);
		}
		if(!empty($postfromdate))
		{
			$this->db->where('ap.appointment_date_time >=', $postfromdate);
		}
		if(!empty($posttodate))
		{
			$this->db->where('ap.appointment_date_time <=', $posttodate);
		}
		if(!empty($beautician_id))
		{
			$this->db->where('ap.allocated_beautician_id', $beautician_id);
			$this->db->where('ap.appointment_date_time >=', '2017-07-01');
		}
		
		$this->db->join('appointment_detail det','ap.id_appointment=det.appointment_id','left');
		$this->db->join('customer cu','ap.customer_id=cu.id_customer','left');
		$this->db->join('city ci','ap.city_id=ci.id_city','lelt');
		$this->db->join('appointment_status as','ap.appointment_status_id=as.id_appointment_status','left');
		$this->db->join('product produ','det.product_id=produ.product_id','left');
		$this->db->order_by("ap.id_appointment", "desc");
		$this->db->group_by('ap.id_appointment'); 
		
		$query = $this->db->get();
		
      //  echo "<pre>"; print_r($this->db->last_query());die;
		
		return $query->result();


	}
	function getAppointmentBackendCSV($customer_status=NULL,$custumer_city=NULL,$postfromdate=NULL,$posttodate=NULL,$beautician_id=NULL,$isreport=false) 

	{	//echo $beautician_id; die;
	
	
		$this->db->select('full_name,customer_name,customer_mob,total_booking_amount,city_name,appointment_date_time,appointment_time,ha_created_date,cust_payment_mode,app_title');
		$this->db->from('appointment ap');
		$this->db->where('ap.appointment_status_id !=',9);
		$this->db->order_by("id_appointment", "desc");
		
		if($isreport)
		{	
			$this->db->where('ap.appointment_status_id', 6);
		}
		
		if(!empty($customer_status))
		{	
			$this->db->where('ap.appointment_status_id', $customer_status);
		}
		
		if(!empty($custumer_city))
		{
			$this->db->where('ap.city_id', $custumer_city);
		}
		if(!empty($postfromdate))
		{
			$this->db->where('ap.appointment_date_time >=', $postfromdate);
		}
		if(!empty($posttodate))
		{
			$this->db->where('ap.appointment_date_time <=', $posttodate);
		}
		if(!empty($beautician_id))
		{
			$this->db->where('ap.allocated_beautician_id', $beautician_id);
			$this->db->where('ap.appointment_date_time >=', '2017-07-01');
		}
		
		$this->db->join('appointment_detail det','ap.id_appointment=det.appointment_id','left');
		$this->db->join('customer cu','ap.customer_id=cu.id_customer','left');
		$this->db->join('city ci','ap.city_id=ci.id_city','lelt');
		$this->db->join('appointment_status as','ap.appointment_status_id=as.id_appointment_status','left');
		$this->db->join('product produ','det.product_id=produ.product_id','left');
		$this->db->group_by('id_appointment'); 
		
		$query = $this->db->get();
		
        //echo "<pre>"; print_r($this->db->last_query());die;
		//echo "<pre>"; print_r($query->result()); die;
		return $query->result_array();


	}
	function getAppointmentDashboard() 

	{

		
		$this->db->select('*');
		$this->db->from('appointment ap');
		$this->db->order_by("id_appointment", "desc");
		$this->db->limit(10);
		$this->db->join('customer cu','ap.customer_id=cu.id_customer','left');
		$this->db->join('city ci','ap.city_id=ci.id_city','lelt');
		$this->db->join('appointment_status as','ap.appointment_status_id=as.id_appointment_status','left');
		$query = $this->db->get();

		return $query->result();

	}
	public function getOrderDetailList($id)
	{
		$this->db->select('*');
		$this->db->from('appointment_detail');
		$this->db->where('appointment_id',$id);
		$query = $this->db->get();

		return $query->result_array();
	}
	function getCompleteOrderDashboard() 

	{

		$this->db->select('*');
		$this->db->from('appointment ap');
		$this->db->where('appointment_status_id',6);
		$this->db->order_by("id_appointment", "desc");
		//$this->db->join('appointment_detail det','ap.id_appointment=det.appointment_id','left');
		$this->db->join('customer cu','ap.customer_id=cu.id_customer','left');
		$this->db->join('city ci','ap.city_id=ci.id_city','lelt');
		//$this->db->join('product produ','det.product_id=produ.product_id','left');
		$this->db->join('appointment_status as','ap.appointment_status_id=as.id_appointment_status','left');

		$query = $this->db->get();

		return $query->result_array();

	}
	public function bookingCalDashboard()
	{
		$this->db->select('*');
		$this->db->from('appointment ap');
		$this->db->order_by("ap.appointment_date_time", "asc");
		//$this->db->join('appointment_detail det','ap.id_appointment=det.appointment_id','left');
		$this->db->join('customer cu','ap.customer_id=cu.id_customer','left');
		$this->db->join('city ci','ap.city_id=ci.id_city','left');
		$this->db->join('appointment_status as','ap.appointment_status_id=as.id_appointment_status','left');
		//$this->db->join('product produ','det.product_id=produ.product_id','left');
        $this->db->where('ap.appointment_date_time >=',date('Y-m-d'));
        $this->db->where('ap.appointment_status_id !=',7);
        $this->db->where('ap.appointment_status_id !=',9);
		$this->db->order_by('ap.appointment_date_time', 'desc');
		$this->db->order_by('ap.appointment_time', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function bookingCalBeauticianAllocated()
	{
		$this->db->select('*');
		$this->db->from('appointment ap');
		$this->db->order_by("ap.appointment_date_time", "asc");
		//$this->db->join('appointment_detail det','ap.id_appointment=det.appointment_id','left');
		$this->db->join('customer cu','ap.customer_id=cu.id_customer','left');
		$this->db->join('city ci','ap.city_id=ci.id_city','left');
		$this->db->join('appointment_status as','ap.appointment_status_id=as.id_appointment_status','left');
		//$this->db->join('product produ','det.product_id=produ.product_id','left');
        $this->db->where('ap.appointment_date_time <=',date('Y-m-d'));
        $this->db->where('ap.appointment_date_time >=',date('Y-m-d', strtotime("-30 days")));
        $this->db->where('ap.appointment_status_id !=',7);
        $this->db->where('ap.appointment_status_id !=',9);
		$this->db->order_by('ap.appointment_date_time', 'desc');
		$this->db->order_by('ap.appointment_time', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	public function getAppointmentby_id($orderId)
	{
		//$id = $this->input->get('id');
		//echo "";print_r($id);die;
		$this->db->select('*');
		$this->db->from('appointment ap');
		$this->db->where('id_appointment', $orderId);
		$this->db->join('customer cu','ap.customer_id=cu.id_customer','left');
		$this->db->join('city ci','ap.city_id=ci.id_city','left');
		$this->db->join('appointment_status as','ap.appointment_status_id=as.id_appointment_status','left');
		//$this->db->where('id_appointment', $id);
		$qry=$this->db->get();
		//echo "<pre>";print_r($qry);die;
			return $qry->result_array();
	}
	public function getAppointmentDetail_id($orderId){
		$this->db->select('*');
		$this->db->from('appointment_detail');
		$this->db->where('appointment_id', $orderId);
		$qry=$this->db->get();
	//	echo "<pre>";print_r($this->db->last_query());die;
			return $qry->result_array();
	}
	
	public function status()
	{
		$this->db->select('*');
		$this->db->from('appointment_status');
		$query=$this->db->get();
		return $query->result_array();
	}
	public function updateAppointment($data)
	{
		
		$id = $this->input->get('id');
		//echo "<pre>"; print_r($id);die;
		$query['customer']= array(
				'full_name' => $data['name'],
				'email_id ' => $data['email'],
				'mobile_no ' => $data['mobile'],
				'city_id' => $data['city']
		);
		$query['appointment']= array(
				'city_id' => $data['city'],
				'customer_name' => $data['name'],
				'customer_mob' => $data['mobile'],
				'appointment_address' => $data['Address']
		);

		//$this->db->update('customer',$query['customer'], array('id_customer' => $id));
		$this->db->update('appointment',$query['appointment'], array('customer_id' => $id));
		//echo $this->db->last_query(); die;
		return $query;
	}
	public function updateAppointmentDetails($data)
	{
		
		$update= array(
				'city_id' => $data['city'],
				'appointment_status_id' => $data['status']
		);

		
		$query2 = $this->db->update('appointment',$update2,array('customer_id' => $data['id']));
		return true;
	}
	public function getbeauticianinfo($cityId=NULL, $id=NULL)
	{

			$this->db->select('*');
			$this->db->from('labs');
			if(!empty($cityId)){
				$this->db->Where('id_city', $cityId);
			}
			if(!empty($id)){
				$this->db->Where('lab_id', $id);
			}
			$query = $this->db->get();
			//echo "<pre>";print_r($this->db->last_query());die;
			return $query->result_array();
	}
	public function getLabsbyId($cityId)
	{
		//	$where = "FIND_IN_SET('".$cityId."', multi_city_id)";
			$this->db->select('*');
			$this->db->from('labs');
			$this->db->where('city_id',$cityId);
			$this->db->where('lab_status','1');
		//	$this->db->or_where($where);			
			$query = $this->db->get();
		    return $query->result_array();
			
    }
	public function updateAppointmentStatus($data, $orderid)
	{
		
		
		$update= array(
				'appointment_status_id' => $data['custoumer_status'],
				'comment' => $data['regioncomment']
		);
		//echo "<pre>"; print_r($update); die;
		$this->db->where("id_appointment",$orderid);
		$query1 = $this->db->update("appointment",$update); 
		//echo "<pre>"; print_r($query1); die;		
		//$query2 = $this->db->update('appointment',$update, array('id_appointment' = $orderid););
		return true;
	}
	public function updateBalCalculation($data, $id)
	{
		
		$update= array(
				'total_booking_amount' => $data['totalamount'],
				'advance_paid' => $data['advancepaid'],
				'discount_amount' => $data['discount'],
				'rest_amount' => $data['restbalance'],
			//	'commission' => $data['hsbpcommission_rupee'],
			//	'customer_payment_by_beautician' => $data['collectedbybeautician']
		);

		
		//echo "<pre>"; print_r($update); die;
		$this->db->where("id_appointment",$id);
		$query1 = $this->db->update("appointment",$update); 
		
		return true;
	}
		public function getOperBeautician($cityId=NULL, $id=NULL)
	{

			$this->db->select('*');
			$this->db->from('beautician');
			if(!empty($cityId))
			{
			$this->db->Where('id_city', $cityId);
			}
			if(!empty($id))
			{
			$this->db->Where('beautician_id', $id);
			}
			$query = $this->db->get();
			//echo "<pre>";print_r($this->db->last_query());die;
			return $query->result_array();
	}
		public function updateBeautcianAllocation($data, $id)
	{
		//echo "<pre>"; print_r($data); die; 
		$update= array(
				/* 'location_latitude' => $data['cust_latitude'],
				'location_longitude' => $data['cust_longitude'], */
				'allocated_lab_id' => $data['labId'],
				'lab_name' => $data['labName'],
				'lab_mob_no' => $data['number'],
				'appointment_status_id' => $data['status'],
				'lab_email_id' => $data['email']
				//, 'beautician_commission_percent' => $data['beauticianhsbpcomm']
		);

		//echo $id;die;
		//echo "<pre>"; print_r($update); die;
		$this->db->where("id_appointment",$id);
		$query1 = $this->db->update("appointment",$update); 
		
		return true;
	}
	public function getlabIdbyAppointmetId($id)
	{
			
			$this->db->select('allocated_lab_id');
			$this->db->from('appointment');
			$this->db->where('id_appointment',$id);
			
			$query = $this->db->get();
			//echo "<pre>"; print_r($this->db->last_query()); die;
			if($query->num_rows()>0) {				
				return $query->result();		
			}
			return false;
			
    }
	public function getLabCommission($beauticianid)
	{
			//echo $beauticianid; die;
			$this->db->select('lab_commission_percentage');
			$this->db->from('labs');
			$this->db->where('lab_id',$beauticianid);
			
			$query = $this->db->get();
		    if($query->num_rows()>0) {				
				return $query->result();		
			}
			return false;
			
    }
	public function getlabDetailsById($beauticianid)
	{
			//echo $beauticianid; die;
			$this->db->select('*');
			$this->db->from('labs');
			$this->db->where('lab_id',$beauticianid);
			
			$query = $this->db->get();
			return $query->result_array();
		    
    }
	function getAppointmentOrder() 

	{

		
		$this->db->select('*');
		$this->db->from('appointment');
		$this->db->order_by("id_appointment", "desc");
		//$this->db->limit(10);
		//$this->db->join('customer cu','ap.customer_id=cu.id_customer','left');
		//$this->db->join('city ci','ap.city_id=ci.id_city','lelt');
		//$this->db->join('appointment_status as','ap.appointment_status_id=as.id_appointment_status','left');
		$query = $this->db->get();

		return $query->result();

	}
	
	public function updateOrderStatusLog($data)
	{
		//echo "<pre>"; print_r($data); die;
		$this->db->insert('appointment_history',$data);
		return true;
	}
	public function getOrderHistoryByid($orderId)
	{
		//$id = $this->input->get('id');
		//echo "";print_r($id);die;
		$this->db->select('*');
		$this->db->from('appointment_history');
		$this->db->where('id_appointment', $orderId);
		$qry=$this->db->get();
		//echo "<pre>";print_r($qry);die;
		return $qry->result_array();
	}
	public function updateAppointmentRecords($data, $orderid){	
		$update = array(
				'city_id' => $data['city'],
				'appointment_address' => $data['address'],
				'appointment_date_time' => date('Y-m-d',strtotime($data['adate'])),
				'appointment_time' => $data['atime']
		);
		$this->db->where("id_appointment",$orderid);
		$query1 = $this->db->update("appointment",$update); 
		
		return true;
	}
	
	public function cheackCode($code=NULL)
	{
			$date = date('Y-m-d');
		   $this->db->select('*');
		   $this->db->from('coupan');
		   $this->db->where('coupan_code',strtoupper($code));
		   //$this->db->where('valide_from <=', $date);
		   $this->db->where('valide_to >=', $date);
		   $this->db->where('coupan_status','1');
		   $query = $this->db->get();
			
	   if($query->num_rows() > 0)
	   {
		   $result = $query->result_array();
		   return $result[0];  
	   }
	   else
	   {
			return false;
	   }
	}
	public function coupanHistory($code)
	{
		$this->db->select('*');
		$this->db->from('coupan_history');
		$this->db->where('coupon_code',strtoupper($code));
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	
	public function insertCoupon($data)
	{
		$this->db->insert('coupan_history',$data);
		return true;
	}
	public function InsertAppointmentDetals($data)
	{
		$this->db->insert('appointment_detail', $data);
		return true;
	}
	public function TotalProductpricebyId($orderId){
		$this->db->select('*,SUM(price) as total');
		$this->db->from('appointment ap');
		$this->db->join('appointment_detail det','ap.id_appointment=det.appointment_id','left');
		//$this->db->from('appointment_detail');
		$this->db->where("ap.id_appointment", $orderId);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function UpdateTotalAmountbyOrderId($orderid, $data){
		$query['appointment']= array(
				'total_booking_amount' => $data['total'],
				'rest_amount' => $data['restmount']
		);
		$this->db->update('appointment',$query['appointment'], array('id_appointment' => $orderid));
		return true;
		
	}
	function customerTokenIds()
	{
		$this->db->select('customer_token_id');
		$this->db->from('customer');	
		$this->db->where("id_customer", '337');
		$this->db->or_where("id_customer", '516');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function paymentIdUpdate($orderId,$paymentId,$amount){
		$query['appointment']= array(
				'advance_paid' => $amount,
				'txn_id' => $paymentId
		);
		$this->db->update('appointment',$query['appointment'], array('id_appointment' => $orderId));
		$query['appointment']['order_id']=$orderId;
		$this->insertPaymentLeaser($query['appointment']);
		return true;
	}
	public function insertPaymentLeaser($data){
		$data['amount'] = $data['advance_paid'];
		$data['payment_id'] = $data['txn_id'];
		unset($data['advance_paid']);
		unset($data['txn_id']);
		$this->db->insert('payment_leaser',$data); 
		return true;
	}
	
}
?>