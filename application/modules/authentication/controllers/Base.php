<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/CO_Controller.php';

class Base extends CO_Controller {

  function __construct()
  {
    // Construct the parent class
    parent::__construct();

    $this->load->model('Auth_model');    
    $this->site_config = $this->Auth_model->Get_Site_Config();
  }

  public function Check_Authentication()
  {
    $this->is_authenticated = @$this->session->is_authenticated ;
    $this->is_superuser = @$this->session->IS_SUPERUSER ;
    $this->role = @$this->session->GROUP_NAME ;

    if(@$this->is_authenticated)
    {
      if(@$this->is_superuser)
        redirect(ADMIN_CONTROLLER_PATH);

      if(@$this->role=='developer')
        redirect(DEVELOPER_CONTROLLER_PATH);

      if(@$this->role=='HR')
        redirect(ADMIN_CONTROLLER_PATH.'Subadmin/');
    }
  }


  public function _Check_user($post_data)
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

    //if USER is inactive
    if($user['is_active']!=1)
    {
      return USER_INACTIVE ;
    }

    //Return user details
    return $user ;
  }

  public function authenticate($user_id=0)
  {
    if(!$user_id)
        return false;

    try
    {
        $user = $this->get_user($user_id);
        $session_data = $this->_set_session_data($user);
        //Setting Session data
        $this->session->set_userdata($session_data);
        $this->_set_loggedin_flag(1);
        return true;
    }
    catch(Exception $e){
        return false ;
    }
  }

  private function _set_loggedin_flag($flag)
  {
      $user_id = $this->session->userdata($this->auth_vars->auth_user_id());
      $this->db->set('is_logged_in',$flag)->where('id',$user_id)->update(USERS);
  }

  private function _set_session_data($user)
  {
    $set = [] ;

    $set[$this->auth_vars->auth_user_id()] = $user['id'] ;
    $set[$this->auth_vars->auth_username()] = $user['username'] ;
    $set[$this->auth_vars->auth_email()] = $user['email'] ;
    $set[$this->auth_vars->is_active()] = $user['is_active'] ;
    $set[$this->auth_vars->is_superuser()] = $user['is_superuser'] ;
    $set[$this->auth_vars->auth_group()] = $this->groups_obj->get_group_details($user['groups']['group_id'])['group_name'] ;
    $set[$this->auth_vars->auth_groups()] = $user['groups'] ;
    $set[$this->auth_vars->auth_permissions()] = $user['permissions'] ;
    $set[$this->auth_vars->is_authenticated()] = true ;

    foreach ($this->extra_session_vars as $key => $value) {
        $set[$key] = $value ;
    }

    return $set ;
  }

  private function _get_session_vars()
  {
    return [
              $this->auth_vars->auth_user_id(),
              $this->auth_vars->auth_username(),
              $this->auth_vars->auth_email(),
              $this->auth_vars->is_active(),
              $this->auth_vars->is_superuser(),
              $this->auth_vars->auth_group(),
              $this->auth_vars->auth_groups(),
              $this->auth_vars->auth_permissions(),
              $this->auth_vars->is_authenticated(),
          ];
  }


  public function logout()
  {
    $this->_set_loggedin_flag(0);

    //Destroy only the userdata not all the session
    $this->session->unset_userdata($this->_get_session_vars());
    //$this->session->sess_destroy();

    $this->session->set_flashdata("message",LOGOUT_SUCCESS);
    redirect($this->controller_path);
  }

}