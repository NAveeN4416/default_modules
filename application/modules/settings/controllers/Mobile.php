<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/settings/controllers/Base.php');
class Mobile extends Base {

	public function __construct()
	{
      // Construct the parent class
	   	parent::__construct();
	    $this->load->model('DB_model');
	    $this->load->model('Mobile_Model');

	  	$this->controller_path = "settings/mobile/";
	  	$this->controller = "mobile";
	  	$this->data = [] ;
	}

	public function index()
	{
    	$this->data['page_name'] = 'mobile_config' ;
    	$this->data['mobiles'] = $this->Mobile_Model->Get_Objects(MOBILE_DEVICES);

    	$this->Load_View('mobile/mobile_platforms',$this->data);
	}

	public function add_edit_mobile()
	{
		$id = $this->input->post('id');
    	$this->data = $this->Mobile_Model->Get_Object(MOBILE_DEVICES,['id'=>$id]) ;

    	$this->load->view("mobile/add_device",$this->data);
	}

	public function save_device()
	{
		$device = $this->input->post();

		$flag = $this->Mobile_Model->Upsert_Object(MOBILE_DEVICES,$device);

		$this->Ajax['message'] = "Success";

		echo  $this->AjaxResponse();
	}

	public function Change_Device_Status()
	{
		$this->Ajax['status'] = 0;
		$this->Ajax['message'] = "Something went wrong !";

		$postdata = $this->input->post();

		$set['status'] = $postdata['status'];
		$where['id'] = $postdata['device_id'];
		
		$uflag = $this->Mobile_Model->Update_Objects(MOBILE_DEVICES,$set,$where);

		if($uflag)
		{
			$this->Ajax['status'] = 1 ;
			$this->Ajax['message'] = "Success";
		}

		echo $this->AjaxResponse();
	}

	public function Edit_Configuration($device_id)
	{
		$device = $this->Mobile_Model->Get_Object(MOBILE_DEVICES,['id'=>$device_id]);
		$config = $device['mobile_configurations'][0];

		$this->data['device_id'] = $device_id ;
		$this->data['device_name'] = $device['name'] ;
		$this->data['config_dev'] = json_decode($config['configuration_dev'],True);
		$this->data['config_prod'] = json_decode($config['configuration_prod'],True);

		//echo "<pre>"; print_r($this->data);exit;

		$this->Load_View('mobile/update_config',$this->data);
	}

	public function Update_Configuration()
	{
		echo "<pre>"; 
		print_r($_POST);
		print_r($_FILES);
		exit;
	}
}
