<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/settings/controllers/Base.php');
class Mobile_Services extends Base {

	public function __construct()
	{
      // Construct the parent class
	   	parent::__construct();
	    $this->load->model('DB_model');
	    $this->load->model('Mobile_Services_model');

	  	$this->controller_path = "settings/mobile_services/";
	  	$this->controller = "mobile_services";
	  	$this->data = [] ;

	  	$this->data['main_page'] = 'mobile_services' ;
	  	$this->data['page_name'] = 'mobile_services' ;
	}

	public function index()
	{
    	$this->data['services_list'] = $this->Mobile_Services_model->Get_Objects(MOBILE_APIS);
    	$this->Load_View('mobile_services/services_list',$this->data);
	}

	public function add_edit_service($service_id=0)
	{
		if($service_id)
			$this->data = $this->Mobile_Services_model->Get_Object(MOBILE_APIS,['id'=>$service_id]);

		$this->data['authentications'] = $this->Mobile_Services_model->Get_Objects(MOBILE_AUTHENTICATIONS);

    	$this->Load_View('mobile_services/add_service',$this->data);
	}

	public function save_service()
	{
		$service = $this->input->post();
		$flag = $this->Mobile_Services_model->Upsert_Object(MOBILE_APIS,$service);

		$this->Ajax['message'] = "Success";
		echo  $this->AjaxResponse();
	}

	public function Change_Service_Status()
	{
		$this->Ajax['status'] = 0;
		$this->Ajax['message'] = "Something went wrong !";

		$postdata = $this->input->post();

		$set['status'] = $postdata['status'];
		$where['id'] = $postdata['service_id'];
		
		$uflag = $this->Mobile_Services_model->Update_Objects(MOBILE_APIS,$set,$where);

		if($uflag)
		{
			$this->Ajax['status'] = 1;
			$this->Ajax['message'] = "Success";
		}

		echo $this->AjaxResponse();
	}

	public function Get_Service_Timeline()
	{
		$this->Load_View('mobile_services/services_timeline');
	}
}
