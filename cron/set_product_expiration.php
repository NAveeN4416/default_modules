<?php

$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, "https://www.volivesolutions.com/ajer_dev/home/set_order_expiration");
curl_setopt($ch1, CURLOPT_HEADER, 0);
curl_exec($ch1);
curl_close($ch1);

$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, "https://www.volivesolutions.com/ajer_dev/services/auto_complete_request?API-KEY=963524");
curl_setopt($ch2, CURLOPT_HEADER, 0);
curl_exec($ch2);
curl_close($ch2);


/*$ch3 = curl_init();
curl_setopt($ch3, CURLOPT_URL, "https://www.volivesolutions.com/ajer_dev/services/change_objection_status?API-KEY=963524");
curl_setopt($ch3, CURLOPT_HEADER, 0);
curl_exec($ch3);
curl_close($ch3);*/

?>