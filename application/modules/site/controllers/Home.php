<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/site/controllers/Base.php');

class Home extends Base {

  function __construct()
  {
    // Construct the parent class
    parent::__construct();

    $this->controller = "home";
    $this->controller_path = "site/home/";

  }

  public function index()
  {
    echo "Site Working fine" ;
  }

}