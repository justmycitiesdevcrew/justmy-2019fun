<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends CI_Controller {
	
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
			 redirect(base_url().'section');
		}
	}
	
	public function index(){
		$this->load->view('include/header');
		$this->load->view('include/breadcrum');
		$this->load->view('view_sections_list');
		$this->load->view('include/footer');
		
	}
		
}
?>