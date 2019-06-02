<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Postmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function getPosts($PostId=NULL,$ps_status){
		$this->db->select('*');
		$this->db->from('c_posts i');
		$this->db->join('c_users b','b.user_id = i.c_user_id');
		$this->db->join('post_status c','c.post_id = i.post_id');
		$this->db->order_by("i.post_id", "DESC");

		if(!empty($ps_status)){
			$this->db->where("ps_status", $ps_status);
		}
		else{
			$this->db->where("ps_status", "pending");
		}

		$query = $this->db->get();
//		echo $this->db->last_query();
		return $query->result_array();

	}
	function getPostsonly($PostId=NULL){
		$this->db->select('*');
		$this->db->from('c_posts i');
		$this->db->join('c_users b','b.user_id = i.c_user_id');
		$this->db->order_by("i.post_id", "DESC");
		if($PostId){
			$this->db->where("post_id", $PostId);
		}
		$query = $this->db->get();
//echo $this->db->last_query(); die;
		return $query->result_array();

	}

	function insertPost($data=NULL){
		$arr['post'] = array(	
					
					"cp_title"=>$data['post_title'],
					"cp_url"=>"http://2019fun.justmy.com/".$data['post_url']."/",
					"cp_type"=>$data['post_type'],
					"cp_author_name"=>$data['post_author'],	
					"c_user_id"=>$data['post_user'],
					"cp_image"=>$data['post_image'],
					"cp_html"=>$data['post_html']
					
			);
			//echo "<pre>";  print_r($arr['post']); die;
			$this->db->insert('c_posts', $arr['post']);
			//echo $this->db->last_query(); die;
			return true;
	}

	public function updatePost($data){
		$id = $this->input->get('Id');
		if(!empty($data['post_image'])&& !empty($data['post_html'])){
			$arr['post'] = array(	
					
					"cp_title"=>$data['post_title'],
					"cp_url"=>"http://2019fun.justmy.com/".$data['post_url']."/",
					"cp_type"=>$data['post_type'],
					"cp_author_name"=>$data['post_author'],	
					"c_user_id"=>$data['post_user'],
					"cp_image"=>$data['post_image'],
					"cp_html"=>$data['post_html']
					
			);
		}
		if(empty($data['post_image'])&& !empty($data['post_html'])){
			$arr['post'] = array(	
					
					"cp_title"=>$data['post_title'],
					"cp_url"=>"http://2019fun.justmy.com/".$data['post_url']."/",
					"cp_type"=>$data['post_type'],
					"cp_author_name"=>$data['post_author'],	
					"c_user_id"=>$data['post_user'],
					//"cp_image"=>$data['post_image'],
					"cp_html"=>$data['post_html']
					
			);
		}
		if(!empty($data['post_image'])&& empty($data['post_html'])){
			$arr['post'] = array(	
					
					"cp_title"=>$data['post_title'],
					"cp_url"=>"http://2019fun.justmy.com/".$data['post_url']."/",
					"cp_type"=>$data['post_type'],
					"cp_author_name"=>$data['post_author'],	
					"c_user_id"=>$data['post_user'],
					"cp_image"=>$data['post_image']
					//"cp_html"=>$data['post_html']
					
			);
		}
		if(empty($data['post_image'])&& empty($data['post_html'])){
			$arr['post'] = array(	
					
					"cp_title"=>$data['post_title'],
					"cp_url"=>"http://2019fun.justmy.com/".$data['post_url']."/",
					"cp_type"=>$data['post_type'],
					"cp_author_name"=>$data['post_author'],	
					"c_user_id"=>$data['post_user']
					//"cp_image"=>$data['post_image'],
					//"cp_html"=>$data['post_html']
					
			);
		}
		$result1=$this->db->update('c_posts', $arr['post'], array('post_id' => $id));
		return true;
	}
	public function addPostStatus($postId=null, $data=Null){
				$array['post_status'] = array(
					"ps_status" => $data['post_status'],
					"ps_notes" => $data['post_notes'],
					"post_id" => $postId
				);
	//echo "<pre>";  print_r($array); die;
				$this->db->insert('post_status', $array['post_status']);
		return true;
	}
	public function updatePostStatus($postId=null, $data=Null){
			$this->deletePostStatus($postId);
				$array['post_status'] = array(
					"ps_status" => $data['post_status'],
					"ps_notes" => $data['post_notes'],
					"post_id" => $postId
				);
				$this->db->insert('post_status', $array['post_status']);
		return true;
	}
	public function deletePostStatus($postId=NULL){
		if($postId){
			$this->db->where('post_id' , $postId);
			$this->db->delete('post_status'); 
		}
	}
	public function getPostStatusById($postId=NULL){
		$this->db->select('*');
		$this->db->from('post_status');
		$this->db->order_by("id", "DESC");
		if($postId){
		$this->db->where("post_id", $postId);
		}
		$query = $this->db->get();
	
	//echo $this->db->last_query();
		return $query->result_array();

	}
	public function updatePostMarket($postId=null, $data=Null){
			$this->deleteAllPostMarket($postId);
			foreach($data as $market){
				$array['post_market'] = array(
					"market_id" => $market,
					"post_id" => $postId
				);
				$this->db->insert('post_market', $array['post_market']);
			}
		return true;
	}
	public function deleteAllPostMarket($postId=NULL){
		if($postId){
			$this->db->where('post_id' , $postId);
			$this->db->delete('post_market'); 
		}
	}
	public function getAddedMarketsById($postId=NULL){
		$this->db->select('*');
		$this->db->from('post_market');
		if($postId){
		$this->db->where("post_id", $postId);
		}
		$query = $this->db->get();
	
//		echo $this->db->last_query();
		return $query->result_array();

	}
	public function updatePostChannel($postId=null, $data=Null){
		$this->deleteAllPostChannel($postId);
		foreach($data as $channel){
				$array['post_channels'] = array(
					"channel_id" => $channel,
					"post_id" => $postId
				);
				
				$this->db->insert('post_channels', $array['post_channels']);
			}
		return true;
	}
	public function deleteAllPostChannel($postId=NULL){
		if($postId){
			$this->db->where('post_id' , $postId);
			$this->db->delete('post_channels'); 
		}
	}
	public function getAddedChannelById($postId=NULL){
		$this->db->select('*');
		$this->db->from('post_channels');
		if($postId){
		$this->db->where("post_id", $postId);
		}
		$query = $this->db->get();
	
//		echo $this->db->last_query();
		return $query->result_array();

	}
	public function updatePostProfile($postId=null, $data=Null){
		$this->deleteAllPostProfile($postId);
		foreach($data as $profile){
				$array['post_profile'] = array(
					"profile_id" => $profile,
					"post_id" => $postId
				);
				
				$this->db->insert('post_connect', $array['post_profile']);
			}
		return true;
	}
	public function deleteAllPostProfile($postId=NULL){
		if($postId){
			$this->db->where('post_id' , $postId);
			$this->db->delete('post_connect'); 
		}
	}
	public function getAddedProfileById($postId=NULL){
		$this->db->select('*');
		$this->db->from('post_connect');
		if($postId){
		$this->db->where("post_id", $postId);
		}
		$query = $this->db->get();
	
//		echo $this->db->last_query();
		return $query->result_array();

	}
	function deletePost($id)
	{
		//$this->deletePostStatus($id);
		//$this->deleteAllPostMarket($id);
		//$this->deleteAllPostChannel($id);
		//$this->deleteAllPostProfile($id);
	   	$this->db->set('ps_status', "Trash");
		$this->db->where('post_id', $id);
		$this->db->update('post_status');
		//echo $this->db->last_query();  
	}
	function deleteStatus($id)
	{
	   $this->db->where('id', $id);
	   $this->db->delete('post_status'); 
	}
	
}

?>