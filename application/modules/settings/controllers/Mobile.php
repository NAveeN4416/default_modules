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

	  	$this->controller_path = "settings/mobile";
	  	$this->controller = "mobile";
	  	$this->data = [] ;
	}

	public function index()
	{
    	$this->data['page_name'] = 'mobile_config' ;
    	$this->data['mobiles'] = $this->Mobile_Model->Get_Objects(MOBILE_DEVICES);

    	$this->Load_View('mobile/mobile_config',$this->data);
	}


	public function add_edit_mobile()
	{
    	$this->data['device'] = [] ;

    	$this->load->view("mobile/add_device",$this->data);
	}

	public function save_device()
	{
		$device = $this->input->post();

		$flag = $this->Mobile_Model->save_device($device);

		$this->Ajax['message'] = "Success";

		echo  $this->AjaxResponse();
	}

	public function GroupActivity()
	{
		$this->Ajax['status'] = 0;
		$this->Ajax['message'] = "Something went wrong !";


		$postdata = $this->input->post();

		$set['status'] = $postdata['status'];
		$where['id'] = $postdata['group_id'];
		
		$uflag = $this->Groups_model->update_group($set,$where);

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
