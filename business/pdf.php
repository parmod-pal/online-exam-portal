<?php
$url = urlencode('http://www.google.com/');
$image_url = 'http://images.websnapr.com/?url=' . $url . '&size=s';
 
$ch = curl_init();
$timeout = 0;
curl_setopt($ch, CURLOPT_URL, $image_url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
 
// Getting binary data
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
 
$image = curl_exec($ch);
curl_close($ch);
 
// output to browser
header("Content-type: image/jpeg");
$imageFile=fopen('websiteimage.jpg', 'w');
fwrite($imageFile,$image);
//print $image;
?>
<img src="http://images.websnapr.com/?url='..'&size=s" alt="Site image" />