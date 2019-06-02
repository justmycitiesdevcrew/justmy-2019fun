<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Channel extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Channelmodel');
		$this->load->helper('common');
		$this->load->library("user_agent");
        if(!isLoggedIn() && !isSuperAdmin())
         redirect('Login');
		if($this->session->userdata('user_role') == '3'){
			 return true;
		}
		if($this->session->userdata('user_role') == '4'){
			 redirect(base_url().'channel');
		}
	}
	
	public function index(){
	   
			$data['channel'] = $this->Channelmodel->getChannel();
	
		$this->load->view('include/header',$data);
		$this->load->view('include/breadcrum');
		$this->load->view('view_channel_list');
		$this->load->view('include/footer');
		
	}
	
	public function addChannel()
	{
		$this->load->view('include/header');
		$this->load->view('include/breadcrum');
		$this->load->view('add_channel');
		$this->load->view('include/footer');
	}
	
	public function insertChannel(){
		$data = $this->input->post();
		$this->load->library('upload');
		$attachment ="";
		if($data){
		    if($_FILES['channel_facebook_image']['name'] !="")
		    {
				$fieldName = 'channel_facebook_image';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'channel_facebook_image'.time().'.'.$ext;
				$this->upload->initialize($this->set_upload_options($attachment));
				
				if($this->upload->do_upload($fieldName))
				{
					$msg = "upload success"; //die;
				}
				else
				{
					$error = array('error' => $this->upload->display_errors());
					
				}
			}
		$data['channel_facebook_image'] = $attachment;
		
		if($result=$this->Channelmodel->insertChannel($data)){	
//echo $this->db->last_query(); die;		
			redirect(base_url().'channel/');
			}
		}
	}
	
	public function editChannel(){
		$data['channel'] = $this->Channelmodel->getChannel($this->input->get('id'));
		$this->load->view('include/header',$data);
		$this->load->view('include/breadcrum');
		$this->load->view('edit_channel');
		$this->load->view('include/footer');
	}
	
	
	public function updateChannel(){
		$this->load->library('upload');
		$data=$this->input->post();		
		if($data){
		$attachment ="";
		    if($_FILES['channel_facebook_image']['name'] !="")
		    {
				$fieldName = 'channel_facebook_image';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'channel_facebook_image'.time().'.'.$ext;
				$this->upload->initialize($this->set_upload_options($attachment));
				
				if($this->upload->do_upload($fieldName))
				{
					$msg = "upload success"; //die;
				}
				else
				{
					$error = array('error' => $this->upload->display_errors());
					
				}
			}
		$data['channel_facebook_image'] = $attachment;
		if($result=$this->Channelmodel->updateChannel($data)){
			
			redirect(base_url().'channel/');
			}
		}
	}
	
	public function deleteChannel()
	{
	    $id = $this->input->get('id');
		$result = $this->Channelmodel->deleteChannel($id);
			redirect(base_url().'channel/');
	}
	private function set_upload_options($imageName)
	{   
		//upload an image options
		$config = array();
		$config['upload_path'] = 'upload/images';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '50000KB';
		$config['overwrite']     = FALSE;
		$config['file_name']	 = $imageName;

		return $config;
	}
		
}
?>