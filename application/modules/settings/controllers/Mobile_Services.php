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

	  	$this->controller_path = "settings/mobile_services";
	  	$this->controller = "mobile_services";
	  	$this->data = [] ;

	  	$this->data['main_page'] = 'mobile_services' ;
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

    	$this->Load_View('mobile_services/add_service',$this->data);
	}

	public function save_service()
	{
		$device = $this->input->post();

		$flag = $this->Mobile_Services_model->save_service($device);

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


	public function Get_GroupUsers($group_id)
	{
		$this->data['group_details'] = $this->Groups_model->get_group($group_id);
		$this->data['group_id'] = $group_id ;

		$this->Load_View('groups/group_users',$this->data);
	}


	public function getgroups()
	{
		$groups = $this->Groups_model->Get_groups();

		$data = [] ;

		foreach ($groups as $key => $group) {

			$this->load->library('parser');

			$actions = [
							"edit_class" => "add_group",
							"group_id"=> $group['id'],
							"delete_class" => "delete_group" 
						] ;

			$actions = $this->parser->parse('groups/snippets/actions',$actions,TRUE);
			$status = ($group['status']==1) ? 'checked' : '' ;

			$row = [] ;

			$row['group_name'] = $group['group_name'];
			$row['status'] =  "<input onchange='GroupActivity(".$group['id'].")' id='group_status".$group['id']."' type='checkbox' ".$status." name='my-checkbox' data-bootstrap-switch data-toggle='toggle' data-on-text='On' data-off-color='warning' data-on-color='success' data-off-text='Off' data-handle-width='10'>"  ; //$group['status'];
			$row['created_at'] = $group['created_at'];
			$row['actions'] = $actions;

			$data[] = $row ;
		}

		$this->Ajax['data'] = $data ;
		$this->Ajax['recordsTotal'] = 10 ;
		$this->Ajax['recordsFiltered'] = 10 ;

		echo $this->AjaxResponse();
	}


	public function getusers($group_id)
	{
		$groups = $this->Groups_model->Get_groups();

		$data = [] ;

		foreach ($groups as $key => $group) {

			$this->load->library('parser');

			$actions = [
							"edit_class" => "add_group",
							"group_id"=> $group['id'],
							"delete_class" => "delete_group" 
						] ;

			$actions = $this->parser->parse('groups/snippets/actions',$actions,TRUE);
			$status = ($group['status']==1) ? 'checked' : '' ;

			$row = [] ;

			$row['group_name'] = $group['group_name'];
			$row['status'] =  "<input onchange='GroupActivity(".$group['id'].")' id='group_status".$group['id']."' type='checkbox' ".$status." name='my-checkbox' data-bootstrap-switch data-toggle='toggle' data-on-text='On' data-off-color='warning' data-on-color='success' data-off-text='Off' data-handle-width='10'>"  ; //$group['status'];
			$row['created_at'] = $group['created_at'];
			$row['actions'] = $actions;

			$data[] = $row ;
		}

		$this->Ajax['data'] = $data ;
		$this->Ajax['recordsTotal'] = 10 ;
		$this->Ajax['recordsFiltered'] = 10 ;

		echo $this->AjaxResponse();
	}

}
