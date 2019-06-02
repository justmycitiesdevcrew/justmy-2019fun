<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Cookie Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/cookie_helper.html
 */

// ------------------------------------------------------------------------

// --------------------------------------------------------------------

if ( ! function_exists('sendMail'))
{
	/**
	 * Delete a COOKIE
	 *
	 * @param	mixed
	 * @param	string	the cookie domain. Usually: .yourdomain.com
	 * @param	string	the cookie path
	 * @param	string	the cookie prefix
	 * @return	void
	 */
	function sendMail($to=NULL, $subject=NULL, $message=NULL, $cc=NULL,$from='info@prasukorganics.in', $isHtml=NULL, $fileName=NULL)
	{
		$cc = 'order@prasukorganics.in';
		$CI =& get_instance();
        $CI->load->library('email'); 
	//	$CI->email->from('<info@prasukorganics.in>', 'Prasuk Organics');
		$CI->email->from('<'.$from.'>', 'Prasuk Organics');
		$CI->email->to($to);
		$CI->email->cc($cc); 
	//	$CI->email->bcc(''); 
		$CI->email->subject($subject);
				
		$CI->email->message($message);	

	//	$CI->email->send();
		if($CI->email->send())
			return true;
		else{
			return 'some thing is wrong!';
		}
	}
	
	function sendSMS($mobileNo=NULL, $message=NULL){

		// SMS Sender added by sumeshwar
		if($mobileNo!=='' && $message!=""){
			$msg = urlencode($message);
$url = 'http://smsmedia.online/vendorsms/pushsms.aspx?user=Prasuk&password=prasuk&msisdn='.$mobileNo.'&sid=PRASUK&msg='.$message.'&fl=0&gwid=2';
			//echo $url; die;
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$curl_scraped_page = curl_exec($ch);
			//echo $curl_scraped_page;
			curl_close($ch);
			$data['message'] = 'Successfully sent';
			return $data;
		}else{
			$data['message'] = 'Mobile no or message could not blank.';
			return $data;
		}
	}
	
	function getLocalityByCity($selectedCity){		
		//$url = 'https://maps.googleapis.com/maps/api/place/autocomplete/json?input='.urlencode($selectedCity).'&key=AIzaSyAtVjNO4cMlyGf8aEGrCADkt_LPOZNkx0U&session_token='.rand(1111111111,9999999999);
		$url = 'https://maps.googleapis.com/maps/api/place/autocomplete/json?input='.urlencode($selectedCity).'&key=AIzaSyCQPOQQHyA2COIUGhG-PFIdUQ_faYjsN6c&session_token='.rand(1111111111,9999999999);
			//echo $url; die;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$curl_scraped_page = curl_exec($ch);
		//echo $curl_scraped_page;
		curl_close($ch);
		return json_decode($curl_scraped_page,true);
	}
	function getLocalityByLatLong($latLong){		
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.$latLong.'&sensor=true';
			//echo $url; die;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$curl_scraped_page = curl_exec($ch);
		//echo $curl_scraped_page;
		curl_close($ch);
		return json_decode($curl_scraped_page,true);
	}
	if ( ! function_exists('beauticianDetail')){
	function beauticianDetail($id = NULL) {
		if(!$id)
			return false;
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('beautician_email_id,beautician_mobile_no');
		$ci->db->from('hsbp_beautician');
		$ci->db->where('beautician_id' , $id);
		$query = $ci->db->get();
		$results = $query->result() ;
		//echo "<pre>"; print_r($results); die;
		return $results[0];
    }
}

if ( ! function_exists('getStatesList'))
{
	function getStatesList() {
		
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('*');
		$ci->db->from('ecom_city');
		$ci->db->order_by('state_name','asc');
		$ci->db->where('parent_id' , '0');
		$query = $ci->db->get();
		$results = $query->result_array() ;
		//echo "<pre>"; print_r($results); die;
		return $results;
    }
}
if ( ! function_exists('getCityByStateId'))
{
	function getCityByStateId($id = NULL) {
		if(!$id)
			return false;
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('*');
		$ci->db->from('ecom_city');
		$ci->db->order_by('city_name','asc');
		$ci->db->where('parent_id' , $id);
		$query = $ci->db->get();
		$results = $query->result_array() ;
		//echo "<pre>"; print_r($results); die;
		return $results;
    }
}
if ( ! function_exists('getCityByStateName'))
{
	function getCityByStateName($id = NULL) {
		if(!$id)
			return false;
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('*');
		$ci->db->from('ecom_city');
		$ci->db->order_by('city_name','asc');
		$ci->db->where('city_state' , $id);
		$query = $ci->db->get();
		$results = $query->result_array() ;
		//echo "<pre>"; print_r($results); die;
		return $results;
    }
}
if ( ! function_exists('getCities'))
{
	function getCities($id = NULL) {
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('*');
		$ci->db->from('ecom_city');
		$ci->db->where('parent_id != 0');
		if($id){
			$ci->db->where('city_id',$id);
		}
		$ci->db->order_by('city_name','asc');
		$query = $ci->db->get();
		$results = $query->result_array() ;
		//echo "<pre>"; print_r($results); die;
		return $results;
    }
}
if ( ! function_exists('getCitiesByName'))
{
	function getCitiesByName($cityName = NULL) {
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('*');
		$ci->db->from('ecom_city');
		$ci->db->where('parent_id != 0');
		if($cityName){
			$ci->db->where('city_name',$cityName);
		}
		$ci->db->order_by('city_name','asc');
		$query = $ci->db->get();
		$results = $query->result_array() ;
		//echo "<pre>"; print_r($results); die;
		return $results;
    }
}

if ( ! function_exists('order_status'))
{
	function order_status($id = NULL) {
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('*');
		$ci->db->from('order_status');
		$query = $ci->db->get();
		$results = $query->result_array() ;
		//echo "<pre>"; print_r($results); die;
		return $results;
    }
}
if ( ! function_exists('getCat'))
{
	function getAllProducts($id = NULL, $parent_id = null) {
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('*');
		$ci->db->from('products');
		$ci->db->order_by('product_name','asc');
		//$ci->db->where('status','1');
		if($parent_id){
			$ci->db->where('parent_id',0);
		}
		if($id){
			$ci->db->where('parent_id',$id);
		}
		$query = $ci->db->get();
		$results = $query->result_array() ;
		//echo "<pre>"; print_r($results); die;
		return $results;
    }
}
if ( ! function_exists('getCat'))
{
	function getCat($id = NULL, $parent_id = null) {
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('*');
		$ci->db->from('categories');
		$ci->db->where('cat_status','1');
		if($parent_id){
			$ci->db->where('parent_id',0);
		}
		if($id){
			$ci->db->where('parent_id',$id);
		}
		$query = $ci->db->get();
		$results = $query->result_array() ;
		//echo "<pre>"; print_r($results); die;
		return $results;
    }
}

if ( ! function_exists('getBoxCat'))
{
	function getBoxCat($id = NULL, $parent_id = null) {
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('*');
		$ci->db->from('boxcategories');
		$ci->db->where('box_cat_status','1');
		if($parent_id){
			$ci->db->where('box_parent_id',0);
		}
		if($id){
			$ci->db->where('box_parent_id',$id);
		}
		$query = $ci->db->get();
		$results = $query->result_array();
	//	echo "<pre>"; print_r($ci->db->last_query()); die;
		return $results;
    }
}

if ( ! function_exists('getCityIdByName'))
{
	function getCityIdByName($name = NULL) {
		if(!$name)
			return false;
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('id_city');
		$ci->db->from('hsbp_city');
		$ci->db->where('city_name' , $name);
		$query = $ci->db->get();
		$results = $query->result() ;
		//echo "<pre>"; print_r($results); die;
		return $results[0]->id_city;
    }
}
	
}
function getCity($citiesonly=null) 
{
		$CI =& get_instance();
    $CI->load->model('citymodel');
	$city = $CI->citymodel->getCity('','',$citiesonly); 
    return $city;  
}
function getOrderId($custMobileNo = NULL) {
	if(!$custMobileNo)
		return false;
	$ci =& get_instance();
	$ci->load->database();
	$ci->db->select('id_appointment');
	$ci->db->from('hsbp_appointment');
	$ci->db->where('customer_mob', $custMobileNo);
	$ci->db->order_by("id_appointment", "desc");
	$query = $ci->db->get();
	$results = $query->result() ;
	//echo "<pre>"; print_r($results[0]);die;
	return $results[0]->id_appointment;
	}
function categoryAllList() {
	
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('c.cat_name as catname,c.cat_status as catstatus,c.category_banner as catbanner,c.id as catid, c.parent_id as catparentid');
        $ci->db->from('categories c');
    	$ci->db->order_by('c.cat_name','desc');
		$ci->db->where('c.cat_status', '1');
		$ci->db->where('c.parent_id','0');		
        $query = $ci->db->get();
		$categoryList = $query->result_array();
		if($categoryList){
				foreach($categoryList as $key => $list){
					$ci->db->select('*');
					$ci->db->from('categories c');
					$ci->db->order_by('c.cat_name','asc');
					$ci->db->where('cat_status', '1');
					$ci->db->where('parent_id', $list['catid']);
					$query = $ci->db->get();
					$res = $query->result_array();
					$categoryList[$key]['subcategory'] = $res;
				}
		return $categoryList;
	}
}
	function sendPushNotificationToGCM($tokenId, $notification) {
			
			//$registatoin_ids = array($tokenId);
			$registatoin_ids =array($tokenId);
			
			//echo "<pre>"; print_r($registatoin_ids); die;
			$url = 'https://fcm.googleapis.com/fcm/send';

		$fields = array (
				'registration_ids' => $registatoin_ids,
				'data' => $notification
		);
		//echo "<pre>"; print_r($fields); die;
	   $fields = json_encode ( $fields );
		//echo "<pre>"; print_r($fields); 
		$headers = array (
				'Authorization: key=' ."AAAAwEqJZFk:APA91bEZ-mPmCFo24wFiIVLzAOCJb0OqkiTqXG5GTDazHkiFZzvMoaSxYRNzi4-0gwuWhXLc4Jgd6_jBWpGH8w7KOo_BpQrbMAIttxQfQKK_qJZhaPe8M1HmcBHY_0K2hOYXLK_P9mVs",
				'Content-Type: application/json'
		);

		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, true );
		curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec ( $ch );
		if ($result === FALSE) {
				die('Curl failed: ' . curl_error($ch));
			}
		//echo $result.'<br/>'; die;
		//echo "Notification sent.";
		$result1 = json_decode($result);
		//echo "<pre>"; print_r($result1); die;
		curl_close ( $ch );
	}
function get_lat_long($address=null) {
   $array = array();
   $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

   // We convert the JSON to an array
   $geo = json_decode($geo, true);

   // If everything is cool
   if ($geo['status'] = 'OK') {
      $latitude = $geo['results'][0]['geometry']['location']['lat'];
      $longitude = $geo['results'][0]['geometry']['location']['lng'];
      $array = array('lat'=> $latitude ,'lng'=>$longitude);
   }

   return $array;
}
function getMinBookingAmount($cityId=NULL){
	$minBookingAmount = array(1 => 600, 2=>600, 3 => 600, 4=>450, 5=> 600, 6=>600, 7 => 600, 8=>600, 9=>600, 10=>600, 11=>600, 12=>600, 13=>600, 14=>600, 15=>600, 16=>600, 17=>600, 18=>600, 19=>600, 20=>600, 21=>600);
	if($cityId)
		return $minBookingAmount[$cityId];
	else
		return 0;
}
function getSupportNumber($cityId=NULL){
	if($cityId)
		return 9582577510;
	else
		return 9582577510;
}
if ( ! function_exists('units'))
{
	function units(){
		$units['weight'] = array('10'=>'10 grams','50'=>'50 grams','75'=>'75 grams','100'=>'100 grams','150'=>'150 grams','200'=>'200 grams','250'=>'250 grams','300'=>'300 grams','500'=>'500 grams','600'=>'600 grams','750'=>'750 grams','1000'=>'1 kg','1500'=>'1.5 kg','2000'=>'2 kg','2500'=>'2.5 kg','3000'=>'3 kg','5000'=>'5 kg','10000'=>'10 kg','20000'=>'20 kg');
		$units['piece'] = array('1'=>'1 piece','2'=>'2 piece','3'=>'3 piece','4'=>'4 piece','5'=>'5 piece','6'=>'6 piece','7'=>'7 piece','8'=>'8 piece','9'=>'9 piece','10'=>'10 piece','11'=>'11 piece','12'=>'12 piece');
		$units['drink'] = array('50'=>'50 ml','75'=>'75 ml','100'=>'100 ml','200'=>'200 ml','250'=>'250 ml','500'=>'500 ml','1000'=>'1 L','2000'=>'2 L','3000'=>'3 L','5000'=>'5 L');
		return $units;
	}
	function getUnitValue($unit,$unittype){
		$units = units();
		if($unittype == 'weight'){
			return $units['weight'][$unit];
		}
		elseif($unittype == 'per piece'){
			return $units['piece'][$unit];
		}
		elseif($unittype == 'drink'){
			return $units['drink'][$unit];
		}
	}
}
function reverseUnit($val=null){
	$units = units(); 
	$weight = array_flip($units['weight']);
	$piece = array_flip($units['piece']);
	$drink = array_flip($units['drink']);
	if(isset($weight[$val])){
		$baseUnit[0] = $weight[$val];
		$baseUnit[1] = 'weight';
	}elseif(isset($piece[$val])){
		$baseUnit[0] = $piece[$val];
		$baseUnit[1] = 'piece';
	}elseif(isset($drink[$val])){
		$baseUnit[0] = $drink[$val];
		$baseUnit[1] = 'drink';
	}
	return $baseUnit;
}
function get_snippet( $str, $wordCount) {
  return implode( 
    '', 
    array_slice( 
      preg_split(
        '/([\s,\.;\?\!]+)/', 
        $str, 
        $wordCount*2+1, 
        PREG_SPLIT_DELIM_CAPTURE
      ),
      0,
      $wordCount*2-1
    )
  );
}

function deliveryRate($orderAmount){
	$ci =& get_instance();
	$ci->load->database();
	$city_id = $ci->session->userdata('city_id');
	$customer_id = $ci->session->userdata('userid');

	if(!$city_id)
		return 0;
	
	/*prasuk member*/
	 	$ci->db->select('*');
		$ci->db->from('customer');
		$ci->db->where('id_customer', $customer_id);
		$ci->db->where('customer_prasuk_family_card', '1');
		$ci->db->limit(1);
		$query = $ci->db->get();
		$cust = $query->result();
		if($cust){
			$ci->db->select('*');
			$ci->db->from('subscription');
			$ci->db->where('customer_id', $customer_id);
			$ci->db->order_by('subscription_id', 'desc');
			$ci->db->limit(1);
			$query = $ci->db->get();
			$results = $query->result() ;
			if($results){
				if($results[0]->subscription_valid_date >= date('Y-m-d H:i:s')){						
					$rate = 0;		
					return $rate;
				}
				
			}
		} 
	/*prasuk mend end*/
	/* check for second and more orders in a week */
		
		$currentDate = date('Y-m-d H:i:s');
		$nextSunday = date('Y-m-d H:i:s', strtotime('next Sunday'));
		$previousMondey = date('Y-m-d H:i:s', strtotime('-6 days',strtotime($nextSunday)));
		$ci->db->select('*');
		$ci->db->from('orders');
		$ci->db->where('customer_id', $customer_id);
		$ci->db->where('order_status !=', '7');
		$ci->db->where('order_date_time >=', $previousMondey);
		$ci->db->where('order_date_time <=', $nextSunday);
		$query = $ci->db->get();
 		$custPreviousOrder = $query->result();
		if($custPreviousOrder){				
			$rate = 0;		
			return $rate;				
		} 
		
	/* check for second and more orders in a week end*/
		
		
		
		
		
		
		
		if($orderAmount >= 500){
			$rate = 0;		
			return $rate;
		}	
	
	$ci->db->select('delivery_charges');
	$ci->db->from('city_detail');
	$ci->db->where('city_id', $city_id);
	$query = $ci->db->get();
	$results = $query->result() ; 
	return $results[0]->delivery_charges;
}
function onefunction($scheduleddate,$selectedaddress,$orderAmount=0,$city_id=NULL,$customer_id=NULL){
	/* 	if(!empty($scheduleddate) && !empty($selectedaddress))
			return 0;
		 */
		$ci =& get_instance();
		$ci->load->database();
		if($city_id){
			$city_id = $city_id;
		}else{
			$city_id = $ci->session->userdata('city_id');
		}
		if($customer_id){
			$customer_id =$customer_id;
		}else{
			$customer_id = $ci->session->userdata('userid');
		}
		
		$result['rate'] = 0;
		$result['prasukmember'] = false;
		$prasukmember = false;
		
	/*prasuk member*/
	 	$ci->db->select('*');
		$ci->db->from('customer');
		$ci->db->where('id_customer', $customer_id);
		$ci->db->where('customer_prasuk_family_card', '1');
		$ci->db->limit(1);
		$query = $ci->db->get();
		$cust = $query->result();
		if($cust){
			$ci->db->select('*');
			$ci->db->from('subscription');
			$ci->db->where('customer_id', $customer_id);
			$ci->db->order_by('subscription_id', 'desc');
			$ci->db->limit(1);
			$query = $ci->db->get();
			$results = $query->result() ;
			if($results){
				if(($results[0]->subscription_valid_date >= date('Y-m-d H:i:s')) 
					&& ($results[0]->subscription_valid_date >= date('Y-m-d H:i:s',strtotime($scheduleddate))) 
					&& ($results[0]->address_id == $selectedaddress)){						
					$rate = 0;
					$prasukmember = true; 
					$result['rate'] = $rate;
					$result['prasukmember'] = $prasukmember;
				}
				
			}
		}
		if($prasukmember){
			return $result;
		}else{	
			/* check for second and more orders in a week */
				
				$currentDate = date('Y-m-d H:i:s');
				$nextSunday = date('Y-m-d H:i:s', strtotime('next Sunday'));
				$previousMondey = date('Y-m-d H:i:s', strtotime('-6 days',strtotime($nextSunday)));
				$ci->db->select('*');
				$ci->db->from('orders');
				$ci->db->where('customer_id', $customer_id);
				$ci->db->where('order_status !=', '7');
				$ci->db->where('is_free', '0');
				$ci->db->where('order_date_time >=', $previousMondey);
				$ci->db->where('order_date_time <=', $nextSunday);
				$query = $ci->db->get();
				$custPreviousOrder = $query->result();
				if($custPreviousOrder){				
					$result['rate'] = 0;		
					return $result;				
				}  
				
			/* check for second and more orders in a week end*/
				
				
			if($orderAmount >= 500){
				$result['rate'] = 0;		
				return $result;
			}	
	
			$ci->db->select('delivery_charges');
			$ci->db->from('city_detail');
			$ci->db->where('city_id', $city_id);
			$query = $ci->db->get();
			$results = $query->result() ;
			//echo "<pre>"; print_r($results[0]);die;
			$result['rate'] = $results[0]->delivery_charges;			 
			return $result;
		}
	/*prasuk mend end*/ 
	
}
function makeseofriendlyurl($string){
  $string = str_ireplace(array('--','&',',',' ','%','@','(',')','!',"'"),'-',trim($string));
  if(strpos($string, '--') !== false){
	 $string = makeseofriendlyurl($string);
  }
  return $string;
  
}
function getuseragent(){
  if(isset($_SERVER['HTTP_USER_AGENT']) and !empty($_SERVER['HTTP_USER_AGENT'])){
       
	   $user_ag = $_SERVER['HTTP_USER_AGENT'];
       
	   if(preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis',$user_ag)){
		   $user_ag="Mobile";
       }else{
		   $user_ag="Desktop";
       }
    }else{
		$user_ag="App";
    }
	return $user_ag;
}
function specialdiscount($productTotal){
	return $specialdiscount = (10 * $productTotal)/100;		
}
function calculateGST($product_gst_tax,$productTotal){	
	return $percentagePrice = ($product_gst_tax * $productTotal)/100;
}

function countJarBag($bag,$jar){	
	$oneBag = 5; 
	$bagVol = 500; /*in grams*/
	$oneJar = 15; 
	$jarVol = 500; /*in grams*/
 
	$jar = ceil($jar/$jarVol);
	$bag = ceil($bag/$bagVol); 
	$res[0]['totalBagRs'] = $bag*$oneBag; 
	$res[0]['totalJarRs'] = $jar*$oneJar; 
	$res[0]['jarqty'] = $jar; 
	$res[0]['bagqty'] = $bag; 
	return $res;	 
}


function getDeliveryDays($delivery_days=null){
	
		$ci =& get_instance();
		date_default_timezone_set('Asia/Kolkata');
		if($delivery_days){
			$delivery_days = explode(',',$delivery_days);
		
		}
		else{
		$delivery_days = explode(',',$ci->session->userdata('delivery_days'));
		}
		$today = date('D, d M y');
		$currTime = date('H');
		//echo $currTime; die;
	
	
		$result['Wed'] = date('D, d M y', strtotime('next '.$delivery_days[0]));
		$result['WedDate'] = date('d', strtotime('next '.$delivery_days[0]));
		$result['Sat'] = date('D, d M y', strtotime('next '.$delivery_days[1]));
		$result['SatDate'] = date('d', strtotime('next '.$delivery_days[1]));
		if($currTime > 18){
			if($result['WedDate'] == (date('d')+1)){
				$result['Wed'] = date('D, d M y', strtotime('next week  '.$delivery_days[0]));
			}
			if($result['SatDate'] == (date('d')+1)){
				$result['Sat'] = date('D, d M y', strtotime('next week  '.$delivery_days[1]));
			}
		}
		$result['nxtWed'] = date('D, d M y', strtotime('next week  '.$delivery_days[0]));
		$result['nxtSat'] = date('D, d M y', strtotime('next week '.$delivery_days[1]));
		
		$result['nxtWeekWed'] = date('D, d M y', strtotime("+7 day", strtotime($result['nxtWed'])));
		$result['nxtWeekSat'] = date('D, d M y', strtotime("+7 day", strtotime($result['nxtSat'])));
		$result['nxtNxtWeekWed'] = date('D, d M y', strtotime("+7 day", strtotime($result['nxtWeekWed'])));
		$result['nxtNxtWeekSat'] = date('D, d M y', strtotime("+7 day", strtotime($result['nxtWeekSat'])));
		return $result;
}
function validateCancel($deliveryDate){ 
	//echo $deliveryDate; die;
	$today = strtotime(date('d-m-Y'));
	$todayTime = date('H');
	if($today  <= $deliveryDate){ 	
		if($today == strtotime('-1 day ',$deliveryDate) && $todayTime >= '15'){			
			return false;
		}	
		if(date('d-m-Y',$today) == date('d-m-Y',$deliveryDate)){			
			return false;
		}
		return true;
	}else{
		return false;
	}
}
function calculatePrice($qty, $price,$units){ 
/* echo $qty.' ';
echo $price.' ';
echo $units.' '; die; */
	$total = (($qty)*(($price)/($units)));
	return round($total);
	 
}
function ThankYouPageStock($orderId){
	$ci =& get_instance();
	$ci->load->model('webservices/Usermodel');
 $data['categoryId'] = 1;
 $orderId = $orderId; 
 if($orderId){
 $bookingDetails = $ci->Usermodel->BookingDetailsThank($orderId);
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
						$ci->Usermodel->updateProductStock($value['id'],$qty,$action='-');
					}
				}				
				$bookingDetails = $ci->Usermodel->UpdateBookingIsStock($orderId);
				return true;
			}
			
				return false;
	}
				return false;
 }
				return false;
	 
}