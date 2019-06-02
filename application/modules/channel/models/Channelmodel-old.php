<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Channelmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function getChannel($ChannelId=NULL){
		$this->db->select('*');
		$this->db->from('channel');
		if($ChannelId){
		$this->db->where("channel_id", $ChannelId);
		}
		$query = $this->db->get();
	
//		echo $this->db->last_query();
		return $query->result_array();

	} 
	

	public function updateChannel($data){
		$id = $this->input->get('Id');
		if(!empty($data['channel_facebook_image'])){
			$arr['channel'] = array(	
					//"categories_id"=>$data['cc_title'],
					"channel_name"=>$data['channel_name'],
					"channel_title"=>$data['channel_title'],
					"channel_description"=>$data['channel_description'],
					"channel_keywords"=>$data['channel_keywords'],	
					"channel_facebook_image"=>$data['channel_facebook_image']
					
			);
		}
		if(empty($data['channel_facebook_image'])){
			$arr['channel'] = array(	
					//"categories_id"=>$data['cc_title'],
					"channel_name"=>$data['channel_name'],
					"channel_title"=>$data['channel_title'],
					"channel_description"=>$data['channel_description'],
					"channel_keywords"=>$data['channel_keywords']
					//"channel_facebook_image"=>$data['channel_facebook_image']
					
			);
		}
		//echo "<pre>";  print_r($arr['channel']); die;
		$result1=$this->db->update('channel', $arr['channel'], array('channel_id' => $data['channel_id']));
		//echo $this->db->last_query(); die;
		return true;
	}
	
	function insertChannel($data=NULL){
		$arr['channel'] = array(	
					//"categories_id"=>$data['cc_title'],
					"channel_name"=>$data['channel_name'],
					"channel_title"=>$data['channel_title'],
					"channel_description"=>$data['channel_description'],
					"channel_keywords"=>$data['channel_keywords'],	
					"channel_facebook_image"=>$data['channel_facebook_image']
					
			);
			//echo "<pre>";  print_r($arr['channel']); die;
			$this->db->insert('channel', $arr['channel']);
			return true;
	}
	function deleteChannel($id)
		{
		   $this->db->where('channel_id', $id);
		   $this->db->delete('channel'); 
		}
	
	
}
?>