<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	require_once(APPPATH.'modules/settings/models/Base_model.php');

	class DB_model extends Base_model {
		
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
		return $this->db->get(SITE_CONFIG)->row_array() ;
	}

	public function Update_SiteConfig($set)
	{
		return $this->db->set($set)->where('id',1)->update(SITE_CONFIG) ;
	}

	public function Update_SiteDatabase($set)
	{
		// 1. Load Main database and update
		// 2. Load Development Database update

		$production_db = $this->load->database('default',True);
		$development_db = $this->load->database('development',True);

		$production_db->set($set)->update(SITE_CONFIG);	
		$development_db->set($set)->update(SITE_CONFIG);

		return True ;	
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
