<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Seomodel extends CI_Model

{

	public function __construct()

	{

		parent::__construct();

		$this->load->database();

	}
	public function seoCityPageAdd($data,$cityId)
	{
	    $query=$this->db->get_where('city_detail',array('city_id' => $cityId));

        if($query->num_rows() > 0)
		{
			return true;
			//redirect(base_url()."admin/Citycontent/getCityName?msg=emailexits");
        }
		else
		{
		$query = array(
		                'city_id' => $cityId,
						'content' => $data['content'],
						'status' => '1',
						'created_date' => date('Y-m-d')
					);
		$this->db->insert('city_detail',$query);
		//echo "<pre>";print_r($this->db->last_query());die;
		return true;
		}
		
	}
	public function seoCityPageUpdate($data,$Id)
	{
		
		$query = array(
						'keyword' => $data['keyword'],
						'title' => $data['cityTitle'],
						'description' => $data['cityDescription'],
						'content' => $data['content'],
						'status' => '1',
						'created_date' => date('Y-m-d')
					);
		//echo "<pre>";print_r($Id);die;
		$this->db->where('city_detail_id',$Id);
		$this->db->update('city_detail',$query);
		//echo "<pre>";print_r($this->db->last_query());die;
		return $query;
	}
	public function getSeoPageFrontend($cityName)
	{
		//echo "";print_r($cityName);die;
		    $this->db->select('*');
			$this->db->from('city ct');	
			$this->db->join('city_detail ctd','ctd.city_id = ct.id_city');
		if($cityName!=Null)
		{
			$this->db->where('ct.city_name', $cityName);
		}	
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			//echo "<pre>";print_r($this->db->last_query());die;
			return $row;			
		}			
			return false;
	}
	public function getSeoPage($cityName)
	{
		$this->db->select('*');
			$this->db->from('city ct');	
			$this->db->join('city_detail ctd','ctd.city_id = ct.city_id');
		if($cityName!=Null)
		{
			$this->db->where('ct.city_id', $cityName);
		}	
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			
			return $row;			
		}			
			return false;
	}
	public function getSeoPageById($Id)
	{
		    $this->db->select('*');
			$this->db->from('city ct');	
			$this->db->join('city_detail ctd','ctd.city_id = ct.id_city');
			$this->db->where('ctd.city_detail_id', $Id);
			$query = $this->db->get();
			//echo "<pre>";print_r($query->result());die;
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			
			return $row;			
		}			
			return false;	
		
	}
	
	public function getCitySeoPage()
	{
		    $this->db->select('*');
			$this->db->from('city');	
			$this->db->order_by('id_city','desc');
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			return $row;			
		}			
			return false;
	}
	public function getCitySeoPageById($cityId)
	{
		    $this->db->select('*');
			$this->db->from('city');
            $this->db->where('id_city',$cityId);		
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			return $row;			
		}			
			return false;
	}
//New	
	public function getCityLocality($cityId)
	{
		//echo "";print_r($cityName);die;
		    $this->db->select('*');
			$this->db->from('city_locality ctl');	
			$this->db->join('city ct','ct.city_id = ctl.city_id');
			//$this->db->limit(100, 1);
		if($cityId!=Null)
		{
			$this->db->where('ctl.city_id', $cityId);
		}	
			$this->db->order_by('city_locality_id', 'RANDOM');
            $this->db->limit(20);
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			//echo "<pre>";print_r($this->db->last_query());die;
			return $row;			
		}			
			return false;
	}
	public function CityLocalityInsert($data)
	{
	    
		$query = array(
		                                'city_locality_name' => $data['localityname'],
										'city_id' => $data['cityid']
									   );
		//echo "<pre>";print_r($query['city_locality']);die;
		$this->db->insert('city_locality',$query);
		return $query;
		
	}
	function changeCityLocalityStatus($data) 
	{
			$id = $this->input->get('inactiveStatusId');
			$value = $this->input->get('statusValue');
			$arr = array(			 
				        'status'=>$value
				        );
			  $this->db->where('city_locality_id', $id);
			  $this->db->update('city_locality', $arr);

        return true;
				 
    }
	function cityLocalityDetailsById($cityLocalityId) 
	{		
			$this->db->select('*');
			$this->db->from('city_locality');
            $this->db->where('city_locality_id',$cityLocalityId);		
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			return $row;			
		}			
			return false;
				 
    }
	function cityLocalityDetailsByName($cityName=NULL, $cityLocality=NULL){
			$this->db->select('*');
			$this->db->from('city_locality hcl');
			$this->db->join('city hc', 'hcl.city_id = hc.id_city', 'left');
            $this->db->where('locality_seo_name',$cityLocality);				
            $this->db->where('hc.city_name',$cityName);				
			$query = $this->db->get();
		if ($query->num_rows() > 0) 
		{				
			$row = $query->result();
			return $row;			
		}			
			return false;
				 
    }
	public function updateCityLocalityDetails($data)
	{
		$id = $data['citylocalityid'];
		if($data)
	    {
		$query['city_locality'] = array(
		                                'city_locality_name' => $data['localityname']
									   );
		
		$this->db->update('city_locality', $query['city_locality'],array('city_locality_id' => $id));
		return true;
        }
		else
		{
			return false;
		}
	}
	function getRating($cityName=NULL){
			$this->db->select('count(feedback_id) as users,avg(rating_id) as avg, sum(rating_id) as total');
			$this->db->from('feedback');
		    $this->db->where('city_id',$cityName);				
		    $this->db->where('fd_state','1');				
        	$query = $this->db->get();
			$result = $query->result_array();
			//echo '<pre>'; print_r($this->db->last_query()); die;
			return $result;
    }
}