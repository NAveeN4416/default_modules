<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once(APPPATH.'modules/settings/models/Base_model.php');

	class Permissions_model extends Base_model {
		
	function __construct() 
	{
		parent::__construct();
	}

	public function get_menu()
	{
		return $this->db->get(ADMIN_MENU)->result_array();
	}

	public function Get_Permissions()
	{
		return $this->db->get(AUTH_GROUP_PERMISSIONS)->result_array();
	}

	public function get_permission($id)
	{
		return $this->db->where('group_id',$id)->get(AUTH_GROUP_PERMISSIONS)->row_array();
	}

	public function save_permissions($data)
	{
		$rows = $this->db->where('group_id',$data['group_id'])->get(AUTH_GROUP_PERMISSIONS)->num_rows();

		if($rows)
		{
			return $this->update_permission($data,['group_id'=>$data['group_id']]);
		}

		return $this->db->insert(AUTH_GROUP_PERMISSIONS,$data);
	}

	public function update_permission($set,$where)
	{
		return $this->db->set($set)->where($where)->update(AUTH_GROUP_PERMISSIONS);
	}

}
