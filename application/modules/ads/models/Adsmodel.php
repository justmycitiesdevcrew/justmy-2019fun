<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Adsmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function getAds($AdsId=NULL){
		$this->db->select('*');
		$this->db->from('ads a');
			$this->db->join('markets b','b.market_id = a.market_id');
			$this->db->join('profiles c','c.profile_id = a.profile_id');
			$this->db->order_by("id", "DESC");
		if($AdsId){
		$this->db->where("id", $AdsId);
		}
		$query = $this->db->get();
	
		//echo $this->db->last_query();
		return $query->result_array();

	}
	public function getAddedCategoriesById($AdsId=NULL){
		$this->db->select('*');
		$this->db->from('ad_cat');
		if($AdsId){
		$this->db->where("ad_id", $AdsId);
		}
		$query = $this->db->get();
	
//echo $this->db->last_query();
		return $query->result_array();

	} 
	public function getAddedChannelById($AdsId=NULL){
		$this->db->select('*');
		$this->db->from('ad_channels');
		if($AdsId){
		$this->db->where("ad_id", $AdsId);
		}
		$query = $this->db->get();
	
//		echo $this->db->last_query();
		return $query->result_array();

	} 
	
	public function updateAd($data){
		$id = $this->input->get('Id');
		if(!empty($data['ad_video']) && !empty($data['ad_banner'])){
			$arr['ads'] = array(
					"market_id"=>$data['market_name'],
					"profile_id"=>$data['profile_name'],
					"ad_type"=>$data['ad_type'],
					"ad_size"=>$data['ad_size'],	
					"ad_link"=>$data['ad_link'],
					"ad_video"=>$data['ad_video'],
					"ad_banner"=>$data['ad_banner'],
					"ad_url"=>$data['ad_url'],
					"ad_code"=>$data['ad_code']
					
			);
		}
		if(empty($data['ad_video']) && !empty($data['ad_banner'])){
			$arr['ads'] = array(
					"market_id"=>$data['market_name'],
					"profile_id"=>$data['profile_name'],
					"ad_type"=>$data['ad_type'],
					"ad_size"=>$data['ad_size'],	
					"ad_link"=>$data['ad_link'],
					//"ad_video"=>$data['ad_video'],
					"ad_banner"=>$data['ad_banner'],
					"ad_url"=>$data['ad_url'],
					"ad_code"=>$data['ad_code']
					
			);
		}
		if(!empty($data['ad_video']) && empty($data['ad_banner'])){
			$arr['ads'] = array(
					"market_id"=>$data['market_name'],
					"profile_id"=>$data['profile_name'],
					"ad_type"=>$data['ad_type'],
					"ad_size"=>$data['ad_size'],	
					"ad_link"=>$data['ad_link'],
					"ad_video"=>$data['ad_video'],
					//"ad_banner"=>$data['ad_banner'],
					"ad_url"=>$data['ad_url'],
					"ad_code"=>$data['ad_code']
					
			);
		}
		if(empty($data['ad_video']) && empty($data['ad_banner'])){
			$arr['ads'] = array(
					"market_id"=>$data['market_name'],
					"profile_id"=>$data['profile_name'],
					"ad_type"=>$data['ad_type'],
					"ad_size"=>$data['ad_size'],	
					"ad_link"=>$data['ad_link'],
					//"ad_video"=>$data['ad_video'],
					//"ad_banner"=>$data['ad_banner'],
					"ad_url"=>$data['ad_url'],
					"ad_code"=>$data['ad_code']
					
			);
		}
			//echo "<pre>";  print_r($arr['ads']); die;
			$this->db->update('ads', $arr['ads'],array('id' => $id));
			//echo $this->db->last_query(); die;
			return true;
	}
	
	function insertAd($data=NULL){
		$arr['ads'] = array(
					"market_id"=>$data['market_name'],
					"profile_id"=>$data['profile_name'],
					"ad_type"=>$data['ad_type'],
					"ad_size"=>$data['ad_size'],	
					"ad_link"=>$data['ad_link'],
					"ad_video"=>$data['ad_video'],
					"ad_banner"=>$data['ad_banner'],
					"ad_url"=>$data['ad_url'],
					"ad_code"=>$data['ad_code']
					
			);
			$this->db->insert('ads', $arr['ads']);
			//echo $this->db->last_query(); die;
			return true;
	}
	public function updateAdCategory($AdsId=null, $data=Null){
			$this->deleteAllAdCategories($AdsId);
			//echo "<pre>";  print_r($data); die;
			foreach($data as $categorie){
				$array['ad_cat'] = array(
					"cat_id" => $categorie,
					"ad_id" => $AdsId
				);
				//echo "<pre>";  print_r($array['cat_channels']); die;
				$this->db->insert('ad_cat', $array['ad_cat']);
				//echo $this->db->last_query(); die;
			}
		return true;
	}
	public function updateAdChannel($AdsId=null, $data=Null){
			$this->deleteAllAdChannel($AdsId);
			//echo "<pre>";  print_r($data); die;
			foreach($data as $channel){
				$array['ad_channels'] = array(
					"channel_id" => $channel,
					"ad_id" => $AdsId
				);
				//echo "<pre>";  print_r($array['cat_channels']); die;
				$this->db->insert('ad_channels', $array['ad_channels']);
				//echo $this->db->last_query(); die;
			}
		return true;
	}
	function deleteAd($id)
	{
		$this->deleteAllAdChannel($id);
		$this->deleteAllAdCategories($id);
	   $this->db->where('id', $id);
	   $this->db->delete('ads');
	//echo $this->db->last_query(); die;
	}
	public function deleteAllAdChannel($AdsId=NULL){
		if($AdsId){
			$this->db->where('ad_id', $AdsId);
			$this->db->delete('ad_channels'); 
		}
	}
	public function deleteAllAdCategories($AdsId=NULL){
		if($AdsId){
			$this->db->where('ad_id', $AdsId);
			$this->db->delete('ad_cat'); 
		}
	}
}

?>