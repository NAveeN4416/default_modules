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

    $this->post_data = $this->post();
    $this->query_params = $this->get();
    $this->files = $_FILES ;
  }

  public function index_get()
  {
    $result = ['status'=>1,"message"=>date('Y-m-d h:i:s')];

    $this->response($result,REST_Controller::HTTP_OK);
  }

  public function generate_token_post()
  {
    $username = $this->post_data['username'];
    $password = $this->post_data['password'];

    $flag = $this->Common_model->Authenticate_User($username,$password);

    if($flag==INVALID_CREDENTIALS || $flag==INVALID_PASSWORD)
    {
      $this->status = 0 ;
      $this->message = $flag ;

      return $this->Send_Response();
    }
    else
    {
      $user = $flag ;
      $token = $this->Create_Token();

      $set['token'] = $token;
      $set['user_id'] = $user['id'];

      $upsert_flag = $this->Common_model->Upsert_Token($set);

      if($upsert_flag)
      {
        $this->status = 0;
        $this->message = SUCCESS;
        $this->data['Token'] = $token;
        return $this->Send_Response();
      }
    }
  }

  public function Get_Cities_get()
  {
    $this->status = 1;
    $this->message = "Success" ;
    $this->data['cities'] = [ "Hyderabad", "Banglore", "Chennai"];

    return $this->Send_Response();
  }


}