<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	require APPPATH . 'libraries/CO_Model.php';

	class Base_model extends CO_Model {
		
	function __construct() 
	{
		parent::__construct();
	}

	public function Check_Slug_InDB($table,$slug)
	{
		return $this->db->where('slug',$slug)->get($table)->num_rows();
	}

	public function Update_SiteDatabase($set)
	{
		// 1. Load Main database and update
		// 2. Load Development database and update

		$production_db = $this->load->database('default',True);
		$development_db = $this->load->database('development',True);

		$production_db->set($set)->update(SITE_CONFIG);	
		$development_db->set($set)->update(SITE_CONFIG);

		return True ;	
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
