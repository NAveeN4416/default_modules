<?PHP 
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_SessionVars {

	function __construct()
	{
		//pass
	}

	public function auth_role()
	{
    	return 'USER_ROLE';
	}

	public function auth_role_id()
	{
    	return 'ROLE_ID';
	}

	public function auth_user_id()
	{
    	return 'USER_ID';
	}

	public function auth_username()
	{
    	return 'USER_NAME';
	}	

	public function auth_email()
	{
    	return 'EMAIL';
	}

}
