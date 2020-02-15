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

	public function Update_SiteConfig($set)
	{
		return $this->db->set($set)->where('id',1)->update('site_configurations') ;
	}

	public function get_MobileConfig($set)
	{
		$devices =  $this->db->where('status',1)->get('mobile_devices')->result_array() ;

		foreach ($devices as $key => $device) {
			$config = $this->db->where('device_type',$device['id'])->get('mobile_configurations')->row_array();

			$devices[$key]['config'] = $config ;
		}

		return $devices ;
	}

	public function Update_MobileConfig($where,$set)
	{
		return $this->db->set($set)->where($where)->update('mobile_configurations') ;
	}

	public function get_thirdparty_config()
	{
		return $this->db->get('third_party_configurations')->result_array() ;
	}

	public function Update_ThirdPartyConfig($where,$set)
	{
		return $this->db->set($set)->where($where)->update('third_party_configurations') ;
	}

}
