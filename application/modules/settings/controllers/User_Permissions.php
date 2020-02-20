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

    	$this->controller_path = "settings/permissions";
    	$this->controller = "permissions";
    	$this->data = [] ;
  	}


  	public function index()
  	{
  		$this->Load_View('groups/permissions/permissions');
  	}


    public function edit_permissions($group_id)
    {
      $this->Load_View('groups/permissions/permissions');
    }
}
