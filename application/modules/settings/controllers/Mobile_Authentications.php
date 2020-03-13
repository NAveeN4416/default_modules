<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/settings/controllers/Base.php');
class Mobile_Authentications extends Base {

	public function __construct()
	{
      // Construct the parent class
	   	parent::__construct();
	    $this->load->model('Mobile_Authentications_model');

	  	$this->controller_path = "settings/mobile_authentications/";
	  	$this->controller = "mobile_authentications";

	  	$this->data = [] ;
	  	$this->data['main_page'] = 'mobile_authentications' ;
	}

	public function index()
	{
    	$this->data['list'] = $this->Mobile_Authentications_model->Get_Objects(MOBILE_AUTHENTICATIONS);

    	$this->Load_View('mobile_authentications/list',$this->data);
	}

	public function add_edit_authentication()
	{
		$authentication_id = $this->input->post('id');

		if($authentication_id)
			$this->data = $this->Mobile_Authentications_model->Get_Object(MOBILE_AUTHENTICATIONS,['id'=>$authentication_id]);

    	$this->load->view('mobile_authentications/add_authentication',$this->data);
	}

	public function save_authentication()
	{
		$authentication = $this->input->post();

		$flag = $this->Mobile_Authentications_model->Upsert_Object(MOBILE_AUTHENTICATIONS,$authentication);

		$this->Ajax['status'] = 1 ;
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
}
