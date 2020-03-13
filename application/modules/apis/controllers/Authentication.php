<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/apis/controllers/Base.php');

class Authentication extends Base {

  function __construct()
  {
    // Construct the parent class
    parent::__construct();

    $this->controller_path = "apis/authentication/";
    $this->controller = "authentication";
  }

  public function index_get()
  {
    $result = ['status'=>1,"message"=>date('Y-m-d h:i:s')];

    $this->response($result,REST_Controller::HTTP_OK);
  }

}