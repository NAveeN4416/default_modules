<?php 

$ch2 = curl_init();
curl_setopt($ch2, CURLOPT_URL, "https://www.volivesolutions.com/ajer_dev/home/make_product_old");
curl_setopt($ch2, CURLOPT_HEADER, 0);
curl_exec($ch2);
curl_close($ch2);


?>