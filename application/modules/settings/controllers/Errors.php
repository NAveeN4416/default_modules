<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/CO_Controller.php';
class Errors extends CO_Controller {

	/**
	 * All About Static words
	 *
	 * Maps to the following URL
	 * 		http://example.com/localization
	 */
	public function __construct()
  	{
        // Construct the parent class
     	parent::__construct();

    	$this->controller_path = "settings/errors";
    	$this->controller = "errors";
  	}

  	public function Not_Authorised()
  	{
  		$this->load->view('error/403.html');
  	}
}
