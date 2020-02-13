<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CO_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->database();

        $this->load->library('session');
        $this->load->library('Auth_SessionVars');
        $this->load->library('Authentication');
        $this->load->library('Groups');
        $this->load->library('Permissions');

        $this->Auth = new Authentication(); 
        $this->auth_vars = new Auth_SessionVars();
        $this->groups_obj 	  = new Groups();
        $this->permissions_obj = new Permissions(); 

        
        $this->set_timezone();
	}



    public function set_timezone($time_zone="Asia/Calcutta")
    {
    	date_default_timezone_set($time_zone) ;
    }

    public function authenticate($user_id=0)
    {
        if(!$user_id)
            return false;

        try
        {
            $user = $this->get_user($user_id);
            $session_data = $this->set_session_data($user);
            //Setting Session data
            $this->session->set_userdata($session_data);

            return true;
        }
        catch(Exception $e){
            return false ;
        }
    }


    public function set_session_data($user)
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

    //Getting data for setting session
    public function get_user($user_id)
    {
        $user = $this->db->where('id',$user_id)->get('auth_users')->row_array();

        $groups = array() ;
        $permissions = array() ;

        $groups = $this->groups_obj->get_group($user_id);
        $permissions = $this->permissions_obj->get_group_permissions($groups['id']);
        $permissions = $this->permissions_obj->get_permissions($permissions);

        $this->groups = $groups;
        $this->permissions = $permissions;

        $user['groups'] = $groups;
        $user['permissions'] = $permissions;

        return $user;
    }


	//Response outgoing <---> Request
	public function load_pages($body,$data)
	{
  	  //if user logged in check for Mobile verified or not if not redirect
      if($this->auth_level==1)
      {
       	$this->check_otp();
      }

	  $page_path =  'home/'.$body ;

	  $this->load->view('home/includes/header2',$data);
	  $this->load->view($page_path,$data);
	  $this->load->view('home/includes/footer2',$data);
	}

}

?>