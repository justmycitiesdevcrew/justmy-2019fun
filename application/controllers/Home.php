<?php

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
		$this->load->library('session');
	//	$this->load->model('blog/Blogmodel');
		$this->load->model('webservices/Usermodel');
    }

    public function index()
    {
		
		$data['blogs'] = $this->Blogmodel->getBlogList($status='1');
		$data['why']=$this->Usermodel->getwhyorganics();
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('index');
	//	echo "index page";
		$this->load->view('footer');
    }
    public function login()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
    }
    public function signup()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('signup');
		$this->load->view('footer');
    }
    public function products()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('product-list');
		$this->load->view('footer');
    }
	public function aboutus()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('about-us');
		$this->load->view('footer');
    }
	public function aboutusnew()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('about-us-new');
		$this->load->view('footer');
    }
	public function contactus()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('contact-us');
		$this->load->view('footer');
    }
	public function whyorganics()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('why-organics');
		$this->load->view('footer');
    }
    public function productdetails()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('product-details');
		$this->load->view('footer');
    }
    public function forgotpassword()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('forgot-password');
		$this->load->view('footer');
    }
    public function testimonials()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('testimonials');
		$this->load->view('footer');
    }
    public function termcondition()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('term-condition');
		$this->load->view('footer');
    }
    public function privacypolicy()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('privacy-policy');
		$this->load->view('footer');
    }
    public function ourbelief()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('our-belief');
		$this->load->view('footer');
    }
    public function refundpolicy()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('refund-policy');
		$this->load->view('footer');
    }
    public function deliveryschedule()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('delivery-schedule');
		$this->load->view('footer');
    }
	 public function faqs()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('faqs');
		$this->load->view('footer');
    }
	 public function ourteam()
    {
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('our-team');
		$this->load->view('footer');
    }
	public function aboutusmob()
    {
		$this->load->view('head');
		$this->load->view('mobviewcss/stylecss-mobview');
		$this->load->view('about-us-mob');
    }
	public function whyorganicsmob()
    {
		$this->load->view('head');
		$this->load->view('mobviewcss/stylecss-mobview');
		$this->load->view('mob-why-organics');	
    }
	public function termconditionmob()
    {
		$this->load->view('head');
		$this->load->view('mobviewcss/stylecss-mobview');
		$this->load->view('mob-term-condition');	
    }
	public function ourbeliefmob()
    {
		$this->load->view('head');
		$this->load->view('mobviewcss/stylecss-mobview');
		$this->load->view('mob-our-belief');	
    }
	public function privacypolicymob()
    {
		$this->load->view('head');
		$this->load->view('mobviewcss/stylecss-mobview');
		$this->load->view('mob-privacy-policy');	
    }
	public function ourteammob()
    {
		$this->load->view('head');
		$this->load->view('mobviewcss/stylecss-mobview');
		$this->load->view('mob-our-team');	
    }
	
	public function getLocalityByCity(){
		$selectedCity = $this->input->get('selectedCity');
		if($selectedCity){			
			$res = getLocalityByCity($selectedCity);
			if(sizeof($res['predictions']) > 0 && $res['status'] == 'OK'){
				$arr = array();
				foreach($res['predictions'] as $key => $list){					
					$arr[$key]=$list['description'];					
				}
				$result['Success'] = "TRUE";
				$result['Message'] = "Locality List";
				$final=$arr;
			}else{
				
			$result['Success'] = "FALSE";
			$result['Message'] = $res['error_message'];
				$final=$res;
				
			}
			$result['Result'] = $final;
			
			die(json_encode($result));	
		}else{ 
			$result['Success'] = "FALSE";
			$result['Message'] = "Invalid Request";
			$result['Result'] = array();
			die(json_encode($result));	
		}
	} 
	public function getLocalitiesBySearch(){
		$selectedCity = $this->input->get('term');
		if($selectedCity){			
			$res = getLocalityByCity($selectedCity);
			if(!empty($res)){
				if(sizeof($res['predictions']) > 0 && $res['status'] == 'OK'){
					$arr = array();
					foreach($res['predictions'] as $key => $list){					
						$arr[$key]['description']=$list['description'];					
						$arr[$key]['city_name']=$list['structured_formatting']['main_text'];					
					}
					$result['Success'] = "TRUE";
					$result['Message'] = "Locality List";
					$final=$arr;
				}else{
					
					$result['Success'] = "FALSE";
					$result['Message'] = $res['error_message'];
					$final=$res;
					
				}
				$result['Result'] = $final;
				
				die(json_encode($result));
			}
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = "Invalid Request";
			$result['Result'] = array();
			die(json_encode($result));	
		}
	}
	public function getLocalitiesByLanLong(){
		$latlong = $this->input->get('latlong');
		if($latlong){			
			$res = getLocalityByLatLong($latlong);
			if(sizeof($res['results']) > 0 && $res['status'] == 'OK'){
				$arr = array();
				//foreach($res['results'] as $key => $list){					
					$arr['formatted_address']=$res['results'][0]['formatted_address'];					
					$arr['city_name']=$res['results'][0]['address_components'][3]['long_name'];					
				//}
				$result['Success'] = "TRUE";
				$result['Message'] = "Locality List";
				$final=$arr;
			}else{
				
			$result['Success'] = "FALSE";
			$result['Message'] = $res['error_message'];
				$final=$res;
				
			}
			$result['Result'] = $final;
			
			die(json_encode($result));	
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = "Invalid Request";
			$result['Result'] = array();
			die(json_encode($result));	
		}
	}
	public function setAddSess(){
		$data = $this->input->post();
		if($data){
			if($data['city_name'] == 'Gurgaon'){
				$data['city_name'] = 'Gurugram';
			}
			$res = getCitiesByName($data['city_name']);	
			if($res){
				$city_id = $res[0]['city_id'];
			}else{
				$city_id = '';
			}
			
			$cityDetails=$this->Usermodel->getCityDetails($city_id);
			$newdata = array(
				'city_name'  => $data['city_name'],
				'city_id'	=>	$city_id,
				'description'  => $data['description'],
				'delivery_days'=>$cityDetails[0]['delivery_days'],
				'delivery_charges'=>$cityDetails[0]['delivery_charges'],
			);
			$this->session->set_userdata($newdata);
			$result['Success'] = "TRUE";
			$result['Message'] = "Your current location set successfully!";
			$result['Result'] = array();			
			die(json_encode($result));	
		}else{
			$result['Success'] = "FALSE";
			$result['Message'] = "Invalid Request";
			$result['Result'] = array();
			die(json_encode($result));	
		}
	}
	public function customerfeedback(){
		$data['customerDetails'] = '';
		$id = $this->input->get('id');
		if($id){
			$id = base64_decode($id);
			$id = explode('-',$id);
			$id['customerId'] = ($id[0]/7);
			$id['orderId'] = ($id[1]/$id['customerId']);
		//echo "<pre>"; print_r($id); die;
			$data['customerDetails'] = $this->Usermodel->getUserDetailsByOrderCutomerId($id);
		}
	//	echo "<pre>"; print_r($data); die;
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('customer-feedback');
		$this->load->view('footer');
	}
	
	
	
	public function test(){
		$query = " INSERT INTO `ecom_blog_category` (`cat_id`, `cat_name`, `blog_category_icon`, `blog_cat_url`, `cat_status`, `parent_id`) VALUES
(1, 'whats new', 'blog_category_icon_1549281186.png', 'whats-new', '1', 0),
(2, 'from prasuk farms', 'blog_category_icon_1549281200.png', 'from-prasuk-farms', '1', 0),
(3, 'offers', 'blog_category_icon_1549281207.png', 'offers', '1', 0),
(6, 'testingg', 'blog_category_icon_1549027377.png', 'testingg', '0', 0);





";
		$createTables = $this->Usermodel->createTable($query);
		echo $createTables; die;
	}
	
	
	
}
?>