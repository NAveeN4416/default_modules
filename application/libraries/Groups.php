<?php


defined('BASEPATH') OR exit('No direct script access allowed');


class Groups {

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

        $db_mode =  $this->_CI->db->get(SITE_CONFIG)->row_array()['site_db'];
        if($db_mode=="Development")
        {
          $this->_CI->db = $this->_CI->load->database("development",True);
          //echo "Development db loaded" ;exit;
        }
        else
        {
          $this->_CI->db = $this->_CI->load->database("default",True);
        }

        $this->_CI->load->library('session');
    }

    public function get_groups($user_id)
    {
        $groups = array() ;

        $groups_list = $this->_CI->db->select('id')->where('user_id',$user_id)->get('auth_user_groups')->result_array();

        foreach ($groups_list as $key => $group) {
            $groups[] = $group['id'] ;
        }

        return $groups ;
    }

    public function get_group($user_id)
    {
        return $this->_CI->db->where('user_id',$user_id)->get('auth_user_groups')->row_array();
    }


    public function get_group_details($group_id)
    {
        $group = $this->_CI->db->where('id',$group_id)->get('auth_groups')->row_array();

        return $group ;
    }

}

?>