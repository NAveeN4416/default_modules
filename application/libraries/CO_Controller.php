<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CO_Controller extends MY_Controller {

    public $extra_session_vars = array() ; 

	public function __construct()
	{
		parent::__construct();
        $this->load->database();

        //Choose Live or Production Database
        $this->Load_Database();

        $this->load->library('session');
        $this->load->library('Auth_SessionVars');
        $this->load->library('Groups');
        $this->load->library('Permissions');

        $this->auth_vars = new Auth_SessionVars();
        $this->groups_obj 	  = new Groups();
        $this->permissions_obj = new Permissions(); 

        $this->set_timezone();
	}

    //Loading Database as Selection from Developer
    public function Load_Database()
    {
        $db_mode =  $this->db->get(SITE_CONFIG)->row_array()['site_db'];

        if($db_mode=="Development")
        {
          $this->db = $this->load->database("development",True);
          //echo "Development db loaded" ;exit;
        }
        else
        {
          $this->db = $this->load->database("default",True);
        }
    }

    public function set_timezone($time_zone="Asia/Calcutta")
    {
    	date_default_timezone_set($time_zone) ;
    }

    //Getting data for setting session
    public function get_user($user_id)
    {
        $user = $this->db->where('id',$user_id)->get('auth_users')->row_array();

        $groups = array() ;
        $permissions = array() ;

        $groups = $this->groups_obj->get_group($user_id);
        $permissions = $this->permissions_obj->get_group_permissions($groups['id']);
        //$permissions = $this->permissions_obj->get_permissions($permissions);

        $this->groups = $groups;
        $this->permissions = $permissions;

        $user['groups'] = $groups;
        $user['permissions'] = $permissions;

        return $user;
    }
}

?>