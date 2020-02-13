<?PHP 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_SessionVars {

	public function auth_user_id()
	{
    	return 'USER_ID';
	}

	public function auth_username()
	{
    	return 'USERNAME';
	}	

	public function auth_email()
	{
    	return 'EMAIL';
	}

	public function is_active()
	{
    	return 'IS_ACTIVE';
	}

	public function is_superuser()
	{
    	return 'IS_SUPERUSER';
	}

	public function auth_group()
	{
    	return 'GROUP_NAME';
	}

	public function auth_groups()
	{
    	return 'GROUPS';
	}

	public function auth_permissions()
	{
    	return 'PERMISSIONS';
	}

	public function is_authenticated()
	{
    	return 'is_authenticated';
	}
}
