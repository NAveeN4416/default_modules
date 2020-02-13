<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	require APPPATH . 'libraries/CO_Model.php';

	class DB_model extends CO_Model {
		
	function __construct() 
	{
		parent::__construct();
	}

	public function get_db_tables()
	{
		return $this->db->list_tables();
	}

	public function get_site_config()
	{
		return $this->db->get('site_configurations')->row_array() ;
	}

}
