<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/settings/controllers/Base.php');
class User_Permissions extends Base {

	/**
	 * Restrict Users to access your site
	 *
	 * Maps to the following URL
	 * 		http://example.com/permissions
	 */

	public function __construct()
  	{
        // Construct the parent class
     	parent::__construct();
      $this->load->model('Groups_model');
      $this->load->model('Permissions_model');

    	$this->controller_path = "settings/permissions";
    	$this->controller = "permissions";
    	$this->data = [] ;
  	}


  	public function index()
  	{
      $this->data['groups'] = $this->Groups_model->Get_groups();
      $this->data['menu'] = $this->Permissions_model->get_menu();

  		$this->Load_View('groups/permissions/permissions',$this->data);
  	}


    public function Submit_Permissions()
    {
      $post_data = $this->input->post();

      $data['group_id'] = $post_data['group_id'];
      $data['permissions'] = json_encode(['permissions'=>$post_data['permissions']]);

      $flag = $this->Permissions_model->save_permissions($data);

      $this->Ajax['status'] = 1 ;
      $this->Ajax['messsage'] = "Success" ;

      echo $this->AjaxResponse();
    }

    public function edit_permissions($group_id)
    {
      //$this->data['groups'] = $this->Groups_model->Get_groups();
      $this->data['group'] = $this->Groups_model->get_group($group_id);
      $this->data['menu'] = $this->Permissions_model->get_menu();
      $permissions = $this->Permissions_model->get_permission($group_id);

      if($permissions)
      {
        $permissions['permissions'] = json_decode($permissions['permissions'],true)['permissions'];
      }

      $this->data['permissions'] = $permissions ;
      $this->data['group_id'] = $group_id ;

      //echo "<pre>"; print_r($this->data);exit;

      $this->Load_View('groups/permissions/permissions',$this->data);
    }
}
