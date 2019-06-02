<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoriesmanage extends CI_Controller {
    function __construct() {
        parent::__construct();
       $this->load->model('Categoriesmodel');
	   if(!isLoggedIn() && !isSuperAdmin())
				redirect('login');
    }

public function index()
{
   
		$data['category'] = $this->Categoriesmodel->getSelectCategory(); 
		//echo "<pre>"; print_r($data); die;
        $this->load->view('include/header',$data); 
		$this->load->view('include/breadcrum'); 
		$this->load->view('view_cat_list');
		$this->load->view('include/footer');
}
public function viewSubCategory()
{
   
		$data['category'] = $this->Categoriesmodel->getsubCategory($this->input->get('categoryId')); 
	//	echo "<pre>"; print_r($data); die;
        $this->load->view('include/header',$data); 
		$this->load->view('include/breadcrum'); 
		$this->load->view('view_subcat_list');
		$this->load->view('include/footer');
}
public function addCategory()
{
   
        $this->load->view('include/header'); 
		$this->load->view('include/breadcrum'); 
		$this->load->view('add-category');
		$this->load->view('include/footer');
}
public function addSubCategory()
{
   
        $this->load->view('include/header'); 
		$this->load->view('include/breadcrum'); 
		$this->load->view('add-sub-category');
		$this->load->view('include/footer');
}
public function getCategory()
{
      // $id = $this->input->get('category');
	   //echo "<pre>";print_r($id);die;
    $data['category'] = $this->Categoriesmodel->getSelectCategory();  
        $this->load->view('include/header'); 
		$this->load->view('include/breadcrum'); 
		$this->load->view('categoryview',$data);
		$this->load->view('include/footer');
}
public function editCategory()
{
    $id = $this->input->get('categoryId');
    $data['category'] = $this->Categoriesmodel->getCategoryById($id); 
    //echo "<pre>";print_r($data['category']);die;	
        $this->load->view('include/header'); 
		$this->load->view('include/breadcrum'); 
		$this->load->view('editCategory',$data);
		$this->load->view('include/footer');
}
public function updateCategory()
{
	$data=$this->input->post();		
		$res= $this->Categoriesmodel->categoryUpdate($data);		
		if($res){				
				$this->session->set_flashdata('alert', 'Category updated successfully');
				redirect(base_url().'categories/Categoriesmanage');
			}else{				
				$this->session->set_flashdata('alert', 'Failed to update try later.');				
			   redirect(base_url().'categories/Categoriesmanage');
			}
}
public function addCategoryData()
{
   
   $data = $this->input->post();
   $result=$this->Categoriesmodel->addCategory($data);	
			if($result){
				$this->session->set_flashdata('alert', 'Category added successfully');	
			redirect(base_url().'categories/Categoriesmanage');
			}else{
				
				$this->session->set_flashdata('alert', 'Enter Category name.');	
				redirect(base_url().'categories/Categoriesmanage/addCategory');
			}

		if($result){
			$this->session->set_flashdata('alert', 'Category added successfully');	
			redirect(base_url().'categories/Categoriesmanage');
		}else{
			
			$this->session->set_flashdata('alert', 'Category Name already exist.');	
			redirect(base_url().'categories/Categoriesmanage');
		}
		
}
public function addSubCategoryData()
{
   
   $data = $this->input->post();
   
		$this->load->library('upload');
		if(trim($data['category'])){
			if($_FILES['logo']['name'] !="")
		    {
			    $imgPath = 'upload/category/';
				$fieldName = 'logo';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'category_logo_'.time().'.'.$ext;
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
				$result=$this->Categoriesmodel->addSubCategory($data);				
			}else{
				
				$this->session->set_flashdata('alert', 'Enter Category name.');	
				redirect(base_url().'categories/Categoriesmanage/addCategory');
			}
		}else{
			$this->session->set_flashdata('alert', 'Enter Category name.');	
			redirect(base_url().'categories/Categoriesmanage/addCategory');
		}
		if($result){
			$this->session->set_flashdata('alert', 'Category added successfully');	
			redirect(base_url().'categories/Categoriesmanage');
		}else{
			
			$this->session->set_flashdata('alert', 'Category Name already exist.');	
			redirect(base_url().'categories/Categoriesmanage');
		}
	
}
public function deleteCategoryInfo($id)
	{
	    //$this->load->model('Servicesmodel');
		$result = $this->Categoriesmodel->deleteCategory($id);
		if($result)
		{
			redirect(base_url()."Categorymanage/getCategory?msg=delete");
		}
	}
	public function ActiveStatus(){
		$result = $this->Categoriesmodel->ActiveStatus($this->input->post());
		if($result)			
		{				
	         redirect(base_url().'categories/Categoriesmanage');		
	 
	    }
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