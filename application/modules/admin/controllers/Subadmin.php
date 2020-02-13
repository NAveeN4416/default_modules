<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/admin/controllers/Base.php');

class Subadmin extends Base {

  function __construct()
  {
    // Construct the parent class
    parent::__construct();

    $this->controller = "subadmin";
    $this->controller_path = "admin/subadmin/";

    if(!$this->is_authenticated || $this->is_superuser){
      redirect('admin/base/login_page');
    }
  }

  function index()
  {
    echo "Welcome Subadmin ! <br>"."<a href='".base_url()."admin/subadmin/logout'>Logout here</a>" ;
  }
}