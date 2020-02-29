<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');


	class Admin_model extends CI_Model {
		
	function __construct() 
	{
		parent::__construct();
	}

	public function Get_Site_Config()
	{
		return $this->db->get(SITE_CONFIG)->row_array();
	}
	
	public function Get_Menu()
	{
		$parents = $this->db->where('status',1)->where('parent_id',0)->get(ADMIN_MENU)->result_array();

		foreach ($parents as $key => $menu) {
			$childs = $this->db->where('status',1)->where('parent_id',$menu['id'])->get(ADMIN_MENU)->result_array();

			$parents[$key]['children'] = $childs;
		}

		return $parents ;
	}
}
