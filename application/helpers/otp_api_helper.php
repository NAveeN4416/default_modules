<?php  

defined('BASEPATH') or exit('No direct script access allowed');


	function send_otp($mobile)
	{
		$ch = curl_init();

		$options = array(
						    CURLOPT_URL            => 'https://api.cmtelecom.com/v1.0/otp/generate',
						    CURLOPT_HTTPHEADER     => array(
														        'Content-Type: application/json',
														        'X-CM-ProductToken: 1462cdb6-9f89-4adf-aa2e-d4794d888622',
														    ),
						    CURLOPT_POST           => true,
						    CURLOPT_POSTFIELDS     => json_encode(array(
																        'recipient' => '+966'.$mobile,
																        'sender' 	=> 'ZIDO',
																        'length'    => 4,
																        'expiry'    => 180,
																        'message'   => 'زيدو   Zido -كلمة السر   OTP للدخول   {code}'
																	    )),
						    CURLOPT_RETURNTRANSFER => true
						);

		curl_setopt_array($ch, $options);
		$response = curl_exec($ch);
		curl_close($ch);

		$generateResponse = json_decode($response);

		return $generateResponse ;
	}


	function verify_otp($message_id,$code)
	{
		$ch = curl_init();

		$options = array(
		    CURLOPT_URL            => 'https://api.cmtelecom.com/v1.0/otp/verify',
		    CURLOPT_HTTPHEADER     => array(
										        'Content-Type: application/json',
										        'X-CM-ProductToken: 1462cdb6-9f89-4adf-aa2e-d4794d888622',
										    ),
		    CURLOPT_POST           => true,
		    CURLOPT_POSTFIELDS     => json_encode(array(
												        'id'   => $message_id,
												        'code' => $code,
												    )),
		    CURLOPT_RETURNTRANSFER => true
		);

		curl_setopt_array($ch, $options);
		$response = curl_exec($ch);
		curl_close($ch);

		$verifyResponse = json_decode($response);

		return $verifyResponse ;
	}


	function send_message($mobile,$password)
	{
		$ch = curl_init();

		$options = array(
						    CURLOPT_URL            => 'https://api.cmtelecom.com/v1.0/otp/generate',
						    CURLOPT_HTTPHEADER     => array(
														        'Content-Type: application/json',
														        'X-CM-ProductToken: 1462cdb6-9f89-4adf-aa2e-d4794d888622',
														    ),
						    CURLOPT_POST           => true,
						    CURLOPT_POSTFIELDS     => json_encode(array(
																        'recipient' => '+966'.$mobile,
																        'sender' 	=> 'ZIDO',
																        'message'   => 'زيدو   Zido -  كلمةالمرور  الجديدة   Password '. $password
																	    )),
						    CURLOPT_RETURNTRANSFER => true
						);

		curl_setopt_array($ch, $options);
		$response = curl_exec($ch);
		curl_close($ch);

		$generateResponse = json_decode($response);

		return $generateResponse ;
	}


?>






