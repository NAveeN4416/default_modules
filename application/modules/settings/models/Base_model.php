<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	require APPPATH . 'libraries/CO_Model.php';

	class Base_model extends CO_Model {
		
	function __construct() 
	{
		parent::__construct();
	}

	public function Get_groups()
	{
		return $this->db->get(AUTH_GROUPS)->result_array();
	}


	public function save_groups($data)
	{
		if($data['id'])
		{
			$this->db->where('id',$data['id']);
			return $this->db->set($set)->update(AUTH_GROUPS);
		}

		return $this->db->insert(AUTH_GROUPS,$data);
	}
}
