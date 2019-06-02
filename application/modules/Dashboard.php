<?php 
class Dashboard extends CI_Controller {
	
	public function __construct()
   {  
	parent::__construct(); 
		
		$this->load->helper('common');
	 	//$this->load->model('companymanagement/Companymodel');
		$this->load->library('upload');
   } 

	public function index()
	{
		//$data['allcompany']=$this->Companymodel->getCompanies();
		//echo "<pre>"; print_r($data); die;
		$this->load->view('includes/head');
		$this->load->view('includes/leftmenu');
		$this->load->view('includes/header');
	    $this->load->view('view_dashboard');
		$this->load->view('includes/footer');
	}
	
}	
?>