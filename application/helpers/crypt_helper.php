<?php  
defined('BASEPATH') or exit('No direct script access allowed');

if( ! function_exists('encrpt') )
{
	function encrpt($id = '')
	{
	  return urlencode(base64_encode($id));
	}
}

if( ! function_exists('decrpt') )
{
	function decrpt($id = '')
	{
	  return base64_decode(urldecode($id));
	}
}