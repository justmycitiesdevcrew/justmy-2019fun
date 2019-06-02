<?php
class Usermodel extends CI_Model
{

    public function __construct()
    { 

        parent::__construct();
    }

	public function isMobileOrEmailExist($mobileNo=NULL,$email=NULL){
		if($email !== NULL && $mobileNo !==NULL){
			if($this->checkExistingMobile($mobileNo)){
				$msg = 'Mobile number already exist, try to sign in.';
				return $msg;
			}
			if($this->checkExistingEmail($email)){
				$msg = 'Email already exist, try to sign in.';
					return $msg;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}

	public function checkExistingMobile($mobileNo = NULL) {
		$this->db->select('c.mobile_no,c.email_id');
        $this->db->from('customer c');
		$this->db->where('mobile_no', $mobileNo);
        $query = $this->db->get();
		if($query->num_rows()){
			return true;
		}
		else{
			return false;
		}
    }
	public function checkExistingEmail($email = NULL) {
		$this->db->select('c.email_id');
        $this->db->from('customer c');
		$this->db->where('email_id', $email);
		$query = $this->db->get();
		if($query->num_rows()){
			return true;
		}
		else{
			return false;
		}
    }
	
	public function isMobileOrEmailExist2($mobileNo=NULL,$email=NULL,$userId){
		if($email !== NULL && $mobileNo !==NULL){
			if($this->checkExistingMobile2($mobileNo,$userId)){
				$msg = 'Mobile number already exist, try to sign in.';
				return $msg;
			}
			if($this->checkExistingEmail2($email,$userId)){
				$msg = 'Email already exist, try to sign in.';
					return $msg;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}
	public function checkExistingMobile2($mobileNo = NULL,$userId) {
		$this->db->select('c.mobile_no,c.email_id');
        $this->db->from('customer c');
		$this->db->where('mobile_no', $mobileNo);
		$this->db->where('id_customer !=', $userId);
        $query = $this->db->get();
		if($query->num_rows()){
			return true;
		}
		else{
			return false;
		}
    }
	public function checkExistingEmail2($email = NULL,$userId) {
		$this->db->select('c.email_id');
        $this->db->from('customer c');
		$this->db->where('email_id', $email);
		$this->db->where('id_customer !=', $userId);
		$query = $this->db->get();
		if($query->num_rows()){
			return true;
		}
		else{
			return false;
		}
    }

	public function userRegistration($data){
		$userTable = array(
					'full_name'=>$data['FullName'],
					'last_name'=>$data['LastName'],
					'mobile_no'=>$data['MobileNo'],
					'email_id'=>$data['Email'],
					'password'=>md5($data['Password']),
					'city_id'=>$data['city_id'],
					'locality_id'=>$data['custLocality'],
					//'pincode'=>$data['pincode'],
					'address'=>$data['newaddress'],
			);
		$query = $this->db->insert('customer',$userTable);
		$inserted_Id = $this->db->insert_id();
		return $inserted_Id;
	}
	public function submitquery($data){
		$userTable = array(
					'customer_id'=>$data['userid'],
					'first_name'=>$data['Fname'],
					'last_name'=>$data['Lname'],
					'email'=>$data['Email'],
					'mobile_no'=>$data['Mobile'],
					'query'=>($data['Query']),
					'query_type'=>$data['type'],
			);
		$query = $this->db->insert('query',$userTable);
		$inserted_Id = $this->db->insert_id();
		return $inserted_Id;
	}
	public function submitCustomerquery($data){
		$userTable = array(
					'customer_order_id'=>$data['userid'],
					'order_id'=>$data['orderid'],
					'customer_name'=>$data['Fname'].' '.$data['Lname'], 
					'email_id'=>$data['Email'],
					'moblie_no'=>$data['Mobile'],
					'message'=>($data['Query']), 
					'city_id'=>($data['FcityId']), 
					'rating_id'=>(($data['Rateproducts']+$data['Rateservice'])/2),
					'feedback_data'=>json_encode(array('product_rating'=>$data['Rateproducts'],'service_rating'=>$data['Rateservice'])),
			);
		$query = $this->db->insert('feedback',$userTable);
		$inserted_Id = $this->db->insert_id();
		return $inserted_Id;
	}

	public function userLogin($data) {
		$this->db->select('id_customer,email_id,mobile_no,full_name,last_name,city_id,state_id,address,profile_img,hc_created_date,customer_prasuk_family_card,locality_id,pincode,date_of_birth,delivery_preferences,customer_wallet');
        $this->db->from('customer c');
		$this->db->where('password', md5($data['Password']));	
		$this->db->where("(mobile_no =  '".$data['MobileNo']."' or email_id = '".$data['MobileNo']."')");		
		$this->db->limit(1);
        $query = $this->db->get();        
	//	echo $this->db->last_query();die;
		return $query->result_array();		
    }
	public function userLogin2($userid) {
		$this->db->select('id_customer,email_id,mobile_no,full_name,last_name,city_id,state_id,address,profile_img,hc_created_date,customer_prasuk_family_card,customer_wallet');
        $this->db->from('customer c');
		$this->db->where('id_customer',$userid);			
		$this->db->limit(1);
        $query = $this->db->get();        
		return $query->result_array();		
    }
	public function userLoginIdMob($userid,$mobileNo) {
		$this->db->select('id_customer,email_id,mobile_no,full_name,last_name,city_id,state_id,address,profile_img,hc_created_date,customer_prasuk_family_card,customer_wallet');
        $this->db->from('customer c');
		$this->db->where('id_customer',$userid);			
		$this->db->where('mobile_no',$mobileNo);			
		$this->db->limit(1);
        $query = $this->db->get();        
		return $query->result_array();		
    }
	public function customerAddresses($custId){
		$this->db->select('*');
        $this->db->from('customer_address');
        $this->db->join('city','city.city_id = customer_address.customer_city_id');
		$this->db->where('customer_id',$custId);	
        $query = $this->db->get();
		$res = $query->result_array();
		if($query->num_rows()){
			return $res;
		}
		else{
			return false;
		}
    }
	public function getCityDetails($cityId) {
		$this->db->select('*');
        $this->db->from('city c');
        $this->db->join('city_detail cd','c.city_id = cd.city_id');
		$this->db->where('c.city_id', $cityId);
        $query = $this->db->get();        
	//	echo $this->db->last_query();die;
		return $query->result_array();		
    }
	public function getOrderDetails($data) {
		$this->db->select('*');
        $this->db->from('orders');
		$this->db->where('order_id', $data['orderid']);	
		$this->db->where('customer_id',$data['userID']);	
        $query = $this->db->get();        
	//	echo $this->db->last_query();die;
		return $query->result_array();		
    }
	public function checkUserMobile($mobileNo){
		$this->db->select('c.mobile_no,c.email_id,c.full_name,c.last_name');
        $this->db->from('customer c');
		$this->db->where("(mobile_no =  '".$mobileNo."' or email_id = '".$mobileNo."')");	
        $query = $this->db->get();
		$res = $query->result_array();
		if($query->num_rows()){
			return $res;
		}
		else{
			return false;
		}
    }

	public function getwhyorganics(){
		$this->db->select('*');
        $this->db->from('whyorganic c');
		$this->db->where('whyorganic_status','1');	
        $query = $this->db->get();
		$res = $query->result_array();
		if($query->num_rows()){
			return $res;
		}
		else{
			return false;
		}
    }
	public function BookingDetailsThank($order_id,$isStocked=0){
		$this->db->select('*');
        $this->db->from('orders');
		$this->db->where('is_stocked',$isStocked);	
		$this->db->where('order_id',$order_id);	
        $query = $this->db->get();
		$res = $query->result_array();
	//	echo "<pre>"; print_r($this->db->last_query()); die;
		if($query->num_rows()){
			return $res;
		}
		else{
			return false;
		}
    }
	public function checkuserOrderid($data){
		$this->db->select('*');
        $this->db->from('orders');
		$this->db->where('customer_id',$data['userid']);	
		$this->db->where('order_id',$data['orderid']);	
        $query = $this->db->get();
		$res = $query->result_array(); 
		if($query->num_rows()){
			return $res;
		}
		else{
			return false;
		}
    }

	public function updateUserPass($data){
		$this->db->where('email_id', $data['MobileNo']);
		$updateData['password'] = md5($data['Password']);
		$query = $this->db->update('customer',$updateData);
		if($this->db->affected_rows())
			return true;
		else
			return false;
	}
	public function CancelOrder($data){
		$this->db->where('order_status !=', '6'); 
		$this->db->where('order_status !=', '7'); 
		$this->db->where('order_id', $data['orderid']);
		$this->db->where('customer_id', $data['UserId']);
		$updateData['order_status'] = 7;
		$query = $this->db->update('orders',$updateData);
		if($this->db->affected_rows())
			return true;
		else
			return false;
	}
	public function UpdateBookingIsStock($orderId){
		$this->db->where('order_id', $orderId);
		$updateData['is_stocked'] = 1;
		$query = $this->db->update('orders',$updateData);
		if($this->db->affected_rows())
			return true;
		else
			return false;
	}
	public function updateProductStock($productId,$qty,$action='-'){
		$qty = $qty;
		$this->db->where("product_id", $productId);
		$this->db->set("product_qty", "`product_qty` ".$action." $qty", FALSE);
		$this->db->update("products");
	//	echo $this->db->last_query(); die;
		if($this->db->affected_rows()){
			 return true;
			}else{
			 return false;
		 }
	}
	public function categoryList(){
		$this->db->select('*');
        $this->db->from('categories c');
		$this->db->where('cat_status', '1');
        $query = $this->db->get();
		$res = $query->result_array();
		return $res;
	}
	public function getfaqs(){
		$this->db->select('*');
        $this->db->from('faq');
		$this->db->where('faq_status', '1');
        $query = $this->db->get();
		$res = $query->result_array();
		return $res;
	}
	public function getblogs(){
		$this->db->select('*');
        $this->db->from('blogs');
		$this->db->where('blog_status', '1');
        $query = $this->db->get();
		$res = $query->result_array();
		return $res;
	}
	public function productlist($categoryId){
		$this->db->select('*,products.product_id as pid');
		$this->db->from('products');	
		$this->db->join('categories','categories.id = products.product_cat_id');			
		$this->db->order_by('products.product_id','desc');
		$this->db->where('product_cat_id',$categoryId);	
		$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result_array();
			return $row;			
		}else			
			return false;
	}
	function productAttachments($pid){
		$this->db->select('product_attachment');
		$this->db->from('product_attachment');	
		$this->db->where('product_id',$pid);	
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() > 0) 
		{
			$row = $query->result_array();
			return $row;			
		}else			
			return false;
	}
	function citylist(){
		$this->db->select('*');
		$this->db->from('city');	
		$this->db->where('parent_id !=0');	
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() > 0){
			$row = $query->result_array();
			return $row;			
		}else			
			return false;
	}
	public function feedback($data){
		$arr = array(
			'customer_order_id'=>$data['CustomerOrderId'],
		//	'allocated_delievery_id'=>$data['AllocatedDelieveryId'],
			'customer_name'=>$data['CustomerName'],
			'email_id'=>$data['EmailId'],
			'moblie_no'=>$data['MoblieNo'],
			'city_id'=>$data['CityId'],
			'message'=>$data['Message'],
			'rating_id'=>$data['Rating'],
		);
		$this->db->insert('feedback',$arr);
		return $this->db->insert_id();
	}
	
	
	 public function checkUserId($data){
		$this->db->select('customer.id_customer,customer.customer_wallet,customer.email_id,customer.mobile_no,customer.full_name,customer.address,customer.date_of_birth,customer.last_name,customer.pincode,customer.locality_id,customer.city_id,customer.pickup_point_details,customer.pickup_point,customer.delivery_preferences,city.city_name,city_locality.city_locality_name');
		$this->db->from('customer');
		$this->db->join('city','customer.city_id = city.city_id','left');		
		$this->db->join('city_locality','city_locality.city_locality_id = customer.city_id','left');		
		$this->db->where('id_customer',$data['userID']);
		$query = $this->db->get(); 
		$result = $query->result_array();
		return $result;
	}
	 public function getLocality($cityid){
		$this->db->select('*');
		$this->db->from('city_locality');
		$this->db->order_by('city_locality_name','asc');
		$this->db->where('city_id',$cityid);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	 public function orderHistory($custID){
		$this->db->select('*');
		$this->db->from('orders o');
		$this->db->join('order_status os','os.id_order_status = o.order_status');
		$this->db->join('delivery','delivery.id_delivery = o.allocated_delivery_id','left');
		$this->db->order_by('order_id','desc');
		$this->db->where('o.order_status','6');
		$this->db->where('o.customer_id',$custID);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	 public function transactionsHistory($custID, $limit = true,$postfromdate = null , $posttodate=null){
		$this->db->select('*,t.amount as tamount,t.created_date as created_date');
		$this->db->from('user_transaction t');
		$this->db->join('user_wallet w','w.transaction_id = t.transaction_id','left');
		$this->db->order_by('t.transaction_id','desc');
		if(!empty($postfromdate)){
			$this->db->where('t.created_date >=', date('Y-m-d',strtotime('-90 day',strtotime($postfromdate))));
		}
		if(!empty($posttodate)){
			$this->db->where('t.created_date <=',  date('Y-m-d',strtotime('+1 day',strtotime($posttodate))));
		}	 
		$this->db->where('t.user_id',$custID);
		if($limit){
			$this->db->limit(10);
		}
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	 public function loadmoretransaction($from, $to, $userid){
		$this->db->select('*,t.amount as tamount');
		$this->db->from('user_transaction t');
		$this->db->join('user_wallet w','w.transaction_id = t.transaction_id','left');
		$this->db->order_by('t.transaction_id','desc');
		$this->db->where('t.user_id',$userid);
		$this->db->limit($from,$to);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	 public function nextDelievery($custID){
		$this->db->select('*');
		$this->db->from('orders o');
		$this->db->join('order_status os','os.id_order_status = o.order_status');
		$this->db->join('delivery','delivery.id_delivery = o.allocated_delivery_id','left');
		$this->db->order_by('order_id','desc');
		$this->db->where('order_status !=','6');
		$this->db->where('customer_id',$custID);
		$this->db->limit(10);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	 public function loadmorenextdelivery($from, $to,$custID){
		$this->db->select('*');
		$this->db->from('orders o');
		$this->db->join('order_status os','os.id_order_status = o.order_status');
		$this->db->join('delivery','delivery.id_delivery = o.allocated_delivery_id','left');
		$this->db->order_by('order_id','desc');
		$this->db->where('order_status !=','6');
		$this->db->where('customer_id',$custID);
		$this->db->limit($from,$to);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	public function updateProfile($data,$custID){
	 
		$arr = array(
			'full_name'=>$data['custname'],
			'mobile_no'=>$data['custmobile'],
			'email_id'=>$data['custemail'],
			'date_of_birth'=>$data['custDOB'],
			'address'=>$data['custAdd'],
			'last_name'=>$data['custlastname'],
			'pincode'=>$data['custPincode'],
			'city_id'=>$data['custCity'],
			'locality_id'=>$data['custLocality'],
		);
		$this->db->update('customer',$arr,array('id_customer'=>$custID));
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}
	public function checkAddAlready($data,$custID){
		$this->db->select('*');
		$this->db->from('customer_address');
		$this->db->where('customer_locality_id',$data['custLocality']);
		$this->db->where('customer_id',$custID);
		$query = $this->db->get();
		if ($query->num_rows() > 0){
			$row = $query->result_array();
			return true;			
		}else{
			
			$this->db->select('*');
			$this->db->from('city_locality');	
			$this->db->where('city_locality_id',$data['custLocality']);	
			$query = $this->db->get();
			$localitydata = $query->result_array();
			
			$arrr['customer_city_id'] = $data['custCity'];
			$arrr['customer_locality_id'] = $data['custLocality'];
			$arrr['customer_locality_name'] = $localitydata[0]['city_locality_name'];
			$arrr['customer_address'] = $data['custAdd'];
			$arrr['customer_pincode'] = $data['custPincode'];
			$arrr['customer_id'] = $custID;
			$query = $this->db->insert('customer_address',$arrr);
			return false;
		}
		
	}
	public function updateaddress($data,$custID){
		$arr = array(
			'customer_city_id'=>$data['city_id'],
			'customer_locality_id'=>$data['custLocality'],
			'customer_locality_name'=>$data['localityName'],
			'customer_address'=>$data['newaddress'],
			'customer_pincode'=>$data['pincode'],
		);
		
		$this->db->where('address_id',$data['addressId']);	
		$this->db->where('customer_id',$custID);	
		$this->db->update('customer_address',$arr);
	//	echo $this->db->last_query(); die;
		return true;
	}
	public function addnewaddress($data,$custID){
		$arr = array(
			'city_id'=>$data['city_id'],
			'locality_id'=>$data['custLocality'],
			'address'=>$data['newaddress'],
			'pincode'=>$data['pincode'],
		);
		if(!isset($data['pincode'])){
			unset($arr['pincode']);
		}
		$this->db->update('customer',$arr,array('id_customer'=>$custID));
		
			
			$this->db->select('*');
			$this->db->from('customer');	
			$this->db->where('id_customer',$custID);	
			$query = $this->db->get();
			$row = $query->result_array();
			
			$this->db->select('city.city_name,city_detail.delivery_days,city_detail.delivery_charges');
			$this->db->from('city');	
			$this->db->join('city_detail','city.city_id=city_detail.city_id');	
			$this->db->where('city.city_id',$data['city_id']);	
			$query = $this->db->get();
			$city = $query->result_array();
			
			$this->db->select('*');
			$this->db->from('city_locality');	
			$this->db->where('city_locality_id',$data['custLocality']);	
			$query = $this->db->get();
			$localitydata = $query->result_array();
			
			$arr['customer_locality_name'] = $localitydata[0]['city_locality_name'];
			$arr['cityname'] = $city[0]['city_name'];
			$arr['delivery_days'] = $city[0]['delivery_days'];
			$arr['delivery_charges'] = $city[0]['delivery_charges'];
			
			$arrr['customer_city_id'] = $arr['city_id'];
			$arrr['customer_locality_id'] = $arr['locality_id'];
			$arrr['customer_locality_name'] = $localitydata[0]['city_locality_name'];
			$arrr['customer_address'] = $arr['address'];
			$arrr['customer_pincode'] = $data['pincode'];
			$arrr['customer_id'] = $custID;
			$query = $this->db->insert('customer_address',$arrr);
			
			return $arr;
		
	}
	public function addtofav($custID){
		$this->db->select('*');
		$this->db->from('customer_fav');	
		$this->db->where('fav_customer_id',$custID);	
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() > 0){ 
			$row = $query->result_array();
			return $row;			
		}else			
			return false;
	}
	public function productDeatils($prodId){
		$this->db->select('*');
		$this->db->from('products');	
		$this->db->where('product_id',$prodId);	
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		if ($query->num_rows() > 0){ 
			$row = $query->result_array();
			return $row;			
		}else			
			return false;
	}
	public function useroffers($customer_id = Null){
		$this->db->select('*');
		$this->db->from('coupan');
		$this->db->where('coupan_status','1');
		$this->db->where('valide_to >', date('Y-m-d'));
		$this->db->order_by('coupan_id', 'asc');
		
		if($customer_id){
			$this->db->where('customer_id',$customer_id);	
		}
		$query = $this->db->get();
		if ($query->num_rows() > 0){ 
			$row = $query->result_array();
			return $row;			
		}else			
			return false;
	}
	public function getfeedback(){
		$this->db->select('*');
		$this->db->from('feedback f');
		$this->db->join('city c','f.city_id = c.city_id');
		$this->db->order_by('feedback_id','desc');			
		$this->db->where('fd_state','1');			
		$this->db->limit(40);			
		$query = $this->db->get();
		if ($query->num_rows() > 0){ 
			$row = $query->result_array();
			return $row;			
		}else			
			return false;
	}
	public function createFav($custID,$prodJson){
		$arr = array(
			'fav_customer_id'=>$custID,
			'fav_content'=>$prodJson,
		); 
		$this->db->insert('customer_fav',$arr);
		return $this->db->insert_id();
		
	}
	public function updateFav($custID,$prodJson){
		$arr = array(
			'fav_content'=>$prodJson,
		); 
		$this->db->where('fav_customer_id',$custID);
		$this->db->update('customer_fav',$arr);
		return true;
		
	}
	public function updatetoken($data){
		$this->db->where('id_customer', $data['UserId']);
		$updateData['customer_token_id'] = ($data['DeviceToken']);
		$query = $this->db->update('customer',$updateData);
			return true;
	}
	public function checkCurrentPass($data) {
		$this->db->select('*');
        $this->db->from('customer c');
		$this->db->where('id_customer', $data['UserId']);
		$this->db->where('password', md5($data['CurrentPassword']));
        $query = $this->db->get();
	//		echo $this->db->last_query(); die;
		if($query->num_rows()){
			$row = $query->result_array();
			return $row;	
		}
		else{
			return false;
		}
    }		
	public function updatePassword($data){
		$this->db->where('id_customer', $data['UserId']);
		$this->db->where('password', md5($data['CurrentPassword']));
		$updateData['password'] = md5($data['NewPassword']);
		$query = $this->db->update('customer',$updateData);
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}			
	public function updateDeliveryPreferences($data,$cusId){
		$this->db->where('id_customer', $cusId);
		$updateData['pickup_point'] = $data['pickup_point'];
		$updateData['pickup_point_details']=$data['pickup_point_details'];
		$updateData['delivery_preferences'] = json_encode(
			array(
				'time'=>$data['time'],
				'deliverythrough'=>$data['deliverythrough'],
				'comment'=>$data['comment'],
			)
		);
		$query = $this->db->update('customer',$updateData);
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}
	
	 public function getUserDetailsByOrderCutomerId($data){
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->join('customer','orders.customer_id = customer.id_customer','left');		 		
		$this->db->where('customer.id_customer',$data['customerId']);
		$this->db->where('orders.order_id',$data['orderId']);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}	
	 public function getCities(){
		$this->db->select('*');
		$this->db->from('city');
		$this->db->where('parent_id !=','0');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}
	 public function deleteCustomerAddress($data){
		$this->db->where('customer_id', $data['userId']);
		$this->db->where('address_id', $data['addressId']);
		$this->db->delete('customer_address');
		if($this->db->affected_rows()){
			return true;
		}else{
			return false;
		}
	}
		
	 public function checkPrasukMemberValid($customerId){
		$this->db->select('*');
		$this->db->from('subscription');
		$this->db->where('customer_id',$customerId);
		$this->db->where('subscription_valid_date >=',date('Y-m-d H:i:s'));
		$this->db->order_by('subscription_id','desc');
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows()){
			$result = $query->result_array();
			return 1;
		}else{
			return false;
		}
	}
	 public function getgallery(){
		$this->db->select('*');
		$this->db->from('gallery_managment');
		$this->db->where('gallery_status','1'); 
		$this->db->order_by('gallery_id','desc');	 
		$query = $this->db->get();
		if($query->num_rows()){
			$result = $query->result_array();
			return $result;
		}else{
			return false;
		}
	}
	public function emailSubscribe($emailid){
	    
		date_default_timezone_set('Asia/Kolkata');
		$userTable = array(
					'email_id'=>$emailid, 
					'email_subscription_created_date'=>date('Y-m-d H:i:s'), 
			);
		$query = $this->db->insert('email_subscription',$userTable);
		$inserted_Id = $this->db->insert_id();
		return $inserted_Id;
	}
	public function getnewscategory(){
		$this->db->select('*');
        $this->db->from('blog_category b');
		$this->db->where('cat_status','1');	
        $query = $this->db->get();
		$res = $query->result_array();
		if($query->num_rows()){
			return $res;
		}
		else{
			return false;
		}
    }
	public function getnews(){
		$this->db->select('*');
        $this->db->from('blogs');
		$this->db->where('blog_status', '1');
        $query = $this->db->get();
		$res = $query->result_array();
		return $res;
	}
	public function createTable($SQL){
		$res = $this->db->query($SQL);
		return $res;
	}
}
?>