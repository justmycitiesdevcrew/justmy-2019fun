<?php 
class Skills extends CI_Controller {
	
	public function __construct()
   {  
	parent::__construct(); 
		
		$this->load->helper('common');
	 	$this->load->model('Skillsmodel');
		$this->load->library('upload');
   } 

	public function index()
	{
		$data['allskills']=$this->Skillsmodel->getSkills();
		//echo "<pre>"; print_r($data); die;
		$this->load->view('includes/head',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('includes/header');
	    $this->load->view('view-skills-list');
		$this->load->view('includes/footer');
	}
	public function addnewSkill()
	{
		//$data['allCategories']=$this->Projectsmodel->getCategories();
		//echo "<pre>"; print_r($data); die;
		$this->load->view('includes/head');
		$this->load->view('includes/leftmenu');
		$this->load->view('includes/header');
	    $this->load->view('add-skills');
		$this->load->view('includes/footer');
	}
	public function submitNewSkill()
	{
		$data = $this->input->post();
		$result = $this->Skillsmodel->submitNewSkill($data);
		if($result)
		{
			redirect(base_url().'skills?msg=insert_success');
		}
	}
	public function editSkill()
	{	
		$id = $this->input->get('id');
		$data['allskills'] = $this->Skillsmodel->getSkills($id);
		$this->load->view('includes/head',$data);
		$this->load->view('includes/leftmenu');
		$this->load->view('includes/header');
	    $this->load->view('edit-skills');
		$this->load->view('includes/footer');
	}
	public function updateSkills()
	{	
		$data = $this->input->post();
		$id = $this->input->get('id');
		$result = $this->Skillsmodel->updateSkills($id,$data);
		if($result)
		{
			redirect(base_url().'skills?msg=update_success');
		}
	}
	
	public function ActiveStatus(){
		$result = $this->Skillsmodel->ActiveStatus($this->input->post());
		if($result)			
		{				
	         redirect(base_url().'skills');		
	 
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