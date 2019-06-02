<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Marketpages extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Marketpagesmodel');
        $this->load->library('session');
    }
    
    public function index(){
        
        $inputData['domain'] = $_GET['url'];
        $data['marketData'] = $this->Marketpagesmodel->getMarketList($inputData['domain']);
        //echo "<pre>"; print_r($data); die;
        //die($inputData['domain']);
        $this->load->view('marketpages',$data);
    }
}	