<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends MX_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model('Usermodel');
		$this->load->model('Productsmodel');
		$this->load->model('Ordermodel');
		$this->load->library('session');
    }
	//registration
	public function registration(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['FullName'] =  $this->input->post('FullName', TRUE);
			$inputData['LastName'] =  $this->input->post('LastName', TRUE);
			$inputData['MobileNo'] =  $this->input->post('MobileNo', TRUE);
			$inputData['Email'] =  $this->input->post('Email', TRUE);
			$inputData['Password'] =  $this->input->post('Password', TRUE);			
			$inputData['city_id'] =  $this->input->post('city_id', TRUE);	
			$inputData['custLocality'] =  $this->input->post('custLocality', TRUE);	
			$inputData['pincode'] =  '';//$this->input->post('pincode', TRUE);	
			$inputData['newaddress'] =  $this->input->post('newaddress', TRUE);	
			$inputData['tryfree'] =  $this->input->post('tryfree', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['FullName'] && !empty($input_data)){
				$inputData['FullName'] = $input_data['FullName'];
			}
			if(!$inputData['LastName'] && !empty($input_data)){
				$inputData['LastName'] = $input_data['LastName'];
			}
			if(!$inputData['MobileNo'] && !empty($input_data)){
				$inputData['MobileNo'] = $input_data['MobileNo'];
			}
			if(!$inputData['Email'] && !empty($input_data)){
				$inputData['Email'] = $input_data['Email'];
			}
			if(!$inputData['Password'] && !empty($input_data)){ 
				$inputData['Password'] = $input_data['Password'];
			}
		 	if(!$inputData['city_id'] && !empty($input_data)){
				$inputData['city_id'] = $input_data['city_id'];
			}
		 	if(!$inputData['custLocality'] && !empty($input_data)){
				$inputData['custLocality'] = $input_data['custLocality'];
			}
			 
		 	if(!$inputData['pincode'] && !empty($input_data)){
				$inputData['pincode'] = $input_data['pincode'];
			} 
		 	if(!$inputData['newaddress'] && !empty($input_data)){
				$inputData['newaddress'] = $input_data['newaddress'];
			}
		 	if(!$inputData['tryfree'] && !empty($input_data)){
				$inputData['tryfree'] = $input_data['tryfree'];
			}
		//	echo "<pre>"; print_r($inputData); die;
			if($inputData['FullName'] && $inputData['MobileNo'] && $inputData['Email'] && $inputData['Password'] && $inputData['city_id'] && $inputData['custLocality'] && $inputData['newaddress']){
				if(!$msg = $this->Usermodel->isMobileOrEmailExist($inputData['MobileNo'],$inputData['Email'])){
					$userDetail=$this->Usermodel->userRegistration($inputData);
					if($userDetail){
						
						$userData=$this->Usermodel->userLogin2($user_id = $userDetail);							
						$cityDetails=$this->Usermodel->getCityDetails($userData[0]['city_id']);
						if($cityDetails){
							$delivery_days=$cityDetails[0]['delivery_days'];
							$delivery_charges=$cityDetails[0]['delivery_charges'];
						}else{
							$delivery_charges = '';
							$delivery_days='';
						}
						
						$config['charset'] = 'utf-8';
						$config['wordwrap'] = TRUE;
						$config['mailtype'] = 'html';
						$this->email->initialize($config);
						
						if($inputData['tryfree'] == 'tryfree'){
							$p =0;
							$data[$p]['id'] = 165;
								$o = $this->Ordermodel->productlistfree($data[$p]['id']);
							//	echo "<pre>"; print_r($o); die;
										$cartData[$p]['subtotal'] = 1;
										$productTotal =  0; 
										$cartData[$p]['specialdiscount'] = 0;											 											
										$percentagePrice = 0;
										$cartData[$p]['gstprice'] = round($percentagePrice,2);
										$productTotal =  $productTotal + $percentagePrice;
										
										if($o[0]['packing_type'] == 'jar'){
											$jar = 1;
										}elseif($o[0]['packing_type'] == 'bag'){
											$bag = 1;
										}
										$grandTotal = $productTotal;									
										$data[$p]['img'] = $o[0]['product_icon'];
										$data[$p]['unit'] =$o[0]['product_weight_unit'];
										$data[$p]['unittype'] =$o[0]['product_unit_type'];
										$cartData[$p]['productjson'] = '';
										 
										$cartData[$p]['name'] =  ucfirst($o[0]['product_name']); 
										if($o[0]['product_unit_type'] == 'weight'){
												$cartData[$p]['qty'] = 1; 
												$cartData[$p]['unitprice'] = 1;
												$qty = 1;
												$price = 1;
												$units = 0;
												$cartData[$p]['actualUnitPrice'] = $price;
												$total = 1;
												$cartData[$p]['price'] = $total;
												
									
										}elseif($o[0]['product_unit_type'] == 'per piece'){								
												$cartData[$p]['qty'] = 1; 
												$cartData[$p]['unitprice'] =1;
												$qty = 1;
												$price = 1;
												$units = 0;
												$cartData[$p]['actualUnitPrice'] = $price;
												$total = 1;
												$cartData[$p]['price'] = $total;
										
										}elseif($o[0]['product_unit_type'] == 'drink'){								
												$cartData[$p]['qty'] = 1; 
												$cartData[$p]['unitprice'] = 1;
												$qty = 1;
												$price = 1;
												$units = 0;
												$cartData[$p]['actualUnitPrice'] = $price;
												$total = 1;
												$cartData[$p]['price'] = $total;
										
										}
										$cartData[$p]['icon'] = $o[0]['product_icon'];
										$cartData[$p]['type'] = '';
										$cartData[$p]['id'] = $data[$p]['id'];
								$dataa = array(
									'customer_id'=>$user_id,
									'city_id'=>$inputData['city_id'],
									'state_id'=>$cityDetails[0]['parent_id'],
									'pincode'=>$inputData['pincode'],
									'city_locality_id'=>$inputData['custLocality'],
									'customer_name'=>$inputData['FullName'].' '.$inputData['LastName'],
									'delivery_address'=>$inputData['newaddress'],
									'delivery_date'=>date('Y-m-d H:i'),
									'contact_number'=>$inputData['MobileNo'],
									'order_details'=>json_encode($cartData),
									'purchase_price'=>1,
									'discount_price'=>0,
									'delivery_price'=>0,
									'jar_price'=>0,
									'bag_price'=>0,
									'jar_qty'=>0,
									'bag_qty'=>1,
									'is_free'=>1,
									'order_frequency'=>$this->session->userdata('boxfrequencyselect'),
								);
							$res = $this->Ordermodel->addorder($dataa);
							$dataa['orderid'] = $res;
							$to= $inputData['Email'];
							$subject="Thank you for placing an order with Prasuk Farms";
							$message = $this->load->view('email/free-samples',$dataa,TRUE);
							sendMail($to, $subject, $message,'','info@prasukorganics.in');
						}
					
						$result['Success'] = "TRUE";
						$result['Message'] = 'Signup successfully and password send to your email id';
						$result['Result'] = array(); 
 
						

						$to= $inputData['Email'];
						$subject="Thank You for Committing to Organic Living with Prasuk";
						$message = $this->load->view('email/registration',$inputData,TRUE);
						sendMail($to, $subject, $message,'','info@prasukorganics.in');
						
						$mobileNo = $inputData['MobileNo'];
						$msg = 'Hi '.$inputData['FullName'].' '.$inputData['LastName'].', we appreciate your commitment to organic living with Prasuk Farms, you are now a part of Community Supported Agriculture, so welcome to your farm at Prasuk. We look forward to sending you healthy, organic foods at the best prices. '.base_url().'myaccount click here to make changes to your account or view your order history. Lets Commit to Organic Warm Regards, Prasuk Farms.';
						$smsText = str_replace(" ","%20",$msg);
						sendSMS($mobileNo,$smsText);
						
						$sessionData = array(
							'username'=>$inputData['MobileNo'],
							'userid'=>$userDetail,
							'firstname'=>$inputData['FullName'],
							'lastname'=>$inputData['LastName'],
							'password'=>$inputData['Password'],
							'city_id'=>$userData[0]['city_id'],
							'prasukmember'=>$this->Usermodel->checkPrasukMemberValid($userDetail),
							'delivery_days'=>$delivery_days,
							'delivery_charges'=>$delivery_charges,
							'welcome_back'=>true,
						);
						$this->session->set_userdata($sessionData);
						
						if($update = $this->Usermodel->addnewaddress($inputData,$userid = $userDetail)){
							$sessionData = array(
								'city_id'=>$inputData['city_id'],
								'delivery_days'=>$update['delivery_days'], 
								'delivery_charges'=>$update['delivery_charges'],
								'city_name'=>$update['cityname'],
							);
							$this->session->set_userdata($sessionData);
						}
						die(json_encode($result));
					}
					else{
						$result['Success'] = "FALSE";
						$result['Message'] = "Registration Failed";
						$result['Result'] = array();
						die(json_encode($result));	
					} 
				}else{
						$result['Success'] = "FALSE";
						$result['Message'] = $msg;
						$result['Result'] = array();
						die(json_encode($result));	
				}
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Invalid resquest';
				die(json_encode($result));	
			}
	}
	//login
	public function login(){		
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['MobileNo'] =  $this->input->post('MobileNo', TRUE);
			$inputData['Password'] =  $this->input->post('Password', TRUE);		
			$input_data = json_decode($json, TRUE);
			if(!$inputData['MobileNo'] && !empty($input_data)){
				$inputData['MobileNo'] = $input_data['MobileNo'];
			}if(!$inputData['Password'] && !empty($input_data)){
				$inputData['Password'] = $input_data['Password'];
			}
			if(!empty($inputData['MobileNo']) && !empty($inputData['Password'])){				
					$userDetail=$this->Usermodel->userLogin($inputData);
				 	if($userDetail){
						$cityDetails=$this->Usermodel->getCityDetails($userDetail[0]['city_id']);
					 	if(!$userDetail[0]['city_id']){ 
							$userDetail[0]['city_id'] =''; 
						}
						if(!$userDetail[0]['address']){ 
							$userDetail[0]['address'] =''; 
						}
						if(!$userDetail[0]['state_id']){ 
							$userDetail[0]['state_id'] =''; 
						}
						$sessionData = array(
							'username'=>$inputData['MobileNo'],
							'userid'=>$userDetail[0]['id_customer'],
							'firstname'=>$userDetail[0]['full_name'],
							'lastname'=>$userDetail[0]['last_name'],
							'password'=>$inputData['Password'],
							'city_id'=>$userDetail[0]['city_id'],
							'prasukmember'=>$this->Usermodel->checkPrasukMemberValid($userDetail[0]['id_customer']),
							'delivery_days'=>$cityDetails[0]['delivery_days'],
							'delivery_charges'=>$cityDetails[0]['delivery_charges'],
						);
					 	$this->session->set_userdata($sessionData);
						$result['Success'] = "TRUE";
						$result['Message'] = 'Login Redirecting';
						$result['Result'] = $userDetail;
						die(json_encode($result));
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'User Name or password is not matched!';
						$result['Result'] = array();
						die(json_encode($result));	
					}
				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Invalid request';
				die(json_encode($result));	
			}
	}
	//RepeatOrder
	public function RepeatOrdernew(){		
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['orderid'] =  $this->input->post('orderid', TRUE);
			$inputData['deliveryday'] =  $this->input->post('deliveryday', TRUE);
			$input_data = json_decode($json, TRUE);
			if(!$inputData['orderid'] && !empty($input_data)){
				$inputData['orderid'] = $input_data['orderid'];
			}
			if(!$inputData['deliveryday'] && !empty($input_data)){
				$inputData['deliveryday'] = $input_data['deliveryday'];
			}
			$inputData['add_quantity'] = '';
			if(!empty($inputData['orderid'])){	
					$inputData['userID'] = $this->session->userdata('userid'); 
					if($customerDetails = $this->Usermodel->checkUserId($inputData)){
						$orderDetails =$this->Usermodel->getOrderDetails($inputData);
						//	echo "<pre>"; print_r($userDetail); die;
					
						if($orderDetails){
							$details = json_decode($orderDetails[0]['order_details'],true);
							foreach($details as $key => $values){
								if(isset($values['type'])){
									$values['type'] = $values['type'] ;
								}else{
									$values['type'] = '';
								}
								if($values['type'] != 'box'){
									if($productDetails=$this->Ordermodel->productlist($values['id'])){
										if(!empty(trim($inputData['add_quantity']))){
											$qty = $inputData['add_quantity'];
											if($productDetails[0]['product_weight_unit']){
												$p = ($productDetails[0]['product_price']/$productDetails[0]['product_weight_unit']);
											}else{
												$p = ($productDetails[0]['product_price']);
											}
										}else{
											$qty = $productDetails[0]['product_weight_unit'];
											$p = ($productDetails[0]['product_price']/$productDetails[0]['product_weight_unit']);
										}
										$insert_room = array(
											'id'      => 'p'.$values['id'],
											'qty'     => $qty,
											'price'   => $p,
											'unitprice'   => $productDetails[0]['product_price'],
											'unitvalue'   => $productDetails[0]['product_weight_unit'],
											'gstprice'   => $productDetails[0]['product_gst_tax'],
											'type'   => $values['type'],
											'productjson'   => '',
											'name'    => str_ireplace(array('!'),'',$productDetails[0]['product_name']),
										);
										$res = $this->cart->insert($insert_room);
										
										 
										
										$result['Success'] = "TRUE";
										$result['Message'] = 'Item added successfully into cart';
										$result['RowId'] = $res;
										$result['Result'] = ''; 
									}else{
										$result['Success'] = "False";
										$result['Message'] = 'Product id is incorrect!';
										die(json_encode($result));	
									}
								}elseif($values['type'] == 'box'){
									if($package=$this->Ordermodel->packagelist($values['id'])){
										if(!empty(trim($inputData['add_quantity']))){
											$qty = $inputData['add_quantity'];
											if($package[0]['package_weight_unit']){
												$p = ($package[0]['package_price']/1);
											}else{
												$p = ($package[0]['package_price']);
											}
										}else{
											$qty = $package[0]['package_weight_unit'];
											$p = ($package[0]['package_price']/1);
										}
										$insert_room = array(
											'id'      => 'p'.$values['id'],
											'qty'     => $qty,
											'price'   => $p,
											'unitprice'   => $package[0]['package_price'],
											'unitvalue'   => $package[0]['package_weight_unit'],
											'gstprice'   => $package[0]['package_gst_tax'],
											'type'   => $values['type'],
											'productjson'   => '',
											'name'    => str_ireplace(array('!'),'',$package[0]['package_name']),
										);
										$res = $this->cart->insert($insert_room);
										 
										$result['Success'] = "TRUE";
										$result['Message'] = 'Item added successfully into cart';
										$result['RowId'] = $res;
										$result['Result'] = ''; 
									}else{
										$result['Success'] = "False";
										$result['Message'] = 'Package id is incorrect!';
										die(json_encode($result));	
									}
								}else{
									$result['Success'] = "False";
									$result['Message'] = 'Parameters are incorrect';
									die(json_encode($result));	
								}
							}
							
							$result['Success'] = "TRUE";
							$result['Message'] = 'Add to cart successfully!';
							$result['Result'] = '';
							die(json_encode($result));
						}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'Invalid order id!!';
							$result['Result'] = array();
							die(json_encode($result));
						}
						
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Invalid account details !!';
						$result['Result'] = array();
						die(json_encode($result));	
					}
				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Invalid request';
				die(json_encode($result));	
			}
	}
	
	
	public function RepeatOrder(){
		
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['orderid'] =  $this->input->post('orderid', TRUE);
			$inputData['deliveryday'] =  $this->input->post('deliveryday', TRUE);
			$input_data = json_decode($json, TRUE);
			if(!$inputData['orderid'] && !empty($input_data)){
				$inputData['orderid'] = $input_data['orderid'];
			}
			if(!$inputData['deliveryday'] && !empty($input_data)){
				$inputData['deliveryday'] = $input_data['deliveryday'];
			}
			if(!empty($inputData['orderid'])){		
					$inputData['userID'] = $this->session->userdata('userid'); 
					if($customerDetails = $this->Usermodel->checkUserId($inputData)){
						$orderDetails =$this->Usermodel->getOrderDetails($inputData);
						//	echo "<pre>"; print_r($userDetail); die;
					
						if($orderDetails){
							$dataa = array(
								'customer_id'=>$customerDetails[0]['id_customer'],
								'city_id'=>$customerDetails[0]['city_id'],
								'customer_name'=>$customerDetails[0]['full_name'].' '.$customerDetails[0]['last_name'],
								'delivery_address'=>$customerDetails[0]['address'],
								'delivery_date'=>date('Y-m-d H:i',strtotime($inputData['deliveryday'])),
								'contact_number'=>$customerDetails[0]['mobile_no'],
								'order_details'=>$orderDetails[0]['order_details'],
								'purchase_price'=>$orderDetails[0]['purchase_price'],
								'discount_price'=>'0',
							);
							
								$res = $this->Ordermodel->addorder($dataa);
							
								$config['charset'] = 'utf-8';
								$config['wordwrap'] = TRUE;
								$config['mailtype'] = 'html';
								$this->email->initialize($config);
								$dataa['full_name'] = $dataa['customer_name'];
								$dataa['order_id'] = $res;
								$dataa['order_date'] = date('d M, Y');
								$dataa['mobile_no'] = $dataa['contact_number'];
								$dataa['city_name'] = $customerDetails[0]['city_name'];
								$dataa['city_state'] = '';//$customerDetails[0]['city_state'];
								$dataa['pincode'] = $customerDetails[0]['pincode'];
								$dataa['city_locality_name'] = $customerDetails[0]['city_locality_name'];
								$dataa['mode'] = 'Cash';
								$dataa['email'] = $customerDetails[0]['email_id'];
								$dataa['Delivery'] =  deliveryRate();
								$to = $dataa['email'];
								$subject="Thank you for placing an order with Prasuk Farms";
								$message = $this->load->view('email/emailorder.php',$dataa,TRUE);							
							//	echo $message; die;
								sendMail($to, $subject, $message,'','order@prasukorganics.in');
								$sessionData = array(
									'discount_amount'=>0,
									'GrandTotal'=>0,
									'CouponCode'=>'',
								);
								$order_details = json_decode($orderDetails[0]['order_details'],true);
									$i=0;$pN='';
									foreach($order_details as $plist)
									{
										if($i==0){
											$pN .= ucfirst($plist['name']).' ';
										}
										else{
											$pN .= ', '.ucfirst($plist['name']);
										}
									
										$i++;
									}
							$this->session->set_userdata($sessionData);
							$this->cart->destroy();
							$dataa['order_details'] =$pN ;
							$result['Success'] = "TRUE";
							$result['Message'] = 'Order created successfully!';
							$result['Result'] = $dataa;
							die(json_encode($result));
						}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'Invalid order id!!';
							$result['Result'] = array();
							die(json_encode($result));
						}
						
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Invalid account details !!';
						$result['Result'] = array();
						die(json_encode($result));	
					}
				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Invalid request';
				die(json_encode($result));	
			}
	}
	//updateProfile
	public function updateProfile(){
		
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['custname'] =  $this->input->post('custname', TRUE);
			$inputData['custmobile'] =  $this->input->post('custmobile', TRUE);		
			$inputData['custemail'] =  $this->input->post('custemail', TRUE);		
			$inputData['custDOB'] =  $this->input->post('custDOB', TRUE);		
			$inputData['custAdd'] =  $this->input->post('custAdd', TRUE);		
			$inputData['custlastname'] =  $this->input->post('custlastname', TRUE);		
			$inputData['custCity'] =  $this->input->post('custCity', TRUE);		
			$inputData['custPincode'] =  $this->input->post('custPincode', TRUE);		
			$inputData['custLocality'] =  $this->input->post('custLocality', TRUE);		
			$inputData['userId'] =  $this->input->post('userId', TRUE);		
			$input_data = json_decode($json, TRUE);
			if(!$inputData['custname'] && !empty($input_data)){
				$inputData['custname'] = $input_data['custname'];
			}
			if(!$inputData['custmobile'] && !empty($input_data)){
				$inputData['custmobile'] = $input_data['custmobile'];
			}
			if(!$inputData['custemail'] && !empty($input_data)){
				$inputData['custemail'] = $input_data['custemail'];
			}
			if(!$inputData['custDOB'] && !empty($input_data)){
				$inputData['custDOB'] = $input_data['custDOB'];
			}
			if(!$inputData['custAdd'] && !empty($input_data)){
				$inputData['custAdd'] = $input_data['custAdd'];
			}
			if(!$inputData['custlastname'] && !empty($input_data)){
				$inputData['custlastname'] = $input_data['custlastname'];
			}
			if(!$inputData['custPincode'] && !empty($input_data)){
				$inputData['custPincode'] = $input_data['custPincode'];
			}
			if(!$inputData['custCity'] && !empty($input_data)){
				$inputData['custCity'] = $input_data['custCity'];
			}
			if(!$inputData['custLocality'] && !empty($input_data)){
				$inputData['custLocality'] = $input_data['custLocality'];
			}
			if(!$inputData['userId'] && !empty($input_data)){
				$inputData['userId'] = $input_data['userId'];
			}
			if(!empty($inputData['custname']) && !empty($inputData['custmobile']) && !empty($inputData['custemail']) && !empty($inputData['custAdd'])){
				if($inputData['userId']){
					$sessionUserId['userID'] = $inputData['userId'];
				}else{
					$sessionUserId['userID'] = $this->session->userdata('userid');
				}				
				if($sessionUserId['userID']){
					if($userDetail=$this->Usermodel->checkUserId($sessionUserId)){
						if(!$msg = $this->Usermodel->isMobileOrEmailExist2($inputData['custmobile'],$inputData['custemail'],$sessionUserId['userID'])){
							if($update = $this->Usermodel->updateProfile($inputData,$sessionUserId['userID'])){								
								$cityDetails=$this->Usermodel->getCityDetails($inputData['custCity']);
								$sessionData = array(
								'city_id'=>$inputData['custCity'],
								'delivery_days'=>$cityDetails[0]['delivery_days'],
								'delivery_charges'=>$cityDetails[0]['delivery_charges'],
							);
					//		echo "<pre>"; print_r($sessionData); die;
							$this->session->set_userdata($sessionData);
							$checkAddAlready = $this->Usermodel->checkAddAlready($inputData,$sessionUserId['userID']);
								$result['Success'] = "TRUE";
								$result['Message'] = 'Personal details updated successfully!';
								$result['Result'] = $userDetail;
								die(json_encode($result));
							}else{
								$result['Success'] = "TRUE";
								$result['Message'] = 'No changes performed in personal details!';
								$result['Result'] = array();
								die(json_encode($result));	
							}
						}else{
								$result['Success'] = "FALSE";
								$result['Message'] = $msg;
								$result['Result'] = array();
								die(json_encode($result));	
						}
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Invalid account details !!';
						$result['Result'] = array();
						die(json_encode($result));	
					}
				}else{
					$result['Success'] = "FALSE";
					$result['Message'] = 'Login first!';
					die(json_encode($result));	
				}
				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = 'Parameters are incorrect';
			die(json_encode($result));	
		}
				
		
	}
	//myaccount
	public function myaccount(){
		
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['myAccount'] =  $this->input->post('myAccount', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['myAccount'] && !empty($input_data)){
				$inputData['myAccount'] = $input_data['myAccount'];
			}
			if($inputData['myAccount']=='myAccount'){
				if($sessionUserId['userID'] = $this->session->userdata('userid')){
					if($userDetail=$this->Usermodel->checkUserId($sessionUserId)){
					//	echo "<pre>"; print_r($userDetail); die;
						$pN = '';$grandTotal = 0; 
						if($userDetail){
							$res['personalDetails'] = $userDetail[0];							
							$res['personalDetails']['delivery_preferences'] = json_decode($userDetail[0]['delivery_preferences'],true);							
							if( $userDetail[0]['city_id']){							
							$ress = $this->Usermodel->getLocality($userDetail[0]['city_id']);
							$y ='';
								if($ress){
									$y .= '<select  class="form-control" id="custLocality">';
									foreach($ress as $list){				
										$y.= '<option value="'.$list['city_locality_id'].'">'.ucfirst($list['city_locality_name']).' </option>';
									}			
									$y.=  '</select>';
								}else{
									$y.=  '<select  class="form-control" id="custLocality">';
										
										$y.=  '<option value="">---Select Locality---</option>';
											
									$y.=  '</select>';
								}
								$res['Localities'] =$y;
							}else{
								$res['Localities'] = '';
							}
							$res['orderHistory'] = $this->Usermodel->orderHistory($sessionUserId['userID']);
							if($res['orderHistory']){
								foreach($res['orderHistory'] as $okey => $olist){
									$order_details = json_decode($olist['order_details'],true);
									$i=0;
									foreach($order_details as $plist)
									{
										if($i==0){
										$pN .= ucfirst($plist['name']).'';
										}
										else{
										$pN .= ', '.ucfirst($plist['name']);
										} 
										//$pN .= ''.ucfirst($plist['name']).', ';
										$i++;
									}
									$res['orderHistory'][$okey]['order_details'] = $pN; 
									$pN = '';
									$d = date('d',strtotime($olist['order_date_time'])); 
									$res['orderHistory'][$okey]['order_date_time'] =$d.' '.date('M, Y',strtotime($olist['order_date_time'])); 
									$res['orderHistory'][$okey]['delivery_date_f_s'] = date('D, d M',strtotime($olist['delivery_date'])); 
								}
							}
							$res['nextDelievery'] = $this->Usermodel->nextDelievery($sessionUserId['userID']);
							$pND = '';
							if($res['nextDelievery']){
								foreach($res['nextDelievery'] as $okey => $olist){
									$order_details = json_decode($olist['order_details'],true);
									$i=0; 
									foreach($order_details as $plist)
									{
										if($i==0){
											$pND .= ucfirst($plist['name']).'';
										}
										else{ 
											$pND .= ', '.ucfirst($plist['name']);
										} 
										
										//	$pND .= ucfirst($plist['name']).', ';
										
										
									
										$i++;
									}
									$i =0;
									$res['nextDelievery'][$okey]['order_details'] = $pND; 
									$pND = '';
									$d = date('d',strtotime($olist['order_date_time'])); 
									$res['nextDelievery'][$okey]['order_date_time'] =$d.' '.date('M, Y',strtotime($olist['order_date_time'])); 
									$res['nextDelievery'][$okey]['delivery_date_f_s'] = date('D, d M',strtotime($olist['delivery_date'])); 
									$res['nextDelievery'][$okey]['purchase_price'] = ($olist['purchase_price'] +  $olist['delivery_price']) - $olist['discount_price']; 
									$res['nextDelievery'][$okey]['IsShowCancel'] = validateCancel(strtotime($olist['delivery_date'])); 
								}
							}
							$res['transactions'] = $this->Usermodel->transactionsHistory($sessionUserId['userID']);
							if($res['transactions']){
								foreach($res['transactions'] as $okey => $olist){
									$res['transactions'][$okey]['created_date'] =  date('D, d M h:iA',strtotime($olist['created_date'])); 
								}
							}
							$userData = $sessionUserId['userID'];
							if($userData){
								$favData = $this->Productsmodel->addtofav($userData);
								if($favData){
									$favProds = array_values(json_decode($favData[0]['fav_content'],true));
									if($favProds){
										foreach($favProds as $keys => $flist){
											$productDeatils = $this->Usermodel->productDeatils($flist);
											$res['favProd'][$keys]['img'] = base_url().'upload/'.$productDeatils[0]['product_icon']; 
											$res['favProd'][$keys]['name'] = ucfirst($productDeatils[0]['product_name']); 
											$res['favProd'][$keys]['id'] =$flist;
											$res['favProd'][$keys]['url'] =$productDeatils[0]['product_url'];
										}
									}else{
										$res['favProd'] = '';
									}
									
								}else{
									$res['favProd'] = '';
								}
							}else{
								$res['favProd'] = '';
							}
							$res['customerAddresses'] = $this->Usermodel->customerAddresses($sessionUserId['userID']);
							$result['Success'] = "TRUE";
							$result['Message'] = 'User Log-In';
							$result['Result'] = $res;
							die(json_encode($result));
						}else{
							$result['Success'] = "FALSE"; 
							$result['Message'] = 'Invalid account details !!';
							$result['Result'] = array();
							die(json_encode($result));	
						}
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Invalid user id!';
						die(json_encode($result));	
					}
				}else{
					$result['Success'] = "FALSE";
					$result['Message'] = 'Login first!';
					die(json_encode($result));	
				}
				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Invalid request';
				die(json_encode($result));	
			}
	}
	//forgot password
	/* public function forgotpassword(){
		$json = trim(file_get_contents('php://input'));
			if(!empty($json)){
				$inputData['MobileNo'] =  $this->input->post('MobileNo', TRUE);
				$input_data = json_decode($json, TRUE);
				
				if(!$inputData['MobileNo'] && !empty($input_data)){
					$inputData['MobileNo'] = $input_data['MobileNo'];
				}	
				if(!empty($inputData['MobileNo'])){
					if($userDetail=$this->Usermodel->checkUserMobile($inputData['MobileNo'])){					
						 		$randkey = rand(10000000,99999999);
								$inputData['Password'] = $randkey;
								if($updatePass = $this->Usermodel->updateUserPass($inputData)){
									$data['Password'] = $randkey;
									$data['FullName'] = $userDetail[0]['full_name'];
									$data['LastName'] = $userDetail[0]['last_name'];
									$config['charset'] = 'utf-8';
									$config['wordwrap'] = TRUE;
									$config['mailtype'] = 'html';
									$this->email->initialize($config);
									$to= $userDetail[0]['email_id'];
									$subject="Prasuk Organic - forgot password";
									$message = $this->load->view('email/send_password_to_customer',$data,TRUE);
									sendMail($to, $subject, $message,'','customercare@prasukorganics.in');
									$result['Success'] = "TRUE";
									$result['Message'] = 'New password sent to your email ID.';
									$result['Result'] = array();
								}else{
										
									$result['Success'] = "FALSE";
									$result['Message'] = 'Failed to update password, try again';
									$result['Result'] = array();
								}
								die(json_encode($result));
				 
						
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Your mobile number does not exsist.';
						$result['Result'] = array();
						die(json_encode($result));	
					}
				}else{
					$result['Success'] = "FALSE";
					$result['Message'] = 'Incorrect data input';
					$result['Result'] = array();
					die(json_encode($result));	
				}
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Incorrect parameter';
				$result['Result'] = array();
				die(json_encode($result));	
			}
	} */
	public function forgotpassword(){
		$json = trim(file_get_contents('php://input'));
			if(!empty($json)){
				$inputData['MobileNo'] =  $this->input->post('MobileNo', TRUE);
				$input_data = json_decode($json, TRUE);
				
				if(!$inputData['MobileNo'] && !empty($input_data)){
					$inputData['MobileNo'] = $input_data['MobileNo'];
				}	
				if(!empty($inputData['MobileNo'])){
					if($userDetail=$this->Usermodel->checkUserMobile($inputData['MobileNo'])){					
						 		$randkey = rand(10000000,99999999);
								$inputData['Password'] = $randkey;
								$inputData['MobileNo'] = $userDetail[0]['email_id'];
								if($updatePass = $this->Usermodel->updateUserPass($inputData)){
									$data['Password'] = $randkey;
									$data['FullName'] = $userDetail[0]['full_name'];
									$data['LastName'] = $userDetail[0]['last_name'];
									$config['charset'] = 'utf-8';
									$config['wordwrap'] = TRUE;
									$config['mailtype'] = 'html';
									$this->email->initialize($config);
									$to= $userDetail[0]['email_id'];
									$subject="Prasuk Organic - forgot password";
									$message = $this->load->view('email/send_password_to_customer',$data,TRUE);
									sendMail($to, $subject, $message,'','customercare@prasukorganics.in');
									$result['Success'] = "TRUE";
									$result['Message'] = 'New password sent to your email ID!';
									$result['Result'] = array();
								}else{
										
									$result['Success'] = "FALSE";
									$result['Message'] = 'Failed to send password, try again!';
									$result['Result'] = array();
								}
								die(json_encode($result));
							 
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'User Name is not exist!';
						$result['Result'] = array();
						die(json_encode($result));	
					}
				}else{
					$result['Success'] = "FALSE";
					$result['Message'] = 'Incorrect data input';
					$result['Result'] = array();
					die(json_encode($result));	
				}
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Incorrect parameter';
				$result['Result'] = array();
				die(json_encode($result));	
			}
	}
	//list categories
	public function categorylist(){
		
		if($categoryList = $this->Usermodel->categoryList()){
			$result['Success'] = "TRUE";
			$result['Message'] = 'Category List.';
			$result['Result'] = $categoryList;
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = 'No category list found.';
			$result['Result'] = array();
		}
		die(json_encode($result));
		
	}
	//addtofov
	public function addtofav(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['productid'] =  $this->input->post('productid', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['productid'] && !empty($input_data)){
				$inputData['productid'] = $input_data['productid'];
			}
			if(!empty($inputData['productid'])){			
				if($userid=$this->session->userdata('userid')){
					
						$addtofov = $this->Usermodel->addtofav($userid);
						if(!$addtofov){				
							$prodJson = array($inputData['productid']);
							$createFav = $this->Usermodel->createFav($userid,json_encode($prodJson));
							if($createFav){
								$result['Success'] = "TRUE";
								$result['Message'] = 'Product added as favourite!';
								$result['Result'] = '';
								$result['Type'] = 'add';
							}else{
								$result['Success'] = "FALSE";
								$result['Message'] = 'Some thing want wrong try again!';
							}
								die(json_encode($result));							
						}else{
							$prodJson = json_decode($addtofov[0]['fav_content'],true);
							$newProd = ($inputData['productid']);
							if(in_array($newProd,$prodJson)){
								if(($key = array_search($newProd, $prodJson)) !== false){
									unset($prodJson[$key]);
								}
								//echo "<pre>"; print_r($prodJson); die;
								$createFav = $this->Usermodel->updateFav($userid,json_encode($prodJson));
								$result['Success'] = "TRUE";
								$result['Message'] = 'Product removed from favourite!';
								$result['Result'] = '';
								$result['Type'] = 'remove';
							}else{
								$prodJson = array_merge($prodJson,array($newProd)); 
								$createFav = $this->Usermodel->updateFav($userid,json_encode($prodJson));
								$result['Success'] = "TRUE";
								$result['Message'] = 'Product added as favourite!';
								$result['Result'] = '';
								$result['Type'] = 'add';
							}
							
								die(json_encode($result));			
						}
					
				}else{
					$result['Success'] = "FALSE";
					$result['Message'] = 'Please login first!';
					die(json_encode($result));	
				}				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Unable to proceed!';
				die(json_encode($result));	
			}
		
	} 
	//addtofovMobileAPI
	public function addtofavapi(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['productid'] =  $this->input->post('productid', TRUE);	
			$inputData['userId'] =  $this->input->post('userId', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['productid'] && !empty($input_data)){
				$inputData['productid'] = $input_data['productid'];
			}
			if(!$inputData['userId'] && !empty($input_data)){
				$inputData['userId'] = $input_data['userId'];
			}
			if(!empty($inputData['productid'])&&!empty($inputData['userId'])){			
				if($userid=$inputData['userId']){
					
						$addtofov = $this->Usermodel->addtofav($userid);
						if(!$addtofov){				
							$prodJson = array($inputData['productid']);
							$createFav = $this->Usermodel->createFav($userid,json_encode($prodJson));
							if($createFav){
								$result['Success'] = "TRUE";
								$result['Message'] = 'Product added as favourite!';
								$result['Result'] = '';
								$result['Type'] = 'add';
							}else{
								$result['Success'] = "FALSE";
								$result['Message'] = 'Some thing want wrong try again!';
							}
								die(json_encode($result));							
						}else{
							$prodJson = json_decode($addtofov[0]['fav_content'],true);
							$newProd = ($inputData['productid']);
							if(in_array($newProd,$prodJson)){
								if(($key = array_search($newProd, $prodJson)) !== false){
									unset($prodJson[$key]);
								}
								//echo "<pre>"; print_r($prodJson); die;
								$createFav = $this->Usermodel->updateFav($userid,json_encode($prodJson));
								$result['Success'] = "TRUE";
								$result['Message'] = 'Product removed from favourite!';
								$result['Result'] = '';
								$result['Type'] = 'remove';
							}else{
								$prodJson = array_merge($prodJson,array($newProd)); 
								$createFav = $this->Usermodel->updateFav($userid,json_encode($prodJson));
								$result['Success'] = "TRUE";
								$result['Message'] = 'Product added as favourite!';
								$result['Result'] = '';
								$result['Type'] = 'add';
							}
							
								die(json_encode($result));			
						}
					
				}else{
					$result['Success'] = "FALSE";
					$result['Message'] = 'Please login first!';
					die(json_encode($result));	
				}				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Unable to proceed!';
				die(json_encode($result));	
			}
		
	} 
	//list products
	public function productlist(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['CategoryID'] =  $this->input->post('CategoryID', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['CategoryID'] && !empty($input_data)){
				$inputData['CategoryID'] = $input_data['CategoryID'];
			}
			if(!empty($inputData['CategoryID'])){				
					$res['productList']=$this->Usermodel->productlist($inputData['CategoryID']);
					if($res['productList']){
						foreach($res['productList'] as $key =>$values){
							$productAttachments = $this->Usermodel->productAttachments($values['pid']);
							foreach($productAttachments as $AD){
								$Pl[] = $AD['product_attachment'];
							}
							$res['productList'][$key]['productAttachments'] = $Pl;
						}
					}
					if($res['productList']){
						$result['Success'] = "TRUE";
						$result['Message'] = 'Category wise product list.';
						$result['Result'] = $res;
						die(json_encode($result));
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'No products found.';
						$result['Result'] = array();
						die(json_encode($result));	
					}				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}
	}
	//loadmoretransaction
	public function loadmoretransaction(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['transLimit'] =  $this->input->post('transLimit', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['transLimit'] && !empty($input_data)){
				$inputData['transLimit'] = $input_data['transLimit'];
			}
			if(!empty($inputData['transLimit'])){
					$from = $inputData['transLimit'];
					$to = $inputData['transLimit'] + 20;
					$userid = $this->session->userdata('userid');
					if($userid){
						$res['transactions']=$this->Usermodel->loadmoretransaction($from,$to,$userid);
						
						if($res['transactions']){
							foreach($res['transactions'] as $okey => $olist){
										$res['transactions'][$okey]['created_date'] = date('D, d M h:iA',strtotime($olist['created_date'])); 
									}
							$result['Success'] = "TRUE";
							$result['Message'] = 'More list.';
							$result['Result'] = $res;
							die(json_encode($result));
						}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'No list found.';
							$result['Result'] = array();
							die(json_encode($result));	
						}
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Broken link';
						die(json_encode($result));	
					}				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}
	}
	//loadmoretransaction
	public function loadmorenextdelivery(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['transLimit'] =  $this->input->post('transLimit', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['transLimit'] && !empty($input_data)){
				$inputData['transLimit'] = $input_data['transLimit'];
			}
			if(!empty($inputData['transLimit'])){
					$from = $inputData['transLimit'];
					$to = $inputData['transLimit'] + 20;
					$userid = $this->session->userdata('userid');
					if($userid){
						$res['nextDelievery']=$this->Usermodel->loadmorenextdelivery($from,$to,$userid);
						
						if($res['nextDelievery']){
								$pN = '';
							if($res['nextDelievery']){
								foreach($res['nextDelievery'] as $okey => $olist){
									$order_details = json_decode($olist['order_details'],true);
									$i=0;
									foreach($order_details as $plist)
									{
										if($i==0){
											$pN .= ucfirst($plist['name']).' ';
										}
										else{
											$pN .= ', '.ucfirst($plist['name']);
										}
									
										$i++;
									}
									$i =0;
									$res['nextDelievery'][$okey]['order_details'] = $pN; 
									$pN = '';
									$d = date('d',strtotime($olist['order_date_time'])); 
									$res['nextDelievery'][$okey]['order_date_time'] =$d.' '.date('M, Y',strtotime($olist['order_date_time'])); 
									$res['nextDelievery'][$okey]['delivery_date_f_s'] = date('D, d M',strtotime($olist['delivery_date'])); 
									$res['nextDelievery'][$okey]['purchase_price'] = ($olist['purchase_price'] +  $olist['delivery_price']) - $olist['discount_price'] ; 
								}
							}
							$result['Success'] = "TRUE";
							$result['Message'] = 'More list.';
							$result['Result'] = $res;
							die(json_encode($result));
						}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'No list found.';
							$result['Result'] = array();
							die(json_encode($result));	
						}
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Broken link';
						die(json_encode($result));	
					}				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}
	}
	//about us
	//term and conditions
	//join as former
	//city list
	public function citylist(){
		
		if($citylist = $this->Usermodel->citylist()){
			$result['Success'] = "TRUE";
			$result['Message'] = 'City List.';
			$result['Result'] = $citylist;
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = 'No City found.';
			$result['Result'] = array();
		}
		die(json_encode($result));
		
	}
	public function feedback(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['CustomerOrderId'] =  $this->input->post('CustomerOrderId', TRUE);	
			$inputData['CustomerName'] =  $this->input->post('CustomerName', TRUE);	
		//	$inputData['AllocatedDelieveryId'] =  $this->input->post('AllocatedDelieveryId', TRUE);	
			$inputData['EmailId'] =  $this->input->post('EmailId', TRUE);	
			$inputData['MoblieNo'] =  $this->input->post('MoblieNo', TRUE);	
			$inputData['CityId'] =  $this->input->post('CityId', TRUE);	
			$inputData['Message'] =  $this->input->post('Message', TRUE);	
			$inputData['Rating'] =  $this->input->post('Rating', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['CustomerOrderId'] && !empty($input_data)){
				$inputData['CustomerOrderId'] = $input_data['CustomerOrderId'];
			}
	/* 		if(!$inputData['AllocatedDelieveryId'] && !empty($input_data)){
				$inputData['AllocatedDelieveryId'] = $input_data['AllocatedDelieveryId'];
			} */
			if(!$inputData['CustomerName'] && !empty($input_data)){
				$inputData['CustomerName'] = $input_data['CustomerName'];
			}
			if(!$inputData['EmailId'] && !empty($input_data)){
				$inputData['EmailId'] = $input_data['EmailId'];
			}
			if(!$inputData['MoblieNo'] && !empty($input_data)){
				$inputData['MoblieNo'] = $input_data['MoblieNo'];
			}
			if(!$inputData['CityId'] && !empty($input_data)){
				$inputData['CityId'] = $input_data['CityId'];
			}
			if(!$inputData['Message'] && !empty($input_data)){
				$inputData['Message'] = $input_data['Message'];
			}
			if(!$inputData['Rating'] && !empty($input_data)){
				$inputData['Rating'] = $input_data['Rating'];
			}
			if(!empty($inputData['CustomerOrderId'])&& !empty($inputData['CustomerName'])&& !empty($inputData['EmailId'])&& !empty($inputData['MoblieNo'])&& !empty($inputData['CityId'])&& !empty($inputData['Message'])&& !empty($inputData['Rating'])){				
					$res=$this->Usermodel->feedback($inputData);					
					if($res){
						$result['Success'] = "TRUE";
						$result['Message'] = 'Thank you for your feedback.';
						$result['Result'] = $res;
						die(json_encode($result));
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Some thing happen wrong, please try again.';
						$result['Result'] = array();
						die(json_encode($result));	
					}				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Incorrect data input.';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Incorrect Parameters';
				die(json_encode($result));	
			}
	}
	
	public function updatetoken(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['DeviceToken'] =  $this->input->post('DeviceToken', TRUE);	
			$inputData['UserId'] =  $this->input->post('UserId', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['DeviceToken'] && !empty($input_data)){
				$inputData['DeviceToken'] = $input_data['DeviceToken'];
			}
			if(!$inputData['UserId'] && !empty($input_data)){
				$inputData['UserId'] = $input_data['UserId'];
			}
			//if(!empty($inputData['UserId'])&&!empty($inputData['DeviceToken'])){				
			if(!empty($inputData['UserId'])){				
					$res=$this->Usermodel->updatetoken($inputData);
					
					if($res){
						$result['Success'] = "TRUE";
						$result['Message'] = 'Updated.';
						$result['Result'] = $res;
						die(json_encode($result));
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'No products found.';
						$result['Result'] = array();
						die(json_encode($result));	
					}				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}
	}
	public function CancelOrder(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['orderid'] =  $this->input->post('orderid', TRUE);	
			$inputData['UserId'] = 	$userid = $this->session->userdata('userid');	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['orderid'] && !empty($input_data)){
				$inputData['orderid'] = $input_data['orderid'];
			}
			if(!$inputData['UserId'] && !empty($input_data)){
				$inputData['UserId'] = $input_data['UserId'];
			}
			if(!empty($inputData['UserId'])&&!empty($inputData['orderid'])){				
					$res=$this->Usermodel->userLogin2($inputData['UserId']);					
					if($res){
						$bookingDetails = $this->Usermodel->BookingDetailsThank($inputData['orderid'],$isStocked=1);
					//	echo "<pre>"; print_r($bookingDetails); die;
						$valCancel = validateCancel(strtotime($bookingDetails[0]['delivery_date']));
					//	echo "<pre>"; print_r($valCancel); die;
						if($valCancel){
							$cancelOrder = $this->Usermodel->CancelOrder($inputData);						 
							if($cancelOrder){ 
								$bookingDetails = $this->Usermodel->BookingDetailsThank($inputData['orderid'],$isStocked=1);
								if($bookingDetails){
									$orderDetails = json_decode($bookingDetails[0]['order_details'],true); 
									if($orderDetails){ 
										foreach($orderDetails as $key => $value){
											if($value['type'] != 'box'){							
												$result = reverseUnit($value['qty']);
												$orderDetails[$key]['qty'] = $result[0];
												if($result[1] == 'weight'){
													$qty = $orderDetails[$key]['qty']/1000; 
												}elseif($result[1] == 'drink'){
													$qty = $orderDetails[$key]['qty']/1000; 
												}elseif($result[1] == 'piece'){
													$qty = $orderDetails[$key]['qty']; 
												}
												$this->Usermodel->updateProductStock($value['id'],$qty,$action='+');
											}
										}											
								//		$bookingDetails = $this->Usermodel->UpdateBookingIsStock($orderId);
									}
								}
										
								$result['Success'] = "TRUE";
								$result['Message'] = 'Order had been Cancelled!';
								$result['Result'] = $cancelOrder;
								die(json_encode($result));
							}else{
										$result['Success'] = "FALSE";
										$result['Message'] = 'Failed to cancel try later!';
										$result['Result'] = array();
										die(json_encode($result));	
							}
						}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'Delivery date expired, you can not cancel!';
							$result['Result'] = array();
							die(json_encode($result));	
						}							
					 
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Failed to cancel try later!';
						$result['Result'] = array();
						die(json_encode($result));	
					}				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}
	}
	
	public function useroffers(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['DeviceToken'] =  $this->input->post('DeviceToken', TRUE);	
			$inputData['UserId'] =  $this->input->post('UserId', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['DeviceToken'] && !empty($input_data)){
				$inputData['DeviceToken'] = $input_data['DeviceToken'];
			}
			if(!$inputData['UserId'] && !empty($input_data)){
				$inputData['UserId'] = $input_data['UserId'];
			}
			if(!empty($inputData['UserId']) || !empty($inputData['DeviceToken'])){				
					$res=$this->Usermodel->useroffers($inputData['UserId']);
					
					if($res){
						$result['Success'] = "TRUE";
						$result['Message'] = 'Coupon List.';
						$result['Result'] = $res;
						die(json_encode($result));
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'No Coupon found.';
						$result['Result'] = array();
						die(json_encode($result));	
					}				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	public function changepassword(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['UserId'] =  $this->input->post('UserId', TRUE);	
			$inputData['CurrentPassword'] =  $this->input->post('CurrentPassword', TRUE);	
			$inputData['NewPassword'] =  $this->input->post('NewPassword', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['CurrentPassword'] && !empty($input_data)){
				$inputData['CurrentPassword'] = $input_data['CurrentPassword'];
			}
			if(!$inputData['NewPassword'] && !empty($input_data)){
				$inputData['NewPassword'] = $input_data['NewPassword'];
			}
			if(!$inputData['UserId'] && !empty($input_data)){
				$inputData['UserId'] = $input_data['UserId'];
			}
			if(empty(trim($inputData['UserId']))){
				$inputData['UserId'] = $this->session->userdata('userid');
			}
			if(!empty($inputData['UserId']) && !empty($inputData['CurrentPassword']) && !empty($inputData['NewPassword'])){						
					if($res=$this->Usermodel->checkCurrentPass($inputData)){
						if(md5($inputData['CurrentPassword']) == $res[0]['password']){
							if($update = $this->Usermodel->updatePassword($inputData)){
								$result['Success'] = "TRUE";
								$result['Message'] = 'Password Updated Successfully!';
								$result['Result'] = $update;
								die(json_encode($result));
							}else{
								$result['Success'] = "FALSE";
								$result['Message'] = 'Try new password!!!';
								$result['Result'] = array();
								die(json_encode($result));	
							}
						}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'You trying older password, try new password!!';
							$result['Result'] = array();
							die(json_encode($result));	
						}	
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Incorrect Password!!!';
						$result['Result'] = array();
						die(json_encode($result));	
					}	
								
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	public function updateDeliveryPreferences(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['time'] =  $this->input->post('time', TRUE);	
			$inputData['deliverythrough'] =  $this->input->post('deliverythrough', TRUE);	
			$inputData['comment'] =  $this->input->post('comment', TRUE);	
			$inputData['pickup_point'] =  $this->input->post('pickup_point', TRUE);	
			$inputData['pickup_point_details'] =  $this->input->post('pickup_point_details', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['time'] && !empty($input_data)){
				$inputData['time'] = $input_data['time'];
			}
			if(!$inputData['deliverythrough'] && !empty($input_data)){
				$inputData['deliverythrough'] = $input_data['deliverythrough'];
			}
			if(!$inputData['comment'] && !empty($input_data)){
				$inputData['comment'] = $input_data['comment'];
			}
			if(!$inputData['pickup_point'] && !empty($input_data)){
				$inputData['pickup_point'] = $input_data['pickup_point'];
			}
			if(!$inputData['pickup_point_details'] && !empty($input_data)){
				$inputData['pickup_point_details'] = $input_data['pickup_point_details'];
			}
			
			if(!empty($inputData['deliverythrough']) && !empty($inputData['comment'])){						
					if($userid=$this->session->userdata('userid')){
							if($update = $this->Usermodel->updateDeliveryPreferences($inputData,$userid)){
								$result['Success'] = "TRUE";
								$result['Message'] = 'Delivery Preferences Updated Successfully!';
								$result['Result'] = $update;
								die(json_encode($result));
							}else{
								$result['Success'] = "FALSE";
								$result['Message'] = 'No changes performed to update Delivery Preferences!!!';
								$result['Result'] = array();
								die(json_encode($result));	
							}
					}	
					
								
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	public function addnewaddress(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['city_id'] =  $this->input->post('city_id', TRUE);	
			$inputData['custLocality'] =  $this->input->post('custLocality', TRUE);	
			$inputData['newaddress'] =  $this->input->post('newaddress', TRUE);	
			$inputData['pincode'] =  $this->input->post('pincode', TRUE);	
			$inputData['userId'] =  $this->input->post('userId', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['city_id'] && !empty($input_data)){
				$inputData['city_id'] = $input_data['city_id'];
			}
			if(!$inputData['custLocality'] && !empty($input_data)){
				$inputData['custLocality'] = $input_data['custLocality'];
			}
			if(!$inputData['newaddress'] && !empty($input_data)){
				$inputData['newaddress'] = $input_data['newaddress'];
			}
			if(!$inputData['pincode'] && !empty($input_data)){
				$inputData['pincode'] = $input_data['pincode'];
			}
			if(!$inputData['userId'] && !empty($input_data)){
				$inputData['userId'] = $input_data['userId'];
			}
			
			if(!empty($inputData['city_id']) && !empty($inputData['custLocality']) && !empty($inputData['newaddress']) && !empty($inputData['pincode'])){
				if($inputData['userId']){
					$userid=$inputData['userId'];
				}else{
					$userid=$this->session->userdata('userid');
				}
					if($this->Usermodel->userLogin2($userid)){
						if($update = $this->Usermodel->addnewaddress($inputData,$userid)){
							$sessionData = array(
								'city_id'=>$inputData['city_id'],
								'delivery_days'=>$update['delivery_days'], 
								'delivery_charges'=>$update['delivery_charges'],
								'city_name'=>$update['cityname'],
							);
							$this->session->set_userdata($sessionData);
							$result['Success'] = "TRUE";
							$result['Message'] = 'Address added Successfully!';
							$result['Result'] = $update;
							die(json_encode($result));
						}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'Failed to add try again!!!';
							$result['Result'] = array();
							die(json_encode($result));	
						}
					}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'Invalid user id!!!';
							$result['Result'] = array();
							die(json_encode($result));	
					}	
					
								
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	
	public function submitquery(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['Fname'] =  $this->input->post('Fname', TRUE);	
			$inputData['Lname'] =  $this->input->post('Lname', TRUE);	
			$inputData['Email'] =  $this->input->post('Email', TRUE);	
			$inputData['Mobile'] =  $this->input->post('Mobile', TRUE);	
			$inputData['Query'] =  $this->input->post('Query', TRUE);	
			$inputData['type'] =  $this->input->post('type', TRUE);	
			$inputData['userid'] =  $this->input->post('userid', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['Fname'] && !empty($input_data)){
				$inputData['Fname'] = $input_data['Fname'];
			}
			if(!$inputData['Lname'] && !empty($input_data)){
				$inputData['Lname'] = $input_data['Lname'];
			}
			if(!$inputData['Email'] && !empty($input_data)){
				$inputData['Email'] = $input_data['Email'];
			}
			if(!$inputData['Mobile'] && !empty($input_data)){
				$inputData['Mobile'] = $input_data['Mobile'];
			}
			if(!$inputData['Query'] && !empty($input_data)){
				$inputData['Query'] = $input_data['Query'];
			}
			if(!$inputData['type'] && !empty($input_data)){
				$inputData['type'] = $input_data['type'];
			}
			if(!$inputData['userid'] && !empty($input_data)){
				$inputData['userid'] = $input_data['userid'];
			}
			if($this->session->userdata('userid')){
				$inputData['userid'] = $this->session->userdata('userid');
			}else{
				$inputData['userid'] = $inputData['userid'];
			}
			if(!empty($inputData['Fname']) && !empty($inputData['Lname']) && !empty($inputData['Email']) && !empty($inputData['Mobile']) && !empty($inputData['Query']) && !empty($inputData['type'])){						
							if($update = $this->Usermodel->submitquery($inputData)){
								$result['Success'] = "TRUE";
								$result['Message'] = 'Your query received successfully!';
								$result['Result'] = $update;
								
								$config['charset'] = 'utf-8';
								$config['wordwrap'] = TRUE;
								$config['mailtype'] = 'html';
								$this->email->initialize($config);

								$to= 'contactus@prasukorganics.in';
								$subject="Contact us";
								$message = $this->load->view('email/contact-us',$inputData,TRUE);
								sendMail($to, $subject, $message,'','contactus@prasukorganics.in');
								die(json_encode($result));
							}else{
								$result['Success'] = "FALSE";
								$result['Message'] = 'Internal error occured try again!!!';
								$result['Result'] = array();
								die(json_encode($result));	
							}
					
								
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	public function submitCustomerFeedback(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['FcityId'] =  $this->input->post('FcityId', TRUE);	
			$inputData['Fname'] =  $this->input->post('Fname', TRUE);	
			$inputData['Lname'] =  $this->input->post('Lname', TRUE);	
			$inputData['Email'] =  $this->input->post('Email', TRUE);	
			$inputData['Mobile'] =  $this->input->post('Mobile', TRUE);	
			$inputData['Query'] =  $this->input->post('Query', TRUE);	
			$inputData['type'] =  $this->input->post('type', TRUE);	
			$inputData['userid'] =  $this->input->post('userid', TRUE);	
			$inputData['orderid'] =  $this->input->post('orderid', TRUE);	
			$inputData['Rateproducts'] =  $this->input->post('Rateproducts', TRUE);	
			$inputData['Rateservice'] =  $this->input->post('Rateservice', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['FcityId'] && !empty($input_data)){
				$inputData['FcityId'] = $input_data['FcityId'];
			}
			if(!$inputData['Fname'] && !empty($input_data)){
				$inputData['Fname'] = $input_data['Fname'];
			}
			if(!$inputData['Lname'] && !empty($input_data)){
				$inputData['Lname'] = $input_data['Lname'];
			}
			if(!$inputData['Email'] && !empty($input_data)){
				$inputData['Email'] = $input_data['Email'];
			}
			if(!$inputData['Mobile'] && !empty($input_data)){
				$inputData['Mobile'] = $input_data['Mobile'];
			}
			if(!$inputData['Query'] && !empty($input_data)){
				$inputData['Query'] = $input_data['Query'];
			}
			if(!$inputData['type'] && !empty($input_data)){
				$inputData['type'] = $input_data['type'];
			}
			if(!$inputData['userid'] && !empty($input_data)){
				$inputData['userid'] = $input_data['userid'];
			}
			if(!$inputData['orderid'] && !empty($input_data)){
				$inputData['orderid'] = $input_data['orderid'];
			}
			if(!$inputData['Rateproducts'] && !empty($input_data)){
				$inputData['Rateproducts'] = $input_data['Rateproducts'];
			}
			if(!$inputData['Rateservice'] && !empty($input_data)){
				$inputData['Rateservice'] = $input_data['Rateservice'];
			}
			
			$id = $inputData['orderid'];
			$id = base64_decode($id);
			$id = explode('-',$id);
			$inputData['userid'] = ($id[0]/7);
			$inputData['orderid'] = ($id[1]/$inputData['userid']);
			if(!empty($inputData['FcityId']) &&!empty($inputData['Fname']) && !empty($inputData['Lname']) && !empty($inputData['Email']) && !empty($inputData['Mobile'])  && !empty($inputData['type']) && !empty($inputData['Rateproducts']) && !empty($inputData['Rateservice'])){						
					if($checkuserOrderid = $this->Usermodel->checkuserOrderid($inputData)){
							if($update = $this->Usermodel->submitCustomerquery($inputData)){
								$result['Success'] = "TRUE";
								$result['Message'] = 'Your feedback received successfully!';
								$result['Result'] = $update;
								
								$config['charset'] = 'utf-8';
								$config['wordwrap'] = TRUE;
								$config['mailtype'] = 'html';
								$this->email->initialize($config);

								$to= 'contactus@prasukorganics.in';
								$subject="Contact us";
								$message = $this->load->view('email/contact-us',$inputData,TRUE);
								sendMail($to, $subject, $message,'','contactus@prasukorganics.in');
								die(json_encode($result));
							}else{
								$result['Success'] = "FALSE";
								$result['Message'] = 'Internal error occured try again!!!';
								$result['Result'] = array();
								die(json_encode($result));	
							}
					}else{
								$result['Success'] = "FALSE";
								$result['Message'] = 'Record not found!!!';
								$result['Result'] = array();
								die(json_encode($result));	
					}
					
								
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	
	public function getfeedback(){
					
		$res=$this->Usermodel->getfeedback();
		if($res){
			foreach($res as $key=>$list){
				$res[$key]['created_date'] = date('M d Y',strtotime($list['created_date']));
			}
			$result['Success'] = "TRUE";
			$result['Total'] = count($res);
			$result['Message'] = 'Customer feedback list.';
			$result['Result'] = $res;
			die(json_encode($result));
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = 'No feedback found.';
			$result['Result'] = array();
			die(json_encode($result));	
		}				
			
	}
	public function getfaqs(){
					
		$res=$this->Usermodel->getfaqs();
		if($res){
			
			$result['Success'] = "TRUE";
			$result['Message'] = 'Faqs list.';
			$result['Result'] = $res;
			die(json_encode($result));
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = 'No faqs found.';
			$result['Result'] = array();
			die(json_encode($result));	
		}				
			
	}
	public function getwhyorganics(){
					
		$res=$this->Usermodel->getwhyorganics();
		if($res){
			foreach($res as $key => $list){
				$res[$key] = $list;
				$res[$key]['whyorganic_image_app'] = base_url().'upload/'.$list['whyorganic_image'];
			}
			$result['Success'] = "TRUE";
			$result['Message'] = 'Why Organics list.';
			$result['Result'] = $res;
			die(json_encode($result));
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = 'No Record found.';
			$result['Result'] = array();
			die(json_encode($result));	
		}				
			
	}
	public function galleryAPP(){
					
		$res=$this->Usermodel->getgallery();
		if($res){
			foreach($res as $key => $list){
				$res[$key] = $list;
				$res[$key]['gallery_img'] = base_url().'upload/'.$list['gallery_img'];
			}
			$result['Success'] = "TRUE";
			$result['Message'] = 'Gallery images list.';
			$result['Result'] = $res;
			die(json_encode($result));
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = 'No Record found.';
			$result['Result'] = array();
			die(json_encode($result));	
		}				
			
	}
	public function getblogs(){
					
		$res=$this->Usermodel->getblogs();
		if($res){
			foreach($res as $key => $value){
				$res[$key]['blog_created_date'] = date('d M Y',strtotime($value['blog_created_date']));
				$res[$key]['blog_by'] = ucfirst($value['blog_by']);
			}
			$result['Success'] = "TRUE";
			$result['Message'] = 'Customer blog list.';
			$result['Result'] = $res;
			die(json_encode($result));
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = 'No blog found.';
			$result['Result'] = array();
			die(json_encode($result));	
		}				
			
	} 
	public function getLocality(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['cityid'] =  $this->input->post('cityid', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['cityid'] && !empty($input_data)){
				$inputData['cityid'] = $input_data['cityid'];
			}
			$x = '';
			if(!empty($inputData['cityid'])){	
				$res = $this->Usermodel->getLocality($inputData['cityid']);
				if($res){
					$x .= '<select  class="form-control" id="custLocality">';
					foreach($res as $list){				
						$x .= '<option value="'.$list['city_locality_id'].'">'.ucfirst($list['city_locality_name']).' </option>';
					}			
					$x .= '</select>';
				}else{
					$x .= '<select  class="form-control" id="custLocality">';
						
						$x .= '<option value="">---Select Locality---</option>';
							
					$x .= '</select>';
				}
				
					$result['Success'] = "TRUE";
					$result['Message'] = '';
					$result['Result'] = $x;
					die(json_encode($result));	
			}else{
				$x .= '<select  class="form-control" id="custLocality">';
						
						$x .= '<option value="">---Select Locality---</option>';
							
					$x .= '</select>';
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
					$result['Result'] = $x;
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	public function getLocalityMobile(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['city_id'] =  $this->input->post('city_id', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['city_id'] && !empty($input_data)){
				$inputData['city_id'] = $input_data['city_id'];
			}
			$x = '';
			if(!empty($inputData['city_id'])){	
				$res = $this->Usermodel->getLocality($inputData['city_id']);
				if($res){					 
					foreach($res as $key => $list){				
						 $data[$key]['city_locality_id']=$list['city_locality_id'];
						 $data[$key]['city_locality_name']=$list['city_locality_name'];
					}
					
					$result['Success'] = "TRUE";
					$result['Message'] = '';
					$result['Result'] = $data;
				}else{
					$data = array();					
					$result['Success'] = "FALSE";
					$result['Message'] = 'Locality not found!!';
					$result['Result'] = $data;
				}
				
					die(json_encode($result));	
			}else{
			 
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				$result['Result'] = array();
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	/* #### MOBILE API's #### */
	
	public function getCities(){
					
		$res=$this->Usermodel->getCities();
		if($res){
			
			$result['Success'] = "TRUE";
			$result['Message'] = 'Faqs list.';
			$result['Result'] = $res;
			die(json_encode($result));
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = 'No faqs found.';
			$result['Result'] = array();
			die(json_encode($result));	
		}				
			
	}
	
	public function GetCustomerAddresses(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['userId'] =  $this->input->post('userId', TRUE);	 
			 
			$input_data = json_decode($json, TRUE);
			if(!$inputData['userId'] && !empty($input_data)){
				$inputData['userId'] = $input_data['userId'];
			}
			 
			if(!empty($inputData['userId'])){						
				if($checkUser = $this->Usermodel->userLogin2($inputData['userId'])){
					if($AddressData = $this->Usermodel->customerAddresses($inputData['userId'])){
						$cityData =  $this->Usermodel->getCities();
						foreach($cityData as $cKey => $cityValue){							
							foreach($AddressData as $key => $value){								
									$data[$cKey]['cityId'] = $cityValue['city_id'];
									$data[$cKey]['cityName'] = $cityValue['city_name'];
									
								if($value['customer_city_id'] == $cityValue['city_id']){									
									$data[$cKey]['deliveryAddresses'][$key] = $value;
								}else{									 						
									$data[$cKey]['deliveryAddresses'][$key] = array();
								}
							}
						}
						foreach($data as $dKey => $list){
							$list['deliveryAddresses'] = array_filter($list['deliveryAddresses']);
							$data[$dKey]['deliveryAddresses'] = array_values($list['deliveryAddresses']);
						}
						$result['Success'] = "TRUE";
						$result['Message'] = 'Delivery Addresses List!';
						$result['Result'] = $data;
					
						die(json_encode($result));
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'No record found!!!';
						$result['Result'] = array();
						die(json_encode($result));	
					}
				}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Internal error occured try again!!!';
						$result['Result'] = array();
						die(json_encode($result));	
					}
					
								
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	
	public function deleteCustomerAddress(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['userId'] =  $this->input->post('userId', TRUE);	 
			$inputData['addressId'] =  $this->input->post('addressId', TRUE);	 
			 
			$input_data = json_decode($json, TRUE);
			if(!$inputData['userId'] && !empty($input_data)){
				$inputData['userId'] = $input_data['userId'];
			}
			if(!$inputData['addressId'] && !empty($input_data)){
				$inputData['addressId'] = $input_data['addressId'];
			}
			 
			if(!empty($inputData['userId']) && !empty($inputData['addressId'])){						
				if($checkUser = $this->Usermodel->userLogin2($inputData['userId'])){
					if($AddressData = $this->Usermodel->deleteCustomerAddress($inputData)){
						$result['Success'] = "TRUE";
						$result['Message'] = 'Address deleted successfully!';
						$result['Result'] = array();
					
						die(json_encode($result));
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Record not found!!!';
						$result['Result'] = array();
						die(json_encode($result));	
					}
				}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Internal error occured try again!!!';
						$result['Result'] = array();
						die(json_encode($result));	
					}
					
								
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	
	
	public function updateaddress(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['city_id'] =  $this->input->post('city_id', TRUE);	
			$inputData['custLocality'] =  $this->input->post('custLocality', TRUE);	
			$inputData['newaddress'] =  $this->input->post('newaddress', TRUE);	
			$inputData['pincode'] =  $this->input->post('pincode', TRUE);	
			$inputData['userId'] =  $this->input->post('userId', TRUE);	
			$inputData['addressId'] =  $this->input->post('addressId', TRUE);	
			$inputData['localityName'] =  $this->input->post('localityName', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['city_id'] && !empty($input_data)){
				$inputData['city_id'] = $input_data['city_id'];
			}
			if(!$inputData['custLocality'] && !empty($input_data)){
				$inputData['custLocality'] = $input_data['custLocality'];
			}
			if(!$inputData['newaddress'] && !empty($input_data)){
				$inputData['newaddress'] = $input_data['newaddress'];
			}
			if(!$inputData['pincode'] && !empty($input_data)){
				$inputData['pincode'] = $input_data['pincode'];
			}
			if(!$inputData['userId'] && !empty($input_data)){
				$inputData['userId'] = $input_data['userId'];
			}
			if(!$inputData['addressId'] && !empty($input_data)){
				$inputData['addressId'] = $input_data['addressId']; 
			}
			if(!$inputData['localityName'] && !empty($input_data)){
				$inputData['localityName'] = $input_data['localityName'];
			}
			
			if(!empty($inputData['localityName']) && !empty($inputData['city_id']) && !empty($inputData['addressId']) && !empty($inputData['custLocality']) && !empty($inputData['newaddress']) && !empty($inputData['pincode'])){
				if($inputData['userId']){
					$userid=$inputData['userId'];
				}else{
					$userid=$this->session->userdata('userid');
				}
					if($this->Usermodel->userLogin2($userid)){
						if($update = $this->Usermodel->updateaddress($inputData,$userid)){
							 
							$result['Success'] = "TRUE";
							$result['Message'] = 'Address updated Successfully!';
							$result['Result'] = $update;
							die(json_encode($result));
						}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'Failed to add try again!!!';
							$result['Result'] = array();
							die(json_encode($result));	
						}
					}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'Invalid user id!!!';
							$result['Result'] = array();
							die(json_encode($result));	
					}	
					
								
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	
	public function WalletTransactions(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['userId'] =  $this->input->post('userId', TRUE);	
			$inputData['mobileNo'] =  $this->input->post('mobileNo', TRUE);		
			$input_data = json_decode($json, TRUE);
		
			if(!$inputData['userId'] && !empty($input_data)){
				$inputData['userId'] = $input_data['userId']; 
			}
			if(!$inputData['mobileNo'] && !empty($input_data)){
				$inputData['mobileNo'] = $input_data['mobileNo'];
			}
			
			if(!empty($inputData['userId']) && !empty($inputData['mobileNo'])){
				
				
					if($userDetails = $this->Usermodel->userLoginIdMob($inputData['userId'],$inputData['mobileNo'])){
						$wallet_balance = $userDetails[0]['customer_wallet'];
						if($transactions = $this->Usermodel->transactionsHistory($inputData['userId'],false,$postfromdate = date('Y-m-d'),$posttodate = date('Y-m-d'))){
							$i = 0;
							foreach($transactions as $okey => $olist){
								$res[date('m',strtotime($olist['created_date']))]['date'] = date('F',strtotime($olist['created_date']));
								$res[date('m',strtotime($olist['created_date']))]['histroy'][$i] = $olist;
								$res[date('m',strtotime($olist['created_date']))]['histroy'][$i]['created_date'] =  date('D, d M h:iA',strtotime($olist['created_date'])); 
								$i++;
							}
							$res = array_values($res);
							//echo "<pre>"; print_r($res );
							foreach($res as $dKey => $list){
								$res[$dKey]['histroy'] = array_values($list['histroy']); 
								 
							}						
							$result['Success'] = "TRUE";
							$result['Message'] = 'Wallet Transaction History!';
							$result['WalletBalance'] = $wallet_balance;
							$result['Result'] = $res;
							die(json_encode($result));
						}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'No Transaction history found!';
							$result['WalletBalance'] = $wallet_balance;
							$result['Result'] = array();
							die(json_encode($result));	
						}
					}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'Invalid user id!!!';
							$result['Result'] = array();
							die(json_encode($result));	
					}	
					
								
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	
	public function MyOrderList(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['userId'] =  $this->input->post('userId', TRUE);	
			$inputData['mobileNo'] =  $this->input->post('mobileNo', TRUE);		
			$input_data = json_decode($json, TRUE);
		
			if(!$inputData['userId'] && !empty($input_data)){
				$inputData['userId'] = $input_data['userId']; 
			}
			if(!$inputData['mobileNo'] && !empty($input_data)){
				$inputData['mobileNo'] = $input_data['mobileNo'];
			}
			
			if(!empty($inputData['userId']) && !empty($inputData['mobileNo'])){
				
				
					if($userDetails = $this->Usermodel->userLoginIdMob($inputData['userId'],$inputData['mobileNo'])){
						
							$i = 0;$pN ='';
							$res['orderHistory'] = $this->Usermodel->orderHistory($inputData['userId']);
						//	echo "<pre>"; print_r($res['orderHistory']); die;
							if($res['orderHistory']){
								foreach($res['orderHistory'] as $okey => $olist){
									$order_details = json_decode($olist['order_details'],true);
									$i=0;
									foreach($order_details as $plist)
									{
										if($i==0){
										$pN .= ucfirst($plist['name']).' ';
										}
										else{
										$pN .= ', '.ucfirst($plist['name']);
										}
									
										$i++;
									}
									$res['orderHistory'][$okey]['order_details'] = $pN; 
									$res['orderHistory'][$okey]['order_Items_details'] = json_decode($olist['order_details'],true); 
									if($res['orderHistory'][$okey]['order_Items_details']){
									    foreach($res['orderHistory'][$okey]['order_Items_details'] as $ODKey => $ODList ){
									        if(isset($ODList['productjson'])){
    									        if(!$ODList['productjson'])
    									        {
    									            $res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'] = array();
    									        }else{ 
													 if(($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][0]['products'])){
														foreach($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][0]['products'] as $jsonKey => $jsonList){
															if(isset($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][0]['products'][$jsonKey]['productquarter'])){
																unset($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][0]['products'][$jsonKey]['productquarter']);
															}
														}
													}
													if(($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][1]['products2'])){
														foreach($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][1]['products2'] as $jsonKey => $jsonList){
															if(isset($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][1]['products2'][$jsonKey]['productquarter'])){
																unset($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][1]['products2'][$jsonKey]['productquarter']);
															}
														}
													} 
												}
									        }
									    }
									}
									$d = date('d',strtotime($olist['order_date_time']));   
									$res['orderHistory'][$okey]['order_date_time'] =$d.' '.date('M, Y',strtotime($olist['order_date_time'])); 
									$res['orderHistory'][$okey]['delivery_date_f_s'] = date('d M Y',strtotime($olist['delivery_date'])); 
									$pN = '';									
								}
							}
							$res['nextDelievery'] = $this->Usermodel->nextDelievery($inputData['userId']);
						$pN = '';
							if($res['nextDelievery']){
								foreach($res['nextDelievery'] as $onkey => $olist){
									$order_details = json_decode($olist['order_details'],true);
									$i=0;
									foreach($order_details as $plist)
									{
										if($i==0){
											$pN .= ucfirst($plist['name']).' ';
										}
										else{
											$pN .= ', '.ucfirst($plist['name']);
										}
									
										$i++;
									}
									$i =0;
									$res['nextDelievery'][$onkey]['order_details'] = $pN; 
									$res['nextDelievery'][$onkey]['order_Items_details'] = json_decode($olist['order_details'],true); 
									if(	$res['nextDelievery'][$onkey]['order_Items_details']){
									    foreach($res['nextDelievery'][$onkey]['order_Items_details'] as $ODKey => $ODList ){
									         if(isset($ODList['productjson'])){
    									        if(!$ODList['productjson'])
    									        {
    									            $res['nextDelievery'][$onkey]['order_Items_details'][$ODKey]['productjson'] = array();
    									        }else{
													 if(isset($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][0]['products'])){
														foreach($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][0]['products'] as $jsonKey => $jsonList){
															if($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][0]['products'][$jsonKey]['productquarter']){
																unset($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][0]['products'][$jsonKey]['productquarter']);
															}
														}
													}
													if(isset($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][1]['products2'])){
														foreach($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][1]['products2'] as $jsonKey => $jsonList){
															if($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][1]['products2'][$jsonKey]['productquarter']){
																unset($res['orderHistory'][$okey]['order_Items_details'][$ODKey]['productjson'][1]['products2'][$jsonKey]['productquarter']);
															}
														}
													}
												}
									         }
									    }
									}
									$pN = '';
									$d = date('d',strtotime($olist['order_date_time'])); 
									$res['nextDelievery'][$onkey]['order_date_time'] =$d.' '.date('M, Y',strtotime($olist['order_date_time'])); 
									$res['nextDelievery'][$onkey]['delivery_date_f_s'] = date('d M Y',strtotime($olist['delivery_date'])); 
									$res['nextDelievery'][$onkey]['purchase_price'] = ($olist['purchase_price'] +  $olist['delivery_price']) - $olist['discount_price']; 
									$res['nextDelievery'][$onkey]['IsShowCancel'] = validateCancel(strtotime($olist['delivery_date'])); 
								}
							}
							/* foreach($res as $dKey => $list){
								$res[$dKey]['histroy'] = array_values($list['histroy']); 
								 
							} */
						if($res){							
							$result['Success'] = "TRUE";
							$result['Message'] = ''; 
							$result['Result'] = $res;
							die(json_encode($result));
						}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'No order placed yet!'; 
							$result['Result'] = array();
							die(json_encode($result));	
						}
					}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'Invalid user id!!!';
							$result['Result'] = array();
							die(json_encode($result));	
					}	
					
								
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	public function CancelOrderApp(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['orderid'] =  $this->input->post('orderid', TRUE);	
			$inputData['UserId'] = 	$this->input->post('UserId', TRUE);	
			$inputData['mobileNo'] = 	$this->input->post('mobileNo', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['orderid'] && !empty($input_data)){
				$inputData['orderid'] = $input_data['orderid'];
			}
			if(!$inputData['UserId'] && !empty($input_data)){
				$inputData['UserId'] = $input_data['UserId'];
			}
			if(!$inputData['mobileNo'] && !empty($input_data)){
				$inputData['mobileNo'] = $input_data['mobileNo'];
			}
			if(!empty($inputData['UserId'])&&!empty($inputData['orderid'])){				
					$res=$this->Usermodel->userLoginIdMob($inputData['UserId'],$inputData['mobileNo']);					
					if($res){
						$bookingDetails = $this->Usermodel->BookingDetailsThank($inputData['orderid'],$isStocked=1);
						$valCancel = validateCancel(strtotime($bookingDetails[0]['delivery_date']));
					//	echo "<pre>"; print_r($valCancel); die;
						if($valCancel){
							$cancelOrder = $this->Usermodel->CancelOrder($inputData);						 
							if($cancelOrder){ 
							//	$bookingDetails = $this->Usermodel->BookingDetailsThank($inputData['orderid'],$isStocked=1);
								if($bookingDetails){
									$orderDetails = json_decode($bookingDetails[0]['order_details'],true); 
									if($orderDetails){ 
										foreach($orderDetails as $key => $value){
											if($value['type'] != 'box'){							
												$rev = reverseUnit($value['qty']);
												$orderDetails[$key]['qty'] = $rev[0];
												if($rev[1] == 'weight'){
													$qty = $orderDetails[$key]['qty']/1000; 
												}elseif($rev[1] == 'drink'){
													$qty = $orderDetails[$key]['qty']/1000; 
												}elseif($rev[1] == 'piece'){
													$qty = $orderDetails[$key]['qty']; 
												}
												$this->Usermodel->updateProductStock($value['id'],$qty,$action='+');
											}
										}											 
									}
								}
										
								$result['Success'] = "TRUE";
								$result['Message'] = 'Order had been Cancelled!';
								$result['Result'] = $cancelOrder;
								die(json_encode($result));
							}else{
										$result['Success'] = "FALSE";
										$result['Message'] = 'Failed to cancel try later!';
										$result['Result'] = array();
										die(json_encode($result));	
							}
						}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'Delivery date expired, you can not cancel!';
							$result['Result'] = array();
							die(json_encode($result));	
						}							
					 
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Failed to cancel try later!';
						$result['Result'] = array();
						die(json_encode($result));	
					}				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}
	}
	

	public function emailSubscribe(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['emailid'] =  $this->input->post('emailid', TRUE);	 	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['emailid'] && !empty($input_data)){
				$inputData['emailid'] = $input_data['emailid'];
			} 
			if(!empty($inputData['emailid'])){
				  
				 		if($bookingDetails = $this->Usermodel->emailSubscribe($inputData['emailid'])){
						  
								$result['Success'] = "TRUE";
								$result['Message'] = 'You subscribed successfully!';
								$result['Result'] = '';
								die(json_encode($result));
							}else{
										$result['Success'] = "FALSE";
										$result['Message'] = 'Failed to subscribe try later!';
										$result['Result'] = array();
										die(json_encode($result));	
							}
					 
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Enter your email id!';
						$result['Result'] = array();
						die(json_encode($result));	
					}				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
	}
	
	public function submitCustomerFeedbackAPP(){
		$json = trim(file_get_contents('php://input'));
		if(!empty($json)){
			$inputData['FcityId'] =  $this->input->post('FcityId', TRUE);			 
			$inputData['Query'] =  $this->input->post('Query', TRUE);	
			$inputData['type'] =  'feedback';	
		 	$inputData['orderid'] =  $this->input->post('orderid', TRUE);	
			$inputData['Rateproducts'] =  $this->input->post('Rateproducts', TRUE);	
			$inputData['Rateservice'] =  $this->input->post('Rateservice', TRUE);	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['FcityId'] && !empty($input_data)){
				$inputData['FcityId'] = $input_data['FcityId'];
			}
			
			if(!$inputData['Query'] && !empty($input_data)){
				$inputData['Query'] = $input_data['Query'];
			}
			if(!$inputData['type'] && !empty($input_data)){
				$inputData['type'] = $input_data['type'];
			}
			
			if(!$inputData['orderid'] && !empty($input_data)){
				$inputData['orderid'] = $input_data['orderid'];
			}
			if(!$inputData['Rateproducts'] && !empty($input_data)){
				$inputData['Rateproducts'] = $input_data['Rateproducts'];
			}
			if(!$inputData['Rateservice'] && !empty($input_data)){
				$inputData['Rateservice'] = $input_data['Rateservice'];
			}
			
			$id = $inputData['orderid'];
			$id = base64_decode($id); 
			$id = explode('-',$id);
			$inputData['userid'] = ($id[0]/7);
			$inputData['orderid'] = ($id[1]/$inputData['userid']);
		//	echo "<pre>"; print_r($inputData); die;
			if($userDeatils = $this->Usermodel->userLogin2($user_id = $inputData['userid'])){					
				$inputData['Fname'] = $userDeatils[0]['full_name']; 
				$inputData['Lname'] =  $userDeatils[0]['last_name'];
				$inputData['Email'] =  $userDeatils[0]['email_id'];
				$inputData['Mobile']= $userDeatils[0]['mobile_no'];
					if($checkuserOrderid = $this->Usermodel->checkuserOrderid($inputData)){
							if($update = $this->Usermodel->submitCustomerquery($inputData)){
								$result['Success'] = "TRUE";
								$result['Message'] = 'Your feedback received successfully!';
								$result['Result'] = $update;
								
								$config['charset'] = 'utf-8';
								$config['wordwrap'] = TRUE;
								$config['mailtype'] = 'html';
								$this->email->initialize($config);

								$to= 'contactus@prasukorganics.in';
								$subject="Contact us";
								$message = $this->load->view('email/contact-us',$inputData,TRUE);
							//	sendMail($to, $subject, $message,'','contactus@prasukorganics.in');
								die(json_encode($result));
							}else{
								$result['Success'] = "FALSE";
								$result['Message'] = 'Internal error occured try again!!!';
								$result['Result'] = array();
								die(json_encode($result));	
							}
					}else{
								$result['Success'] = "FALSE";
								$result['Message'] = 'Record not found!!!';
								$result['Result'] = array();
								die(json_encode($result));	
					}
					
								
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	
	public function getblogsAPP(){  
			$inputData['emailid'] =  true;	 	
		 
			 
			if(!empty($inputData['emailid'])){
				  if($blogs =	$this->Usermodel->getblogs()){
						foreach($blogs as $key=>$list){
							$blogs[$key]['blog_img'] = base_url().'upload/'.$list['blog_img'];
						}
						$res['blogs'] = $blogs;
					}else{
						$res['blogs'] = array();
					}			
					$result['Success'] = "TRUE";
					$result['Message'] = '';
					$result['Result'] = $res;
					die(json_encode($result));
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
	 	
	}
	
	public function DashboardApp(){
		$json = trim(file_get_contents('php://input'));
		$content =$json;
		$fp = fopen("myText.txt","wb");
		fwrite($fp,$content);
		fclose($fp);
		if(!empty($json)){
			$inputData['appVersion'] =  $this->input->post('appVersion', TRUE);			 
			$inputData['deviceToken'] =  $this->input->post('deviceToken', TRUE);	 
		 	$inputData['userId'] =  $this->input->post('userId', TRUE);	
			$inputData['androidOS'] =  $this->input->post('androidOS', TRUE); 	
			$input_data = json_decode($json, TRUE);
			if(!$inputData['appVersion'] && !empty($input_data)){
				$inputData['appVersion'] = $input_data['appVersion'];
			}
			if(!$inputData['deviceToken'] && !empty($input_data)){
				$inputData['deviceToken'] = $input_data['deviceToken'];
			} 
			if(!$inputData['userId'] && !empty($input_data)){
				$inputData['userId'] = $input_data['userId'];
			}
			if(!$inputData['androidOS'] && !empty($input_data)){
				$inputData['androidOS'] = $input_data['androidOS'];
			} 
			
		 
			if($userDeatils = $this->Usermodel->userLogin2($user_id = $inputData['userId'])){				 
					if($blogs =	$this->Usermodel->getblogs()){
						foreach($blogs as $key=>$list){
							$blogs[$key]['blog_img'] = base_url().'upload/'.$list['blog_img'];
						}
						$res['blogs'] = $blogs;
					}else{
						$res['blogs'] = array();
					}			 
					if($feedback =	$this->Usermodel->getfeedback()){
						foreach($feedback as $key=>$list){
							$feedback[$key]['created_date'] = date('M d Y',strtotime($list['created_date']));
						}
						$res['feedback'] = $feedback;
					}else{
						$res['feedback'] = array();
					}		 
					if($getwhyorganics =	$this->Usermodel->getwhyorganics()){
						foreach($getwhyorganics as $key=>$list){
							$getwhyorganics[$key]['whyorganic_image'] = base_url().'upload/'.$list['whyorganic_image'];
						}
						$res['whyorganics'] = $getwhyorganics;
					}else{
						$res['whyorganics'] = array();
					}
					$res['banners'] = array(
						base_url().'public/images/mobile-banner1.png',
						base_url().'public/images/mobile-banner2.png',
						base_url().'public/images/mobile-banner3.png',
					);
					$result['Success'] = "TRUE";
					$result['Message'] = '';
					$result['Result'] = $res;
					die(json_encode($result));			
					
								
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Given request is invalid!';
				die(json_encode($result));	
			}
	}
	
	//RepeatOrder
	public function RepeatOrderAPP(){		
		$json = trim(file_get_contents('php://input')); 
		if(!empty($json)){
			$inputData['orderid'] =  $this->input->post('orderid', TRUE);
			$inputData['userId'] =  $this->input->post('userId', TRUE);
			$input_data = json_decode($json, TRUE);
			if(!$inputData['orderid'] && !empty($input_data)){
				$inputData['orderid'] = $input_data['orderid'];
			}
			if(!$inputData['userId'] && !empty($input_data)){
				$inputData['userId'] = $input_data['userId'];
			}
			$inputData['add_quantity'] = '';
			if(!empty($inputData['orderid']) && !empty($inputData['userId'])){	
					$inputData['userID'] = $inputData['userId']; 
					if($customerDetails = $this->Usermodel->checkUserId($inputData)){
						$orderDetails =$this->Usermodel->getOrderDetails($inputData);
						if($orderDetails){
							$details = json_decode($orderDetails[0]['order_details'],true);
							foreach($details as $key => $values){
								if(isset($values['type'])){
									$values['type'] = $values['type'] ;
								}else{
									$values['type'] = '';
								}
								if($values['type'] != 'box'){
									if($productDetails=$this->Ordermodel->productlist($values['id'])){
										if(!empty(trim($inputData['add_quantity']))){
											$qty = $inputData['add_quantity'];
											if($productDetails[0]['product_weight_unit']){
												$p = ($productDetails[0]['product_price']/$productDetails[0]['product_weight_unit']);
											}else{
												$p = ($productDetails[0]['product_price']);
											}
										}else{
											$qty = $productDetails[0]['product_weight_unit'];
											$p = ($productDetails[0]['product_price']/$productDetails[0]['product_weight_unit']);
										}
										$res[$key] = $productDetails[0]; 
										$res[$key]['order_Items_details'] = $values; 
										$res[$key]['product_selected_weight_unit'] = json_decode($productDetails[0]['product_selected_weight_unit'],true); 
										$res[$key]['product_selected_weight_unit'] = array_values($res[$key]['product_selected_weight_unit']); 
										$res[$key]['product_selected_weight_unit_app'] = array_values($res[$key]['product_selected_weight_unit']); 
										
										 
										
										$result['Success'] = "TRUE";
										$result['Message'] = 'Item added successfully into cart';
									//	$result['RowId'] = $res;
										$result['Result'] = $res; 
										
									}else{
										$result['Success'] = "False";
										$result['Message'] = 'Product id is incorrect!';
										die(json_encode($result));	
									}
								}elseif($values['type'] == 'box'){
									if($package=$this->Ordermodel->packagelist($values['id'])){
										if(!empty(trim($inputData['add_quantity']))){
											$qty = $inputData['add_quantity'];
											if($package[0]['package_weight_unit']){
												$p = ($package[0]['package_price']/1);
											}else{
												$p = ($package[0]['package_price']);
											}
										}else{
											$qty = $package[0]['package_weight_unit'];
											$p = ($package[0]['package_price']/1);
										}
										$insert_room[$key] = array(
											'id'      => 'p'.$values['id'],
											'qty'     => $qty,
											'price'   => $p,
											'unitprice'   => $package[0]['package_price'],
											'unitvalue'   => $package[0]['package_weight_unit'],
											'gstprice'   => $package[0]['package_gst_tax'],
											'type'   => $values['type'],
											'productjson'   => '',
											'name'    => str_ireplace(array('!'),'',$package[0]['package_name']),
										);
									//	$res = $this->cart->insert($insert_room);
										 
										$result['Success'] = "TRUE";
										$result['Message'] = 'Item added successfully into cart';
									//	$result['RowId'] = $insert_room;
										$result['Result'] = ''; 
									}else{
										$result['Success'] = "False";
										$result['Message'] = 'Package id is incorrect!';
										die(json_encode($result));	
									}
									
								}else{
									$result['Success'] = "False";
									$result['Message'] = 'Parameters are incorrect';
									die(json_encode($result));	
								}
							}
							$units = units(); 
							$units['weight'] = array_values($units['weight']);
							$units['piece'] = array_values($units['piece']);
							$units['drink'] = array_values($units['drink']);
							$result['units'] = $units;	
							die(json_encode($result));
						}else{
							$result['Success'] = "FALSE";
							$result['Message'] = 'Invalid order id!!';
							$result['Result'] = array();
							die(json_encode($result));
						}
						
					}else{
						$result['Success'] = "FALSE";
						$result['Message'] = 'Invalid account details !!';
						$result['Result'] = array();
						die(json_encode($result));	
					}
				
			}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Parameters are incorrect';
				die(json_encode($result));	
			}
				
		}else{
				$result['Success'] = "FALSE";
				$result['Message'] = 'Invalid request';
				die(json_encode($result));	
			}
	}
	
	

	public function getnewscategory(){
					
		$res=$this->Usermodel->getnewscategory();
		if($res){
			foreach($res as $key => $list){
				$res[$key] = $list;
				$res[$key]['thumbnail'] = base_url().'upload/blogcategory/'.$list['blog_category_icon'];
			}
			$result['Success'] = "TRUE";
			$result['Message'] = 'category list.';
			$result['Result'] = $res;
			die(json_encode($result));
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = 'No Record found.';
			$result['Result'] = array();
			die(json_encode($result));	
		}				
			
	}
	public function getnews(){
					
		$res=$this->Usermodel->getnews();
		if($res){
			foreach($res as $key => $value){
				$res[$key]['blog_created_date'] = date('d M Y',strtotime($value['blog_created_date']));
				$res[$key]['blog_by'] = ucfirst($value['blog_by']);
				$res[$key]['thumbnail'] =  base_url().'upload/'.$value['blog_img'];
			}
			$result['Success'] = "TRUE";
			$result['Message'] = 'Customer blog list.';
			$result['Result'] = $res;
			die(json_encode($result));
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = 'No blog found.';
			$result['Result'] = array();
			die(json_encode($result));	
		}				
			
	} 












	/* 	$req_dump = print_r($json, TRUE);
		$fp = fopen('request.txt', 'a');
		fwrite($fp, $req_dump);
		fclose($fp); */
}	