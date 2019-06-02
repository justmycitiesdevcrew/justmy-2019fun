<?php
class Blogs extends CI_Controller{

    function __construct(){
        parent::__construct();        
		$this->load->model('blog/Blogmodel');
		$this->load->model('blogcategories/Categoriesmodel');
		
		$this->load->model('newsandoffers/Newsandoffersmodel');
		$this->load->model('newsofferscategories/Newsofferscategoriesmodel');
    }

    public function index(){
		$data['blogs'] = $this->Blogmodel->getBlogList($status='1');
		$data['seo']['title'] = '';
		$data['seo']['description'] = '';
		$data['seo']['keywords'] = '';
		$data['categoryLists'] = $this->Categoriesmodel->getCategories($status='1');
		//echo "<pre>"; print_r($data); die;
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('blogs-list',$data);	
		$this->load->view('footer');
    }
		
	public function search(){
		//echo "testing"; die;
		$data['term'] =$this->uri->segment(2);
		$data['blogs'] = $this->Blogmodel->getBlogList($status='1','','');
		  if($data['blogs']){
			foreach($data['blogs'] as $list){
				  if($list['blog_url'] == $data['term']){
					  $data['seo']['title'] = $list['seo_title'];
					  $data['seo']['description'] = $list['seo_description'];
					  $data['seo']['keywords'] = $list['seo_keywords'];
				  }
			}
		  }else{
			   $data['seo']['title'] = '';
			   $data['seo']['description'] = '';
		       $data['seo']['keywords'] = '';
		  }
		//echo "<pre>"; print_r($data); die;
		$data['categoryLists'] = $this->Categoriesmodel->getCategories($status='1');
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('blog-view',$data);	
		$this->load->view('footer');
	}
	
	public function searchCategory($searchCat){
		//echo "testing"; die;
		$data['blogs'] = $this->Blogmodel->getBlogList($status='1','','','',$searchCat);
		$data['seo']['title'] = '';
		$data['seo']['description'] = '';
		$data['seo']['keywords'] = '';
		$data['categoryLists'] = $this->Categoriesmodel->getCategories($status='1');
		//echo "<pre>"; print_r($data); die;
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('blogs-list',$data);	
		$this->load->view('footer');
	}
	
	
	
	
	
    public function newsandoffers(){
		$data['blogs'] = $this->Newsandoffersmodel->getBlogList($status='1');
		$data['seo']['title'] = '';
		$data['seo']['description'] = '';
		$data['seo']['keywords'] = '';
		$data['categoryLists'] = $this->Newsofferscategoriesmodel->getCategories($status='1');
		//echo "<pre>"; print_r($data); die;
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('news-offers-list',$data);	
		$this->load->view('footer');
    }
	
	public function searchNewsandoffers(){
		//echo "testing"; die;
		$data['term'] =$this->uri->segment(2);
		$data['blogs'] = $this->Newsandoffersmodel->getBlogList($status='1','','');
		  if($data['blogs']){
			foreach($data['blogs'] as $list){
				  if($list['blog_url'] == $data['term']){
					  $data['seo']['title'] = $list['seo_title'];
					  $data['seo']['description'] = $list['seo_description'];
					  $data['seo']['keywords'] = $list['seo_keywords'];
				  }
			}
		  }else{
			   $data['seo']['title'] = '';
			   $data['seo']['description'] = '';
		       $data['seo']['keywords'] = '';
		  }
		//echo "<pre>"; print_r($data); die;
		$data['categoryLists'] = $this->Newsofferscategoriesmodel->getCategories($status='1');
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('news-and-offers-view',$data);	
		$this->load->view('footer');
	}
	
	
	public function searchNewsandoffersCat($searchCat){
		//echo "testing"; die;
		$data['blogs'] = $this->Newsandoffersmodel->getBlogList($status='1','','','',$searchCat);
		$data['seo']['title'] = '';
		$data['seo']['description'] = '';
		$data['seo']['keywords'] = '';
		$data['categoryLists'] = $this->Newsofferscategoriesmodel->getCategories($status='1');
		//echo "<pre>"; print_r($data); die;
		$this->load->view('head',$data);
		$this->load->view('header');
		$this->load->view('news-offers-list',$data);	
		$this->load->view('footer');
	}
	
}
?>