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
	  	$this->data['page_name'] = 'mobile_platforms' ;
	}

	public function index()
	{
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
		$config = @$device['mobile_configurations'][0];

		$this->data['device_id'] = $device_id ;
		$this->data['device_name'] = @$device['name'] ;
		$this->data['config_dev'] = json_decode(@$config['configuration_dev'],True);
		$this->data['config_prod'] = json_decode(@$config['configuration_prod'],True);

		//echo "<pre>"; print_r($this->data);exit;

		$this->Load_View('mobile/update_config',$this->data);
	}

	public function Update_Configuration()
	{
		$post_data = $this->input->post();

		$device_id = $post_data['id'];
		$description = $post_data['description'];

		$dev_files = $_FILES['dev_files'];
		$prod_files = $_FILES['prod_files'];

		$configuration_dev = array();
		$configuration_prod = array();

		foreach ($post_data['dev_keys'] as $key => $value) {
			if($value && $post_data['dev_values'][$key])
			{
				$configuration_dev[$value] = $post_data['dev_values'][$key];
			}
		}

		foreach ($post_data['prod_keys'] as $key => $value) {
			if($value && $post_data['prod_values'][$key])
			{
				$configuration_prod[$value] = $post_data['prod_values'][$key];
			}
		}

		//Uplaod Files if Any
		$this->load->library('File_Upload_Library');

		$path = 'uploads/mobile_configurations/';
		$uploaded_files = $this->Upload_Multiple_Files($dev_files,$path);
		foreach ($uploaded_files as $key => $uploaded_file) {
			$configuration_dev['file_'.$key] = $path.$uploaded_file['file_name'];
		}

		$uploaded_files = $this->Upload_Multiple_Files($prod_files,$path);
		foreach ($uploaded_files as $key => $uploaded_file) {
			$configuration_prod['file_'.$key] = $path.$uploaded_file['file_name'];
		}


		$configuration_dev = json_encode($configuration_dev);
		$configuration_prod = json_encode($configuration_prod);

		$set['configuration_dev'] = $configuration_dev;
		$set['configuration_prod'] = $configuration_prod;
		$set['description'] = $description;

		$where['device_id'] = $device_id ;

		$flag = $this->Mobile_Model->Update_Objects(MOBILE_CONFIG,$set,$where);

		redirect($this->controller_path.'Edit_Configuration/'.$device_id);
	}


	public function Upload_Multiple_Files($files, $upload_path, $config=array())
	{
		$uploaded_files = array();
		$this->file_upload = new File_Upload_Library();

		for($key=0; $key<count($files['name']);$key++) {

			if($files['error'][$key]!=4)
			{
				$_FILES['file']['name']= $files['name'][$key];
		        $_FILES['file']['type']= $files['type'][$key];
		        $_FILES['file']['tmp_name']= $files['tmp_name'][$key];
		        $_FILES['file']['error']= $files['error'][$key];
		        $_FILES['file']['size']= $files['size'][$key];

				$config['upload_path'] = $upload_path ;
				$config['allowed_types'] = '*';
				$config['file_name'] = 'file'.$key.'_'.date('d_m_Y_H_i_s') ;
				$this->file_upload->Set_Config($config);
				$this->file_upload->Upload_File('file');

				$uploaded_files[] = $this->file_upload->Uploaded_Data();
			}
		}

		return $uploaded_files;
	}
}
