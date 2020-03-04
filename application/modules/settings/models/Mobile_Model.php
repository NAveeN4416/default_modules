<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once(APPPATH.'modules/settings/models/Base_model.php');

	class Mobile_model extends Base_model {
		
	function __construct() 
	{
		parent::__construct();
	}

	public function Get_Mobile($id='')
	{
		if($id)
			return $this->db->where('id',$id)->get(MOBILE_DEVICES)->row_array();

		return $this->db->get(MOBILE_DEVICES)->result_array();
	}

	public function save_device($data)
	{
		if(isset($data['id']) && $data['id']!='' && $data['id']!=0)
		{
			$this->db->where('id',$data['id']);
			return $this->db->set($data)->update(MOBILE_DEVICES);
		}

		return $this->db->insert(MOBILE_DEVICES,$data);
	}

	public function update_menu($set,$where)
	{
		return $this->db->set($set)->where($where)->update(ADMIN_MENU);
	}

}
