<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

 * CodeIgniter

 *

 * An open source application development framework for PHP 5.1.6 or newer

 *

 * @package		CodeIgniter

 * @author		ExpressionEngine Dev Team

 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.

 * @license		http://codeigniter.com/user_guide/license.html

 * @link		http://codeigniter.com

 * @since		Version 1.0

 * @filesource

 */



// ------------------------------------------------------------------------



/**

 * CodeIgniter CAPTCHA Helper

 *

 * @package		CodeIgniter

 * @subpackage	Helpers

 * @category	Helpers

 * @author		ExpressionEngine Dev Team

 * @link		http://codeigniter.com/user_guide/helpers/xml_helper.html

 */



// ------------------------------------------------------------------------



/**

 * Create CAPTCHA

 *

 * @access	public

 * @param	array	array of data for the CAPTCHA

 * @param	string	path to create the image in

 * @param	string	URL to the CAPTCHA image folder

 * @param	string	server path to font

 * @return	string

 */

if ( ! function_exists('isLoggedIn'))
{
	function isLoggedIn() {
		$CI =& get_instance();
		if($CI->session->userdata('logged_in'))
			return true;
		
		return false;
    }
}

if ( ! function_exists('isSuperAdmin'))
{
	function isSuperAdmin() {
		$CI =& get_instance();
		if($CI->session->userdata('user_role') == 1)
			return true;
		
		return false;
    }
}

if ( ! function_exists('isDoctor'))
{
	function isDoctor() {
		$CI =& get_instance();
		if($CI->session->userdata('user_role') == 4)
			return true;
		
		return false;
    }
}



if ( ! function_exists('getUserId'))
{
	function getUserId() {
		$CI =& get_instance();
		return $CI->session->userdata('id_user');
    }
}

if ( ! function_exists('getUserName'))
{
	function getUserName() {
		$CI =& get_instance();
		return $CI->session->userdata('user_name');
    }
}
if ( ! function_exists('UserName'))
{
	function UserName() {
		$CI =& get_instance();
		return $CI->session->userdata('name');
    }
}
if ( ! function_exists('imagelist'))
{
	function imagelist() {
		$CI =& get_instance();
		return $CI->session->userdata('profile_photo_att');
    }
}

if ( ! function_exists('getUserDetails'))
{
	function getUserDetails($id = NULL) {
		if(!$id)
			return false;
		$ci =& get_instance();
		$ci->load->database();
		$ci->db->select('*');
		$ci->db->from('user_details');
		$ci->db->where('id_user' , $id);
		//$this->db->join(‘table2′, ‘table2.id = table1.id’);
		$query = $ci->db->get();
		$results = $query->result() ;
		//print_r($results); die;
		return $results[0];
    }
}



// ------------------------------------------------------------------------



/* End of file captcha_helper.php */

/* Location: ./system/heleprs/captcha_helper.php */