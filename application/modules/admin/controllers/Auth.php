<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/admin/controllers/Base.php');

class Auth extends Base {

  function __construct()
  {
    // Construct the parent class
    parent::__construct();

    $this->controller = "auth";
    $this->controller_path = "admin/auth/";

    $this->load->model("Auth_model");
  }

  public function index()
  {
    if($this->is_authenticated)

      if($this->is_superuser)
        redirect('admin/index');

      if($this->role=='developer')
        redirect('admin/subadmin/index');

    $this->data['message'] = @$this->session->flashdata('message');
    $this->load->view('login',$this->data);
  }

  private function _Check_user($post_data)
  {
  	$login_config = $this->Auth_model->login_config();

    $where[$login_config['web_key']] = $post_data['email'] ;

  	$user = $this->Auth_model->Get_User($where);

    //if user not found
    if(!$user)
    {
      return INVALID_CREDENTIALS ;
    }

    //if password is incorrect
    if(base64_encode($post_data['password'])!=$user['password'])
    {
      return INVALID_PASSWORD ;
    }

    //Return user details
  	return $user ;
  }

  public function login()
  {
    $post_data = $this->input->post();
    
    if(!$post_data)
    {
      redirect('admin/auth');
    }

    $user_flag = $this->_Check_user($post_data);

    //if anything wrong
    if($user_flag==INVALID_CREDENTIALS || $user_flag==INVALID_PASSWORD)
    {
      $this->session->set_flashdata("message",$user_flag);
      redirect('admin/auth');
    }

    if($user_flag)
    {
    	$flag = $this->authenticate($user_flag['id']);

	    if($flag)
	    {
	      redirect('admin');
	    }
    }
  }

  public function Ajax_Login()
  {
    $post_data = $this->input->post();
    
    if(!$post_data)
    {
      redirect('admin/auth');
    }

    $user_flag = $this->_Check_user($post_data);

    //if anything wrong
    if($user_flag==INVALID_CREDENTIALS || $user_flag==INVALID_PASSWORD)
    {
      echo json_encode(['status'=>0,"message"=>$user_flag]);
      return;
    }

    if($user_flag)
    {
    	$flag = $this->authenticate($user_flag['id']);

	    if($flag)
	    {
	      echo json_encode(['status'=>1,"message"=>"Success"]);
        return;
	    }
    }

    echo json_encode(['status'=>0,"message"=>"User not found!"]);
  }

}