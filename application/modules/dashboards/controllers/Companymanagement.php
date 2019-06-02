<?php 
class Companymanagement extends CI_Controller {
	
	public function __construct()
   {  
	parent::__construct(); 
		
		$this->load->helper('common');
	 	$this->load->model('Companymodel');
		$this->load->library('upload');
   } 

	public function index()
	{
		$data['allcompany']=$this->Companymodel->getCompanies();
		//echo "<pre>"; print_r($data); die;
		$this->load->view('includes/head',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('includes/header');
	    $this->load->view('view-company-list');
		$this->load->view('includes/footer');
	}
	public function addCompany()
	{
		//$data['allCategories']=$this->Projectsmodel->getCategories();
		//echo "<pre>"; print_r($data); die;
		$this->load->view('includes/head');
		$this->load->view('includes/leftmenu');
		$this->load->view('includes/header');
	    $this->load->view('add-company');
		$this->load->view('includes/footer');
	}
	public function submitnewCompany()
	{
		$data = $this->input->post();
		$result = $this->Companymodel->submitnewCompany($data);
		if($result)
		{
			redirect(base_url().'companymanagement?msg=insert_success');
		}
	}
	public function editCompany()
	{	
		$id = $this->input->get('id');
		$data['allcompany'] = $this->Companymodel->getCompanies($id);
		$this->load->view('includes/head',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('includes/header');
	    $this->load->view('edit-company');
		$this->load->view('includes/footer');
	}
	public function updateCompany()
	{	
		$data = $this->input->post();
		$id = $this->input->get('id');
		$result = $this->Companymodel->updateCompany($id,$data);
		if($result)
		{
			redirect(base_url().'companymanagement?msg=update_success');
		}
	}
	
	public function ActiveStatus(){
		$result = $this->Companymodel->ActiveStatus($this->input->post());
		if($result)			
		{				
	         redirect(base_url().'companymanagement');		
	 
	    }
	}
	
	/* public function editMember()
	{
		$data['input'] = $this->input->post();	
		if($data['input']){
			$attachment ="";
			$file=$_FILES;
			
			//echo "<pre>"; print_r($data); die;
			if($_FILES['memberImg']['name'] !="")
		    {
				$fieldName = 'memberImg';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'designaxis_memberImg_'.time().'.'.$ext;
				//echo "<pre>";print_r($attachment);die;
				 $this->upload->initialize($this->set_upload_options($attachment)); 
				if($this->upload->do_upload($fieldName))
				{
					$msg = "upload success"; //die;
				}
				else
				{
					$error = array('error' => $this->upload->display_errors());
					
				}
			
			    //print_r($_FILES); die;
			}
			

			$data['input']['memberImg'] = $attachment;		
			//echo "<pre>"; print_r($data); die;
			if($data['input']){
				$result=$this->Teammodel->updateMember($data['input']);
			}
			if($result){
				redirect(base_url().'team?success=updatetrue');
			}else{
				redirect(base_url().'team?success=updatefalse');
			}
		}else{
		$data['allProjects']=$this->Projectsmodel->getProjects();
		$data['team']=$this->Teammodel->getTeam();
		foreach($data['team'] as $details){
				if($details->id == $this->input->get('id')){
					$data['member']=$details;
				}
			}
		//echo "<pre>"; print_r($data); die;
		$this->load->view('include/header',$data);
		$this->load->view('include/left-sidebar');
		$this->load->view('include/breadcrum');
	    $this->load->view('edit-member');
		$this->load->view('include/footer');
		}
	}
	
	public function submitNewMember(){
		
		$data['input'] = $this->input->post();	
		$attachment ="";
		$file=$_FILES;
			if($_FILES['memberImg']['name'] !="")
		    {
				$fieldName = 'memberImg';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'designaxis_membertImg_'.time().'.'.$ext;
				//echo "<pre>";print_r($attachment);die;
				 $this->upload->initialize($this->set_upload_options($attachment)); 
				if($this->upload->do_upload($fieldName))
				{
					$msg = "upload success"; //die;
				}
				else
				{
					$error = array('error' => $this->upload->display_errors());
					
				}
			
			    //print_r($_FILES); die;
			}
			

		$data['input']['memberImg'] = $attachment;		
		//echo "<pre>"; print_r($data); die;
		if($data['input']){
			$result=$this->Teammodel->insertMember($data['input']);
		}
		if($result){
			redirect(base_url().'team?success=true');
		}else{
			redirect(base_url().'team?success=false');
		}			
	}
	
	private function set_upload_options($attachment)
    {   
        $config = array();
        $config['upload_path']   = FCPATH . 'upload';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 0;
        $config['overwrite']     = TRUE;		
		$config['file_name']	 = $attachment;

        return $config;
    } */
	
}
?>