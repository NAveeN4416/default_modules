<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once(APPPATH.'modules/settings/models/Base_model.php');

	class Menu_model extends Base_model {
		
	function __construct() 
	{
		parent::__construct();
	}

	public function Get_menu($id='')
	{
		if($id)
			return $this->db->where('id',$id)->get(ADMIN_MENU)->row_array();

		return $this->db->get(ADMIN_MENU)->result_array();
	}

	public function Get_ParentMenu($id='')
	{
		$this->db->where('parent_id',0);

		if($id)
			return $this->db->where('id',$id)->get(ADMIN_MENU)->row_array();

		return $this->db->get(ADMIN_MENU)->result_array();
	}

	public function Get_MenuStructure()
	{
		$parent_structure = $this->Get_ParentMenu();

		foreach ($parent_structure as $key => $parent) {
			$parent_structure[$key]['child_menu'] = $this->db->where('parent_id',$parent['id'])->get(ADMIN_MENU)->result_array();
		}

		return $parent_structure ;
	}

	public function save_menu($data)
	{
		if(isset($data['id']) && $data['id']!='' && $data['id']!=0)
		{
			$this->db->where('id',$data['id']);
			return $this->db->set($data)->update(ADMIN_MENU);
		}

		return $this->db->insert(ADMIN_MENU,$data);
	}

	public function update_menu($set,$where)
	{
		return $this->db->set($set)->where($where)->update(ADMIN_MENU);
	}

}
