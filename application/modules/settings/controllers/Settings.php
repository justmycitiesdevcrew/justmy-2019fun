<?php
class Settings extends CI_Controller

{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Accountsmodel');
		$this->load->helper('common');
        if(!isLoggedIn() && !isSuperAdmin())
         redirect('Login');	
	}
	
	
	public function index(){
		$data['settings'] = $this->Accountsmodel->getSettings();
		$this->load->view('include/header',$data);
		$this->load->view('include/breadcrum');
		$this->load->view('edit_setting');
		$this->load->view('include/footer');
	}
	public function updatesetting(){
		$data = $this->input->post();
		$this->load->library('upload');
		if($data){
			if($_FILES['logo']['name'] !="")
		    {
			    $imgPath = 'upload/';
				$fieldName = 'logo';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'company_logo_'.time().'.'.$ext;
				$this->upload->initialize($this->set_upload_options($attachment,$imgPath));
				if($this->upload->do_upload($fieldName))
				{
					$msg = "upload success"; 
				}
				else
				{
					$error = array('error' => $this->upload->display_errors());
				}			
				$data['profilePhoto'] = $attachment; 
//	echo"<pre>"; print_r($data); //die;				
				$this->Accountsmodel->updatesettinglogo($data);				
			}else{	
				$this->Accountsmodel->updatesetting($data);	
			}
		}
		
				$this->session->set_flashdata('alert', 'Updated successfully');			
				redirect(base_url().'settings');
			   
	}
	private function set_upload_options($imageName,$imgPath) {  
		//print_r($imgPath); die;
		$config = array();
		$config['upload_path']   = $imgPath;
		$config['allowed_types'] = 'gif|jpg|png|pdf';
		$config['max_size']      = '50000KB';
		$config['overwrite']     = FALSE;
		$config['file_name']	 = $imageName;
		return $config;
	} 
}
?>