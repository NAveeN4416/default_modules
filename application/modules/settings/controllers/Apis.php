<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/settings/controllers/Base.php');
class Apis extends Base {

	/**
	 * All About API's of your Site
	 *
	 * Maps to the following URL
	 * 		http://example.com/apis
	 */

	public function __construct()
  {
        // Construct the parent class
     parent::__construct();
  }

  public function check_login()
  {
  	if($this->auth_level==9 || $this->auth_level==4)
  	{
  		//Let the request go further
  	}
  	else
  	{
  		//redirect and break
  		redirect('admin/logout');
  		exit;
  	}
  }
}

function delete_files($array_of_files,$type="")
{
	$type = ($type) ? $type : 'image' ;

	foreach ($array_of_files as $key => $file)
	{
		$file = $file[$type] ;

		unlink($file);
	}
}
