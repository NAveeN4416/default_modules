<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'modules/authentication/controllers/Base.php');

class Auth extends Base {

  function __construct()
  {
    // Construct the parent class
    parent::__construct();
    $this->load->library('Auth_SessionVars');

    $this->controller = 'auth/' ;
    $this->controller_path = AUTH_CONTROLLER_PATH ;

    $this->load->model("Auth_model");
  }

  public function index()
  {
    $this->Check_Authentication();

    $this->data['message'] = @$this->session->flashdata('message');
    $this->load->view('login',$this->data);
  }


  public function Forgot_Password()
  {
    $this->data['message'] = @$this->session->flashdata('message');
    $this->load->view('forgot_password',$this->data);
  }

  public function Send_Verification_Code()
  {
    $this->data['message'] = @$this->session->flashdata('message');
    $this->load->view('change_password',$this->data);
  }


  public function login()
  {
    $post_data = $this->input->post();
    
    if(!$post_data)
    {
      redirect($this->controller_path);
    }

    $user_flag = $this->_Check_user($post_data);

    //if anything wrong
    if($user_flag==INVALID_CREDENTIALS || $user_flag==INVALID_PASSWORD || $user_flag==USER_INACTIVE)
    {
      $this->session->set_flashdata("message",$user_flag);
      redirect($this->controller_path);
    }

    if($user_flag)
    {
    	$flag = $this->authenticate($user_flag['id']);

	    if($flag)
	    {
        $this->is_authenticated = @$this->session->is_authenticated ;
        $this->is_superuser = @$this->session->IS_SUPERUSER ;
        $this->role = @$this->session->GROUP_NAME ;

        if(@$this->role=='HR')
          redirect(ADMIN_CONTROLLER_PATH.'Subadmin/');

	      redirect('admin/');
	    }
    }
  }

  public function Ajax_Login()
  {
    $post_data = $this->input->post();
    
    if(!$post_data)
    {
      redirect($this->controller_path);
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