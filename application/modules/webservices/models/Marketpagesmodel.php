<?php
class Marketpagesmodel extends CI_Model
{

    public function __construct()
    { 

        parent::__construct();
    }

    public function getMarketList($id=NULL){
       if($id){
			$this->db->where("market_id", $id);
		}
	   //if($marketName){
               // $this->db->where("market_name", trim($marketName));
        //}
        $query = $this->db->get('markets');
	//echo $this->db->last_query(); die;
        return $query->result_array();
    }
}
?>