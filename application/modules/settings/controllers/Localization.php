<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/settings/controllers/Base.php');
class Localization extends Base {

	/**
	 * All About Static words
	 *
	 * Maps to the following URL
	 * 		http://example.com/localization
	 */
	public $auth_classes = 'Auth_Class';


	public function __construct()
  	{
        // Construct the parent class
     	parent::__construct();

    	$this->controller_path = "settings/localization";
    	$this->controller = "localization";
  	}

}
