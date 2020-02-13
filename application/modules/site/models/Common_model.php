<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/CO_Model.php';

class Common_model extends CO_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function Get_Site_Config()
	{
		return $this->db->get(SITE_CONFIG)->row_array();
	}
}
