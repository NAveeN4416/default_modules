<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Authentication {

    /**
     * CodeIgniter instance
     *
     * @var object
     */
    private $_CI;
   

    /**
     * 
     * @param array $rules
     * @param array $data
     * @param array $messages
     * @throws Exception
     */

    public $extra_session_vars = array() ; 

    //Initialize with data
    public function __construct()
    {
        //Get the CodeIgniter reference
        $this->_CI = &get_instance();

        //$this->_login_type = $login_type ;    

        $this->_CI->load->database();
        $this->_CI->load->library('session');
        $this->_CI->load->library('Groups');
        $this->_CI->load->library('Permissions');

        $this->groups_obj = new Groups();
        $this->permissions_obj = new Permissions();        
    }


    public function get_user($user_id)
    {
        $user = $this->_CI->db->where('id',$user_id)->get('auth_users')->row_array();

        $groups = array() ;
        $permissions = array() ;

        $groups = $this->groups_obj->get_groups($user_id);

        if($groups)
            foreach ($groups as $key => $group) {
                $permissions_list = $this->permissions_obj->get_group_permissions($group);
                $permissions = $this->permissions_obj->get_permissions($permissions_list);
            }

        $this->groups = $groups;
        $this->permissions = $permissions;

        $user['groups'] = $groups;
        $user['permissions'] = $permissions;

        return $user;
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
            $this->_CI->session->set_userdata($session_data);

            return true;
        }
        catch(Exception $e){
            return false ;
        }
    }

    public function set_session_data($user)
    {
        $this->_CI->load->library('Auth_SessionVars');
        $auth_vars = new Auth_SessionVars();

        $set = [] ;

        $set[$auth_vars->auth_user_id()] = $user['id'] ;
        $set[$auth_vars->auth_username()] = $user['username'] ;
        $set[$auth_vars->auth_email()] = $user['email'] ;
        $set[$auth_vars->is_active()] = $user['is_active'] ;
        $set[$auth_vars->is_superuser()] = $user['is_superuser'] ;
        $set[$auth_vars->auth_groups()] = $user['groups'] ;
        $set[$auth_vars->auth_permissions()] = $user['permissions'] ;

        foreach ($this->extra_session_vars as $key => $value) {
            $set[$key] = $value ;
        }

        return $set ;
    }

    public function logout()
    {
        return $this->_CI->session->sess_destroy();
    }

}

?>