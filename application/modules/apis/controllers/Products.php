<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/apis/controllers/Base.php');

class Products extends Base {

  function __construct()
  {
    // Construct the parent class
    parent::__construct();
    $this->__Site_Status();

    $this->controller = "home";
    $this->controller_path = "site/home/";
  }

  public function __Site_Status($status='')
  {
    //Check if explicitly calling or not
    if($status=='')
    {
      $status = $this->site_config['status'];
    }

    if($status==0)
    {
      return redirect('site/independent/index');
    }
  }

  public function index()
  {
    echo "Site Working fine" ;
  }

}