<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/CO_Model.php';

class Common_model extends CO_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function Get_Site_Config()
	{
		return $this->db->get(SITE_CONFIG)->row_array();
	}

	public function Upsert_Token($data)
	{
		$record = $this->db->where('user_id',$data['user_id'])->get(MOBILE_AUTH_TOKENS)->row_array();

		if($record)
			return $this->db->set($data)->where('user_id',$data['user_id'])->update(MOBILE_AUTH_TOKENS);

		return $this->db->insert(MOBILE_AUTH_TOKENS,$data);
	}

	public function Authenticate_User($username,$password)
	{
		$user = $this->db->where('email',$username)->get(USERS)->row_array();

		if($user)
		{
			if(base64_encode($password)==$user['password'])
			{
				return $user ;
			}
			return INVALID_PASSWORD;
		}
		else
		{
			return INVALID_CREDENTIALS;
		}
	}
}
