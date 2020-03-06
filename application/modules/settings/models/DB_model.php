<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once(APPPATH.'modules/settings/models/Base_model.php');

	class DB_model extends Base_model {
		
	function __construct() 
	{
		parent::__construct();
	}

	public function GetData($table,$where='')
	{
		if($where)
			$this->db->where($where);

		return $this->db->get($table)->result_array();
	}


	public function get_mobile_config()
	{
		$configs = $this->db->get(MOBILE_CONFIG)->result_array();

		return $this->_query_response($configs,MOBILE_CONFIG);
	}

	public function get_mobile_devices()
	{
		$configs = $this->db->get(MOBILE_DEVICES)->result_array();

		return $this->_query_response($configs,MOBILE_DEVICES);	
	}


	public function get_db_tables()
	{
		return $this->db->list_tables();
	}

	public function get_site_config()
	{
		return $this->db->get(SITE_CONFIG)->row_array() ;
	}

	public function Update_SiteConfig($set)
	{
		return $this->db->set($set)->where('id',1)->update(SITE_CONFIG) ;
	}

	public function get_MobileConfig()
	{
		$devices =  $this->db->where('status',1)->get(MOBILE_DEVICES)->result_array() ;

		foreach ($devices as $key => $device) {
			$config = $this->db->where('device_type',$device['id'])->get(MOBILE_CONFIG)->row_array();

			$devices[$key]['config'] = $config ;
		}

		return $devices ;
	}

	public function Update_MobileConfig($where,$set)
	{
		return $this->db->set($set)->where($where)->update(MOBILE_CONFIG) ;
	}

	public function get_thirdparty_config()
	{
		return $this->db->get(THIRD_PARYT_CONFIG)->result_array() ;
	}

	public function Update_ThirdPartyConfig($where,$set)
	{
		return $this->db->set($set)->where($where)->update(THIRD_PARYT_CONFIG) ;
	}

}
