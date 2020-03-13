<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Base extends REST_Controller {

	public function __construct()
  	{
    	// Construct the parent class
   	 	parent::__construct();
   	 	$this->set_timezone();
   	 	$this->load->database();
   	 	$this->load->library('Groups');
        $this->load->library('Permissions');


        //Initilize Required Vars & Objects
   	 	$this->initialize_vars_objects();

        //Choose Live or Production Database
        $this->Load_Database();

   	 	//Loading Models
   	 	$this->load->model('Common_model');

		//$this->Token_Authentication();
  	}


  	private function initialize_vars_objects()
  	{
  		$this->is_logged_in = false ;
  		$this->user_id = 0 ;

  		$this->groups_obj = new Groups();
        $this->permissions_obj = new Permissions();
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

    private function Token_Authentication()
    {
    	$result = ['status'=>0,"message"=>"Token Required"];

        if(isset($_SERVER['HTTP_AUTHORIZATION']))
        {
        	$Auth_header = $_SERVER['HTTP_AUTHORIZATION'] ; 

        	$auth = explode(" ", $Auth_header);

        	if(count($auth)==2)
        	{
        		$flag = $auth[0];
        		$token = $auth[1];

        		//Get user for this token
				$this->user_id = @$this->Common_model->Get_Object(MOBILE_AUTH_TOKENS,['token'=>$token])['user_id'];

				if($this->user_id)
				{
					$this->is_logged_in = true ;
					return true;
				}

				$result['message'] = "Please login !";

		    	$this->response($result, REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
		    	return ;
        	}

        	$result['message'] = "Invalid Token !";
		    $this->response($result, REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code

		    return;
        }

		// Set the response and exit
		$result['message'] = "Authentication Required !";
	    $this->response($result, REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
    } 

}

?>