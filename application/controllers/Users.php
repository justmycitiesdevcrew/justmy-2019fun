<?php

class Users extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
		$this->load->library('session');
    }

    public function index(){
		if(!empty($this->session->userdata('username')) && !empty($this->session->userdata('password'))){
			redirect(base_url().'myaccount');
		}
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('signin');
		$this->load->view('footer');
    }
	
    public function signup(){
		if(!empty($this->session->userdata('username')) && !empty($this->session->userdata('password'))){
			redirect(base_url().'myaccount');
		}
		$this->load->view('head');
		$this->load->view('header');
		$this->load->view('signup');
		$this->load->view('footer');
    }
	public function myaccount(){
		if(!empty($this->session->userdata('username')) && !empty($this->session->userdata('password'))){
			$this->load->view('head');
			$this->load->view('header');
			$this->load->view('my-account');
			$this->load->view('footer');
		}else{
			$this->session->set_flashdata('alert', 'Please Sign In first!');
			redirect(base_url().'signin');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		$this->session->set_flashdata('alert', 'Logout successfully!');
		redirect(base_url().'signin');
	}

}
?>