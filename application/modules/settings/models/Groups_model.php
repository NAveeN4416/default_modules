<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once(APPPATH.'modules/settings/models/Base_model.php');

	class Groups_model extends Base_model {
		
	function __construct() 
	{
		parent::__construct();
	}

	public function Get_groups()
	{
		return $this->db->get(AUTH_GROUPS)->result_array();
	}

	public function get_group($id)
	{
		return $this->db->where('id',$id)->get(AUTH_GROUPS)->row_array();
	}

	public function save_groups($data)
	{
		if(isset($data['id']) && $data['id']!='' && $data['id']!=0)
		{
			$this->db->where('id',$data['id']);
			return $this->db->set($data)->update(AUTH_GROUPS);
		}

		return $this->db->insert(AUTH_GROUPS,$data);
	}

	public function update_group($set,$where)
	{
		return $this->db->set($set)->where($where)->update(AUTH_GROUPS);
	}

}
