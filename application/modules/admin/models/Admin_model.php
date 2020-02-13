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
	
}
