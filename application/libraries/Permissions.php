<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Permissions {

    /**
     * CodeIgniter instance
     *
     * @var object
     */
    private $_CI;
    private $_GROUPS = [] ;

    /**
     * 
     * @param array $rules
     * @param array $data
     * @param array $messages
     * @throws Exception
     */

    //Initialize with data
    public function __construct()
    {
        //Get the CodeIgniter reference
        $this->_CI = &get_instance();

        $this->_CI->load->database();
        $this->_CI->load->library('session');
        $this->_CI->load->library('Auth_SessionVars');

    }

    public function get_permissions($permissions)
    {
        $total_permissions = array();

        foreach ($permissions as $key => $permission) {
           $permission = $this->_CI->db->where_in('id',$permission)
                                     ->get('auth_permissions')
                                     ->row_array();

            array_push($total_permissions, $permission);
        }

        return $total_permissions;
    }


    public function get_group_permissions($group_id)
    {
        return $this->_CI->db->select('permission_id')
                             ->where('group_id',$group_id)
                             ->get('auth_group_permissions')
                             ->result_array();
    }

}

?>