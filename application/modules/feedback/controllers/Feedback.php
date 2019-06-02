<?php
class Feedback extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('citymodel');		
		$this->load->model('Seomodel');	
		$this->load->model('Feedbackmodel');	
		if(!isLoggedIn() || !isSuperAdmin())
         redirect('login');	
	}

	public function index()
	{       
        
	    $data['feedback'] = $this->Feedbackmodel->getFeedback();
		//echo "<pre>";print_r($data['feedback']);die;
		$this->load->view('include/header');
		$this->load->view('include/breadcrum');
		$this->load->view('view_feedback_list',$data);
		$this->load->view('include/footer');		
	 
	    
	}
	
	public function editFeedback(){
		//$postdata = $this->input->post();
	//	$data['subscription'] = $this->subscriptionmodel->getSubscriptionList();
		$data['feedback'] = $this->Feedbackmodel->getFeedback($status='1',$this->input->get('id'));
		//$data['city'] = $this->citymodel->getCity();
		//echo"<pre>";print_r($data);die;
		$this->load->view('include/header');
		$this->load->view('include/breadcrum');
		$this->load->view('edit_feedback_list',$data);
		$this->load->view('include/footer');
	}
	public function updateFeedback() 
	{
		$data=$this->input->post();		
		$res= $this->Feedbackmodel->feedbackUpdate($data);		
		if($res){				
				$this->session->set_flashdata('alert', 'Customer updated successfully');
				redirect(base_url().'feedback');
			}else{				
				$this->session->set_flashdata('alert', 'Failed to update try later.');				
			   redirect(base_url().'feedback');
			}
	}
	public function feedbackActiveStatus()
	{       
	    $result = $this->citymodel->cancelFeedbackStatus($this->input->post());
	    //echo "<pre>"; print_r($result);die;
		if($result)			
		{				
	    $data['feedback'] = $this->Feedbackmodel->getFeedback();
		//echo "<pre>";print_r($data['Product']);die;
		$this->load->view('include/header');
		$this->load->view('include/breadcrum');
		$this->load->view('view_feedback_list',$data);
		$this->load->view('include/footer');		
	 
	    }
	}

}
?>