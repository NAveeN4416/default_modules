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


    public function get_group_permissions($group_id)
    {
        return $this->_CI->db->select('*')
                             ->where('group_id',$group_id)
                             ->get('auth_group_permissions')
                             ->result_array();
    }

}

?>