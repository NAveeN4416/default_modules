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

  }

  public function index()
  {
    if($this->is_authenticated)

      if($this->is_superuser)
        redirect('admin/index');

      if($this->role=='developer')
        redirect('admin/subadmin/index');


    echo "<a href='".base_url()."admin/auth/login'>Login</a>" ;
  }

  private function _Check_user($data)
  {
  	$login_config = $this->Auth_model->login_config();

    $where[$login_config['web_key']] = 'admin@gmail.com' ;
    $where['password'] = base64_encode(123456) ;

  	$user = $this->db->where($where)->get('auth_users')->row_array();

  	return $user ;
  }

  public function login()
  {
    $post_data = $this->input->post();
    
    $user = $this->_Check_user($post_data);

    if($user)
    {
    	$flag = $this->authenticate($user['id']);

	    if($flag)
	    {
	      redirect('admin/auth');
	    }
    }

    echo "User not found !";
  }


  public function Ajax_login()
  {
    $post_data = $this->input->post();
    
    $login_config = $this->Auth_model->login_config();

    $where[$login_config['web_key']] = 'developer@gmail.com' ;
    $where['password'] = base64_encode(123456) ;

    $user = $this->db->where($where)->get('auth_users')->row_array();

    if($user)
    {
    	$flag = $this->authenticate($user['id']);

	    if($flag)
	    {
	      echo json_encode(['satus'=>1,"message"=>"Success"]);
	    }
    }

    echo json_encode(['satus'=>0,"message"=>"User not found!"]);
  }

}