<?php
//1. secret-key
//2. secret-key-timestamp

//initializing secret key in some variable 
$key = md5("9893627028");
 
//encode it using base64
$encodedKey = base64_encode($key);
 
//Generate timestamp in long which works as a salt
$secret_key_timestamp = time();
 
//Computes the signature by hashing the salt with the secret key as the key
$signature = hash_hmac('SHA256', $secret_key_timestamp, $encodedKey, true);
 
//encode it using base64
$secret_key = base64_encode($signature);
 
echo "secret_key ".$secret_key;
echo "<br>secret_key_timestamp ".$secret_key_timestamp;
?>