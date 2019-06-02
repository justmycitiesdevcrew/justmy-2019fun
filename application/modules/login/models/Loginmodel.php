<?php
 ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Loginmodel extends CI_Model {

    function __construct() {
        parent::__construct();
       
    }

    public function login($email, $password) {
        $this->db->select('*');
        $this->db->from('c_users i');
		//$this->db->join('user_details id','id.id_user = i.id_user');

        $this->db->where('username', $email);
        $this->db->where('password',md5($password));
        //$this->db->where('status', 1);        
        $this->db->limit(1);
        $query = $this->db->get();        
       //echo $this->db->last_query();die;
        $row = $query->row();
       
        if (!is_object($row)) {
            return false;
        }
       return ( ($row) ? $row : false );       
    }

    public function updateLastVisitDate($user_id) {
        $this->db->set('last_visited_date ', 'NOW()', FALSE);
        $this->db->where('id', $user_id);
        $this->db->where_in('userlevel_id ', array(2));

        return $this->db->update('user');
    }

    public function updatePasswordSalt($userid, $password) {
        $this->db->set('last_visited_date ', 'NOW()', FALSE);
        $this->db->where('id', $userid);
        $this->db->where_in('userlevel_id ', array(2));
        $data['password'] = $password;

        return $this->db->update('user', $data);
    }

    public function updatePassword($data, $id) {
        $this->db->where('id_user', $id);
        //$this->db->where('userlevel', 2);
        //$this->db->where_in('userlevel_id', array(2, 9));
        return $this->db->update('user', $data);
    }

    public function checkEmail($email) {
        $this->db->select("*");
        $this->db->from('user i');
		$this->db->join('user_details id','id.id_user = i.id_user');

        $this->db->where("user_name = '" . $email . "'");
        //$this->db->where_in('userlevel_id', array(2, 9));
        $this->db->where("status != 0");
        $this->db->limit(1);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        $row = $query->row();
        if (is_object($row)) {
            return $row;
        } else {
            return false;
        }
    }

}
?>

