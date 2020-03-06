<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/settings/controllers/Base.php');
class User_Groups extends Base {

	public function __construct()
	{
      // Construct the parent class
	   	parent::__construct();
	    $this->load->model('DB_model');
	    $this->load->model('Groups_model');

	  	$this->controller_path = "settings/user_groups";
	  	$this->controller = "user_groups";
	  	$this->data = [] ;
	}

	public function index()
	{
		$this->Load_View('groups/groups');
	}

	public function add_edit_group()
	{
		$group_id = $this->input->post('id');

		$group = @$this->Groups_model->GetData(AUTH_GROUPS,['id'=>$group_id])[0];

		$this->load->view('groups/add_edit_group',$group);
	}

	public function save_group()
	{
		$group = $this->input->post();

		$flag = $this->Groups_model->save_groups($group);

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

		$uflag = $this->Groups_model->Set_Status(AUTH_GROUPS,$postdata['status'],$where);

		if($uflag)
		{
			$this->Ajax['status'] = 1;
			$this->Ajax['message'] = "Success";
		}

		echo $this->AjaxResponse();
	}


	public function Get_GroupUsers($group_id)
	{
		$this->data['group_details'] = $this->Groups_model->Get_Object(AUTH_GROUPS,['id'=>$group_id]);
		$this->data['group_id'] = $group_id ;

		$this->Load_View('groups/group_users',$this->data);
	}


	public function getgroups()
	{
		$groups = $this->Groups_model->Get_Objects(AUTH_GROUPS);

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
		$groups = $this->Groups_model->Get_Objects(AUTH_GROUPS);

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
