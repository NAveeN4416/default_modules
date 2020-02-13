<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CO_Model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function Get_User($user_id)
	{
		$user = $this->db->where('id',$user_id)->get('auth_users')->row_array();
        $groups = $this->db->where('user_id',$user_id)->get('auth_user_groups')->result_array();
	
        $user['groups'] = $groups;

        return $user;
	}

}
?>