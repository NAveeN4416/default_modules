<?php  
defined('BASEPATH') or exit('No direct script access allowed');

if( ! function_exists('send_mail') )
{
	function send_mail($to,$subject,$template)
	{
		
		$from     = "noreply@ajer.com";
	    $headers  = "From:<$from>\n";
	    $headers .= "MIME-Version: 1.0\n";
	    $headers .= "Content-type: text/html; charset=iso 8859-1";

	    //mail($to,$subject,$txt,$headers);

	    return  mail($to,$subject,$template,$headers,"-f$from");

	    //return true;
	}
}