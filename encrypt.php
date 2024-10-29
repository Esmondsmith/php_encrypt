<?php

$encrypt_method_used = 'AES-256-CBC';
$secret_key = 'esmond_key_15'; 
$init_vector = substr(hash('sha256', 'init_vector_string'), 0, 16); 

$originalString = "Welcome to Lagos";

// Encrypt string
$encryptedString = openssl_encrypt($originalString, $encrypt_method_used, $secret_key, 0, $init_vector);
$encryptedString = base64_encode($encryptedString); 
$encryptedStringForHex = bin2hex($encryptedString); //This is for hexadecimal(HEX)

// Decrypt string
$decryptedString = openssl_decrypt(base64_decode($encryptedString), $encrypt_method_used, $secret_key, 0, $init_vector);

echo "Original String: " . $originalString . "<br>";
echo "Encrypted String: " . $encryptedString . "<br>";
echo "Decrypted String: " . $decryptedString . "<br>";



?>
