<?php 
class Team extends CI_Controller {
	
	public function __construct()
   {  
	parent::__construct(); 
		
		$this->load->helper('common'); 
		$this->load->model('Teammodel');
		$this->load->library('upload');
        if(!isLoggedIn())
         redirect('login');
   }

	public function index()
	{ 
		$data['team']=$this->Teammodel->getTeam();
		//echo "<pre>"; print_r($data); die;
		$this->load->view('include/header',$data); 
	    $this->load->view('view-team-list');
		$this->load->view('include/footer');
	}
	public function addmember()
	{ 
		$this->load->view('include/header'); 
	    $this->load->view('add-member');
		$this->load->view('include/footer');
	}
	public function editMember()
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
				$attachment = 'PrasukImg_'.time().'.'.$ext;
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
		$data['team']=$this->Teammodel->getTeam();
		foreach($data['team'] as $details){
				if($details->id == $this->input->get('id')){
					$data['member']=$details;
				}
			}
		//echo "<pre>"; print_r($data); die;
		$this->load->view('include/header',$data); 
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
				$attachment = 'prasukImg_'.time().'.'.$ext;
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
	public function ActiveStatus(){
		$result = $this->Teammodel->ActiveStatus($this->input->post());
		if($result)			
		{				
	         redirect(base_url().'team');		
	 
	    }
	}
	private function set_upload_options($attachment)
    {   
        $config = array();
        $config['upload_path']   = FCPATH . 'upload';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 100000;
        $config['overwrite']     = TRUE;		
		$config['file_name']	 = $attachment;

        return $config;
    }
	
}
?>