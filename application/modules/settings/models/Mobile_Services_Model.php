<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once(APPPATH.'modules/settings/models/Base_model.php');

	class Mobile_Services_model extends Base_model {
		
	function __construct() 
	{
		parent::__construct();
	}

	public function Get_Mobile($id='')
	{
		if($id)
			return $this->db->where('id',$id)->get(MOBILE_APIS)->row_array();

		return $this->db->get(MOBILE_APIS)->result_array();
	}

	public function save_service($data)
	{
		if(isset($data['id']) && $data['id']!='' && $data['id']!=0)
		{
			$this->db->where('id',$data['id']);
			return $this->db->set($data)->update(MOBILE_APIS);
		}

		return $this->db->insert(MOBILE_APIS,$data);
	}

}
