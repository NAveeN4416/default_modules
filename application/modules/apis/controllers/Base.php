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
 	 	$this->__initialize_vars_objects();

    //Choose Live or Production Database
    $this->Load_Database();

 	 	//Loading Models
 	 	$this->load->model('Common_model');

    $this->controller_name = $this->router->fetch_class() ;
    $this->api_method = $this->router->fetch_method() ;
    $this->__Check_Authentication_Policy();
	}

  private function __Check_Serive_Activity($service_policy)
  {
    if($service_policy['status']=="InActive")
    {
      $this->status = 0;
      $this->message = "{$this->api_method} Api is InActive !";
      return $this->Send_Response();
    }

  }

  private function __Check_Authentication_Policy()
  {
    $where['api_method'] = $this->api_method ;

    $service_policy = $this->Common_model->Get_Object(MOBILE_APIS,$where);

    $this->__Check_Serive_Activity($service_policy);

    $authentication_type = $service_policy['mobile_authentications']['slug'];
    $this->authentication_type = $service_policy['mobile_authentications']['authentication_name'];

    if($authentication_type=='basic_authentication')
    {
      $this->Basic_Authentication();
    }

    if($authentication_type=='token_authentication')
    {
      $this->Token_Authentication();
    }
  }

	private function __initialize_vars_objects()
	{
    //Request Authentication Vars
		$this->is_logged_in = false ;
		$this->user_id = 0 ;
    $this->user = array();


    //Response Variables
    $this->status = 1 ;
    $this->message = SUCCESS ;
    $this->http_code = REST_Controller::HTTP_OK ;
    $this->data = array();
    $this->validation_errors = array();
    $this->authentication_type = "No Authentication" ;


    //Objects
    $this->groups_obj = new Groups();
    $this->permissions_obj = new Permissions();
	}

  public function Send_Response($after_response=false)
  {
    $result = [
                  "status"            => $this->status,
                  "message"           => $this->message,
                  "data"              => $this->data,
                  "validation_errors" => $this->validation_errors,
                  "authentication_type" => $this->authentication_type,
              ];
  

    $this->response($result,$this->http_code,$after_response);
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


  private function __Check_user($where)
  {
    return $this->db->where($where)->get(USERS)->result_array();
  }

  private function Token_Authentication()
  {
    if(isset($_SERVER['HTTP_AUTHORIZATION']))
    {
    	$Auth_header = $_SERVER['HTTP_AUTHORIZATION'] ; 

    	$auth = explode(" ", $Auth_header);

    	if(count($auth)==2)
    	{
    		$flag = $auth[0];
    		$token = $auth[1];

    		//Get user of this token
				$this->user_id = @$this->Common_model->Get_Object(MOBILE_AUTH_TOKENS,['token'=>$token])['user_id'];

				if($this->user_id)
				{
					$this->is_logged_in = true ;
          $this->user = $this->get_user($this->user_id);
					return true;
				}

        $this->status = 0 ;
        $this->message = "Please login !" ;

		    return $this->Send_Response();
      }

      $this->status = 0 ;
      $this->message = "Invalid Token !";

      return $this->Send_Response();
    }

	 $this->status = 0 ;
   $this->message = "Authentication Required" ;
   return $this->Send_Response();
  }

  private function Basic_Authentication()
  {
    $username = (@$_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : '' ;
    $password = @($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '' ;

    if($username && $password)
    {
      $password = base64_encode($password);

      $where['email'] = $username ;

      $user = $this->__Check_user($where);

      if(count($user)==1)
      {
        if($password!=$user[0]['password'])
        {
          $this->status = 0;
          $this->message = "Invalid Password !";
          goto end;
        }

        $this->user = $user[0];
        $this->user_id = $user[0]['id'];
        $this->is_logged_in = true ;
        return true;
      }

      if(count($user)>1)
      {
        $this->status = 0 ;
        $this->message = "Sorry !, multiple records found";
      }else{
        $this->status = 0 ;
        $this->message = "Invalid Credentials !" ;
      }

      end:
      return $this->Send_Response();
    }

    $this->status = 0 ;
    $this->message = "Username & Password Required !";

    return $this->Send_Response();
  }

  public function Create_Token($n=50) { 
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*?'; 
      $token = ''; 
    
      for ($i = 0; $i < $n; $i++) { 
          $index = rand(0, strlen($characters) - 1); 
          $token .= $characters[$index]; 
      } 
    
      return $token; 
  } 

}

?>