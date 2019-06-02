<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('Postmodel');
		$this->load->model('market/Marketmodel');
		$this->load->model('channel/Channelmodel');
		$this->load->model('profile/Profilemodel');
		$this->load->model('user/Usermodel');
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
		
		if(isset($_GET['status'])){ 
				if($this->input->get('status')){
					$ps_status = $this->input->get('status');
				}
				else{
					$ps_status =NULL;
				}
			 $data['posts'] = $this->Postmodel->getPosts('',$ps_status);
			}elseif(isset($_GET['statusall'])){
				$data['posts'] = $this->Postmodel->getPostsonly();
			}
			else{
		 		$data['posts'] = $this->Postmodel->getPosts();
			}
	
		$this->load->view('include/header',$data);
		$this->load->view('include/breadcrum');
		$this->load->view('view_posts_list');
		$this->load->view('include/footer');
		
	}
	
	public function addPost()
	{
		$data['UserLists']=$this->Usermodel->getUserOnly();
		//echo "<pre>"; print_r($data['UserLists']);die;
		$this->load->view('include/header');
		$this->load->view('include/breadcrum');
		$this->load->view('add_posts', $data);
		$this->load->view('include/footer');
	}
	
	public function insertPost(){
		$data = $this->input->post();
		$this->load->library('upload');
		$attachment ="";
		if($data){
		    if($_FILES['post_image']['name'] !="")
		    {
				$fieldName = 'post_image';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'post_image'.time().'.'.$ext;
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
		$data['post_image'] = $attachment;
		$attachment1 ="";
		if($data){
		    if($_FILES['post_html']['name'] !="")
		    {
				$fieldName = 'post_html';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment1 = 'post_html'.time().'.'.$ext;
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
		$data['post_html'] = $attachment1;
		
		if($result=$this->Postmodel->insertPost($data)){				
			redirect(base_url().'post/');
			}
		}
	}
}
	
	public function editPost(){
		$data['UserLists']=$this->Usermodel->getUserOnly();
		$data['marketLists']=$this->Marketmodel->getMarketList();
		$data['channelLists']=$this->Channelmodel->getChannel();
		$data['profileLists']=$this->Profilemodel->getProfileOnly();
		$data['marketAddedLists']=$this->Postmodel->getAddedMarketsById($this->input->get('id'));
		$data['profileAddedLists']=$this->Postmodel->getAddedProfileById($this->input->get('id'));
		$data['channelAddedLists']=$this->Postmodel->getAddedChannelById($this->input->get('id'));
		$data['statusLists']=$this->Postmodel->getPostStatusById($this->input->get('id'));
		$data['posts'] = $this->Postmodel->getPostsonly($this->input->get('id'));
		$data['UserLists']=$this->Usermodel->getUserOnly();
		$this->load->view('include/header',$data);
		$this->load->view('include/breadcrum');
		$this->load->view('edit_posts');
		$this->load->view('include/footer');
	}
	
	
	public function updatePost(){
		$this->load->library('upload');
		$data=$this->input->post();	
		if(count($data['markets']) > 0){
			$this->Postmodel->updatePostMarket($data['post_id'], $data['markets']);
		}else{
			$this->Postmodel->deleteAllPostMarket($data['post_id']);
		}
		if(count($data['channel']) > 0){
			$this->Postmodel->updatePostChannel($data['post_id'], $data['channel']);
		}else{
			$this->Postmodel->deleteAllPostChannel($data['post_id']);
		}
		if(count($data['profile']) > 0){
			$this->Postmodel->updatePostProfile($data['post_id'], $data['profile']);
		}else{
			$this->Postmodel->deleteAllPostProfile($data['post_id']);
		}
		//if(count(($data['post_status']) > 0) || count(($data['post_notes']) > 0)){
			//$this->Postmodel->updatePostStatus($data['post_id'], $data);
		//}else{
			//$this->Postmodel->deletePostStatus($data['post_id']);
		//}
		$attachment ="";
		if($data){
		    if($_FILES['post_image']['name'] !="")
		    {
				$fieldName = 'post_image';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'post_image'.time().'.'.$ext;
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
		}
		$data['post_image'] = $attachment;
		$attachment1 ="";
		if($data){
		    if($_FILES['post_html']['name'] !="")
		    {
				$fieldName = 'post_html';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment1 = 'post_html'.time().'.'.$ext;
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
		$data['post_html'] = $attachment1;
		
		if($result=$this->Postmodel->updatePost($data)){				
			redirect(base_url().'post/');
			}
		}	
	}
	public function postStatus()
	{
		
		$data['statusLists']=$this->Postmodel->getPostStatusById($this->input->get('id'));
		//echo "<pre>"; print_r($data); die;
		$this->load->view('include/header');
		$this->load->view('include/breadcrum');
		$this->load->view('status_post', $data);
		$this->load->view('include/footer');
	}
	public function addPostStatus(){
		$postId = $this->input->get('Id');
		$data = $this->input->post();
		$this->load->library('upload');
		if($result=$this->Postmodel->addPostStatus($postId, $data)){				
			redirect(base_url().'post/postStatus?id='.$postId);
			}
		}
	public function deletePost()
	{
	    $id = $this->input->get('id');
		$result = $this->Postmodel->deletePost($id);
			redirect(base_url().'post/');
	}
	public function deleteStatus()
	{
		$postId = $this->input->get('postId');
		//echo "<pre>"; print_r($postId); die;
	    $id = $this->input->get('id');
		$result = $this->Postmodel->deleteStatus($id);
			redirect(base_url().'post/postStatus?id='.$postId);
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