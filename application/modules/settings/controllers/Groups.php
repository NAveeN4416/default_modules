<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/settings/controllers/Base.php');
class Groups extends Base {

	/**
	 * All About User Groups
	 *
	 * Maps to the following URL
	 * 		http://example.com/groups
	 */

	public function __construct()
  	{
        // Construct the parent class
     	parent::__construct();

    	$this->controller_path = "settings/groups";
    	$this->controller = "groups";
  	}

}
