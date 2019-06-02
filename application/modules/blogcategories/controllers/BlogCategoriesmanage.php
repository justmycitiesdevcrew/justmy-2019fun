<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlogCategoriesmanage extends CI_Controller {
    function __construct() {
        parent::__construct();
       $this->load->model('Categoriesmodel');
	   	$this->load->library('upload');
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
		
		$attachment = '';
			if($_FILES['logoIcon']['name'] !="")
		    {
				$fieldName = 'logoIcon';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'blog_category_icon_'.time().'.'.$ext;
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
				
			}
			$data['logoIcon'] = $attachment;
			$res= $this->Categoriesmodel->categoryUpdate($data);
		if($res){
			$this->session->set_flashdata('alert', 'Category updated successfully');
			
				redirect(base_url().'blogcategories/BlogCategoriesmanage/');
			}else{	
			$this->session->set_flashdata('alert', 'Failed to update try later.');	
			redirect(base_url().'blogcategories/BlogCategoriesmanage/');		
			}
	}

public function addCategoryData()
{
   
   $data = $this->input->post();
   $attachment ="";
		if($data){
				
		    if($_FILES['logoIcon']['name'] !="")
		    {
				$fieldName = 'logoIcon';
				$ext = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
				$attachment = 'blog_category_icon'.time().'.'.$ext;
				$this->upload->initialize($this->set_upload_options($attachment));
				
			if($this->upload->do_upload($fieldName))
			{
				$msg = "upload success"; //die;
			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				
			}
				$data['logoIcon'] = $attachment;
			//	echo "<pre>"; print_r($data); die;
		
				$result=$this->Categoriesmodel->addCategory($data);				
				$this->session->set_flashdata('alert', 'Category Submit Successfully!');	
				redirect(base_url().'blogcategories/BlogCategoriesmanage/');
			}else{	
				$this->session->set_flashdata('alert', 'Category Submit failed!');	
				redirect(base_url().'blogcategories/BlogCategoriesmanage/');
			}
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
	         redirect(base_url().'blogcategories/BlogCategoriesmanage');		
	 
	    }
	}
	private function set_upload_options($imageName)
	{   
		//upload an image options
		$config = array();
		$config['upload_path'] = 'upload/blogcategory';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '100000';
		$config['overwrite']     = FALSE;
		$config['file_name']	 = $imageName;

		return $config;
	}

}
?>