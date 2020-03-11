<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Auth_model extends CI_Model {
	

	function __construct() 
	{
		parent::__construct();
	}

	public function Get_User($where)
	{
		return $this->db->where($where)->get(USERS)->row_array();
	}


	public function login_config()
	{
		return $this->db->get(LOGIN_CONFIG)->row_array();
	}

	public function Get_Site_Config()
	{
		return $this->db->get(SITE_CONFIG)->row_array();
	}
}
