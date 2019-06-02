<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ads extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Adsmodel');
		$this->load->model('market/Marketmodel');
		$this->load->model('profile/Profilemodel');
		$this->load->model('channel/Channelmodel');
		$this->load->model('categories/Categoriesmodel');
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
	   
			$data['ads'] = $this->Adsmodel->getAds();
			//echo "<pre>"; print_r($data['ads']);die;
	
		$this->load->view('include/header',$data);
		$this->load->view('include/breadcrum');
		$this->load->view('view_ads_list');
		$this->load->view('include/footer');
		
	}
	
	public function addAds()
	{
		
		$data['profileLists']=$this->Profilemodel->getProfileOnly();
		$data['marketLists']=$this->Marketmodel->getMarketList();
		
		$this->load->view('include/header');
		$this->load->view('include/breadcrum');
		$this->load->view('add_ads', $data);
		$this->load->view('include/footer');
	}
	
	public function insertAd(){
		$data = $this->input->post();
		$this->load->library('upload');
		$attachment ="";
		    if($_FILES['ad_video']['name'] !="")
		    {
				$fieldName = 'ad_video';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'ad_video'.time().'.'.$ext;
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
		$data['ad_video'] = $attachment;
		$attachment1 ="";
		    if($_FILES['ad_banner']['name'] !="")
		    {
				$fieldName = 'ad_banner';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment1 = 'ad_banner'.time().'.'.$ext;
				$this->upload->initialize($this->set_upload_options($attachment1));
				
				if($this->upload->do_upload($fieldName))
				{
					$msg = "upload success"; //die;
				}
				else
				{
					$error = array('error' => $this->upload->display_errors());
					
				}
			}
		$data['ad_banner'] = $attachment1;
		if($result=$this->Adsmodel->insertAd($data)){				
			redirect(base_url().'ads/');
			}
	}
	
	public function editAd(){
		$data['profileLists']=$this->Profilemodel->getProfileOnly();
		$data['marketLists']=$this->Marketmodel->getMarketList();
		$data['channelLists']=$this->Channelmodel->getChannel();
		$data['categoryLists']=$this->Categoriesmodel->getCategories();
		$data['categoryAddedLists']=$this->Adsmodel->getAddedCategoriesById($this->input->get('id'));
		$data['channelAddedLists']=$this->Adsmodel->getAddedChannelById($this->input->get('id'));
		$data['ads'] = $this->Adsmodel->getAds($this->input->get('id'));
		//echo "<pre>"; print_r($data['ads']);die;
		$this->load->view('include/header',$data);
		$this->load->view('include/breadcrum');
		$this->load->view('edit_ads', $data);
		$this->load->view('include/footer');
	}
	
	
	public function updateAd(){
		$data=$this->input->post();	
		if(count($data['categories']) > 0){
			$this->Adsmodel->updateAdCategory($data['id'], $data['categories']);
		}else{
			$this->Adsmodel->deleteAllAdCategories($data['id']);
		}
		if(count($data['channel']) > 0){
			$this->Adsmodel->updateAdChannel($data['id'], $data['channel']);
		}else{
			$this->Adsmodel->deleteAllAdChannel($data['id']);
		}
		$this->load->library('upload');
		$attachment ="";
		    if($_FILES['ad_video']['name'] !="")
		    {
				$fieldName = 'ad_video';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'ad_video'.time().'.'.$ext;
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
		$data['ad_video'] = $attachment;
		$attachment1 ="";
		    if($_FILES['ad_banner']['name'] !="")
		    {
				$fieldName = 'ad_banner';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment1 = 'ad_banner'.time().'.'.$ext;
				$this->upload->initialize($this->set_upload_options($attachment1));
				
				if($this->upload->do_upload($fieldName))
				{
					$msg = "upload success"; //die;
				}
				else
				{
					$error = array('error' => $this->upload->display_errors());
					
				}
			}
		$data['ad_banner'] = $attachment1;
		//echo "<pre>"; print_r($data);die;
		if($result=$this->Adsmodel->updateAd($data)){				
			redirect(base_url().'ads/');
			}
	}
	
	public function deleteAd()
	{
	    $id = $this->input->get('id');
		$result = $this->Adsmodel->deleteAd($id);
			redirect(base_url().'ads/');
	}
	private function set_upload_options($imageName)
	{   
		//upload an image options
		$config = array();
		$config['upload_path'] = 'upload/adsdata';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|mp4';
		$config['max_size']      = '50000KB';
		$config['overwrite']     = FALSE;
		$config['file_name']	 = $imageName;

		return $config;
	}
		
}
?>