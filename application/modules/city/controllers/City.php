<?php
class City extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		
		
		$this->load->helper('common');
		$this->load->library("user_agent");
        if(!isLoggedIn() && !isSuperAdmin())
         redirect('Login');
		if($this->session->userdata('user_role') == '3'){
			 return true;
		}
		if($this->session->userdata('user_role') == '4'){
			 redirect(base_url().'city');
		}
	}
	
	
	public function index()
	{
			$this->load->view('include/header');
			$this->load->view('include/breadcrum');
			$this->load->view('youtube');
			$this->load->view('include/footer');
	}
	
	public function cityLocalityActiveStatus()
	{   $cityId = $this->input->get('cityId');
		$result = $this->Seomodel->changeCityLocalityStatus($this->input->post());
		//$data =$this->input->post();
		
		
	    //echo "<pre>"; print_r($result);die;
		if($result)			
		{
			redirect(base_url()."city/getCityLocality?id=$cityId");
	    
	    }
	}
	public function editCityLocalityDetails()
	{	$cityLocalityId = $this->input->get('id');
		$data['cityLocalityDetails'] = $this->Seomodel->cityLocalityDetailsById($cityLocalityId);
			//echo "<pre>"; print_r($data);die;
			$this->load->view('include/header');
			$this->load->view('include/breadcrum');
			$this->load->view('edit_city_locality',$data);
			$this->load->view('include/footer');
	}
	public function cityLocalityDetailsUpdate()
	{
		$data = $this->input->post();
		$cityId = $this->input->post('cityid');
		//echo "<pre>";print_r($data);die;
		$result = $this->Seomodel->updateCityLocalityDetails($data);
		if($result)			
		{
			redirect(base_url()."city/getCityLocality?id=$cityId");
	    
	    }
	}
	public function deliveryManagement()
	{
		$data['cityName'] = $this->citymodel->get_cities_bk_price();
		//echo "<pre>";print_r($data);die;
		$this->load->view('include/header');
		$this->load->view('include/breadcrum');
		$this->load->view('view_delivery_managment', $data);
		$this->load->view('include/footer');
	}	
	public function addDeliverydata()
	{
		$this->load->view('include/header');
		$this->load->view('include/breadcrum');
		$this->load->view('add_delivery_data');
		$this->load->view('include/footer');
	}
	public function insertDeliverypriceBycity()
	{
		$data = $this->input->post();
		//echo "<pre>";print_r($data);die;
		$result = $this->citymodel->insertDeliverypriceBycity($data);
		if($result)
		{
			redirect(base_url()."city");
		}
	}
	public function editCityDeliveryPrice()
	{ 
		//echo "yogesh"; die;
		$data['cityList'] = $this->citymodel->get_cities_bk_price($this->input->get('id'));
	//	$data['city'] = $this->Citymodel->getCity();
	//	echo "<pre>";print_r($data);die;
		$this->load->view('include/header');
		$this->load->view('include/breadcrum');
		$this->load->view('edit_delivery_data',$data);
		$this->load->view('include/footer');
	}
	public function updateCityDeliveryPrice()
	{
		$data = $this->input->post();
		$result = $this->citymodel->updateCityDeliveryPrice($data);
		//echo "<pre>"; print_r($result);die;
		if($result){
			$this->session->set_flashdata('alert', 'Delivery Data updated successfully');
			redirect('city');
		}
		
	}
	public function subcategories(){
		$data = $this->input->post();
		$res = getCityByStateName($data['stateId']);
		if($res){
			$r = '<select class="form-control" name="city" id="subCatIds" required>';
			foreach($res as $list){				
				$r .='<option value="'.$list['city_name'].'">'.ucfirst($list['city_name']).' </option>';				
			}
			$r .='</select>';
			$result['Success'] = "True";
			$result['Message'] = ' ';
			$result['Result'] = $r;
			
		}else{			 
			$r = '<select class="form-control" id="subCatIds" name="city"  >';
			$r .='<option value=""></option>';			 
			$r .='</select>';
			$result['Success'] = "False";
			$result['Message'] = ' ';
			$result['Result'] = $r;
		}
	//	echo $r;
		die(json_encode($result));
	}
}
?>