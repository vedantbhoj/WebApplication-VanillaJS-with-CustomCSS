<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://pratikbhandarkar.com/nestaway/fetch_users.php");
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						$data= curl_exec ($ch);
						curl_close($ch);
echo($data);
die();
?>